<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Finalize Booking — Eventify</title>
    <meta name="description" content="Finalize your event package booking with Eventify.">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/burger.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Homepage CSS/homePage_top_div.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Homepage CSS/homePage_mid_div.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Registration CSS/Reg_contain_div.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Homepage CSS/hero_banner.css') }}">
    <link rel="stylesheet" href="{{ asset('css/booking.css') }}">

    {{-- Pass auth state to JavaScript --}}
    <script>window.EVENTIFY_IS_AUTH = {{ auth()->check() ? 'true' : 'false' }};</script>

    {{-- ── Sub-service catalogue (PHP → JS) ──────────────────────────── --}}
    <script>
    window.BOOKING_DATA = {
        package:  @json($package),
        services: @json($services),
        catalogue: {
            "Furniture and Set\u2011up": [
                { id:"fs-tables",    label:"Tables",                      price:2000  },
                { id:"fs-chairs",    label:"Chairs",                      price:1800  },
                { id:"fs-linens",    label:"Tablecloths \u0026 linens",   price:1000  },
                { id:"fs-covers",    label:"Chair covers \u0026 ribbons", price:800  },
                { id:"fs-stage",     label:"Stage \/ platform",           price:5000 },
                { id:"fs-podium",    label:"Podium \/ lectern",           price:4500  },
                { id:"fs-tents",     label:"Tents \u0026 canopies",       price:3000 },
                { id:"fs-backdrop",  label:"Backdrop \/ event backdrop",  price:2000 },
                { id:"fs-decor",     label:"Decorations \u0026 centerpieces", price:2500 }
            ],
            "Audio and Visual": [
                { id:"av-sound",       label:"Sound system",                  price:3000 },
                { id:"av-wiredmic",    label:"Wired microphones",             price:400  },
                { id:"av-wirelessmic", label:"Wireless microphones",          price:600  },
                { id:"av-speakers",    label:"Speakers \u0026 monitors",      price:1200 },
                { id:"av-mixer",       label:"Mixer \/ audio console",        price:800  },
                { id:"av-projector",   label:"Projector",                     price:1500 },
                { id:"av-screen",      label:"Projector screen \/ LED screen",price:1800 },
                { id:"av-stagelights", label:"Stage lights \u0026 spotlights",price:2000 },
                { id:"av-uplighting",  label:"LED uplighting",                price:1000 }
            ],
            "Food and Catering": [
                { id:"fc-catering",  label:"Catering service (full-service staff)", price:5000 },
                { id:"fc-buffet",    label:"Buffet tables",                          price:800  },
                { id:"fc-warmers",   label:"Food warmers \/ chafing dishes",         price:600  },
                { id:"fc-plates",    label:"Plates, utensils \u0026 glasses",        price:500  },
                { id:"fc-napkins",   label:"Napkins (cloth \u0026 paper)",            price:200  },
                { id:"fc-drinks",    label:"Drink dispensers \u0026 water stations",  price:400  },
                { id:"fc-dessert",   label:"Dessert \/ cake display table",           price:700  }
            ],
            "Decorations and Theme": [
                { id:"dt-balloon",     label:"Balloon arches \u0026 columns", price:1500 },
                { id:"dt-flowers",     label:"Fresh flower arrangements",      price:2000 },
                { id:"dt-photobooth",  label:"Photo booth setup",              price:3000 },
                { id:"dt-props",       label:"Props \u0026 themed items",      price:800  },
                { id:"dt-signage",     label:"Welcome signage \/ boards",      price:600  },
                { id:"dt-fairylights", label:"Fairy lights \u0026 string lights", price:900 },
                { id:"dt-colortheme",  label:"Custom color theme styling",     price:1200 }
            ],
            "Entertainment": [
                { id:"ent-dj",        label:"Professional DJ",                    price:5000 },
                { id:"ent-band",      label:"Live band performance",              price:8000 },
                { id:"ent-solo",      label:"Solo performers (singer, acoustic)", price:3000 },
                { id:"ent-games",     label:"Games \u0026 group activities",       price:1500 },
                { id:"ent-emcee",     label:"Emcee \/ host services",             price:2500 },
                { id:"ent-slideshow", label:"Slideshow \/ video presentation",     price:1200 },
                { id:"ent-magic",     label:"Magic shows \u0026 special acts",     price:3500 }
            ]
        }
    };
    </script>
</head>
<body>
<div class="wholepage">

    {{-- Shared Header --}}
    @include('partials.header')
    @include('partials.toast')

    {{-- ═══════════════════════════════════════════════
         BOOKING PAGE
    ═══════════════════════════════════════════════ --}}
    <main class="bk-page">

        {{-- Breadcrumb --}}
        <nav class="bk-breadcrumb" aria-label="Breadcrumb">
            <a href="/#packages">Packages</a>
            <span class="sep">›</span>
            <span class="current">Finalize Booking</span>
        </nav>

        {{-- ── 1. Package + Selected Services Summary ──── --}}
        <div class="bk-label">📦 Your Selection</div>
        <div class="bk-summary-card">
            <h1 class="bk-pkg-name">{{ $package ?: 'Event Package' }}</h1>
            <div class="bk-service-tags">
                @forelse($services as $svc)
                    <span class="bk-service-tag">{{ $svc }}</span>
                @empty
                    <span style="color:var(--ev-muted); font-size:.85rem;">No services selected.</span>
                @endforelse
            </div>
        </div>

        <hr class="bk-divider">

        {{-- ── 2. Sub-service Accordions ───────────────── --}}
        <section class="bk-section">
            <h2 class="bk-section-title">
                <span class="icon">🛠️</span> Choose Your Sub-Services
            </h2>

            @php
                /* Normalise the service names coming from packages.js so they
                   match the catalogue keys defined in the JS catalogue object  */
                $keyMap = [
                    'furniture and set‑up'  => 'Furniture and Set‑up',
                    'furniture and setup'   => 'Furniture and Set‑up',
                    'audio and visual'      => 'Audio and Visual',
                    'food and catering'     => 'Food and Catering',
                    'decorations and theme' => 'Decorations and Theme',
                    'entertainment'         => 'Entertainment',
                ];

                $icons = [
                    'Furniture and Set‑up'  => '🪑',
                    'Audio and Visual'      => '🎙️',
                    'Food and Catering'     => '🍽️',
                    'Decorations and Theme' => '🎀',
                    'Entertainment'         => '🎵',
                ];

                $subServices = [
                    'Furniture and Set‑up' => [
                        ['id'=>'fs-tables',    'label'=>'Tables',                       'price'=>500 ],
                        ['id'=>'fs-chairs',    'label'=>'Chairs',                       'price'=>300 ],
                        ['id'=>'fs-linens',    'label'=>'Tablecloths & linens',         'price'=>200 ],
                        ['id'=>'fs-covers',    'label'=>'Chair covers & ribbons',       'price'=>150 ],
                        ['id'=>'fs-stage',     'label'=>'Stage / platform',             'price'=>1500],
                        ['id'=>'fs-podium',    'label'=>'Podium / lectern',             'price'=>800 ],
                        ['id'=>'fs-tents',     'label'=>'Tents & canopies',             'price'=>2000],
                        ['id'=>'fs-backdrop',  'label'=>'Backdrop / event backdrop',   'price'=>1200],
                        ['id'=>'fs-decor',     'label'=>'Decorations & centerpieces',  'price'=>900 ],
                    ],
                    'Audio and Visual' => [
                        ['id'=>'av-sound',       'label'=>'Sound system',                  'price'=>3000],
                        ['id'=>'av-wiredmic',    'label'=>'Wired microphones',             'price'=>400 ],
                        ['id'=>'av-wirelessmic', 'label'=>'Wireless microphones',          'price'=>600 ],
                        ['id'=>'av-speakers',    'label'=>'Speakers & monitors',           'price'=>1200],
                        ['id'=>'av-mixer',       'label'=>'Mixer / audio console',         'price'=>800 ],
                        ['id'=>'av-projector',   'label'=>'Projector',                     'price'=>1500],
                        ['id'=>'av-screen',      'label'=>'Projector screen / LED screen', 'price'=>1800],
                        ['id'=>'av-stagelights', 'label'=>'Stage lights & spotlights',     'price'=>2000],
                        ['id'=>'av-uplighting',  'label'=>'LED uplighting',                'price'=>1000],
                    ],
                    'Food and Catering' => [
                        ['id'=>'fc-catering', 'label'=>'Catering service (full-service staff)', 'price'=>5000],
                        ['id'=>'fc-buffet',   'label'=>'Buffet tables',                          'price'=>800 ],
                        ['id'=>'fc-warmers',  'label'=>'Food warmers / chafing dishes',          'price'=>600 ],
                        ['id'=>'fc-plates',   'label'=>'Plates, utensils & glasses',             'price'=>500 ],
                        ['id'=>'fc-napkins',  'label'=>'Napkins (cloth & paper)',                'price'=>200 ],
                        ['id'=>'fc-drinks',   'label'=>'Drink dispensers & water stations',      'price'=>400 ],
                        ['id'=>'fc-dessert',  'label'=>'Dessert / cake display table',           'price'=>700 ],
                    ],
                    'Decorations and Theme' => [
                        ['id'=>'dt-balloon',    'label'=>'Balloon arches & columns',     'price'=>1500],
                        ['id'=>'dt-flowers',    'label'=>'Fresh flower arrangements',    'price'=>2000],
                        ['id'=>'dt-photobooth', 'label'=>'Photo booth setup',            'price'=>3000],
                        ['id'=>'dt-props',      'label'=>'Props & themed items',         'price'=>800 ],
                        ['id'=>'dt-signage',    'label'=>'Welcome signage / boards',     'price'=>600 ],
                        ['id'=>'dt-fairylights','label'=>'Fairy lights & string lights', 'price'=>900 ],
                        ['id'=>'dt-colortheme', 'label'=>'Custom color theme styling',  'price'=>1200],
                    ],
                    'Entertainment' => [
                        ['id'=>'ent-dj',        'label'=>'Professional DJ',                    'price'=>5000],
                        ['id'=>'ent-band',      'label'=>'Live band performance',              'price'=>8000],
                        ['id'=>'ent-solo',      'label'=>'Solo performers (singer, acoustic)', 'price'=>3000],
                        ['id'=>'ent-games',     'label'=>'Games & group activities',           'price'=>1500],
                        ['id'=>'ent-emcee',     'label'=>'Emcee / host services',             'price'=>2500],
                        ['id'=>'ent-slideshow', 'label'=>'Slideshow / video presentation',    'price'=>1200],
                        ['id'=>'ent-magic',     'label'=>'Magic shows & special acts',        'price'=>3500],
                    ],
                ];
            @endphp

            @if(empty($services))
                <div class="bk-no-selection">
                    <span class="icon">📋</span>
                    No services were selected. <a href="/#packages" style="color:var(--ev-accent)">Go back</a> and choose a package.
                </div>
            @else
                <div class="subsvc-accordion" id="subsvcAccordion">
                    @foreach($services as $svcRaw)
                        @php
                            $normalised = $keyMap[strtolower($svcRaw)] ?? $svcRaw;
                            $subs       = $subServices[$normalised] ?? [];
                            $icon       = $icons[$normalised] ?? '⚙️';
                        @endphp
                        @if(!empty($subs))
                        <div class="subsvc-group" data-service="{{ $normalised }}">
                            <button class="subsvc-header" type="button" aria-expanded="false">
                                <span class="subsvc-header-left">
                                    <span class="subsvc-icon">{{ $icon }}</span>
                                    <span>{{ $normalised }}</span>
                                    <span class="subsvc-badge"></span>
                                </span>
                                <span class="subsvc-chevron">▾</span>
                            </button>
                            <div class="subsvc-body">
                                <div class="subsvc-list">
                                    @foreach($subs as $sub)
                                    <label class="subsvc-item" for="{{ $sub['id'] }}">
                                        <input
                                            type="checkbox"
                                            class="subsvc-cbx"
                                            id="{{ $sub['id'] }}"
                                            data-price="{{ $sub['price'] }}"
                                            data-label="{{ $sub['label'] }}"
                                        >
                                        <div class="subsvc-item__info">
                                            <div class="subsvc-item__name">{{ $sub['label'] }}</div>
                                            <div class="subsvc-item__price">₱{{ number_format($sub['price']) }}</div>
                                        </div>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
            @endif
        </section>

        <hr class="bk-divider">

        {{-- ── 3. Event Details ─────────────────────────── --}}
        <section class="bk-section">
            <h2 class="bk-section-title">
                <span class="icon">📝</span> Event Details
            </h2>
            <div class="bk-inputs-grid">
                <div class="bk-field">
                    <label for="bkGuestCount">How many guests?</label>
                    <input
                        type="number"
                        id="bkGuestCount"
                        name="guest_count"
                        min="1"
                        placeholder="e.g. 100"
                        autocomplete="off"
                    >
                </div>
                <div class="bk-field">
                    <label for="bkEventDate">Event Date</label>
                    <input
                        type="date"
                        id="bkEventDate"
                        name="event_date"
                        min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                    >
                </div>
            </div>
        </section>

        {{-- ── 4. Total Price ───────────────────────────── --}}
        <div class="bk-price-card">
            <div>
                <div class="bk-price-label">Estimated Total</div>
                <div class="bk-price-sub">Base price of sub-services + ₱50 per guest above 50</div>
            </div>
            <div class="bk-price-amount" id="bkTotalAmount">₱0</div>
        </div>

        {{-- ── 5. Review Payment Button ─────────────────── --}}
        <button class="bk-review-btn" id="bkReviewBtn" type="button">
            Review Payment →
        </button>

    </main>

    {{-- ═══════════════════════════════════════════════
         PAYMENT MODAL
    ═══════════════════════════════════════════════ --}}
    <div class="pay-backdrop" id="payBackdrop" role="dialog" aria-modal="true" aria-labelledby="payModalTitle">
        <div class="pay-modal">
            <button class="pay-modal__close" id="payCloseBtn" aria-label="Close">✕</button>

            <h2 class="pay-modal__title" id="payModalTitle">💳 Review Payment</h2>
            <p class="pay-modal__subtitle">Choose your preferred payment method to continue.</p>

            {{-- Amount summary --}}
            <div class="pay-modal__amount">
                <span class="pay-modal__amount-label">Total Amount Due</span>
                <span class="pay-modal__amount-value" id="payModalAmount">₱0</span>
            </div>

            {{-- Payment options --}}
            <div class="pay-options" role="radiogroup" aria-label="Payment Methods">

                <label class="pay-option" for="pay-gcash">
                    <input type="radio" id="pay-gcash" name="payment_method" value="GCash">
                    <span class="pay-option__icon">📱</span>
                    <div class="pay-option__info">
                        <div class="pay-option__name">GCash</div>
                        <div class="pay-option__desc">Pay via GCash mobile wallet</div>
                    </div>
                </label>

                <label class="pay-option" for="pay-maya">
                    <input type="radio" id="pay-maya" name="payment_method" value="Maya">
                    <span class="pay-option__icon">💜</span>
                    <div class="pay-option__info">
                        <div class="pay-option__name">Maya</div>
                        <div class="pay-option__desc">Pay via Maya (formerly PayMaya)</div>
                    </div>
                </label>

                <label class="pay-option" for="pay-card">
                    <input type="radio" id="pay-card" name="payment_method" value="Credit/Debit Card">
                    <span class="pay-option__icon">💳</span>
                    <div class="pay-option__info">
                        <div class="pay-option__name">Credit / Debit Card</div>
                        <div class="pay-option__desc">Visa, Mastercard, JCB accepted</div>
                    </div>
                </label>

                <label class="pay-option" for="pay-bank">
                    <input type="radio" id="pay-bank" name="payment_method" value="Bank Transfer">
                    <span class="pay-option__icon">🏦</span>
                    <div class="pay-option__info">
                        <div class="pay-option__name">Bank Transfer</div>
                        <div class="pay-option__desc">Direct bank deposit / online transfer</div>
                    </div>
                </label>

                <label class="pay-option" for="pay-paypal">
                    <input type="radio" id="pay-paypal" name="payment_method" value="PayPal">
                    <span class="pay-option__icon">🅿️</span>
                    <div class="pay-option__info">
                        <div class="pay-option__name">PayPal</div>
                        <div class="pay-option__desc">Pay securely via PayPal</div>
                    </div>
                </label>

            </div>

            {{-- Book button (disabled until payment is selected) --}}
            <button class="pay-book-btn" id="payBookBtn" type="button" disabled>
                Book Now
            </button>
        </div>
    </div>

</div>{{-- end .wholepage --}}

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('javascript/Burger.js') }}"></script>
<script src="{{ asset('javascript/toast.js') }}"></script>
<script src="{{ asset('javascript/booking.js') }}"></script>
</body>
</html>
