<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu teraktivasi — {{ $card->business_name }}</title>
    <style>
        :root {
            --ink: #0F172A;
            --primary: #2563EB;
            --primary-hover: #1D4ED8;
            --surface: #FFFFFF;
            --bg: #F1F5F9;
            --muted: #64748B;
            --line: #E2E8F0;
            --success: #16A34A;
            --success-bg: #F0FDF4;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'SF Pro Text', 'SF Pro Display', system-ui, sans-serif;
            background: var(--bg);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 24px 16px;
            -webkit-font-smoothing: antialiased;
        }

        .card {
            width: 100%;
            max-width: 440px;
            background: var(--surface);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 24px rgba(15, 23, 42, 0.08);
        }

        /* ── Header (dark navy) ── */
        .card__header {
            background: var(--ink);
            color: #fff;
            padding: 24px 28px;
        }

        .card__brand {
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            opacity: 0.4;
            margin-bottom: 10px;
        }

        .card__header-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
        }

        .card__title {
            font-size: 20px;
            font-weight: 700;
            line-height: 1.3;
            margin-bottom: 4px;
        }

        .card__subtitle {
            font-size: 13px;
            opacity: 0.55;
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
            transform: rotate(-6deg);
        }

        .card__stamp svg {
            width: 22px;
            height: 22px;
            color: var(--success);
        }

        .card__code-row {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 16px;
            padding: 8px 14px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 6px;
        }

        .card__code-label {
            font-size: 10px;
            letter-spacing: 1px;
            text-transform: uppercase;
            opacity: 0.4;
        }

        .card__code {
            font-size: 18px;
            font-weight: 700;
            letter-spacing: 2px;
        }

        /* ── Body ── */
        .card__body {
            padding: 24px 28px 28px;
        }

        /* ── Success message ── */
        .success-msg {
            background: var(--success-bg);
            border-left: 3px solid var(--success);
            padding: 14px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .success-msg__title {
            font-weight: 700;
            font-size: 14px;
            color: var(--success);
            margin-bottom: 4px;
        }

        .success-msg__text {
            font-size: 13px;
            color: var(--muted);
            line-height: 1.6;
        }

        /* ── QR code section ── */
        .qr-section {
            text-align: center;
            margin-bottom: 24px;
            padding: 20px;
            background: var(--bg);
            border-radius: 10px;
        }

        .qr-section__label {
            font-size: 12px;
            font-weight: 600;
            color: var(--muted);
            margin-bottom: 14px;
        }

        .qr-section__image {
            display: inline-block;
            background: #fff;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid var(--line);
        }

        .qr-section__image img {
            display: block;
            width: 160px;
            height: 160px;
        }

        .qr-section__hint {
            font-size: 11px;
            color: var(--muted);
            margin-top: 10px;
            line-height: 1.5;
        }

        /* ── Summary ── */
        .summary {
            margin-bottom: 24px;
        }

        .summary__row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 11px 0;
            border-bottom: 1px solid var(--line);
            gap: 16px;
        }

        .summary__row:last-child {
            border-bottom: none;
        }

        .summary__label {
            font-size: 12px;
            font-weight: 600;
            color: var(--muted);
            flex-shrink: 0;
        }

        .summary__value {
            font-size: 14px;
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

        /* ── Button (ink for navigation) ── */
        .btn-review {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            padding: 13px;
            background: var(--ink);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-family: inherit;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.2s;
        }

        .btn-review:hover {
            background: #1E293B;
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
            border-radius: 8px;
            font-family: inherit;
            font-weight: 500;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            transition: color 0.2s, border-color 0.2s;
        }

        .btn-home:hover {
            color: var(--ink);
            border-color: var(--muted);
        }

        .btn-home svg {
            width: 15px;
            height: 15px;
        }

        /* ── Footer ── */
        .card__footer {
            text-align: center;
            padding: 0 28px 20px;
            font-size: 11px;
            color: var(--muted);
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <div class="card">
        {{-- Header --}}
        <div class="card__header">
            <div class="card__brand">Kartu Review</div>
            <div class="card__header-top">
                <div>
                    <h1 class="card__title">Kartu teraktivasi</h1>
                    <p class="card__subtitle">Kartu ini sudah siap digunakan.</p>
                </div>
                <div class="card__stamp">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                </div>
            </div>
            <div class="card__code-row">
                <span class="card__code-label">No. kartu</span>
                <span class="card__code">{{ $card->unique_code }}</span>
            </div>
        </div>

        {{-- Body --}}
        <div class="card__body">
            <div class="success-msg">
                <div class="success-msg__title">Aktivasi berhasil</div>
                <p class="success-msg__text">
                    Isi sekali saja. Setelah ini, kartu akan langsung mengarah ke halaman review kamu setiap kali ditap — permanen.
                </p>
            </div>

            {{-- QR code yang bisa di-scan --}}
            <div class="qr-section">
                <div class="qr-section__label">Scan untuk buka halaman usaha ini</div>
                <div class="qr-section__image">
                    <img
                        src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data={{ urlencode($card->target_url) }}&margin=0"
                        alt="QR code {{ $card->unique_code }}"
                        width="160"
                        height="160"
                    >
                </div>
                <div class="qr-section__hint">
                    Cetak atau screenshot QR ini untuk ditempel di tempat usaha kamu.
                </div>
            </div>

            {{-- Ringkasan --}}
            <div class="summary">
                <div class="summary__row">
                    <span class="summary__label">Usaha</span>
                    <span class="summary__value">{{ $card->business_name }}</span>
                </div>
                <div class="summary__row">
                    <span class="summary__label">Link review</span>
                    <span class="summary__value">
                        <a href="{{ $card->target_url }}" target="_blank" rel="noopener">
                            {{ Str::limit($card->target_url, 40) }}
                        </a>
                    </span>
                </div>
                <div class="summary__row">
                    <span class="summary__label">Diaktifkan</span>
                    <span class="summary__value">
                        {{ $card->activated_at ? $card->activated_at->translatedFormat('d M Y, H:i') : '—' }}
                    </span>
                </div>
            </div>

            <a href="{{ $card->target_url }}" target="_blank" rel="noopener" class="btn-review">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                    <polyline points="15 3 21 3 21 9"></polyline>
                    <line x1="10" y1="14" x2="21" y2="3"></line>
                </svg>
                Buka link Google Review
            </a>

            <a href="/" class="btn-home">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
                Kembali ke beranda
            </a>
        </div>

        <div class="card__footer">
            Kartu ini sudah aktif secara permanen. Tidak perlu aktivasi ulang.
        </div>
    </div>
</body>
</html>
