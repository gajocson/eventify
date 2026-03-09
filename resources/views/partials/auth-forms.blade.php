{{-- ============================================================
     Auth Forms Sub-Partial
     Included inside the dropdown for both guest and hidden auth panels.
     ============================================================ --}}

<div class="menu-header">Welcome to Eventify</div>

<div class="auth-tabs">
    <button class="auth-tab active" id="tab-signin" onclick="showAuthForm('signin')">Sign In</button>
    <button class="auth-tab" id="tab-signup" onclick="showAuthForm('signup')">Sign Up</button>
</div>

{{-- Sign In Form --}}
<div class="auth-form-wrapper active" id="form-signin">
    <form id="signinForm" onsubmit="handleSignIn(event)">
        @csrf
        <div class="field-group">
            <input type="email" name="email" id="signin-email" placeholder="Email address" required autocomplete="email">
        </div>
        <div class="field-group pass-wrap">
            <input type="password" name="password" id="signin-password" placeholder="Password" required autocomplete="current-password">
            <span class="material-symbols-outlined eye" data-target="signin-password">visibility_off</span>
        </div>
        <div class="forgot-wrap">
            <a href="#" class="forgot-link">Forgot password?</a>
        </div>
        <button type="submit" class="auth-submit-btn" id="signin-submit-btn">Sign In</button>
        <div class="or-divider">
            <span class="divider-line"></span>
            <span class="or-text">or sign in with</span>
            <span class="divider-line"></span>
        </div>
        <div class="social-buttons">
            <button type="button" class="social-btn">
                <img src="https://cdn-icons-png.flaticon.com/512/300/300221.png" alt="Google">
                <span>Google</span>
            </button>
            <button type="button" class="social-btn">
                <img src="https://cdn-icons-png.flaticon.com/512/733/733547.png" alt="Facebook">
                <span>Facebook</span>
            </button>
        </div>
        <p class="switch-link">Don't have an account? <a href="#" onclick="showAuthForm('signup'); return false;">Sign Up</a></p>
    </form>
</div>

{{-- Sign Up Form --}}
<div class="auth-form-wrapper" id="form-signup">
    <form id="signupForm" onsubmit="handleSignUp(event)">
        @csrf
        <div class="user-type-selection">
            <div class="radio-item">
                <input type="radio" id="dp-customer" name="user_type" value="customer" checked>
                <label for="dp-customer">Customer</label>
            </div>
            <div class="radio-item">
                <input type="radio" id="dp-organizer" name="user_type" value="organizer">
                <label for="dp-organizer">Organizer</label>
            </div>
        </div>
        <div class="name-row">
            <div class="field-group">
                <input type="text" name="first_name" id="signup-firstname" placeholder="First Name" required autocomplete="given-name">
            </div>
            <div class="field-group">
                <input type="text" name="last_name" id="signup-lastname" placeholder="Last Name" required autocomplete="family-name">
            </div>
        </div>
        <div class="field-group">
            <input type="email" name="email" id="signup-email" placeholder="Email address" required autocomplete="email">
        </div>
        <div class="field-group pass-wrap">
            <input type="password" name="password" id="signup-password" placeholder="Password" required>
            <span class="material-symbols-outlined eye" data-target="signup-password">visibility_off</span>
        </div>
        <div class="field-group pass-wrap">
            <input type="password" name="password_confirmation" id="signup-confirm" placeholder="Confirm Password" required>
            <span class="material-symbols-outlined eye" data-target="signup-confirm">visibility_off</span>
        </div>
        <div class="checkbox-wrap">
            <input type="checkbox" id="dp-terms" name="terms" value="1" required>
            <label for="dp-terms">I accept the <a href="#">terms &amp; conditions</a></label>
        </div>
        <button type="submit" class="auth-submit-btn" id="signup-submit-btn">Create Account</button>
        <div class="or-divider">
            <span class="divider-line"></span>
            <span class="or-text">or register with</span>
            <span class="divider-line"></span>
        </div>
        <div class="social-buttons">
            <button type="button" class="social-btn">
                <img src="https://cdn-icons-png.flaticon.com/512/300/300221.png" alt="Google">
                <span>Google</span>
            </button>
            <button type="button" class="social-btn">
                <img src="https://cdn-icons-png.flaticon.com/512/733/733547.png" alt="Facebook">
                <span>Facebook</span>
            </button>
        </div>
        <p class="switch-link">Already have an account? <a href="#" onclick="showAuthForm('signin'); return false;">Sign In</a></p>
    </form>
</div>
