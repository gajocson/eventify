<div class="modal fade" id="signupModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content right-box">

      <div class="modal-header">
        <h5 class="modal-title">Create Account</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">

        <!-- Radio buttons to select type -->
        <div class="user-type-selection">
          <div class="radio-item">
            <input type="radio" id="customer" name="user_type" value="customer" checked>
            <label for="customer">I am a Customer</label>
          </div>
          <div class="radio-item">
            <input type="radio" id="organizer" name="user_type" value="organizer">
            <label for="organizer">I am a Business</label>
          </div>
        </div>

        <!-- Customer Form -->
        <form id="customerFields">
          <p class="create">Create an account</p>
          <p class="account">Already have an account? <a href="#">Sign In</a></p>

          <div class="name">
            <input type="text" name="firstname" placeholder="First Name" required>
            <input type="text" name="lastname" placeholder="Last Name" required>
          </div>

          <div class="EmailPass">
            <input type="email" name="email" placeholder="Email" required>
            <div class="pass-wrap">
              <input type="password" id="password" placeholder="Password" required>
              <span class="material-symbols-outlined eye" data-target="password">visibility_off</span>
            </div>
            <div class="pass-wrap">
              <input type="password" id="conPass" placeholder="Confirm Password" required>
              <span class="material-symbols-outlined eye" data-target="conPass">visibility_off</span>
            </div>
          </div>

          <div class="checkbox-wrap">
            <input type="checkbox" id="terms" required>
            <label for="terms">I accept the terms and conditions</label>
          </div>

          <div class="button">
            <button type="submit" class="createbtn">Create Account</button>
          </div>
        </form>

        <!-- Business Form -->
        <form id="businessFields" style="display:none;">
            <p class="create">Register your business</p>

            <div class="name">
                <input type="text" name="business_name" placeholder="Business Name" required>
            </div>

            <!-- Phone Number -->
            <div class="name">
                <input type="tel" name="phone" placeholder="Phone Number" required pattern="[0-9]{10}">
            </div>

            <div class="EmailPass">
                <input type="email" name="email" placeholder="Email" required>
                
                <div class="pass-wrap">
                <input type="password" id="businessPassword" placeholder="Password" required>
                <span class="material-symbols-outlined eye" data-target="businessPassword">visibility_off</span>
                </div>

                <div class="pass-wrap">
                <input type="password" id="businessConPass" placeholder="Confirm Password" required>
                <span class="material-symbols-outlined eye" data-target="businessConPass">visibility_off</span>
                </div>
            </div>

            <div class="checkbox-wrap">
                <input type="checkbox" id="termsBusiness" required>
                <label for="termsBusiness">I accept the terms and conditions</label>
            </div>

            <div class="button">
                <button type="submit" class="createbtn">Create Account</button>
            </div>
        </form>

        <!-- Social buttons (always visible) -->
        <div class="or-divider">
          <span class="divider-line"></span>
          <span class="or-text">or register with</span>
          <span class="divider-line"></span>
        </div>
        <div class="social-buttons">
          <button class="social-btn">
            <img src="https://cdn-icons-png.flaticon.com/512/300/300221.png" alt="Google">
            <span>Google</span>
          </button>
          <button class="social-btn">
            <img src="https://cdn-icons-png.flaticon.com/512/733/733547.png" alt="Facebook">
            <span>Facebook</span>
          </button>
        </div>

      </div>
    </div>
  </div>
</div>