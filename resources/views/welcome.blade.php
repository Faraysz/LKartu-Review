<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Review — Tap. Aktifkan. Dapatkan Review.</title>
    <style>
        :root {
            --ink: #0F172A;
            --paper: #F1F5F9;
            --surface: #FFFFFF;
            --stamp: #2563EB;
            --stamp-hover: #1D4ED8;
            --success: #16A34A;
            --muted: #64748B;
            --line: #E2E8F0;
            --warning-dot: #F59E0B;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'SF Pro Text', 'SF Pro Display', system-ui, sans-serif;
            background: var(--paper);
            color: var(--ink);
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
        }

        /* ── NAV ── */
        .nav {
            position: fixed; top: 0; left: 0; right: 0; z-index: 100;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--line);
        }
        .nav__inner {
            max-width: 1080px; margin: 0 auto;
            padding: 16px 24px;
            display: flex; align-items: center; justify-content: space-between;
        }
        .nav__brand {
            font-family: -apple-system, BlinkMacSystemFont, 'SF Pro Display', system-ui, sans-serif;
            font-weight: 700; font-size: 18px;
            color: var(--ink); text-decoration: none;
        }
        .nav__brand span { color: var(--stamp); }
        .nav__links { display: flex; gap: 28px; align-items: center; }
        .nav__link {
            font-size: 14px; font-weight: 500; color: var(--muted);
            text-decoration: none; transition: color 0.2s;
        }
        .nav__link:hover { color: var(--ink); }
        .nav__cta {
            font-size: 13px; font-weight: 600; color: #fff;
            background: var(--ink); padding: 8px 18px; border-radius: 6px;
            text-decoration: none; transition: background 0.2s;
        }
        .nav__cta:hover { background: #1E293B; }

        /* ── HERO ── */
        .hero {
            min-height: 100vh;
            display: flex; align-items: center; justify-content: center;
            padding: 120px 24px 80px;
        }
        .hero__inner {
            max-width: 1080px; width: 100%;
            display: grid; grid-template-columns: 1fr 1fr; gap: 64px;
            align-items: center;
        }
        .hero__badge {
            display: inline-flex; align-items: center; gap: 6px;
            font-size: 12px; font-weight: 500;
            color: var(--muted);
            padding: 6px 14px; border-radius: 100px;
            border: 1px solid var(--line); margin-bottom: 20px;
        }
        .hero__badge-dot {
            width: 6px; height: 6px; border-radius: 50%;
            background: var(--stamp);
        }
        .hero__title {
            font-family: -apple-system, BlinkMacSystemFont, 'SF Pro Display', system-ui, sans-serif;
            font-weight: 500; font-size: clamp(32px, 4.5vw, 48px);
            line-height: 1.15; margin-bottom: 20px;
            color: var(--ink);
        }
        .hero__title em {
            font-style: normal; color: var(--stamp);
        }
        .hero__desc {
            font-size: 16px; color: var(--muted); line-height: 1.7;
            margin-bottom: 32px; max-width: 440px;
        }
        .hero__actions { display: flex; gap: 12px; flex-wrap: wrap; }
        .btn-primary {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 13px 24px; background: var(--stamp); color: #fff;
            border-radius: 6px; font-weight: 600; font-size: 15px;
            text-decoration: none; transition: background 0.2s;
        }
        .btn-primary:hover { background: var(--stamp-hover); }
        .btn-secondary {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 13px 24px; background: transparent; color: var(--ink);
            border: 1px solid var(--line); border-radius: 6px;
            font-weight: 600; font-size: 15px; text-decoration: none;
            transition: border-color 0.2s;
        }
        .btn-secondary:hover { border-color: var(--ink); }

        /* ── Card mockup ── */
        .hero__visual { display: flex; justify-content: center; }
        .card-mock { width: 280px; }
        .card-mock__inner {
            background: var(--ink);
            border-radius: 4px;
            padding: 24px;
            color: var(--surface);
            position: relative;
            box-shadow: 0 12px 32px rgba(15, 23, 42, 0.1);
        }
        .card-mock__chip {
            width: 40px; height: 28px;
            background: linear-gradient(135deg, #c9a84c, #e8d48b);
            border-radius: 4px; margin-bottom: 20px;
            position: relative;
        }
        .card-mock__chip::after {
            content: ''; position: absolute;
            top: 5px; left: 5px; right: 5px; bottom: 5px;
            border: 1px solid rgba(0,0,0,0.15); border-radius: 2px;
        }
        .card-mock__nfc {
            position: absolute; top: 24px; right: 24px;
            opacity: 0.3;
        }
        .card-mock__label {
            font-size: 10px; letter-spacing: 1px;
            opacity: 0.4; margin-bottom: 4px;
        }
        .card-mock__url {
            font-family: -apple-system, BlinkMacSystemFont, 'SF Pro Display', system-ui, sans-serif;
            font-size: 13px; opacity: 0.9;
            margin-bottom: 18px;
        }
        .card-mock__brand {
            font-family: -apple-system, BlinkMacSystemFont, 'SF Pro Display', system-ui, sans-serif;
            font-weight: 700; font-size: 14px;
        }
        .card-mock__code {
            font-family: -apple-system, BlinkMacSystemFont, 'SF Pro Display', system-ui, sans-serif;
            font-weight: 300; font-size: 20px; letter-spacing: 3px;
            margin-top: 6px; opacity: 0.5;
        }

        /* ── SECTIONS ── */
        .section { padding: 100px 24px; }
        .section--surface { background: var(--surface); }
        .section--ink { background: var(--ink); color: var(--surface); }
        .section__header {
            text-align: center; max-width: 520px; margin: 0 auto 60px;
        }
        .section__label {
            font-size: 12px; font-weight: 500;
            color: var(--stamp); margin-bottom: 10px;
        }
        .section__title {
            font-family: -apple-system, BlinkMacSystemFont, 'SF Pro Display', system-ui, sans-serif;
            font-weight: 500; font-size: clamp(24px, 3.5vw, 30px);
            line-height: 1.25; margin-bottom: 12px;
        }
        .section__desc {
            font-size: 15px; color: var(--muted); line-height: 1.7;
        }

        /* ── Steps ── */
        .steps {
            max-width: 960px; margin: 0 auto;
            display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px;
        }
        .step {
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: 4px; padding: 28px 24px;
            position: relative; overflow: hidden;
            transition: box-shadow 0.2s;
        }
        .step:hover {
            box-shadow: 0 12px 32px rgba(15, 23, 42, 0.1);
        }
        .step__number {
            font-family: -apple-system, BlinkMacSystemFont, 'SF Pro Display', system-ui, sans-serif;
            font-weight: 700; font-size: 56px;
            color: var(--paper); position: absolute;
            top: -6px; right: 12px; line-height: 1;
        }
        .step__icon {
            width: 40px; height: 40px;
            background: rgba(176, 64, 46, 0.08);
            border-radius: 4px;
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 16px; color: var(--stamp);
        }
        .step__icon svg { width: 20px; height: 20px; }
        .step__title {
            font-family: -apple-system, BlinkMacSystemFont, 'SF Pro Display', system-ui, sans-serif;
            font-weight: 500; font-size: 18px; margin-bottom: 8px;
        }
        .step__desc {
            font-size: 14px; color: var(--muted); line-height: 1.7;
        }

        /* ── QR section ── */
        .qr-grid {
            max-width: 720px; margin: 0 auto;
            display: grid; grid-template-columns: 1fr 1fr; gap: 40px;
            align-items: center;
        }
        .qr-card {
            background: var(--ink);
            border-radius: 4px;
            padding: 24px;
            color: var(--surface);
            box-shadow: 0 12px 32px rgba(15, 23, 42, 0.1);
        }
        .qr-card__label {
            font-size: 10px; letter-spacing: 1px;
            opacity: 0.4; margin-bottom: 4px;
        }
        .qr-card__url {
            font-family: -apple-system, BlinkMacSystemFont, 'SF Pro Display', system-ui, sans-serif;
            font-size: 12px; opacity: 0.8;
            margin-bottom: 16px;
        }
        .qr-card__qr {
            background: #fff;
            border-radius: 4px;
            padding: 16px;
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 16px;
        }
        .qr-card__qr svg { width: 140px; height: 140px; }
        .qr-card__brand {
            font-family: -apple-system, BlinkMacSystemFont, 'SF Pro Display', system-ui, sans-serif;
            font-weight: 700; font-size: 13px; text-align: center;
            opacity: 0.5;
        }
        .qr-info__title {
            font-family: -apple-system, BlinkMacSystemFont, 'SF Pro Display', system-ui, sans-serif;
            font-weight: 500; font-size: 22px;
            line-height: 1.3; margin-bottom: 12px;
        }
        .qr-info__desc {
            font-size: 14px; color: var(--muted); line-height: 1.7;
            margin-bottom: 20px;
        }
        .qr-info__list {
            list-style: none; display: flex; flex-direction: column; gap: 10px;
        }
        .qr-info__item {
            display: flex; align-items: flex-start; gap: 10px;
            font-size: 14px; color: var(--muted); line-height: 1.5;
        }
        .qr-info__item-icon {
            flex-shrink: 0; width: 20px; height: 20px;
            color: var(--success); margin-top: 1px;
        }

        /* ── Features ── */
        .features {
            max-width: 960px; margin: 0 auto;
            display: grid; grid-template-columns: repeat(2, 1fr); gap: 24px;
        }
        .feature {
            display: flex; gap: 14px; padding: 20px;
            border-radius: 4px; transition: background 0.2s;
        }
        .feature:hover { background: rgba(241, 245, 249, 0.6); }
        .feature__icon {
            flex-shrink: 0;
            width: 36px; height: 36px;
            background: rgba(62, 122, 92, 0.1);
            border-radius: 4px;
            display: flex; align-items: center; justify-content: center;
            color: var(--success);
        }
        .feature__icon svg { width: 18px; height: 18px; }
        .feature__title {
            font-weight: 600; font-size: 15px; margin-bottom: 4px;
        }
        .feature__desc {
            font-size: 13px; color: var(--muted); line-height: 1.6;
        }

        /* ── CTA ── */
        .cta {
            text-align: center; padding: 100px 24px;
            background: var(--ink); color: var(--surface);
        }
        .cta__title {
            font-family: -apple-system, BlinkMacSystemFont, 'SF Pro Display', system-ui, sans-serif;
            font-weight: 500; font-size: clamp(24px, 3.5vw, 30px);
            line-height: 1.25; margin-bottom: 16px;
        }
        .cta__desc {
            font-size: 15px; opacity: 0.6; margin-bottom: 32px;
            max-width: 420px; margin-left: auto; margin-right: auto; line-height: 1.7;
        }
        .btn-cta {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 14px 28px; background: var(--stamp); color: #fff;
            border-radius: 6px; font-weight: 600; font-size: 15px;
            text-decoration: none; transition: background 0.2s;
        }
        .btn-cta:hover { background: var(--stamp-hover); }

        /* ── Demo / Try section ── */
        .demo {
            text-align: center; padding: 100px 24px;
            background: var(--ink); color: var(--surface);
        }
        .demo__title {
            font-family: -apple-system, BlinkMacSystemFont, 'SF Pro Display', system-ui, sans-serif;
            font-weight: 500; font-size: clamp(24px, 3.5vw, 30px);
            line-height: 1.25; margin-bottom: 12px;
        }
        .demo__desc {
            font-size: 15px; opacity: 0.6; margin-bottom: 36px;
            max-width: 420px; margin-left: auto; margin-right: auto; line-height: 1.7;
        }
        .demo__actions {
            display: flex; flex-direction: column; gap: 24px;
            max-width: 400px; margin: 0 auto;
        }
        .demo__form {
            display: flex; flex-direction: column; gap: 8px; align-items: center;
        }
        .demo__btn {
            display: inline-flex; align-items: center; justify-content: center; gap: 8px;
            width: 100%; padding: 14px 28px;
            background: var(--stamp); color: #fff;
            border: none; border-radius: 6px;
            font-family: 'Inter', system-ui, sans-serif;
            font-weight: 600; font-size: 15px;
            cursor: pointer; transition: background 0.2s;
        }
        .demo__btn:hover { background: var(--stamp-hover); }
        .demo__btn svg { width: 16px; height: 16px; }
        .demo__divider {
            display: flex; align-items: center; gap: 12px;
            font-size: 12px; opacity: 0.4;
        }
        .demo__divider::before,
        .demo__divider::after {
            content: ''; flex: 1; height: 1px;
            background: rgba(255, 255, 255, 0.15);
        }
        .demo__lookup {
            display: flex; gap: 8px; width: 100%;
        }
        .demo__input {
            flex: 1; padding: 12px 14px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 6px; color: var(--surface);
            font-family: 'Inter', system-ui, sans-serif;
            font-size: 14px;
        }
        .demo__input::placeholder { color: rgba(255, 255, 255, 0.3); }
        .demo__input:focus {
            outline: none;
            border-color: rgba(255, 255, 255, 0.4);
        }
        .demo__go {
            padding: 12px 18px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 6px; color: var(--surface);
            font-family: 'Inter', system-ui, sans-serif;
            font-weight: 600; font-size: 14px;
            cursor: pointer; transition: background 0.2s;
        }
        .demo__go:hover { background: rgba(255, 255, 255, 0.18); }
        .demo__hint {
            font-size: 12px; opacity: 0.4; margin-top: 4px;
        }
        .demo__error {
            font-size: 13px; color: #E8B74A; margin-top: 4px;
            display: none;
        }

        /* ── Footer ── */
        .footer {
            text-align: center; padding: 32px 24px;
            font-size: 12px; color: var(--muted);
            border-top: 1px solid var(--line);
        }

        /* ── Responsive ── */
        @media (max-width: 768px) {
            .hero__inner { grid-template-columns: 1fr; text-align: center; }
            .hero__desc { margin-left: auto; margin-right: auto; }
            .hero__actions { justify-content: center; }
            .hero__visual { margin-top: 24px; }
            .card-mock { width: 240px; }
            .steps { grid-template-columns: 1fr; max-width: 400px; }
            .qr-grid { grid-template-columns: 1fr; max-width: 340px; }
            .features { grid-template-columns: 1fr; }
            .nav__links { gap: 16px; }
            .nav__link { display: none; }
        }
    </style>
</head>
<body>

{{-- Navigation --}}
<nav class="nav">
    <div class="nav__inner">
        <a href="/" class="nav__brand">Kartu<span>Review</span></a>
        <div class="nav__links">
            <a href="#cara-kerja" class="nav__link">Cara kerja</a>
            <a href="#qr-code" class="nav__link">QR code</a>
            <a href="#fitur" class="nav__link">Keunggulan</a>
            <a href="#mulai" class="nav__cta">Mulai sekarang</a>
        </div>
    </div>
</nav>

{{-- Hero --}}
<section class="hero">
    <div class="hero__inner">
        <div>
            <div class="hero__badge">
                <span class="hero__badge-dot"></span>
                NFC + QR code
            </div>
            <h1 class="hero__title">
                Satu tap untuk<br><em>review bintang lima</em>
            </h1>
            <p class="hero__desc">
                Kartu pintar untuk bisnis kamu. Pelanggan cukup tap atau scan, langsung diarahkan ke halaman Google Review. Tanpa aplikasi, tanpa ribet.
            </p>
            <div class="hero__actions">
                <a href="#mulai" class="btn-primary">
                    Dapatkan kartu
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                </a>
                <a href="#cara-kerja" class="btn-secondary">Lihat cara kerja</a>
            </div>
        </div>
        <div class="hero__visual">
            <div class="card-mock">
                <div class="card-mock__inner">
                    <div class="card-mock__chip"></div>
                    <div class="card-mock__nfc">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round">
                            <path d="M5 12.55a11 11 0 0 1 14.08 0"></path>
                            <path d="M1.42 9a16 16 0 0 1 21.16 0"></path>
                            <path d="M8.53 16.11a6 6 0 0 1 6.95 0"></path>
                            <circle cx="12" cy="20" r="1"></circle>
                        </svg>
                    </div>
                    <div class="card-mock__label">Tap to review</div>
                    <div class="card-mock__url">kartu.id/r/ABC123</div>
                    <div class="card-mock__brand">Kartu Review</div>
                    <div class="card-mock__code">ABC123</div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Cara kerja --}}
<section class="section section--surface" id="cara-kerja">
    <div class="section__header">
        <div class="section__label">Cara kerja</div>
        <h2 class="section__title">Semudah tiga langkah</h2>
        <p class="section__desc">
            Dari kartu kosong sampai banjir review — tanpa perlu keahlian teknis.
        </p>
    </div>
    <div class="steps">
        <div class="step">
            <div class="step__number">01</div>
            <div class="step__icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                    <path d="M16 3h-4l-2 4h8l-2-4z"></path>
                </svg>
            </div>
            <h3 class="step__title">Dapatkan kartu</h3>
            <p class="step__desc">
                Terima kartu fisik NFC + QR yang sudah diprogram dengan kode unik. Taruh di meja kasir atau tempat strategis.
            </p>
        </div>
        <div class="step">
            <div class="step__number">02</div>
            <div class="step__icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                </svg>
            </div>
            <h3 class="step__title">Aktivasi sekali</h3>
            <p class="step__desc">
                Tap kartu pertama kali, isi nama usaha dan link Google Review. Cukup satu kali — kartu aktif selamanya.
            </p>
        </div>
        <div class="step">
            <div class="step__number">03</div>
            <div class="step__icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                </svg>
            </div>
            <h3 class="step__title">Panen review</h3>
            <p class="step__desc">
                Setiap pelanggan yang tap langsung diarahkan ke Google Review kamu. Makin banyak tap, makin banyak review.
            </p>
        </div>
    </div>
</section>

{{-- QR code --}}
<section class="section" id="qr-code">
    <div class="section__header">
        <div class="section__label">QR code</div>
        <h2 class="section__title">Tap atau scan, sama hasilnya</h2>
        <p class="section__desc">
            Setiap kartu punya QR code unik yang mengarah ke link review kamu. HP tanpa NFC? Scan QR tetap jalan.
        </p>
    </div>
    <div class="qr-grid">
        <div class="qr-card">
            <div class="qr-card__label">Tap to review</div>
            <div class="qr-card__url">kartu.id/r/ABC123</div>
            <div class="qr-card__qr">
                {{-- Simplified QR pattern (visual representation) --}}
                <svg viewBox="0 0 29 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="29" height="29" fill="white"/>
                    {{-- Position patterns (3 corners) --}}
                    <rect x="0" y="0" width="7" height="7" fill="#1C2B3A"/>
                    <rect x="1" y="1" width="5" height="5" fill="white"/>
                    <rect x="2" y="2" width="3" height="3" fill="#1C2B3A"/>
                    <rect x="22" y="0" width="7" height="7" fill="#1C2B3A"/>
                    <rect x="23" y="1" width="5" height="5" fill="white"/>
                    <rect x="24" y="2" width="3" height="3" fill="#1C2B3A"/>
                    <rect x="0" y="22" width="7" height="7" fill="#1C2B3A"/>
                    <rect x="1" y="23" width="5" height="5" fill="white"/>
                    <rect x="2" y="24" width="3" height="3" fill="#1C2B3A"/>
                    {{-- Timing patterns --}}
                    <rect x="8" y="6" width="1" height="1" fill="#1C2B3A"/>
                    <rect x="10" y="6" width="1" height="1" fill="#1C2B3A"/>
                    <rect x="12" y="6" width="1" height="1" fill="#1C2B3A"/>
                    <rect x="14" y="6" width="1" height="1" fill="#1C2B3A"/>
                    <rect x="6" y="8" width="1" height="1" fill="#1C2B3A"/>
                    <rect x="6" y="10" width="1" height="1" fill="#1C2B3A"/>
                    <rect x="6" y="12" width="1" height="1" fill="#1C2B3A"/>
                    <rect x="6" y="14" width="1" height="1" fill="#1C2B3A"/>
                    {{-- Data modules (decorative pattern) --}}
                    <rect x="9" y="9" width="1" height="1" fill="#1C2B3A"/>
                    <rect x="11" y="9" width="2" height="1" fill="#1C2B3A"/>
                    <rect x="14" y="9" width="1" height="1" fill="#1C2B3A"/>
                    <rect x="16" y="9" width="1" height="1" fill="#1C2B3A"/>
                    <rect x="19" y="9" width="2" height="1" fill="#1C2B3A"/>
                    <rect x="9" y="11" width="2" height="1" fill="#1C2B3A"/>
                    <rect x="13" y="11" width="1" height="1" fill="#1C2B3A"/>
                    <rect x="15" y="11" width="2" height="1" fill="#1C2B3A"/>
                    <rect x="19" y="11" width="1" height="1" fill="#1C2B3A"/>
                    <rect x="10" y="13" width="1" height="1" fill="#1C2B3A"/>
                    <rect x="12" y="13" width="2" height="1" fill="#1C2B3A"/>
                    <rect x="16" y="13" width="1" height="1" fill="#1C2B3A"/>
                    <rect x="18" y="13" width="2" height="1" fill="#1C2B3A"/>
                    <rect x="9" y="15" width="1" height="1" fill="#1C2B3A"/>
                    <rect x="11" y="15" width="1" height="1" fill="#1C2B3A"/>
                    <rect x="14" y="15" width="2" height="1" fill="#1C2B3A"/>
                    <rect x="17" y="15" width="1" height="1" fill="#1C2B3A"/>
                    <rect x="20" y="15" width="1" height="1" fill="#1C2B3A"/>
                    <rect x="9" y="17" width="2" height="1" fill="#1C2B3A"/>
                    <rect x="13" y="17" width="1" height="1" fill="#1C2B3A"/>
                    <rect x="16" y="17" width="2" height="1" fill="#1C2B3A"/>
                    <rect x="19" y="17" width="1" height="1" fill="#1C2B3A"/>
                    <rect x="10" y="19" width="1" height="1" fill="#1C2B3A"/>
                    <rect x="12" y="19" width="1" height="1" fill="#1C2B3A"/>
                    <rect x="15" y="19" width="2" height="1" fill="#1C2B3A"/>
                    <rect x="18" y="19" width="1" height="1" fill="#1C2B3A"/>
                    <rect x="20" y="19" width="1" height="1" fill="#1C2B3A"/>
                    {{-- Bottom-right data --}}
                    <rect x="9" y="22" width="1" height="1" fill="#1C2B3A"/>
                    <rect x="11" y="22" width="2" height="1" fill="#1C2B3A"/>
                    <rect x="15" y="22" width="1" height="1" fill="#1C2B3A"/>
                    <rect x="18" y="22" width="1" height="1" fill="#1C2B3A"/>
                    <rect x="22" y="22" width="2" height="1" fill="#1C2B3A"/>
                    <rect x="26" y="22" width="1" height="1" fill="#1C2B3A"/>
                    <rect x="9" y="24" width="2" height="1" fill="#1C2B3A"/>
                    <rect x="14" y="24" width="1" height="1" fill="#1C2B3A"/>
                    <rect x="17" y="24" width="2" height="1" fill="#1C2B3A"/>
                    <rect x="22" y="24" width="1" height="1" fill="#1C2B3A"/>
                    <rect x="25" y="24" width="2" height="1" fill="#1C2B3A"/>
                    <rect x="9" y="26" width="1" height="1" fill="#1C2B3A"/>
                    <rect x="12" y="26" width="2" height="1" fill="#1C2B3A"/>
                    <rect x="16" y="26" width="1" height="1" fill="#1C2B3A"/>
                    <rect x="19" y="26" width="1" height="1" fill="#1C2B3A"/>
                    <rect x="23" y="26" width="1" height="1" fill="#1C2B3A"/>
                    <rect x="26" y="26" width="2" height="1" fill="#1C2B3A"/>
                    {{-- Right-side data --}}
                    <rect x="22" y="9" width="1" height="1" fill="#1C2B3A"/>
                    <rect x="25" y="9" width="2" height="1" fill="#1C2B3A"/>
                    <rect x="23" y="11" width="2" height="1" fill="#1C2B3A"/>
                    <rect x="26" y="11" width="1" height="1" fill="#1C2B3A"/>
                    <rect x="22" y="13" width="1" height="1" fill="#1C2B3A"/>
                    <rect x="25" y="13" width="1" height="1" fill="#1C2B3A"/>
                    <rect x="27" y="13" width="1" height="1" fill="#1C2B3A"/>
                    <rect x="23" y="15" width="1" height="1" fill="#1C2B3A"/>
                    <rect x="26" y="15" width="2" height="1" fill="#1C2B3A"/>
                    <rect x="22" y="17" width="2" height="1" fill="#1C2B3A"/>
                    <rect x="25" y="17" width="1" height="1" fill="#1C2B3A"/>
                    <rect x="27" y="17" width="1" height="1" fill="#1C2B3A"/>
                    <rect x="22" y="19" width="1" height="1" fill="#1C2B3A"/>
                    <rect x="25" y="19" width="2" height="1" fill="#1C2B3A"/>
                </svg>
            </div>
            <div class="qr-card__brand">Kartu Review</div>
        </div>
        <div class="qr-info">
            <h3 class="qr-info__title">Satu kartu, dua cara akses</h3>
            <p class="qr-info__desc">
                Setiap kartu dicetak dengan QR code unik yang berisi URL redirect ke halaman review kamu. Cocok untuk semua jenis HP.
            </p>
            <ul class="qr-info__list">
                <li class="qr-info__item">
                    <svg class="qr-info__item-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    <span>NFC untuk tap instan — tanpa buka aplikasi apapun</span>
                </li>
                <li class="qr-info__item">
                    <svg class="qr-info__item-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    <span>QR code untuk HP tanpa NFC — scan langsung buka</span>
                </li>
                <li class="qr-info__item">
                    <svg class="qr-info__item-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    <span>Kode unik per kartu, tidak ada dua kartu yang sama</span>
                </li>
                <li class="qr-info__item">
                    <svg class="qr-info__item-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    <span>URL di QR permanen, target review bisa diubah di server</span>
                </li>
            </ul>
        </div>
    </div>
</section>

{{-- Keunggulan --}}
<section class="section section--surface" id="fitur">
    <div class="section__header">
        <div class="section__label">Keunggulan</div>
        <h2 class="section__title">Kenapa pakai Kartu Review?</h2>
        <p class="section__desc">
            Solusi paling simpel untuk mengumpulkan review Google dari pelanggan.
        </p>
    </div>
    <div class="features">
        <div class="feature">
            <div class="feature__icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"></path></svg>
            </div>
            <div>
                <div class="feature__title">Tap instan</div>
                <div class="feature__desc">NFC langsung buka halaman review tanpa install aplikasi. Cukup sentuh.</div>
            </div>
        </div>
        <div class="feature">
            <div class="feature__icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
            </div>
            <div>
                <div class="feature__title">Aktivasi sekali, selamanya</div>
                <div class="feature__desc">Tidak perlu program ulang chip. Link review tersimpan di server.</div>
            </div>
        </div>
        <div class="feature">
            <div class="feature__icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
            </div>
            <div>
                <div class="feature__title">Aman dan terkontrol</div>
                <div class="feature__desc">Hanya pemilik kartu yang bisa aktivasi. Link tidak bisa diubah orang lain.</div>
            </div>
        </div>
        <div class="feature">
            <div class="feature__icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
            </div>
            <div>
                <div class="feature__title">Setup hitungan detik</div>
                <div class="feature__desc">Isi nama usaha, paste link review, selesai. Tidak perlu keahlian teknis.</div>
            </div>
        </div>
    </div>
</section>

{{-- Demo: coba alur aktivasi tanpa kartu fisik --}}
<section class="demo" id="mulai">
    <h2 class="demo__title">Coba alur aktivasinya</h2>
    <p class="demo__desc">
        Tidak perlu kartu fisik. Buat kartu demo untuk mencoba seluruh alur dari aktivasi sampai redirect ke review.
    </p>
    <div class="demo__actions">
        {{-- Tombol buat kartu demo baru --}}
        <form class="demo__form" method="POST" action="{{ route('cards.demo.create') }}">
            @csrf
            <button type="submit" class="demo__btn">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                Buat kartu demo
            </button>
        </form>

        <div class="demo__divider">atau</div>

        {{-- Input kode kartu yang sudah ada --}}
        <div style="width: 100%">
            <div class="demo__lookup">
                <input
                    type="text"
                    id="demo-code"
                    class="demo__input"
                    placeholder="Masukkan kode kartu (mis. ABC123)"
                    maxlength="12"
                    autocomplete="off"
                    spellcheck="false"
                >
                <button type="button" class="demo__go" onclick="lookupCard()">Buka</button>
            </div>
            <div class="demo__hint">Ketik kode kartu yang sudah pernah dibuat untuk membuka halamannya.</div>
            <div class="demo__error" id="demo-error">Kode kartu tidak boleh kosong.</div>
        </div>
    </div>
</section>

{{-- Footer --}}
<footer class="footer">
    &copy; {{ date('Y') }} Kartu Review. Semua hak dilindungi.
</footer>

<script>
function lookupCard() {
    var input = document.getElementById('demo-code');
    var error = document.getElementById('demo-error');
    var code = input.value.trim().toUpperCase();

    if (!code) {
        error.textContent = 'Kode kartu tidak boleh kosong.';
        error.style.display = 'block';
        return;
    }

    error.style.display = 'none';
    window.location.href = '/r/' + encodeURIComponent(code);
}

document.getElementById('demo-code').addEventListener('keydown', function(e) {
    if (e.key === 'Enter') {
        e.preventDefault();
        lookupCard();
    }
});
</script>

</body>
</html>
