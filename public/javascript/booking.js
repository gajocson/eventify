/* =================================================
   Eventify — booking.js
   Sub-service accordion, dynamic pricing,
   payment modal logic.
   ================================================= */

(function () {
    'use strict';

    /* ──────────────────────────────────────────────
       Sub-service data: label + base price (₱)
    ────────────────────────────────────────────── */
    const SUB_SERVICES = {
        'Furniture and Set‑up': [
            { id: 'fs-tables', label: 'Tables', price: 500 },
            { id: 'fs-chairs', label: 'Chairs', price: 300 },
            { id: 'fs-linens', label: 'Tablecloths & linens', price: 200 },
            { id: 'fs-covers', label: 'Chair covers & ribbons', price: 150 },
            { id: 'fs-stage', label: 'Stage / platform', price: 1500 },
            { id: 'fs-podium', label: 'Podium / lectern', price: 800 },
            { id: 'fs-tents', label: 'Tents & canopies', price: 2000 },
            { id: 'fs-backdrop', label: 'Backdrop / event backdrop', price: 1200 },
            { id: 'fs-decor', label: 'Decorations & centerpieces', price: 900 },
        ],
        'Audio and Visual': [
            { id: 'av-sound', label: 'Sound system', price: 3000 },
            { id: 'av-wiredmic', label: 'Wired microphones', price: 400 },
            { id: 'av-wirelessmic', label: 'Wireless microphones', price: 600 },
            { id: 'av-speakers', label: 'Speakers & monitors', price: 1200 },
            { id: 'av-mixer', label: 'Mixer / audio console', price: 800 },
            { id: 'av-projector', label: 'Projector', price: 1500 },
            { id: 'av-screen', label: 'Projector screen / LED screen', price: 1800 },
            { id: 'av-stagelights', label: 'Stage lights & spotlights', price: 2000 },
            { id: 'av-uplighting', label: 'LED uplighting', price: 1000 },
        ],
        'Food and Catering': [
            { id: 'fc-catering', label: 'Catering service (full-service staff)', price: 5000 },
            { id: 'fc-buffet', label: 'Buffet tables', price: 800 },
            { id: 'fc-warmers', label: 'Food warmers / chafing dishes', price: 600 },
            { id: 'fc-plates', label: 'Plates, utensils & glasses', price: 500 },
            { id: 'fc-napkins', label: 'Napkins (cloth & paper)', price: 200 },
            { id: 'fc-drinks', label: 'Drink dispensers & water stations', price: 400 },
            { id: 'fc-dessert', label: 'Dessert / cake display table', price: 700 },
        ],
        'Decorations and Theme': [
            { id: 'dt-balloon', label: 'Balloon arches & columns', price: 1500 },
            { id: 'dt-flowers', label: 'Fresh flower arrangements', price: 2000 },
            { id: 'dt-photobooth', label: 'Photo booth setup', price: 3000 },
            { id: 'dt-props', label: 'Props & themed items', price: 800 },
            { id: 'dt-signage', label: 'Welcome signage / boards', price: 600 },
            { id: 'dt-fairylights', label: 'Fairy lights & string lights', price: 900 },
            { id: 'dt-colortheme', label: 'Custom color theme styling', price: 1200 },
        ],
        'Entertainment': [
            { id: 'ent-dj', label: 'Professional DJ', price: 5000 },
            { id: 'ent-band', label: 'Live band performance', price: 8000 },
            { id: 'ent-solo', label: 'Solo performers (singer, acoustic)', price: 3000 },
            { id: 'ent-games', label: 'Games & group activities', price: 1500 },
            { id: 'ent-emcee', label: 'Emcee / host services', price: 2500 },
            { id: 'ent-slideshow', label: 'Slideshow / video presentation', price: 1200 },
            { id: 'ent-magic', label: 'Magic shows & special acts', price: 3500 },
        ],
    };

    /* Normalise incoming service labels from packages.js
       (they can have slight formatting differences) */
    const KEY_MAP = {
        'furniture and set‑up': 'Furniture and Set‑up',
        'furniture and setup': 'Furniture and Set‑up',
        'audio and visual': 'Audio and Visual',
        'food and catering': 'Food and Catering',
        'decorations and theme': 'Decorations and Theme',
        'entertainment': 'Entertainment',
    };

    function normaliseKey(label) {
        return KEY_MAP[label.toLowerCase()] || label;
    }

    /* ──────────────────────────────────────────────
       Pricing helpers
    ────────────────────────────────────────────── */
    const BASE_GUEST = 50;
    const EXTRA_GUEST_RATE = 50; // ₱ per guest above 50

    function formatPHP(n) {
        return '₱' + n.toLocaleString('en-PH');
    }

    function computeTotal() {
        let base = 0;

        document.querySelectorAll('.subsvc-cbx:checked').forEach(cb => {
            base += parseFloat(cb.dataset.price) || 0;
        });

        const guests = parseInt(document.getElementById('bkGuestCount').value, 10) || 0;
        const extra = Math.max(0, guests - BASE_GUEST) * EXTRA_GUEST_RATE;

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
