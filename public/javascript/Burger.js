/**
 * Burger.js — Eventify
 * Handles: burger toggle, password visibility, auth form switching,
 *           AJAX Sign In, AJAX Sign Up, AJAX Sign Out, toast notifications.
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
        const form = document.getElementById('signinForm');
        const data = new FormData();
        data.append('_token', getCsrfToken());
        data.append('email', email.value.trim());
        data.append('password', password.value);

        const res = await fetch('/auth/login', { method: 'POST', body: data, headers: { 'X-Requested-With': 'XMLHttpRequest' } });
        const json = await res.json();

        if (json.success) {
            showToast(json.message, 'success');
            swapToAuthPanel(json.user);
            // Close burger dropdown
            document.getElementById('burger').classList.remove('active');
            document.getElementById('menu').classList.remove('active');
            form.reset();
        } else {
            // Show server-side field errors
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
            showToast('Account created! Please sign in.', 'success');
            document.getElementById('signupForm').reset();
            showAuthForm('signin');
        } else if (json.errors) {
            // json.errors is an array of strings from CustomerController
            json.errors.forEach(msg => {
                // Try to map common messages to fields
                if (msg.toLowerCase().includes('email')) showError(email, msg);
                else if (msg.toLowerCase().includes('name')) showError(first, msg);
                else if (msg.toLowerCase().includes('password')) showError(pass, msg);
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
        // Fallback: full-page logout
        window.location.href = '/auth/logout';
    }
}

// ─── Dropdown panel swap ──────────────────────────────────────────────────────
function swapToAuthPanel(user) {
    const guestPanel = document.getElementById('dropdown-guest');
    const authPanel = document.getElementById('dropdown-auth');
    if (!guestPanel || !authPanel) return;

    // Populate dynamic fields
    const greeting = document.getElementById('auth-greeting');
    const emailEl = document.getElementById('auth-email');
    if (greeting) greeting.textContent = 'Hello, ' + (user.name ? user.name.split(' ')[0] : 'there') + '!';
    if (emailEl) emailEl.textContent = user.email || '';

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
    // Trigger enter animation
    requestAnimationFrame(() => toast.classList.remove('toast-enter'));

    // Auto-dismiss after 4 s
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