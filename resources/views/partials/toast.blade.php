{{-- ============================================================
     Toast Notification Partial
     Include on every page: @include('partials.toast')
     Reads session flash: success / error / info
     ============================================================ --}}

@if(session('success') || session('error') || session('info'))
<div id="page-toast" class="page-toast {{ session('success') ? 'toast-success' : (session('error') ? 'toast-error' : 'toast-info') }}" role="alert" aria-live="polite">
    <span class="material-symbols-outlined toast-icon">
        {{ session('success') ? 'check_circle' : (session('error') ? 'error' : 'info') }}
    </span>
    <span class="toast-message">{{ session('success') ?? session('error') ?? session('info') }}</span>
    <button class="toast-close" onclick="this.parentElement.remove()" aria-label="Close">
        <span class="material-symbols-outlined">close</span>
    </button>
</div>
@endif

{{-- Toast container for dynamic JS toasts --}}
<div id="toast-container" aria-live="polite"></div>
