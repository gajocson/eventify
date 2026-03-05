<div class="modal fade" id="loginModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content right-box">

      <div class="modal-header">
        <h5 class="modal-title">Sign In</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">

        <!-- Flash / Validation Messages -->
        @if(session('login_success'))
            <div class="alert alert-success" id="loginSuccess">
                {{ session('login_success') }}
            </div>
        @endif

        @if(session('login_error'))
            <div class="alert alert-danger" id="loginError">
                {{ session('login_error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger" id="loginValidationErrors">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Login Form -->
        <form id="loginForm" method="POST" action="{{ route('login') }}">
            @csrf

            <p class="create">Welcome Back</p>
            <p class="account">Don't have an account? <a href="#" id="switchToRegister">Sign Up</a></p>

            <div class="EmailPass mb-2">
                <input type="email" name="email" placeholder="Email" required class="form-control mb-1">

                <div class="pass-wrap mb-1">
                    <input type="password" name="password" id="loginPassword" placeholder="Password" required class="form-control">
                    <span class="material-symbols-outlined eye" data-target="loginPassword">visibility_off</span>
                </div>
            </div>

            <div class="forgot-wrap mb-2">
                <a href="#" class="forgot-link">Forgot password?</a>
            </div>

            <div class="checkbox-wrap mb-2">
                <input type="checkbox" name="remember" id="rememberMe">
                <label for="rememberMe">Remember me</label>
            </div>

            <div class="button">
                <button type="submit" class="createbtn btn btn-primary w-100">Sign In</button>
            </div>
        </form>

        <!-- Social buttons -->
        <div class="or-divider">
          <span class="divider-line"></span>
          <span class="or-text">or sign in with</span>
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
