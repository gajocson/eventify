<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="wholepage">
        <div class = "topdivider">

            <div class = "logoholder">
                <a href="{{  route('homelanding') }}">
                <img class = "logo" src = "{{ asset('images/Eventify Logo.png') }}" alt = "LogoImage">
                </a>
            </div>

            <div class = "nav-divider1">
                <ul class = "nav-links">
                    <li><a href="{{ route('homelanding') }}">Home</a></li>
                </ul>
            </div>

            <div class = "nav-divider2">
                <ul class = "nav-links">
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>

            <div class = "signin-button">
                <button class = "signin" onclick="window.location='{{ route('login') }}'">Sign In</button>
            </div>

        </div><!-- end of Top Divider -->
    </div>
</body>
</html>