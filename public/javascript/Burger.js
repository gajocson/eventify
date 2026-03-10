/**
 * Burger.js — Eventify
 * Handles: burger toggle, password visibility, auth form switching,
 *           AJAX Sign In (with role), AJAX Sign Up, AJAX Sign Out,
 *           role-aware dropdown panel swap, toast notifications.
 */

// ─── CSRF token helper ────────────────────────────────────────────────────────
function getCsrfToken() {
    const meta = document.querySelector('meta[name="csrf-token"]');
    return meta ? meta.getAttribute('content') : '';
}

// ─── DOM Ready ────────────────────────────────────────────────────────────────
document.addEventListener('DOMContentLoaded', function () {

    const burger = document.getElementById('burger');
    const menu = document.getElementById('menu');

    if (!burger || !menu) return;

    // Burger toggle
    burger.addEventListener('click', function (e) {
        e.stopPropagation();
        burger.classList.toggle('active');
        menu.classList.toggle('active');
    });

    // Close when clicking outside
    document.addEventListener('click', function (e) {
        if (!menu.contains(e.target) && !burger.contains(e.target)) {
            burger.classList.remove('active');
            menu.classList.remove('active');
        }
    });

    // Eye icon — show/hide password (delegated)
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('eye')) {
            const target = document.getElementById(e.target.dataset.target);
            if (!target) return;
            if (target.type === 'password') {
                target.type = 'text';
                e.target.textContent = 'visibility';
            } else {
                target.type = 'password';
                e.target.textContent = 'visibility_off';
            }
        }
    });

    // ── Auto-open Sign In after logout redirect ─────────────────────────────
    // When admin (or any user) logs out and gets redirected to /?signedout=1,
    // open the burger dropdown and show the Sign In tab automatically.
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('signedout') === '1') {
        // Small delay to let the DOM settle
        setTimeout(() => {
            swapToGuestPanel();         // ensure guest panel is showing
            showAuthForm('signin');     // show Sign In tab
            burger.classList.add('active');
            menu.classList.add('active');
            showToast('You have been signed out.', 'info');
        }, 150);

        // Clean the URL so refreshing doesn't re-trigger this
        const cleanUrl = window.location.pathname;
        window.history.replaceState({}, document.title, cleanUrl);
    }
});


// ─── Switch between Sign In / Sign Up tabs ───────────────────────────────────
function showAuthForm(type) {
    const signinTab = document.getElementById('tab-signin');
    const signupTab = document.getElementById('tab-signup');
    const signinForm = document.getElementById('form-signin');
    const signupForm = document.getElementById('form-signup');
    if (!signinTab) return;

    if (type === 'signin') {
        signinTab.classList.add('active');
        signupTab.classList.remove('active');
        signinForm.classList.add('active');
        signupForm.classList.remove('active');
    } else {
        signupTab.classList.add('active');
        signinTab.classList.remove('active');
        signupForm.classList.add('active');
        signinForm.classList.remove('active');
    }
    clearErrors();
}

// ─── AJAX Sign In ─────────────────────────────────────────────────────────────
async function handleSignIn(e) {
    e.preventDefault();
    clearErrors();

    const email = document.getElementById('signin-email');
    const password = document.getElementById('signin-password');
    const btn = document.getElementById('signin-submit-btn');

    // Client-side pre-check
    let ok = true;
    if (!email || !email.value.trim()) { showError(email, 'Email is required.'); ok = false; }
    else if (!isValidEmail(email.value)) { showError(email, 'Enter a valid email.'); ok = false; }
    if (!password || !password.value) { showError(password, 'Password is required.'); ok = false; }
    if (!ok) return;

    btn.disabled = true;
    btn.textContent = 'Signing in…';

    try {
        const data = new FormData();
        data.append('_token', getCsrfToken());
        data.append('email', email.value.trim());
        data.append('password', password.value);

        const res = await fetch('/auth/login', { method: 'POST', body: data, headers: { 'X-Requested-With': 'XMLHttpRequest' } });
        const json = await res.json();

        if (json.success) {
            showToast(json.message, 'success');

            const role = json.role || 'customer';

            // If admin, redirect immediately to the dashboard
            if (role === 'admin' && json.redirectUrl) {
                window.location.href = json.redirectUrl;
                return;
            }

            // Customer: swap dropdown to auth panel
            swapToAuthPanel(json.user, role);
            document.getElementById('burger').classList.remove('active');
            document.getElementById('menu').classList.remove('active');
            document.getElementById('signinForm').reset();
        } else {
            if (json.errors) {
                if (json.errors.email) showError(email, json.errors.email[0]);
                if (json.errors.password) showError(password, json.errors.password[0]);
            }
        }
    } catch (err) {
        showToast('Something went wrong. Please try again.', 'error');
    } finally {
        btn.disabled = false;
        btn.textContent = 'Sign In';
    }
}

// ─── AJAX Sign Up ─────────────────────────────────────────────────────────────
async function handleSignUp(e) {
    e.preventDefault();
    clearErrors();

    const first = document.getElementById('signup-firstname');
    const last = document.getElementById('signup-lastname');
    const email = document.getElementById('signup-email');
    const pass = document.getElementById('signup-password');
    const confirm = document.getElementById('signup-confirm');
    const terms = document.getElementById('dp-terms');
    const btn = document.getElementById('signup-submit-btn');

    let ok = true;
    if (!first || !first.value.trim()) { showError(first, 'First name is required.'); ok = false; }
    if (!last || !last.value.trim()) { showError(last, 'Last name is required.'); ok = false; }
    if (!email || !email.value.trim()) { showError(email, 'Email is required.'); ok = false; }
    else if (!isValidEmail(email.value)) { showError(email, 'Enter a valid email.'); ok = false; }
    if (!pass || pass.value.length < 6) { showError(pass, 'Password must be at least 6 characters.'); ok = false; }
    if (!confirm || confirm.value !== (pass ? pass.value : '')) { showError(confirm, 'Passwords do not match.'); ok = false; }
    if (!terms || !terms.checked) { showError(terms, 'You must accept the terms.'); ok = false; }
    if (!ok) return;

    btn.disabled = true;
    btn.textContent = 'Creating account…';

    try {
        const data = new FormData();
        data.append('_token', getCsrfToken());
        data.append('first_name', first.value.trim());
        data.append('last_name', last.value.trim());
        data.append('email', email.value.trim());
        data.append('password', pass.value);
        data.append('password_confirmation', confirm.value);
        data.append('terms', '1');

        const res = await fetch('/register/customer', { method: 'POST', body: data, headers: { 'X-Requested-With': 'XMLHttpRequest' } });
        const json = await res.json();

        if (json.success) {
            showToast(json.message || 'Account created! Please sign in.', 'success');
            document.getElementById('signupForm').reset();
            showAuthForm('signin');
        } else if (json.errors) {
            // Structured errors object from updated CustomerController
            Object.entries(json.errors).forEach(([field, msgs]) => {
                const msg = Array.isArray(msgs) ? msgs[0] : msgs;
                if (field === 'email') showError(email, msg);
                else if (field === 'first_name') showError(first, msg);
                else if (field === 'last_name') showError(last, msg);
                else if (field === 'password') showError(pass, msg);
                else showToast(msg, 'error');
            });
        }
    } catch (err) {
        showToast('Something went wrong. Please try again.', 'error');
    } finally {
        btn.disabled = false;
        btn.textContent = 'Create Account';
    }
}

// ─── AJAX Sign Out ────────────────────────────────────────────────────────────
async function signOut() {
    try {
        const res = await fetch('/auth/logout', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': getCsrfToken(),
                'X-Requested-With': 'XMLHttpRequest',
                'Content-Type': 'application/json',
            },
        });
        const json = await res.json();

        if (json.success) {
            showToast('You have been signed out.', 'info');
            swapToGuestPanel();
            document.getElementById('burger').classList.remove('active');
            document.getElementById('menu').classList.remove('active');
        }
    } catch (err) {
        // Fallback: full-page redirect with signedout flag so Sign In panel opens
        window.location.href = '/?signedout=1';
    }
}

// ─── Dropdown panel swap ──────────────────────────────────────────────────────
/**
 * swapToAuthPanel — called after successful AJAX login.
 * Builds role-appropriate action links in #auth-actions-container.
 */
function swapToAuthPanel(user, role) {
    const guestPanel = document.getElementById('dropdown-guest');
    const authPanel = document.getElementById('dropdown-auth');
    const actionsContainer = document.getElementById('auth-actions-container');
    if (!guestPanel || !authPanel) return;

    // Populate greeting and email
    const greeting = document.getElementById('auth-greeting');
    const emailEl = document.getElementById('auth-email');
    const iconEl = document.getElementById('auth-icon');

    const firstName = user.name ? user.name.split(' ')[0] : 'there';

    if (role === 'admin') {
        if (greeting) greeting.textContent = 'Hello, Admin ' + firstName + '!';
        if (iconEl) iconEl.textContent = 'admin_panel_settings';
    } else {
        if (greeting) greeting.textContent = 'Hello, ' + firstName + '!';
        if (iconEl) iconEl.textContent = 'account_circle';
    }

    if (emailEl) emailEl.textContent = user.email || '';

    // Build action buttons based on role
    if (actionsContainer) {
        if (role === 'admin') {
            actionsContainer.innerHTML = `
                <a href="/admin/dashboard" class="auth-action-btn profile-btn">
                    <span class="material-symbols-outlined">dashboard</span>
                    Dashboard
                </a>
                <button class="auth-action-btn signout-btn" onclick="signOut()">
                    <span class="material-symbols-outlined">logout</span>
                    Sign Out
                </button>`;
        } else {
            actionsContainer.innerHTML = `
                <a href="/profile" class="auth-action-btn profile-btn">
                    <span class="material-symbols-outlined">person</span>
                    My Profile
                </a>
                <button class="auth-action-btn signout-btn" onclick="signOut()">
                    <span class="material-symbols-outlined">logout</span>
                    Sign Out
                </button>`;
        }
    }

    guestPanel.style.display = 'none';
    authPanel.style.display = '';
    authPanel.classList.add('panel-enter');
    setTimeout(() => authPanel.classList.remove('panel-enter'), 400);
}

function swapToGuestPanel() {
    const guestPanel = document.getElementById('dropdown-guest');
    const authPanel = document.getElementById('dropdown-auth');
    if (!guestPanel || !authPanel) return;

    authPanel.style.display = 'none';
    guestPanel.style.display = '';
    guestPanel.classList.add('panel-enter');
    setTimeout(() => guestPanel.classList.remove('panel-enter'), 400);
    showAuthForm('signin');
}

// ─── Toast helper ─────────────────────────────────────────────────────────────
function showToast(message, type = 'info') {
    const container = document.getElementById('toast-container');
    if (!container) return;

    const icons = { success: 'check_circle', error: 'error', info: 'info' };
    const toast = document.createElement('div');
    toast.className = `page-toast toast-${type} toast-enter`;
    toast.setAttribute('role', 'alert');
    toast.innerHTML = `
        <span class="material-symbols-outlined toast-icon">${icons[type] || 'info'}</span>
        <span class="toast-message">${message}</span>
        <button class="toast-close" onclick="this.parentElement.remove()" aria-label="Close">
            <span class="material-symbols-outlined">close</span>
        </button>`;

    container.appendChild(toast);
    requestAnimationFrame(() => toast.classList.remove('toast-enter'));

    setTimeout(() => {
        toast.classList.add('toast-leave');
        setTimeout(() => toast.remove(), 400);
    }, 4000);
}

// ─── Validation helpers ───────────────────────────────────────────────────────
function isValidEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}

function showError(input, message) {
    if (!input) return;
    let err = input.closest('.field-group, .checkbox-wrap, .auth-form-wrapper')
        ?.querySelector('.field-error');
    if (!err) {
        err = document.createElement('span');
        err.className = 'field-error';
        (input.parentElement || input).appendChild(err);
    }
    err.textContent = message;
    input.style.borderColor = '#e05a6b';
}

function clearErrors() {
    document.querySelectorAll('.field-error').forEach(el => el.remove());
    document.querySelectorAll('.auth-form-wrapper input').forEach(el => {
        el.style.borderColor = '';
    });
}