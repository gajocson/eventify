/**
 * toast.js — Eventify
 * Auto-dismisses server-rendered flash toasts (from PHP flash messages).
 */
document.addEventListener('DOMContentLoaded', function () {
    const pageToast = document.getElementById('page-toast');
    if (!pageToast) return;

    // Fade in
    pageToast.classList.add('toast-visible');

    // Auto-dismiss after 4 s
    setTimeout(function () {
        pageToast.classList.add('toast-leave');
        setTimeout(function () { pageToast.remove(); }, 400);
    }, 4000);
});
