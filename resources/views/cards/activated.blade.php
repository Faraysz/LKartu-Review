<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Teraktivasi — {{ $card->business_name }}</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter+Tight:wght@600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --ink: #0F172A;
            --primary: #2563EB;
            --primary-dark: #1D4ED8;
            --surface: #FFFFFF;
            --bg: #F8FAFC;
            --muted: #64748B;
            --line: #E2E8F0;
            --success: #10B981;
            --success-bg: #ECFDF5;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            background: radial-gradient(circle at 50% 0%, #ECFDF5 0%, var(--bg) 70%);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 32px 16px;
            -webkit-font-smoothing: antialiased;
        }

        h1, h2, h3, h4, h5, h6, strong, b,
        .card__title,
        .card__brand,
        .btn-review,
        .btn-home,
        .success-msg__title,
        .card__code,
        .card__code-label,
        .qr-section__label {
            font-family: 'Inter Tight', sans-serif !important;
        }

        .card {
            width: 100%;
            max-width: 460px;
            background: var(--surface);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 40px -15px rgba(16, 185, 129, 0.12), 0 0 1px 1px rgba(226, 232, 240, 0.8);
            border: 1px solid var(--line);
        }

        /* ── Header ── */
        .card__header {
            background: linear-gradient(145deg, #0F172A 0%, #1E293B 100%);
            color: #fff;
            padding: 28px;
        }

        .card__brand {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #94A3B8;
            margin-bottom: 12px;
        }

        .card__brand-logo {
            height: 24px;
            width: auto;
            object-fit: contain;
            border-radius: 6px;
        }

        .card__header-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
        }

        .card__title {
            font-size: 22px;
            font-weight: 800;
            line-height: 1.25;
            margin-bottom: 6px;
            letter-spacing: -0.5px;
        }

        .card__subtitle {
            font-size: 13px;
            color: #94A3B8;
            line-height: 1.5;
        }

        /* ── Stamp: circle outline + checkmark ── */
        .card__stamp {
            flex-shrink: 0;
            width: 48px;
            height: 48px;
            border: 2.5px solid var(--success);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(16, 185, 129, 0.15);
            transform: rotate(-6deg);
        }

        .card__stamp svg {
            width: 24px;
            height: 24px;
            color: var(--success);
        }

        .card__code-row {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 18px;
            padding: 8px 14px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 100px;
        }

        .card__code-label {
            font-size: 11px;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #94A3B8;
            font-weight: 700;
        }

        .card__code {
            font-size: 15px;
            font-weight: 800;
            font-family: monospace;
            letter-spacing: 2px;
            color: #34D399;
        }

        /* ── Body ── */
        .card__body {
            padding: 28px;
        }

        /* ── Success message ── */
        .success-msg {
            background: var(--success-bg);
            border: 1px solid #A7F3D0;
            padding: 14px 18px;
            border-radius: 12px;
            margin-bottom: 22px;
        }

        .success-msg__title {
            font-weight: 800;
            font-size: 14px;
            color: #065F46;
            margin-bottom: 4px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .success-msg__text {
            font-size: 13px;
            color: #047857;
            line-height: 1.5;
        }

        /* ── QR code section ── */
        .qr-section {
            text-align: center;
            margin-bottom: 24px;
            padding: 24px 20px;
            background: var(--bg);
            border-radius: 16px;
            border: 1px solid var(--line);
        }

        .qr-section__label {
            font-size: 13px;
            font-weight: 700;
            color: var(--ink);
            margin-bottom: 14px;
        }

        .qr-section__image {
            display: inline-block;
            background: #fff;
            padding: 14px;
            border-radius: 14px;
            border: 1px solid var(--line);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .qr-section__image img {
            display: block;
            width: 170px;
            height: 170px;
        }

        .qr-section__hint {
            font-size: 12px;
            color: var(--muted);
            margin-top: 12px;
            line-height: 1.5;
        }

        /* ── Summary ── */
        .summary {
            margin-bottom: 26px;
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 12px;
            padding: 12px 18px;
        }

        .summary__row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 10px 0;
            border-bottom: 1px solid var(--line);
            gap: 16px;
        }

        .summary__row:last-child {
            border-bottom: none;
        }

        .summary__label {
            font-size: 12px;
            font-weight: 700;
            color: var(--muted);
            flex-shrink: 0;
        }

        .summary__value {
            font-size: 13px;
            font-weight: 600;
            color: var(--ink);
            text-align: right;
            word-break: break-all;
            line-height: 1.5;
        }

        .summary__value a {
            color: var(--primary);
            text-decoration: none;
        }

        .summary__value a:hover {
            text-decoration: underline;
        }

        /* ── Buttons ── */
        .btn-review {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            padding: 14px;
            background: var(--ink);
            color: #fff;
            border: none;
            border-radius: 100px;
            font-family: inherit;
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s ease;
            box-shadow: 0 4px 14px rgba(15, 23, 42, 0.2);
        }

        .btn-review:hover {
            background: #1E293B;
            transform: translateY(-1px);
        }

        .btn-review svg {
            width: 16px;
            height: 16px;
        }

        .btn-home {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            background: transparent;
            color: var(--muted);
            border: 1px solid var(--line);
            border-radius: 100px;
            font-family: inherit;
            font-weight: 600;
            font-size: 13px;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s;
        }

        .btn-home:hover {
            color: var(--ink);
            border-color: #94A3B8;
            background: #F8FAFC;
        }

        .btn-home svg {
            width: 15px;
            height: 15px;
        }

        /* ── Footer ── */
        .card__footer {
            text-align: center;
            padding: 0 28px 24px;
            font-size: 12px;
            color: var(--muted);
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <div class="card">
        {{-- Header --}}
        <div class="card__header">
            <div class="card__brand">
                <img src="{{ asset('logo.png') }}" alt="Logo" class="card__brand-logo">
                <span>Tapin</span>
            </div>
            <div class="card__header-top">
                <div>
                    <h1 class="card__title">Kartu Siap Digunakan</h1>
                    <p class="card__subtitle">Kartu ulasan pintar tokomu telah aktif.</p>
                </div>
                <div class="card__stamp">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                </div>
            </div>
            <div class="card__code-row">
                <span class="card__code-label">KODE KARTU:</span>
                <span class="card__code">{{ $card->unique_code }}</span>
            </div>
        </div>

        {{-- Body --}}
        <div class="card__body">
            <div class="success-msg">
                <div class="success-msg__title">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                    Aktivasi Sukses
                </div>
                <div class="success-msg__text">
                    Mulai sekarang, siapapun yang men-tap NFC kartu ini atau scan QR akan langsung diarahkan ke halaman Google Review tokomu.
                </div>
            </div>

            {{-- QR Code section --}}
            <div class="qr-section">
                <div class="qr-section__label">Scan untuk uji coba langsung:</div>
                <div class="qr-section__image">
                    <img
                        src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data={{ urlencode($card->target_url) }}"
                        alt="QR Code {{ $card->business_name }}"
                        loading="lazy"
                    >
                </div>
                <div class="qr-section__hint">
                    Arahkan kamera HP ke QR Code di atas untuk mengetes halaman Google Review usaha kamu.
                </div>
            </div>

            {{-- Data summary --}}
            <div class="summary">
                <div class="summary__row">
                    <div class="summary__label">Nama Usaha</div>
                    <div class="summary__value">{{ $card->business_name }}</div>
                </div>
                <div class="summary__row">
                    <div class="summary__label">Target Review</div>
                    <div class="summary__value">
                        <a href="{{ $card->target_url }}" target="_blank" rel="noopener">
                            {{ Str::limit($card->target_url, 38) }} ↗
                        </a>
                    </div>
                </div>
                <div class="summary__row">
                    <div class="summary__label">Waktu Aktif</div>
                    <div class="summary__value">{{ $card->activated_at?->format('d M Y, H:i') ?? '-' }} WIB</div>
                </div>
            </div>

            <a href="{{ $card->target_url }}" target="_blank" rel="noopener" class="btn-review">
                <span>Buka Link Google Review</span>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                    <polyline points="15 3 21 3 21 9"></polyline>
                    <line x1="10" y1="14" x2="21" y2="3"></line>
                </svg>
            </a>

            <a href="/" class="btn-home">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
                <span>Kembali ke Beranda</span>
            </a>
        </div>

        <div class="card__footer">
            Kartu fisik sudah siap dipajang di kasir atau meja tokomu.
        </div>
    </div>
</body>
</html>
