<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard — Eventify</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/burger.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Homepage CSS/homePage_top_div.css') }}">
    <style>
        *, *::before, *::after { box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: #f4f0fb;
            margin: 0;
            color: #1a0a2e;
        }

        /* ── Page shell ── */
        .admin-page {
            max-width: 1100px;
            margin: 0 auto;
            padding: 40px 24px 60px;
        }

        /* ── Welcome banner ── */
        .admin-banner {
            background: linear-gradient(135deg, #6b3da6, #8b4cc8);
            border-radius: 24px;
            padding: 36px 40px;
            color: #fff;
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 36px;
            box-shadow: 0 12px 40px rgba(107, 61, 154, 0.30);
        }

        .admin-banner__icon {
            font-size: 56px;
            background: rgba(255,255,255,0.15);
            border-radius: 18px;
            width: 88px;
            height: 88px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .admin-banner__title {
            font-size: clamp(22px, 3vw, 34px);
            font-weight: 800;
            margin: 0 0 6px;
            line-height: 1.1;
        }

        .admin-banner__sub {
            font-size: 15px;
            opacity: 0.85;
            margin: 0;
        }

        .admin-badge {
            display: inline-block;
            background: rgba(255,255,255,0.2);
            border: 1px solid rgba(255,255,255,0.35);
            border-radius: 50px;
            padding: 3px 12px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        /* ── Stats grid ── */
        .admin-stats {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 36px;
        }

        .stat-card {
            background: #fff;
            border-radius: 18px;
            padding: 24px 22px;
            border: 1.5px solid #ede8f5;
            box-shadow: 0 4px 16px rgba(107,61,154,0.07);
        }

        .stat-card__icon {
            font-size: 28px;
            margin-bottom: 12px;
        }

        .stat-card__label {
            font-size: 12px;
            font-weight: 600;
            color: #8b7aa8;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: 6px;
        }

        .stat-card__value {
            font-size: 28px;
            font-weight: 800;
            color: #1a0a2e;
        }

        /* ── Quick actions ── */
        .admin-section-title {
            font-size: 18px;
            font-weight: 700;
            color: #1a0a2e;
            margin: 0 0 16px;
        }

        .admin-actions {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 16px;
            margin-bottom: 36px;
        }

        .admin-action-card {
            background: #fff;
            border-radius: 18px;
            padding: 22px 20px;
            border: 1.5px solid #ede8f5;
            box-shadow: 0 4px 16px rgba(107,61,154,0.07);
            cursor: pointer;
            transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.2s;
            text-decoration: none;
            color: inherit;
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .admin-action-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 14px 36px rgba(107,61,154,0.14);
            border-color: #c4a9e0;
            color: inherit;
            text-decoration: none;
        }

        .admin-action-card__icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            background: linear-gradient(135deg, #f3eafd, #e8d5f9);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            flex-shrink: 0;
        }

        .admin-action-card__label {
            font-size: 14px;
            font-weight: 700;
            color: #1a0a2e;
        }

        .admin-action-card__sub {
            font-size: 12px;
            color: #8b7aa8;
            margin-top: 2px;
        }

        /* ── Sign out btn ── */
        .admin-signout-wrap {
            text-align: center;
            padding-top: 10px;
        }

        .admin-signout-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 28px;
            background: rgba(192, 51, 74, 0.08);
            border: 1.5px solid rgba(192, 51, 74, 0.25);
            border-radius: 14px;
            color: #c0334a;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            font-family: 'Inter', sans-serif;
            transition: all 0.22s ease;
        }

        .admin-signout-btn:hover {
            background: rgba(192, 51, 74, 0.15);
            transform: translateY(-2px);
        }

        @media (max-width: 600px) {
            .admin-banner { flex-direction: column; text-align: center; padding: 28px 20px; }
            .admin-page   { padding: 20px 16px 40px; }
        }
    </style>
</head>
<body>

    @include('partials.header')
    @include('partials.toast')

    <main class="admin-page">

        {{-- Welcome Banner --}}
        <div class="admin-banner">
            <div class="admin-banner__icon">
                <span class="material-symbols-outlined" style="font-size:46px; color:#fff;">admin_panel_settings</span>
            </div>
            <div>
                <span class="admin-badge">Admin</span>
                <h1 class="admin-banner__title">Welcome back, {{ $admin->first_name }}!</h1>
                <p class="admin-banner__sub">{{ $admin->email }} &mdash; Eventify Administration Panel</p>
            </div>
        </div>

        {{-- Stats (placeholder) --}}
        <div class="admin-stats">
            <div class="stat-card">
                <div class="stat-card__icon">👥</div>
                <div class="stat-card__label">Total Customers</div>
                <div class="stat-card__value">—</div>
            </div>
            <div class="stat-card">
                <div class="stat-card__icon">📦</div>
                <div class="stat-card__label">Bookings</div>
                <div class="stat-card__value">—</div>
            </div>
            <div class="stat-card">
                <div class="stat-card__icon">🛠️</div>
                <div class="stat-card__label">Services</div>
                <div class="stat-card__value">—</div>
            </div>
            <div class="stat-card">
                <div class="stat-card__icon">⭐</div>
                <div class="stat-card__label">Reviews</div>
                <div class="stat-card__value">—</div>
            </div>
        </div>

        {{-- Quick Actions --}}
        <h2 class="admin-section-title">Quick Actions</h2>
        <div class="admin-actions">
            <a href="{{ url('/') }}" class="admin-action-card">
                <div class="admin-action-card__icon">🏠</div>
                <div>
                    <div class="admin-action-card__label">Homepage</div>
                    <div class="admin-action-card__sub">View public site</div>
                </div>
            </a>
            <a href="{{ url('/services') }}" class="admin-action-card">
                <div class="admin-action-card__icon">🛠️</div>
                <div>
                    <div class="admin-action-card__label">Services</div>
                    <div class="admin-action-card__sub">Manage service listings</div>
                </div>
            </a>
            <a href="{{ url('/packages') }}" class="admin-action-card">
                <div class="admin-action-card__icon">📦</div>
                <div>
                    <div class="admin-action-card__label">Packages</div>
                    <div class="admin-action-card__sub">View event packages</div>
                </div>
            </a>
        </div>

        {{-- Sign Out --}}
        <div class="admin-signout-wrap">
            <button class="admin-signout-btn" onclick="adminSignOut()">
                <span class="material-symbols-outlined">logout</span>
                Sign Out
            </button>
        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('javascript/Burger.js') }}"></script>
    <script src="{{ asset('javascript/toast.js') }}"></script>
    <script>
        async function adminSignOut() {
            try {
                const res = await fetch('/auth/logout', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type': 'application/json',
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
