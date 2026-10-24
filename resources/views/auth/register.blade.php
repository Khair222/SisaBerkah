<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Daftar Akun Baru — SISABERKAH</title>
  <meta name="description" content="Pendaftaran akun baru Admin Mitra dan Pengguna SisaBerkah untuk pemanfaatan sisa bahan organik secara berkelanjutan.">
  <link rel="icon" type="image/png" href="{{ asset('assets/images/logo-icon.png') }}">
  <link rel="stylesheet" href="{{ asset('style.css') }}">
  <script src="{{ asset('assets/js/lucide.min.js') }}"></script>
  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
  <style>
    * {
      box-sizing: border-box;
    }

    html, body.auth-split-body {
      margin: 0;
      padding: 0;
      min-height: 100vh;
      width: 100%;
      font-family: var(--font-body);
      background-color: #04140D;
      color: #FFFFFF;
      overflow-x: hidden;
    }

    .auth-split-container {
      display: flex;
      min-height: 100vh;
      width: 100%;
      max-width: 100vw;
      overflow-x: hidden;
    }

    .auth-hero-side {
      flex: 1.15;
      position: relative;
      background: url('{{ asset("assets/images/login-hero.png") }}') center center / cover no-repeat;
      display: flex;
      flex-direction: column;
      justify-content: flex-end;
      padding: 3.5rem 4rem;
      overflow: hidden;
    }

    .auth-hero-overlay {
      position: absolute;
      inset: 0;
      background: 
        linear-gradient(to top, rgba(3, 16, 10, 0.96) 0%, rgba(3, 16, 10, 0.72) 42%, rgba(3, 16, 10, 0.15) 75%, rgba(3, 16, 10, 0.25) 100%),
        linear-gradient(to right, rgba(3, 16, 10, 0.88) 0%, rgba(3, 16, 10, 0.45) 45%, transparent 85%);
      z-index: 1;
    }

    .auth-hero-content {
      position: relative;
      z-index: 2;
      max-width: 560px;
    }

    .hero-tag {
      color: #22C55E;
      font-family: var(--font-heading);
      font-size: 0.98rem;
      font-weight: 700;
      margin-bottom: 0.85rem;
      letter-spacing: -0.2px;
    }

    .hero-main-title {
      font-family: var(--font-heading);
      font-size: clamp(2.4rem, 3.8vw, 3.4rem);
      font-weight: 800;
      line-height: 1.12;
      color: #FFFFFF;
      margin: 0 0 1.15rem;
      letter-spacing: -0.5px;
      text-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
    }

    .hero-main-title .text-green {
      color: #22C55E;
    }

    .hero-main-desc {
      font-size: 1rem;
      line-height: 1.6;
      color: rgba(255, 255, 255, 0.88);
      margin: 0 0 2.25rem;
      max-width: 480px;
      text-shadow: 0 2px 10px rgba(0, 0, 0, 0.4);
    }

    .hero-features-row {
      display: flex;
      align-items: flex-start;
      gap: 2.25rem;
    }

    .hero-feature-item {
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
      gap: 0.5rem;
    }

    .hero-feature-icon {
      width: 46px;
      height: 46px;
      border-radius: 50%;
      background: rgba(34, 197, 94, 0.16);
      border: 1px solid rgba(34, 197, 94, 0.35);
      display: flex;
      align-items: center;
      justify-content: center;
      color: #22C55E;
      backdrop-filter: blur(6px);
      transition: all 0.25s ease;
    }

    .hero-feature-item:hover .hero-feature-icon {
      transform: translateY(-2px);
      background: rgba(34, 197, 94, 0.25);
      border-color: #22C55E;
    }

    .hero-feature-item span {
      font-size: 0.82rem;
      font-weight: 600;
      color: #FFFFFF;
      line-height: 1.25;
      text-shadow: 0 2px 6px rgba(0, 0, 0, 0.5);
    }

    .auth-form-side {
      flex: 1;
      background-color: #04140D;
      background: radial-gradient(circle at 85% 15%, #082417 0%, #04140D 70%);
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 2.25rem 3rem;
      position: relative;
      overflow-x: hidden;
      overflow-y: auto;
    }

    .auth-form-side::-webkit-scrollbar {
      width: 5px;
    }
    .auth-form-side::-webkit-scrollbar-track {
      background: transparent;
    }
    .auth-form-side::-webkit-scrollbar-thumb {
      background: rgba(34, 197, 94, 0.25);
      border-radius: 9999px;
    }
    .auth-form-side::-webkit-scrollbar-thumb:hover {
      background: rgba(34, 197, 94, 0.5);
    }

    .leaf-watermark-wrap {
      position: absolute;
      inset: 0;
      overflow: hidden;
      pointer-events: none;
      z-index: 1;
    }

    .leaf-watermark {
      position: absolute;
      pointer-events: none;
    }

    .leaf-top-right {
      top: -20px;
      right: -20px;
      width: 240px;
      height: 240px;
      opacity: 0.25;
      transform: rotate(10deg);
    }

    .leaf-bottom-left {
      bottom: -30px;
      left: -30px;
      width: 220px;
      height: 220px;
      opacity: 0.22;
      transform: rotate(-10deg);
    }

    .auth-back-link {
      position: absolute;
      top: 2rem;
      left: 2.5rem;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      color: #FFFFFF;
      text-decoration: none;
      font-size: 0.95rem;
      font-weight: 600;
      z-index: 3;
      transition: all 0.2s ease;
    }

    .auth-back-link:hover {
      color: #22C55E;
      transform: translateX(-3px);
    }

    .auth-form-card {
      width: 100%;
      max-width: 420px;
      margin: auto 0;
      text-align: center;
      position: relative;
      z-index: 2;
    }

    .auth-welcome-text {
      font-size: 0.88rem;
      color: #22C55E;
      margin-bottom: 0.25rem;
      font-weight: 600;
    }

    .auth-title {
      font-family: var(--font-heading);
      font-size: 2.15rem;
      font-weight: 800;
      color: #FFFFFF;
      margin: 0 0 0.35rem;
      letter-spacing: -0.4px;
    }

    .auth-sub {
      font-size: 0.86rem;
      color: #9CA3AF;
      margin: 0 0 1.25rem;
      line-height: 1.45;
    }

    .auth-role-pill {
      display: flex;
      background: rgba(0, 0, 0, 0.4);
      border-radius: 9999px;
      padding: 4px;
      margin-bottom: 1.25rem;
      border: 1px solid rgba(255, 255, 255, 0.12);
      gap: 4px;
    }

    .auth-role-btn {
      flex: 1;
      padding: 0.65rem 1rem;
      border-radius: 9999px;
      border: none;
      background: transparent;
      font-family: var(--font-heading);
      font-size: 0.92rem;
      font-weight: 600;
      color: #CBD5E1;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 0.45rem;
      transition: all 0.25s ease;
    }

    .auth-role-btn.active {
      background: #FFFFFF;
      color: #04140D;
      font-weight: 700;
      box-shadow: 0 4px 14px rgba(0, 0, 0, 0.3);
    }

    .auth-form-group {
      margin-bottom: 1.15rem;
      text-align: left;
    }

    .auth-label {
      display: block;
      font-size: 0.85rem;
      font-weight: 600;
      color: #CBD5E1;
      margin-bottom: 0.45rem;
    }

    .auth-input-wrap {
      position: relative;
      display: flex;
      align-items: center;
    }

    .auth-input-icon {
      position: absolute;
      left: 15px;
      color: #22C55E;
      pointer-events: none;
      width: 18px;
      height: 18px;
    }

    .auth-input {
      width: 100%;
      padding: 0.82rem 1rem 0.82rem 2.9rem;
      background: rgba(6, 26, 18, 0.7);
      border: 1px solid rgba(255, 255, 255, 0.12);
      border-radius: 12px;
      color: #FFFFFF;
      font-size: 0.92rem;
      font-family: var(--font-body);
      transition: all 0.2s ease;
      box-sizing: border-box;
    }

    .auth-input:focus {
      outline: none;
      background: rgba(6, 26, 18, 0.95);
      border-color: #22C55E;
      box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.18);
    }

    .auth-input::placeholder {
      color: #4B6356;
    }

    .auth-input-eye {
      position: absolute;
      right: 14px;
      background: none;
      border: none;
      color: #9CA3AF;
      cursor: pointer;
      padding: 4px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .auth-input-eye:hover {
      color: #FFFFFF;
    }

    .auth-submit-btn {
      width: 100%;
      padding: 0.92rem 1.5rem;
      background: #22C55E;
      color: #04140D;
      border: none;
      border-radius: 12px;
      font-family: var(--font-heading);
      font-size: 0.98rem;
      font-weight: 700;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.6rem;
      transition: all 0.2s ease;
      box-shadow: 0 4px 18px rgba(34, 197, 94, 0.35);
    }

    .auth-submit-btn:hover {
      background: #16A34A;
      transform: translateY(-2px);
      box-shadow: 0 6px 22px rgba(34, 197, 94, 0.45);
    }

    .auth-submit-btn:disabled {
      opacity: 0.6;
      cursor: not-allowed;
      transform: none;
    }

    .auth-prompt-footer {
      margin-top: 1.5rem;
      text-align: center;
      font-size: 0.88rem;
      color: #9CA3AF;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.35rem;
      flex-wrap: wrap;
    }

    .auth-prompt-link {
      background: none;
      border: none;
      padding: 0;
      font-family: inherit;
      font-size: 0.88rem;
      font-weight: 700;
      color: #FFFFFF;
      text-decoration: underline;
      cursor: pointer;
      transition: color 0.2s ease;
    }

    .auth-prompt-link:hover {
      color: #22C55E;
    }

    .alert-box {
      border-radius: 14px;
      font-size: 0.88rem;
      margin-bottom: 1.25rem;
      text-align: left;
      display: none;
      transition: all 0.3s ease;
    }

    .alert-box.alert-error {
      background: linear-gradient(135deg, rgba(239, 68, 68, 0.22) 0%, rgba(185, 28, 28, 0.16) 100%);
      color: #FFFFFF;
      border: 1.5px solid #EF4444;
      box-shadow: 0 8px 24px rgba(239, 68, 68, 0.28), inset 0 1px 0 rgba(255, 255, 255, 0.12);
      padding: 1rem 1.15rem;
    }

    .alert-box.alert-success {
      background: linear-gradient(135deg, rgba(34, 197, 94, 0.22) 0%, rgba(22, 163, 74, 0.16) 100%);
      color: #FFFFFF;
      border: 1.5px solid #22C55E;
      box-shadow: 0 8px 24px rgba(34, 197, 94, 0.25);
      padding: 1rem 1.15rem;
    }

    .alert-content-wrap {
      display: flex;
      align-items: flex-start;
      gap: 0.85rem;
    }

    .alert-icon-pill {
      width: 32px;
      height: 32px;
      border-radius: 50%;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }

    .alert-error .alert-icon-pill {
      background: #EF4444;
      color: #FFFFFF;
      box-shadow: 0 2px 10px rgba(239, 68, 68, 0.5);
    }

    .alert-success .alert-icon-pill {
      background: #22C55E;
      color: #04140D;
      box-shadow: 0 2px 10px rgba(34, 197, 94, 0.5);
    }

    .alert-body-text {
      flex: 1;
    }

    .alert-title {
      font-weight: 700;
      font-size: 0.92rem;
      margin-bottom: 0.2rem;
      display: flex;
      align-items: center;
      gap: 0.4rem;
    }

    .alert-error .alert-title {
      color: #FCA5A5;
    }

    .alert-success .alert-title {
      color: #86EFAC;
    }

    .alert-desc {
      font-size: 0.84rem;
      line-height: 1.45;
      color: rgba(255, 255, 255, 0.92);
    }

    .alert-close-btn {
      background: none;
      border: none;
      color: rgba(255, 255, 255, 0.6);
      cursor: pointer;
      padding: 2px;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: color 0.2s;
    }

    .alert-close-btn:hover {
      color: #FFFFFF;
    }

    .auth-input.is-invalid {
      border-color: #EF4444 !important;
      background: rgba(239, 68, 68, 0.08) !important;
      box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.3) !important;
    }

    .auth-warning-popup {
      position: fixed;
      top: 24px;
      left: 50%;
      transform: translate(-50%, -150%);
      z-index: 99999;
      background: #7F1D1D;
      border: 1.5px solid #EF4444;
      border-radius: 14px;
      padding: 0.85rem 1.25rem;
      display: flex;
      align-items: center;
      gap: 0.85rem;
      box-shadow: 0 14px 40px rgba(0, 0, 0, 0.65), 0 0 25px rgba(239, 68, 68, 0.45);
      color: #FFFFFF;
      min-width: 310px;
      max-width: 90vw;
      opacity: 0;
      pointer-events: none;
      transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .auth-warning-popup.show {
      transform: translate(-50%, 0);
      opacity: 1;
      pointer-events: auto;
    }

    .auth-warning-popup-icon {
      width: 32px;
      height: 32px;
      border-radius: 50%;
      background: #EF4444;
      color: #FFFFFF;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
    }

    .auth-warning-popup-content {
      flex: 1;
      text-align: left;
    }

    .auth-warning-popup-title {
      font-weight: 700;
      font-size: 0.9rem;
      color: #FCA5A5;
      margin-bottom: 0.15rem;
    }

    .auth-warning-popup-msg {
      font-size: 0.82rem;
      color: rgba(255, 255, 255, 0.95);
      line-height: 1.35;
    }

    .auth-warning-popup-close {
      background: none;
      border: none;
      color: rgba(255, 255, 255, 0.6);
      cursor: pointer;
      padding: 4px;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: color 0.2s;
    }

    .auth-warning-popup-close:hover {
      color: #FFFFFF;
    }

    .alert-box.shake {
      animation: alertBoxShake 0.4s ease-in-out;
    }

    @keyframes alertBoxShake {
      0%, 100% { transform: translateX(0); }
      20%, 60% { transform: translateX(-8px); }
      40%, 80% { transform: translateX(8px); }
    }

    @keyframes popupShake {
      0%, 100% { transform: translate(-50%, 0); }
      20%, 60% { transform: translate(calc(-50% - 8px), 0); }
      40%, 80% { transform: translate(calc(-50% + 8px), 0); }
    }

    @media (max-width: 960px) {
      .auth-split-container {
        flex-direction: column;
      }
      .auth-hero-side {
        min-height: 400px;
        flex: none;
        padding: 3rem 2rem 2.5rem;
      }
      .hero-main-title {
        font-size: 2.2rem;
      }
      .auth-form-side {
        padding: 4.5rem 1.5rem 3rem;
      }
      .auth-back-link {
        top: 1.5rem;
        left: 1.5rem;
      }
    }
  </style>
</head>
<body class="auth-split-body">

  <div id="authWarningPopup" class="auth-warning-popup" role="alert">
    <div class="auth-warning-popup-icon">
      <i data-lucide="alert-triangle" style="width:18px;height:18px;"></i>
    </div>
    <div class="auth-warning-popup-content">
      <div class="auth-warning-popup-title" id="popupWarnTitle">Peringatan Pendaftaran</div>
      <div class="auth-warning-popup-msg" id="popupWarnMsg">Mohon lengkapi formulir pendaftaran.</div>
    </div>
    <button type="button" class="auth-warning-popup-close" onclick="hideAlert()" aria-label="Tutup peringatan">
      <i data-lucide="x" style="width:16px;height:16px;"></i>
    </button>
  </div>

  <div class="auth-split-container">
    
    <div class="auth-hero-side">
      <div class="auth-hero-overlay"></div>

      <div class="auth-hero-content">
        <div class="hero-tag">#DariSisaMenjadiBerkah</div>
        <h1 class="hero-main-title">
          Kelola bukan<br>
          sekadar sisa<br>
          <span class="text-green">makanan.</span>
        </h1>
        <p class="hero-main-desc">
          Hubungkan langsung penyedia sisa organik terpilah dengan peternakan rakyat, budidaya maggot BSF, dan sentra kompos ramah lingkungan.
        </p>

        <div class="hero-features-row">
          <div class="hero-feature-item">
            <div class="hero-feature-icon">
              <i data-lucide="leaf" style="width:20px;height:20px;"></i>
            </div>
            <span>Kurangi<br>Sampah</span>
          </div>
          <div class="hero-feature-item">
            <div class="hero-feature-icon">
              <i data-lucide="users" style="width:20px;height:20px;"></i>
            </div>
            <span>Dukung<br>Masyarakat</span>
          </div>
          <div class="hero-feature-item">
            <div class="hero-feature-icon">
              <i data-lucide="leaf" style="width:20px;height:20px;"></i>
            </div>
            <span>Jaga<br>Lingkungan</span>
          </div>
        </div>
      </div>
    </div>

    <div class="auth-form-side">
      <div class="leaf-watermark-wrap">
        <svg class="leaf-watermark leaf-top-right" viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M190 10C150 10 90 50 70 120C50 190 100 190 150 180C175 175 190 150 190 120C190 80 185 40 190 10Z" fill="#22C55E" fill-opacity="0.12"/>
          <path d="M190 10C140 60 90 110 70 120" stroke="#22C55E" stroke-opacity="0.18" stroke-width="2.5" stroke-linecap="round"/>
          <path d="M125 75C110 90 95 110 95 110" stroke="#22C55E" stroke-opacity="0.14" stroke-width="1.5"/>
          <path d="M155 45C140 60 125 80 125 80" stroke="#22C55E" stroke-opacity="0.14" stroke-width="1.5"/>
        </svg>

        <svg class="leaf-watermark leaf-bottom-left" viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M10 190C10 150 50 90 120 70C190 50 190 100 180 150C175 175 150 190 120 190C80 190 40 185 10 190Z" fill="#22C55E" fill-opacity="0.12"/>
          <path d="M10 190C60 140 110 90 120 70" stroke="#22C55E" stroke-opacity="0.18" stroke-width="2.5" stroke-linecap="round"/>
          <path d="M75 125C90 110 110 95 110 95" stroke="#22C55E" stroke-opacity="0.14" stroke-width="1.5"/>
          <path d="M45 155C60 140 80 125 80 125" stroke="#22C55E" stroke-opacity="0.14" stroke-width="1.5"/>
        </svg>
      </div>

      <a href="{{ route('home') }}" class="auth-back-link">
        <i data-lucide="arrow-left" style="width:18px;height:18px;"></i>
        <span>Beranda</span>
      </a>

      <div class="auth-form-card">
        <div class="auth-welcome-text">Bergabunglah bersama kami</div>
        <h2 class="auth-title">Daftar Akun Baru</h2>
        <p class="auth-sub" id="regSubDesc">Daftarkan usaha atau peternakan Anda sebagai mitra penerima pasokan organik.</p>

        <div class="auth-role-pill">
          <button type="button" class="auth-role-btn active" id="btnRoleMitra" onclick="setRole('mitra')">
            <i data-lucide="store" style="width:16px;height:16px;"></i>
            <span>Admin Mitra</span>
          </button>
          <button type="button" class="auth-role-btn" id="btnRoleUser" onclick="setRole('user')">
            <i data-lucide="user" style="width:16px;height:16px;"></i>
            <span>User</span>
          </button>
        </div>

        <div id="alertBox" class="alert-box"></div>

        <!-- FORM REGISTER MITRA -->
        <form id="formRegisterMitra" onsubmit="handleRegisterSubmit(event, 'mitra')">
          <div class="auth-form-group">
            <label class="auth-label" for="regMitraName">Nama Usaha / Mitra</label>
            <div class="auth-input-wrap">
              <i data-lucide="store" class="auth-input-icon"></i>
              <input type="text" id="regMitraName" class="auth-input" placeholder="Masukkan nama usaha atau mitra..." required oninput="this.classList.remove('is-invalid')">
            </div>
          </div>

          <div class="auth-form-group">
            <label class="auth-label" for="regMitraEmail">Email Akun Mitra</label>
            <div class="auth-input-wrap">
              <i data-lucide="mail" class="auth-input-icon"></i>
              <input type="email" id="regMitraEmail" class="auth-input" placeholder="contoh: mitra@email.com" required oninput="this.classList.remove('is-invalid')">
            </div>
          </div>

          <div class="auth-form-group">
            <label class="auth-label" for="regMitraPassword">Kata Sandi</label>
            <div class="auth-input-wrap">
              <i data-lucide="lock" class="auth-input-icon"></i>
              <input type="password" id="regMitraPassword" class="auth-input" placeholder="Minimal 4 karakter..." required oninput="this.classList.remove('is-invalid')">
              <button type="button" class="auth-input-eye" onclick="togglePasswordView('regMitraPassword', this)" aria-label="Toggle password view">
                <i data-lucide="eye" style="width:18px;height:18px;"></i>
              </button>
            </div>
          </div>

          <button type="submit" class="auth-submit-btn" id="btnRegMitraSubmit">
            <i data-lucide="check" style="width:18px;height:18px;"></i>
            <span>Daftar sebagai Admin Mitra</span>
          </button>
        </form>

        <!-- FORM REGISTER USER -->
        <form id="formRegisterUser" style="display:none;" onsubmit="handleRegisterSubmit(event, 'user')">
          <div class="auth-form-group">
            <label class="auth-label" for="regUserName">Nama Lengkap</label>
            <div class="auth-input-wrap">
              <i data-lucide="user" class="auth-input-icon"></i>
              <input type="text" id="regUserName" class="auth-input" placeholder="Masukkan nama lengkap Anda..." required oninput="this.classList.remove('is-invalid')">
            </div>
          </div>

          <div class="auth-form-group">
            <label class="auth-label" for="regUserEmail">Email Pengguna</label>
            <div class="auth-input-wrap">
              <i data-lucide="mail" class="auth-input-icon"></i>
              <input type="email" id="regUserEmail" class="auth-input" placeholder="contoh: user@email.com" required oninput="this.classList.remove('is-invalid')">
            </div>
          </div>

          <div class="auth-form-group">
            <label class="auth-label" for="regUserPassword">Kata Sandi</label>
            <div class="auth-input-wrap">
              <i data-lucide="lock" class="auth-input-icon"></i>
              <input type="password" id="regUserPassword" class="auth-input" placeholder="Minimal 4 karakter..." required oninput="this.classList.remove('is-invalid')">
              <button type="button" class="auth-input-eye" onclick="togglePasswordView('regUserPassword', this)" aria-label="Toggle password view">
                <i data-lucide="eye" style="width:18px;height:18px;"></i>
              </button>
            </div>
          </div>

          <button type="submit" class="auth-submit-btn" id="btnRegUserSubmit">
            <i data-lucide="user-plus" style="width:18px;height:18px;"></i>
            <span>Daftar sebagai Pengguna</span>
          </button>
        </form>

        <div class="auth-prompt-footer">
          <span>Sudah punya akun?</span>
          <a href="{{ route('login') }}" class="auth-prompt-link" id="linkToLogin">Masuk di sini</a>
        </div>

      </div>
    </div>

  </div>

  <script>
    let currentRole = '{{ $role ?? "mitra" }}';

    document.addEventListener('DOMContentLoaded', () => {
      const urlParams = new URLSearchParams(window.location.search);
      const roleParam = urlParams.get('role');
      if (roleParam === 'user' || roleParam === 'mitra') {
        setRole(roleParam);
      } else {
        setRole(currentRole || 'mitra');
      }

      if (window.lucide) {
        lucide.createIcons();
      }
    });

    function showAlert(msg, isError = false, title = null) {
      const box = document.getElementById('alertBox');
      const popup = document.getElementById('authWarningPopup');
      
      const defaultTitle = isError ? 'Peringatan Pendaftaran' : 'Berhasil';
      const actualTitle = title || defaultTitle;
      const iconName = isError ? 'alert-triangle' : 'check';

      box.innerHTML = `
        <div class="alert-content-wrap">
          <div class="alert-icon-pill">
            <i data-lucide="${iconName}" style="width:17px;height:17px;"></i>
          </div>
          <div class="alert-body-text">
            <div class="alert-title">${actualTitle}</div>
            <div class="alert-desc">${msg}</div>
          </div>
          <button type="button" class="alert-close-btn" onclick="hideAlert()" aria-label="Tutup peringatan">
            <i data-lucide="x" style="width:16px;height:16px;"></i>
          </button>
        </div>
      `;
      box.className = isError ? 'alert-box alert-error shake' : 'alert-box alert-success';
      box.style.display = 'block';

      if (popup && isError) {
        document.getElementById('popupWarnTitle').textContent = actualTitle;
        document.getElementById('popupWarnMsg').textContent = msg;
        popup.classList.remove('shake');
        void popup.offsetWidth;
        popup.classList.add('show', 'shake');

        if (window.popupWarnTimer) clearTimeout(window.popupWarnTimer);
        window.popupWarnTimer = setTimeout(() => {
          popup.classList.remove('show');
        }, 5000);
      }

      lucide.createIcons();
    }

    function hideAlert() {
      const box = document.getElementById('alertBox');
      if (box) box.style.display = 'none';
      const popup = document.getElementById('authWarningPopup');
      if (popup) popup.classList.remove('show');
      clearInputErrors();
    }

    function clearInputErrors() {
      document.querySelectorAll('.auth-input').forEach(inp => inp.classList.remove('is-invalid'));
    }

    function setRole(role) {
      currentRole = role;
      hideAlert();
      document.getElementById('btnRoleMitra').className = (role === 'mitra') ? 'auth-role-btn active' : 'auth-role-btn';
      document.getElementById('btnRoleUser').className = (role === 'user') ? 'auth-role-btn active' : 'auth-role-btn';

      const desc = document.getElementById('regSubDesc');
      const formMitra = document.getElementById('formRegisterMitra');
      const formUser = document.getElementById('formRegisterUser');

      if (role === 'mitra') {
        desc.textContent = 'Daftarkan usaha atau peternakan Anda sebagai mitra penerima pasokan organik.';
        formMitra.style.display = 'block';
        formUser.style.display = 'none';
      } else {
        desc.textContent = 'Daftar sebagai Pengguna untuk menyalurkan sisa makanan ke mitra terdaftar.';
        formMitra.style.display = 'none';
        formUser.style.display = 'block';
      }

      lucide.createIcons();
    }

    function togglePasswordView(inputId, btn) {
      const input = document.getElementById(inputId);
      if (input.type === 'password') {
        input.type = 'text';
        btn.innerHTML = `<i data-lucide="eye-off" style="width:18px;height:18px;"></i>`;
      } else {
        input.type = 'password';
        btn.innerHTML = `<i data-lucide="eye" style="width:18px;height:18px;"></i>`;
      }
      lucide.createIcons();
    }

    async function handleRegisterSubmit(e, role) {
      e.preventDefault();
      hideAlert();

      let name, email, password, btn;

      if (role === 'mitra') {
        name = document.getElementById('regMitraName').value.trim();
        email = document.getElementById('regMitraEmail').value.trim();
        password = document.getElementById('regMitraPassword').value.trim();
        btn = document.getElementById('btnRegMitraSubmit');
      } else {
        name = document.getElementById('regUserName').value.trim();
        email = document.getElementById('regUserEmail').value.trim();
        password = document.getElementById('regUserPassword').value.trim();
        btn = document.getElementById('btnRegUserSubmit');
      }

      if (!name || !email || !password) {
        showAlert('Semua kolom formulir wajib diisi.', true, 'Kolom Belum Lengkap');
        return;
      }

      if (password.length < 4) {
        showAlert('Kata sandi minimal 4 karakter.', true, 'Kata Sandi Terlalu Pendek');
        return;
      }

      btn.disabled = true;
      btn.innerHTML = `<span>Mendaftarkan akun...</span>`;

      try {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const response = await fetch("{{ route('register.post') }}", {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
          },
          body: JSON.stringify({
            role: role,
            name: name,
            email: email,
            password: password
          })
        });

        const data = await response.json();

        if (response.ok && data.success) {
          btn.innerHTML = `<span>Pendaftaran Berhasil!</span>`;
          showAlert(data.message || 'Pendaftaran berhasil! Mengalihkan...', false, 'Berhasil');

          setTimeout(() => {
            window.location.href = data.redirect || "{{ route('home') }}";
          }, 600);
        } else {
          btn.disabled = false;
          btn.innerHTML = (role === 'mitra') 
            ? `<i data-lucide="check" style="width:18px;height:18px;"></i><span>Daftar sebagai Admin Mitra</span>`
            : `<i data-lucide="user-plus" style="width:18px;height:18px;"></i><span>Daftar sebagai Pengguna</span>`;
          lucide.createIcons();

          showAlert(data.message || 'Gagal mendaftar. Silakan periksa kembali data Anda.', true, 'Pendaftaran Gagal');
        }
      } catch (err) {
        btn.disabled = false;
        btn.innerHTML = (role === 'mitra') 
          ? `<i data-lucide="check" style="width:18px;height:18px;"></i><span>Daftar sebagai Admin Mitra</span>`
          : `<i data-lucide="user-plus" style="width:18px;height:18px;"></i><span>Daftar sebagai Pengguna</span>`;
        lucide.createIcons();
        showAlert('Terjadi kesalahan koneksi server. Silakan coba lagi.', true, 'Kesalahan Jaringan');
      }
    }
  </script>
</body>
</html>
