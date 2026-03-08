document.addEventListener("DOMContentLoaded", function () {
    const burger = document.getElementById("burger");
    const menu = document.getElementById("menu");

    // ──────────────────────────────────────────────
    // Burger toggle
    // ──────────────────────────────────────────────
    burger.addEventListener("click", function (e) {
        e.stopPropagation();
        burger.classList.toggle("active");
        menu.classList.toggle("active");
    });

    // Close when clicking outside
    document.addEventListener("click", function (e) {
        if (!menu.contains(e.target) && !burger.contains(e.target)) {
            burger.classList.remove("active");
            menu.classList.remove("active");
        }
    });

    // ──────────────────────────────────────────────
    // Eye toggle (show/hide password)
    // Works for dynamically placed .eye icons
    // ──────────────────────────────────────────────
    document.addEventListener("click", function (e) {
        if (e.target.classList.contains("eye")) {
            const target = document.getElementById(e.target.dataset.target);
            if (!target) return;
            if (target.type === "password") {
                target.type = "text";
                e.target.textContent = "visibility";
            } else {
                target.type = "password";
                e.target.textContent = "visibility_off";
            }
        }
    });
});

// ──────────────────────────────────────────────
// Switch between Sign In and Sign Up forms
// ──────────────────────────────────────────────
function showAuthForm(type) {
    const signinTab = document.getElementById("tab-signin");
    const signupTab = document.getElementById("tab-signup");
    const signinForm = document.getElementById("form-signin");
    const signupForm = document.getElementById("form-signup");

    if (type === "signin") {
        signinTab.classList.add("active");
        signupTab.classList.remove("active");
        signinForm.classList.add("active");
        signupForm.classList.remove("active");
    } else {
        signupTab.classList.add("active");
        signinTab.classList.remove("active");
        signupForm.classList.add("active");
        signinForm.classList.remove("active");
    }
}

// ──────────────────────────────────────────────
// Sign In validation
// ──────────────────────────────────────────────
function validateSignIn() {
    const email = document.getElementById("signin-email");
    const password = document.getElementById("signin-password");

    clearErrors();

    let valid = true;

    if (!email.value.trim()) {
        showError(email, "Email is required.");
        valid = false;
    } else if (!isValidEmail(email.value)) {
        showError(email, "Enter a valid email address.");
        valid = false;
    }

    if (!password.value) {
        showError(password, "Password is required.");
        valid = false;
    }

    return valid;
}

// ──────────────────────────────────────────────
// Sign Up validation
// ──────────────────────────────────────────────
function validateSignUp() {
    clearErrors();

    const form = document.getElementById("signupForm");
    const first = form.querySelector("input[name='firstname']");
    const last = form.querySelector("input[name='lastname']");
    const email = document.getElementById("signup-email");
    const pass = document.getElementById("signup-password");
    const confirm = document.getElementById("signup-confirm");
    const terms = document.getElementById("dp-terms");

    let valid = true;

    if (!first.value.trim()) {
        showError(first, "First name is required.");
        valid = false;
    }
    if (!last.value.trim()) {
        showError(last, "Last name is required.");
        valid = false;
    }
    if (!email.value.trim()) {
        showError(email, "Email is required.");
        valid = false;
    } else if (!isValidEmail(email.value)) {
        showError(email, "Enter a valid email address.");
        valid = false;
    }
    if (!pass.value) {
        showError(pass, "Password is required.");
        valid = false;
    } else if (pass.value.length < 8) {
        showError(pass, "Password must be at least 8 characters.");
        valid = false;
    }
    if (confirm.value !== pass.value) {
        showError(confirm, "Passwords do not match.");
        valid = false;
    }
    if (!terms.checked) {
        showError(terms, "You must accept the terms.");
        valid = false;
    }

    return valid;
}

// ──────────────────────────────────────────────
// Helpers
// ──────────────────────────────────────────────
function isValidEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}

function showError(input, message) {
    // Avoid duplicate error messages
    let err = input.parentElement.querySelector(".field-error");
    if (!err) {
        err = document.createElement("span");
        err.className = "field-error";
        input.parentElement.appendChild(err);
    }
    err.textContent = message;
    input.style.borderColor = "#e05a6b";
}

function clearErrors() {
    document.querySelectorAll(".field-error").forEach(el => el.remove());
    document.querySelectorAll(".auth-form-wrapper input").forEach(el => {
        el.style.borderColor = "";
    });
}