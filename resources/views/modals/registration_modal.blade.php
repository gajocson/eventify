<div class="modal fade" id="signupModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content right-box">

      <div class="modal-header">
        <h5 class="modal-title">Create Account</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">

        <!-- Flash / Validation Messages -->
        @if(session('success'))
            <div class="alert alert-success" id="registrationSuccess">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger" id="registrationError">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger" id="validationErrors">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

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
        <form id="customerFields" method="POST" action="{{ route('register.customer') }}">
            @csrf
            <div id="customerMessages"></div> <!-- new container for messages -->

            <p class="create">Create an account</p>
            <p class="account">Already have an account? <a href="#">Sign In</a></p>

            <div class="name mb-2">
                <input type="text" name="first_name" placeholder="First Name" required class="form-control mb-1">
                <input type="text" name="last_name" placeholder="Last Name" required class="form-control">
            </div>

            <div class="EmailPass mb-2">
                <input type="email" name="email" placeholder="Email" required class="form-control mb-1">
                <input type="text" name="phone" placeholder="Phone (optional)" class="form-control mb-1">

                <div class="pass-wrap mb-1">
                    <input type="password" name="password" placeholder="Password" required class="form-control">
                    <span class="material-symbols-outlined eye" data-target="customerPassword">visibility_off</span>
                </div>
                <div class="pass-wrap">
                    <input type="password" name="password_confirmation" placeholder="Confirm Password" required class="form-control">
                    <span class="material-symbols-outlined eye" data-target="customerConPass">visibility_off</span>
                </div>
            </div>

            <div class="checkbox-wrap mb-2">
                <input type="checkbox" name="terms" id="terms" required>
                <label for="terms">I accept the terms and conditions</label>
            </div>

            <div class="button">
                <button type="submit" class="createbtn btn btn-primary w-100">Create Account</button>
            </div>
        </form>

        <!-- Business Form -->
        <form id="businessFields" method="POST" action="{{ route('register.business') }}" style="display:none;">
            @csrf
            <div id="businessMessages"></div> <!-- new container for messages -->

            <p class="create">Register your business</p>

            <div class="name mb-2">
                <input type="text" name="business_name" placeholder="Business Name" required class="form-control mb-1">
                <input type="tel" name="business_cont_num" placeholder="Phone Number" required pattern="09[0-9]{9}" class="form-control">
            </div>

            <div class="EmailPass mb-2">
                <input type="email" name="business_email" placeholder="Email" required class="form-control mb-1">

                <div class="pass-wrap mb-1">
                    <input type="password" name="password" placeholder="Password" required class="form-control">
                    <span class="material-symbols-outlined eye" data-target="businessPassword">visibility_off</span>
                </div>
                <div class="pass-wrap">
                    <input type="password" name="password_confirmation" placeholder="Confirm Password" required class="form-control">
                    <span class="material-symbols-outlined eye" data-target="businessConPass">visibility_off</span>
                </div>
            </div>

            <div class="checkbox-wrap mb-2">
                <input type="checkbox" name="termsBusiness" id="termsBusiness" required>
                <label for="termsBusiness">I accept the terms and conditions</label>
            </div>

            <div class="button">
                <button type="submit" class="createbtn btn btn-primary w-100">Create Account</button>
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