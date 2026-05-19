<!-- resources/views/filament/pages/auth/login.blade.php -->
<x-filament-panels::page.simple>

    <style>
        /* ── Cacher le titre natif Filament ── */
        .fi-simple-header {
            display: none !important;
        }

        /* ── Centrer et plein écran ── */
        .fi-simple-layout {
            min-height: 100vh !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            background: linear-gradient(135deg, #d4ede3 0%, #b8dfd0 50%, #9dd0c0 100%) !important;
            padding: 20px !important;
        }

        .fi-simple-main {
            width: 100% !important;
            max-width: 880px !important;
            margin: 0 auto !important;
        }

        .fi-simple-page {
            padding: 0 !important;
            background: transparent !important;
            box-shadow: none !important;
            border-radius: 0 !important;
            width: 100% !important;
        }

        /* ── Card login ── */
        .login-wrapper {
            display: flex;
            width: 100%;
            min-height: 460px;
            background: #fff;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 16px 60px rgba(30, 77, 53, .2);
            font-family: 'DM Sans', sans-serif;
        }

        /* ── Gauche ── */
        .left-panel {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px 32px;
            background: #fff;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 36px;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: #1e4d35;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 20px;
        }

        .logo-text {
            font-size: 22px;
            font-weight: 700;
            color: #1e4d35;
            letter-spacing: -.5px;
        }

        .logo-text span {
            color: #3a9d68;
        }

        /* ── Droite ── */
        .right-panel {
            flex: 1;
            background: #1e4d35;
            padding: 44px 44px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .right-panel h1 {
            font-size: 26px;
            font-weight: 700;
            color: #fff;
            letter-spacing: -.5px;
            margin-bottom: 6px;
            font-family: 'DM Sans', sans-serif;
        }

        .right-panel .subtitle {
            font-size: 13px;
            color: rgba(255, 255, 255, .6);
            margin-bottom: 30px;
            line-height: 1.5;
            font-family: 'DM Sans', sans-serif;
        }

        /* ── Inputs Filament ── */
        .right-panel .fi-input-wrp input,
        .right-panel .fi-input {
            background: rgba(255, 255, 255, .12) !important;
            border-color: rgba(255, 255, 255, .15) !important;
            color: #fff !important;
            border-radius: 10px !important;
        }

        .right-panel .fi-input-wrp input::placeholder {
            color: rgba(255, 255, 255, .4) !important;
        }

        .right-panel .fi-input-wrp input:focus {
            background: rgba(255, 255, 255, .2) !important;
            border-color: #3a9d68 !important;
            box-shadow: 0 0 0 2px rgba(58, 157, 104, .25) !important;
        }

        .right-panel label,
        .right-panel .fi-fo-field-wrp-label {
            color: rgba(255, 255, 255, .8) !important;
            font-size: 13px !important;
            font-family: 'DM Sans', sans-serif !important;
        }

        /* Icône œil mot de passe */
        .right-panel .fi-input-suffix-item button,
        .right-panel .fi-input-suffix-item svg {
            color: rgba(255, 255, 255, .5) !important;
        }

        /* Checkbox remember me */
        .right-panel .fi-checkbox-input {
            accent-color: #3a9d68 !important;
        }

        .right-panel .fi-checkbox-label {
            color: rgba(255, 255, 255, .7) !important;
            font-family: 'DM Sans', sans-serif !important;
        }

        /* ── Bouton Sign In ── */
        .right-panel .fi-btn-primary,
        .right-panel button[type="submit"] {
            background: #fff !important;
            color: #1e4d35 !important;
            font-weight: 700 !important;
            border-radius: 10px !important;
            border: none !important;
            box-shadow: 0 4px 18px rgba(0, 0, 0, .15) !important;
            width: 100% !important;
            font-family: 'DM Sans', sans-serif !important;
            font-size: 14px !important;
            padding: 12px !important;
            transition: background .15s !important;
        }

        .right-panel .fi-btn-primary:hover,
        .right-panel button[type="submit"]:hover {
            background: #e8f5ef !important;
        }

        /* ── Liens ── */
        .right-panel .fi-link,
        .right-panel a {
            color: rgba(255, 255, 255, .6) !important;
            font-size: 12px !important;
            font-family: 'DM Sans', sans-serif !important;
        }

        .right-panel .fi-link:hover,
        .right-panel a:hover {
            color: #fff !important;
        }

        /* ── Responsive ── */
        @media (max-width: 640px) {
            .login-wrapper {
                flex-direction: column;
            }

            .left-panel {
                padding: 28px 20px 16px;
            }

            .right-panel {
                padding: 28px 20px;
            }
        }

        /* ── Inputs blancs avec texte foncé ── */
        .right-panel .fi-input-wrp input,
        .right-panel .fi-input {
            background: rgba(255, 255, 255, .95) !important;
            border-color: rgba(255, 255, 255, .3) !important;
            color: #1e4d35 !important;
            -webkit-text-fill-color: #1e4d35 !important;
            border-radius: 10px !important;
            font-weight: 500 !important;
        }

        .right-panel .fi-input-wrp input::placeholder {
            color: #6b9e84 !important;
            -webkit-text-fill-color: #6b9e84 !important;
        }

        .right-panel .fi-input-wrp input:focus {
            background: #fff !important;
            border-color: #3a9d68 !important;
            box-shadow: 0 0 0 3px rgba(58, 157, 104, .2) !important;
        }

        /* ── Fix autofill ── */
        .right-panel .fi-input-wrp input:-webkit-autofill,
        .right-panel .fi-input-wrp input:-webkit-autofill:hover,
        .right-panel .fi-input-wrp input:-webkit-autofill:focus {
            -webkit-box-shadow: 0 0 0 50px #fff inset !important;
            -webkit-text-fill-color: #1e4d35 !important;
            caret-color: #1e4d35 !important;
        }

        /* ── Labels Email et Password en blanc ── */
        .right-panel label,
        .right-panel .fi-fo-field-wrp-label,
        .right-panel .fi-label,
        .right-panel [class*="fi-fo"] label,
        .right-panel span.text-sm {
            color: #fff !important;
        }
    </style>

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">

    <div class="login-wrapper">

        {{-- ── Côté gauche : logo + illustration ── --}}
        <div class="left-panel">
            <div class="logo">
                <div class="logo-icon">🤝</div>
                <span class="logo-text">Service<span>Social</span></span>
            </div>

            <svg width="220" height="200" viewBox="0 0 220 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                <ellipse cx="110" cy="100" rx="80" ry="76" fill="#d4ede3" opacity=".7" />
                <ellipse cx="110" cy="100" rx="58" ry="55" fill="#b8dfd0" opacity=".5" />
                <rect x="76" y="30" width="66" height="118" rx="13" fill="#1e4d35" />
                <rect x="82" y="40" width="54" height="94" rx="7" fill="#3a9d68" />
                <rect x="91" y="55" width="36" height="4" rx="2" fill="rgba(255,255,255,.4)" />
                <rect x="91" y="65" width="26" height="3" rx="1.5" fill="rgba(255,255,255,.25)" />
                <rect x="91" y="73" width="30" height="3" rx="1.5" fill="rgba(255,255,255,.25)" />
                <rect x="91" y="83" width="36" height="3" rx="1.5" fill="rgba(255,255,255,.15)" />
                <rect x="91" y="95" width="20" height="18" rx="4" fill="rgba(255,255,255,.3)" />
                <circle cx="160" cy="42" r="18" fill="#5bbf8e" opacity=".9" />
                <circle cx="160" cy="42" r="11" fill="none" stroke="#fff" stroke-width="2.5" opacity=".8" />
                <line x1="160" y1="31" x2="160" y2="53" stroke="#fff" stroke-width="2" />
                <line x1="149" y1="42" x2="171" y2="42" stroke="#fff" stroke-width="2" />
                <circle cx="173" cy="64" r="11" fill="#3a9d68" opacity=".75" />
                <rect x="46" y="122" width="20" height="34" rx="5" fill="#1e4d35" />
                <circle cx="56" cy="115" r="9" fill="#1e4d35" />
                <rect x="140" y="127" width="17" height="28" rx="4" fill="#5bbf8e" />
                <circle cx="148" cy="120" r="8" fill="#5bbf8e" />
                <circle cx="60" cy="123" r="11" fill="none" stroke="#fff" stroke-width="2.5" />
                <line x1="66" y1="129" x2="76" y2="139" stroke="#fff" stroke-width="2.5" stroke-linecap="round" />
                <circle cx="36" cy="55" r="7" fill="#b8dfd0" opacity=".8" />
                <circle cx="178" cy="155" r="5" fill="#3a9d68" opacity=".4" />
                <circle cx="28" cy="128" r="4" fill="#5bbf8e" opacity=".3" />
                <circle cx="190" cy="90" r="4" fill="#b8dfd0" opacity=".5" />
            </svg>
        </div>

        {{-- ── Côté droit : formulaire ── --}}
        <div class="right-panel">
            <h1>Bienvenue !</h1>
            <p class="subtitle">Connectez-vous pour accéder à votre espace de gestion.</p>

            <x-filament-panels::form wire:submit="authenticate">
                {{ $this->form }}
                <x-filament-panels::form.actions :actions="$this->getCachedFormActions()"
                    :full-width="$this->hasFullWidthFormActions()" />
            </x-filament-panels::form>
        </div>

    </div>

</x-filament-panels::page.simple>
