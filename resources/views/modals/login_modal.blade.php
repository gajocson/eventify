<div class="modal fade" id="loginModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered ev-modal-dialog">
    <div class="modal-content ev-modal">

      <!-- Close button -->
      <button type="button" class="ev-close" data-bs-dismiss="modal" aria-label="Close">&times;</button>

      <!-- Left: Brand panel -->
      <div class="ev-brand">
        <div class="ev-brand-inner">
          <span class="ev-brand-icon">✦</span>
          <h2 class="ev-brand-name">Eventify</h2>
          <p class="ev-brand-tagline">Discover seamless planning, unique venues, and curated experiences.</p>
          <div class="ev-brand-dots">
            <span></span><span></span><span></span>
          </div>
        </div>
      </div>

      <!-- Right: Form panel -->
      <div class="ev-form-panel">

        <!-- Flash messages -->
        <div class="ev-alerts">
          @if(session('login_success'))
            <div class="alert alert-success">{{ session('login_success') }}</div>
          @endif
          @if(session('login_error'))
            <div class="alert alert-danger">{{ session('login_error') }}</div>
          @endif
        </div>

        <p class="ev-title">Welcome back</p>
        <p class="ev-subtitle">Don't have an account? <a href="#" id="switchToRegister">Sign up free</a></p>

        <form id="loginForm" method="POST" action="{{ route('login') }}">
          @csrf

          <div class="ev-input-group">

            <div class="ev-field">
              <input type="email" name="email" placeholder="Email address" required>
            </div>

            <div class="ev-field">
              <input type="password" name="password" id="loginPassword" placeholder="Password" required class="has-eye">
              <span class="material-symbols-outlined ev-eye" data-target="loginPassword">visibility_off</span>
            </div>

          </div>

          <div class="ev-forgot">
            <a href="#">Forgot password?</a>
          </div>

          <div class="ev-check">
            <input type="checkbox" name="remember" id="rememberMe">
            <label for="rememberMe">Remember me</label>
          </div>

          <button type="submit" class="ev-btn">Sign In</button>

        </form>

        <div class="ev-divider">
          <span class="ev-divider-line"></span>
          <span class="ev-divider-text">or continue with</span>
          <span class="ev-divider-line"></span>
        </div>

        <div class="ev-social">
          <button class="ev-social-btn">
            <img src="https://cdn-icons-png.flaticon.com/512/300/300221.png" alt="Google">
            Google
          </button>
          <button class="ev-social-btn">
            <img src="https://cdn-icons-png.flaticon.com/512/733/733547.png" alt="Facebook">
            Facebook
          </button>
        </div>

      </div><!-- end ev-form-panel -->
    </div>
  </div>
</div>
