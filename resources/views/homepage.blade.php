<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/burger.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Homepage CSS/homePage_top_div.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Homepage CSS/homePage_mid_div.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Modal CSS/ev_modal.css') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Eventify</title>
</head>
<body>
    <div class="wholepage">
        <div class="topdivider">

            <!-- Row 1: Logo | Nav Tabs | Burger -->
            <div class="header-top-row">
                <div class="logoholder">
                    <a href="#">
                        <img class="logo" src="{{ asset('images/Homepage Photos/Eventify Logo.png') }}" alt="LogoImage">
                    </a>
                </div>

                <nav class="header-nav">
                    <a href="#" class="nav-tab active">
                        <span class="nav-tab-icon">🎟️</span>
                        Events
                    </a>
                    <a href="#" class="nav-tab">
                        <span class="nav-tab-icon">🎤</span>
                        Hosts
                    </a>
                </nav>

                <div class="header-right">
                    <!-- Burger button -->
                    <div class="burger" id="burger">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>

                    <!-- Dropdown Menu -->
                    <div class="dropdown" id="menu">
                        <div class="menu-header">Welcome</div>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#signupModal">Sign Up</a>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Sign In</a>
                    </div>
                </div>
            </div>

            <!-- Row 2: Search Bar -->
            <div class="header-search-row">
                <div class="searchBox">
                    <div class="searchSegment">
                        <label class="searchLabel">Where</label>
                        <input class="searchField" type="search" placeholder="Search events">
                    </div>
                    <div class="searchDivider"></div>
                    <div class="searchSegment">
                        <label class="searchLabel">When</label>
                        <input class="dateTimeField" type="date" placeholder="Add dates">
                    </div>
                    <div class="searchDivider"></div>
                    <div class="searchSegment searchSegment--last">
                        <label class="searchLabel">Who</label>
                        <div class="search-inner">
                            <input class="searchField" type="text" placeholder="Add guests">
                            <button class="searchBtn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- end of Top Divider -->

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

    {{-- Modals --}}
    @include('modals.registration_modal')
    @include('modals.login_modal')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('javascript/Burger.js') }}"></script>
    <script src="{{ asset('javascript/registrationModal.js') }}"></script>
    <script src="{{ asset('javascript/loginModal.js') }}"></script>
</body>
</html>