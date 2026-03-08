<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Material+Symbols+Outlined" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/burger.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Homepage CSS/homePage_top_div.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Homepage CSS/homePage_mid_div.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Registration CSS/Reg_contain_div.css') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Eventify</title>
</head>
<body>
    <div class="wholepage">

        <!-- ======================================================
             SITE HEADER
             ====================================================== -->
        <header class="site-header">

            <!-- Row 1: Nav bar -->
            <nav class="header-nav">

                <!-- Left: Logo -->
                <div class="nav-left">
                    <a href="#" class="logo-link">
                        <img class="logo" src="{{ asset('images/Homepage Photos/Eventify Logo.png') }}" alt="Eventify Logo">
                    </a>
                </div>

                <!-- Center: Navigation links -->
                <div class="nav-center">
                    <a href="#" class="nav-link-item">Packages</a>
                    <a href="#" class="nav-link-item">Services</a>
                </div>

                <!-- Right: Globe icon + Burger -->
                <div class="nav-right">
                    <!-- Globe / Language icon -->
                    <button class="globe-btn" aria-label="Language">
                        <span class="material-symbols-outlined">language</span>
                    </button>

                    <!-- Burger button -->
                    <div class="burger" id="burger" aria-label="Menu" role="button" tabindex="0">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>

                    <!-- Dropdown Menu (burger) -->
                    <div class="dropdown" id="menu">
                        <div class="menu-header">Welcome to Eventify</div>

                        <!-- Tab Buttons -->
                        <div class="auth-tabs">
                            <button class="auth-tab active" id="tab-signin" onclick="showAuthForm('signin')">Sign In</button>
                            <button class="auth-tab" id="tab-signup" onclick="showAuthForm('signup')">Sign Up</button>
                        </div>

                        <!-- ===== SIGN IN FORM ===== -->
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

                        <!-- ===== SIGN UP FORM ===== -->
                        <div class="auth-form-wrapper" id="form-signup">
                            <form method="POST" action="{{ route('register.customer') }}" id="signupForm" onsubmit="return validateSignUp()">
                                @csrf

                                <!-- User Type -->
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

                                <!-- Name -->
                                <div class="name-row">
                                    <div class="field-group">
                                        <input type="text" name="first_name" placeholder="First Name" required autocomplete="given-name">
                                    </div>
                                    <div class="field-group">
                                        <input type="text" name="last_name" placeholder="Last Name" required autocomplete="family-name">
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="field-group">
                                    <input type="email" name="email" id="signup-email" placeholder="Email address" required autocomplete="email">
                                </div>

                                <!-- Password -->
                                <div class="field-group pass-wrap">
                                    <input type="password" name="password" id="signup-password" placeholder="Password" required>
                                    <span class="material-symbols-outlined eye" data-target="signup-password">visibility_off</span>
                                </div>

                                <!-- Confirm Password -->
                                <div class="field-group pass-wrap">
                                    <input type="password" name="password_confirmation" id="signup-confirm" placeholder="Confirm Password" required>
                                    <span class="material-symbols-outlined eye" data-target="signup-confirm">visibility_off</span>
                                </div>

                                <!-- Terms -->
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
            </div><!-- end header-search -->

        </header><!-- end site-header -->

        <!-- ======================================================
             MID SECTION
             ====================================================== -->
        <div class="mid-div">
            <!-- Left Box -->
            <div class="leftbox">
                <div class="quote1">
                    <p>Unlock Unforgettable</p>
                    <p>Events</p>
                </div>
                <div class="quote2">
                    <p class="quote3">Your journey starts here. Discover seamless</p>
                    <p class="quote4">planning, unique venues, and curated experiences.</p>
                </div>
                <div class="gsbtn">
                    <button class="getstarted" onclick="">Get started →</button>
                </div>
            </div><!-- end of left box -->

            <!-- Right Box with Slideshow -->
            <div class="rightbox">
                <div class="imagebox">
                    <img src="{{ asset('images/Homepage Photos/LandingPageImg.jpg') }}" alt="Image">
                    <img src="{{ asset('images/Homepage Photos/LandingPageImg2.png') }}" alt="Image">
                    <img src="{{ asset('images/Homepage Photos/LandingPageImg3.png') }}" alt="Image">
                    <img src="{{ asset('images/Homepage Photos/LandingPageImg4.png') }}" alt="Image">
                </div>
            </div><!-- end of right box -->
        </div><!-- end of mid-div -->

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('javascript/Burger.js') }}"></script>
</body>
</html>