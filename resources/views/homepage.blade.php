<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Eventify — Plan Your Perfect Event</title>
    <meta name="description" content="Eventify: discover seamless event planning, unique venues, and curated experiences.">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/burger.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Homepage CSS/homePage_top_div.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Homepage CSS/homePage_mid_div.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Registration CSS/Reg_contain_div.css') }}">
</head>
<body>
    <div class="wholepage">

        {{-- Shared Header (logo, nav, search bar, burger dropdown) --}}
        @include('partials.header')
        @include('partials.toast')

        {{-- =====================================================
             MID SECTION
             ===================================================== --}}
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
    <script src="{{ asset('javascript/toast.js') }}"></script>
</body>
</html>