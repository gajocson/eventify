<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Noto+Sans:wght@400;600;700&display=swap" rel="stylesheet">
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
                    <a href="{{ url('/hosts') }}" class="nav-tab">
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

        <!-- ===== MAIN CONTENT BELOW HEADER ===== -->
        <div class="main-content">

            <!-- MOST USED EVENT SECTION -->
            <section class="featured-event-section">
                <div class="featured-event-header">
                    <div class="featured-event-title">
                        <span class="featured-badge">⭐ Most Booked</span>
                        <h2>Premium Wedding Reception Package</h2>
                        <p class="featured-event-meta">
                            <span>📍 Makati, Metro Manila</span>
                            <span>👥 Up to 300 guests</span>
                            <span>💍 Starting at ₱150,000</span>
                        </p>
                    </div>
                    <div class="featured-event-rating">
                        <span class="star-icon">★</span>
                        <span class="rating-score">4.97</span>
                        <span class="rating-reviews">· 312 reviews</span>
                    </div>
                </div>

                <!-- Photo Gallery (Airbnb-style) -->
                <div class="photo-gallery" id="photoGallery">
                    <!-- Large photo left -->
                    <div class="gallery-main">
                        <img src="{{ asset('images/Homepage Photos/LandingPageImg.jpg') }}" alt="Event Main Photo">
                    </div>
                    <!-- 2x2 grid right -->
                    <div class="gallery-grid">
                        <div class="gallery-cell">
                            <img src="{{ asset('images/Homepage Photos/LandingPageImg2.png') }}" alt="Event Photo 2">
                        </div>
                        <div class="gallery-cell">
                            <img src="{{ asset('images/Homepage Photos/LandingPageImg3.png') }}" alt="Event Photo 3">
                        </div>
                        <div class="gallery-cell">
                            <img src="{{ asset('images/Homepage Photos/LandingPageImg4.png') }}" alt="Event Photo 4">
                        </div>
                        <div class="gallery-cell gallery-cell--last">
                            <img src="{{ asset('images/Homepage Photos/Hpbck Image.png') }}" alt="Event Photo 5">
                            <button class="show-all-btn" id="showAllBtn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5v-3zm8 0A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5v-3zm-8 8A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5v-3zm8 0A1.5 1.5 0 0 1 10.5 9h3A1.5 1.5 0 0 1 15 10.5v3A1.5 1.5 0 0 1 13.5 15h-3A1.5 1.5 0 0 1 9 13.5v-3z"/>
                                </svg>
                                Show all photos
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Featured Service Details -->
                <div class="featured-event-details">
                    <div class="event-description">
                        <h3 class="service-desc-title">About this service</h3>
                        <p>Make your dream wedding a reality with our all-inclusive premium wedding reception package. From breathtaking floral arrangements and exquisite catering to full sound and lighting setup — our dedicated team of event specialists handles every detail so you can focus on celebrating your special day.</p>
                        <div class="service-highlights">
                            <div class="highlight-item">🌸 Full floral décor & styling</div>
                            <div class="highlight-item">🍽️ Catering for up to 300 guests</div>
                            <div class="highlight-item">🎵 Live band & sound system</div>
                            <div class="highlight-item">📸 Photo & video coverage</div>
                        </div>
                        <a href="#" class="view-event-btn">View Full Package →</a>
                    </div>
                    <div class="event-quick-book">
                        <div class="quick-book-card">
                            <div class="quick-book-price">₱150,000 <span>/ package</span></div>
                            <div class="quick-book-rating">★ 4.97 · <a href="#">312 reviews</a></div>
                            <div class="quick-book-dates">
                                <div class="book-date-field">
                                    <label>EVENT DATE</label>
                                    <span>Pick a date</span>
                                </div>
                                <div class="book-date-divider"></div>
                                <div class="book-date-field">
                                    <label>GUESTS</label>
                                    <span>Up to 300</span>
                                </div>
                            </div>
                            <button class="book-now-btn">Book Now</button>
                            <p class="book-note">You won't be charged yet</p>
                        </div>
                    </div>
                </div>

            </section>

            <!-- DIVIDER -->
            <div class="section-divider"></div>

            <!-- SERVICES LISTING SECTION -->
            <section class="events-listing-section">
                <h2 class="section-title">Browse Event Services</h2>
                <p class="section-subtitle">Find the perfect service for your next special occasion</p>

                <div class="events-grid">
                    <!-- Service Card 1: Wedding -->
                    <div class="event-card">
                        <div class="event-card-img-wrapper">
                            <img src="{{ asset('images/Homepage Photos/LandingPageImg.jpg') }}" alt="Wedding Service">
                            <span class="event-card-badge">💍 Wedding</span>
                            <button class="event-fav-btn" aria-label="Favorite">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                            </button>
                        </div>
                        <div class="event-card-body">
                            <div class="event-card-top">
                                <span class="event-card-location">📍 Makati, Metro Manila</span>
                                <span class="event-card-rating">★ 4.97</span>
                            </div>
                            <h4 class="event-card-name">Elegant Wedding Reception</h4>
                            <p class="event-card-date">Full planning · Up to 300 guests</p>
                            <p class="event-card-price"><strong>₱150,000</strong> / package</p>
                        </div>
                    </div>

                    <!-- Service Card 2: Birthday -->
                    <div class="event-card">
                        <div class="event-card-img-wrapper">
                            <img src="{{ asset('images/Homepage Photos/LandingPageImg2.png') }}" alt="Birthday Service">
                            <span class="event-card-badge">🎂 Birthday</span>
                            <button class="event-fav-btn" aria-label="Favorite">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                            </button>
                        </div>
                        <div class="event-card-body">
                            <div class="event-card-top">
                                <span class="event-card-location">📍 Quezon City</span>
                                <span class="event-card-rating">★ 4.90</span>
                            </div>
                            <h4 class="event-card-name">Grand Birthday Celebration</h4>
                            <p class="event-card-date">Themed setup · Up to 100 guests</p>
                            <p class="event-card-price"><strong>₱35,000</strong> / package</p>
                        </div>
                    </div>

                    <!-- Service Card 3: Conference -->
                    <div class="event-card">
                        <div class="event-card-img-wrapper">
                            <img src="{{ asset('images/Homepage Photos/LandingPageImg3.png') }}" alt="Conference Service">
                            <span class="event-card-badge">🏢 Conference</span>
                            <button class="event-fav-btn" aria-label="Favorite">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                            </button>
                        </div>
                        <div class="event-card-body">
                            <div class="event-card-top">
                                <span class="event-card-location">📍 BGC, Taguig</span>
                                <span class="event-card-rating">★ 4.88</span>
                            </div>
                            <h4 class="event-card-name">Corporate Conference & Summit</h4>
                            <p class="event-card-date">AV setup · Up to 500 attendees</p>
                            <p class="event-card-price"><strong>₱80,000</strong> / package</p>
                        </div>
                    </div>

                    <!-- Service Card 4: Debut -->
                    <div class="event-card">
                        <div class="event-card-img-wrapper">
                            <img src="{{ asset('images/Homepage Photos/LandingPageImg4.png') }}" alt="Debut Service">
                            <span class="event-card-badge">👑 Debut</span>
                            <button class="event-fav-btn" aria-label="Favorite">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                            </button>
                        </div>
                        <div class="event-card-body">
                            <div class="event-card-top">
                                <span class="event-card-location">📍 Pasig, Metro Manila</span>
                                <span class="event-card-rating">★ 4.94</span>
                            </div>
                            <h4 class="event-card-name">Debut & 18th Birthday Ball</h4>
                            <p class="event-card-date">Full décor · Up to 150 guests</p>
                            <p class="event-card-price"><strong>₱60,000</strong> / package</p>
                        </div>
                    </div>

                    <!-- Service Card 5: Christening -->
                    <div class="event-card">
                        <div class="event-card-img-wrapper">
                            <img src="{{ asset('images/Homepage Photos/Hpbck Image.png') }}" alt="Christening Service">
                            <span class="event-card-badge">🕊️ Christening</span>
                            <button class="event-fav-btn" aria-label="Favorite">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                            </button>
                        </div>
                        <div class="event-card-body">
                            <div class="event-card-top">
                                <span class="event-card-location">📍 Parañaque, Metro Manila</span>
                                <span class="event-card-rating">★ 4.86</span>
                            </div>
                            <h4 class="event-card-name">Christening & Baby Shower</h4>
                            <p class="event-card-date">Intimate setup · Up to 80 guests</p>
                            <p class="event-card-price"><strong>₱25,000</strong> / package</p>
                        </div>
                    </div>

                    <!-- Service Card 6: Team Building -->
                    <div class="event-card">
                        <div class="event-card-img-wrapper">
                            <img src="{{ asset('images/Homepage Photos/LandingPageImg.jpg') }}" alt="Team Building Service">
                            <span class="event-card-badge">🤝 Team Building</span>
                            <button class="event-fav-btn" aria-label="Favorite">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                            </button>
                        </div>
                        <div class="event-card-body">
                            <div class="event-card-top">
                                <span class="event-card-location">📍 Ortigas, Pasig</span>
                                <span class="event-card-rating">★ 4.82</span>
                            </div>
                            <h4 class="event-card-name">Corporate Team Building</h4>
                            <p class="event-card-date">Activities & catering · Per group</p>
                            <p class="event-card-price"><strong>₱45,000</strong> / package</p>
                        </div>
                    </div>
                </div>

                <div class="show-more-row">
                    <button class="show-more-btn">Show more services</button>
                </div>
            </section>

        </div><!-- end of main-content -->

    </div>

    {{-- Modals --}}
    @include('modals.registration_modal')
    @include('modals.login_modal')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('javascript/Burger.js') }}"></script>
    <script src="{{ asset('javascript/registrationModal.js') }}"></script>
    <script src="{{ asset('javascript/loginModal.js') }}"></script>

    <script>
        // Favorite button toggle
        document.querySelectorAll('.event-fav-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const svg = this.querySelector('svg');
                if (svg.getAttribute('fill') === 'none') {
                    svg.setAttribute('fill', 'white');
                } else {
                    svg.setAttribute('fill', 'none');
                }
            });
        });
    </script>
</body>
</html>