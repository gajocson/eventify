<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>My Profile — Eventify</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">
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
        .profile-page {
            max-width: 1140px;
            margin: 0 auto;
            padding: 40px 24px 80px;
        }

        /* ── Hero banner ── */
        .profile-banner {
            background: linear-gradient(135deg, #6b3da6, #8b4cc8);
            border-radius: 24px;
            padding: 32px 36px;
            color: #fff;
            display: flex;
            align-items: center;
            gap: 22px;
            margin-bottom: 32px;
            box-shadow: 0 12px 40px rgba(107, 61, 154, 0.30);
        }

        .profile-banner__avatar {
            width: 88px; height: 88px;
            border-radius: 50%;
            background: rgba(255,255,255,0.18);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
            font-size: 48px;
            border: 3px solid rgba(255,255,255,0.35);
        }

        .profile-banner__name {
            font-size: clamp(20px, 3vw, 30px);
            font-weight: 800;
            margin: 0 0 4px;
            line-height: 1.1;
        }

        .profile-banner__email { font-size: 14px; opacity: 0.85; margin: 0; }
        .profile-banner__role {
            display: inline-block;
            background: rgba(255,255,255,0.2);
            border: 1px solid rgba(255,255,255,0.35);
            border-radius: 50px;
            padding: 3px 12px;
            font-size: 11px; font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .profile-banner__actions {
            margin-left: auto;
            display: flex;
            gap: 10px;
            flex-shrink: 0;
        }

        .banner-btn {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 10px 18px;
            border-radius: 12px;
            font-size: 13px; font-weight: 700;
            cursor: pointer;
            border: none;
            text-decoration: none;
            transition: all 0.22s;
            font-family: 'Inter', sans-serif;
        }

        .banner-btn--outline {
            background: rgba(255,255,255,0.15);
            border: 1.5px solid rgba(255,255,255,0.4);
            color: #fff;
        }
        .banner-btn--outline:hover {
            background: rgba(255,255,255,0.25);
            color: #fff;
            text-decoration: none;
        }

        .banner-btn--danger {
            background: rgba(255,80,80,0.18);
            border: 1.5px solid rgba(255,100,100,0.4);
            color: #ffcccc;
        }
        .banner-btn--danger:hover {
            background: rgba(255,80,80,0.3);
            color: #ffe0e0;
        }

        /* ── Layout: sidebar + content ── */
        .profile-layout {
            display: grid;
            grid-template-columns: 220px 1fr;
            gap: 24px;
            align-items: start;
        }

        /* ── Sidebar tabs ── */
        .profile-nav {
            background: #fff;
            border-radius: 20px;
            border: 1.5px solid #ede8f5;
            box-shadow: 0 4px 16px rgba(107,61,154,0.07);
            overflow: hidden;
            position: sticky;
            top: 24px;
        }

        .profile-nav__item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 15px 20px;
            cursor: pointer;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            font-weight: 600;
            color: #5a4a7a;
            border-bottom: 1px solid #f0ebfa;
            transition: background 0.18s, color 0.18s;
        }

        .profile-nav__item:last-child { border-bottom: none; }
        .profile-nav__item:hover { background: #faf7ff; color: #6b3da6; }
        .profile-nav__item.active {
            background: linear-gradient(135deg, #f3eafd, #ede3fa);
            color: #6b3da6;
            border-left: 3px solid #8b4cc8;
        }

        .profile-nav__icon {
            font-size: 20px;
            width: 22px;
            flex-shrink: 0;
        }

        .nav-badge {
            margin-left: auto;
            background: #8b4cc8;
            color: #fff;
            border-radius: 50px;
            padding: 1px 8px;
            font-size: 11px;
            font-weight: 700;
        }

        /* ── Panels ── */
        .profile-panel { display: none; }
        .profile-panel.active { display: block; }

        /* ── Cards ── */
        .pf-card {
            background: #fff;
            border-radius: 20px;
            border: 1.5px solid #ede8f5;
            box-shadow: 0 4px 16px rgba(107,61,154,0.07);
            padding: 28px 28px;
            margin-bottom: 20px;
        }

        .pf-card__title {
            font-size: 16px;
            font-weight: 700;
            color: #1a0a2e;
            margin: 0 0 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .pf-card__title .material-symbols-outlined { font-size: 20px; color: #8b4cc8; }

        /* ── Info rows ── */
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-bottom: 20px;
        }

        .info-item__label {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #a08ab8;
            margin-bottom: 4px;
        }

        .info-item__value {
            font-size: 15px;
            font-weight: 600;
            color: #1a0a2e;
        }

        /* ── Form inputs ── */
        .pf-input-group { margin-bottom: 16px; }

        .pf-label {
            display: block;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #a08ab8;
            margin-bottom: 6px;
        }

        .pf-input {
            width: 100%;
            background: #faf7ff;
            border: 1.5px solid #ede8f5;
            border-radius: 12px;
            color: #1a0a2e;
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            padding: 11px 14px;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .pf-input:focus {
            border-color: #8b4cc8;
            box-shadow: 0 0 0 3px rgba(139,76,200,.13);
        }
        .pf-input.is-error { border-color: #e05c6a; }

        .pf-input-row {
            display: flex;
            gap: 10px;
        }
        .pf-input-row .pf-input { flex: 1; }

        .pf-error {
            font-size: 12px;
            color: #c0334a;
            margin-top: 4px;
        }

        /* ── Buttons ── */
        .pf-btn {
            display: inline-flex; align-items: center; gap: 7px;
            padding: 11px 22px;
            border: none;
            border-radius: 12px;
            font-family: 'Inter', sans-serif;
            font-size: 14px; font-weight: 700;
            cursor: pointer;
            transition: all 0.22s;
        }
        .pf-btn--primary {
            background: linear-gradient(135deg, #8b4cc8, #5a2d82);
            color: #fff;
            box-shadow: 0 6px 18px rgba(107,61,154,.30);
        }
        .pf-btn--primary:hover {
            background: linear-gradient(135deg, #9d5de0, #6b3da6);
            transform: translateY(-2px);
            box-shadow: 0 10px 26px rgba(107,61,154,.42);
        }
        .pf-btn--primary:disabled {
            opacity: 0.6; cursor: not-allowed; transform: none;
        }
        .pf-btn--outline {
            background: #f3eafd;
            color: #6a3da6;
            border: 1.5px solid #d4b4f2;
        }
        .pf-btn--outline:hover {
            background: #ede3fa;
            transform: translateY(-1px);
        }

        /* ── Status badge ── */
        .status-badge {
            display: inline-block;
            border-radius: 50px;
            padding: 4px 13px;
            font-size: 11px;
            font-weight: 700;
        }
        .status-badge--pending   { background: #fff8e1; color: #9a6700; border: 1px solid #f5d060; }
        .status-badge--confirmed { background: #edfaf0; color: #2e7d3e; border: 1px solid #7bcf8e; }
        .status-badge--cancelled { background: #fde8ea; color: #c0334a; border: 1px solid #f0aab5; }

        /* ── Booking cards (in profile) ── */
        .booking-card {
            border: 1.5px solid #ede8f5;
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 16px;
            background: #faf7ff;
            transition: box-shadow 0.2s;
        }
        .booking-card:hover { box-shadow: 0 4px 20px rgba(107,61,154,0.10); }

        .booking-card__header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 12px;
        }

        .booking-card__pkg {
            font-size: 15px;
            font-weight: 700;
            color: #1a0a2e;
        }

        .booking-card__date {
            font-size: 12px;
            color: #8b7aa8;
            margin-top: 3px;
        }

        .booking-card__meta {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
            gap: 10px;
            margin-bottom: 12px;
        }

        .booking-card__meta-item { }
        .booking-card__meta-label {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #a08ab8;
        }
        .booking-card__meta-value {
            font-size: 13px;
            font-weight: 600;
            color: #1a0a2e;
        }

        .booking-card__tags { display: flex; flex-wrap: wrap; gap: 6px; margin-bottom: 10px; }
        .booking-tag {
            background: linear-gradient(135deg, #f3eafd, #ede3fa);
            border: 1px solid #d4b4f2;
            border-radius: 50px;
            padding: 3px 10px;
            font-size: 11px;
            font-weight: 600;
            color: #6a3da6;
        }

        .booking-card__admin-msg {
            background: linear-gradient(135deg, #fff8e1, #fffbf0);
            border: 1px solid #f5d060;
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 13px;
            color: #5a4000;
            margin-bottom: 10px;
        }
        .booking-card__admin-msg strong {
            display: block;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #9a6700;
            margin-bottom: 4px;
        }

        .booking-card__toggle {
            background: none;
            border: none;
            font-family: 'Inter', sans-serif;
            font-size: 12px;
            font-weight: 700;
            color: #8b4cc8;
            cursor: pointer;
            padding: 0;
            display: flex;
            align-items: center;
            gap: 4px;
        }
        .booking-card__toggle:hover { color: #5a2d82; }

        /* ── Message thread ── */
        .msg-thread {
            margin-top: 14px;
            border-top: 1.5px solid #ede8f5;
            padding-top: 14px;
        }

        .msg-thread__title {
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #a08ab8;
            margin-bottom: 12px;
        }

        .msg-bubble {
            margin-bottom: 10px;
            display: flex;
            flex-direction: column;
        }

        .msg-bubble--admin { align-items: flex-start; }
        .msg-bubble--customer { align-items: flex-end; }

        .msg-bubble__name {
            font-size: 11px;
            font-weight: 700;
            color: #a08ab8;
            margin-bottom: 3px;
        }

        .msg-bubble__content {
            max-width: 80%;
            padding: 10px 14px;
            border-radius: 14px;
            font-size: 13px;
            line-height: 1.55;
        }

        .msg-bubble--admin .msg-bubble__content {
            background: linear-gradient(135deg, #f3eafd, #ede3fa);
            color: #1a0a2e;
            border-bottom-left-radius: 4px;
        }

        .msg-bubble--customer .msg-bubble__content {
            background: linear-gradient(135deg, #8b4cc8, #5a2d82);
            color: #fff;
            border-bottom-right-radius: 4px;
        }

        .msg-bubble__time {
            font-size: 10px;
            color: #b0a0c8;
            margin-top: 3px;
        }

        .msg-reply-area {
            margin-top: 12px;
            display: flex;
            gap: 8px;
        }

        .msg-reply-input {
            flex: 1;
            background: #fff;
            border: 1.5px solid #ede8f5;
            border-radius: 12px;
            color: #1a0a2e;
            font-family: 'Inter', sans-serif;
            font-size: 13px;
            padding: 9px 13px;
            outline: none;
            resize: none;
            transition: border-color 0.2s;
            min-height: 42px;
        }
        .msg-reply-input:focus {
            border-color: #8b4cc8;
            box-shadow: 0 0 0 3px rgba(139,76,200,.10);
        }

        .msg-reply-btn {
            background: linear-gradient(135deg, #8b4cc8, #5a2d82);
            color: #fff;
            border: none;
            border-radius: 12px;
            padding: 9px 16px;
            font-family: 'Inter', sans-serif;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
            display: flex; align-items: center; gap: 5px;
        }
        .msg-reply-btn:hover { background: linear-gradient(135deg, #9d5de0, #6b3da6); transform: translateY(-1px); }
        .msg-reply-btn:disabled { opacity: 0.6; cursor: not-allowed; transform: none; }

        /* ── History ── */
        .history-row {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 14px 0;
            border-bottom: 1px solid #f0ebfa;
        }
        .history-row:last-child { border-bottom: none; }
        .history-row__icon {
            width: 40px; height: 40px;
            border-radius: 12px;
            background: linear-gradient(135deg, #f0ebfa, #e5d9f5);
            display: flex; align-items: center; justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
        }
        .history-row__info { flex: 1; min-width: 0; }
        .history-row__pkg {
            font-size: 14px; font-weight: 700; color: #1a0a2e;
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        }
        .history-row__date { font-size: 12px; color: #8b7aa8; }
        .history-row__price {
            font-size: 14px; font-weight: 700; color: #8b4cc8;
            flex-shrink: 0;
        }

        /* ── Empty states ── */
        .pf-empty {
            text-align: center;
            padding: 48px 20px;
            color: #8b7aa8;
        }
        .pf-empty__icon { font-size: 2.8rem; display: block; margin-bottom: 12px; }
        .pf-empty__text { font-size: 14px; }

        /* ── Toast replacement: inline feedback ── */
        .pf-alert {
            padding: 12px 16px;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 16px;
            display: none;
        }
        .pf-alert--success { background: #edfaf0; color: #2e7d3e; border: 1px solid #7bcf8e; }
        .pf-alert--error   { background: #fde8ea; color: #c0334a; border: 1px solid #f0aab5; }

        /* ── Divider ── */
        .pf-divider { border: none; border-top: 1.5px solid #ede8f5; margin: 20px 0; }

        /* ── Responsive ── */
        @media (max-width: 768px) {
            .profile-layout {
                grid-template-columns: 1fr;
            }
            .profile-nav {
                position: static;
                display: flex;
                overflow-x: auto;
                border-radius: 14px;
            }
            .profile-nav__item {
                flex-direction: column;
                gap: 4px;
                padding: 12px 14px;
                min-width: 80px;
                border-bottom: none;
                border-right: 1px solid #f0ebfa;
                font-size: 11px;
            }
            .profile-nav__item.active { border-left: none; border-bottom: 3px solid #8b4cc8; }
            .profile-banner { flex-wrap: wrap; }
            .profile-banner__actions { margin-left: 0; width: 100%; }
            .info-grid { grid-template-columns: 1fr; }
            .booking-card__meta { grid-template-columns: 1fr 1fr; }
        }

        @media (max-width: 480px) {
            .profile-page { padding: 20px 12px 40px; }
            .pf-card { padding: 18px 16px; }
        }
    </style>
</head>
<body>

    @include('partials.header')
    @include('partials.toast')

    <main class="profile-page">

        {{-- ── Banner ── --}}
        <div class="profile-banner">
            <div class="profile-banner__avatar">
                <span class="material-symbols-outlined" style="color:#fff; font-size:46px;">account_circle</span>
            </div>
            <div>
                <div class="profile-banner__role">Customer</div>
                <h1 class="profile-banner__name">{{ $user->first_name }} {{ $user->last_name }}</h1>
                <p class="profile-banner__email">{{ $user->email }}</p>
            </div>
            <div class="profile-banner__actions">
                <a href="{{ url('/') }}" class="banner-btn banner-btn--outline">
                    <span class="material-symbols-outlined" style="font-size:17px;">home</span>
                    Home
                </a>
                <button class="banner-btn banner-btn--danger" onclick="signOut()">
                    <span class="material-symbols-outlined" style="font-size:17px;">logout</span>
                    Sign Out
                </button>
            </div>
        </div>

        {{-- ── Layout ── --}}
        <div class="profile-layout">

            {{-- ── Sidebar nav ── --}}
            <nav class="profile-nav">
                <button class="profile-nav__item active" onclick="switchTab('account', this)">
                    <span class="material-symbols-outlined profile-nav__icon">person</span>
                    Account Info
                </button>
                <button class="profile-nav__item" onclick="switchTab('settings', this)">
                    <span class="material-symbols-outlined profile-nav__icon">lock</span>
                    Settings
                </button>
                <button class="profile-nav__item" onclick="switchTab('bookings', this)">
                    <span class="material-symbols-outlined profile-nav__icon">event</span>
                    My Bookings
                    @if($currentBookings->count() > 0)
                        <span class="nav-badge">{{ $currentBookings->count() }}</span>
                    @endif
                </button>
                <button class="profile-nav__item" onclick="switchTab('history', this)">
                    <span class="material-symbols-outlined profile-nav__icon">history</span>
                    History
                </button>
                <button class="profile-nav__item" onclick="switchTab('messages', this)">
                    <span class="material-symbols-outlined profile-nav__icon">chat</span>
                    Messages
                    @if($messageBookings->count() > 0)
                        <span class="nav-badge">{{ $messageBookings->count() }}</span>
                    @endif
                </button>
            </nav>

            {{-- ── Panels ── --}}
            <div class="profile-panels">

                {{-- ══════════════════════════════════════════
                     PANEL 1: Account Info
                ══════════════════════════════════════════ --}}
                <div class="profile-panel active" id="panel-account">

                    {{-- Display info --}}
                    <div class="pf-card">
                        <div class="pf-card__title">
                            <span class="material-symbols-outlined">badge</span>
                            Account Information
                        </div>
                        <div class="info-grid">
                            <div>
                                <div class="info-item__label">First Name</div>
                                <div class="info-item__value">{{ $user->first_name }}</div>
                            </div>
                            <div>
                                <div class="info-item__label">Last Name</div>
                                <div class="info-item__value">{{ $user->last_name }}</div>
                            </div>
                            <div>
                                <div class="info-item__label">Email Address</div>
                                <div class="info-item__value">{{ $user->email }}</div>
                            </div>
                            <div>
                                <div class="info-item__label">Phone Number</div>
                                <div class="info-item__value" id="phoneDisplay">
                                    {{ $user->phone ?? '—' }}
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Phone update --}}
                    <div class="pf-card">
                        <div class="pf-card__title">
                            <span class="material-symbols-outlined">phone</span>
                            Update Phone Number
                        </div>
                        <div id="phoneAlert" class="pf-alert"></div>
                        <div class="pf-input-group">
                            <label class="pf-label" for="phoneInput">Phone Number</label>
                            <div class="pf-input-row">
                                <input
                                    id="phoneInput"
                                    type="tel"
                                    class="pf-input"
                                    placeholder="e.g. 09171234567"
                                    value="{{ $user->phone }}"
                                >
                                <button class="pf-btn pf-btn--primary" onclick="savePhone()">
                                    <span class="material-symbols-outlined" style="font-size:16px;">save</span>
                                    Save
                                </button>
                            </div>
                            <div class="pf-error" id="phoneError"></div>
                        </div>
                    </div>

                </div>

                {{-- ══════════════════════════════════════════
                     PANEL 2: Settings (Password)
                ══════════════════════════════════════════ --}}
                <div class="profile-panel" id="panel-settings">
                    <div class="pf-card">
                        <div class="pf-card__title">
                            <span class="material-symbols-outlined">lock_reset</span>
                            Change Password
                        </div>
                        <div id="pwAlert" class="pf-alert"></div>
                        <div class="pf-input-group">
                            <label class="pf-label" for="currentPw">Current Password</label>
                            <input id="currentPw" type="password" class="pf-input" placeholder="Enter your current password">
                            <div class="pf-error" id="currentPwError"></div>
                        </div>
                        <div class="pf-input-group">
                            <label class="pf-label" for="newPw">New Password</label>
                            <input id="newPw" type="password" class="pf-input" placeholder="At least 6 characters">
                            <div class="pf-error" id="newPwError"></div>
                        </div>
                        <div class="pf-input-group">
                            <label class="pf-label" for="confirmPw">Confirm New Password</label>
                            <input id="confirmPw" type="password" class="pf-input" placeholder="Re-enter new password">
                            <div class="pf-error" id="confirmPwError"></div>
                        </div>
                        <button class="pf-btn pf-btn--primary" id="pwBtn" onclick="changePassword()">
                            <span class="material-symbols-outlined" style="font-size:16px;">lock</span>
                            Update Password
                        </button>
                    </div>
                </div>

                {{-- ══════════════════════════════════════════
                     PANEL 3: Current Bookings
                ══════════════════════════════════════════ --}}
                <div class="profile-panel" id="panel-bookings">
                    <div class="pf-card">
                        <div class="pf-card__title">
                            <span class="material-symbols-outlined">event_available</span>
                            Current Bookings
                            <span style="font-size:12px; font-weight:600; color:#8b7aa8; margin-left:4px;">({{ $currentBookings->count() }} active)</span>
                        </div>

                        @if($currentBookings->isEmpty())
                            <div class="pf-empty">
                                <span class="pf-empty__icon">📅</span>
                                <p class="pf-empty__text">No active bookings yet.<br>Book an event package to get started!</p>
                                <a href="{{ url('/') }}" class="pf-btn pf-btn--primary" style="display:inline-flex; margin-top:14px;">
                                    <span class="material-symbols-outlined" style="font-size:16px;">add</span>
                                    Browse Packages
                                </a>
                            </div>
                        @else
                            @foreach($currentBookings as $booking)
                            <div class="booking-card">
                                <div class="booking-card__header">
                                    <div>
                                        <div class="booking-card__pkg">{{ $booking->package_name }}</div>
                                        <div class="booking-card__date">
                                            Booked on {{ $booking->created_at->format('M d, Y') }}
                                        </div>
                                    </div>
                                    <span class="status-badge status-badge--{{ $booking->status }}">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </div>

                                <div class="booking-card__meta">
                                    <div class="booking-card__meta-item">
                                        <div class="booking-card__meta-label">Event Date</div>
                                        <div class="booking-card__meta-value">{{ $booking->event_date->format('M d, Y') }}</div>
                                    </div>
                                    <div class="booking-card__meta-item">
                                        <div class="booking-card__meta-label">Guests</div>
                                        <div class="booking-card__meta-value">{{ $booking->guest_count }}</div>
                                    </div>
                                    <div class="booking-card__meta-item">
                                        <div class="booking-card__meta-label">Total Price</div>
                                        <div class="booking-card__meta-value" style="color:#8b4cc8;">₱{{ number_format($booking->total_price, 0) }}</div>
                                    </div>
                                    <div class="booking-card__meta-item">
                                        <div class="booking-card__meta-label">Payment</div>
                                        <div class="booking-card__meta-value">{{ $booking->payment_method }}</div>
                                    </div>
                                </div>

                                {{-- Services --}}
                                @if($booking->services && count($booking->services) > 0)
                                <div class="booking-card__tags">
                                    @foreach($booking->services as $svc)
                                        <span class="booking-tag">{{ $svc }}</span>
                                    @endforeach
                                </div>
                                @endif

                                {{-- Sub-services --}}
                                @if($booking->sub_services && count($booking->sub_services) > 0)
                                <div style="margin-bottom:10px;">
                                    <div class="booking-card__meta-label" style="margin-bottom:5px;">Sub-Services</div>
                                    @foreach($booking->sub_services as $ss)
                                        <div style="font-size:12px; color:#5a4a7a;">• {{ $ss['label'] ?? '' }} — ₱{{ number_format($ss['price'] ?? 0, 0) }}</div>
                                    @endforeach
                                </div>
                                @endif

                                {{-- Admin message highlight (latest only) --}}
                                @php
                                    $latestAdminMsg = $booking->messages->where('sender_type', 'admin')->last();
                                    $hasMessages = $booking->messages->count() > 0;
                                @endphp
                                @if($latestAdminMsg)
                                <div class="booking-card__admin-msg">
                                    <strong>📨 Message from Admin</strong>
                                    {{ $latestAdminMsg->message }}
                                </div>
                                @endif

                                {{-- Toggle message thread --}}
                                @if($hasMessages)
                                <button class="booking-card__toggle" onclick="toggleThread({{ $booking->id }}, this)">
                                    <span class="material-symbols-outlined" style="font-size:16px;">chat</span>
                                    View Conversation ({{ $booking->messages->count() }} messages)
                                    <span class="material-symbols-outlined" style="font-size:16px;" id="toggleIcon-{{ $booking->id }}">expand_more</span>
                                </button>
                                @else
                                <div style="font-size:12px; color:#b0a0c8;">No messages yet. Admin will contact you soon.</div>
                                @endif

                                {{-- Message thread (hidden by default) --}}
                                <div class="msg-thread" id="thread-{{ $booking->id }}" style="display:none;">
                                    <div class="msg-thread__title">Conversation</div>
                                    @foreach($booking->messages as $msg)
                                        <div class="msg-bubble msg-bubble--{{ $msg->sender_type }}">
                                            <div class="msg-bubble__name">
                                                {{ $msg->sender_type === 'admin' ? 'Admin' : ($user->first_name . ' ' . $user->last_name) }}
                                            </div>
                                            <div class="msg-bubble__content">{{ $msg->message }}</div>
                                            <div class="msg-bubble__time">{{ $msg->created_at->format('M d, Y h:i A') }}</div>
                                        </div>
                                    @endforeach

                                    {{-- Reply area (only if admin has sent a message) --}}
                                    @if($latestAdminMsg)
                                    <div class="msg-reply-area" id="replyArea-{{ $booking->id }}">
                                        <textarea
                                            class="msg-reply-input"
                                            id="replyInput-{{ $booking->id }}"
                                            placeholder="Type your reply to the admin..."
                                            rows="1"
                                        ></textarea>
                                        <button
                                            class="msg-reply-btn"
                                            id="replyBtn-{{ $booking->id }}"
                                            onclick="sendReply({{ $booking->id }})"
                                        >
                                            <span class="material-symbols-outlined" style="font-size:16px;">send</span>
                                            Send
                                        </button>
                                    </div>
                                    @endif
                                </div>

                            </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                {{-- ══════════════════════════════════════════
                     PANEL 4: Booking History
                ══════════════════════════════════════════ --}}
                <div class="profile-panel" id="panel-history">
                    <div class="pf-card">
                        <div class="pf-card__title">
                            <span class="material-symbols-outlined">history</span>
                            Booking History
                            <span style="font-size:12px; font-weight:600; color:#8b7aa8; margin-left:4px;">({{ $historyBookings->count() }} records)</span>
                        </div>

                        @if($historyBookings->isEmpty())
                            <div class="pf-empty">
                                <span class="pf-empty__icon">📂</span>
                                <p class="pf-empty__text">No booking history yet.</p>
                            </div>
                        @else
                            @foreach($historyBookings as $booking)
                            <div class="history-row">
                                <div class="history-row__icon">
                                    {{ $booking->status === 'cancelled' ? '❌' : '✅' }}
                                </div>
                                <div class="history-row__info">
                                    <div class="history-row__pkg">{{ $booking->package_name }}</div>
                                    <div class="history-row__date">
                                        Event: {{ $booking->event_date->format('M d, Y') }} &nbsp;·&nbsp;
                                        Booked: {{ $booking->created_at->format('M d, Y') }}
                                    </div>
                                    <div style="margin-top:4px;">
                                        <span class="status-badge status-badge--{{ $booking->status }}">
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="history-row__price">₱{{ number_format($booking->total_price, 0) }}</div>
                            </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                {{-- ══════════════════════════════════════════
                     PANEL 5: Messages
                ══════════════════════════════════════════ --}}
                <div class="profile-panel" id="panel-messages">
                    <div class="pf-card">
                        <div class="pf-card__title">
                            <span class="material-symbols-outlined">forum</span>
                            Messages &amp; Notifications
                        </div>

                        @if($messageBookings->isEmpty())
                            <div class="pf-empty">
                                <span class="pf-empty__icon">💬</span>
                                <p class="pf-empty__text">No messages yet.<br>Admin will send you a message about your booking status here.</p>
                            </div>
                        @else
                            @foreach($messageBookings as $booking)
                            <div class="pf-card" style="background:#faf7ff; border-color:#e5d9f5; margin-bottom:16px;">
                                <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:14px; flex-wrap:wrap; gap:8px;">
                                    <div>
                                        <div style="font-size:14px; font-weight:700; color:#1a0a2e;">{{ $booking->package_name }}</div>
                                        <div style="font-size:12px; color:#8b7aa8;">Event: {{ $booking->event_date->format('M d, Y') }}</div>
                                    </div>
                                    <span class="status-badge status-badge--{{ $booking->status }}">{{ ucfirst($booking->status) }}</span>
                                </div>

                                {{-- Full thread --}}
                                <div class="msg-thread__title">Conversation Thread</div>
                                @foreach($booking->messages as $msg)
                                    <div class="msg-bubble msg-bubble--{{ $msg->sender_type }}">
                                        <div class="msg-bubble__name">
                                            {{ $msg->sender_type === 'admin' ? 'Admin (Eventify)' : ($user->first_name . ' ' . $user->last_name) }}
                                        </div>
                                        <div class="msg-bubble__content">{{ $msg->message }}</div>
                                        <div class="msg-bubble__time">{{ $msg->created_at->format('M d, Y h:i A') }}</div>
                                    </div>
                                @endforeach

                                {{-- Reply area --}}
                                @php $hasAdminMsg = $booking->messages->where('sender_type','admin')->count() > 0; @endphp
                                @if($hasAdminMsg)
                                <div class="msg-reply-area" id="msgReplyArea-{{ $booking->id }}">
                                    <textarea
                                        class="msg-reply-input"
                                        id="msgReplyInput-{{ $booking->id }}"
                                        placeholder="Reply to admin..."
                                        rows="2"
                                    ></textarea>
                                    <button
                                        class="msg-reply-btn"
                                        id="msgReplyBtn-{{ $booking->id }}"
                                        onclick="sendReply({{ $booking->id }}, 'msg')"
                                    >
                                        <span class="material-symbols-outlined" style="font-size:16px;">send</span>
                                        Reply
                                    </button>
                                </div>
                                @endif
                            </div>
                            @endforeach
                        @endif
                    </div>
                </div>

            </div>{{-- end profile-panels --}}
        </div>{{-- end profile-layout --}}
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('javascript/Burger.js') }}"></script>
    <script src="{{ asset('javascript/toast.js') }}"></script>
    <script>
        // ── Tab switching ──────────────────────────────────────────────────
        function switchTab(tabId, btn) {
            document.querySelectorAll('.profile-panel').forEach(p => p.classList.remove('active'));
            document.querySelectorAll('.profile-nav__item').forEach(b => b.classList.remove('active'));

            document.getElementById('panel-' + tabId).classList.add('active');
            btn.classList.add('active');
        }

        // ── Sign Out ───────────────────────────────────────────────────────
        async function signOut() {
            try {
                await fetch('/auth/logout', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                });
            } catch(e) {}
            window.location.href = '/';
        }

        // ── Helper: show alert ─────────────────────────────────────────────
        function showAlert(id, type, msg) {
            const el = document.getElementById(id);
            if (!el) return;
            el.className = 'pf-alert pf-alert--' + type;
            el.textContent = msg;
            el.style.display = 'block';
            setTimeout(() => { el.style.display = 'none'; }, 4500);
        }

        // ── Phone Update ───────────────────────────────────────────────────
        async function savePhone() {
            const phoneInput = document.getElementById('phoneInput');
            const phoneError = document.getElementById('phoneError');
            phoneError.textContent = '';
            phoneInput.classList.remove('is-error');

            const phone = phoneInput.value.trim();
            if (!phone) {
                phoneInput.classList.add('is-error');
                phoneError.textContent = 'Please enter a phone number.';
                return;
            }

            try {
                const res = await fetch('/profile/phone', {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    body: JSON.stringify({ phone }),
                });
                const data = await res.json();
                if (data.success) {
                    document.getElementById('phoneDisplay').textContent = data.phone;
                    showAlert('phoneAlert', 'success', '✅ Phone number saved successfully!');
                    if (typeof window.showToast === 'function') {
                        window.showToast('success', 'Phone number updated!');
                    }
                } else {
                    const errors = data.errors?.phone || [];
                    phoneError.textContent = errors[0] || 'Failed to save phone number.';
                    phoneInput.classList.add('is-error');
                }
            } catch (e) {
                showAlert('phoneAlert', 'error', '❌ Something went wrong. Please try again.');
            }
        }

        // ── Password Change ────────────────────────────────────────────────
        async function changePassword() {
            const currentPw = document.getElementById('currentPw').value;
            const newPw     = document.getElementById('newPw').value;
            const confirmPw = document.getElementById('confirmPw').value;

            // Clear previous errors
            ['currentPw','newPw','confirmPw'].forEach(id => {
                document.getElementById(id).classList.remove('is-error');
                document.getElementById(id + 'Error').textContent = '';
            });

            let hasError = false;

            if (!currentPw) {
                document.getElementById('currentPw').classList.add('is-error');
                document.getElementById('currentPwError').textContent = 'Current password is required.';
                hasError = true;
            }
            if (!newPw || newPw.length < 6) {
                document.getElementById('newPw').classList.add('is-error');
                document.getElementById('newPwError').textContent = 'New password must be at least 6 characters.';
                hasError = true;
            }
            if (newPw !== confirmPw) {
                document.getElementById('confirmPw').classList.add('is-error');
                document.getElementById('confirmPwError').textContent = 'Passwords do not match.';
                hasError = true;
            }
            if (hasError) return;

            const btn = document.getElementById('pwBtn');
            btn.disabled = true;
            btn.textContent = 'Updating…';

            try {
                const res = await fetch('/profile/password', {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    body: JSON.stringify({
                        current_password:          currentPw,
                        new_password:              newPw,
                        new_password_confirmation: confirmPw,
                    }),
                });
                const data = await res.json();

                if (data.success) {
                    showAlert('pwAlert', 'success', '✅ Password updated successfully!');
                    document.getElementById('currentPw').value = '';
                    document.getElementById('newPw').value     = '';
                    document.getElementById('confirmPw').value = '';
                    if (typeof window.showToast === 'function') {
                        window.showToast('success', 'Password updated!');
                    }
                } else {
                    const errs = data.errors || {};
                    if (errs.current_password) {
                        document.getElementById('currentPw').classList.add('is-error');
                        document.getElementById('currentPwError').textContent = errs.current_password[0];
                    }
                    if (errs.new_password) {
                        document.getElementById('newPw').classList.add('is-error');
                        document.getElementById('newPwError').textContent = errs.new_password[0];
                    }
                    showAlert('pwAlert', 'error', '❌ ' + (errs.current_password?.[0] || 'Failed to update password.'));
                }
            } catch (e) {
                showAlert('pwAlert', 'error', '❌ Something went wrong. Please try again.');
            } finally {
                btn.disabled = false;
                btn.innerHTML = '<span class="material-symbols-outlined" style="font-size:16px;">lock</span> Update Password';
            }
        }

        // ── Toggle message thread ──────────────────────────────────────────
        function toggleThread(bookingId, btn) {
            const thread  = document.getElementById('thread-' + bookingId);
            const icon    = document.getElementById('toggleIcon-' + bookingId);
            const isShown = thread.style.display !== 'none';

            thread.style.display = isShown ? 'none' : 'block';
            icon.textContent      = isShown ? 'expand_more' : 'expand_less';
        }

        // ── Send User Reply ────────────────────────────────────────────────
        async function sendReply(bookingId, context) {
            const inputId = context === 'msg'
                ? 'msgReplyInput-' + bookingId
                : 'replyInput-' + bookingId;
            const btnId = context === 'msg'
                ? 'msgReplyBtn-' + bookingId
                : 'replyBtn-' + bookingId;

            const input   = document.getElementById(inputId);
            const btn     = document.getElementById(btnId);
            const message = input ? input.value.trim() : '';

            if (!message) {
                if (typeof window.showToast === 'function') {
                    window.showToast('error', 'Please type a message first.');
                }
                return;
            }

            btn.disabled  = true;
            const origHtml = btn.innerHTML;
            btn.innerHTML = '…';

            try {
                const res = await fetch(`/profile/bookings/${bookingId}/reply`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    body: JSON.stringify({ message }),
                });
                const data = await res.json();

                if (data.success) {
                    input.value = '';

                    // Append the new bubble dynamically
                    const m     = data.message_obj;
                    const bubble = document.createElement('div');
                    bubble.className = 'msg-bubble msg-bubble--customer';
                    bubble.innerHTML = `
                        <div class="msg-bubble__name">${m.sender_name}</div>
                        <div class="msg-bubble__content">${escapeHtml(m.message)}</div>
                        <div class="msg-bubble__time">${m.created_at}</div>
                    `;

                    // Insert before the reply area in bookings thread
                    if (context !== 'msg') {
                        const thread    = document.getElementById('thread-' + bookingId);
                        const replyArea = document.getElementById('replyArea-' + bookingId);
                        thread.insertBefore(bubble, replyArea);
                    } else {
                        // In messages panel
                        const replyArea = document.getElementById('msgReplyArea-' + bookingId);
                        replyArea.parentNode.insertBefore(bubble, replyArea);
                    }

                    if (typeof window.showToast === 'function') {
                        window.showToast('success', '✅ Reply sent!');
                    }
                } else {
                    if (typeof window.showToast === 'function') {
                        window.showToast('error', '❌ Failed to send reply.');
                    }
                }
            } catch (err) {
                if (typeof window.showToast === 'function') {
                    window.showToast('error', '❌ Something went wrong.');
                }
            } finally {
                btn.disabled  = false;
                btn.innerHTML = origHtml;
            }
        }

        function escapeHtml(str) {
            return String(str)
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;');
        }

        // ── Auto-open tab from URL hash ────────────────────────────────────
        (function() {
            const hash = window.location.hash.replace('#', '');
            const validTabs = ['account','settings','bookings','history','messages'];
            if (validTabs.includes(hash)) {
                const btn = document.querySelector(`.profile-nav__item[onclick*="'${hash}'"]`);
                if (btn) btn.click();
            }
        })();
    </script>

</body>
</html>
