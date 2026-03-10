/**
 * Services Page — Ala Carte Modal & Booking JS
 * Opens/closes service selection modals, handles checkbox
 * selections with a minimum-of-5 rule, shows confirmation
 * modal, then POSTs to /booking for the bookings flow.
 */

document.addEventListener('DOMContentLoaded', function () {

    const MIN_REQUIRED = 5;

    /* ══════════════════════════════════════════════════════
       MODAL OPEN / CLOSE
    ══════════════════════════════════════════════════════ */

    // Open modal when a service card is clicked
    document.querySelectorAll('.service-card').forEach(card => {
        card.addEventListener('click', function () {
            const target = this.dataset.modal;
            const overlay = document.getElementById(target);
            if (!overlay) return;

            overlay.classList.add('open');
            document.body.style.overflow = 'hidden';
        });

        // Keyboard accessibility
        card.addEventListener('keydown', function (e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                this.click();
            }
        });
    });

    // Close modal via ✕ button
    document.querySelectorAll('.svc-modal-close').forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.stopPropagation();
            const overlay = this.closest('.svc-modal-overlay');
            closeModal(overlay);
        });
    });

    // Close modal by clicking the backdrop
    document.querySelectorAll('.svc-modal-overlay').forEach(overlay => {
        overlay.addEventListener('click', function (e) {
            if (e.target === overlay) closeModal(overlay);
        });
    });

    // Close on Escape
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            const openOverlay = document.querySelector('.svc-modal-overlay.open');
            if (openOverlay) { closeModal(openOverlay); return; }
            closeConfirmModal();
        }
    });

    function closeModal(overlay) {
        if (!overlay) return;

        const modal = overlay.querySelector('.svc-modal');
        if (modal) {
            modal.style.transform = 'translateY(20px) scale(0.96)';
            modal.style.opacity = '0';
        }
        overlay.style.opacity = '0';

        setTimeout(() => {
            overlay.classList.remove('open');
            overlay.style.opacity = '';
            if (modal) {
                modal.style.transform = '';
                modal.style.opacity = '';
            }
            document.body.style.overflow = '';
        }, 320);
    }

    /* ══════════════════════════════════════════════════════
       CHECKBOX — COUNTER — SUBTOTAL — BOOK NOW
    ══════════════════════════════════════════════════════ */

    document.querySelectorAll('.svc-modal-overlay').forEach(overlay => {
        const cbxList = overlay.querySelectorAll('.ac-cbx');
        const bookBtn = overlay.querySelector('.ac-book-btn');
        const counterEl = overlay.querySelector('.ac-counter');
        const fillEl = counterEl ? counterEl.querySelector('.ac-counter-fill') : null;
        const textEl = counterEl ? counterEl.querySelector('.ac-counter-text') : null;
        const subtotalEl = overlay.querySelector('.ac-subtotal-val');

        if (!cbxList.length || !bookBtn) return;

        cbxList.forEach(cbx => {
            cbx.addEventListener('change', function () {
                const item = this.closest('.ac-cbx-item');
                if (item) item.classList.toggle('is-checked', this.checked);
                updateCounter();
            });
        });

        function updateCounter() {
            const checked = overlay.querySelectorAll('.ac-cbx:checked').length;
            const total = cbxList.length;
            const pct = Math.min((checked / MIN_REQUIRED) * 100, 100);
            const enough = checked >= MIN_REQUIRED;

            // Progress bar
            if (fillEl) {
                fillEl.style.width = pct + '%';
                fillEl.classList.toggle('is-complete', enough);
            }

            // Text
            if (textEl) {
                if (enough) {
                    textEl.textContent = `✓ ${checked} items selected — ready to book!`;
                    textEl.classList.add('is-complete');
                } else {
                    textEl.textContent = `${checked} of ${MIN_REQUIRED} required selected`;
                    textEl.classList.remove('is-complete');
                }
            }

            // Subtotal
            if (subtotalEl) {
                let sub = 0;
                overlay.querySelectorAll('.ac-cbx:checked').forEach(cb => {
                    sub += parseFloat(cb.dataset.price) || 0;
                });
                subtotalEl.textContent = '₱' + sub.toLocaleString('en-PH');
            }

            // Button
            bookBtn.disabled = !enough;
        }
    });

    /* ══════════════════════════════════════════════════════
       BOOK NOW BUTTON → CONFIRMATION MODAL
    ══════════════════════════════════════════════════════ */

    const confirmOverlay = document.getElementById('acConfirmOverlay');
    const confirmCancel = document.getElementById('acConfirmCancel');
    const confirmProceed = document.getElementById('acConfirmProceed');
    const confirmService = document.getElementById('acConfirmService');
    const confirmItems = document.getElementById('acConfirmItems');
    const confirmTotal = document.getElementById('acConfirmTotal');
    const acBookingForm = document.getElementById('acBookingForm');
    const acFormPackage = document.getElementById('acFormPackage');
    const acFormService = document.getElementById('acFormService');

    // Track which overlay opened the confirm modal
    let activeOverlay = null;

    document.querySelectorAll('.ac-book-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            // Auth guard — redirect to homepage login if not signed in
            if (!window.EVENTIFY_IS_AUTH) {
                if (typeof window.showToast === 'function') {
                    window.showToast('error', '🔒 Please sign in to book services.', 4000);
                }
                // Briefly delay so the toast is visible before potentially triggering login
                setTimeout(() => {
                    // Trigger the burger menu / login flow if available
                    const burgerBtn = document.querySelector('.burger-btn, #burgerToggle, .hamburger-btn');
                    if (burgerBtn) burgerBtn.click();
                }, 500);
                return;
            }

            const serviceName = this.dataset.service;
            const overlay = this.closest('.svc-modal-overlay');
            activeOverlay = overlay;

            // Collect selected items
            const selectedItems = [];
            let subTotal = 0;
            overlay.querySelectorAll('.ac-cbx:checked').forEach(cb => {
                const price = parseFloat(cb.dataset.price) || 0;
                selectedItems.push({ label: cb.dataset.label, price });
                subTotal += price;
            });

            // Populate confirm modal
            if (confirmService) confirmService.textContent = serviceName;
            if (confirmItems) {
                confirmItems.innerHTML = selectedItems.map(i =>
                    `<div class="ac-confirm-item-row">
                        <span>${escHtml(i.label)}</span>
                        <span>₱${i.price.toLocaleString('en-PH')}</span>
                    </div>`
                ).join('');
            }
            if (confirmTotal) confirmTotal.textContent = '₱' + subTotal.toLocaleString('en-PH');

            // Show confirm overlay
            closeModal(overlay); // close selection modal first
            setTimeout(() => {
                if (confirmOverlay) {
                    confirmOverlay.classList.add('open');
                    document.body.style.overflow = 'hidden';
                }
            }, 350); // wait for close animation to finish
        });
    });

    // Cancel → go back to the selection modal
    if (confirmCancel) {
        confirmCancel.addEventListener('click', function () {
            closeConfirmModal();
            if (activeOverlay) {
                setTimeout(() => {
                    activeOverlay.classList.add('open');
                    document.body.style.overflow = 'hidden';
                }, 250);
            }
        });
    }

    // Confirm → set form fields and submit to /booking
    if (confirmProceed) {
        confirmProceed.addEventListener('click', function () {
            const serviceName = confirmService ? confirmService.textContent : '';

            // Map display name → booking service key (matches booking.blade.php $keyMap)
            const serviceKeyMap = {
                'Furniture and Setup': 'Furniture and Set-up',
                'Audio and Visual': 'Audio and Visual',
                'Food and Catering': 'Food and Catering',
                'Decorations and Theme': 'Decorations and Theme',
                'Entertainment': 'Entertainment',
            };

            const serviceKey = serviceKeyMap[serviceName] || serviceName;

            if (acFormPackage) acFormPackage.value = 'Ala Carte — ' + serviceName;
            if (acFormService) acFormService.value = serviceKey;

            confirmProceed.disabled = true;
            confirmProceed.innerHTML = '<span class="material-symbols-outlined">hourglass_empty</span> Proceeding…';

            if (acBookingForm) acBookingForm.submit();
        });
    }

    // Close confirmation overlay
    if (confirmOverlay) {
        confirmOverlay.addEventListener('click', function (e) {
            if (e.target === confirmOverlay) closeConfirmModal();
        });
    }

    function closeConfirmModal() {
        if (confirmOverlay) {
            confirmOverlay.classList.remove('open');
            document.body.style.overflow = '';
        }
    }

    /* ══════════════════════════════════════════════════════
       HELPERS
    ══════════════════════════════════════════════════════ */
    function escHtml(str) {
        return String(str)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;');
    }
});
