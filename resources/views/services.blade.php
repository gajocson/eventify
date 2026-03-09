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

        {{-- ── Unified 5-card grid ── --}}
        <div class="services-grid">

            {{-- Card 1: Furniture & Setup --}}
            <div class="service-card" data-modal="modal-furniture" role="button" tabindex="0" aria-label="View Furniture & Setup services">
                <div class="card-img-wrap">
                    <img src="{{ asset('images/Services/service_furniture.png') }}" alt="Furniture & Setup" loading="lazy">
                </div>
                <div class="card-body-custom">
                    <span class="card-emoji">🪑</span>
                    <h2 class="card-title-custom">Furniture &amp; Setup</h2>
                    <p class="card-subtitle">Tables, chairs, stages, tents, backdrops, and full event setup.</p>
                    <span class="card-cta">View all items <span class="material-symbols-outlined">arrow_forward</span></span>
                </div>
            </div>

            {{-- Card 2: Audio & Visual --}}
            <div class="service-card" data-modal="modal-audio" role="button" tabindex="0" aria-label="View Audio & Visual services">
                <div class="card-img-wrap">
                    <img src="{{ asset('images/Services/service_audio.png') }}" alt="Audio & Visual" loading="lazy">
                </div>
                <div class="card-body-custom">
                    <span class="card-emoji">🔊</span>
                    <h2 class="card-title-custom">Audio &amp; Visual</h2>
                    <p class="card-subtitle">Sound systems, lighting, projectors, and LED screens for any event.</p>
                    <span class="card-cta">View all items <span class="material-symbols-outlined">arrow_forward</span></span>
                </div>
            </div>

            {{-- Card 3: Food & Catering --}}
            <div class="service-card" data-modal="modal-catering" role="button" tabindex="0" aria-label="View Food & Catering services">
                <div class="card-img-wrap">
                    <img src="{{ asset('images/Services/service_catering.png') }}" alt="Food & Catering" loading="lazy">
                </div>
                <div class="card-body-custom">
                    <span class="card-emoji">🍽️</span>
                    <h2 class="card-title-custom">Food &amp; Catering</h2>
                    <p class="card-subtitle">Full catering setup with buffet, tableware, warmers, and drinks.</p>
                    <span class="card-cta">View all items <span class="material-symbols-outlined">arrow_forward</span></span>
                </div>
            </div>

            {{-- Card 4: Decorations & Theme --}}
            <div class="service-card" data-modal="modal-decorations" role="button" tabindex="0" aria-label="View Decorations & Theme services">
                <div class="card-img-wrap">
                    <img src="{{ asset('images/Services/service_decorations.png') }}" alt="Decorations & Theme" loading="lazy">
                </div>
                <div class="card-body-custom">
                    <span class="card-emoji">🎉</span>
                    <h2 class="card-title-custom">Decorations &amp; Theme</h2>
                    <p class="card-subtitle">Balloons, flowers, photo booths, props, and custom signage.</p>
                    <span class="card-cta">View all items <span class="material-symbols-outlined">arrow_forward</span></span>
                </div>
            </div>

            {{-- Card 5: Entertainment --}}
            <div class="service-card" data-modal="modal-entertainment" role="button" tabindex="0" aria-label="View Entertainment services">
                <div class="card-img-wrap">
                    <img src="{{ asset('images/Services/service_entertainment.png') }}" alt="Entertainment" loading="lazy">
                </div>
                <div class="card-body-custom">
                    <span class="card-emoji">🎵</span>
                    <h2 class="card-title-custom">Entertainment</h2>
                    <p class="card-subtitle">DJs, live bands, performers, and interactive games &amp; activities.</p>
                    <span class="card-cta">View all items <span class="material-symbols-outlined">arrow_forward</span></span>
                </div>
            </div>

        </div><!-- end services-grid -->

    </main>

    {{-- =====================================================
         MODALS
         ===================================================== --}}

    {{-- Modal 1: Furniture & Setup --}}
    <div class="svc-modal-overlay" id="modal-furniture" role="dialog" aria-modal="true" aria-labelledby="modal-furniture-title">
        <div class="svc-modal">
            <div class="svc-modal-header">
                <span class="svc-modal-emoji">🪑</span>
                <h3 class="svc-modal-title" id="modal-furniture-title">Furniture &amp; Setup</h3>
                <button class="svc-modal-close" aria-label="Close">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <div class="svc-modal-body">
                <p class="svc-modal-intro">We provide complete event furniture and setup services to create the perfect atmosphere for your event.</p>
                <ul class="svc-item-list">
                    <li><span class="material-symbols-outlined item-icon">table_restaurant</span> Tables (round, rectangular, cocktail)</li>
                    <li><span class="material-symbols-outlined item-icon">chair</span> Chairs (Chiavari, banquet, folding)</li>
                    <li><span class="material-symbols-outlined item-icon">dry_cleaning</span> Tablecloths &amp; linens</li>
                    <li><span class="material-symbols-outlined item-icon">style</span> Chair covers &amp; ribbons</li>
                    <li><span class="material-symbols-outlined item-icon">foundation</span> Stage / platform</li>
                    <li><span class="material-symbols-outlined item-icon">podium</span> Podium / lectern</li>
                    <li><span class="material-symbols-outlined item-icon">umbrella</span> Tents &amp; canopies</li>
                    <li><span class="material-symbols-outlined item-icon">wallpaper</span> Backdrop / event backdrop</li>
                    <li><span class="material-symbols-outlined item-icon">local_florist</span> Decorations &amp; centerpieces</li>
                </ul>
            </div>
        </div>
    </div>

    {{-- Modal 2: Audio & Visual --}}
    <div class="svc-modal-overlay" id="modal-audio" role="dialog" aria-modal="true" aria-labelledby="modal-audio-title">
        <div class="svc-modal">
            <div class="svc-modal-header">
                <span class="svc-modal-emoji">🔊</span>
                <h3 class="svc-modal-title" id="modal-audio-title">Audio &amp; Visual</h3>
                <button class="svc-modal-close" aria-label="Close">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <div class="svc-modal-body">
                <p class="svc-modal-intro">Professional audio and visual equipment to ensure your event looks and sounds outstanding.</p>
                <ul class="svc-item-list">
                    <li><span class="material-symbols-outlined item-icon">speaker</span> Sound system (PA system, subwoofers)</li>
                    <li><span class="material-symbols-outlined item-icon">mic</span> Wired microphones</li>
                    <li><span class="material-symbols-outlined item-icon">mic_none</span> Wireless microphones</li>
                    <li><span class="material-symbols-outlined item-icon">surround_sound</span> Speakers &amp; monitors</li>
                    <li><span class="material-symbols-outlined item-icon">tune</span> Mixer / audio console</li>
                    <li><span class="material-symbols-outlined item-icon">video_projector</span> Projector</li>
                    <li><span class="material-symbols-outlined item-icon">live_tv</span> Projector screen / LED screen</li>
                    <li><span class="material-symbols-outlined item-icon">light_mode</span> Stage lights &amp; spotlights</li>
                    <li><span class="material-symbols-outlined item-icon">wb_iridescent</span> LED uplighting</li>
                </ul>
            </div>
        </div>
    </div>

    {{-- Modal 3: Food & Catering --}}
    <div class="svc-modal-overlay" id="modal-catering" role="dialog" aria-modal="true" aria-labelledby="modal-catering-title">
        <div class="svc-modal">
            <div class="svc-modal-header">
                <span class="svc-modal-emoji">🍽️</span>
                <h3 class="svc-modal-title" id="modal-catering-title">Food &amp; Catering</h3>
                <button class="svc-modal-close" aria-label="Close">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <div class="svc-modal-body">
                <p class="svc-modal-intro">Full-service catering solutions from buffet setup to elegant plated dining experiences.</p>
                <ul class="svc-item-list">
                    <li><span class="material-symbols-outlined item-icon">restaurant</span> Catering service (full-service staff)</li>
                    <li><span class="material-symbols-outlined item-icon">table_bar</span> Buffet tables</li>
                    <li><span class="material-symbols-outlined item-icon">whatshot</span> Food warmers / chafing dishes</li>
                    <li><span class="material-symbols-outlined item-icon">dining</span> Plates, utensils &amp; glasses</li>
                    <li><span class="material-symbols-outlined item-icon">texture</span> Napkins (cloth &amp; paper)</li>
                    <li><span class="material-symbols-outlined item-icon">local_drink</span> Drink dispensers &amp; water stations</li>
                    <li><span class="material-symbols-outlined item-icon">cake</span> Dessert / cake display table</li>
                </ul>
            </div>
        </div>
    </div>

    {{-- Modal 4: Decorations & Theme --}}
    <div class="svc-modal-overlay" id="modal-decorations" role="dialog" aria-modal="true" aria-labelledby="modal-decorations-title">
        <div class="svc-modal">
            <div class="svc-modal-header">
                <span class="svc-modal-emoji">🎉</span>
                <h3 class="svc-modal-title" id="modal-decorations-title">Decorations &amp; Theme</h3>
                <button class="svc-modal-close" aria-label="Close">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <div class="svc-modal-body">
                <p class="svc-modal-intro">Transform any venue with our themed decorations, installations, and bespoke event styling.</p>
                <ul class="svc-item-list">
                    <li><span class="material-symbols-outlined item-icon">celebration</span> Balloon arches &amp; columns</li>
                    <li><span class="material-symbols-outlined item-icon">local_florist</span> Fresh flower arrangements</li>
                    <li><span class="material-symbols-outlined item-icon">photo_camera</span> Photo booth setup</li>
                    <li><span class="material-symbols-outlined item-icon">category</span> Props &amp; themed items</li>
                    <li><span class="material-symbols-outlined item-icon">sign_language</span> Welcome signage / boards</li>
                    <li><span class="material-symbols-outlined item-icon">star</span> Fairy lights &amp; string lights</li>
                    <li><span class="material-symbols-outlined item-icon">palette</span> Custom color theme styling</li>
                </ul>
            </div>
        </div>
    </div>

    {{-- Modal 5: Entertainment --}}
    <div class="svc-modal-overlay" id="modal-entertainment" role="dialog" aria-modal="true" aria-labelledby="modal-entertainment-title">
        <div class="svc-modal">
            <div class="svc-modal-header">
                <span class="svc-modal-emoji">🎵</span>
                <h3 class="svc-modal-title" id="modal-entertainment-title">Entertainment</h3>
                <button class="svc-modal-close" aria-label="Close">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <div class="svc-modal-body">
                <p class="svc-modal-intro">From live music to interactive experiences, we keep your guests engaged and entertained all night.</p>
                <ul class="svc-item-list">
                    <li><span class="material-symbols-outlined item-icon">queue_music</span> Professional DJ</li>
                    <li><span class="material-symbols-outlined item-icon">music_note</span> Live band performance</li>
                    <li><span class="material-symbols-outlined item-icon">person_play</span> Solo performers (singer, acoustic)</li>
                    <li><span class="material-symbols-outlined item-icon">sports_esports</span> Games &amp; group activities</li>
                    <li><span class="material-symbols-outlined item-icon">theater_comedy</span> Emcee / host services</li>
                    <li><span class="material-symbols-outlined item-icon">display_external_input</span> Slideshow / video presentation</li>
                    <li><span class="material-symbols-outlined item-icon">auto_fix_high</span> Magic shows &amp; special acts</li>
                </ul>
            </div>
        </div>
    </div>

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('javascript/Burger.js') }}"></script>
    <script src="{{ asset('javascript/services.js') }}"></script>
    <script src="{{ asset('javascript/toast.js') }}"></script>

</body>
</html>
