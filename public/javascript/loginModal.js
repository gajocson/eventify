/**
 * loginModal.js
 * Handles fetching, displaying, and submitting the sign-in modal via AJAX.
 */

document.addEventListener("DOMContentLoaded", function () {

    // 1. Listen for clicks on anything with data-open-signin
    document.addEventListener("click", function (e) {
        // Find closest element with the attribute in case they click inside it (like an icon)
        const trigger = e.target.closest("[data-open-signin]");
        if (!trigger) return;

        e.preventDefault();

        // Check if modal already exists in DOM
        let modalEl = document.getElementById("signinModal");
        if (modalEl) {
            // Just show it
            let bsModal = new bootstrap.Modal(modalEl);
            bsModal.show();
        } else {
            // Fetch it from server
            fetch("/signin-modal")
                .then(response => response.text())
                .then(html => {
                    // Inject into body
                    document.body.insertAdjacentHTML("beforeend", html);

                    modalEl = document.getElementById("signinModal");
                    let bsModal = new bootstrap.Modal(modalEl);
                    bsModal.show();

                    // Initialize the newly injected modal's logic (toggles, form submit)
                    initModalLogic(modalEl);

                    // Clean up DOM when closed
                    modalEl.addEventListener("hidden.bs.modal", function () {
                        modalEl.remove();
                    });
                })
                .catch(error => console.error("Error loading sign-in modal:", error));
        }
    });

});

/**
 * Initializes all the interactive bits inside the modal once it's in the DOM
 */
function initModalLogic(modalEl) {
    const customerBtn = modalEl.querySelector('#signinCustomerBtn');
    const businessBtn = modalEl.querySelector('#signinBusinessBtn');
    const userTypeInput = modalEl.querySelector('#signinUserType');
    const form = modalEl.querySelector('#signinForm');

    const eyeIcon = modalEl.querySelector('#signinEye');
    const passInput = modalEl.querySelector('#signinPass');

    const messagesBox = modalEl.querySelector('#signinMessages');

    // -- 1. Customer / Business Toggle --
    function switchType(type) {
        if (type === 'customer') {
            customerBtn.classList.add('active');
            businessBtn.classList.remove('active');
            userTypeInput.value = 'customer';
            // update form action if routes are available globally
            if (window.signinRoutes) {
                form.action = window.signinRoutes.customer;
            }
        } else {
            businessBtn.classList.add('active');
            customerBtn.classList.remove('active');
            userTypeInput.value = 'business';
            if (window.signinRoutes) {
                form.action = window.signinRoutes.business;
            }
        }
    }

    if (customerBtn && businessBtn) {
        customerBtn.addEventListener('click', () => switchType('customer'));
        businessBtn.addEventListener('click', () => switchType('business'));
    }

    // -- 2. Password visibility toggle --
    if (eyeIcon && passInput) {
        eyeIcon.addEventListener('click', function () {
            if (passInput.type === 'password') {
                passInput.type = 'text';
                eyeIcon.textContent = 'visibility';
            } else {
                passInput.type = 'password';
                eyeIcon.textContent = 'visibility_off';
            }
        });
    }

    // -- 3. Handle AJAX form submission --
    if (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            // clear previous messages
            messagesBox.innerHTML = '';

            const submitBtn = form.querySelector('.signin-submit-btn');
            const originalBtnText = submitBtn.textContent;
            submitBtn.disabled = true;
            submitBtn.textContent = 'Signing in...';

            const formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    submitBtn.disabled = false;
                    submitBtn.textContent = originalBtnText;

                    if (data.errors) {
                        // Show validation errors
                        let errorHtml = '<div class="alert alert-danger" style="padding:10px; border-radius:10px; font-size:14px; margin-bottom:15px;">';
                        if (Array.isArray(data.errors)) {
                            errorHtml += data.errors.join('<br>');
                        } else {
                            // handle object of arrays if standard laravel validation response
                            for (let field in data.errors) {
                                errorHtml += data.errors[field].join('<br>') + '<br>';
                            }
                        }
                        errorHtml += '</div>';
                        messagesBox.innerHTML = errorHtml;
                    }
                    else if (data.success) {
                        // Show success success (optional: redirect)
                        messagesBox.innerHTML = `<div class="alert alert-success" style="padding:10px; border-radius:10px; font-size:14px; margin-bottom:15px;">${data.success}</div>`;
                        if (data.redirect) {
                            window.location.href = data.redirect;
                        }
                    }
                    else if (data.redirect) {
                        // redirect directly without message
                        window.location.href = data.redirect;
                    }
                })
                .catch(error => {
                    console.error('Error submitting login:', error);
                    submitBtn.disabled = false;
                    submitBtn.textContent = originalBtnText;
                    messagesBox.innerHTML = `<div class="alert alert-danger" style="padding:10px; border-radius:10px; font-size:14px; margin-bottom:15px;">An error occurred. Please try again.</div>`;
                });
        });
    }
}
