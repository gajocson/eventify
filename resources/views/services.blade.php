<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Services — Eventify</title>
    <meta name="description" content="Explore Eventify's full range of event services — furniture, audio/visual, catering, decorations, and entertainment.">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/burger.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Homepage CSS/homePage_top_div.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Services CSS/services.css') }}">

    {{-- Pass auth state to JS --}}
    <script>window.EVENTIFY_IS_AUTH = {{ auth()->check() ? 'true' : 'false' }};</script>
</head>
<body>

    {{-- Shared Header (logo, nav, search bar, burger dropdown) --}}
    @include('partials.header')
    @include('partials.toast')

    {{-- =====================================================
         SERVICES CONTENT
         ===================================================== --}}
    <main class="services-page">

        {{-- Page heading --}}
        <div class="services-heading">
            <h1>Our Services</h1>
            <p>Everything you need for a perfect event — all in one place.</p>
        </div>

        {{-- Ala Carte badge --}}
        <div class="ac-page-badge">
            <span class="material-symbols-outlined">shopping_bag</span>
            <span>Click any service card to book individual items <strong>Ala Carte</strong> — mix &amp; match exactly what you need.</span>
        </div>

        {{-- ── Unified 5-card grid ── --}}
        <div class="services-grid">

            {{-- Card 1: Furniture & Setup --}}
            <div class="service-card" data-modal="modal-furniture" role="button" tabindex="0" aria-label="Book Furniture & Setup ala carte">
                <div class="card-img-wrap">
                    <img src="{{ asset('images/Services/service_furniture.png') }}" alt="Furniture & Setup" loading="lazy">
                </div>
                <div class="card-body-custom">
                    <span class="card-emoji">🪑</span>
                    <h2 class="card-title-custom">Furniture &amp; Setup</h2>
                    <p class="card-subtitle">Tables, chairs, stages, tents, backdrops, and full event setup.</p>
                    <span class="card-cta">Book Ala Carte <span class="material-symbols-outlined">arrow_forward</span></span>
                </div>
            </div>

            {{-- Card 2: Audio & Visual --}}
            <div class="service-card" data-modal="modal-audio" role="button" tabindex="0" aria-label="Book Audio & Visual ala carte">
                <div class="card-img-wrap">
                    <img src="{{ asset('images/Services/service_audio.png') }}" alt="Audio & Visual" loading="lazy">
                </div>
                <div class="card-body-custom">
                    <span class="card-emoji">🔊</span>
                    <h2 class="card-title-custom">Audio &amp; Visual</h2>
                    <p class="card-subtitle">Sound systems, lighting, projectors, and LED screens for any event.</p>
                    <span class="card-cta">Book Ala Carte <span class="material-symbols-outlined">arrow_forward</span></span>
                </div>
            </div>

            {{-- Card 3: Food & Catering --}}
            <div class="service-card" data-modal="modal-catering" role="button" tabindex="0" aria-label="Book Food & Catering ala carte">
                <div class="card-img-wrap">
                    <img src="{{ asset('images/Services/service_catering.png') }}" alt="Food & Catering" loading="lazy">
                </div>
                <div class="card-body-custom">
                    <span class="card-emoji">🍽️</span>
                    <h2 class="card-title-custom">Food &amp; Catering</h2>
                    <p class="card-subtitle">Full catering setup with buffet, tableware, warmers, and drinks.</p>
                    <span class="card-cta">Book Ala Carte <span class="material-symbols-outlined">arrow_forward</span></span>
                </div>
            </div>

            {{-- Card 4: Decorations & Theme --}}
            <div class="service-card" data-modal="modal-decorations" role="button" tabindex="0" aria-label="Book Decorations & Theme ala carte">
                <div class="card-img-wrap">
                    <img src="{{ asset('images/Services/service_decorations.png') }}" alt="Decorations & Theme" loading="lazy">
                </div>
                <div class="card-body-custom">
                    <span class="card-emoji">🎉</span>
                    <h2 class="card-title-custom">Decorations &amp; Theme</h2>
                    <p class="card-subtitle">Balloons, flowers, photo booths, props, and custom signage.</p>
                    <span class="card-cta">Book Ala Carte <span class="material-symbols-outlined">arrow_forward</span></span>
                </div>
            </div>

            {{-- Card 5: Entertainment --}}
            <div class="service-card" data-modal="modal-entertainment" role="button" tabindex="0" aria-label="Book Entertainment ala carte">
                <div class="card-img-wrap">
                    <img src="{{ asset('images/Services/service_entertainment.png') }}" alt="Entertainment" loading="lazy">
                </div>
                <div class="card-body-custom">
                    <span class="card-emoji">🎵</span>
                    <h2 class="card-title-custom">Entertainment</h2>
                    <p class="card-subtitle">DJs, live bands, performers, and interactive games &amp; activities.</p>
                    <span class="card-cta">Book Ala Carte <span class="material-symbols-outlined">arrow_forward</span></span>
                </div>
            </div>

        </div><!-- end services-grid -->

    </main>

    {{-- =====================================================
         ALA CARTE SELECTION MODALS (one per service)
         ===================================================== --}}

    {{-- ── Modal 1: Furniture & Setup ────────────────────── --}}
    <div class="svc-modal-overlay" id="modal-furniture" role="dialog" aria-modal="true" aria-labelledby="modal-furniture-title">
        <div class="svc-modal svc-modal--alacarte">
            <div class="svc-modal-header">
                <span class="svc-modal-emoji">🪑</span>
                <div class="svc-modal-header-text">
                    <h3 class="svc-modal-title" id="modal-furniture-title">Furniture &amp; Setup</h3>
                    <p class="svc-modal-subtitle">Ala Carte — select at least 5 items</p>
                </div>
                <button class="svc-modal-close" aria-label="Close">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>

            <div class="svc-modal-body">
                <p class="svc-modal-intro">We provide complete event furniture and setup services. Choose the items you need below.</p>

                {{-- Counter bar --}}
                <div class="ac-counter" id="counter-furniture">
                    <div class="ac-counter-track">
                        <div class="ac-counter-fill" style="width:0%"></div>
                    </div>
                    <span class="ac-counter-text">0 of 5 required selected</span>
                </div>

                {{-- Checkbox list --}}
                <div class="ac-cbx-list">
                    <label class="ac-cbx-item" for="ac-fs-tables">
                        <span class="material-symbols-outlined ac-cbx-icon">table_restaurant</span>
                        <div class="ac-cbx-info">
                            <span class="ac-cbx-name">Tables (round, rectangular, cocktail)</span>
                            <span class="ac-cbx-price">₱2,000</span>
                        </div>
                        <input type="checkbox" class="ac-cbx" id="ac-fs-tables" data-price="2000" data-label="Tables">
                        <span class="ac-cbx-check"><span class="material-symbols-outlined">check</span></span>
                    </label>
                    <label class="ac-cbx-item" for="ac-fs-chairs">
                        <span class="material-symbols-outlined ac-cbx-icon">chair</span>
                        <div class="ac-cbx-info">
                            <span class="ac-cbx-name">Chairs (Chiavari, banquet, folding)</span>
                            <span class="ac-cbx-price">₱1,800</span>
                        </div>
                        <input type="checkbox" class="ac-cbx" id="ac-fs-chairs" data-price="1800" data-label="Chairs">
                        <span class="ac-cbx-check"><span class="material-symbols-outlined">check</span></span>
                    </label>
                    <label class="ac-cbx-item" for="ac-fs-linens">
                        <span class="material-symbols-outlined ac-cbx-icon">dry_cleaning</span>
                        <div class="ac-cbx-info">
                            <span class="ac-cbx-name">Tablecloths &amp; linens</span>
                            <span class="ac-cbx-price">₱1,000</span>
                        </div>
                        <input type="checkbox" class="ac-cbx" id="ac-fs-linens" data-price="1000" data-label="Tablecloths & linens">
                        <span class="ac-cbx-check"><span class="material-symbols-outlined">check</span></span>
                    </label>
                    <label class="ac-cbx-item" for="ac-fs-covers">
                        <span class="material-symbols-outlined ac-cbx-icon">style</span>
                        <div class="ac-cbx-info">
                            <span class="ac-cbx-name">Chair covers &amp; ribbons</span>
                            <span class="ac-cbx-price">₱800</span>
                        </div>
                        <input type="checkbox" class="ac-cbx" id="ac-fs-covers" data-price="800" data-label="Chair covers & ribbons">
                        <span class="ac-cbx-check"><span class="material-symbols-outlined">check</span></span>
                    </label>
                    <label class="ac-cbx-item" for="ac-fs-stage">
                        <span class="material-symbols-outlined ac-cbx-icon">foundation</span>
                        <div class="ac-cbx-info">
                            <span class="ac-cbx-name">Stage / platform</span>
                            <span class="ac-cbx-price">₱5,000</span>
                        </div>
                        <input type="checkbox" class="ac-cbx" id="ac-fs-stage" data-price="5000" data-label="Stage / platform">
                        <span class="ac-cbx-check"><span class="material-symbols-outlined">check</span></span>
                    </label>
                    <label class="ac-cbx-item" for="ac-fs-podium">
                        <span class="material-symbols-outlined ac-cbx-icon">podium</span>
                        <div class="ac-cbx-info">
                            <span class="ac-cbx-name">Podium / lectern</span>
                            <span class="ac-cbx-price">₱4,500</span>
                        </div>
                        <input type="checkbox" class="ac-cbx" id="ac-fs-podium" data-price="4500" data-label="Podium / lectern">
                        <span class="ac-cbx-check"><span class="material-symbols-outlined">check</span></span>
                    </label>
                    <label class="ac-cbx-item" for="ac-fs-tents">
                        <span class="material-symbols-outlined ac-cbx-icon">umbrella</span>
                        <div class="ac-cbx-info">
                            <span class="ac-cbx-name">Tents &amp; canopies</span>
                            <span class="ac-cbx-price">₱3,000</span>
                        </div>
                        <input type="checkbox" class="ac-cbx" id="ac-fs-tents" data-price="3000" data-label="Tents & canopies">
                        <span class="ac-cbx-check"><span class="material-symbols-outlined">check</span></span>
                    </label>
                    <label class="ac-cbx-item" for="ac-fs-backdrop">
                        <span class="material-symbols-outlined ac-cbx-icon">wallpaper</span>
                        <div class="ac-cbx-info">
                            <span class="ac-cbx-name">Backdrop / event backdrop</span>
                            <span class="ac-cbx-price">₱2,000</span>
                        </div>
                        <input type="checkbox" class="ac-cbx" id="ac-fs-backdrop" data-price="2000" data-label="Backdrop / event backdrop">
                        <span class="ac-cbx-check"><span class="material-symbols-outlined">check</span></span>
                    </label>
                    <label class="ac-cbx-item" for="ac-fs-decor">
                        <span class="material-symbols-outlined ac-cbx-icon">local_florist</span>
                        <div class="ac-cbx-info">
                            <span class="ac-cbx-name">Decorations &amp; centerpieces</span>
                            <span class="ac-cbx-price">₱2,500</span>
                        </div>
                        <input type="checkbox" class="ac-cbx" id="ac-fs-decor" data-price="2500" data-label="Decorations & centerpieces">
                        <span class="ac-cbx-check"><span class="material-symbols-outlined">check</span></span>
                    </label>
                </div>
            </div>

            <div class="svc-modal-footer">
                <div class="ac-subtotal">
                    Subtotal: <strong class="ac-subtotal-val">₱0</strong>
                </div>
                <button class="ac-book-btn" disabled data-service="Furniture and Setup">
                    <span class="material-symbols-outlined">shopping_cart</span>
                    Book Now
                </button>
            </div>
        </div>
    </div>

    {{-- ── Modal 2: Audio & Visual ────────────────────────── --}}
    <div class="svc-modal-overlay" id="modal-audio" role="dialog" aria-modal="true" aria-labelledby="modal-audio-title">
        <div class="svc-modal svc-modal--alacarte">
            <div class="svc-modal-header">
                <span class="svc-modal-emoji">🔊</span>
                <div class="svc-modal-header-text">
                    <h3 class="svc-modal-title" id="modal-audio-title">Audio &amp; Visual</h3>
                    <p class="svc-modal-subtitle">Ala Carte — select at least 5 items</p>
                </div>
                <button class="svc-modal-close" aria-label="Close">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>

            <div class="svc-modal-body">
                <p class="svc-modal-intro">Professional audio and visual equipment to ensure your event looks and sounds outstanding.</p>

                <div class="ac-counter" id="counter-audio">
                    <div class="ac-counter-track">
                        <div class="ac-counter-fill" style="width:0%"></div>
                    </div>
                    <span class="ac-counter-text">0 of 5 required selected</span>
                </div>

                <div class="ac-cbx-list">
                    <label class="ac-cbx-item" for="ac-av-sound">
                        <span class="material-symbols-outlined ac-cbx-icon">speaker</span>
                        <div class="ac-cbx-info">
                            <span class="ac-cbx-name">Sound system (PA system, subwoofers)</span>
                            <span class="ac-cbx-price">₱3,000</span>
                        </div>
                        <input type="checkbox" class="ac-cbx" id="ac-av-sound" data-price="3000" data-label="Sound system">
                        <span class="ac-cbx-check"><span class="material-symbols-outlined">check</span></span>
                    </label>
                    <label class="ac-cbx-item" for="ac-av-wiredmic">
                        <span class="material-symbols-outlined ac-cbx-icon">mic</span>
                        <div class="ac-cbx-info">
                            <span class="ac-cbx-name">Wired microphones</span>
                            <span class="ac-cbx-price">₱400</span>
                        </div>
                        <input type="checkbox" class="ac-cbx" id="ac-av-wiredmic" data-price="400" data-label="Wired microphones">
                        <span class="ac-cbx-check"><span class="material-symbols-outlined">check</span></span>
                    </label>
                    <label class="ac-cbx-item" for="ac-av-wirelessmic">
                        <span class="material-symbols-outlined ac-cbx-icon">mic_none</span>
                        <div class="ac-cbx-info">
                            <span class="ac-cbx-name">Wireless microphones</span>
                            <span class="ac-cbx-price">₱600</span>
                        </div>
                        <input type="checkbox" class="ac-cbx" id="ac-av-wirelessmic" data-price="600" data-label="Wireless microphones">
                        <span class="ac-cbx-check"><span class="material-symbols-outlined">check</span></span>
                    </label>
                    <label class="ac-cbx-item" for="ac-av-speakers">
                        <span class="material-symbols-outlined ac-cbx-icon">surround_sound</span>
                        <div class="ac-cbx-info">
                            <span class="ac-cbx-name">Speakers &amp; monitors</span>
                            <span class="ac-cbx-price">₱1,200</span>
                        </div>
                        <input type="checkbox" class="ac-cbx" id="ac-av-speakers" data-price="1200" data-label="Speakers & monitors">
                        <span class="ac-cbx-check"><span class="material-symbols-outlined">check</span></span>
                    </label>
                    <label class="ac-cbx-item" for="ac-av-mixer">
                        <span class="material-symbols-outlined ac-cbx-icon">tune</span>
                        <div class="ac-cbx-info">
                            <span class="ac-cbx-name">Mixer / audio console</span>
                            <span class="ac-cbx-price">₱800</span>
                        </div>
                        <input type="checkbox" class="ac-cbx" id="ac-av-mixer" data-price="800" data-label="Mixer / audio console">
                        <span class="ac-cbx-check"><span class="material-symbols-outlined">check</span></span>
                    </label>
                    <label class="ac-cbx-item" for="ac-av-projector">
                        <span class="material-symbols-outlined ac-cbx-icon">video_projector</span>
                        <div class="ac-cbx-info">
                            <span class="ac-cbx-name">Projector</span>
                            <span class="ac-cbx-price">₱1,500</span>
                        </div>
                        <input type="checkbox" class="ac-cbx" id="ac-av-projector" data-price="1500" data-label="Projector">
                        <span class="ac-cbx-check"><span class="material-symbols-outlined">check</span></span>
                    </label>
                    <label class="ac-cbx-item" for="ac-av-screen">
                        <span class="material-symbols-outlined ac-cbx-icon">live_tv</span>
                        <div class="ac-cbx-info">
                            <span class="ac-cbx-name">Projector screen / LED screen</span>
                            <span class="ac-cbx-price">₱1,800</span>
                        </div>
                        <input type="checkbox" class="ac-cbx" id="ac-av-screen" data-price="1800" data-label="Projector screen / LED screen">
                        <span class="ac-cbx-check"><span class="material-symbols-outlined">check</span></span>
                    </label>
                    <label class="ac-cbx-item" for="ac-av-stagelights">
                        <span class="material-symbols-outlined ac-cbx-icon">light_mode</span>
                        <div class="ac-cbx-info">
                            <span class="ac-cbx-name">Stage lights &amp; spotlights</span>
                            <span class="ac-cbx-price">₱2,000</span>
                        </div>
                        <input type="checkbox" class="ac-cbx" id="ac-av-stagelights" data-price="2000" data-label="Stage lights & spotlights">
                        <span class="ac-cbx-check"><span class="material-symbols-outlined">check</span></span>
                    </label>
                    <label class="ac-cbx-item" for="ac-av-uplighting">
                        <span class="material-symbols-outlined ac-cbx-icon">wb_iridescent</span>
                        <div class="ac-cbx-info">
                            <span class="ac-cbx-name">LED uplighting</span>
                            <span class="ac-cbx-price">₱1,000</span>
                        </div>
                        <input type="checkbox" class="ac-cbx" id="ac-av-uplighting" data-price="1000" data-label="LED uplighting">
                        <span class="ac-cbx-check"><span class="material-symbols-outlined">check</span></span>
                    </label>
                </div>
            </div>

            <div class="svc-modal-footer">
                <div class="ac-subtotal">
                    Subtotal: <strong class="ac-subtotal-val">₱0</strong>
                </div>
                <button class="ac-book-btn" disabled data-service="Audio and Visual">
                    <span class="material-symbols-outlined">shopping_cart</span>
                    Book Now
                </button>
            </div>
        </div>
    </div>

    {{-- ── Modal 3: Food & Catering ────────────────────────── --}}
    <div class="svc-modal-overlay" id="modal-catering" role="dialog" aria-modal="true" aria-labelledby="modal-catering-title">
        <div class="svc-modal svc-modal--alacarte">
            <div class="svc-modal-header">
                <span class="svc-modal-emoji">🍽️</span>
                <div class="svc-modal-header-text">
                    <h3 class="svc-modal-title" id="modal-catering-title">Food &amp; Catering</h3>
                    <p class="svc-modal-subtitle">Ala Carte — select at least 5 items</p>
                </div>
                <button class="svc-modal-close" aria-label="Close">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>

            <div class="svc-modal-body">
                <p class="svc-modal-intro">Full-service catering solutions from buffet setup to elegant plated dining experiences.</p>

                <div class="ac-counter" id="counter-catering">
                    <div class="ac-counter-track">
                        <div class="ac-counter-fill" style="width:0%"></div>
                    </div>
                    <span class="ac-counter-text">0 of 5 required selected</span>
                </div>

                <div class="ac-cbx-list">
                    <label class="ac-cbx-item" for="ac-fc-catering">
                        <span class="material-symbols-outlined ac-cbx-icon">restaurant</span>
                        <div class="ac-cbx-info">
                            <span class="ac-cbx-name">Catering service (full-service staff)</span>
                            <span class="ac-cbx-price">₱5,000</span>
                        </div>
                        <input type="checkbox" class="ac-cbx" id="ac-fc-catering" data-price="5000" data-label="Catering service">
                        <span class="ac-cbx-check"><span class="material-symbols-outlined">check</span></span>
                    </label>
                    <label class="ac-cbx-item" for="ac-fc-buffet">
                        <span class="material-symbols-outlined ac-cbx-icon">table_bar</span>
                        <div class="ac-cbx-info">
                            <span class="ac-cbx-name">Buffet tables</span>
                            <span class="ac-cbx-price">₱800</span>
                        </div>
                        <input type="checkbox" class="ac-cbx" id="ac-fc-buffet" data-price="800" data-label="Buffet tables">
                        <span class="ac-cbx-check"><span class="material-symbols-outlined">check</span></span>
                    </label>
                    <label class="ac-cbx-item" for="ac-fc-warmers">
                        <span class="material-symbols-outlined ac-cbx-icon">whatshot</span>
                        <div class="ac-cbx-info">
                            <span class="ac-cbx-name">Food warmers / chafing dishes</span>
                            <span class="ac-cbx-price">₱600</span>
                        </div>
                        <input type="checkbox" class="ac-cbx" id="ac-fc-warmers" data-price="600" data-label="Food warmers / chafing dishes">
                        <span class="ac-cbx-check"><span class="material-symbols-outlined">check</span></span>
                    </label>
                    <label class="ac-cbx-item" for="ac-fc-plates">
                        <span class="material-symbols-outlined ac-cbx-icon">dining</span>
                        <div class="ac-cbx-info">
                            <span class="ac-cbx-name">Plates, utensils &amp; glasses</span>
                            <span class="ac-cbx-price">₱500</span>
                        </div>
                        <input type="checkbox" class="ac-cbx" id="ac-fc-plates" data-price="500" data-label="Plates, utensils & glasses">
                        <span class="ac-cbx-check"><span class="material-symbols-outlined">check</span></span>
                    </label>
                    <label class="ac-cbx-item" for="ac-fc-napkins">
                        <span class="material-symbols-outlined ac-cbx-icon">texture</span>
                        <div class="ac-cbx-info">
                            <span class="ac-cbx-name">Napkins (cloth &amp; paper)</span>
                            <span class="ac-cbx-price">₱200</span>
                        </div>
                        <input type="checkbox" class="ac-cbx" id="ac-fc-napkins" data-price="200" data-label="Napkins">
                        <span class="ac-cbx-check"><span class="material-symbols-outlined">check</span></span>
                    </label>
                    <label class="ac-cbx-item" for="ac-fc-drinks">
                        <span class="material-symbols-outlined ac-cbx-icon">local_drink</span>
                        <div class="ac-cbx-info">
                            <span class="ac-cbx-name">Drink dispensers &amp; water stations</span>
                            <span class="ac-cbx-price">₱400</span>
                        </div>
                        <input type="checkbox" class="ac-cbx" id="ac-fc-drinks" data-price="400" data-label="Drink dispensers & water stations">
                        <span class="ac-cbx-check"><span class="material-symbols-outlined">check</span></span>
                    </label>
                    <label class="ac-cbx-item" for="ac-fc-dessert">
                        <span class="material-symbols-outlined ac-cbx-icon">cake</span>
                        <div class="ac-cbx-info">
                            <span class="ac-cbx-name">Dessert / cake display table</span>
                            <span class="ac-cbx-price">₱700</span>
                        </div>
                        <input type="checkbox" class="ac-cbx" id="ac-fc-dessert" data-price="700" data-label="Dessert / cake display table">
                        <span class="ac-cbx-check"><span class="material-symbols-outlined">check</span></span>
                    </label>
                </div>
            </div>

            <div class="svc-modal-footer">
                <div class="ac-subtotal">
                    Subtotal: <strong class="ac-subtotal-val">₱0</strong>
                </div>
                <button class="ac-book-btn" disabled data-service="Food and Catering">
                    <span class="material-symbols-outlined">shopping_cart</span>
                    Book Now
                </button>
            </div>
        </div>
    </div>

    {{-- ── Modal 4: Decorations & Theme ────────────────────── --}}
    <div class="svc-modal-overlay" id="modal-decorations" role="dialog" aria-modal="true" aria-labelledby="modal-decorations-title">
        <div class="svc-modal svc-modal--alacarte">
            <div class="svc-modal-header">
                <span class="svc-modal-emoji">🎉</span>
                <div class="svc-modal-header-text">
                    <h3 class="svc-modal-title" id="modal-decorations-title">Decorations &amp; Theme</h3>
                    <p class="svc-modal-subtitle">Ala Carte — select at least 5 items</p>
                </div>
                <button class="svc-modal-close" aria-label="Close">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>

            <div class="svc-modal-body">
                <p class="svc-modal-intro">Transform any venue with our themed decorations, installations, and bespoke event styling.</p>

                <div class="ac-counter" id="counter-decorations">
                    <div class="ac-counter-track">
                        <div class="ac-counter-fill" style="width:0%"></div>
                    </div>
                    <span class="ac-counter-text">0 of 5 required selected</span>
                </div>

                <div class="ac-cbx-list">
                    <label class="ac-cbx-item" for="ac-dt-balloon">
                        <span class="material-symbols-outlined ac-cbx-icon">celebration</span>
                        <div class="ac-cbx-info">
                            <span class="ac-cbx-name">Balloon arches &amp; columns</span>
                            <span class="ac-cbx-price">₱1,500</span>
                        </div>
                        <input type="checkbox" class="ac-cbx" id="ac-dt-balloon" data-price="1500" data-label="Balloon arches & columns">
                        <span class="ac-cbx-check"><span class="material-symbols-outlined">check</span></span>
                    </label>
                    <label class="ac-cbx-item" for="ac-dt-flowers">
                        <span class="material-symbols-outlined ac-cbx-icon">local_florist</span>
                        <div class="ac-cbx-info">
                            <span class="ac-cbx-name">Fresh flower arrangements</span>
                            <span class="ac-cbx-price">₱2,000</span>
                        </div>
                        <input type="checkbox" class="ac-cbx" id="ac-dt-flowers" data-price="2000" data-label="Fresh flower arrangements">
                        <span class="ac-cbx-check"><span class="material-symbols-outlined">check</span></span>
                    </label>
                    <label class="ac-cbx-item" for="ac-dt-photobooth">
                        <span class="material-symbols-outlined ac-cbx-icon">photo_camera</span>
                        <div class="ac-cbx-info">
                            <span class="ac-cbx-name">Photo booth setup</span>
                            <span class="ac-cbx-price">₱3,000</span>
                        </div>
                        <input type="checkbox" class="ac-cbx" id="ac-dt-photobooth" data-price="3000" data-label="Photo booth setup">
                        <span class="ac-cbx-check"><span class="material-symbols-outlined">check</span></span>
                    </label>
                    <label class="ac-cbx-item" for="ac-dt-props">
                        <span class="material-symbols-outlined ac-cbx-icon">category</span>
                        <div class="ac-cbx-info">
                            <span class="ac-cbx-name">Props &amp; themed items</span>
                            <span class="ac-cbx-price">₱800</span>
                        </div>
                        <input type="checkbox" class="ac-cbx" id="ac-dt-props" data-price="800" data-label="Props & themed items">
                        <span class="ac-cbx-check"><span class="material-symbols-outlined">check</span></span>
                    </label>
                    <label class="ac-cbx-item" for="ac-dt-signage">
                        <span class="material-symbols-outlined ac-cbx-icon">sign_language</span>
                        <div class="ac-cbx-info">
                            <span class="ac-cbx-name">Welcome signage / boards</span>
                            <span class="ac-cbx-price">₱600</span>
                        </div>
                        <input type="checkbox" class="ac-cbx" id="ac-dt-signage" data-price="600" data-label="Welcome signage / boards">
                        <span class="ac-cbx-check"><span class="material-symbols-outlined">check</span></span>
                    </label>
                    <label class="ac-cbx-item" for="ac-dt-fairylights">
                        <span class="material-symbols-outlined ac-cbx-icon">star</span>
                        <div class="ac-cbx-info">
                            <span class="ac-cbx-name">Fairy lights &amp; string lights</span>
                            <span class="ac-cbx-price">₱900</span>
                        </div>
                        <input type="checkbox" class="ac-cbx" id="ac-dt-fairylights" data-price="900" data-label="Fairy lights & string lights">
                        <span class="ac-cbx-check"><span class="material-symbols-outlined">check</span></span>
                    </label>
                    <label class="ac-cbx-item" for="ac-dt-colortheme">
                        <span class="material-symbols-outlined ac-cbx-icon">palette</span>
                        <div class="ac-cbx-info">
                            <span class="ac-cbx-name">Custom color theme styling</span>
                            <span class="ac-cbx-price">₱1,200</span>
                        </div>
                        <input type="checkbox" class="ac-cbx" id="ac-dt-colortheme" data-price="1200" data-label="Custom color theme styling">
                        <span class="ac-cbx-check"><span class="material-symbols-outlined">check</span></span>
                    </label>
                </div>
            </div>

            <div class="svc-modal-footer">
                <div class="ac-subtotal">
                    Subtotal: <strong class="ac-subtotal-val">₱0</strong>
                </div>
                <button class="ac-book-btn" disabled data-service="Decorations and Theme">
                    <span class="material-symbols-outlined">shopping_cart</span>
                    Book Now
                </button>
            </div>
        </div>
    </div>

    {{-- ── Modal 5: Entertainment ────────────────────────────── --}}
    <div class="svc-modal-overlay" id="modal-entertainment" role="dialog" aria-modal="true" aria-labelledby="modal-entertainment-title">
        <div class="svc-modal svc-modal--alacarte">
            <div class="svc-modal-header">
                <span class="svc-modal-emoji">🎵</span>
                <div class="svc-modal-header-text">
                    <h3 class="svc-modal-title" id="modal-entertainment-title">Entertainment</h3>
                    <p class="svc-modal-subtitle">Ala Carte — select at least 5 items</p>
                </div>
                <button class="svc-modal-close" aria-label="Close">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>

            <div class="svc-modal-body">
                <p class="svc-modal-intro">From live music to interactive experiences, we keep your guests engaged and entertained all night.</p>

                <div class="ac-counter" id="counter-entertainment">
                    <div class="ac-counter-track">
                        <div class="ac-counter-fill" style="width:0%"></div>
                    </div>
                    <span class="ac-counter-text">0 of 5 required selected</span>
                </div>

                <div class="ac-cbx-list">
                    <label class="ac-cbx-item" for="ac-ent-dj">
                        <span class="material-symbols-outlined ac-cbx-icon">queue_music</span>
                        <div class="ac-cbx-info">
                            <span class="ac-cbx-name">Professional DJ</span>
                            <span class="ac-cbx-price">₱5,000</span>
                        </div>
                        <input type="checkbox" class="ac-cbx" id="ac-ent-dj" data-price="5000" data-label="Professional DJ">
                        <span class="ac-cbx-check"><span class="material-symbols-outlined">check</span></span>
                    </label>
                    <label class="ac-cbx-item" for="ac-ent-band">
                        <span class="material-symbols-outlined ac-cbx-icon">music_note</span>
                        <div class="ac-cbx-info">
                            <span class="ac-cbx-name">Live band performance</span>
                            <span class="ac-cbx-price">₱8,000</span>
                        </div>
                        <input type="checkbox" class="ac-cbx" id="ac-ent-band" data-price="8000" data-label="Live band performance">
                        <span class="ac-cbx-check"><span class="material-symbols-outlined">check</span></span>
                    </label>
                    <label class="ac-cbx-item" for="ac-ent-solo">
                        <span class="material-symbols-outlined ac-cbx-icon">person_play</span>
                        <div class="ac-cbx-info">
                            <span class="ac-cbx-name">Solo performers (singer, acoustic)</span>
                            <span class="ac-cbx-price">₱3,000</span>
                        </div>
                        <input type="checkbox" class="ac-cbx" id="ac-ent-solo" data-price="3000" data-label="Solo performers">
                        <span class="ac-cbx-check"><span class="material-symbols-outlined">check</span></span>
                    </label>
                    <label class="ac-cbx-item" for="ac-ent-games">
                        <span class="material-symbols-outlined ac-cbx-icon">sports_esports</span>
                        <div class="ac-cbx-info">
                            <span class="ac-cbx-name">Games &amp; group activities</span>
                            <span class="ac-cbx-price">₱1,500</span>
                        </div>
                        <input type="checkbox" class="ac-cbx" id="ac-ent-games" data-price="1500" data-label="Games & group activities">
                        <span class="ac-cbx-check"><span class="material-symbols-outlined">check</span></span>
                    </label>
                    <label class="ac-cbx-item" for="ac-ent-emcee">
                        <span class="material-symbols-outlined ac-cbx-icon">theater_comedy</span>
                        <div class="ac-cbx-info">
                            <span class="ac-cbx-name">Emcee / host services</span>
                            <span class="ac-cbx-price">₱2,500</span>
                        </div>
                        <input type="checkbox" class="ac-cbx" id="ac-ent-emcee" data-price="2500" data-label="Emcee / host services">
                        <span class="ac-cbx-check"><span class="material-symbols-outlined">check</span></span>
                    </label>
                    <label class="ac-cbx-item" for="ac-ent-slideshow">
                        <span class="material-symbols-outlined ac-cbx-icon">display_external_input</span>
                        <div class="ac-cbx-info">
                            <span class="ac-cbx-name">Slideshow / video presentation</span>
                            <span class="ac-cbx-price">₱1,200</span>
                        </div>
                        <input type="checkbox" class="ac-cbx" id="ac-ent-slideshow" data-price="1200" data-label="Slideshow / video presentation">
                        <span class="ac-cbx-check"><span class="material-symbols-outlined">check</span></span>
                    </label>
                    <label class="ac-cbx-item" for="ac-ent-magic">
                        <span class="material-symbols-outlined ac-cbx-icon">auto_fix_high</span>
                        <div class="ac-cbx-info">
                            <span class="ac-cbx-name">Magic shows &amp; special acts</span>
                            <span class="ac-cbx-price">₱3,500</span>
                        </div>
                        <input type="checkbox" class="ac-cbx" id="ac-ent-magic" data-price="3500" data-label="Magic shows & special acts">
                        <span class="ac-cbx-check"><span class="material-symbols-outlined">check</span></span>
                    </label>
                </div>
            </div>

            <div class="svc-modal-footer">
                <div class="ac-subtotal">
                    Subtotal: <strong class="ac-subtotal-val">₱0</strong>
                </div>
                <button class="ac-book-btn" disabled data-service="Entertainment">
                    <span class="material-symbols-outlined">shopping_cart</span>
                    Book Now
                </button>
            </div>
        </div>
    </div>

    {{-- =====================================================
         BOOKING CONFIRMATION MODAL
         ===================================================== --}}
    <div class="ac-confirm-overlay" id="acConfirmOverlay" role="dialog" aria-modal="true" aria-labelledby="acConfirmTitle">
        <div class="ac-confirm-modal">
            <div class="ac-confirm-header">
                <span class="ac-confirm-emoji">🛒</span>
                <h3 class="ac-confirm-title" id="acConfirmTitle">Confirm Ala Carte Booking</h3>
            </div>
            <div class="ac-confirm-body">
                <div class="ac-confirm-service" id="acConfirmService"></div>
                <div class="ac-confirm-items" id="acConfirmItems"></div>
                <div class="ac-confirm-total">
                    <span>Subtotal (items only)</span>
                    <strong id="acConfirmTotal">₱0</strong>
                </div>
                <p class="ac-confirm-note">
                    <span class="material-symbols-outlined" style="font-size:14px;vertical-align:middle;">info</span>
                    Guest count, event date, and final price will be set on the next page.
                </p>
            </div>
            <div class="ac-confirm-footer">
                <button class="ac-confirm-cancel" id="acConfirmCancel">Back</button>
                <button class="ac-confirm-proceed" id="acConfirmProceed">
                    <span class="material-symbols-outlined">arrow_forward</span>
                    Continue to Booking
                </button>
            </div>
        </div>
    </div>

    {{-- Hidden form to POST to /booking --}}
    <form id="acBookingForm" method="POST" action="{{ route('booking.show') }}" style="display:none;">
        @csrf
        <input type="hidden" name="package" id="acFormPackage">
        <input type="hidden" name="services[]" id="acFormService">
    </form>

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('javascript/Burger.js') }}"></script>
    <script src="{{ asset('javascript/services.js') }}"></script>
    <script src="{{ asset('javascript/toast.js') }}"></script>

</body>
</html>
