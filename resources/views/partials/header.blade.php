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
            <a href="{{ url('/services') }}"  class="nav-link-item {{ request()->is('services*') ? 'active' : '' }}">Services</a>
        </div>

        {{-- Right: Globe + Burger --}}


            <div class="burger" id="burger" aria-label="Menu" role="button" tabindex="0">
                <span></span>
                <span></span>
                <span></span>
            </div>

            {{-- ============================================================
                 Dropdown — three Blade states:
                   1. @guest          → Sign In / Sign Up forms
                   2. @auth + customer → My Profile + Sign Out
                   3. @auth + admin    → Dashboard + Sign Out
                 ============================================================ --}}
            <div class="dropdown" id="menu">

                @auth('customer')

                    @php $authUser = Auth::guard('customer')->user(); @endphp

                    @if($authUser->role === 'admin')
                    {{-- ── ADMIN STATE ─────────────────────────────────────── --}}
                    <div id="dropdown-auth">
                        <div class="menu-header">
                            <span class="material-symbols-outlined auth-icon">admin_panel_settings</span>
                            Hello, Admin {{ $authUser->first_name }}!
                        </div>
                        <div class="auth-user-info">
                            <span class="material-symbols-outlined user-email-icon">mail</span>
                            {{ $authUser->email }}
                        </div>
                        <div class="auth-actions">
                            <a href="{{ route('admin.dashboard') }}" class="auth-action-btn profile-btn">
                                <span class="material-symbols-outlined">dashboard</span>
                                Dashboard
                            </a>
                            <button class="auth-action-btn signout-btn" onclick="signOut()">
                                <span class="material-symbols-outlined">logout</span>
                                Sign Out
                            </button>
                        </div>
                    </div>
                    {{-- Hidden guest panel for JS swap after logout --}}
                    <div id="dropdown-guest" style="display:none;">
                        @include('partials.auth-forms')
                    </div>

                    @else
                    {{-- ── CUSTOMER STATE ──────────────────────────────────── --}}
                    <div id="dropdown-auth">
                        <div class="menu-header">
                            <span class="material-symbols-outlined auth-icon">account_circle</span>
                            Hello, {{ $authUser->first_name }}!
                        </div>
                        <div class="auth-user-info">
                            <span class="material-symbols-outlined user-email-icon">mail</span>
                            {{ $authUser->email }}
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
                    {{-- Hidden guest panel for JS swap after logout --}}
                    <div id="dropdown-guest" style="display:none;">
                        @include('partials.auth-forms')
                    </div>

                    @endif

                @else
                {{-- ── GUEST STATE ─────────────────────────────────────────── --}}
                <div id="dropdown-guest">
                    @include('partials.auth-forms')
                </div>

                {{-- Hidden auth panel — populated by JS after AJAX login --}}
                <div id="dropdown-auth" style="display:none;">
                    <div class="menu-header">
                        <span class="material-symbols-outlined auth-icon" id="auth-icon">account_circle</span>
                        <span id="auth-greeting">Welcome!</span>
                    </div>
                    <div class="auth-user-info">
                        <span class="material-symbols-outlined user-email-icon">mail</span>
                        <span id="auth-email"></span>
                    </div>
                    <div class="auth-actions" id="auth-actions-container">
                        {{-- Populated dynamically by JS based on role --}}
                    </div>
                </div>

                @endauth

            </div>{{-- end #menu --}}
        </div>{{-- end nav-right --}}
    </nav>{{-- end header-nav --}}

</header>
