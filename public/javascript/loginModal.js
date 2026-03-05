document.addEventListener("DOMContentLoaded", function () {

    // Password visibility toggle
    document.querySelectorAll("#loginModal .ev-field .ev-eye").forEach(icon => {
        icon.addEventListener("click", function () {
            const input = this.parentElement.querySelector('input[type="password"], input[type="text"]');
            if (input.type === "password") {
                input.type = "text";
                this.textContent = "visibility";
            } else {
                input.type = "password";
                this.textContent = "visibility_off";
            }
        });
    });

    // Switch from login modal → registration modal
    const switchToRegister = document.getElementById("switchToRegister");
    if (switchToRegister) {
        switchToRegister.addEventListener("click", function (e) {
            e.preventDefault();

            const loginModalEl = document.getElementById("loginModal");
            const signupModalEl = document.getElementById("signupModal");

            if (loginModalEl && signupModalEl) {
                // Wait for login modal to fully hide before opening signup
                loginModalEl.addEventListener("hidden.bs.modal", function openSignup() {
                    loginModalEl.removeEventListener("hidden.bs.modal", openSignup);
                    new bootstrap.Modal(signupModalEl).show();
                }, { once: true });

                const loginModal = bootstrap.Modal.getInstance(loginModalEl);
                if (loginModal) loginModal.hide();
            }
        });
    }

    // AJAX form submission for login
    const loginForm = document.getElementById("loginForm");
    if (loginForm) {
        loginForm.addEventListener("submit", function (e) {
            e.preventDefault();

            const url = loginForm.action;
            const formData = new FormData(loginForm);

            // Clear old messages
            const existingAlerts = document.querySelectorAll("#loginModal .alert");
            existingAlerts.forEach(a => a.remove());

            fetch(url, {
                method: "POST",
                headers: {
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                },
                body: formData
            })
                .then(res => res.json())
                .then(data => {
                    const modalBody = document.querySelector("#loginModal .modal-body");

                    if (data.errors) {
                        const ul = document.createElement("ul");
                        data.errors.forEach(err => {
                            const li = document.createElement("li");
                            li.textContent = err;
                            ul.appendChild(li);
                        });
                        const div = document.createElement("div");
                        div.classList.add("alert", "alert-danger");
                        div.appendChild(ul);
                        modalBody.prepend(div);
                        setTimeout(() => div.remove(), 5000);
                    } else if (data.success) {
                        const div = document.createElement("div");
                        div.classList.add("alert", "alert-success");
                        div.textContent = data.success;
                        modalBody.prepend(div);
                        loginForm.reset();
                        setTimeout(() => div.remove(), 5000);

                        // Redirect if a redirect URL is provided
                        if (data.redirect) {
                            setTimeout(() => { window.location.href = data.redirect; }, 1000);
                        }
                    }
                })
                .catch(() => {
                    const modalBody = document.querySelector("#loginModal .modal-body");
                    const div = document.createElement("div");
                    div.classList.add("alert", "alert-danger");
                    div.textContent = "Something went wrong. Please try again.";
                    modalBody.prepend(div);
                    setTimeout(() => div.remove(), 5000);
                });
        });
    }

    // Auto-hide any server-rendered flash messages
    document.querySelectorAll("#loginModal .alert").forEach(alert => {
        setTimeout(() => alert.remove(), 5000);
    });
});
