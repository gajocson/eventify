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
            padding: 40px 24px 80px;
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
            width: 88px; height: 88px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }

        .admin-banner__title {
            font-size: clamp(22px, 3vw, 34px);
            font-weight: 800;
            margin: 0 0 6px;
            line-height: 1.1;
        }

        .admin-banner__sub { font-size: 15px; opacity: 0.85; margin: 0; }

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

        .stat-card__icon { font-size: 28px; margin-bottom: 12px; }
        .stat-card__label {
            font-size: 12px; font-weight: 600; color: #8b7aa8;
            text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 6px;
        }
        .stat-card__value { font-size: 28px; font-weight: 800; color: #1a0a2e; }

        /* ── Section title ── */
        .admin-section-title {
            font-size: 18px; font-weight: 700; color: #1a0a2e; margin: 0 0 16px;
        }

        /* ── Quick actions ── */
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
            color: inherit; text-decoration: none;
        }
        .admin-action-card__icon {
            width: 48px; height: 48px;
            border-radius: 14px;
            background: linear-gradient(135deg, #f3eafd, #e8d5f9);
            display: flex; align-items: center; justify-content: center;
            font-size: 22px; flex-shrink: 0;
        }
        .admin-action-card__label { font-size: 14px; font-weight: 700; color: #1a0a2e; }
        .admin-action-card__sub   { font-size: 12px; color: #8b7aa8; margin-top: 2px; }

        /* ── Bookings section ── */
        .bookings-card {
            background: #fff;
            border-radius: 20px;
            border: 1.5px solid #ede8f5;
            box-shadow: 0 4px 16px rgba(107,61,154,0.07);
            overflow: hidden;
            margin-bottom: 36px;
        }

        .bookings-card__header {
            padding: 22px 26px;
            border-bottom: 1.5px solid #ede8f5;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .bookings-card__title {
            font-size: 16px; font-weight: 700; color: #1a0a2e; margin: 0;
        }

        .bookings-count {
            background: linear-gradient(135deg, #f3eafd, #ede3fa);
            border: 1px solid #d4b4f2;
            border-radius: 50px;
            padding: 3px 12px;
            font-size: 12px;
            font-weight: 700;
            color: #6a3da6;
        }

        /* Table */
        .bookings-table { width: 100%; border-collapse: collapse; }
        .bookings-table th {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #8b7aa8;
            padding: 14px 20px;
            text-align: left;
            border-bottom: 1.5px solid #ede8f5;
            background: #faf7ff;
        }
        .bookings-table td {
            padding: 14px 20px;
            font-size: 13.5px;
            border-bottom: 1px solid #f0ebfa;
            vertical-align: middle;
        }
        .bookings-table tr:last-child td { border-bottom: none; }
        .bookings-table tr.bk-row {
            cursor: pointer;
            transition: background 0.18s;
        }
        .bookings-table tr.bk-row:hover { background: #faf7ff; }

        .bk-customer { font-weight: 600; color: #1a0a2e; }
        .bk-email    { font-size: 12px; color: #8b7aa8; margin-top: 2px; }

        /* Status badge */
        .bk-badge {
            display: inline-block;
            border-radius: 50px;
            padding: 4px 12px;
            font-size: 11px;
            font-weight: 700;
        }
        .bk-badge--pending   { background: #fff8e1; color: #9a6700; border: 1px solid #f5d060; }
        .bk-badge--confirmed { background: #edfaf0; color: #2e7d3e; border: 1px solid #7bcf8e; }
        .bk-badge--cancelled { background: #fde8ea; color: #c0334a; border: 1px solid #f0aab5; }

        .bk-view-btn {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background: linear-gradient(135deg, #f3eafd, #ede3fa);
            border: 1px solid #d4b4f2;
            color: #6a3da6;
            border-radius: 8px;
            padding: 6px 13px;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.2s;
        }
        .bk-view-btn:hover { background: linear-gradient(135deg, #e8d5f9, #dbc4f5); }

        .bk-empty {
            text-align: center;
            padding: 60px 20px;
            color: #8b7aa8;
        }
        .bk-empty .icon { font-size: 2.5rem; display: block; margin-bottom: 12px; }

        /* ── Modals (shared base) ── */
        .adm-backdrop {
            display: none;
            position: fixed; inset: 0;
            background: rgba(12, 5, 26, 0.52);
            backdrop-filter: blur(4px);
            z-index: 9000;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .adm-backdrop.is-open { display: flex; }

        .adm-modal {
            background: #fff;
            border-radius: 24px;
            padding: 36px 32px 30px;
            width: 100%;
            max-width: 560px;
            max-height: 90vh;
            overflow-y: auto;
            position: relative;
            box-shadow: 0 32px 80px rgba(12,5,26,0.28), 0 8px 24px rgba(0,0,0,0.12);
            animation: modalIn .28s cubic-bezier(.34,1.4,.64,1);
        }

        @keyframes modalIn {
            from { opacity:0; transform: scale(.96) translateY(14px); }
            to   { opacity:1; transform: scale(1) translateY(0); }
        }

        .adm-modal::-webkit-scrollbar { width: 4px; }
        .adm-modal::-webkit-scrollbar-track { background: transparent; }
        .adm-modal::-webkit-scrollbar-thumb { background: rgba(139,76,200,.2); border-radius: 10px; }

        .adm-modal__close {
            position: absolute;
            top: 16px; right: 18px;
            background: rgba(139,76,200,.08);
            border: none;
            border-radius: 10px;
            width: 34px; height: 34px;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer;
            font-size: 17px; color: #7a5e9a;
            transition: background 0.2s, color 0.2s;
            line-height: 1;
        }
        .adm-modal__close:hover { background: rgba(139,76,200,.16); color: #5a2d82; }

        .adm-modal__title { font-size: 1.25rem; font-weight: 800; color: #1a0a2e; margin: 0 0 4px; }
        .adm-modal__sub   { font-size: .82rem; color: #7a6091; margin: 0 0 20px; }

        /* Info rows inside modals */
        .adm-info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 16px;
        }

        @media (max-width: 480px) { .adm-info-grid { grid-template-columns: 1fr; } }

        .adm-info-item { }
        .adm-info-item__label {
            font-size: .68rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #a08ab8;
            margin-bottom: 3px;
        }
        .adm-info-item__value {
            font-size: .88rem;
            font-weight: 600;
            color: #1a0a2e;
        }

        /* Tags inside modals */
        .adm-tags { display: flex; flex-wrap: wrap; gap: 6px; margin-top: 4px; }
        .adm-tag {
            background: linear-gradient(135deg, #f3eafd, #ede3fa);
            border: 1px solid #d4b4f2;
            border-radius: 50px;
            padding: 4px 11px;
            font-size: .72rem;
            font-weight: 600;
            color: #6a3da6;
        }

        /* Sub-services table inside modal */
        .adm-subsvc-table { width: 100%; border-collapse: collapse; font-size: .82rem; }
        .adm-subsvc-table th {
            font-size: .68rem;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #a08ab8;
            padding: 6px 10px;
            text-align: left;
            border-bottom: 1px solid #ede8f5;
        }
        .adm-subsvc-table td {
            padding: 8px 10px;
            border-bottom: 1px solid #f3eafd;
            color: #1a0a2e;
        }
        .adm-subsvc-table tr:last-child td { border-bottom: none; }
        .adm-subsvc-table .price-col { text-align: right; color: #8b4cc8; font-weight: 700; }

        .adm-divider { border: none; border-top: 1.5px solid #ede8f5; margin: 18px 0; }

        /* Button styles */
        .adm-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 22px;
            border: none;
            border-radius: 12px;
            font-family: 'Inter', sans-serif;
            font-size: .88rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.22s ease;
        }

        .adm-btn--primary {
            background: linear-gradient(135deg, #8b4cc8, #5a2d82);
            color: #fff;
            box-shadow: 0 6px 18px rgba(107,61,154,.35);
        }
        .adm-btn--primary:hover {
            background: linear-gradient(135deg, #9d5de0, #6b3da6);
            transform: translateY(-2px);
            box-shadow: 0 10px 26px rgba(107,61,154,.48);
        }

        .adm-btn--outline {
            background: #f3eafd;
            color: #6a3da6;
            border: 1.5px solid #d4b4f2;
        }
        .adm-btn--outline:hover {
            background: #ede3fa;
            border-color: #b890e8;
            transform: translateY(-1px);
        }

        .adm-btn--danger {
            background: rgba(192,51,74,.08);
            border: 1.5px solid rgba(192,51,74,.25);
            color: #c0334a;
        }
        .adm-btn--danger:hover {
            background: rgba(192,51,74,.15);
            transform: translateY(-1px);
        }

        .adm-btn--small { padding: 8px 14px; font-size: .78rem; border-radius: 9px; }

        /* Message textarea */
        .adm-textarea {
            width: 100%;
            min-height: 110px;
            background: #faf7ff;
            border: 1.5px solid #ede8f5;
            border-radius: 12px;
            color: #1a0a2e;
            font-family: 'Inter', sans-serif;
            font-size: .88rem;
            padding: 12px 15px;
            resize: vertical;
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none;
        }
        .adm-textarea:focus {
            border-color: #8b4cc8;
            box-shadow: 0 0 0 3px rgba(139,76,200,.14);
        }

        .adm-textarea-label {
            display: block;
            font-size: .72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #a08ab8;
            margin-bottom: 8px;
        }

        /* Status update select */
        .adm-status-select {
            background: #faf7ff;
            border: 1.5px solid #ede8f5;
            border-radius: 10px;
            color: #1a0a2e;
            font-family: 'Inter', sans-serif;
            font-size: .85rem;
            padding: 8px 14px;
            outline: none;
            cursor: pointer;
            transition: border-color 0.2s;
        }
        .adm-status-select:focus { border-color: #8b4cc8; }

        /* Sign out */
        .admin-signout-wrap { text-align: center; padding-top: 10px; }
        .admin-signout-btn {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 12px 28px;
            background: rgba(192, 51, 74, 0.08);
            border: 1.5px solid rgba(192, 51, 74, 0.25);
            border-radius: 14px;
            color: #c0334a;
            font-size: 14px; font-weight: 700;
            cursor: pointer;
            font-family: 'Inter', sans-serif;
            transition: all 0.22s ease;
        }
        .admin-signout-btn:hover { background: rgba(192, 51, 74, 0.15); transform: translateY(-2px); }

        @media (max-width: 768px) {
            .admin-banner { flex-direction: column; text-align: center; padding: 28px 20px; }
            .admin-page   { padding: 20px 16px 40px; }
            .bookings-table th:nth-child(3),
            .bookings-table td:nth-child(3),
            .bookings-table th:nth-child(4),
            .bookings-table td:nth-child(4) { display: none; }
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

        {{-- Stats --}}
        <div class="admin-stats">
            <div class="stat-card">
                <div class="stat-card__icon">👥</div>
                <div class="stat-card__label">Total Customers</div>
                <div class="stat-card__value">{{ $totalCustomers }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-card__icon">📦</div>
                <div class="stat-card__label">Bookings</div>
                <div class="stat-card__value">{{ $totalBookings }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-card__icon">⏳</div>
                <div class="stat-card__label">Pending</div>
                <div class="stat-card__value">{{ $bookings->where('status','pending')->count() }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-card__icon">✅</div>
                <div class="stat-card__label">Confirmed</div>
                <div class="stat-card__value">{{ $bookings->where('status','confirmed')->count() }}</div>
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

        {{-- ═══════════════════════════
             BOOKINGS SECTION
        ════════════════════════════ --}}
        <h2 class="admin-section-title">Bookings</h2>
        <div class="bookings-card">
            <div class="bookings-card__header">
                <h3 class="bookings-card__title">📋 All Bookings</h3>
                <span class="bookings-count">{{ $totalBookings }} total</span>
            </div>

            @if($bookings->isEmpty())
                <div class="bk-empty">
                    <span class="icon">📭</span>
                    No bookings yet. Once customers book an event, they will appear here.
                </div>
            @else
                <table class="bookings-table">
                    <thead>
                        <tr>
                            <th>Customer</th>
                            <th>Package</th>
                            <th>Event Date</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $booking)
                        <tr class="bk-row" onclick="openBookingModal({{ $booking->id }})">
                            <td>
                                @if($booking->customer)
                                    <div class="bk-customer">{{ $booking->customer->first_name }} {{ $booking->customer->last_name }}</div>
                                    <div class="bk-email">{{ $booking->customer->email }}</div>
                                @else
                                    <div class="bk-customer" style="color:#a08ab8;">Deleted Customer</div>
                                @endif
                            </td>
                            <td>{{ $booking->package_name }}</td>
                            <td>{{ \Carbon\Carbon::parse($booking->event_date)->format('M d, Y') }}</td>
                            <td>₱{{ number_format($booking->total_price, 0) }}</td>
                            <td>
                                <span class="bk-badge {{ $booking->statusBadgeClass() }}">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>
                            <td>
                                <button class="bk-view-btn" onclick="event.stopPropagation(); openBookingModal({{ $booking->id }})">
                                    View
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        {{-- Sign Out --}}
        <div class="admin-signout-wrap">
            <button class="admin-signout-btn" onclick="adminSignOut()">
                <span class="material-symbols-outlined">logout</span>
                Sign Out
            </button>
        </div>

    </main>

    {{-- ═══════════════════════════════════════════════
         BOOKING DATA (passed from controller, JSON for JS)
    ════════════════════════════════════════════════ --}}
    @php
        $bookingsJson = $bookings->map(function($b) {
            return [
                'id'             => $b->id,
                'customer_name'  => $b->customer
                                        ? ($b->customer->first_name . ' ' . $b->customer->last_name)
                                        : 'Deleted Customer',
                'customer_email' => $b->customer ? $b->customer->email : '—',
                'package_name'   => $b->package_name,
                'services'       => $b->services,
                'sub_services'   => $b->sub_services,
                'guest_count'    => $b->guest_count,
                'event_date'     => \Carbon\Carbon::parse($b->event_date)->format('F d, Y'),
                'total_price'    => number_format($b->total_price, 0),
                'payment_method' => $b->payment_method,
                'status'         => $b->status,
                'admin_message'  => $b->admin_message ?? '',
                'created_at'     => $b->created_at->format('M d, Y h:i A'),
            ];
        })->values()->all();
    @endphp
    <script>
    window.ADMIN_BOOKINGS = @json($bookingsJson);
    </script>

    {{-- ═══════════════════════════════════════════════
         BOOKING DETAIL MODAL
    ════════════════════════════════════════════════ --}}
    <div class="adm-backdrop" id="bkDetailBackdrop">
        <div class="adm-modal" style="max-width:620px;">
            <button class="adm-modal__close" onclick="closeBookingModal()">✕</button>

            <p class="adm-modal__sub" id="bkDetailCreatedAt" style="color:#a08ab8; font-size:.75rem; margin-bottom:6px;"></p>
            <h2 class="adm-modal__title" id="bkDetailTitle">Booking Details</h2>
            <p class="adm-modal__sub" id="bkDetailSubtitle"></p>

            {{-- Customer info --}}
            <div class="adm-info-grid" id="bkDetailCustomer"></div>

            <hr class="adm-divider">

            {{-- Booking info --}}
            <div class="adm-info-grid" id="bkDetailBooking"></div>

            {{-- Services --}}
            <div style="margin-bottom:14px;">
                <div class="adm-info-item__label" style="margin-bottom:8px;">Main Services</div>
                <div class="adm-tags" id="bkDetailServices"></div>
            </div>

            {{-- Sub-services table --}}
            <div style="margin-bottom:14px;">
                <div class="adm-info-item__label" style="margin-bottom:8px;">Sub-Services Selected</div>
                <table class="adm-subsvc-table">
                    <thead>
                        <tr>
                            <th>Sub-Service</th>
                            <th class="price-col">Price</th>
                        </tr>
                    </thead>
                    <tbody id="bkDetailSubSvcs"></tbody>
                </table>
            </div>

            <hr class="adm-divider">

            {{-- Admin message if already sent --}}
            <div id="bkDetailAdminMsg" style="display:none; margin-bottom:14px;">
                <div class="adm-info-item__label" style="margin-bottom:6px;">Admin Message Sent</div>
                <div id="bkDetailAdminMsgText" style="font-size:.85rem; color:#1a0a2e; background:#faf7ff; border:1.5px solid #ede8f5; border-radius:10px; padding:10px 14px;"></div>
            </div>

            {{-- Status update --}}
            <div style="display:flex; align-items:center; gap:12px; margin-bottom:20px;">
                <div class="adm-info-item__label" style="margin:0;">Status</div>
                <select class="adm-status-select" id="bkStatusSelect" onchange="updateBookingStatus(this.value)">
                    <option value="pending">Pending</option>
                    <option value="confirmed">Confirmed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>

            {{-- Action buttons --}}
            <div style="display:flex; gap:12px; flex-wrap:wrap;">
                <button class="adm-btn adm-btn--primary" onclick="openContactModal()">
                    ✉️ Contact Customer
                </button>
                <button class="adm-btn adm-btn--outline" onclick="closeBookingModal()">
                    Close
                </button>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════
         CONTACT CUSTOMER MODAL
    ════════════════════════════════════════════════ --}}
    <div class="adm-backdrop" id="bkContactBackdrop">
        <div class="adm-modal" style="max-width:560px;">
            <button class="adm-modal__close" onclick="closeContactModal()">✕</button>

            <h2 class="adm-modal__title">✉️ Contact Customer</h2>
            <p class="adm-modal__sub" id="contactSubtitle"></p>

            {{-- Customer recap --}}
            <div class="adm-info-grid" id="contactCustomerInfo" style="margin-bottom:14px;"></div>

            {{-- Booking recap --}}
            <div style="background:#faf7ff; border:1.5px solid #ede8f5; border-radius:14px; padding:14px 18px; margin-bottom:18px;">
                <div class="adm-info-item__label" style="margin-bottom:8px;">Booking Summary</div>
                <div id="contactBookingSummary" style="font-size:.85rem; color:#1a0a2e; line-height:1.7;"></div>
                <div class="adm-tags" id="contactServiceTags" style="margin-top:10px;"></div>
                <div style="font-size:.78rem; color:#8b4cc8; font-weight:700; margin-top:8px;" id="contactSubSvcList"></div>
            </div>

            {{-- Message --}}
            <label class="adm-textarea-label" for="contactMessage">Your Message to the Customer</label>
            <textarea
                class="adm-textarea"
                id="contactMessage"
                placeholder="Hello! I'm reaching out regarding your booking for [Package Name]..."
            ></textarea>

            <div style="display:flex; gap:12px; margin-top:16px; flex-wrap:wrap;">
                <button class="adm-btn adm-btn--primary" id="contactSendBtn" onclick="sendAdminMessage()">
                    📨 Send Message
                </button>
                <button class="adm-btn adm-btn--outline" onclick="closeContactModal()">
                    Cancel
                </button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('javascript/Burger.js') }}"></script>
    <script src="{{ asset('javascript/toast.js') }}"></script>
    <script>
        /* ── Sign Out ── */
        async function adminSignOut() {
            try {
                await fetch('/auth/logout', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type': 'application/json',
                    },
                });
            } catch(e) {}
            // Redirect with ?signedout=1 so the homepage opens the Sign In panel automatically
            window.location.href = '/?signedout=1';
        }

        /* ── State ── */
        let activeBookingId = null;

        function getBooking(id) {
            return window.ADMIN_BOOKINGS.find(b => b.id == id) || null;
        }

        /* ── Booking Detail Modal ── */
        function openBookingModal(id) {
            const b = getBooking(id);
            if (!b) return;
            activeBookingId = id;

            document.getElementById('bkDetailCreatedAt').textContent = 'Booked on: ' + b.created_at;
            document.getElementById('bkDetailTitle').textContent = b.package_name;
            document.getElementById('bkDetailSubtitle').textContent = 'Payment via ' + b.payment_method + ' · ' + b.guest_count + ' guests';

            // Customer
            document.getElementById('bkDetailCustomer').innerHTML = `
                <div class="adm-info-item">
                    <div class="adm-info-item__label">Customer Name</div>
                    <div class="adm-info-item__value">${b.customer_name}</div>
                </div>
                <div class="adm-info-item">
                    <div class="adm-info-item__label">Email</div>
                    <div class="adm-info-item__value">${b.customer_email}</div>
                </div>
            `;

            // Booking info
            document.getElementById('bkDetailBooking').innerHTML = `
                <div class="adm-info-item">
                    <div class="adm-info-item__label">Event Date</div>
                    <div class="adm-info-item__value">${b.event_date}</div>
                </div>
                <div class="adm-info-item">
                    <div class="adm-info-item__label">Guest Count</div>
                    <div class="adm-info-item__value">${b.guest_count} guests</div>
                </div>
                <div class="adm-info-item">
                    <div class="adm-info-item__label">Total Price</div>
                    <div class="adm-info-item__value" style="color:#5a2d82; font-size:1.1rem;">₱${b.total_price}</div>
                </div>
                <div class="adm-info-item">
                    <div class="adm-info-item__label">Payment Method</div>
                    <div class="adm-info-item__value">${b.payment_method}</div>
                </div>
            `;

            // Services
            const svcContainer = document.getElementById('bkDetailServices');
            svcContainer.innerHTML = (b.services || []).map(s => `<span class="adm-tag">${s}</span>`).join('');

            // Sub-services
            const tbody = document.getElementById('bkDetailSubSvcs');
            if (b.sub_services && b.sub_services.length) {
                tbody.innerHTML = b.sub_services.map(ss => `
                    <tr>
                        <td>${ss.label}</td>
                        <td class="price-col">₱${Number(ss.price).toLocaleString('en-PH')}</td>
                    </tr>
                `).join('');
            } else {
                tbody.innerHTML = '<tr><td colspan="2" style="color:#a08ab8; text-align:center;">No sub-services selected</td></tr>';
            }

            // Admin message
            const msgWrap = document.getElementById('bkDetailAdminMsg');
            const msgText = document.getElementById('bkDetailAdminMsgText');
            if (b.admin_message) {
                msgText.textContent = b.admin_message;
                msgWrap.style.display = 'block';
            } else {
                msgWrap.style.display = 'none';
            }

            // Status select
            document.getElementById('bkStatusSelect').value = b.status;

            document.getElementById('bkDetailBackdrop').classList.add('is-open');
            document.body.style.overflow = 'hidden';
        }

        function closeBookingModal() {
            document.getElementById('bkDetailBackdrop').classList.remove('is-open');
            document.body.style.overflow = '';
        }

        document.getElementById('bkDetailBackdrop').addEventListener('click', function(e) {
            if (e.target === this) closeBookingModal();
        });

        /* ── Status Update ── */
        async function updateBookingStatus(newStatus) {
            if (!activeBookingId) return;
            try {
                const res = await fetch(`/admin/bookings/${activeBookingId}/status`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    body: JSON.stringify({ status: newStatus }),
                });
                const data = await res.json();
                if (data.success && typeof window.showToast === 'function') {
                    window.showToast('success', 'Status updated to "' + newStatus + '".');
                    // update local state
                    const b = getBooking(activeBookingId);
                    if (b) b.status = newStatus;
                }
            } catch(e) {
                if (typeof window.showToast === 'function') {
                    window.showToast('error', 'Failed to update status.');
                }
            }
        }

        /* ── Contact Modal ── */
        function openContactModal() {
            const b = getBooking(activeBookingId);
            if (!b) return;

            document.getElementById('contactSubtitle').textContent = 'Sending message to ' + b.customer_name;

            document.getElementById('contactCustomerInfo').innerHTML = `
                <div class="adm-info-item">
                    <div class="adm-info-item__label">Name</div>
                    <div class="adm-info-item__value">${b.customer_name}</div>
                </div>
                <div class="adm-info-item">
                    <div class="adm-info-item__label">Email</div>
                    <div class="adm-info-item__value">${b.customer_email}</div>
                </div>
            `;

            document.getElementById('contactBookingSummary').innerHTML = `
                <strong>Package:</strong> ${b.package_name}<br>
                <strong>Event Date:</strong> ${b.event_date}<br>
                <strong>Guests:</strong> ${b.guest_count}<br>
                <strong>Total:</strong> ₱${b.total_price}<br>
                <strong>Payment:</strong> ${b.payment_method}
            `;

            document.getElementById('contactServiceTags').innerHTML =
                (b.services || []).map(s => `<span class="adm-tag">${s}</span>`).join('');

            document.getElementById('contactSubSvcList').innerHTML =
                (b.sub_services || []).map(ss => `${ss.label} — ₱${Number(ss.price).toLocaleString('en-PH')}`).join('<br>');

            // Pre-fill any existing message
            document.getElementById('contactMessage').value = b.admin_message || '';

            document.getElementById('bkContactBackdrop').classList.add('is-open');
        }

        function closeContactModal() {
            document.getElementById('bkContactBackdrop').classList.remove('is-open');
        }

        document.getElementById('bkContactBackdrop').addEventListener('click', function(e) {
            if (e.target === this) closeContactModal();
        });

        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') {
                closeContactModal();
                closeBookingModal();
            }
        });

        /* ── Send Admin Message ── */
        async function sendAdminMessage() {
            if (!activeBookingId) return;
            const message = document.getElementById('contactMessage').value.trim();
            if (!message) {
                if (typeof window.showToast === 'function') {
                    window.showToast('error', 'Please enter a message before sending.');
                }
                return;
            }

            const btn = document.getElementById('contactSendBtn');
            btn.disabled = true;
            btn.textContent = 'Sending…';

            try {
                const res = await fetch(`/admin/bookings/${activeBookingId}/message`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    body: JSON.stringify({ admin_message: message }),
                });

                const data = await res.json();

                if (res.ok && data.success) {
                    // Update local state
                    const b = getBooking(activeBookingId);
                    if (b) b.admin_message = message;

                    // Update message display in detail modal
                    const msgWrap = document.getElementById('bkDetailAdminMsg');
                    document.getElementById('bkDetailAdminMsgText').textContent = message;
                    msgWrap.style.display = 'block';

                    closeContactModal();
                    if (typeof window.showToast === 'function') {
                        window.showToast('success', '✅ Message saved successfully!', 4000);
                    }
                } else {
                    throw new Error(data.message || 'Could not save message.');
                }
            } catch(err) {
                if (typeof window.showToast === 'function') {
                    window.showToast('error', '❌ ' + err.message);
                }
            } finally {
                btn.disabled = false;
                btn.textContent = '📨 Send Message';
            }
        }
    </script>
</body>
</html>
