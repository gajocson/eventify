<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>My Profile — Eventify</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/burger.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Homepage CSS/homePage_top_div.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
</head>
<body>

    @include('partials.header')
    @include('partials.toast')

    <main class="profile-page">
        <div class="profile-card">
            <div class="profile-avatar">
                <span class="material-symbols-outlined">account_circle</span>
            </div>
            <h1 class="profile-name">{{ $user->first_name }} {{ $user->last_name }}</h1>
            <p class="profile-email">{{ $user->email }}</p>

            @if($user->phone)
            <p class="profile-meta">
                <span class="material-symbols-outlined">phone</span>
                {{ $user->phone }}
            </p>
            @endif

            @if($user->city)
            <p class="profile-meta">
                <span class="material-symbols-outlined">location_on</span>
                {{ $user->city }}
            </p>
            @endif

            <div class="profile-actions">
                <a href="{{ url('/') }}" class="profile-action-btn back-btn">
                    <span class="material-symbols-outlined">home</span>
                    Back to Home
                </a>
                <button class="profile-action-btn signout-btn" onclick="signOut()">
                    <span class="material-symbols-outlined">logout</span>
                    Sign Out
                </button>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('javascript/Burger.js') }}"></script>
    <script src="{{ asset('javascript/toast.js') }}"></script>
    <script>
        // On this page, signOut() should do a full redirect after logout
        const _originalSignOut = signOut;
        async function signOut() {
            try {
                const res = await fetch('/auth/logout', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                });
                window.location.href = '/';
            } catch(e) {
                window.location.href = '/';
            }
        }
    </script>
</body>
</html>
