document.addEventListener("DOMContentLoaded", function () {
    const signupBtn = document.querySelector(".dropdown a[href='#']");

    signupBtn.addEventListener("click", function (e) {
        e.preventDefault();

        fetch('/registration-modal')
            .then(res => res.text())
            .then(html => {
                document.body.insertAdjacentHTML('beforeend', html);
                const modalEl = document.getElementById('signupModal');

                // Show the modal
                const myModal = new bootstrap.Modal(modalEl);
                myModal.show();

                // Remove modal when hidden
                modalEl.addEventListener('hidden.bs.modal', () => modalEl.remove());

                // Attach password toggle
                attachPasswordToggle(modalEl);

                // Attach customer/business toggle
                attachFormToggle();
            })
            .catch(err => console.error(err));
    }); // <-- this closes signupBtn click listener
}); // <-- this closes DOMContentLoaded listener

// Password visibility
function attachPasswordToggle(modalEl) {
    modalEl.querySelectorAll(".eye").forEach(icon => {
        icon.addEventListener("click", function () {
            const target = modalEl.querySelector(`#${this.dataset.target}`);
            if (target.type === "password") {
                target.type = "text";
                this.textContent = "visibility";
            } else {
                target.type = "password";
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
    updateForm(); // initial
}