/**
 * Services Page — Modal JS
 * Opens/closes service detail modals with smooth animations.
 */

document.addEventListener('DOMContentLoaded', function () {

    // ── Open modal when a card is clicked ──
    document.querySelectorAll('.service-card').forEach(card => {
        card.addEventListener('click', function () {
            const target = this.dataset.modal;
            const overlay = document.getElementById(target);
            if (!overlay) return;

            overlay.classList.add('open');
            document.body.style.overflow = 'hidden';
        });
    });

    // ── Close modal via X button ──
    document.querySelectorAll('.svc-modal-close').forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.stopPropagation();
            closeModal(this.closest('.svc-modal-overlay'));
        });
    });

    // ── Close modal by clicking outside the modal box ──
    document.querySelectorAll('.svc-modal-overlay').forEach(overlay => {
        overlay.addEventListener('click', function (e) {
            if (e.target === overlay) {
                closeModal(overlay);
            }
        });
    });

    // ── Close modal on Escape key ──
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            const open = document.querySelector('.svc-modal-overlay.open');
            if (open) closeModal(open);
        }
    });

    function closeModal(overlay) {
        if (!overlay) return;

        // Animate out
        const modal = overlay.querySelector('.svc-modal');
        if (modal) {
            modal.style.transform = 'translateY(20px) scale(0.96)';
            modal.style.opacity = '0';
        }
        overlay.style.opacity = '0';

        setTimeout(() => {
            overlay.classList.remove('open');
            overlay.style.opacity = '';
            if (modal) {
                modal.style.transform = '';
                modal.style.opacity = '';
            }
            document.body.style.overflow = '';
        }, 320);
    }
});
