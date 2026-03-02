<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{ asset('css/burger.css') }}">
    <link rel="stylesheet" href="{{ asset('css/homePage_top_div.css') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="wholepage">
        <div class = "topdivider">

            <div class = "logoholder">
                <a href="#">
                <img class = "logo" src = "{{ asset('images/Homepage Photos/Eventify Logo.png') }}" alt = "LogoImage">
                </a>
            </div>

            <div class="searchBox">
                <div class="searchSegment">
                    <input class="searchField" type="search" placeholder="Search">
                </div>
                <div class="searchSegment">
                    <input class="dateTimeField" type="date">
                </div>
            </div>

            <div class = "nav-divider1">
                <ul class = "nav-links">
                    <li><a href="#">Events</a></li>
                </ul>
            </div>

            <div class = "nav-divider2">
                <ul class = "nav-links">
                    <li><a href="#">Hosts</a></li>
                </ul>
            </div>

            <!-- Burger button -->
            <div class="burger" id="burger">
                <span></span>
                <span></span>
                <span></span>

                    
            <!-- Dropdown Menu -->
            <div class="dropdown" id="menu">
                <a href="#">Home</a>
                <a href="#">Profile</a>
                <a href="#">Settings</a>
                <a href="#">Logout</a>
            </div>

        </div><!-- end of Top Divider -->
    </div>
    <script src="{{ asset('javascript/Burger.js') }}"></script>
</body>
</html>