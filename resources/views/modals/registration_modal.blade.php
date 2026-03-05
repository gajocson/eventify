<div class="modal fade" id="signupModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered ev-modal-dialog">
    <div class="modal-content ev-modal">

      <!-- Close button -->
      <button type="button" class="ev-close" data-bs-dismiss="modal" aria-label="Close">&times;</button>

      <!-- Left: Brand panel -->
      <div class="ev-brand">
        <div class="ev-brand-inner">
          <span class="ev-brand-icon">✦</span>
          <h2 class="ev-brand-name">Eventify</h2>
          <p class="ev-brand-tagline">Join thousands of hosts and attendees creating unforgettable moments.</p>
          <div class="ev-brand-dots">
            <span></span><span></span><span></span>
          </div>
        </div>
      </div>

      <!-- Right: Form panel -->
      <div class="ev-form-panel">

        <!-- Flash / Validation messages -->
        <div class="ev-alerts">
          @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
          @endif
          @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
          @endif
          @if($errors->any())
            <div class="alert alert-danger">
              <ul class="mb-0">
                @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
        </div>

        <p class="ev-title">Create account</p>
        <p class="ev-subtitle">Already have an account? <a href="#" id="switchToLogin">Sign in</a></p>

        <!-- Account type pills -->
        <div class="ev-type-pills">
          <input type="radio" id="customer" name="user_type" value="customer" checked>
          <label for="customer">I'm a Customer</label>
          <input type="radio" id="organizer" name="user_type" value="organizer">
          <label for="organizer">I'm a Business</label>
        </div>

        <!-- ── Customer Form ─────────────────────────────── -->
        <form id="customerFields" method="POST" action="{{ route('register.customer') }}">
          @csrf
          <div id="customerMessages"></div>

          <div class="ev-input-group">

            <div class="ev-row">
              <div class="ev-field">
                <input type="text" name="first_name" placeholder="First name" required>
              </div>
              <div class="ev-field">
                <input type="text" name="last_name" placeholder="Last name" required>
              </div>
            </div>

            <div class="ev-field">
              <input type="email" name="email" placeholder="Email address" required>
            </div>

            <div class="ev-field">
              <input type="text" name="phone" placeholder="Phone (optional)">
            </div>

            <div class="ev-field">
              <input type="password" name="password" placeholder="Password" required class="has-eye">
              <span class="material-symbols-outlined ev-eye">visibility_off</span>
            </div>

            <div class="ev-field">
              <input type="password" name="password_confirmation" placeholder="Confirm password" required class="has-eye">
              <span class="material-symbols-outlined ev-eye">visibility_off</span>
            </div>

          </div>

          <div class="ev-check">
            <input type="checkbox" name="terms" id="terms" required>
            <label for="terms">I accept the terms and conditions</label>
          </div>

          <button type="submit" class="ev-btn">Create Account</button>
        </form>

        <!-- ── Business Form ─────────────────────────────── -->
        <form id="businessFields" method="POST" action="{{ route('register.business') }}" style="display:none;">
          @csrf
          <div id="businessMessages"></div>

          <div class="ev-input-group">

            <div class="ev-field">
              <input type="text" name="business_name" placeholder="Business name" required>
            </div>

            <div class="ev-field">
              <input type="tel" name="business_cont_num" placeholder="Phone number (optional)">
            </div>

            <div class="ev-field">
              <input type="email" name="business_email" placeholder="Email address" required>
            </div>

            <div class="ev-field">
              <input type="password" name="password" placeholder="Password" required class="has-eye">
              <span class="material-symbols-outlined ev-eye">visibility_off</span>
            </div>

            <div class="ev-field">
              <input type="password" name="password_confirmation" placeholder="Confirm password" required class="has-eye">
              <span class="material-symbols-outlined ev-eye">visibility_off</span>
            </div>

          </div>

          <div class="ev-check">
            <input type="checkbox" name="termsBusiness" id="termsBusiness" required>
            <label for="termsBusiness">I accept the terms and conditions</label>
          </div>

          <button type="submit" class="ev-btn">Register Business</button>
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