document.addEventListener("DOMContentLoaded", function () {
    // Find the Sign Up link in your dropdown
    const signupBtn = document.querySelector(".dropdown a[href='#']"); // or give it an id for clarity

    signupBtn.addEventListener("click", function (e) {
        e.preventDefault(); // prevent default link behavior

        // Fetch the modal HTML from the server
        fetch('/registration-modal')
            .then(response => response.text())
            .then(html => {
                // Insert the modal HTML at the end of the body
                document.body.insertAdjacentHTML('beforeend', html);

                const modalEl = document.getElementById('signupModal');

                // Attach password toggle
                attachPasswordToggle(modalEl);

                // Initialize and show the Bootstrap modal
                const myModal = new bootstrap.Modal(modalEl);
                myModal.show();

                // Remove modal from DOM when hidden to avoid duplicates
                modalEl.addEventListener('hidden.bs.modal', () => {
                    modalEl.remove();
                });
            })
            .catch(err => console.error('Failed to load modal:', err));
    });
});

// Function to attach password toggle for dynamically loaded modal
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