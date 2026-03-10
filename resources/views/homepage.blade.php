<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Eventify — Plan Your Perfect Event</title>
    <meta name="description" content="Eventify: discover seamless event planning, unique venues, and curated experiences.">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/burger.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Homepage CSS/homePage_top_div.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Homepage CSS/homePage_mid_div.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Registration CSS/Reg_contain_div.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Homepage CSS/hero_banner.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Homepage CSS/packages.css') }}">

    {{-- Pass auth state to JavaScript --}}
    <script>window.EVENTIFY_IS_AUTH = {{ auth()->check() ? 'true' : 'false' }};</script>
</head>
<body>
    <div class="wholepage">

        {{-- Shared Header (logo, nav, search bar, burger dropdown) --}}
        @include('partials.header')
        @include('partials.toast')

        {{-- =====================================================
             HERO BANNER — Always visible (before & after login)
             ===================================================== --}}
        <div class="hero-banner">
            <img class="hero-banner__img" src="{{ asset('images/Homepage Photos/hero_banner.png') }}" alt="Where Great Events Begin — Eventify Hero Banner">
            <div class="hero-banner__overlay"></div>
            <div class="hero-banner__content">
                <span class="hero-banner__tagline">Discover · Plan · Celebrate</span>
                <h1 class="hero-banner__headline">Where Great Events Begin</h1>
                <a href="#packages" class="hero-banner__cta">Browse Packages</a>
            </div>
        </div>

        {{-- =====================================================
             PACKAGES SECTION — Visible to all users
             ===================================================== --}}
        <section class="packages-section" id="packages">
            <div class="packages-section__header">
                <span class="packages-section__label">✦ Our Packages</span>
                <h2 class="packages-section__title">Find Your Perfect Event</h2>
                <p class="packages-section__subtitle">Choose a package below, select your services, and let us bring your vision to life.</p>
            </div>

            <div class="packages-grid">

                {{-- 1. Wedding --}}
                <div class="pkg-card" data-package="Wedding Package" role="button" tabindex="0" aria-label="Open Wedding Package">
                    <div class="pkg-card__img-wrap">
                        <img src="{{ asset('images/Packages/package_wedding.png') }}" alt="Wedding Package" loading="lazy">
                    </div>
                    <div class="pkg-card__content">
                        <div class="pkg-card__icon">💍</div>
                        <div class="pkg-card__body">
                            <p class="pkg-card__title">Wedding Package</p>
                            <p class="pkg-card__desc">Timeless ceremonies and elegant receptions tailored to your love story.</p>
                        </div>
                        <span class="pkg-card__cta">Select services →</span>
                    </div>
                </div>

                {{-- 2. Birthday Party --}}
                <div class="pkg-card" data-package="Birthday Party Package" role="button" tabindex="0" aria-label="Open Birthday Party Package">
                    <div class="pkg-card__img-wrap">
                        <img src="{{ asset('images/Packages/package_birthday.png') }}" alt="Birthday Party Package" loading="lazy">
                    </div>
                    <div class="pkg-card__content">
                        <div class="pkg-card__icon">🎂</div>
                        <div class="pkg-card__body">
                            <p class="pkg-card__title">Birthday Party Package</p>
                            <p class="pkg-card__desc">Fun, vibrant celebrations that make every age feel special.</p>
                        </div>
                        <span class="pkg-card__cta">Select services →</span>
                    </div>
                </div>

                {{-- 3. Debut --}}
                <div class="pkg-card" data-package="Debut Package" role="button" tabindex="0" aria-label="Open Debut Package">
                    <div class="pkg-card__img-wrap">
                        <img src="{{ asset('images/Packages/package_debut.png') }}" alt="Debut Package" loading="lazy">
                    </div>
                    <div class="pkg-card__content">
                        <div class="pkg-card__icon">👑</div>
                        <div class="pkg-card__body">
                            <p class="pkg-card__title">Debut Package</p>
                            <p class="pkg-card__desc">Mark the milestone of turning 18 with a night to remember.</p>
                        </div>
                        <span class="pkg-card__cta">Select services →</span>
                    </div>
                </div>

                {{-- 4. Corporate Event --}}
                <div class="pkg-card" data-package="Corporate Event Package" role="button" tabindex="0" aria-label="Open Corporate Event Package">
                    <div class="pkg-card__img-wrap">
                        <img src="{{ asset('images/Packages/package_corporate.png') }}" alt="Corporate Event Package" loading="lazy">
                    </div>
                    <div class="pkg-card__content">
                        <div class="pkg-card__icon">🏢</div>
                        <div class="pkg-card__body">
                            <p class="pkg-card__title">Corporate Event Package</p>
                            <p class="pkg-card__desc">Professional gatherings, conferences, and team events done right.</p>
                        </div>
                        <span class="pkg-card__cta">Select services →</span>
                    </div>
                </div>

                {{-- 5. Engagement Party --}}
                <div class="pkg-card" data-package="Engagement Party Package" role="button" tabindex="0" aria-label="Open Engagement Party Package">
                    <div class="pkg-card__img-wrap">
                        <img src="{{ asset('images/Packages/package_engagement.png') }}" alt="Engagement Party Package" loading="lazy">
                    </div>
                    <div class="pkg-card__content">
                        <div class="pkg-card__icon">💒</div>
                        <div class="pkg-card__body">
                            <p class="pkg-card__title">Engagement Party Package</p>
                            <p class="pkg-card__desc">Celebrate your "yes" with an intimate and stylish gathering.</p>
                        </div>
                        <span class="pkg-card__cta">Select services →</span>
                    </div>
                </div>

                {{-- 6. Baby Shower --}}
                <div class="pkg-card" data-package="Baby Shower Package" role="button" tabindex="0" aria-label="Open Baby Shower Package">
                    <div class="pkg-card__img-wrap">
                        <img src="{{ asset('images/Packages/package_babyshower.png') }}" alt="Baby Shower Package" loading="lazy">
                    </div>
                    <div class="pkg-card__content">
                        <div class="pkg-card__icon">🍼</div>
                        <div class="pkg-card__body">
                            <p class="pkg-card__title">Baby Shower Package</p>
                            <p class="pkg-card__desc">Sweet and playful showers welcoming your little one into the world.</p>
                        </div>
                        <span class="pkg-card__cta">Select services →</span>
                    </div>
                </div>

                {{-- 7. Graduation Party --}}
                <div class="pkg-card" data-package="Graduation Party Package" role="button" tabindex="0" aria-label="Open Graduation Party Package">
                    <div class="pkg-card__img-wrap">
                        <img src="{{ asset('images/Packages/package_graduation.png') }}" alt="Graduation Party Package" loading="lazy">
                    </div>
                    <div class="pkg-card__content">
                        <div class="pkg-card__icon">🎓</div>
                        <div class="pkg-card__body">
                            <p class="pkg-card__title">Graduation Party Package</p>
                            <p class="pkg-card__desc">Honor every milestone, diploma, and dream achieved.</p>
                        </div>
                        <span class="pkg-card__cta">Select services →</span>
                    </div>
                </div>

                {{-- 8. Anniversary Celebration --}}
                <div class="pkg-card" data-package="Anniversary Celebration Package" role="button" tabindex="0" aria-label="Open Anniversary Celebration Package">
                    <div class="pkg-card__img-wrap">
                        <img src="{{ asset('images/Packages/package_anniversary.png') }}" alt="Anniversary Celebration Package" loading="lazy">
                    </div>
                    <div class="pkg-card__content">
                        <div class="pkg-card__icon">🥂</div>
                        <div class="pkg-card__body">
                            <p class="pkg-card__title">Anniversary Celebration Package</p>
                            <p class="pkg-card__desc">Relive and renew your love story with a memorable celebration.</p>
                        </div>
                        <span class="pkg-card__cta">Select services →</span>
                    </div>
                </div>

                {{-- 9. Product Launch Event --}}
                <div class="pkg-card" data-package="Product Launch Event Package" role="button" tabindex="0" aria-label="Open Product Launch Event Package">
                    <div class="pkg-card__img-wrap">
                        <img src="{{ asset('images/Packages/package_productlaunch.png') }}" alt="Product Launch Event Package" loading="lazy">
                    </div>
                    <div class="pkg-card__content">
                        <div class="pkg-card__icon">🚀</div>
                        <div class="pkg-card__body">
                            <p class="pkg-card__title">Product Launch Event Package</p>
                            <p class="pkg-card__desc">Make a powerful first impression with a buzz-worthy launch event.</p>
                        </div>
                        <span class="pkg-card__cta">Select services →</span>
                    </div>
                </div>

                {{-- 10. Christening / Baptism --}}
                <div class="pkg-card" data-package="Christening / Baptism Package" role="button" tabindex="0" aria-label="Open Christening / Baptism Package">
                    <div class="pkg-card__img-wrap">
                        <img src="{{ asset('images/Packages/package_christening.png') }}" alt="Christening / Baptism Package" loading="lazy">
                    </div>
                    <div class="pkg-card__content">
                        <div class="pkg-card__icon">✝️</div>
                        <div class="pkg-card__body">
                            <p class="pkg-card__title">Christening / Baptism Package</p>
                            <p class="pkg-card__desc">A sacred and joyful celebration of faith and new beginnings.</p>
                        </div>
                        <span class="pkg-card__cta">Select services →</span>
                    </div>
                </div>

                {{-- ── Admin-created packages from DB ── --}}
                @foreach($adminPackages ?? [] as $ap)
                <div class="pkg-card" data-package="{{ $ap->name }}" role="button" tabindex="0" aria-label="Open {{ $ap->name }}">
                    @if($ap->image_path)
                        <div class="pkg-card__img-wrap">
                            <img src="{{ asset($ap->image_path) }}" alt="{{ $ap->name }}" loading="lazy">
                        </div>
                    @else
                        <div class="pkg-card__img-wrap" style="background:linear-gradient(135deg,#f3eafd,#e8d5f9); display:flex; align-items:center; justify-content:center; height:180px;">
                            <span style="font-size:52px; line-height:1;">{{ $ap->emoji }}</span>
                        </div>
                    @endif
                    <div class="pkg-card__content">
                        <div class="pkg-card__icon">{{ $ap->emoji }}</div>
                        <div class="pkg-card__body">
                            <p class="pkg-card__title">{{ $ap->name }}</p>
                            <p class="pkg-card__desc">{{ $ap->description }}</p>
                        </div>
                        <span class="pkg-card__cta">Select services →</span>
                    </div>
                </div>
                @endforeach

            </div>{{-- end .packages-grid --}}
        </section>

        {{-- =====================================================
             MID SECTION
             ===================================================== --}}

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
    <script src="{{ asset('javascript/packages.js') }}"></script>
</body>
</html>