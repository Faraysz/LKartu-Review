<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tapin — Kartu Google Review Pintar NFC & QR Code</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter+Tight:wght@600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --brand-blue: #0066FF;
            --brand-dark: #0A0F1D;
            --brand-slate: #1E293B;
            --brand-muted: #64748B;
            --brand-border: #E2E8F0;
            --brand-bg: #F8FAFC;
            --brand-surface: #FFFFFF;
            --brand-green: #10B981;
            --brand-amber: #F59E0B;
            --radius-full: 9999px;
            --radius-xl: 20px;
            --radius-lg: 16px;
            --radius-md: 12px;
            --shadow-subtle: 0 1px 3px 0 rgba(0, 0, 0, 0.05), 0 1px 2px -1px rgba(0, 0, 0, 0.05);
            --shadow-float: 0 20px 35px -10px rgba(10, 15, 29, 0.08), 0 1px 3px 0 rgba(0, 0, 0, 0.04);
            --shadow-blue-glow: 0 12px 28px -6px rgba(0, 102, 255, 0.32);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: var(--brand-bg);
            color: var(--brand-dark);
            line-height: 1.6;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        /* ── INTER TIGHT FONT KHUSUS UNTUK SEMUA HURUF TEBAL / HEADING ── */
        h1, h2, h3, h4, h5, h6, strong, b,
        .header__brand,
        .hero__title,
        .section-heading,
        .step-box__title,
        .step-box__num,
        .calc-panel__title,
        .calc-display__num,
        .calc-detail-val,
        .bento-card__title,
        .pricing-card__name,
        .pricing-card__price,
        .faq-question,
        .cta-banner__title,
        .stat-item-num,
        .btn-header-cta,
        .btn-primary-popl,
        .btn-secondary-popl,
        .btn-pricing,
        .btn-wa-hero {
            font-family: 'Inter Tight', sans-serif !important;
            letter-spacing: -0.03em;
        }

        /* ── SUBTLE BACKGROUND ACCENTS ── */
        .ambient-glow {
            position: absolute;
            width: 720px; height: 420px;
            top: -80px; left: 50%; transform: translateX(-50%);
            background: radial-gradient(circle, rgba(0, 102, 255, 0.09) 0%, rgba(99, 102, 241, 0.04) 50%, transparent 70%);
            pointer-events: none; z-index: 0;
        }

        /* ── LIGHTWEIGHT SCROLL ANIMATIONS (HEADLINES EXCLUDED) ── */
        .reveal {
            opacity: 0;
            transform: translateY(18px);
            transition: opacity 0.45s cubic-bezier(0.16, 1, 0.3, 1), transform 0.45s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: opacity, transform;
        }
        .reveal.is-revealed {
            opacity: 1;
            transform: translateY(0);
        }

        /* ── NAVBAR ── */
        .header {
            position: fixed; top: 0; left: 0; right: 0; z-index: 1000;
            background: rgba(255, 255, 255, 0.88);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
            transition: all 0.25s ease;
        }
        .header__inner {
            max-width: 1180px; margin: 0 auto;
            padding: 14px 24px;
            display: flex; align-items: center; justify-content: space-between;
        }
        .header__brand {
            display: flex; align-items: center; gap: 10px;
            text-decoration: none; font-weight: 800; font-size: 20px;
            color: var(--brand-dark);
        }
        .header__logo {
            height: 32px; width: auto; object-fit: contain; border-radius: 6px;
        }
        .header__brand span { color: var(--brand-blue); }
        .header__nav {
            display: flex; align-items: center; gap: 26px;
        }
        .header__link {
            text-decoration: none; font-size: 14px; font-weight: 600;
            color: var(--brand-muted); transition: color 0.15s ease;
        }
        .header__link:hover { color: var(--brand-blue); }
        .btn-header-cta {
            background: var(--brand-blue);
            color: #fff; text-decoration: none;
            padding: 9px 20px; border-radius: var(--radius-full);
            font-size: 13px; font-weight: 700;
            display: inline-flex; align-items: center; gap: 7px;
            box-shadow: 0 4px 12px rgba(0, 102, 255, 0.28);
            transition: all 0.2s ease;
        }
        .btn-header-cta:hover {
            background: #0052cc;
            transform: translateY(-1px);
            box-shadow: var(--shadow-blue-glow);
        }

        /* ── HERO SECTION ── */
        .hero {
            position: relative;
            padding: 130px 24px 70px;
            max-width: 1180px; margin: 0 auto;
        }
        .hero__grid {
            display: grid; grid-template-columns: 1.1fr 0.9fr; gap: 48px;
            align-items: center;
        }
        .hero__rating-pill {
            display: inline-flex; align-items: center; gap: 10px;
            background: var(--brand-surface);
            border: 1px solid var(--brand-border);
            padding: 5px 14px 5px 6px; border-radius: var(--radius-full);
            box-shadow: var(--shadow-subtle);
            margin-bottom: 24px;
        }
        .rating-avatars {
            display: flex; margin-right: -4px;
        }
        .rating-avatar {
            width: 24px; height: 24px; border-radius: 50%;
            background: #E2E8F0; border: 2px solid #FFFFFF;
            display: flex; align-items: center; justify-content: center;
            font-size: 10px; font-weight: 800; color: #475569;
            margin-left: -6px;
        }
        .rating-avatar:first-child { margin-left: 0; background: #DBEAFE; color: var(--brand-blue); }
        .rating-avatar:nth-child(2) { background: #DCFCE7; color: var(--brand-green); }
        .rating-avatar:nth-child(3) { background: #FEF3C7; color: var(--brand-amber); }
        .stars-group {
            display: flex; gap: 2px; color: var(--brand-amber);
        }
        .stars-group svg { width: 14px; height: 14px; fill: currentColor; }
        .rating-label {
            font-size: 12px; font-weight: 700; color: var(--brand-slate);
        }

        .hero__title {
            font-size: clamp(36px, 4.4vw, 54px);
            font-weight: 800; line-height: 1.15;
            color: var(--brand-dark);
            margin-bottom: 20px;
        }
        .hero__title .blue-text {
            color: var(--brand-blue);
        }
        .hero__desc {
            font-size: 17px; color: var(--brand-muted);
            line-height: 1.65; margin-bottom: 34px;
            max-width: 500px;
        }
        .hero__cta-group {
            display: flex; flex-wrap: wrap; gap: 14px;
            align-items: center; margin-bottom: 38px;
        }
        .btn-primary-popl {
            background: var(--brand-blue);
            color: #fff; text-decoration: none;
            padding: 14px 28px; border-radius: var(--radius-full);
            font-size: 14px; font-weight: 700;
            display: inline-flex; align-items: center; gap: 8px;
            box-shadow: 0 6px 20px rgba(0, 102, 255, 0.3);
            transition: all 0.2s ease;
        }
        .btn-primary-popl:hover {
            background: #0052cc;
            transform: translateY(-2px);
            box-shadow: var(--shadow-blue-glow);
        }
        .btn-primary-popl svg {
            transition: transform 0.2s ease;
        }
        .btn-primary-popl:hover svg {
            transform: translateX(3px);
        }
        .btn-secondary-popl {
            background: var(--brand-surface);
            color: var(--brand-dark); text-decoration: none;
            padding: 14px 26px; border-radius: var(--radius-full);
            font-size: 14px; font-weight: 700;
            border: 1px solid var(--brand-border);
            display: inline-flex; align-items: center; gap: 8px;
            box-shadow: var(--shadow-subtle);
            transition: all 0.2s ease;
        }
        .btn-secondary-popl:hover {
            background: #F1F5F9; border-color: #CBD5E1;
            transform: translateY(-2px);
        }

        .hero__stats-row {
            display: flex; gap: 32px; align-items: center;
            border-top: 1px solid var(--brand-border);
            padding-top: 22px;
        }
        .stat-item-num {
            font-size: 20px; font-weight: 800; color: var(--brand-dark);
        }
        .stat-item-label {
            font-size: 12px; font-weight: 600; color: var(--brand-muted);
        }

        /* ── HERO INTERACTIVE CARD & PHONE STAGE ── */
        .stage {
            position: relative;
            display: flex; justify-content: center; align-items: center;
            min-height: 440px;
            perspective: 1000px;
        }

        @keyframes float-subtle {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-8px); }
        }
        @keyframes radar-ripple {
            0% { transform: scale(0.6); opacity: 0.8; }
            100% { transform: scale(2.4); opacity: 0; }
        }

        .radar-ring {
            position: absolute;
            width: 140px; height: 140px;
            border-radius: 50%;
            border: 2px solid rgba(0, 102, 255, 0.35);
            top: 28%; left: 28%;
            animation: radar-ripple 2.8s cubic-bezier(0, 0.2, 0.8, 1) infinite;
            pointer-events: none;
        }
        .radar-ring:nth-child(2) {
            animation-delay: 1.4s;
        }

        /* Smart Card Physical Mockup */
        .smart-card {
            position: relative;
            width: 320px; height: 196px;
            background: linear-gradient(135deg, #0B1120 0%, #172554 100%);
            border-radius: 16px;
            padding: 22px;
            color: #FFFFFF;
            box-shadow: 0 24px 48px -12px rgba(11, 17, 32, 0.35), 0 0 0 1px rgba(255, 255, 255, 0.12);
            transform: rotateX(6deg) rotateY(-12deg) rotateZ(2deg);
            transform-style: preserve-3d;
            transition: transform 0.2s cubic-bezier(0.2, 0, 0, 1), box-shadow 0.2s ease;
            cursor: pointer;
            z-index: 2;
            overflow: hidden;
        }
        .smart-card:hover {
            box-shadow: 0 32px 56px -12px rgba(0, 102, 255, 0.3), 0 0 0 1px rgba(255, 255, 255, 0.25);
        }
        .smart-card-sheen {
            position: absolute; top: -50%; left: -50%; width: 200%; height: 200%;
            background: linear-gradient(115deg, transparent 40%, rgba(255, 255, 255, 0.08) 46%, rgba(255, 255, 255, 0.18) 50%, transparent 54%);
            pointer-events: none;
            transition: transform 0.15s ease-out;
        }
        .smart-card__top {
            display: flex; justify-content: space-between; align-items: flex-start;
            margin-bottom: 24px;
        }
        .emv-chip {
            width: 38px; height: 28px;
            background: linear-gradient(135deg, #D4AF37 0%, #E5C158 50%, #AA820A 100%);
            border-radius: 5px;
            border: 1px solid rgba(0,0,0,0.25);
            display: flex; align-items: center; justify-content: center;
        }
        .emv-chip svg { width: 34px; height: 24px; opacity: 0.7; }
        .nfc-wave-icon svg { width: 24px; height: 24px; color: rgba(255, 255, 255, 0.8); }
        .smart-card__brand {
            font-size: 16px; font-weight: 800;
            display: flex; align-items: center; gap: 7px;
        }
        .smart-card__brand span { color: #60A5FA; }
        .smart-card__sub {
            font-size: 11px; font-weight: 700; text-transform: uppercase;
            letter-spacing: 0.08em; color: #94A3B8; margin-top: 3px;
        }
        .smart-card__pill {
            position: absolute; bottom: 18px; right: 20px;
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 3px 9px; border-radius: var(--radius-full);
            font-size: 10px; font-family: monospace; font-weight: 700;
            color: #E2E8F0;
        }

        /* ── ULTRA-REALISTIC SMARTPHONE MOCKUP (IPHONE PRO) ── */
        .phone-frame {
            position: absolute;
            right: 0px; top: 10px;
            width: 228px; height: 396px;
            background: #0B0F19;
            border-radius: 44px;
            padding: 8px;
            box-shadow: 0 30px 60px -15px rgba(10, 15, 29, 0.35),
                        0 0 0 2px #334155,
                        inset 0 0 0 1.5px rgba(255, 255, 255, 0.15);
            z-index: 3;
            animation: float-subtle 5s ease-in-out infinite;
        }
        /* Physical Side Buttons */
        .phone-btn {
            position: absolute;
            background: #1E293B;
            border-radius: 2px;
        }
        .phone-btn--vol-up { left: -4px; top: 80px; width: 3px; height: 26px; }
        .phone-btn--vol-down { left: -4px; top: 114px; width: 3px; height: 26px; }
        .phone-btn--power { right: -4px; top: 96px; width: 3px; height: 38px; }

        .phone-inner-bezel {
            width: 100%; height: 100%;
            background: #FFFFFF;
            border-radius: 36px;
            overflow: hidden;
            display: flex; flex-direction: column;
            position: relative;
            box-shadow: inset 0 0 0 1px rgba(0, 0, 0, 0.08);
        }
        .phone-screen-sheen {
            position: absolute; top: 0; left: 0; right: 0; height: 50%;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.45) 0%, rgba(255, 255, 255, 0) 65%);
            pointer-events: none; z-index: 10;
        }

        /* iOS Status Bar */
        .phone-status-bar {
            padding: 8px 16px 4px;
            display: flex; align-items: center; justify-content: space-between;
            font-size: 11px; font-weight: 700; color: #0A0F1D;
            position: relative; z-index: 5;
            background: transparent;
        }
        .phone-time { font-size: 11px; font-weight: 800; letter-spacing: -0.02em; }
        .phone-island {
            width: 62px; height: 16px; background: #000000;
            border-radius: var(--radius-full);
            display: flex; align-items: center; justify-content: flex-end;
            padding-right: 6px;
        }
        .island-camera {
            width: 6px; height: 6px; border-radius: 50%;
            background: #111827; border: 1px solid #1F2937;
        }
        .phone-status-icons {
            display: flex; align-items: center; gap: 5px; color: #0A0F1D;
        }

        /* Phone Screen & Google Maps Review UI */
        .phone-screen-content {
            flex: 1;
            background: linear-gradient(180deg, #F1F5F9 0%, #E2E8F0 100%);
            display: flex; flex-direction: column; justify-content: flex-end;
            padding: 10px;
            position: relative;
        }
        .maps-header-bar {
            position: absolute; top: 8px; left: 10px; right: 10px;
        }
        .maps-search-pill {
            background: rgba(255, 255, 255, 0.95);
            border-radius: var(--radius-full);
            padding: 5px 10px;
            display: flex; align-items: center; gap: 6px;
            font-size: 10px; font-weight: 600; color: #64748B;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.06);
        }

        /* Google Review Modal Sheet */
        .google-review-modal {
            background: #FFFFFF;
            border-radius: 20px;
            padding: 14px 12px;
            box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.08);
            text-align: center;
            position: relative; z-index: 4;
        }
        .modal-drag-handle {
            width: 32px; height: 3px; background: #E2E8F0;
            border-radius: var(--radius-full); margin: 0 auto 10px;
        }
        .g-header {
            display: flex; align-items: center; gap: 8px;
            text-align: left; margin-bottom: 10px;
        }
        .g-avatar {
            width: 30px; height: 30px; border-radius: 50%;
            background: #F8FAFC; border: 1px solid #E2E8F0;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .g-store-name {
            font-size: 12px; font-weight: 800; color: var(--brand-dark); line-height: 1.2;
        }
        .g-store-badge {
            display: flex; align-items: center; gap: 3px;
            font-size: 9px; font-weight: 700; color: var(--brand-blue);
        }
        .g-prompt {
            font-size: 10.5px; font-weight: 600; color: #475569;
            margin-bottom: 8px;
        }
        .g-stars-row {
            display: flex; justify-content: center; gap: 4px;
            margin-bottom: 10px;
        }
        .g-star {
            width: 20px; height: 20px;
            fill: #F59E0B;
            filter: drop-shadow(0 2px 4px rgba(245, 158, 11, 0.35));
        }
        .g-tags-wrap {
            display: flex; justify-content: center; gap: 4px;
            margin-bottom: 10px;
        }
        .g-tag {
            background: #EFF6FF; color: var(--brand-blue);
            font-size: 9px; font-weight: 700; padding: 2px 8px;
            border-radius: var(--radius-full);
        }
        .g-submit-btn {
            background: #1A73E8; color: #FFFFFF;
            font-size: 11px; font-weight: 700; padding: 7px 14px;
            border-radius: var(--radius-full);
            display: flex; align-items: center; justify-content: center; gap: 5px;
            box-shadow: 0 4px 10px rgba(26, 115, 232, 0.35);
        }
        .home-indicator {
            width: 80px; height: 3.5px; background: #0A0F1D;
            border-radius: var(--radius-full); margin: 6px auto 0;
        }

        /* ── TRUSTED LOGO MARQUEE ── */
        .marquee-section {
            border-top: 1px solid var(--brand-border);
            border-bottom: 1px solid var(--brand-border);
            background: #FFFFFF;
            padding: 24px 0; overflow: hidden;
        }
        .marquee-title {
            text-align: center; font-size: 12px; font-weight: 700;
            text-transform: uppercase; letter-spacing: 0.08em;
            color: var(--brand-muted); margin-bottom: 16px;
        }
        .marquee-track {
            display: flex; gap: 48px; width: max-content;
            animation: scroll-left 25s linear infinite;
        }
        @keyframes scroll-left {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        .marquee-item {
            display: flex; align-items: center; gap: 8px;
            font-size: 14px; font-weight: 700; color: #475569;
        }
        .marquee-item svg { width: 18px; height: 18px; color: var(--brand-blue); }

        /* ── SECTION COMMON (HEADINGS SOLID, NO SLOW ANIMATION) ── */
        .section {
            padding: 84px 24px;
            max-width: 1180px; margin: 0 auto;
        }
        .section__header {
            text-align: center; max-width: 620px; margin: 0 auto 52px;
        }
        .section-tag {
            display: inline-flex; align-items: center; gap: 6px;
            background: #EFF6FF; color: var(--brand-blue);
            font-size: 12px; font-weight: 800; text-transform: uppercase;
            letter-spacing: 0.08em; padding: 5px 14px; border-radius: var(--radius-full);
            margin-bottom: 14px;
        }
        .section-tag svg { width: 14px; height: 14px; }
        .section-heading {
            font-size: clamp(28px, 3.2vw, 38px);
            font-weight: 800; color: var(--brand-dark); line-height: 1.25; margin-bottom: 14px;
        }
        .section-subheading {
            font-size: 16px; color: var(--brand-muted); line-height: 1.6;
        }

        /* ── 3-STEP PROCESS ── */
        .steps-grid {
            display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px;
        }
        .step-box {
            background: var(--brand-surface);
            border: 1px solid var(--brand-border);
            border-radius: var(--radius-xl);
            padding: 32px 26px;
            box-shadow: var(--shadow-subtle);
            transition: all 0.25s ease;
            position: relative;
        }
        .step-box:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-float);
            border-color: #BFDBFE;
        }
        .step-icon-wrap {
            width: 46px; height: 46px; border-radius: var(--radius-md);
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 22px;
            transition: transform 0.2s ease;
        }
        .step-box:hover .step-icon-wrap { transform: scale(1.06); }
        .step-icon-wrap--blue { background: #EFF6FF; color: var(--brand-blue); }
        .step-icon-wrap--purple { background: #F5F3FF; color: #7C3AED; }
        .step-icon-wrap--green { background: #ECFDF5; color: var(--brand-green); }
        .step-icon-wrap svg { width: 22px; height: 22px; }
        .step-box__num {
            position: absolute; top: 28px; right: 26px;
            font-size: 13px; font-weight: 800; color: #94A3B8;
        }
        .step-box__title {
            font-size: 19px; font-weight: 800; color: var(--brand-dark);
            margin-bottom: 10px;
        }
        .step-box__desc {
            font-size: 14px; color: var(--brand-muted); line-height: 1.6;
        }

        /* ── ROI CALCULATOR ── */
        .calc-panel {
            background: linear-gradient(135deg, #0A0F1D 0%, #172554 100%);
            border-radius: var(--radius-xl);
            padding: 52px 48px;
            color: #FFFFFF;
            box-shadow: 0 25px 50px -12px rgba(10, 15, 29, 0.4);
            display: grid; grid-template-columns: 1.1fr 0.9fr; gap: 48px;
            align-items: center;
        }
        .calc-panel__title {
            font-size: 30px; font-weight: 800; line-height: 1.25; margin-bottom: 14px;
        }
        .calc-panel__desc {
            font-size: 15px; color: #94A3B8; line-height: 1.6; margin-bottom: 28px;
        }
        .slider-box { margin-bottom: 24px; }
        .slider-meta {
            display: flex; justify-content: space-between; align-items: center;
            margin-bottom: 12px; font-size: 14px; font-weight: 700; color: #E2E8F0;
        }
        .slider-badge {
            background: var(--brand-blue); color: #fff;
            padding: 4px 12px; border-radius: var(--radius-full);
            font-size: 13px; font-weight: 700;
        }
        .slider-input {
            -webkit-appearance: none; width: 100%; height: 8px;
            border-radius: var(--radius-full); background: #334155;
            outline: none; cursor: pointer;
        }
        .slider-input::-webkit-slider-thumb {
            -webkit-appearance: none; width: 22px; height: 22px;
            border-radius: 50%; background: #60A5FA;
            border: 3px solid #FFFFFF; box-shadow: 0 0 10px rgba(96, 165, 250, 0.6);
            cursor: pointer; transition: transform 0.1s ease;
        }
        .slider-input::-webkit-slider-thumb:hover { transform: scale(1.15); }
        .calc-display {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: var(--radius-lg);
            padding: 32px; text-align: center;
        }
        .calc-display__num {
            font-size: clamp(40px, 4.5vw, 60px);
            font-weight: 800;
            background: linear-gradient(135deg, #60A5FA 0%, #34D399 100%);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            line-height: 1; margin-bottom: 6px;
        }
        .calc-display__label {
            font-size: 13px; font-weight: 700; color: #CBD5E1;
            text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 20px;
        }
        .calc-grid-details {
            display: grid; grid-template-columns: 1fr 1fr; gap: 14px;
            border-top: 1px solid rgba(255, 255, 255, 0.1); padding-top: 18px;
        }
        .calc-detail-name { font-size: 12px; color: #94A3B8; margin-bottom: 4px; }
        .calc-detail-val { font-size: 15px; font-weight: 800; color: #FFFFFF; }

        /* ── FEATURE CARDS 2x2 GRID ── */
        .bento-wrap {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 24px;
            align-items: stretch;
        }
        .bento-card {
            background: var(--brand-surface);
            border: 1px solid var(--brand-border);
            border-radius: var(--radius-xl);
            padding: 32px 28px;
            box-shadow: var(--shadow-subtle);
            transition: all 0.25s ease;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            height: 100%;
        }
        .bento-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-float);
            border-color: #BFDBFE;
        }
        .bento-icon-btn {
            width: 44px; height: 44px; border-radius: var(--radius-md);
            display: inline-flex; align-items: center; justify-content: center;
            margin-bottom: 20px;
            flex-shrink: 0;
        }
        .bento-icon-btn--blue { background: #EFF6FF; color: var(--brand-blue); }
        .bento-icon-btn--amber { background: #FEF3C7; color: var(--brand-amber); }
        .bento-icon-btn--purple { background: #F5F3FF; color: #7C3AED; }
        .bento-icon-btn--green { background: #ECFDF5; color: var(--brand-green); }
        .bento-icon-btn svg { width: 22px; height: 22px; }
        .bento-card__title {
            font-size: 19px; font-weight: 800; color: var(--brand-dark);
            margin-bottom: 10px;
            line-height: 1.35;
            min-height: 52px;
            display: flex;
            align-items: center;
        }
        .bento-card__desc, .bento-desc {
            font-size: 14.5px; color: var(--brand-muted); line-height: 1.6;
            margin: 0;
            flex: 1;
        }

        /* ── PRICING SECTION ── */
        .pricing-section {
            background: #FFFFFF;
            border-top: 1px solid var(--brand-border);
            border-bottom: 1px solid var(--brand-border);
            padding: 88px 24px;
        }
        .pricing-grid {
            display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px;
            max-width: 1140px; margin: 0 auto;
        }
        .pricing-card {
            background: var(--brand-bg);
            border: 1px solid var(--brand-border);
            border-radius: var(--radius-xl);
            padding: 36px 28px;
            display: flex; flex-direction: column; justify-content: space-between;
            position: relative;
            transition: all 0.25s ease;
        }
        .pricing-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-float);
            border-color: #CBD5E1;
        }
        .pricing-card--popular {
            background: #FFFFFF;
            border: 2px solid var(--brand-blue);
            box-shadow: var(--shadow-float);
            transform: scale(1.03);
            z-index: 2;
        }
        .pricing-card--popular:hover {
            transform: scale(1.03) translateY(-4px);
        }
        .popular-badge {
            position: absolute; top: -14px; left: 50%; transform: translateX(-50%);
            background: var(--brand-blue); color: #fff;
            padding: 4px 14px; border-radius: var(--radius-full);
            font-size: 11px; font-weight: 800; text-transform: uppercase;
            letter-spacing: 0.08em; box-shadow: 0 4px 10px rgba(0, 102, 255, 0.3);
        }
        .pricing-card__name {
            font-size: 19px; font-weight: 800; color: var(--brand-dark); margin-bottom: 6px;
        }
        .pricing-card__sub {
            font-size: 13px; color: var(--brand-muted); margin-bottom: 20px;
        }
        .pricing-card__price-box {
            display: flex; align-items: baseline; gap: 8px; margin-bottom: 6px;
        }
        .pricing-card__price {
            font-size: 34px; font-weight: 800; color: var(--brand-dark);
        }
        .pricing-card__old-price {
            font-size: 15px; color: #94A3B8; text-decoration: line-through;
        }
        .pricing-card__note {
            font-size: 12px; font-weight: 700; color: var(--brand-green); margin-bottom: 24px;
        }
        .pricing-features {
            list-style: none; padding: 0; margin: 0 0 32px;
            border-top: 1px solid var(--brand-border); padding-top: 20px;
        }
        .pricing-feature-item {
            display: flex; align-items: flex-start; gap: 10px;
            font-size: 13px; color: #334155; margin-bottom: 12px; line-height: 1.5;
        }
        .pricing-feature-item svg {
            width: 17px; height: 17px; color: var(--brand-green); flex-shrink: 0; margin-top: 2px;
        }
        .btn-pricing {
            width: 100%; padding: 13px; border-radius: var(--radius-full);
            font-size: 14px; font-weight: 700; text-align: center;
            text-decoration: none; display: inline-flex; align-items: center; justify-content: center;
            gap: 8px; transition: all 0.2s ease;
        }
        .btn-pricing--outline {
            background: transparent; color: var(--brand-dark);
            border: 1px solid var(--brand-border);
        }
        .btn-pricing--outline:hover {
            background: #F1F5F9; border-color: #94A3B8;
        }
        .btn-pricing--blue {
            background: var(--brand-blue); color: #fff; border: none;
            box-shadow: 0 4px 14px rgba(0, 102, 255, 0.3);
        }
        .btn-pricing--blue:hover {
            background: #0052cc; box-shadow: var(--shadow-blue-glow);
        }

        /* ── FAQ SECTION ── */
        .faq-wrap {
            max-width: 780px; margin: 0 auto;
        }
        .faq-item {
            background: var(--brand-surface);
            border: 1px solid var(--brand-border);
            border-radius: var(--radius-lg);
            margin-bottom: 14px;
            overflow: hidden;
            box-shadow: var(--shadow-subtle);
            transition: all 0.2s ease;
        }
        .faq-item:hover { border-color: #CBD5E1; }
        .faq-question {
            width: 100%; padding: 20px 24px;
            background: transparent; border: none;
            display: flex; justify-content: space-between; align-items: center;
            font-family: inherit; font-size: 16px; font-weight: 800;
            color: var(--brand-dark); text-align: left; cursor: pointer;
            gap: 16px;
        }
        .faq-chevron {
            width: 20px; height: 20px; color: var(--brand-muted);
            transition: transform 0.25s ease; flex-shrink: 0;
        }
        .faq-item.is-open .faq-chevron {
            transform: rotate(180deg); color: var(--brand-blue);
        }
        .faq-answer {
            max-height: 0; overflow: hidden;
            transition: max-height 0.3s ease-out;
            padding: 0 24px;
        }
        .faq-item.is-open .faq-answer {
            padding-bottom: 22px;
        }
        .faq-answer p {
            font-size: 14px; color: var(--brand-muted); line-height: 1.65;
        }

        /* ── FINAL BANNER CTA ── */
        .cta-banner {
            background: linear-gradient(135deg, #0A0F1D 0%, #172554 100%);
            border-radius: var(--radius-xl);
            padding: 56px 40px; text-align: center;
            color: #fff; margin-top: 64px;
            box-shadow: var(--shadow-float);
        }
        .cta-banner__title {
            font-size: clamp(26px, 3.5vw, 36px);
            font-weight: 800; margin-bottom: 14px;
        }
        .cta-banner__sub {
            font-size: 16px; color: #94A3B8; margin-bottom: 30px; max-width: 540px; margin-left: auto; margin-right: auto;
        }
        .btn-wa-hero {
            background: #25D366; color: #fff; text-decoration: none;
            padding: 15px 32px; border-radius: var(--radius-full);
            font-size: 15px; font-weight: 800;
            display: inline-flex; align-items: center; gap: 9px;
            box-shadow: 0 6px 20px rgba(37, 211, 102, 0.3);
            transition: all 0.2s ease;
        }
        .btn-wa-hero:hover {
            background: #20BA5A; transform: translateY(-2px);
            box-shadow: 0 10px 24px rgba(37, 211, 102, 0.4);
        }

        /* ── FOOTER ── */
        .footer {
            border-top: 1px solid var(--brand-border);
            background: #FFFFFF;
            padding: 40px 24px; text-align: center;
            font-size: 13px; color: var(--brand-muted);
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 960px) {
            .hero__grid { grid-template-columns: 1fr; text-align: center; }
            .hero__desc { margin: 0 auto 32px; }
            .hero__cta-group { justify-content: center; }
            .hero__stats-row { justify-content: center; }
            .steps-grid { grid-template-columns: 1fr; }
            .calc-panel { grid-template-columns: 1fr; padding: 36px 24px; }
            .bento-wrap { grid-template-columns: 1fr; }
            .pricing-grid { grid-template-columns: 1fr; max-width: 440px; }
            .pricing-card--popular { transform: none; }
            .pricing-card--popular:hover { transform: translateY(-4px); }
            .header__nav .header__link { display: none; }
            .phone-frame { position: relative; margin: 24px auto 0; right: auto; top: auto; }
        }
        @media (max-width: 520px) {
            .smart-card { width: 280px; height: 175px; }
            .phone-frame { width: 180px; height: 320px; right: -10px; }
            .cta-banner { padding: 40px 20px; }
        }
    </style>
</head>
<body>

    <div class="ambient-glow"></div>

    {{-- NAVBAR --}}
    <header class="header">
        <div class="header__inner">
            <a href="/" class="header__brand">
                <img src="{{ asset('logo.png') }}" alt="Logo Tapin" class="header__logo">
                Tap-in
            </a>
            <nav class="header__nav">
                <a href="#cara-kerja" class="header__link">Cara Kerja</a>
                <a href="#kalkulator" class="header__link">Kalkulator</a>
                <a href="#keunggulan" class="header__link">Keunggulan</a>
                <a href="#harga" class="header__link">Paket Harga</a>
                <a href="#faq" class="header__link">Tanya Jawab</a>
                <a href="#harga" class="btn-header-cta">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"></path><path d="M3 6h18"></path><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                    Pesan Kartu
                </a>
            </nav>
        </div>
    </header>

    {{-- HERO SECTION --}}
    <section class="hero">
        <div class="hero__grid">
            <div class="hero__content">
                {{-- Popl Style Rating Badge --}}
                <div class="hero__rating-pill">
                    <div class="rating-avatars">
                        <div class="rating-avatar">A</div>
                        <div class="rating-avatar">B</div>
                        <div class="rating-avatar">C</div>
                    </div>
                    <div class="stars-group">
                        <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                        <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                        <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                        <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                        <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                    </div>
                    <span class="rating-label">Rating 4.9/5 dari 1,200+ Pemilik Bisnis</span>
                </div>

                <h1 class="hero__title">
                    Dapatkan Ulasan <span class="blue-text">Bintang 5</span> Hanya dengan Sekali Tap
                </h1>
                <p class="hero__desc">
                    Tingkatkan reputasi Google Maps tokomu secara instan. Pelanggan cukup menempelkan smartphone ke kartu NFC — halaman ulasan langsung terbuka dalam 1 detik.
                </p>

                <div class="hero__cta-group">
                    <a href="#harga" class="btn-primary-popl">
                        <span>Pesan Kartu Tapin</span>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
                    </a>
                    <a href="#kalkulator" class="btn-secondary-popl">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="16" height="20" x="4" y="2" rx="2"></rect><line x1="8" x2="16" y1="6" y2="6"></line><line x1="16" x2="16" y1="14" y2="14"></line><line x1="8" x2="8" y1="14" y2="14"></line><line x1="12" x2="12" y1="14" y2="14"></line><line x1="8" x2="8" y1="18" y2="18"></line><line x1="12" x2="12" y1="18" y2="18"></line><line x1="16" x2="16" y1="18" y2="18"></line></svg>
                        <span>Hitung Potensi Toko</span>
                    </a>
                </div>

                <div class="hero__stats-row">
                    <div>
                        <div class="stat-item-num">1 Detik</div>
                        <div class="stat-item-label">Kecepatan Buka Link</div>
                    </div>
                    <div>
                        <div class="stat-item-num">+340%</div>
                        <div class="stat-item-label">Kenaikan Ulasan Bulanan</div>
                    </div>
                    <div>
                        <div class="stat-item-num">0 Aplikasi</div>
                        <div class="stat-item-label">Tanpa Perlu Pasang Aplikasi</div>
                    </div>
                </div>
            </div>

            {{-- 3D INTERACTIVE HERO STAGE --}}
            <div class="stage" id="interactive-stage">
                <div class="radar-ring"></div>
                <div class="radar-ring"></div>

                {{-- Physical Smart Card --}}
                <div class="smart-card" id="smart-card-3d">
                    <div class="smart-card-sheen" id="smart-card-sheen"></div>
                    <div class="smart-card__top">
                        <div class="emv-chip">
                            <svg viewBox="0 0 32 24" fill="none">
                                <rect x="1" y="1" width="30" height="22" rx="3" stroke="#856404" stroke-width="1.2"/>
                                <line x1="1" y1="8" x2="31" y2="8" stroke="#856404" stroke-width="1"/>
                                <line x1="1" y1="16" x2="31" y2="16" stroke="#856404" stroke-width="1"/>
                                <line x1="11" y1="8" x2="11" y2="16" stroke="#856404" stroke-width="1"/>
                                <line x1="21" y1="8" x2="21" y2="16" stroke="#856404" stroke-width="1"/>
                            </svg>
                        </div>
                        <div class="nfc-wave-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                                <path d="M6 8a9 9 0 0 1 12 0"></path>
                                <path d="M9 11a5 5 0 0 1 6 0"></path>
                                <path d="M12 14v.01"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <div class="smart-card__brand">
                            <img src="{{ asset('logo.png') }}" style="height: 18px; width: auto;" alt="">
                            Tap<span>in</span>
                        </div>
                        <div class="smart-card__sub">Tempelkan HP ke kartu</div>
                    </div>
                    <div class="smart-card__pill">NFC &amp; QR Aktif</div>
                </div>

                {{-- Ultra-Realistic Smartphone Mockup with Real Google Review Screen --}}
                <div class="phone-frame">
                    <div class="phone-btn phone-btn--vol-up"></div>
                    <div class="phone-btn phone-btn--vol-down"></div>
                    <div class="phone-btn phone-btn--power"></div>

                    <div class="phone-inner-bezel">
                        <div class="phone-screen-sheen"></div>

                        {{-- iOS Status Bar --}}
                        <div class="phone-status-bar">
                            <span class="phone-time">09:41</span>
                            <div class="phone-island">
                                <span class="island-camera"></span>
                            </div>
                            <div class="phone-status-icons">
                                <svg width="12" height="10" viewBox="0 0 12 10" fill="currentColor">
                                    <rect x="0" y="7" width="2" height="3" rx="0.5"/>
                                    <rect x="3" y="5" width="2" height="5" rx="0.5"/>
                                    <rect x="6" y="3" width="2" height="7" rx="0.5"/>
                                    <rect x="9" y="0" width="2" height="10" rx="0.5"/>
                                </svg>
                                <svg width="12" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M12 20h.01"></path><path d="M2 8.82a15 15 0 0 1 20 0"></path><path d="M5 12.859a10 10 0 0 1 14 0"></path><path d="M8.5 16.429a5 5 0 0 1 7 0"></path></svg>
                                <svg width="16" height="8" viewBox="0 0 24 12" fill="currentColor">
                                    <rect x="1" y="1" width="19" height="10" rx="2.5" fill="none" stroke="currentColor" stroke-width="2"/>
                                    <rect x="3" y="3" width="14" height="6" rx="1.5"/>
                                    <path d="M22 4v4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                </svg>
                            </div>
                        </div>

                        {{-- Google Maps Real Review Experience --}}
                        <div class="phone-screen-content">
                            <div class="maps-header-bar">
                                <div class="maps-search-pill">
                                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                    <span>Google Maps</span>
                                </div>
                            </div>

                            {{-- Google Review Modal Sheet --}}
                            <div class="google-review-modal">
                                <div class="modal-drag-handle"></div>
                                <div class="g-header">
                                    <div class="g-avatar">
                                        <svg width="18" height="18" viewBox="0 0 24 24">
                                            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                                            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                                            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
                                            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="g-store-name">Usaha Kamu</div>
                                        <div class="g-store-badge">
                                            <svg width="10" height="10" viewBox="0 0 24 24" fill="#0066FF"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                            <span>Bisnis Terverifikasi</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="g-prompt">Beri penilaian pengalaman Anda</div>

                                <div class="g-stars-row">
                                    <svg class="g-star" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                                    <svg class="g-star" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                                    <svg class="g-star" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                                    <svg class="g-star" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                                    <svg class="g-star" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                                </div>

                                <div class="g-tags-wrap">
                                    <span class="g-tag">Pelayanan Cepat</span>
                                    <span class="g-tag">Sangat Puas</span>
                                </div>

                                <div class="g-submit-btn">
                                    <span>Posting Ulasan</span>
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                                </div>
                            </div>

                            <div class="home-indicator"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- LOGO TICKER MARQUEE --}}
    <div class="marquee-section">
        <div class="marquee-title">Sangat Cocok Digunakan Oleh Berbagai Jenis Bisnis</div>
        <div class="marquee-track">
            <div class="marquee-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8h1a4 4 0 0 1 0 8h-1"></path><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"></path><line x1="6" y1="1" x2="6" y2="4"></line><line x1="10" y1="1" x2="10" y2="4"></line><line x1="14" y1="1" x2="14" y2="4"></line></svg>
                Kedai Kopi &amp; Kafe
            </div>
            <div class="marquee-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 2v7c0 1.1.9 2 2 2h4a2 2 0 0 0 2-2V2"></path><path d="M7 2v20"></path><path d="M21 15V2v0a5 5 0 0 0-5 5v6c0 1.1.9 2 2 2h3Zm0 0v7"></path></svg>
                Restoran &amp; Rumah Makan
            </div>
            <div class="marquee-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="6" cy="6" r="3"></circle><circle cx="6" cy="18" r="3"></circle><line x1="20" y1="4" x2="8.12" y2="15.88"></line><line x1="14.47" y1="14.48" x2="20" y2="20"></line><line x1="8.12" y1="8.12" x2="12" y2="12"></line></svg>
                Barbershop &amp; Salon
            </div>
            <div class="marquee-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"></path></svg>
                Klinik Kecantikan &amp; Gigi
            </div>
            <div class="marquee-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"></path><path d="M3 6h18"></path><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                Toko Retail &amp; Butik
            </div>
            <div class="marquee-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                Hotel &amp; Penginapan
            </div>
            {{-- Loop items --}}
            <div class="marquee-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8h1a4 4 0 0 1 0 8h-1"></path><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"></path><line x1="6" y1="1" x2="6" y2="4"></line><line x1="10" y1="1" x2="10" y2="4"></line><line x1="14" y1="1" x2="14" y2="4"></line></svg>
                Kedai Kopi &amp; Kafe
            </div>
            <div class="marquee-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 2v7c0 1.1.9 2 2 2h4a2 2 0 0 0 2-2V2"></path><path d="M7 2v20"></path><path d="M21 15V2v0a5 5 0 0 0-5 5v6c0 1.1.9 2 2 2h3Zm0 0v7"></path></svg>
                Restoran &amp; Rumah Makan
            </div>
        </div>
    </div>

    {{-- HOW IT WORKS --}}
    <section class="section" id="cara-kerja">
        <div class="section__header">
            <div class="section-tag">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg>
                Cara Kerja
            </div>
            <h2 class="section-heading">Tiga Langkah Sederhana Menuju Bintang 5</h2>
            <p class="section-subheading">Tidak perlu lagi meminta pelanggan mengetik nama tokomu secara manual di Google.</p>
        </div>

        <div class="steps-grid">
            <div class="step-box reveal">
                <div class="step-box__num">01</div>
                <div class="step-icon-wrap step-icon-wrap--blue">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                </div>
                <h3 class="step-box__title">Pajang Kartu di Kasir</h3>
                <p class="step-box__desc">Letakkan kartu fisik berdesain elegan di meja kasir, ruang tunggu, atau meja makan tokomu.</p>
            </div>
            <div class="step-box reveal">
                <div class="step-box__num">02</div>
                <div class="step-icon-wrap step-icon-wrap--purple">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="14" height="20" x="5" y="2" rx="2" ry="2"></rect><path d="M12 18h.01"></path></svg>
                </div>
                <h3 class="step-box__title">Pelanggan Dekatkan HP</h3>
                <p class="step-box__desc">Pelanggan cukup menempelkan HP mereka (iPhone maupun Android) ke kartu. Tanpa perlu pasang aplikasi apapun.</p>
            </div>
            <div class="step-box reveal">
                <div class="step-box__num">03</div>
                <div class="step-icon-wrap step-icon-wrap--green">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10"></path><path d="m9 12 2 2 4-4"></path></svg>
                </div>
                <h3 class="step-box__title">Ulasan Langsung Masuk</h3>
                <p class="step-box__desc">Layar ulasan Google Maps langsung terbuka otomatis. Pelanggan tinggal klik bintang 5 dan ulasan langsung terbit.</p>
            </div>
        </div>
    </section>

    {{-- INTERACTIVE ROI CALCULATOR --}}
    <section class="section" id="kalkulator">
        <div class="calc-panel reveal">
            <div>
                <h2 class="calc-panel__title">Berapa Banyak Ulasan Baru yang Bisa Kamu Dapatkan?</h2>
                <p class="calc-panel__desc">
                    Gunakan slider interaktif di bawah ini untuk menghitung potensi lonjakan ulasan Google Review berdasarkan jumlah pengunjung harian bisnismu.
                </p>
                <div class="slider-box">
                    <div class="slider-meta">
                        <span>Pengunjung Toko Harian:</span>
                        <span class="slider-badge" id="slider-badge-val">50 Orang / Hari</span>
                    </div>
                    <input type="range" min="10" max="300" value="50" step="5" class="slider-input" id="range-calc-input">
                </div>
            </div>
            <div class="calc-display">
                <div class="calc-display__num" id="calc-result-number">+75</div>
                <div class="calc-display__label">Potensi Ulasan Baru / Bulan</div>
                <div class="calc-grid-details">
                    <div>
                        <div class="calc-detail-name">Kredibilitas Toko</div>
                        <div class="calc-detail-val">⭐ 4.8 - 5.0</div>
                    </div>
                    <div>
                        <div class="calc-detail-name">Peringkat Google Maps</div>
                        <div class="calc-detail-val">3 Teratas Lokal ↗</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- FEATURE CARDS 2x2 GRID --}}
    <section class="section" id="keunggulan">
        <div class="section__header">
            <div class="section-tag">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z"></path></svg>
                Keunggulan Spesifikasi
            </div>
            <h2 class="section-heading">Kualitas Kartu Hardware Terbaik</h2>
            <p class="section-subheading">Diproduksi dengan standar industri tahan aus untuk pemakaian komersial jangka panjang.</p>
        </div>

        <div class="bento-wrap">
            <div class="bento-card reveal">
                <div class="bento-icon-btn bento-icon-btn--blue">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22a7 7 0 0 0 7-7c0-2-1-3.9-3-5.5s-3.5-4-4-6.5c-.5 2.5-2 4.9-4 6.5C6 11.1 5 13 5 15a7 7 0 0 0 7 7z"></path></svg>
                </div>
                <h3 class="bento-card__title">100% Anti Air &amp; Noda Kopi</h3>
                <p class="bento-card__desc">Dibuat dari material polimer solid kedap cairan. Tahan cipratan minyak, kuah panas, atau semprotan pembersih meja kasir tanpa merusak sirkuit chip NFC di dalamnya.</p>
            </div>

            <div class="bento-card reveal">
                <div class="bento-icon-btn bento-icon-btn--amber">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg>
                </div>
                <h3 class="bento-card__title">Tanpa Baterai, Aktif Selamanya</h3>
                <p class="bento-card__desc">Ditenagai induksi gelombang pasif saat smartphone mendekat. Tidak memerlukan kabel charger, bebas colokan listrik, dan aktif seumur hidup tanpa habis daya.</p>
            </div>

            <div class="bento-card reveal">
                <div class="bento-icon-btn bento-icon-btn--purple">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="14" height="20" x="5" y="2" rx="2" ry="2"></rect><path d="M12 18h.01"></path></svg>
                </div>
                <h3 class="bento-card__title">Kompatibel 99.9% Smartphone</h3>
                <p class="bento-card__desc">Langsung terbaca oleh sensor NFC di iPhone dan Android modern. Dilengkapi cetakan QR Code cadangan resolusi tinggi di sisi belakang untuk tipe smartphone lawas.</p>
            </div>

            <div class="bento-card reveal">
                <div class="bento-icon-btn bento-icon-btn--green">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12a9 9 0 0 0-9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"></path><path d="M3 3v5h5"></path><path d="M3 12a9 9 0 0 0 9 9 9.75 9.75 0 0 0 6.74-2.74L21 16"></path><path d="M16 16h5v5"></path></svg>
                </div>
                <h3 class="bento-card__title">Bebas Ubah Tautan Kapan Saja</h3>
                <p class="bento-card__desc">Jika tokomu berpindah alamat Maps atau berganti nama toko, kartu fisik tak perlu dicetak ulang. Tautan ulasan dapat dialihkan secara fleksibel dan instan dari sistem.</p>
            </div>
        </div>
    </section>

    {{-- PRICING PACKAGES --}}
    <section class="pricing-section" id="harga">
        <div class="section__header">
            <div class="section-tag">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><path d="m16 10-4 4-2-2"></path></svg>
                Pilihan Paket
            </div>
            <h2 class="section-heading">Investasi Sekali, Hasil Selamanya</h2>
            <p class="section-subheading">Cukup beli kartu fisik satu kali. Tanpa biaya langganan bulanan atau biaya tersembunyi apapun.</p>
        </div>

        <div class="pricing-grid">
            {{-- Paket Single --}}
            <div class="pricing-card reveal">
                <div>
                    <div class="pricing-card__name">Paket Single</div>
                    <div class="pricing-card__sub">Ideal untuk 1 meja kasir toko atau butik</div>
                    <div class="pricing-card__price-box">
                        <span class="pricing-card__price">Rp30.000</span>
                        <span class="pricing-card__old-price">Rp45.000</span>
                    </div>
                    <div class="pricing-card__note">Sekali bayar selamanya</div>

                    <ul class="pricing-features">
                        <li class="pricing-feature-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <span>1x Kartu Fisik Pintar Tapin (NFC + QR)</span>
                        </li>
                        <li class="pricing-feature-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <span>100% Anti Air &amp; Tahan Tumpahan Minuman</span>
                        </li>
                        <li class="pricing-feature-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <span>Bebas Ubah Link Review Kapan Saja</span>
                        </li>
                        <li class="pricing-feature-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <span>Garansi Chip NFC 1 Tahun</span>
                        </li>
                    </ul>
                </div>
                <a href="https://api.whatsapp.com/send?text=Halo%20Tapin,%20saya%20tertarik%20pesan%20Paket%20Single%20(Rp30.000)." target="_blank" rel="noopener" class="btn-pricing btn-pricing--outline">
                    <span>Pesan via WhatsApp</span>
                </a>
            </div>

            {{-- Paket Cafe / Resto (BEST SELLER) --}}
            <div class="pricing-card pricing-card--popular reveal">
                <div class="popular-badge">Paling Laris</div>
                <div>
                    <div class="pricing-card__name">Paket Kafe &amp; Resto</div>
                    <div class="pricing-card__sub">1 Kasir + 2 Meja Pelanggan Strategis</div>
                    <div class="pricing-card__price-box">
                        <span class="pricing-card__price">Rp70.000</span>
                        <span class="pricing-card__old-price">Rp90.000</span>
                    </div>
                    <div class="pricing-card__note">Hemat Rp20.000 • Paling Laris</div>

                    <ul class="pricing-features">
                        <li class="pricing-feature-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <span><strong>3x Kartu Fisik Pintar Tapin</strong></span>
                        </li>
                        <li class="pricing-feature-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <span>Semua Fitur di Paket Single</span>
                        </li>
                        <li class="pricing-feature-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <span>Mendongkrak Konversi Review Hingga 3x Lipat</span>
                        </li>
                        <li class="pricing-feature-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <span>Gratis Setup &amp; Panduan Penempatan Kasir</span>
                        </li>
                    </ul>
                </div>
                <a href="https://api.whatsapp.com/send?text=Halo%20Tapin,%20saya%20mau%20pesan%20Paket%20Kafe%20Resto%20(Rp70.000)." target="_blank" rel="noopener" class="btn-pricing btn-pricing--blue">
                    <span>Pesan Paket Kafe (3 Kartu)</span>
                </a>
            </div>

            {{-- Paket Custom Logo --}}
            <div class="pricing-card reveal">
                <div>
                    <div class="pricing-card__name">Paket Custom Brand</div>
                    <div class="pricing-card__sub">Cetak logo &amp; warna brand tokomu sendiri</div>
                    <div class="pricing-card__price-box">
                        <span class="pricing-card__price">Rp120.000</span>
                        <span class="pricing-card__old-price">Rp150.000</span>
                    </div>
                    <div class="pricing-card__note">Termasuk 5 Kartu Desain Penuh</div>

                    <ul class="pricing-features">
                        <li class="pricing-feature-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <span><strong>5x Kartu Custom Full Desain Toko Kamu</strong></span>
                        </li>
                        <li class="pricing-feature-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <span>Bebas Tentukan Link Berbeda per Cabang</span>
                        </li>
                        <li class="pricing-feature-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <span>Hasil Cetak HD Matte / Glossy Tahan Gores</span>
                        </li>
                        <li class="pricing-feature-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <span>Konsultasi Desain &amp; Preview Mockup Gratis</span>
                        </li>
                    </ul>
                </div>
                <a href="https://api.whatsapp.com/send?text=Halo%20Tapin,%20saya%20tertarik%20konsultasi%20Paket%20Custom%20Brand%20(Rp120.000)." target="_blank" rel="noopener" class="btn-pricing btn-pricing--outline">
                    <span>Konsultasi Desain via WA</span>
                </a>
            </div>
        </div>
    </section>

    {{-- FAQ SECTION --}}
    <section class="section" id="faq">
        <div class="section__header">
            <div class="section-tag">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><path d="M12 17h.01"></path></svg>
                Tanya Jawab
            </div>
            <h2 class="section-heading">Pertanyaan yang Sering Diajukan</h2>
            <p class="section-subheading">Semua hal yang perlu kamu ketahui tentang cara kerja dan kepemilikan kartu pintar Tapin.</p>
        </div>

        <div class="faq-wrap">
            {{-- FAQ 1 --}}
            <div class="faq-item reveal">
                <button type="button" class="faq-question">
                    <span>Apakah ada biaya bulanan atau langganan?</span>
                    <svg class="faq-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </button>
                <div class="faq-answer">
                    <p><strong>Tidak ada sama sekali.</strong> Kamu hanya perlu membayar satu kali saat membeli kartu fisik Tapin. Sistem routing ulasan aktif selamanya tanpa biaya langganan bulanan maupun tahunan.</p>
                </div>
            </div>

            {{-- FAQ 2 --}}
            <div class="faq-item reveal">
                <button type="button" class="faq-question">
                    <span>Apakah pelanggan harus download aplikasi untuk bisa tap kartu?</span>
                    <svg class="faq-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </button>
                <div class="faq-answer">
                    <p><strong>100% tidak perlu aplikasi.</strong> Saat smartphone (iPhone maupun Android) didekatkan ke kartu, sistem NFC bawaan HP langsung membuka browser dan mengarahkan ke halaman Google Review tokomu dalam waktu 1 detik.</p>
                </div>
            </div>

            {{-- FAQ 3 --}}
            <div class="faq-item reveal">
                <button type="button" class="faq-question">
                    <span>Bagaimana jika HP pelanggan belum memiliki fitur NFC?</span>
                    <svg class="faq-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </button>
                <div class="faq-answer">
                    <p>Di setiap sisi belakang kartu Tapin sudah dicetak <strong>QR Code cadangan berkualitas tajam</strong>. Pelanggan yang memakai HP tipe lawas cukup mengarahkan kamera biasa ke QR Code tersebut untuk membuka link ulasan.</p>
                </div>
            </div>

            {{-- FAQ 4 --}}
            <div class="faq-item reveal">
                <button type="button" class="faq-question">
                    <span>Jika suatu saat toko saya pindah alamat, apakah harus beli kartu baru?</span>
                    <svg class="faq-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </button>
                <div class="faq-answer">
                    <p><strong>Tidak perlu beli baru.</strong> Berkat teknologi Decoupled URL Tapin, kamu cukup memperbarui link tujuan Google Maps di sistem kami. Kartu fisik lama yang sudah tersebar akan otomatis langsung me-redirect ke alamat baru.</p>
                </div>
            </div>
        </div>

        {{-- FINAL CTA BANNER --}}
        <div class="cta-banner reveal">
            <h3 class="cta-banner__title">Siap Banjiri Tokomu dengan Ulasan Bintang 5?</h3>
            <p class="cta-banner__sub">Tingkatkan ranking Google Maps dan kepercayaan pelanggan baru mulai hari ini dengan kartu pintar Tapin.</p>
            <a href="https://api.whatsapp.com/send?text=Halo%20Tapin,%20saya%20mau%20konsultasi%20dan%20pesan%20kartu%20review%20untuk%20toko%20saya." target="_blank" rel="noopener" class="btn-wa-hero">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.816 9.816 0 0 0 12.04 2m.01 1.67c2.2 0 4.26.86 5.82 2.42a8.225 8.225 0 0 1 2.41 5.83c0 4.54-3.7 8.24-8.24 8.24-1.48 0-2.93-.4-4.2-1.15l-.3-.18-3.12.82.83-3.04-.2-.31a8.196 8.196 0 0 1-1.26-4.38c0-4.54 3.7-8.24 8.24-8.24m4.52 11.66c-.25-.13-1.47-.72-1.7-.81-.23-.08-.39-.13-.56.13-.17.25-.64.81-.79.97-.14.17-.29.19-.54.06-.25-.13-1.06-.39-2.02-1.25-.75-.67-1.26-1.5-1.41-1.75-.15-.25-.02-.39.11-.51.11-.11.25-.29.37-.44.12-.14.17-.25.25-.42.08-.17.04-.31-.02-.44-.06-.13-.56-1.35-.77-1.85-.2-.49-.41-.42-.56-.43-.14-.01-.31-.01-.47-.01-.17 0-.44.06-.67.31-.23.25-.88.86-.88 2.1 0 1.24.9 2.44 1.03 2.61.12.17 1.77 2.71 4.3 3.79.6.26 1.07.41 1.44.53.61.19 1.16.17 1.6.1.49-.07 1.47-.6 1.68-1.18.21-.58.21-1.07.15-1.18-.06-.1-.23-.17-.48-.29Z"/>
                </svg>
                <span>Pesan Sekarang via WhatsApp</span>
            </a>
        </div>
    </section>

    {{-- FOOTER --}}
    <footer class="footer">
        &copy; {{ date('Y') }} Tapin. Platform Kartu Ulasan Pintar NFC &amp; QR Code untuk Bisnis Lokal.
    </footer>

    {{-- SCRIPTS (MICRO-INTERACTIONS & LIGHTWEIGHT SCROLL OBSERVER) --}}
    <script>
        // 1. Lightweight Scroll Animation (Headlines Excluded for Instant Load)
        document.addEventListener('DOMContentLoaded', () => {
            const reveals = document.querySelectorAll('.reveal');
            if ('IntersectionObserver' in window) {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach((entry) => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('is-revealed');
                            observer.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });

                reveals.forEach(el => observer.observe(el));
            } else {
                reveals.forEach(el => el.classList.add('is-revealed'));
            }
        });

        // 2. Interactive FAQ Accordion
        const faqQuestions = document.querySelectorAll('.faq-question');
        faqQuestions.forEach(btn => {
            btn.addEventListener('click', () => {
                const item = btn.parentElement;
                const answer = item.querySelector('.faq-answer');
                const isOpen = item.classList.contains('is-open');

                // Close other open faqs
                document.querySelectorAll('.faq-item.is-open').forEach(openItem => {
                    if (openItem !== item) {
                        openItem.classList.remove('is-open');
                        openItem.querySelector('.faq-answer').style.maxHeight = null;
                    }
                });

                if (isOpen) {
                    item.classList.remove('is-open');
                    answer.style.maxHeight = null;
                } else {
                    item.classList.add('is-open');
                    answer.style.maxHeight = answer.scrollHeight + 32 + 'px';
                }
            });
        });

        // 3. 3D Card Stage Interactive Mousemove Tilt
        const stageArea = document.getElementById('interactive-stage');
        const cardTarget = document.getElementById('smart-card-3d');
        const sheenTarget = document.getElementById('smart-card-sheen');

        if (stageArea && cardTarget) {
            stageArea.addEventListener('mousemove', (e) => {
                const rect = stageArea.getBoundingClientRect();
                const x = e.clientX - rect.left - (rect.width / 2);
                const y = e.clientY - rect.top - (rect.height / 2);

                const rotateX = -(y / rect.height) * 20;
                const rotateY = (x / rect.width) * 20;

                cardTarget.style.transform = `rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale(1.02)`;
                if (sheenTarget) {
                    sheenTarget.style.transform = `translate(${x * 0.3}px, ${y * 0.3}px)`;
                }
            });

            stageArea.addEventListener('mouseleave', () => {
                cardTarget.style.transform = 'rotateX(6deg) rotateY(-12deg) rotateZ(2deg) scale(1)';
                if (sheenTarget) sheenTarget.style.transform = 'translate(0px, 0px)';
            });
        }

        // 4. Interactive ROI Calculator with Live Counter
        const rangeInput = document.getElementById('range-calc-input');
        const badgeOutput = document.getElementById('slider-badge-val');
        const calcOutput = document.getElementById('calc-result-number');

        if (rangeInput && badgeOutput && calcOutput) {
            rangeInput.addEventListener('input', (e) => {
                const visitors = parseInt(e.target.value);
                badgeOutput.textContent = `${visitors} Orang / Hari`;

                // Kalkulasi konversi ulasan bulanan (~5% pengunjung)
                const monthlyEstimated = Math.round(visitors * 30 * 0.05);
                calcOutput.textContent = `+${monthlyEstimated}`;
            });
        }
    </script>
</body>
</html>
