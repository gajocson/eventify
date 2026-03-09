/* ================================================
   Eventify — packages.js
   Handles: package card interaction, service modal,
            checkbox validation, auth-gated booking
   ================================================ */

(function () {
    'use strict';

    /* ------------------------------------------
       Constants
    ------------------------------------------ */
    const MIN_SERVICES = 3;

    const SERVICES = [
        { id: 'svc-furniture', icon: '🪑', label: 'Furniture and Set‑up', sub: 'Chairs, tables, and event furniture' },
        { id: 'svc-av', icon: '🎙️', label: 'Audio and Visual', sub: 'Sound system, screens, and lighting' },
        { id: 'svc-catering', icon: '🍽️', label: 'Food and Catering', sub: 'Menus, serving staff, and equipment' },
        { id: 'svc-decorations', icon: '🎀', label: 'Decorations and Theme', sub: 'Flowers, balloons, and themed decor' },
        { id: 'svc-entertainment', icon: '🎵', label: 'Entertainment', sub: 'Music, performances, and activities' },
    ];

    /* ------------------------------------------
       State
    ------------------------------------------ */
    let currentPackage = '';
    let prevModal = null;   // track which modal to go back to

    /* ------------------------------------------
       Auth State  (set by Blade in <head>)
    ------------------------------------------ */
    const isAuthenticated = !!(window.EVENTIFY_IS_AUTH);

    /* ------------------------------------------
       DOM References - resolved after DOMContentLoaded
    ------------------------------------------ */
    let svcBackdrop, svcModal;
    let authBackdrop, authModal;
    let bookingBackdrop, bookingModal;

    /* ------------------------------------------
       Helper: open / close modals
    ------------------------------------------ */
    function openModal(backdrop) {
        backdrop.classList.add('is-open');
        document.body.style.overflow = 'hidden';
    }

    function closeModal(backdrop) {
        backdrop.classList.remove('is-open');
        document.body.style.overflow = '';
    }

    function closeAll() {
        [svcBackdrop, authBackdrop, bookingBackdrop].forEach(b => {
            if (b) b.classList.remove('is-open');
        });
        document.body.style.overflow = '';
    }

    /* ------------------------------------------
       Service Modal — populate & open
    ------------------------------------------ */
    function openServiceModal(pkgName) {
        currentPackage = pkgName;

        // Inject package name
        svcModal.querySelectorAll('[data-pkg-name]').forEach(el => {
            el.textContent = pkgName;
        });

        // Reset checkboxes
        svcModal.querySelectorAll('input[type="checkbox"]').forEach(cb => {
            cb.checked = false;
            cb.closest('.svc-item').classList.remove('is-checked');
        });

        updateCounter();
        openModal(svcBackdrop);
    }

    /* ------------------------------------------
       Checkbox validation
    ------------------------------------------ */
    function updateCounter() {
        const checked = svcModal.querySelectorAll('input[type="checkbox"]:checked').length;
        const counter = svcModal.querySelector('.svc-counter');
        const btn = svcModal.querySelector('.svc-booknow-btn');
        const remaining = MIN_SERVICES - checked;

        if (remaining > 0) {
            counter.textContent = `Select at least ${remaining} more service${remaining === 1 ? '' : 's'} to continue`;
            counter.classList.remove('is-ready');
            btn.disabled = true;
        } else {
            counter.textContent = `✓ ${checked} service${checked === 1 ? '' : 's'} selected — ready to book!`;
            counter.classList.add('is-ready');
            btn.disabled = false;
        }
    }

    /* ------------------------------------------
       Book Now handler
    ------------------------------------------ */
    function handleBookNow() {
        const selected = Array.from(
            svcModal.querySelectorAll('input[type="checkbox"]:checked')
        ).map(cb => cb.dataset.label);

        closeModal(svcBackdrop);

        if (!isAuthenticated) {
            // Guest → auth prompt
            openModal(authBackdrop);
        } else {
            // Logged-in → booking confirmation
            populateBookingModal(currentPackage, selected);
            openModal(bookingBackdrop);
        }
    }

    /* ------------------------------------------
       Booking Confirmation Modal — populate
    ------------------------------------------ */
    function populateBookingModal(pkgName, services) {
        bookingModal.querySelector('[data-bkg-pkg]').textContent = pkgName;

        const tagsContainer = bookingModal.querySelector('.booking-tags');
        tagsContainer.innerHTML = services
            .map(s => `<span class="booking-tag">${s}</span>`)
            .join('');
    }

    /* ------------------------------------------
       Build Service Modal HTML
    ------------------------------------------ */
    function buildServiceModal() {
        const svcHTML = SERVICES.map(s => `
            <label class="svc-item" for="${s.id}">
                <input type="checkbox" id="${s.id}" data-label="${s.label}">
                <span class="svc-item__icon">${s.icon}</span>
                <span class="svc-item__body">
                    <span class="svc-item__label">${s.label}</span>
                    <span class="svc-item__sublabel">${s.sub}</span>
                </span>
            </label>
        `).join('');

        return `
        <div class="evtf-modal-backdrop" id="pkgServiceModal" role="dialog" aria-modal="true" aria-labelledby="svcModalTitle">
            <div class="evtf-modal">
                <button class="evtf-modal__close" data-close-modal aria-label="Close">✕</button>
                <div class="svc-modal__badge">🗓️ Event Package</div>
                <h2 class="svc-modal__title" id="svcModalTitle"><span data-pkg-name></span></h2>
                <p class="svc-modal__subtitle">Select your services&nbsp;&mdash; choose at least ${MIN_SERVICES} to continue.</p>
                <div class="svc-list">${svcHTML}</div>
                <p class="svc-counter"></p>
                <button class="svc-booknow-btn" id="svcBookNowBtn" disabled>Book Now</button>
            </div>
        </div>`;
    }

    /* ------------------------------------------
       Build Auth Prompt Modal HTML
    ------------------------------------------ */
    function buildAuthModal() {
        return `
        <div class="evtf-modal-backdrop" id="pkgAuthPromptModal" role="dialog" aria-modal="true" aria-labelledby="authPromptTitle">
            <div class="evtf-modal">
                <button class="evtf-modal__close" data-close-modal aria-label="Close">✕</button>
                <div class="auth-prompt-modal__icon">🔐</div>
                <h2 class="auth-prompt-modal__title" id="authPromptTitle">Almost there!</h2>
                <p class="auth-prompt-modal__text">
                    To book your <strong data-pkg-name></strong> package, please
                    <strong>sign in</strong> or <strong>create a free account</strong> first.
                </p>
                <div class="auth-prompt-btns">
                    <a href="#" class="auth-prompt__signin" id="authPromptSignin">Sign In</a>
                    <a href="#" class="auth-prompt__signup" id="authPromptSignup">Sign Up</a>
                </div>
            </div>
        </div>`;
    }

    /* ------------------------------------------
       Build Booking Confirmation Modal HTML
    ------------------------------------------ */
    function buildBookingModal() {
        return `
        <div class="evtf-modal-backdrop" id="pkgBookingModal" role="dialog" aria-modal="true" aria-labelledby="bookingModalTitle">
            <div class="evtf-modal">
                <button class="evtf-modal__close" data-close-modal aria-label="Close">✕</button>
                <div class="booking-modal__check">✓</div>
                <h2 class="booking-modal__title" id="bookingModalTitle">Confirm Your Booking</h2>
                <p class="booking-modal__subtitle">Review your selections and confirm to proceed.</p>
                <div class="booking-modal__summary">
                    <div class="booking-summary__row">
                        <span class="booking-summary__icon">📦</span>
                        <div>
                            <div class="booking-summary__key">Package</div>
                            <div class="booking-summary__val" data-bkg-pkg></div>
                        </div>
                    </div>
                    <div class="booking-summary__row">
                        <span class="booking-summary__icon">✅</span>
                        <div>
                            <div class="booking-summary__key">Selected Services</div>
                            <div class="booking-tags"></div>
                        </div>
                    </div>
                </div>
                <button class="booking-confirm-btn" id="bookingConfirmBtn">Confirm Booking</button>
                <button class="booking-back-btn" id="bookingBackBtn">← Change Services</button>
            </div>
        </div>`;
    }

    /* ------------------------------------------
       Wire Burger dropdown Sign-In / Sign-Up
       (open dropdown, activate correct tab)
    ------------------------------------------ */
    function openBurgerAuth(tab /* 'signin' | 'signup' */) {
        // Try clicking the burger to open dropdown
        const burger = document.querySelector('.burger');
        if (burger && !burger.classList.contains('active')) {
            burger.click();
        }

        // Activate the correct auth tab
        setTimeout(() => {
            const tabBtn = document.querySelector(
                tab === 'signup'
                    ? '.auth-tab[data-tab="signup"], .auth-tab:last-child'
                    : '.auth-tab[data-tab="signin"], .auth-tab:first-child'
            );
            if (tabBtn) tabBtn.click();
        }, 120);

        closeAll();
    }

    /* ------------------------------------------
       Init
    ------------------------------------------ */
    document.addEventListener('DOMContentLoaded', function () {

        // Inject modal HTML at end of body
        const host = document.createElement('div');
        host.id = 'evtf-modals';
        host.innerHTML = buildServiceModal() + buildAuthModal() + buildBookingModal();
        document.body.appendChild(host);

        // Cache references
        svcBackdrop = document.getElementById('pkgServiceModal');
        svcModal = svcBackdrop.querySelector('.evtf-modal');
        authBackdrop = document.getElementById('pkgAuthPromptModal');
        authModal = authBackdrop.querySelector('.evtf-modal');
        bookingBackdrop = document.getElementById('pkgBookingModal');
        bookingModal = bookingBackdrop.querySelector('.evtf-modal');

        /* -- Package card clicks -- */
        document.querySelectorAll('.pkg-card').forEach(card => {
            card.addEventListener('click', () => {
                const name = card.dataset.package;
                if (name) openServiceModal(name);
            });
            // Also keyboard accessible
            card.setAttribute('tabindex', '0');
            card.setAttribute('role', 'button');
            card.addEventListener('keydown', e => {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    card.click();
                }
            });
        });

        /* -- Checkbox interactions -- */
        svcModal.querySelectorAll('input[type="checkbox"]').forEach(cb => {
            cb.addEventListener('change', function () {
                const item = this.closest('.svc-item');
                item.classList.toggle('is-checked', this.checked);
                updateCounter();
            });
        });

        /* -- Svc item label click propagation fix (label wraps checkbox) -- */
        // Already handled natively via <label for="">

        /* -- Book Now -- */
        document.getElementById('svcBookNowBtn').addEventListener('click', handleBookNow);

        /* -- Auth prompt buttons → open burger dropdown -- */
        document.getElementById('authPromptSignin').addEventListener('click', e => {
            e.preventDefault();
            openBurgerAuth('signin');
        });
        document.getElementById('authPromptSignup').addEventListener('click', e => {
            e.preventDefault();
            openBurgerAuth('signup');
        });

        /* -- Booking → Back to services -- */
        document.getElementById('bookingBackBtn').addEventListener('click', () => {
            closeModal(bookingBackdrop);
            openModal(svcBackdrop);
        });

        /* -- Booking → Confirm: POST to /booking page -- */
        document.getElementById('bookingConfirmBtn').addEventListener('click', () => {
            // Collect the currently selected services from the service modal
            const selectedServices = Array.from(
                svcModal.querySelectorAll('input[type="checkbox"]:checked')
            ).map(cb => cb.dataset.label);

            // Build a hidden form and submit it to navigate to the booking page
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '/booking';
            form.style.display = 'none';

            // CSRF token
            const csrfMeta = document.querySelector('meta[name="csrf-token"]');
            const csrf = document.createElement('input');
            csrf.type = 'hidden';
            csrf.name = '_token';
            csrf.value = csrfMeta ? csrfMeta.content : '';
            form.appendChild(csrf);

            // Package name
            const pkgInput = document.createElement('input');
            pkgInput.type = 'hidden';
            pkgInput.name = 'package';
            pkgInput.value = currentPackage;
            form.appendChild(pkgInput);

            // Each selected service as services[]
            selectedServices.forEach(svc => {
                const svcInput = document.createElement('input');
                svcInput.type = 'hidden';
                svcInput.name = 'services[]';
                svcInput.value = svc;
                form.appendChild(svcInput);
            });

            document.body.appendChild(form);
            form.submit();
        });

        /* -- Close buttons (✕) -- */
        document.querySelectorAll('[data-close-modal]').forEach(btn => {
            btn.addEventListener('click', () => closeAll());
        });

        /* -- Backdrop click to close -- */
        [svcBackdrop, authBackdrop, bookingBackdrop].forEach(backdrop => {
            backdrop.addEventListener('click', function (e) {
                if (e.target === this) closeAll();
            });
        });

        /* -- ESC key -- */
        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') closeAll();
        });

    }); // DOMContentLoaded

})();
