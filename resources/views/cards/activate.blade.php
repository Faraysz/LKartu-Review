<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aktivasi kartu — {{ $card->unique_code }}</title>
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
            --error: #DC2626;
            --error-bg: #FEF2F2;
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
            max-width: 420px;
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

        .card__code {
            display: inline-block;
            margin-top: 14px;
            padding: 6px 14px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 6px;
            font-size: 16px;
            font-weight: 700;
            letter-spacing: 2px;
        }

        /* ── Body (form) ── */
        .card__body {
            padding: 24px 28px 28px;
        }

        .card__hint {
            font-size: 13px;
            color: var(--muted);
            line-height: 1.6;
            margin-bottom: 20px;
        }

        /* ── Alerts ── */
        .alert {
            padding: 12px 14px;
            border-radius: 8px;
            font-size: 13px;
            line-height: 1.5;
            margin-bottom: 16px;
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
            margin-bottom: 16px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--ink);
            margin-bottom: 6px;
        }

        .form-group input {
            width: 100%;
            padding: 11px 14px;
            border: 1px solid var(--line);
            border-radius: 8px;
            font-family: inherit;
            font-size: 14px;
            color: var(--ink);
            background: var(--surface);
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-group input::placeholder {
            color: #94A3B8;
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        /* ── Input group (input + maps button) ── */
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
            padding: 11px 14px;
            background: var(--ink);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-family: inherit;
            font-weight: 600;
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
            font-size: 11px;
            color: var(--muted);
            margin-top: 6px;
            line-height: 1.5;
        }

        .btn-activate {
            display: block;
            width: 100%;
            padding: 13px;
            margin-top: 24px;
            background: var(--primary);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-family: inherit;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-activate:hover {
            background: var(--primary-hover);
        }

        .btn-activate:active {
            transform: scale(0.98);
        }

        /* ── Footer ── */
        .card__footer {
            text-align: center;
            padding: 0 28px 20px;
            font-size: 11px;
            color: var(--muted);
        }
    </style>
</head>
<body>
    <div class="card">
        {{-- Header --}}
        <div class="card__header">
            <div class="card__brand">Kartu Review</div>
            <h1 class="card__title">Aktivasi kartu</h1>
            <p class="card__subtitle">Isi data usaha kamu untuk mengaktifkan kartu ini.</p>
            <div class="card__code">{{ $card->unique_code }}</div>
        </div>

        {{-- Body --}}
        <div class="card__body">
            <p class="card__hint">
                Setelah diaktifkan, setiap kartu ini di-tap atau di-scan, pelanggan akan langsung diarahkan ke halaman Google Review usaha kamu.
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
                    <label for="business_name">Nama usaha</label>
                    <input type="text" id="business_name" name="business_name" placeholder="Contoh: Kopi Senja" value="{{ old('business_name') }}" required>
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
                        Klik <strong>Maps</strong> → cari usaha kamu → tekan <strong>Bagikan</strong> → salin link → paste di sini.
                    </div>
                </div>

                <button type="submit" class="btn-activate">Aktivasi kartu sekarang</button>
            </form>
        </div>

        <div class="card__footer">
            Kartu ini hanya bisa diaktivasi satu kali.
        </div>
    </div>
</body>
</html>
