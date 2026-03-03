document.addEventListener("DOMContentLoaded", function () {
    const signupBtn = document.querySelector(".dropdown a[href='#']");

    signupBtn.addEventListener("click", function (e) {
        e.preventDefault();

        fetch('/registration-modal')
            .then(res => res.text())
            .then(html => {
                document.body.insertAdjacentHTML('beforeend', html);
                const modalEl = document.getElementById('signupModal');

                const myModal = new bootstrap.Modal(modalEl);
                myModal.show();

                modalEl.addEventListener('hidden.bs.modal', () => modalEl.remove());

                attachPasswordToggle(modalEl);
                attachFormToggle();
                bindAjaxForms(modalEl);
                autoHideMessages(modalEl);
            })
            .catch(err => console.error(err));
    });
});

// Password visibility toggle
function attachPasswordToggle(modalEl) {
    modalEl.querySelectorAll(".pass-wrap .eye").forEach(icon => {
        icon.addEventListener("click", function () {
            const input = this.parentElement.querySelector('input');
            if (input.type === "password") {
                input.type = "text";
                this.textContent = "visibility";
            } else {
                input.type = "password";
                this.textContent = "visibility_off";
            }
        });
    });
}

// Switch Customer/Business form
function attachFormToggle() {
    const customerRadio = document.getElementById("customer");
    const businessRadio = document.getElementById("organizer");
    const customerFields = document.getElementById("customerFields");
    const businessFields = document.getElementById("businessFields");

    function updateForm() {
        if (customerRadio.checked) {
            customerFields.style.display = "block";
            businessFields.style.display = "none";
        } else {
            customerFields.style.display = "none";
            businessFields.style.display = "block";
        }
    }

    customerRadio.addEventListener("change", updateForm);
    businessRadio.addEventListener("change", updateForm);
    updateForm();
}

// Auto-hide messages after 5 seconds
function autoHideMessages(modalEl) {
    modalEl.querySelectorAll(".alert").forEach(alert => {
        setTimeout(() => {
            alert.style.display = 'none';
        }, 5000);
    });
}

// AJAX form submission for both forms
function bindAjaxForms(modalEl) {
    const customerForm = modalEl.querySelector('#customerFields');
    const businessForm = modalEl.querySelector('#businessFields');

    function submitForm(form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            // Remove old alerts
            modalEl.querySelectorAll('.alert').forEach(a => a.remove());

            const url = form.action;
            const formData = new FormData(form);

            fetch(url, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: formData
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
                    form.prepend(div);
                } else if (data.success) {
                    const div = document.createElement('div');
                    div.classList.add('alert', 'alert-success');
                    div.textContent = data.success;
                    form.prepend(div);

                    // Optionally reset form
                    form.reset();

                    autoHideMessages(modalEl);
                }
            })
            .catch(err => {
                const div = document.createElement('div');
                div.classList.add('alert', 'alert-danger');
                div.textContent = "Something went wrong. Please try again.";
                form.prepend(div);
            });
        });
    }

    submitForm(customerForm);
    submitForm(businessForm);
}