{{-- ======================================================================
     Shared Header Partial — HTML ONLY
     All CSS must be loaded in the page's own <head>.
     ====================================================================== --}}

<header class="site-header">

    {{-- Row 1: Nav bar --}}
    <nav class="header-nav">

        {{-- Left: Logo --}}
        <div class="nav-left">
            <a href="{{ url('/') }}" class="logo-link">
                <img class="logo" src="{{ asset('images/Homepage Photos/Eventify Logo.png') }}" alt="Eventify Logo">
            </a>
        </div>

        {{-- Center: Navigation links --}}
        <div class="nav-center">
            <a href="{{ url('/packages') }}" class="nav-link-item {{ request()->is('packages*') ? 'active' : '' }}">Packages</a>
            <a href="{{ url('/services') }}" class="nav-link-item {{ request()->is('services*') ? 'active' : '' }}">Services</a>
        </div>

        {{-- Right: Globe + Burger --}}
        <div class="nav-right">
            <button class="globe-btn" aria-label="Language">
                <span class="material-symbols-outlined">language</span>
            </button>

            <div class="burger" id="burger" aria-label="Menu" role="button" tabindex="0">
                <span></span>
                <span></span>
                <span></span>
            </div>

            {{-- ============================================================
                 Dropdown — two states rendered by Blade:
                    #dropdown-guest  shown when NOT logged in
                    #dropdown-auth   shown when logged in
                 JS toggles visibility after AJAX login/logout.
                 ============================================================ --}}
            <div class="dropdown" id="menu">

                @auth('customer')
                {{-- ── AUTH STATE ───────────────────────────────────────── --}}
                <div id="dropdown-auth">
                    <div class="menu-header">
                        <span class="material-symbols-outlined auth-icon">account_circle</span>
                        Hello, {{ Auth::guard('customer')->user()->first_name }}!
                    </div>
                    <div class="auth-user-info">
                        <span class="material-symbols-outlined user-email-icon">mail</span>
                        {{ Auth::guard('customer')->user()->email }}
                    </div>
                    <div class="auth-actions">
                        <a href="{{ route('profile') }}" class="auth-action-btn profile-btn">
                            <span class="material-symbols-outlined">person</span>
                            My Profile
                        </a>
                        <button class="auth-action-btn signout-btn" onclick="signOut()">
                            <span class="material-symbols-outlined">logout</span>
                            Sign Out
                        </button>
                    </div>
                </div>
                {{-- hidden guest panel (for JS swap after logout) --}}
                <div id="dropdown-guest" style="display:none;">
                    @include('partials.auth-forms')
                </div>

                @else
                {{-- ── GUEST STATE ──────────────────────────────────────── --}}
                <div id="dropdown-guest">
                    @include('partials.auth-forms')
                </div>
                {{-- hidden auth panel (for JS swap after login) --}}
                <div id="dropdown-auth" style="display:none;">
                    <div class="menu-header">
                        <span class="material-symbols-outlined auth-icon">account_circle</span>
                        <span id="auth-greeting">Welcome!</span>
                    </div>
                    <div class="auth-user-info">
                        <span class="material-symbols-outlined user-email-icon">mail</span>
                        <span id="auth-email"></span>
                    </div>
                    <div class="auth-actions">
                        <a href="{{ route('profile') }}" class="auth-action-btn profile-btn">
                            <span class="material-symbols-outlined">person</span>
                            My Profile
                        </a>
                        <button class="auth-action-btn signout-btn" onclick="signOut()">
                            <span class="material-symbols-outlined">logout</span>
                            Sign Out
                        </button>
                    </div>
                </div>

                @endauth

            </div>{{-- end #menu --}}
        </div>{{-- end nav-right --}}
    </nav>{{-- end header-nav --}}

    {{-- Row 2: Search bar --}}
    <div class="header-search">
        <form class="search-pill" action="#" method="GET" id="mainSearchForm">
            <div class="search-field" id="search-where">
                <label for="input-where">
                    <span class="material-symbols-outlined search-field-icon">location_on</span>
                </label>
                <div class="search-field-text">
                    <span class="search-field-label">Where</span>
                    <input type="text" id="input-where" name="where" placeholder="City, venue or area…" autocomplete="off">
                </div>
            </div>
            <div class="search-divider"></div>
            <div class="search-field" id="search-what">
                <label for="input-what">
                    <span class="material-symbols-outlined search-field-icon">star</span>
                </label>
                <div class="search-field-text">
                    <span class="search-field-label">What</span>
                    <input type="text" id="input-what" name="what" placeholder="Package, service or event type…" autocomplete="off">
                </div>
            </div>
            <button type="submit" class="search-btn" aria-label="Search">
                <span class="material-symbols-outlined">search</span>
            </button>
        </form>
    </div>

</header>
