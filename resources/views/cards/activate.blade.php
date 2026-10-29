<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aktivasi Kartu — {{ $card->unique_code }}</title>
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
            --error: #EF4444;
            --error-bg: #FEF2F2;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            background: radial-gradient(circle at 50% 0%, #EFF6FF 0%, var(--bg) 70%);
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
        .btn-activate,
        .btn-maps {
            font-family: 'Inter Tight', sans-serif !important;
            letter-spacing: -0.03em;
        }

        .card {
            width: 100%;
            max-width: 440px;
            background: var(--surface);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 40px -15px rgba(37, 99, 235, 0.12), 0 0 1px 1px rgba(226, 232, 240, 0.8);
            border: 1px solid var(--line);
        }

        /* ── Header ── */
        .card__header {
            background: linear-gradient(145deg, #0F172A 0%, #1E293B 100%);
            color: #fff;
            padding: 28px 28px 24px;
            position: relative;
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

        .card__code {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 16px;
            padding: 6px 14px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 100px;
            font-size: 13px;
            font-family: monospace;
            font-weight: 700;
            letter-spacing: 1.5px;
            color: #60A5FA;
        }

        /* ── Body ── */
        .card__body {
            padding: 28px;
        }

        .card__hint {
            font-size: 13px;
            color: var(--muted);
            line-height: 1.6;
            margin-bottom: 22px;
        }

        /* ── Alerts ── */
        .alert {
            padding: 12px 14px;
            border-radius: 10px;
            font-size: 13px;
            line-height: 1.5;
            margin-bottom: 18px;
        }
        .alert--success {
            background: var(--success-bg);
            color: var(--success);
            border-left: 3px solid var(--success);
        }
        .alert--error {
            background: var(--error-bg);
            color: var(--error);
            border-left: 3px solid var(--error);
        }

        /* ── Form ── */
        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            color: var(--ink);
            margin-bottom: 6px;
        }

        .form-group input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--line);
            border-radius: 12px;
            font-family: inherit;
            font-size: 14px;
            color: var(--ink);
            background: #fff;
            transition: all 0.2s;
        }

        .form-group input::placeholder {
            color: #94A3B8;
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.12);
        }

        /* ── Input group ── */
        .input-group {
            display: flex;
            gap: 8px;
        }

        .input-group input {
            flex: 1;
            min-width: 0;
        }

        .btn-maps {
            flex-shrink: 0;
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 12px 16px;
            background: var(--ink);
            color: #fff;
            border: none;
            border-radius: 12px;
            font-family: inherit;
            font-weight: 700;
            font-size: 13px;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.2s;
            white-space: nowrap;
        }

        .btn-maps:hover {
            background: #1E293B;
        }

        .btn-maps svg {
            width: 16px;
            height: 16px;
            flex-shrink: 0;
        }

        .form-hint {
            font-size: 12px;
            color: var(--muted);
            margin-top: 8px;
            line-height: 1.5;
        }

        .btn-activate {
            display: block;
            width: 100%;
            padding: 14px;
            margin-top: 24px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: #fff;
            border: none;
            border-radius: 100px;
            font-family: inherit;
            font-weight: 700;
            font-size: 15px;
            cursor: pointer;
            box-shadow: 0 6px 18px rgba(37, 99, 235, 0.3);
            transition: all 0.2s ease;
        }

        .btn-activate:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 24px rgba(37, 99, 235, 0.4);
        }

        .btn-activate:active {
            transform: scale(0.98);
        }

        /* ── Footer ── */
        .card__footer {
            text-align: center;
            padding: 0 28px 22px;
            font-size: 12px;
            color: var(--muted);
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
            <h1 class="card__title">Aktivasi Kartu Pintar</h1>
            <p class="card__subtitle">Isi data usaha kamu untuk mulai menerima ulasan otomatis.</p>
            <div class="card__code">
                <span>ID:</span>
                <span>{{ $card->unique_code }}</span>
            </div>
        </div>

        {{-- Body --}}
        <div class="card__body">
            <p class="card__hint">
                Setelah diaktifkan, setiap kali kartu ini di-tap atau di-scan, pelanggan akan langsung diarahkan ke halaman Google Review usaha kamu.
            </p>

            @if (session('success'))
                <div class="alert alert--success">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert--error">
                    @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('cards.activate.submit', ['code' => $card->unique_code]) }}">
                @csrf

                <div class="form-group">
                    <label for="business_name">Nama Usaha / Toko</label>
                    <input type="text" id="business_name" name="business_name" placeholder="Contoh: Usaha Kamu" value="{{ old('business_name') }}" required>
                </div>

                <div class="form-group">
                    <label for="target_url">Link Google Review</label>
                    <div class="input-group">
                        <input type="url" id="target_url" name="target_url" placeholder="Paste link dari Google Maps" value="{{ old('target_url') }}" required>
                        <a href="https://www.google.com/maps" target="_blank" rel="noopener" class="btn-maps" title="Buka Google Maps">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                            Maps
                        </a>
                    </div>
                    <div class="form-hint">
                        Klik <strong>Maps</strong> → cari usaha kamu → tekan <strong>Bagikan</strong> → salin link → paste di kolom ini.
                    </div>
                </div>

                <button type="submit" class="btn-activate">Aktivasi Kartu Sekarang</button>
            </form>
        </div>

        <div class="card__footer">
            Kartu fisik ini akan langsung aktif permanen setelah disimpan.
        </div>
    </div>
</body>
</html>
