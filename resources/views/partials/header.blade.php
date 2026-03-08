{{-- ============================================================
     Shared Header Partial — HTML ONLY (no <link> tags)
     CSS must be loaded in the page's own <head>.
     Include: @include('partials.header')
     ============================================================ --}}

<header class="site-header">

    <!-- Row 1: Nav bar -->
    <nav class="header-nav">

        <!-- Left: Logo -->
        <div class="nav-left">
            <a href="{{ url('/') }}" class="logo-link">
                <img class="logo" src="{{ asset('images/Homepage Photos/Eventify Logo.png') }}" alt="Eventify Logo">
            </a>
        </div>

        <!-- Center: Navigation links -->
        <div class="nav-center">
            <a href="{{ url('/packages') }}" class="nav-link-item {{ request()->is('packages*') ? 'active' : '' }}">Packages</a>
            <a href="{{ url('/services') }}" class="nav-link-item {{ request()->is('services*') ? 'active' : '' }}">Services</a>
        </div>

        <!-- Right: Globe icon + Burger -->
        <div class="nav-right">
            <button class="globe-btn" aria-label="Language">
                <span class="material-symbols-outlined">language</span>
            </button>

            <div class="burger" id="burger" aria-label="Menu" role="button" tabindex="0">
                <span></span>
                <span></span>
                <span></span>
            </div>

            <!-- Dropdown Menu -->
            <div class="dropdown" id="menu">
                <div class="menu-header">Welcome to Eventify</div>

                <div class="auth-tabs">
                    <button class="auth-tab active" id="tab-signin" onclick="showAuthForm('signin')">Sign In</button>
                    <button class="auth-tab" id="tab-signup" onclick="showAuthForm('signup')">Sign Up</button>
                </div>

                <!-- Sign In Form -->
                <div class="auth-form-wrapper active" id="form-signin">
                    <form method="POST" action="{{ route('login') }}" id="signinForm" onsubmit="return validateSignIn()">
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
                        <button type="submit" class="auth-submit-btn">Sign In</button>
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

                <!-- Sign Up Form -->
                <div class="auth-form-wrapper" id="form-signup">
                    <form method="POST" action="{{ route('register.customer') }}" id="signupForm" onsubmit="return validateSignUp()">
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
                                <input type="text" name="first_name" placeholder="First Name" required autocomplete="given-name">
                            </div>
                            <div class="field-group">
                                <input type="text" name="last_name" placeholder="Last Name" required autocomplete="family-name">
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
                            <input type="checkbox" id="dp-terms" required>
                            <label for="dp-terms">I accept the <a href="#">terms &amp; conditions</a></label>
                        </div>
                        <button type="submit" class="auth-submit-btn">Create Account</button>
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

            </div><!-- end dropdown -->
        </div><!-- end nav-right -->
    </nav><!-- end header-nav -->

    <!-- Row 2: Search bar -->
    <div class="header-search">
        <form class="search-pill" action="#" method="GET" id="mainSearchForm">
            <div class="search-field" id="search-where">
                <label for="input-where">
                    <span class="material-symbols-outlined search-field-icon">location_on</span>
                </label>
                <div class="search-field-text">
                    <span class="search-field-label">Where</span>
                    <input type="text" id="input-where" name="where" placeholder="City, venue or area…" autocomplete="off">
                </div>
            </div>
            <div class="search-divider"></div>
            <div class="search-field" id="search-what">
                <label for="input-what">
                    <span class="material-symbols-outlined search-field-icon">star</span>
                </label>
                <div class="search-field-text">
                    <span class="search-field-label">What</span>
                    <input type="text" id="input-what" name="what" placeholder="Package, service or event type…" autocomplete="off">
                </div>
            </div>
            <button type="submit" class="search-btn" aria-label="Search">
                <span class="material-symbols-outlined">search</span>
            </button>
        </form>
    </div>

</header>
