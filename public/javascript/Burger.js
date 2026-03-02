document.addEventListener("DOMContentLoaded", function () {
    const burger = document.getElementById("burger");
    const menu = document.getElementById("menu");

    // Create overlay dynamically
    let overlay = document.createElement("div");
    overlay.className = "menu-overlay";
    document.body.appendChild(overlay);

    burger.addEventListener("click", function (e) {
        e.stopPropagation();
        burger.classList.toggle("active");
        menu.classList.toggle("active");
        overlay.classList.toggle("active");
    });

    // Close when clicking outside or on overlay
    document.addEventListener("click", function () {
        burger.classList.remove("active");
        menu.classList.remove("active");
        overlay.classList.remove("active");
    });

    overlay.addEventListener("click", function () {
        burger.classList.remove("active");
        menu.classList.remove("active");
        overlay.classList.remove("active");
    });
});