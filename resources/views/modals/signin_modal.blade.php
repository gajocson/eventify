{{-- Sign-In Modal: loaded via AJAX, injected into <body>, shown with Bootstrap --}}
<div class="modal fade" id="signinModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered signin-dialog">
    <div class="modal-content signin-card">

      {{-- Close button --}}
      <button type="button" class="signin-close" data-bs-dismiss="modal" aria-label="Close">
        <span class="material-symbols-outlined">close</span>
      </button>

      {{-- Header --}}
      <div class="signin-header">
        <p class="signin-title">Welcome Back!</p>
        <p class="signin-subtitle">Sign in to your account to continue</p>
      </div>

      {{-- Customer / Business toggle --}}
      <div class="signin-toggle">
        <button id="signinCustomerBtn" class="stoggle-btn active" data-type="customer">
          <span class="material-symbols-outlined">person</span> Customer
        </button>
        <button id="signinBusinessBtn" class="stoggle-btn" data-type="business">
          <span class="material-symbols-outlined">account_balance</span> Business
        </button>
      </div>

      {{-- Messages container --}}
      <div id="signinMessages"></div>

      {{-- Form (action swapped by JS) --}}
      <form id="signinForm" method="POST" action="{{ route('login.customer') }}" novalidate>
        @csrf
        <input type="hidden" name="user_type" id="signinUserType" value="customer">

        <div class="signin-field">
          <label for="signinEmail">Email</label>
          <input type="email" id="signinEmail" name="email" placeholder="you@example.com" autocomplete="email" required>
        </div>

        <div class="signin-field">
          <label for="signinPass">Password</label>
          <div class="signin-pass-wrap">
            <input type="password" id="signinPass" name="password" placeholder="Enter your password" autocomplete="current-password" required>
            <span class="material-symbols-outlined signin-eye" id="signinEye">visibility_off</span>
          </div>
        </div>

        <div class="signin-form-footer">
          <label class="signin-remember">
            <input type="checkbox" name="remember"> <span>Remember me</span>
          </label>
          <a href="#" class="signin-forgot">Forgot Password?</a>
        </div>

        <button type="submit" class="signin-submit-btn">Sign In</button>
      </form>

      <div class="signin-note">
        Don't have an account?
        <a href="{{ route('register') }}" class="signin-signup-link">Sign up</a>
      </div>

    </div>
  </div>
</div>

<script>
  // Routes available to login.js
  window.signinRoutes = {
    customer: "{{ route('login.customer') }}",
    business: "{{ route('login.business') }}"
  };
</script>
