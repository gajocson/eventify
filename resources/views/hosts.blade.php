<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/burger.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Homepage CSS/homePage_top_div.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Hosts CSS/hosts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Modal CSS/ev_modal.css') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Hosts — Eventify</title>
</head>
<body>
    <div class="wholepage">

        {{-- ===== SHARED HEADER ===== --}}
        <div class="topdivider">
            <div class="header-top-row">
                <div class="logoholder">
                    <a href="{{ url('/') }}">
                        <img class="logo" src="{{ asset('images/Homepage Photos/Eventify Logo.png') }}" alt="Eventify Logo">
                    </a>
                </div>

                <nav class="header-nav">
                    <a href="{{ url('/') }}" class="nav-tab">
                        <span class="nav-tab-icon">🎟️</span>
                        Events
                    </a>
                    <a href="{{ url('/hosts') }}" class="nav-tab active">
                        <span class="nav-tab-icon">🎤</span>
                        Hosts
                    </a>
                </nav>

                <div class="header-right">
                    <div class="burger" id="burger">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <div class="dropdown" id="menu">
                        <div class="menu-header">Welcome</div>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#signupModal">Sign Up</a>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Sign In</a>
                    </div>
                </div>
            </div>

            <div class="header-search-row">
                <div class="searchBox">
                    <div class="searchSegment">
                        <label class="searchLabel">Where</label>
                        <input class="searchField" type="search" placeholder="Search hosts">
                    </div>
                    <div class="searchDivider"></div>
                    <div class="searchSegment">
                        <label class="searchLabel">When</label>
                        <input class="dateTimeField" type="date">
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
        </div>{{-- end header --}}

        {{-- ===== HOSTS PAGE CONTENT ===== --}}
        <div class="hosts-page">

            <div class="hosts-hero">
                <h1 class="hosts-title">Meet Our Hosts</h1>
                <p class="hosts-subtitle">Trusted professionals ready to make your event unforgettable</p>
            </div>

            {{-- ===== SECTION 1: TOP RATED ===== --}}
            <div class="hosts-section-label">
                <h2 class="section-heading">⭐ Top Rated Hosts</h2>
                <p class="section-sub">Handpicked by Eventify for outstanding performance</p>
            </div>

            <div class="hosts-grid">

                {{-- Card 1 --}}
                <div class="host-card">
                    <div class="host-card__img-wrap">
                        <img src="{{ asset('images/Hosts Photos/host1_sophia.jpg') }}"
                             onerror="this.onerror=null;this.src='https://randomuser.me/api/portraits/women/44.jpg';"
                             alt="Sophia Reyes">
                        <span class="host-card__badge">⭐ Top Rated</span>
                        <div class="portfolio-overlay">
                            <p class="portfolio-bio">"I bring elegance and warmth to every event — your dream wedding is my masterpiece."</p>
                            <div class="portfolio-stats">
                                <div class="p-stat"><span class="p-stat__num">320+</span><span class="p-stat__lbl">Events</span></div>
                                <div class="p-stat"><span class="p-stat__num">98%</span><span class="p-stat__lbl">Completion</span></div>
                                <div class="p-stat"><span class="p-stat__num">8 yrs</span><span class="p-stat__lbl">Experience</span></div>
                            </div>
                            <div class="portfolio-tags">
                                <span>💍 Weddings</span><span>🥂 Galas</span><span>🎊 Debuts</span>
                            </div>
                        </div>
                    </div>
                    <div class="host-card__body">
                        <h3 class="host-card__name">Sophia Reyes</h3>
                        <p class="host-card__specialty">Wedding &amp; Gala Specialist</p>
                        <span class="host-card__rating">★★★★★ <small>(128 reviews)</small></span>
                        <div class="host-card__rate">
                            <span class="rate-amount">₱2,500</span>
                            <span class="rate-label">/ hour</span>
                        </div>
                        <button class="host-card__btn" data-bs-toggle="modal" data-bs-target="#loginModal">Book Now</button>
                    </div>
                </div>

                {{-- Card 2 --}}
                <div class="host-card">
                    <div class="host-card__img-wrap">
                        <img src="{{ asset('images/Hosts Photos/host2_andrea.jpg') }}"
                             onerror="this.onerror=null;this.src='https://randomuser.me/api/portraits/women/65.jpg';"
                             alt="Andrea Santos">
                        <span class="host-card__badge host-card__badge--new">✨ New</span>
                        <div class="portfolio-overlay">
                            <p class="portfolio-bio">"Transforming corporate visions into seamless, high-impact conference experiences."</p>
                            <div class="portfolio-stats">
                                <div class="p-stat"><span class="p-stat__num">54+</span><span class="p-stat__lbl">Events</span></div>
                                <div class="p-stat"><span class="p-stat__num">95%</span><span class="p-stat__lbl">Completion</span></div>
                                <div class="p-stat"><span class="p-stat__num">2 yrs</span><span class="p-stat__lbl">Experience</span></div>
                            </div>
                            <div class="portfolio-tags">
                                <span>💼 Corporate</span><span>🎤 Conferences</span><span>🏆 Awards</span>
                            </div>
                        </div>
                    </div>
                    <div class="host-card__body">
                        <h3 class="host-card__name">Andrea Santos</h3>
                        <p class="host-card__specialty">Corporate Events &amp; Conferences</p>
                        <span class="host-card__rating">★★★★☆ <small>(54 reviews)</small></span>
                        <div class="host-card__rate">
                            <span class="rate-amount">₱1,800</span>
                            <span class="rate-label">/ hour</span>
                        </div>
                        <button class="host-card__btn" data-bs-toggle="modal" data-bs-target="#loginModal">Book Now</button>
                    </div>
                </div>

                {{-- Card 3 --}}
                <div class="host-card">
                    <div class="host-card__img-wrap">
                        <img src="{{ asset('images/Hosts Photos/host3_mia.jpg') }}"
                             onerror="this.onerror=null;this.src='https://randomuser.me/api/portraits/women/33.jpg';"
                             alt="Mia Villanueva">
                        <span class="host-card__badge">⭐ Top Rated</span>
                        <div class="portfolio-overlay">
                            <p class="portfolio-bio">"Every birthday is a story — let me help you write the most memorable chapter yet."</p>
                            <div class="portfolio-stats">
                                <div class="p-stat"><span class="p-stat__num">210+</span><span class="p-stat__lbl">Events</span></div>
                                <div class="p-stat"><span class="p-stat__num">99%</span><span class="p-stat__lbl">Completion</span></div>
                                <div class="p-stat"><span class="p-stat__num">5 yrs</span><span class="p-stat__lbl">Experience</span></div>
                            </div>
                            <div class="portfolio-tags">
                                <span>🎂 Birthdays</span><span>🎉 Parties</span><span>👨‍👩‍👧 Family</span>
                            </div>
                        </div>
                    </div>
                    <div class="host-card__body">
                        <h3 class="host-card__name">Mia Villanueva</h3>
                        <p class="host-card__specialty">Birthday &amp; Social Events</p>
                        <span class="host-card__rating">★★★★★ <small>(97 reviews)</small></span>
                        <div class="host-card__rate">
                            <span class="rate-amount">₱2,000</span>
                            <span class="rate-label">/ hour</span>
                        </div>
                        <button class="host-card__btn" data-bs-toggle="modal" data-bs-target="#loginModal">Book Now</button>
                    </div>
                </div>

                {{-- Card 4 --}}
                <div class="host-card">
                    <div class="host-card__img-wrap">
                        <img src="{{ asset('images/Hosts Photos/host4_carla.png') }}"
                             onerror="this.onerror=null;this.src='https://randomuser.me/api/portraits/women/68.jpg';"
                             alt="Carla Mendoza">
                        <span class="host-card__badge">⭐ Top Rated</span>
                        <div class="portfolio-overlay">
                            <p class="portfolio-bio">"Crafting unforgettable debut and formal celebrations with grace, style, and precision."</p>
                            <div class="portfolio-stats">
                                <div class="p-stat"><span class="p-stat__num">450+</span><span class="p-stat__lbl">Events</span></div>
                                <div class="p-stat"><span class="p-stat__num">100%</span><span class="p-stat__lbl">Completion</span></div>
                                <div class="p-stat"><span class="p-stat__num">10 yrs</span><span class="p-stat__lbl">Experience</span></div>
                            </div>
                            <div class="portfolio-tags">
                                <span>👑 Debuts</span><span>🎗️ Formals</span><span>🌹 Galas</span>
                            </div>
                        </div>
                    </div>
                    <div class="host-card__body">
                        <h3 class="host-card__name">Carla Mendoza</h3>
                        <p class="host-card__specialty">Debut &amp; Formal Events</p>
                        <span class="host-card__rating">★★★★★ <small>(213 reviews)</small></span>
                        <div class="host-card__rate">
                            <span class="rate-amount">₱3,200</span>
                            <span class="rate-label">/ hour</span>
                        </div>
                        <button class="host-card__btn" data-bs-toggle="modal" data-bs-target="#loginModal">Book Now</button>
                    </div>
                </div>

                {{-- Card 5 --}}
                <div class="host-card">
                    <div class="host-card__img-wrap">
                        <img src="{{ asset('images/Hosts Photos/host5_marco.png') }}"
                             onerror="this.onerror=null;this.src='https://randomuser.me/api/portraits/men/32.jpg';"
                             alt="Marco Dela Cruz">
                        <div class="portfolio-overlay">
                            <p class="portfolio-bio">"From intimate concerts to massive festivals — I command the stage so you don't have to."</p>
                            <div class="portfolio-stats">
                                <div class="p-stat"><span class="p-stat__num">180+</span><span class="p-stat__lbl">Events</span></div>
                                <div class="p-stat"><span class="p-stat__num">97%</span><span class="p-stat__lbl">Completion</span></div>
                                <div class="p-stat"><span class="p-stat__num">6 yrs</span><span class="p-stat__lbl">Experience</span></div>
                            </div>
                            <div class="portfolio-tags">
                                <span>🎵 Concerts</span><span>🎸 Festivals</span><span>🏟️ Large Venues</span>
                            </div>
                        </div>
                    </div>
                    <div class="host-card__body">
                        <h3 class="host-card__name">Marco Dela Cruz</h3>
                        <p class="host-card__specialty">Concerts &amp; Large Events</p>
                        <span class="host-card__rating">★★★★☆ <small>(76 reviews)</small></span>
                        <div class="host-card__rate">
                            <span class="rate-amount">₱4,000</span>
                            <span class="rate-label">/ hour</span>
                        </div>
                        <button class="host-card__btn" data-bs-toggle="modal" data-bs-target="#loginModal">Book Now</button>
                    </div>
                </div>

            </div>{{-- end top-rated grid --}}

            {{-- ===== SECTION 2: MORE HOSTS ===== --}}
            <div class="hosts-section-label">
                <h2 class="section-heading">🎤 More Hosts</h2>
                <p class="section-sub">Discover more talented professionals for your next event</p>
            </div>

            <div class="hosts-grid">

                {{-- Card 6 --}}
                <div class="host-card">
                    <div class="host-card__img-wrap">
                        <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Rafael Cruz">
                        <span class="host-card__badge host-card__badge--new">✨ New</span>
                        <div class="portfolio-overlay">
                            <p class="portfolio-bio">"Outdoor events are my passion — I turn open fields into magical festival grounds."</p>
                            <div class="portfolio-stats">
                                <div class="p-stat"><span class="p-stat__num">41+</span><span class="p-stat__lbl">Events</span></div>
                                <div class="p-stat"><span class="p-stat__num">94%</span><span class="p-stat__lbl">Completion</span></div>
                                <div class="p-stat"><span class="p-stat__num">3 yrs</span><span class="p-stat__lbl">Experience</span></div>
                            </div>
                            <div class="portfolio-tags">
                                <span>🎪 Festivals</span><span>🌿 Outdoor</span><span>🎶 Music</span>
                            </div>
                        </div>
                    </div>
                    <div class="host-card__body">
                        <h3 class="host-card__name">Rafael Cruz</h3>
                        <p class="host-card__specialty">Music Festivals &amp; Outdoor Events</p>
                        <span class="host-card__rating">★★★★☆ <small>(41 reviews)</small></span>
                        <div class="host-card__rate">
                            <span class="rate-amount">₱3,500</span>
                            <span class="rate-label">/ hour</span>
                        </div>
                        <button class="host-card__btn" data-bs-toggle="modal" data-bs-target="#loginModal">Book Now</button>
                    </div>
                </div>

                {{-- Card 7 --}}
                <div class="host-card">
                    <div class="host-card__img-wrap">
                        <img src="https://randomuser.me/api/portraits/women/12.jpg" alt="Lena Garcia">
                        <div class="portfolio-overlay">
                            <p class="portfolio-bio">"Soft, joyful, and deeply personal — I celebrate every new arrival with heartfelt detail."</p>
                            <div class="portfolio-stats">
                                <div class="p-stat"><span class="p-stat__num">62+</span><span class="p-stat__lbl">Events</span></div>
                                <div class="p-stat"><span class="p-stat__num">100%</span><span class="p-stat__lbl">Completion</span></div>
                                <div class="p-stat"><span class="p-stat__num">3 yrs</span><span class="p-stat__lbl">Experience</span></div>
                            </div>
                            <div class="portfolio-tags">
                                <span>🍼 Baby Showers</span><span>🌸 Christenings</span>
                            </div>
                        </div>
                    </div>
                    <div class="host-card__body">
                        <h3 class="host-card__name">Lena Garcia</h3>
                        <p class="host-card__specialty">Baby Showers &amp; Baby Events</p>
                        <span class="host-card__rating">★★★★★ <small>(62 reviews)</small></span>
                        <div class="host-card__rate">
                            <span class="rate-amount">₱1,500</span>
                            <span class="rate-label">/ hour</span>
                        </div>
                        <button class="host-card__btn" data-bs-toggle="modal" data-bs-target="#loginModal">Book Now</button>
                    </div>
                </div>

                {{-- Card 8 --}}
                <div class="host-card">
                    <div class="host-card__img-wrap">
                        <img src="https://randomuser.me/api/portraits/men/76.jpg" alt="James Lim">
                        <span class="host-card__badge">⭐ Top Rated</span>
                        <div class="portfolio-overlay">
                            <p class="portfolio-bio">"From product launches to tech summits — I deliver polished events that make headlines."</p>
                            <div class="portfolio-stats">
                                <div class="p-stat"><span class="p-stat__num">155+</span><span class="p-stat__lbl">Events</span></div>
                                <div class="p-stat"><span class="p-stat__num">99%</span><span class="p-stat__lbl">Completion</span></div>
                                <div class="p-stat"><span class="p-stat__num">7 yrs</span><span class="p-stat__lbl">Experience</span></div>
                            </div>
                            <div class="portfolio-tags">
                                <span>💻 Tech</span><span>🚀 Launches</span><span>🎯 Summits</span>
                            </div>
                        </div>
                    </div>
                    <div class="host-card__body">
                        <h3 class="host-card__name">James Lim</h3>
                        <p class="host-card__specialty">Tech &amp; Product Launch Events</p>
                        <span class="host-card__rating">★★★★★ <small>(155 reviews)</small></span>
                        <div class="host-card__rate">
                            <span class="rate-amount">₱5,000</span>
                            <span class="rate-label">/ hour</span>
                        </div>
                        <button class="host-card__btn" data-bs-toggle="modal" data-bs-target="#loginModal">Book Now</button>
                    </div>
                </div>

                {{-- Card 9 --}}
                <div class="host-card">
                    <div class="host-card__img-wrap">
                        <img src="https://randomuser.me/api/portraits/women/55.jpg" alt="Patricia Gomez">
                        <div class="portfolio-overlay">
                            <p class="portfolio-bio">"Themed parties that spark imagination — I create worlds where kids (and adults!) get lost."</p>
                            <div class="portfolio-stats">
                                <div class="p-stat"><span class="p-stat__num">88+</span><span class="p-stat__lbl">Events</span></div>
                                <div class="p-stat"><span class="p-stat__num">96%</span><span class="p-stat__lbl">Completion</span></div>
                                <div class="p-stat"><span class="p-stat__num">4 yrs</span><span class="p-stat__lbl">Experience</span></div>
                            </div>
                            <div class="portfolio-tags">
                                <span>🎠 Themed</span><span>🧸 Kids</span><span>🎈 Parties</span>
                            </div>
                        </div>
                    </div>
                    <div class="host-card__body">
                        <h3 class="host-card__name">Patricia Gomez</h3>
                        <p class="host-card__specialty">Themed Parties &amp; Children Events</p>
                        <span class="host-card__rating">★★★★☆ <small>(88 reviews)</small></span>
                        <div class="host-card__rate">
                            <span class="rate-amount">₱1,200</span>
                            <span class="rate-label">/ hour</span>
                        </div>
                        <button class="host-card__btn" data-bs-toggle="modal" data-bs-target="#loginModal">Book Now</button>
                    </div>
                </div>

                {{-- Card 10 --}}
                <div class="host-card">
                    <div class="host-card__img-wrap">
                        <img src="https://randomuser.me/api/portraits/men/23.jpg" alt="Diego Ramos">
                        <span class="host-card__badge host-card__badge--new">✨ New</span>
                        <div class="portfolio-overlay">
                            <p class="portfolio-bio">"High-energy sports events and award nights — I bring the crowd to their feet every time."</p>
                            <div class="portfolio-stats">
                                <div class="p-stat"><span class="p-stat__num">29+</span><span class="p-stat__lbl">Events</span></div>
                                <div class="p-stat"><span class="p-stat__num">93%</span><span class="p-stat__lbl">Completion</span></div>
                                <div class="p-stat"><span class="p-stat__num">2 yrs</span><span class="p-stat__lbl">Experience</span></div>
                            </div>
                            <div class="portfolio-tags">
                                <span>🏅 Sports</span><span>🏆 Awards</span><span>🎖️ Ceremonies</span>
                            </div>
                        </div>
                    </div>
                    <div class="host-card__body">
                        <h3 class="host-card__name">Diego Ramos</h3>
                        <p class="host-card__specialty">Sports &amp; Award Ceremonies</p>
                        <span class="host-card__rating">★★★★☆ <small>(29 reviews)</small></span>
                        <div class="host-card__rate">
                            <span class="rate-amount">₱2,800</span>
                            <span class="rate-label">/ hour</span>
                        </div>
                        <button class="host-card__btn" data-bs-toggle="modal" data-bs-target="#loginModal">Book Now</button>
                    </div>
                </div>

            </div>{{-- end more-hosts grid --}}
        </div>{{-- end hosts-page --}}

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
