/* =================================================
   Eventify — booking.js
   Sub-service accordion, dynamic pricing,
   payment modal logic.
   ================================================= */

(function () {
    'use strict';

    /* ──────────────────────────────────────────────
       Pricing helpers
    ────────────────────────────────────────────── */
    const BASE_GUEST = 30;
    const EXTRA_GUEST_RATE = 100; // ₱ per guest above 30 (packages only)

    // Whether this is an ala-carte booking (set via window.BOOKING_DATA.isAlaCarte in Blade)
    const isAlaCarte = !!(window.BOOKING_DATA && window.BOOKING_DATA.isAlaCarte);

    function formatPHP(n) {
        return '₱' + n.toLocaleString('en-PH');
    }

    function computeTotal() {
        let base = 0;

        document.querySelectorAll('.subsvc-cbx:checked').forEach(cb => {
            base += parseFloat(cb.dataset.price) || 0;
        });

        // Guest surcharge only applies to package bookings, not ala-carte
        let extra = 0;
        if (!isAlaCarte) {
            const guests = parseInt(document.getElementById('bkGuestCount').value, 10) || 0;
            extra = Math.max(0, guests - BASE_GUEST) * EXTRA_GUEST_RATE;
        }

        return base + extra;
    }

    function updatePrice() {
        const total = computeTotal();
        const el = document.getElementById('bkTotalAmount');
        const payEl = document.getElementById('payModalAmount');
        if (el) el.textContent = formatPHP(total);
        if (payEl) payEl.textContent = formatPHP(total);
    }

    /* ──────────────────────────────────────────────
       Accordion: open/close sub-service groups
    ────────────────────────────────────────────── */
    function initAccordions() {
        document.querySelectorAll('.subsvc-header').forEach(header => {
            header.addEventListener('click', () => {
                const group = header.closest('.subsvc-group');
                group.classList.toggle('is-open');
            });
        });

        // Auto-open first accordion
        const first = document.querySelector('.subsvc-group');
        if (first) first.classList.add('is-open');
    }

    /* ──────────────────────────────────────────────
       Sub-service checkboxes
    ────────────────────────────────────────────── */
    function initCheckboxes() {
        document.querySelectorAll('.subsvc-cbx').forEach(cb => {
            cb.addEventListener('change', function () {
                const item = this.closest('.subsvc-item');
                item.classList.toggle('is-checked', this.checked);

                // Update badge count on the accordion header
                const group = item.closest('.subsvc-group');
                const checked = group.querySelectorAll('.subsvc-cbx:checked').length;
                const badge = group.querySelector('.subsvc-badge');
                if (badge) {
                    badge.textContent = checked + ' selected';
                    badge.classList.toggle('visible', checked > 0);
                }

                updatePrice();
            });
        });
    }

    /* ──────────────────────────────────────────────
       Guest count → update price
    ────────────────────────────────────────────── */
    function initGuestInput() {
        const input = document.getElementById('bkGuestCount');
        if (input) {
            input.addEventListener('input', updatePrice);
        }
    }

    /* ──────────────────────────────────────────────
       Payment modal
    ────────────────────────────────────────────── */
    function initPaymentModal() {
        const backdrop = document.getElementById('payBackdrop');
        const bookBtn = document.getElementById('payBookBtn');
        const reviewBtn = document.getElementById('bkReviewBtn');
        const closeBtn = document.getElementById('payCloseBtn');

        if (!backdrop) return;

        // Open modal
        reviewBtn.addEventListener('click', () => {
            updatePrice(); // sync amount
            backdrop.classList.add('is-open');
            document.body.style.overflow = 'hidden';
        });

        // Close modal
        function closePayModal() {
            backdrop.classList.remove('is-open');
            document.body.style.overflow = '';
        }

        closeBtn.addEventListener('click', closePayModal);
        backdrop.addEventListener('click', e => { if (e.target === backdrop) closePayModal(); });
        document.addEventListener('keydown', e => { if (e.key === 'Escape') closePayModal(); });

        // Payment option selection → enables Book button
        document.querySelectorAll('.pay-option').forEach(opt => {
            opt.addEventListener('click', () => {
                const radio = opt.querySelector('input[type="radio"]');
                if (radio) radio.checked = true;

                document.querySelectorAll('.pay-option').forEach(o => o.classList.remove('is-selected'));
                opt.classList.add('is-selected');

                bookBtn.disabled = false;
            });
        });

        // Book button click — submit booking via AJAX then redirect
        bookBtn.addEventListener('click', async () => {
            bookBtn.disabled = true;
            bookBtn.textContent = 'Saving…';

            // Collect selected sub-services
            const subServices = [];
            document.querySelectorAll('.subsvc-cbx:checked').forEach(cb => {
                subServices.push({
                    label: cb.dataset.label || '',
                    price: parseFloat(cb.dataset.price) || 0,
                });
            });

            const payload = {
                package_name:   window.BOOKING_DATA?.package || '',
                services:       window.BOOKING_DATA?.services || [],
                sub_services:   subServices,
                guest_count:    parseInt(document.getElementById('bkGuestCount')?.value, 10) || 0,
                event_date:     document.getElementById('bkEventDate')?.value || '',
                total_price:    computeTotal(),
                payment_method: document.querySelector('input[name="payment_method"]:checked')?.value || '',
            };

            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';

            try {
                const res = await fetch('/booking/store', {
                    method:  'POST',
                    headers: {
                        'Content-Type':     'application/json',
                        'Accept':           'application/json',
                        'X-CSRF-TOKEN':     csrfToken,
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    body: JSON.stringify(payload),
                });

                const data = await res.json();

                closePayModal();

                if (res.ok && data.success) {
                    if (typeof window.showToast === 'function') {
                        window.showToast('success', '🎉 Booking confirmed! Our team will be in touch soon.', 6000);
                    } else {
                        alert('🎉 Booking confirmed! Our team will be in touch soon.');
                    }
                    setTimeout(() => { window.location.href = '/'; }, 2200);
                } else {
                    throw new Error(data.message || 'Something went wrong.');
                }

            } catch (err) {
                bookBtn.disabled = false;
                bookBtn.textContent = 'Book Now';
                if (typeof window.showToast === 'function') {
                    window.showToast('error', '❌ ' + (err.message || 'Could not save booking. Please try again.'), 5000);
                } else {
                    alert('Error: ' + err.message);
                }
            }
        });
    }

    /* ──────────────────────────────────────────────
       Init
    ────────────────────────────────────────────── */
    document.addEventListener('DOMContentLoaded', () => {
        initAccordions();
        initCheckboxes();
        initGuestInput();
        initPaymentModal();
        updatePrice();
    });

})();
