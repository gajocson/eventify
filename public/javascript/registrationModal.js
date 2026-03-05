document.addEventListener("DOMContentLoaded", function () {

    const signupModalEl = document.getElementById('signupModal');
    if (!signupModalEl) return;

    // ── Initialise all behaviours once ─────────────────────────────────────
    attachPasswordToggle(signupModalEl);
    attachFormToggle(signupModalEl);
    bindAjaxForms(signupModalEl);
    autoHideMessages(signupModalEl);

    // ── Switch: Sign In link inside registration modal → open login modal ──
    const switchToLogin = document.getElementById('switchToLogin');
    if (switchToLogin) {
        switchToLogin.addEventListener('click', function (e) {
            e.preventDefault();
            const signupModal = bootstrap.Modal.getInstance(signupModalEl);
            if (signupModal) signupModal.hide();

            const loginModalEl = document.getElementById('loginModal');
            if (loginModalEl) {
                const loginModal = new bootstrap.Modal(loginModalEl);
                loginModal.show();
            }
        });
    }
});

// ── Password visibility toggle ─────────────────────────────────────────────
function attachPasswordToggle(modalEl) {
    modalEl.querySelectorAll('.ev-field .ev-eye').forEach(icon => {
        icon.addEventListener('click', function () {
            const input = this.parentElement.querySelector('input');
            if (input.type === 'password') {
                input.type = 'text';
                this.textContent = 'visibility';
            } else {
                input.type = 'password';
                this.textContent = 'visibility_off';
            }
        });
    });
}

// ── Switch Customer / Business form ───────────────────────────────────────
function attachFormToggle(modalEl) {
    const customerRadio = modalEl.querySelector('#customer');
    const businessRadio = modalEl.querySelector('#organizer');
    const customerFields = modalEl.querySelector('#customerFields');
    const businessFields = modalEl.querySelector('#businessFields');

    function updateForm() {
        if (customerRadio.checked) {
            customerFields.style.display = 'block';
            businessFields.style.display = 'none';
        } else {
            customerFields.style.display = 'none';
            businessFields.style.display = 'block';
        }
    }

    customerRadio.addEventListener('change', updateForm);
    businessRadio.addEventListener('change', updateForm);
    updateForm();
}

// ── Auto-hide flash messages after 5 s ────────────────────────────────────
function autoHideMessages(modalEl) {
    modalEl.querySelectorAll('.alert').forEach(alert => {
        setTimeout(() => { alert.style.display = 'none'; }, 5000);
    });
}

// ── AJAX form submission ───────────────────────────────────────────────────
function bindAjaxForms(modalEl) {
    const customerForm = modalEl.querySelector('#customerFields');
    const businessForm = modalEl.querySelector('#businessFields');

    function submitForm(form, messagesContainerId) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            const messagesContainer = form.querySelector(`#${messagesContainerId}`);
            messagesContainer.innerHTML = '';

            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: new FormData(form)
            })
                .then(res => res.json())
                .then(data => {
                    if (data.errors) {
                        const ul = document.createElement('ul');
                        data.errors.forEach(err => {
                            const li = document.createElement('li');
                            li.textContent = err;
                            ul.appendChild(li);
                        });
                        const div = document.createElement('div');
                        div.classList.add('alert', 'alert-danger');
                        div.appendChild(ul);
                        messagesContainer.appendChild(div);
                        autoHideMessages(modalEl);
                    } else if (data.success) {
                        const div = document.createElement('div');
                        div.classList.add('alert', 'alert-success');
                        div.textContent = data.success;
                        messagesContainer.appendChild(div);
                        form.reset();
                        autoHideMessages(modalEl);
                    }
                })
                .catch(() => {
                    const div = document.createElement('div');
                    div.classList.add('alert', 'alert-danger');
                    div.textContent = 'Something went wrong. Please try again.';
                    messagesContainer.appendChild(div);
                });
        });
    }

    submitForm(customerForm, 'customerMessages');
    submitForm(businessForm, 'businessMessages');
}