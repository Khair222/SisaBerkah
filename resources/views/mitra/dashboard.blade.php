<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Dashboard Kelola Mitra — SISABERKAH</title>
  <meta name="description" content="Dashboard pengaturan profil usaha, kebutuhan pasokan bahan organik, dan keamanan akun untuk mitra terdaftar SisaBerkah.">
  <link rel="icon" type="image/png" href="{{ asset('assets/images/logo-icon.png') }}">
  <link rel="stylesheet" href="{{ asset('style.css') }}">
  <script src="{{ asset('assets/js/lucide.min.js') }}"></script>
  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
  <style>
    :root {
      --sidebar-w: 280px;
      --sidebar-bg: #116246;
      --sidebar-border: rgba(255, 255, 255, 0.16);
      --sidebar-hover: rgba(255, 255, 255, 0.14);
      --sidebar-active-bg: rgba(255, 255, 255, 0.24);
      --sidebar-active-text: #FFFFFF;
      --sidebar-text: #E8FAF2;
      --sidebar-muted: #A7F3D0;
      --dash-bg: #F4F6F4;
      --card-bg: #FFFFFF;
      --border-color: #E2E8E2;
      --primary: #10B981;
      --primary-dark: #047857;
      --accent-green: #34D399;
    }

    * {
      box-sizing: border-box;
    }

    body.dashboard-body {
      margin: 0;
      padding: 0;
      font-family: var(--font-body);
      background-color: var(--dash-bg);
      color: var(--color-text);
      min-height: 100vh;
      display: flex;
    }

    /* ================= 1. LEFT SIDEBAR ================= */
    .dashboard-sidebar {
      width: var(--sidebar-w);
      height: 100vh;
      position: fixed;
      top: 0;
      left: 0;
      background: #116246;
      background: linear-gradient(180deg, #157351 0%, #0E523A 100%);
      border-right: 1px solid var(--sidebar-border);
      display: flex;
      flex-direction: column;
      z-index: 1000;
      transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
      overflow-y: auto;
      box-shadow: 4px 0 25px rgba(14, 82, 58, 0.15);
    }

    .sidebar-brand-box {
      padding: 1.5rem 1.5rem 1.25rem;
      border-bottom: 1px solid var(--sidebar-border);
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .sidebar-brand-link {
      display: flex;
      align-items: center;
      text-decoration: none;
    }

    .sidebar-logo {
      height: 34px;
      width: auto;
      object-fit: contain;
    }

    .sidebar-panel-tag {
      font-size: 0.74rem;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.8px;
      background: rgba(255, 255, 255, 0.2);
      color: #FFFFFF;
      border: 1px solid rgba(255, 255, 255, 0.35);
      padding: 0.3rem 0.85rem;
      border-radius: 9999px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
    }

    .sidebar-mitra-card {
      margin: 1.15rem 1.15rem 0.75rem;
      padding: 0.95rem;
      background: rgba(0, 0, 0, 0.15);
      border: 1px solid rgba(255, 255, 255, 0.16);
      border-radius: 14px;
      display: flex;
      align-items: center;
      gap: 0.85rem;
      box-shadow: inset 0 1px 2px rgba(255, 255, 255, 0.08);
    }

    .sidebar-avatar-wrap {
      position: relative;
      width: 44px;
      height: 44px;
      flex-shrink: 0;
    }

    .sidebar-avatar-img {
      width: 100%;
      height: 100%;
      border-radius: 12px;
      object-fit: cover;
      border: 2px solid #6EE7B7;
    }

    .sidebar-online-dot {
      position: absolute;
      bottom: -2px;
      right: -2px;
      width: 11px;
      height: 11px;
      background: #22C55E;
      border: 2px solid #0E523A;
      border-radius: 50%;
    }

    .sidebar-mitra-info {
      flex: 1;
      min-width: 0;
    }

    .sidebar-mitra-name {
      font-family: var(--font-heading);
      font-size: 0.92rem;
      font-weight: 700;
      color: #FFFFFF;
      margin: 0 0 2px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .sidebar-mitra-owner {
      font-size: 0.76rem;
      color: #D1FAE5;
      margin: 0;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .sidebar-nav {
      flex: 1;
      padding: 0.85rem 0.85rem;
      display: flex;
      flex-direction: column;
      gap: 0.35rem;
    }

    .sidebar-nav-header {
      font-size: 0.72rem;
      font-weight: 800;
      letter-spacing: 0.9px;
      color: #A7F3D0;
      text-transform: uppercase;
      padding: 0.85rem 0.65rem 0.35rem;
      opacity: 0.95;
    }

    .sidebar-nav-btn {
      width: 100%;
      display: flex;
      align-items: center;
      gap: 0.8rem;
      padding: 0.75rem 0.95rem;
      border-radius: 11px;
      border: 1px solid transparent;
      background: transparent;
      color: var(--sidebar-text);
      font-family: inherit;
      font-size: 0.88rem;
      font-weight: 600;
      cursor: pointer;
      text-align: left;
      transition: all 0.2s ease;
      position: relative;
    }

    .sidebar-nav-btn i {
      width: 18px;
      height: 18px;
      color: var(--sidebar-muted);
      transition: color 0.2s ease;
      flex-shrink: 0;
    }

    .sidebar-nav-btn:hover {
      background: var(--sidebar-hover);
      color: #FFFFFF;
      border-color: rgba(255, 255, 255, 0.18);
    }

    .sidebar-nav-btn:hover i {
      color: #FFFFFF;
    }

    .sidebar-nav-btn.active {
      background: var(--sidebar-active-bg);
      color: #FFFFFF;
      font-weight: 700;
      border-color: rgba(255, 255, 255, 0.3);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .sidebar-nav-btn.active i {
      color: #FFFFFF;
    }

    .sidebar-nav-btn.active::before {
      content: '';
      position: absolute;
      left: 0;
      top: 15%;
      bottom: 15%;
      width: 4px;
      background: #86EFAC;
      border-radius: 0 4px 4px 0;
      box-shadow: 0 0 8px rgba(134, 239, 172, 0.9);
    }

    .sidebar-badge-count {
      margin-left: auto;
      font-size: 0.72rem;
      font-weight: 700;
      padding: 0.18rem 0.5rem;
      border-radius: 9999px;
      background: rgba(255, 255, 255, 0.24);
      color: #FFFFFF;
      border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .sidebar-footer {
      padding: 1.15rem 1rem;
      border-top: 1px solid var(--sidebar-border);
      display: flex;
      flex-direction: column;
      gap: 0.45rem;
      background: rgba(0, 0, 0, 0.16);
    }

    .sidebar-footer-link {
      display: flex;
      align-items: center;
      gap: 0.65rem;
      padding: 0.65rem 0.85rem;
      border-radius: 9px;
      font-size: 0.82rem;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.2s ease;
    }

    .sidebar-footer-link.public {
      background: rgba(255, 255, 255, 0.14);
      color: #FFFFFF;
      border: 1px solid rgba(255, 255, 255, 0.24);
    }

    .sidebar-footer-link.public:hover {
      background: rgba(255, 255, 255, 0.25);
      border-color: rgba(255, 255, 255, 0.4);
    }

    .sidebar-footer-link.logout {
      background: rgba(239, 68, 68, 0.2);
      color: #FEE2E2;
      border: 1px solid rgba(239, 68, 68, 0.35);
      cursor: pointer;
      width: 100%;
    }

    .sidebar-footer-link.logout:hover {
      background: #EF4444;
      color: #FFFFFF;
      border-color: #DC2626;
    }

    /* ================= 2. MAIN CONTENT WRAPPER ================= */
    .dashboard-main-area {
      flex: 1;
      margin-left: var(--sidebar-w);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      width: calc(100% - var(--sidebar-w));
    }

    .dashboard-header-bar {
      background: #FFFFFF;
      border-bottom: 1px solid var(--border-color);
      padding: 1.15rem 2.25rem;
      display: flex;
      align-items: center;
      justify-content: space-between;
      position: sticky;
      top: 0;
      z-index: 99;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
    }

    .header-welcome-col h1 {
      font-family: var(--font-heading);
      font-size: 1.35rem;
      font-weight: 800;
      color: var(--color-text);
      margin: 0 0 2px;
      letter-spacing: -0.3px;
    }

    .header-welcome-col p {
      font-size: 0.84rem;
      color: var(--color-muted);
      margin: 0;
    }

    .header-action-col {
      display: flex;
      align-items: center;
      gap: 0.85rem;
    }

    .header-mitra-badge {
      display: inline-flex;
      align-items: center;
      gap: 0.45rem;
      background: #EDF7EE;
      color: var(--color-primary-dark);
      border: 1px solid #C8E6C9;
      border-radius: 9999px;
      padding: 0.4rem 0.85rem;
      font-size: 0.82rem;
      font-weight: 700;
    }

    .header-web-btn {
      display: inline-flex;
      align-items: center;
      gap: 0.4rem;
      padding: 0.42rem 0.95rem;
      background: #FFFFFF;
      border: 1px solid var(--border-color);
      border-radius: 9999px;
      font-size: 0.82rem;
      font-weight: 600;
      color: var(--color-text);
      text-decoration: none;
      transition: all 0.2s ease;
    }

    .header-web-btn:hover {
      border-color: var(--color-primary);
      color: var(--color-primary);
    }

    .dashboard-workspace-body {
      flex: 1;
      padding: 2rem 2.25rem 3rem;
      max-width: 1350px;
      width: 100%;
      margin: 0 auto;
    }

    .dashboard-tab-pane {
      display: none;
      animation: fadeInTab 0.3s ease;
    }

    .dashboard-tab-pane.active {
      display: block;
    }

    @keyframes fadeInTab {
      from { opacity: 0; transform: translateY(6px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* ================= 3. OVERVIEW TAB STYLES ================= */
    .overview-hero-banner {
      background: linear-gradient(135deg, #062817 0%, #03180F 100%);
      border: 1px solid rgba(34, 197, 94, 0.24);
      border-radius: 18px;
      padding: 2rem 2.25rem;
      margin-bottom: 1.85rem;
      display: flex;
      flex-direction: column;
      gap: 1.35rem;
      box-shadow: 0 8px 24px rgba(4, 20, 13, 0.12);
      position: relative;
      overflow: hidden;
    }

    .overview-hero-banner::after {
      content: '';
      position: absolute;
      top: -50px;
      right: -50px;
      width: 220px;
      height: 220px;
      background: radial-gradient(circle, rgba(34, 197, 94, 0.18) 0%, transparent 70%);
      border-radius: 50%;
      pointer-events: none;
    }

    .overview-hero-text {
      position: relative;
      z-index: 1;
      max-width: 820px;
    }

    .overview-hero-text h2 {
      font-family: var(--font-heading);
      font-size: 1.6rem;
      font-weight: 800;
      color: #FFFFFF;
      margin: 0 0 0.45rem;
      letter-spacing: -0.3px;
    }

    .overview-hero-text p {
      font-size: 0.92rem;
      line-height: 1.65;
      color: rgba(255, 255, 255, 0.85);
      margin: 0;
    }

    .overview-hero-actions {
      display: flex;
      align-items: center;
      gap: 0.85rem;
      flex-wrap: wrap;
      position: relative;
      z-index: 1;
    }

    .btn-hero-primary {
      padding: 0.75rem 1.35rem;
      background: #22C55E;
      color: #04140D;
      font-weight: 700;
      font-size: 0.88rem;
      border: none;
      border-radius: 12px;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      text-decoration: none;
      box-shadow: 0 4px 14px rgba(34, 197, 94, 0.35);
      transition: all 0.2s ease;
      white-space: nowrap;
    }

    .btn-hero-primary:hover {
      background: #16A34A;
      transform: translateY(-2px);
      box-shadow: 0 6px 18px rgba(34, 197, 94, 0.45);
    }

    .btn-hero-secondary {
      padding: 0.75rem 1.35rem;
      background: rgba(255, 255, 255, 0.12);
      color: #FFFFFF;
      font-weight: 600;
      font-size: 0.88rem;
      border: 1px solid rgba(255, 255, 255, 0.28);
      border-radius: 12px;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      text-decoration: none;
      backdrop-filter: blur(6px);
      transition: all 0.2s ease;
      white-space: nowrap;
    }

    .btn-hero-secondary:hover {
      background: rgba(255, 255, 255, 0.22);
      border-color: rgba(255, 255, 255, 0.45);
      transform: translateY(-2px);
    }

    .overview-stats-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
      gap: 1.25rem;
      margin-bottom: 1.85rem;
    }

    .stat-metric-card {
      background: #FFFFFF;
      border: 1px solid var(--border-color);
      border-radius: 16px;
      padding: 1.35rem 1.4rem;
      display: flex;
      align-items: flex-start;
      gap: 1rem;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.02);
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .stat-metric-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.05);
    }

    .stat-icon-wrap {
      width: 48px;
      height: 48px;
      border-radius: 14px;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }

    .stat-icon-green { background: #E8F5E9; color: #2E7D32; }
    .stat-icon-blue  { background: #E0F2FE; color: #0284C7; }
    .stat-icon-amber { background: #FEF3C7; color: #D97706; }
    .stat-icon-purple{ background: #F3E8FF; color: #7C3AED; }

    .stat-content-box {
      flex: 1;
      min-width: 0;
    }

    .stat-label-text {
      font-size: 0.74rem;
      font-weight: 700;
      color: var(--color-muted);
      text-transform: uppercase;
      letter-spacing: 0.5px;
      margin-bottom: 0.3rem;
    }

    .stat-value-text {
      font-family: var(--font-heading);
      font-size: 1.15rem;
      font-weight: 800;
      color: var(--color-text);
      line-height: 1.25;
      margin-bottom: 0.25rem;
      word-break: break-word;
    }

    .stat-sub-text {
      font-size: 0.82rem;
      color: var(--color-muted);
      line-height: 1.4;
    }

    .settings-grid {
      display: grid;
      grid-template-columns: 1.35fr 1fr;
      gap: 1.75rem;
    }

    .settings-card {
      background: #FFFFFF;
      border: 1px solid var(--border-color);
      border-radius: 18px;
      padding: 2rem;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.02);
    }

    .settings-card-header {
      margin-bottom: 1.5rem;
      padding-bottom: 1rem;
      border-bottom: 1px solid var(--border-color);
      display: flex;
      align-items: center;
      gap: 0.75rem;
    }

    .settings-card-header i {
      color: var(--color-primary);
    }

    .settings-card-header h3 {
      font-family: var(--font-heading);
      font-size: 1.15rem;
      font-weight: 800;
      color: var(--color-text);
      margin: 0;
    }

    .settings-card-header p {
      font-size: 0.8rem;
      color: var(--color-muted);
      margin: 0.2rem 0 0;
    }

    .pwd-input-wrap {
      position: relative;
    }

    .pwd-toggle-btn {
      position: absolute;
      right: 12px;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      color: #94A3B8;
      cursor: pointer;
      padding: 4px;
      display: flex;
      align-items: center;
    }

    .pwd-toggle-btn:hover {
      color: var(--color-text);
    }

    .settings-alert {
      padding: 0.85rem 1.15rem;
      border-radius: 12px;
      font-size: 0.85rem;
      margin-bottom: 1.25rem;
      display: none;
      align-items: flex-start;
      gap: 0.75rem;
    }

    .settings-alert.error {
      display: flex;
      background: #FEF2F2;
      border: 1.5px solid #EF4444;
      color: #991B1B;
    }

    .settings-alert.success {
      display: flex;
      background: #F0FDF4;
      border: 1.5px solid #22C55E;
      color: #166534;
    }

    .account-meta-row {
      display: flex;
      justify-content: space-between;
      padding: 0.85rem 0;
      border-bottom: 1px solid #F1F5F1;
      font-size: 0.86rem;
    }

    .account-meta-label {
      color: var(--color-muted);
      font-weight: 500;
    }

    .account-meta-val {
      font-weight: 700;
      color: var(--color-text);
      text-align: right;
    }

    .mobile-dash-header {
      display: none;
      background: #116246;
      background: linear-gradient(90deg, #157351 0%, #0E523A 100%);
      padding: 0.85rem 1.25rem;
      border-bottom: 1px solid var(--sidebar-border);
      align-items: center;
      justify-content: space-between;
      width: 100%;
      position: sticky;
      top: 0;
      z-index: 1010;
    }

    .mobile-sidebar-toggle {
      background: rgba(255, 255, 255, 0.08);
      border: 1px solid var(--sidebar-border);
      color: #FFFFFF;
      padding: 0.45rem;
      border-radius: 9px;
      cursor: pointer;
      display: flex;
      align-items: center;
    }

    .mobile-dash-logo {
      height: 28px;
    }

    .sidebar-backdrop {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, 0.6);
      z-index: 999;
      backdrop-filter: blur(2px);
    }

    @media (max-width: 1024px) {
      .dashboard-sidebar {
        transform: translateX(-100%);
      }

      .dashboard-sidebar.open {
        transform: translateX(0);
      }

      .sidebar-backdrop.active {
        display: block;
      }

      .dashboard-main-area {
        margin-left: 0;
        width: 100%;
      }

      .mobile-dash-header {
        display: flex;
      }

      .settings-grid {
        grid-template-columns: 1fr;
      }
    }

    /* Pasokan Masuk Filter Pills & Table */
    .pasokan-filter-pill {
      background: #FFFFFF;
      border: 1px solid #E2E8F0;
      color: #64748B;
      padding: 0.35rem 0.85rem;
      border-radius: 9999px;
      font-size: 0.78rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.2s ease;
      display: inline-flex;
      align-items: center;
      gap: 0.35rem;
    }
    .pasokan-filter-pill:hover {
      background: #F1F5F9;
      color: var(--color-text);
      border-color: #CBD5E1;
    }
    .pasokan-filter-pill.active {
      background: var(--color-primary);
      color: #FFFFFF;
      border-color: var(--color-primary);
      box-shadow: 0 2px 6px rgba(16, 185, 129, 0.25);
    }

    /* Custom image thumb delete button */
    .custom-thumb-wrapper {
      position: relative;
      display: inline-flex;
    }

    .btn-delete-custom-img {
      position: absolute;
      top: -7px;
      right: -7px;
      width: 22px;
      height: 22px;
      border-radius: 50%;
      background: #EF4444;
      color: #FFFFFF;
      border: 2px solid #FFFFFF;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
      transition: all 0.15s ease;
      z-index: 20;
      padding: 0;
    }

    .btn-delete-custom-img:hover {
      background: #DC2626;
      transform: scale(1.18);
    }
  </style>
</head>
<body class="dashboard-body">
  @include('partials.preloader')

  @php
    $presetImages = [
      'assets/images/partner_doni.jpg',
      'assets/images/partner_budi.jpg',
      'assets/images/partner_adam.jpg',
      'assets/images/partner_haris.jpg',
      'assets/images/about_organic.jpg',
    ];
    $rawImg = $profile->image_url ?: ($profile->image ?: 'assets/images/partner_doni.jpg');
    $isCustomImg = !empty($rawImg) && !in_array($rawImg, $presetImages);

    $pName = $profile->name ?? 'Peternakan Pak Doni';
    $pOwner = $profile->owner ?? 'Pak Doni Prasetyo';
    $pEmail = $user->email ?? 'doni@sisaberkah.id';
    $pId = $profile->id ?? 'doni';
    $pImg = $profile->display_image ?? asset('assets/images/partner_doni.jpg');
    $pCat = $profile->category ?? 'Peternakan';
    $pLoc = $profile->location ?? 'Pakem, Sleman';
    $pFullLoc = $profile->full_location ?? $profile->location ?? 'Pakem, Sleman, D.I. Yogyakarta';
    $pWa = $profile->whatsapp ?? '6283193738711';
    $pNeed = $profile->materials_needed ?? 'Ampas tahu segar, ampas kelapa, & sisa sayuran hijau (sawi, kangkung, kubis)';
    $pAmount = $profile->estimated_amount ?? '150 – 500 Kg / minggu';
    $pTerms = $profile->terms_conditions ?? 'Ampas tahu maksimal 24 jam setelah produksi, bebas kantong kresek.';
    $pDesc = $profile->description ?? 'Peternakan kambing etawa dan domba pedesaan dengan kandang panggung modern.';
    $pHours = $profile->operating_hours ?? 'Senin - Sabtu, 07:00 - 16:00 WIB';
    $pStatus = $profile->status ?? 'active';
  @endphp

  <!-- Mobile Top Header Bar -->
  <header class="mobile-dash-header">
    <button type="button" class="mobile-sidebar-toggle" onclick="toggleMobileSidebar()" aria-label="Buka Menu">
      <i data-lucide="menu" style="width:20px;height:20px;"></i>
    </button>
    <a href="{{ route('home') }}">
      <img src="{{ asset('assets/images/logo.png') }}" alt="SISABERKAH" class="mobile-dash-logo">
    </a>
    <div class="header-mitra-badge" style="padding:0.3rem 0.65rem;font-size:0.75rem;">
      <span class="status-dot"></span>
      <span id="mobileNavPartnerName">{{ $pName }}</span>
    </div>
  </header>

  <div class="sidebar-backdrop" id="sidebarBackdrop" onclick="closeMobileSidebar()"></div>

  <!-- ================= LEFT DASHBOARD SIDEBAR ================= -->
  <aside class="dashboard-sidebar" id="dashboardSidebar">
    
    <div class="sidebar-brand-box" style="justify-content: center;">
      <span class="sidebar-panel-tag" style="font-size: 0.8rem; padding: 0.35rem 0.95rem; letter-spacing: 0.8px;">Mitra Panel</span>
    </div>

    <div class="sidebar-mitra-card">
      <div class="sidebar-avatar-wrap">
        <img id="sidebarAvatarImg" src="{{ $pImg }}" alt="Foto Mitra" class="sidebar-avatar-img">
        <span class="sidebar-online-dot" title="Status Aktif"></span>
      </div>
      <div class="sidebar-mitra-info">
        <h4 id="sidebarPartnerName" class="sidebar-mitra-name">{{ $pName }}</h4>
        <p id="sidebarOwnerName" class="sidebar-mitra-owner">{{ $pOwner }}</p>
      </div>
    </div>

    <!-- Navigation Menu Items -->
    <nav class="sidebar-nav">
      <div class="sidebar-nav-header">MENU UTAMA</div>

      <button type="button" class="sidebar-nav-btn active" data-tab="overview" onclick="switchDashboardTab('overview')">
        <i data-lucide="layout-dashboard"></i>
        <span>Ikhtisar Dashboard</span>
      </button>

      <button type="button" class="sidebar-nav-btn" data-tab="profile" onclick="switchDashboardTab('profile')">
        <i data-lucide="store"></i>
        <span>Profil & Identitas Usaha</span>
      </button>

      <button type="button" class="sidebar-nav-btn" data-tab="needs" onclick="switchDashboardTab('needs')">
        <i data-lucide="sprout"></i>
        <span>Kebutuhan Bahan Organik</span>
      </button>

      <button type="button" class="sidebar-nav-btn" data-tab="preview" onclick="switchDashboardTab('preview')">
        <i data-lucide="eye"></i>
        <span>Pratinjau Publik (Live)</span>
      </button>

      <div class="sidebar-nav-header" style="margin-top:0.6rem;">MANAJEMEN & PENGATURAN</div>

      <button type="button" class="sidebar-nav-btn" data-tab="incoming" onclick="switchDashboardTab('incoming')">
        <i data-lucide="inbox"></i>
        <span>Log Pasokan Masuk</span>
        <span class="sidebar-badge-count">Rutin</span>
      </button>

      <button type="button" class="sidebar-nav-btn" data-tab="settings" onclick="switchDashboardTab('settings')">
        <i data-lucide="settings"></i>
        <span>Pengaturan Akun & Sandi</span>
      </button>
    </nav>

    <div class="sidebar-footer">
      <a href="{{ route('mitra.index') }}#{{ $pId }}" id="sidebarPublicLink" target="_blank" class="sidebar-footer-link public">
        <i data-lucide="external-link" style="width:15px;height:15px;"></i>
        <span>Lihat di Halaman Publik</span>
      </a>
      <a href="{{ route('logout') }}" class="sidebar-footer-link logout">
        <i data-lucide="log-out" style="width:15px;height:15px;"></i>
        <span>Keluar dari Akun</span>
      </a>
    </div>
  </aside>

  <!-- ================= MAIN CONTENT AREA ================= -->
  <div class="dashboard-main-area">

    <header class="dashboard-header-bar">
      <div class="header-welcome-col">
        <h1 id="mainHeaderTitle">Ikhtisar Dashboard</h1>
        <p id="mainHeaderSubtitle">Kelola ketersediaan penerimaan bahan organik dan pengaturan profil Anda.</p>
      </div>
      <div class="header-action-col">
        <div class="header-mitra-badge">
          <span class="status-dot"></span>
          <span id="navPartnerName">{{ $pName }}</span>
        </div>
        <a href="{{ route('mitra.index') }}#{{ $pId }}" id="btnViewPublicMitra" target="_blank" class="header-web-btn">
          <i data-lucide="external-link" style="width:14px;height:14px;"></i>
          <span>Lihat di Web</span>
        </a>
      </div>
    </header>

    <div class="dashboard-workspace-body">

      <!-- TAB 1: IKHTISAR DASHBOARD -->
      <section id="tab-overview" class="dashboard-tab-pane active">
        <div class="overview-hero-banner">
          <div class="overview-hero-text">
            <h2 id="overviewWelcomeName">Halo, {{ $pName }}!</h2>
            <p>
              Akun Anda terhubung aktif ke direktori publik SisaBerkah. Calon penyalur bahan organik (restoran, pasar, katering, dan warga) dapat melihat profil dan menghubungi Anda langsung via WhatsApp resmi.
            </p>
          </div>
          <div class="overview-hero-actions">
            <button type="button" class="btn-hero-primary" onclick="switchDashboardTab('profile')">
              <i data-lucide="edit-3" style="width:16px;height:16px;"></i>
              <span>Edit Profil Usaha</span>
            </button>
            <button type="button" class="btn-hero-secondary" onclick="switchDashboardTab('needs')">
              <i data-lucide="sprout" style="width:16px;height:16px;"></i>
              <span>Atur Kebutuhan Bahan</span>
            </button>
          </div>
        </div>

        <div class="overview-stats-grid">
          <div class="stat-metric-card">
            <div class="stat-icon-wrap stat-icon-green">
              <i data-lucide="activity" style="width:24px;height:24px;"></i>
            </div>
            <div class="stat-content-box">
              <div class="stat-label-text">Status Penerimaan</div>
              <div class="stat-value-text" id="statStatusVal" style="color: {{ $pStatus === 'active' ? '#2E7D32' : '#DC2626' }};">
                {{ $pStatus === 'active' ? 'Buka / Aktif' : 'Tutup Sementara' }}
              </div>
              <div class="stat-sub-text">Menerima pasokan rutin</div>
            </div>
          </div>

          <div class="stat-metric-card">
            <div class="stat-icon-wrap stat-icon-blue">
              <i data-lucide="scale" style="width:24px;height:24px;"></i>
            </div>
            <div class="stat-content-box">
              <div class="stat-label-text">Estimasi Kapasitas</div>
              <div class="stat-value-text" id="statCapacityVal">{{ $pAmount }}</div>
              <div class="stat-sub-text">Volume pakan per minggu</div>
            </div>
          </div>

          <div class="stat-metric-card">
            <div class="stat-icon-wrap stat-icon-amber">
              <i data-lucide="tag" style="width:24px;height:24px;"></i>
            </div>
            <div class="stat-content-box">
              <div class="stat-label-text">Kategori Usaha</div>
              <div class="stat-value-text" id="statCategoryVal">{{ $pCat }}</div>
              <div class="stat-sub-text">Sektor pemanfaatan</div>
            </div>
          </div>

          <div class="stat-metric-card">
            <div class="stat-icon-wrap stat-icon-purple">
              <i data-lucide="phone-call" style="width:24px;height:24px;"></i>
            </div>
            <div class="stat-content-box">
              <div class="stat-label-text">WhatsApp Terhubung</div>
              <div class="stat-value-text" id="statWaVal">+{{ $pWa }}</div>
              <div class="stat-sub-text">Kontak calon penyalur</div>
            </div>
          </div>
        </div>

        <div style="background:#FFFFFF;border:1px solid var(--border-color);border-radius:18px;padding:1.75rem;margin-bottom:1.5rem;">
          <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem;flex-wrap:wrap;gap:0.5rem;">
            <div style="display:flex;align-items:center;gap:0.6rem;">
              <div style="width:36px;height:36px;border-radius:10px;background:#E8F5E9;color:#2E7D32;display:flex;align-items:center;justify-content:center;">
                <i data-lucide="sprout" style="width:20px;height:20px;"></i>
              </div>
              <h3 style="font-family:var(--font-heading);font-size:1.15rem;font-weight:700;margin:0;">Bahan Organik yang Sedang Dicari</h3>
            </div>
            <button type="button" onclick="switchDashboardTab('needs')" class="btn-hero-secondary" style="background:#F1F5F9;color:var(--color-text);border-color:#CBD5E1;padding:0.45rem 0.95rem;font-size:0.8rem;">
              <i data-lucide="edit" style="width:14px;height:14px;"></i>
              <span>Perbarui Kebutuhan</span>
            </button>
          </div>

          <div style="background:#F8FAF8;border:1px solid #D1E7DD;border-radius:12px;padding:1.15rem;font-size:0.95rem;font-weight:600;color:#0F5132;line-height:1.6;" id="overviewNeedsDesc">
            {{ $pNeed }}
          </div>

          <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(260px, 1fr));gap:1rem;margin-top:1.25rem;">
            <div style="background:#FFFFFF;border:1px solid #E2E8F0;border-radius:12px;padding:1rem;">
              <strong style="display:block;font-size:0.75rem;color:var(--color-muted);text-transform:uppercase;margin-bottom:0.25rem;">Ketentuan Kualitas</strong>
              <span style="font-size:0.86rem;color:var(--color-text);" id="overviewTermsDesc">{{ $pTerms }}</span>
            </div>
            <div style="background:#FFFFFF;border:1px solid #E2E8F0;border-radius:12px;padding:1rem;">
              <strong style="display:block;font-size:0.75rem;color:var(--color-muted);text-transform:uppercase;margin-bottom:0.25rem;">Jam Operasional Penerimaan</strong>
              <span style="font-size:0.86rem;color:var(--color-text);" id="overviewHoursDesc">{{ $pHours }}</span>
            </div>
          </div>
        </div>
      </section>

      <!-- TAB 2: PROFIL & IDENTITAS USAHA -->
      <section id="tab-profile" class="dashboard-tab-pane">
        <div class="editor-panel-card" style="box-shadow:none;border:1px solid var(--border-color);">
          <div class="editor-panel-header">
            <div>
              <h3>Identitas Usaha & Kontak Resmi</h3>
              <p style="font-size:0.82rem;color:var(--color-muted);margin-top:2px;">Edit nama peternakan/usaha, penanggung jawab, lokasi, dan kontak WhatsApp.</p>
            </div>
          </div>

          <form onsubmit="handleSaveProfile(event)">
            <div class="editor-form-body">
              <div class="editor-section-block">
                <div class="form-grid-2">
                  <div class="form-group-custom">
                    <label class="form-label-custom" for="editName">Nama Usaha / Peternakan</label>
                    <input type="text" id="editName" class="form-input-custom" style="padding-left:1rem;" value="{{ $pName }}" placeholder="e.g. Peternakan Pak Doni" oninput="updateLivePreview()" required>
                  </div>

                  <div class="form-group-custom">
                    <label class="form-label-custom" for="editOwner">Nama Pemilik / Pengelola</label>
                    <input type="text" id="editOwner" class="form-input-custom" style="padding-left:1rem;" value="{{ $pOwner }}" placeholder="e.g. Pak Doni Prasetyo" oninput="updateLivePreview()" required>
                  </div>
                </div>

                <div class="form-grid-2">
                  @php
                    $standardCats = ['Peternakan', 'Pertanian', 'Pengolahan Kompos', 'Biokonversi Maggot (BSF)', 'Pemanfaat Organik'];
                    $isCustomCat = !in_array($pCat, $standardCats);
                  @endphp
                  <div class="form-group-custom">
                    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:0.45rem;">
                      <label class="form-label-custom" for="editCategoryPreset" style="margin-bottom:0;">Kategori Mitra</label>
                      <span style="font-size:0.75rem;color:var(--color-primary-dark);font-weight:600;">Bisa pilih atau ketik sendiri</span>
                    </div>
                    <select id="editCategoryPreset" class="form-input-custom" style="padding-left:1rem;" onchange="handleCategoryPresetChange()">
                      <option value="Peternakan" {{ (!$isCustomCat && $pCat === 'Peternakan') ? 'selected' : '' }}>Peternakan</option>
                      <option value="Pertanian" {{ (!$isCustomCat && $pCat === 'Pertanian') ? 'selected' : '' }}>Pertanian</option>
                      <option value="Pengolahan Kompos" {{ (!$isCustomCat && $pCat === 'Pengolahan Kompos') ? 'selected' : '' }}>Pengolahan Kompos</option>
                      <option value="Biokonversi Maggot (BSF)" {{ (!$isCustomCat && $pCat === 'Biokonversi Maggot (BSF)') ? 'selected' : '' }}>Biokonversi Maggot (BSF)</option>
                      <option value="Pemanfaat Organik" {{ (!$isCustomCat && $pCat === 'Pemanfaat Organik') ? 'selected' : '' }}>Pemanfaat Organik</option>
                      <option value="custom" {{ $isCustomCat ? 'selected' : '' }}>✏️ Ketik Kategori Lainnya (Bebas)...</option>
                    </select>

                    <div id="customCategoryWrap" style="margin-top:0.6rem;{{ $isCustomCat ? '' : 'display:none;' }}">
                      <div class="form-input-wrap">
                        <i data-lucide="edit-3" class="form-input-icon" style="width:16px;height:16px;"></i>
                        <input type="text" id="editCategoryCustom" class="form-input-custom" value="{{ $isCustomCat ? $pCat : '' }}" placeholder="Ketik kategori usaha Anda (contoh: Budidaya Jamur, Eco-Enzyme, dll)" oninput="updateLivePreview()">
                      </div>
                      <small style="color:var(--color-muted);font-size:0.75rem;margin-top:0.25rem;display:block;">Kategori yang Anda ketik akan langsung tampil di kartu profil publik.</small>
                    </div>
                  </div>

                  <div class="form-group-custom">
                    <label class="form-label-custom" for="editLoc">Wilayah Singkat (Tampil di Kartu)</label>
                    <input type="text" id="editLoc" class="form-input-custom" style="padding-left:1rem;" value="{{ $pLoc }}" placeholder="e.g. Pakem, Sleman" oninput="updateLivePreview()" required>
                  </div>
                </div>

                <div class="form-group-custom">
                  <label class="form-label-custom" for="editFullLoc">Alamat Lengkap Operasional</label>
                  <textarea id="editFullLoc" class="form-textarea-custom" placeholder="Alamat lengkap peternakan/usaha..." oninput="updateLivePreview()">{{ $pFullLoc }}</textarea>
                </div>

                <div class="form-group-custom">
                  <label class="form-label-custom" for="editWa">Nomor WhatsApp Resmi (Awali 62)</label>
                  <div class="form-input-wrap">
                    <i data-lucide="phone" class="form-input-icon" style="width:16px;height:16px;"></i>
                    <input type="text" id="editWa" class="form-input-custom" value="{{ $pWa }}" placeholder="e.g. 6283193738711" oninput="updateLivePreview()" required>
                  </div>
                </div>

                <div class="form-group-custom">
                  <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:0.45rem;">
                    <label class="form-label-custom" style="margin-bottom:0;">Foto Profil Usaha</label>
                    <span style="font-size:0.78rem;color:var(--color-muted);">Bisa dari file Laptop atau Kamera/Galeri HP</span>
                  </div>

                  <div style="background:#F4F8F4;border:1.5px dashed #A7CCA5;border-radius:14px;padding:0.95rem 1.25rem;margin-bottom:1rem;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:0.75rem;">
                    <div style="display:flex;align-items:center;gap:0.75rem;">
                      <div style="width:42px;height:42px;border-radius:10px;background:#E2EFE0;color:var(--color-primary);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <i data-lucide="camera" style="width:22px;height:22px;"></i>
                      </div>
                      <div>
                        <div style="font-family:var(--font-heading);font-weight:700;font-size:0.92rem;color:var(--color-text);">Unggah / Ganti Foto Sendiri</div>
                        <div style="font-size:0.78rem;color:var(--color-muted);">Pilih file foto dari laptop atau gunakan kamera/galeri HP</div>
                      </div>
                    </div>

                    <div style="display:flex;align-items:center;gap:0.5rem;flex-wrap:wrap;">
                      <input type="file" id="deviceFileInput" accept="image/*" style="display:none;" onchange="handleDeviceImageUpload(event)">
                      <button type="button" class="btn-partner-profile" onclick="document.getElementById('deviceFileInput').click()" style="width:auto;padding:0.55rem 1.15rem;background:#FFFFFF;border-color:var(--color-primary);color:var(--color-primary);font-size:0.85rem;display:inline-flex;align-items:center;gap:0.45rem;">
                        <i data-lucide="upload" style="width:15px;height:15px;"></i>
                        <span>Pilih Foto dari Perangkat</span>
                      </button>

                      <button type="button" id="btnRemoveCustomPhoto" onclick="deleteCustomImage(event)" style="display:{{ $isCustomImg ? 'inline-flex' : 'none' }};width:auto;padding:0.55rem 0.95rem;background:#FEF2F2;border:1px solid #FECACA;color:#DC2626;border-radius:10px;font-size:0.85rem;font-weight:600;cursor:pointer;align-items:center;gap:0.4rem;transition:all 0.2s ease;" title="Hapus foto unggahan kustom">
                        <i data-lucide="trash-2" style="width:15px;height:15px;"></i>
                        <span>Hapus Foto</span>
                      </button>
                    </div>
                  </div>

                  <div style="font-size:0.8rem;font-weight:600;color:var(--color-muted);margin-bottom:0.45rem;">Atau pilih dari koleksi foto preset:</div>
                  <div class="image-selector-row" id="imagePresetContainer">
                    <span id="customImageSlot" style="display:{{ $isCustomImg ? 'inline-flex' : 'none' }};">
                      @if($isCustomImg)
                        <div class="custom-thumb-wrapper">
                          <button type="button" class="image-thumb-btn active" data-img="{{ $rawImg }}" onclick="selectPresetImage(this)" title="Foto dari Perangkat Anda">
                            <img src="{{ $pImg }}" alt="Foto Anda">
                          </button>
                          <button type="button" class="btn-delete-custom-img" onclick="deleteCustomImage(event)" title="Hapus foto ini" aria-label="Hapus foto">
                            <i data-lucide="x" style="width:12px;height:12px;"></i>
                          </button>
                        </div>
                      @endif
                    </span>
                    <button type="button" class="image-thumb-btn {{ (!$isCustomImg && $rawImg === 'assets/images/partner_doni.jpg') ? 'active' : '' }}" data-img="assets/images/partner_doni.jpg" onclick="selectPresetImage(this)" title="Peternakan Kambing / Domba">
                      <img src="{{ asset('assets/images/partner_doni.jpg') }}" alt="Peternakan Doni">
                    </button>
                    <button type="button" class="image-thumb-btn {{ (!$isCustomImg && $rawImg === 'assets/images/partner_budi.jpg') ? 'active' : '' }}" data-img="assets/images/partner_budi.jpg" onclick="selectPresetImage(this)" title="Peternakan Sapi">
                      <img src="{{ asset('assets/images/partner_budi.jpg') }}" alt="Peternakan Sapi">
                    </button>
                    <button type="button" class="image-thumb-btn {{ (!$isCustomImg && $rawImg === 'assets/images/partner_adam.jpg') ? 'active' : '' }}" data-img="assets/images/partner_adam.jpg" onclick="selectPresetImage(this)" title="Peternakan Unggas / Ayam">
                      <img src="{{ asset('assets/images/partner_adam.jpg') }}" alt="Peternakan Ayam">
                    </button>
                    <button type="button" class="image-thumb-btn {{ (!$isCustomImg && $rawImg === 'assets/images/partner_haris.jpg') ? 'active' : '' }}" data-img="assets/images/partner_haris.jpg" onclick="selectPresetImage(this)" title="Biokonversi Maggot BSF">
                      <img src="{{ asset('assets/images/partner_haris.jpg') }}" alt="Maggot BSF">
                    </button>
                    <button type="button" class="image-thumb-btn {{ (!$isCustomImg && $rawImg === 'assets/images/about_organic.jpg') ? 'active' : '' }}" data-img="assets/images/about_organic.jpg" onclick="selectPresetImage(this)" title="Pertanian Hortikultura">
                      <img src="{{ asset('assets/images/about_organic.jpg') }}" alt="Pertanian">
                    </button>
                  </div>
                  <input type="hidden" id="editImg" value="{{ $rawImg }}">
                </div>

              </div>

              <div style="margin-top:1.5rem;display:flex;justify-content:flex-end;">
                <button type="submit" class="btn-save-mitra" id="btnSubmitSaveProfile">
                  <i data-lucide="save" style="width:18px;height:18px;"></i>
                  <span>Simpan Perubahan</span>
                </button>
              </div>
            </div>
          </form>
        </div>
      </section>

      <!-- TAB 3: KEBUTUHAN BAHAN ORGANIK -->
      <section id="tab-needs" class="dashboard-tab-pane">
        <div class="editor-panel-card" style="box-shadow:none;border:1px solid var(--border-color);">
          <div class="editor-panel-header">
            <div>
              <h3>Kebutuhan Pasokan & Batas Kapasitas</h3>
              <p style="font-size:0.82rem;color:var(--color-muted);margin-top:2px;">Tentukan jenis bahan organik yang dicari, estimasi volume, dan syarat penerimaan.</p>
            </div>
          </div>

          <form onsubmit="handleSaveProfile(event)">
            <div class="editor-form-body">
              <div class="editor-section-block">
                <div class="form-group-custom">
                  <label class="form-label-custom" for="editNeed">Jenis Bahan Organik yang Sangat Dibutuhkan</label>
                  <textarea id="editNeed" class="form-textarea-custom" placeholder="e.g. Ampas tahu segar..." oninput="updateLivePreview()" required>{{ $pNeed }}</textarea>
                </div>

                <div class="form-grid-2">
                  <div class="form-group-custom">
                    <label class="form-label-custom" for="editAmount">Estimasi Kebutuhan / Kapasitas Penampungan</label>
                    <input type="text" id="editAmount" class="form-input-custom" style="padding-left:1rem;" value="{{ $pAmount }}" placeholder="e.g. 150 – 500 Kg / minggu" oninput="updateLivePreview()" required>
                  </div>

                  <div class="form-group-custom">
                    <label class="form-label-custom" for="editHours">Jam Operasional Penerimaan / Penjemputan</label>
                    <input type="text" id="editHours" class="form-input-custom" style="padding-left:1rem;" value="{{ $pHours }}" placeholder="e.g. Senin - Sabtu, 07:00 - 16:00 WIB" oninput="updateLivePreview()">
                  </div>
                </div>

                <div class="form-group-custom">
                  <label class="form-label-custom" for="editTerms">Ketentuan & Syarat Kualitas Penerimaan</label>
                  <textarea id="editTerms" class="form-textarea-custom" placeholder="e.g. Ampas tahu maksimal 24 jam..." oninput="updateLivePreview()" required>{{ $pTerms }}</textarea>
                </div>

                <div class="form-group-custom">
                  <label class="form-label-custom" for="editDesc">Deskripsi Singkat Profil & Pemanfaatan Bahan</label>
                  <textarea id="editDesc" class="form-textarea-custom" placeholder="Jelaskan secara singkat pemanfaatan..." oninput="updateLivePreview()" style="min-height:95px;">{{ $pDesc }}</textarea>
                </div>

                <div class="form-group-custom">
                  <label class="form-label-custom">Status Penerimaan Pasokan</label>
                  <div class="status-toggle-container">
                    <button type="button" id="statusBtnOpen" class="status-pill-btn {{ $pStatus === 'active' ? 'active-open' : '' }}" onclick="setStatusToggle('active')">
                      <span class="status-dot"></span>
                      <span>Buka (Menerima Pasokan Baru)</span>
                    </button>
                    <button type="button" id="statusBtnClosed" class="status-pill-btn {{ $pStatus === 'closed' ? 'active-closed' : '' }}" onclick="setStatusToggle('closed')">
                      <span class="status-dot" style="background:#EF4444;"></span>
                      <span>Tutup Sementara (Kapasitas Penuh)</span>
                    </button>
                  </div>
                  <input type="hidden" id="editStatus" value="{{ $pStatus }}">
                </div>
              </div>

              <div style="margin-top:1.5rem;display:flex;justify-content:flex-end;">
                <button type="submit" class="btn-save-mitra" id="btnSubmitSaveNeeds">
                  <i data-lucide="save" style="width:18px;height:18px;"></i>
                  <span>Simpan Perubahan</span>
                </button>
              </div>
            </div>
          </form>
        </div>
      </section>

      <!-- TAB 4: PRATINJAU PUBLIK (LIVE PREVIEW) -->
      <section id="tab-preview" class="dashboard-tab-pane">
        <div style="background:#FFFFFF;border:1px solid var(--border-color);border-radius:18px;padding:2rem;">
          <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;flex-wrap:wrap;gap:0.75rem;">
            <div>
              <h3 style="font-family:var(--font-heading);font-size:1.25rem;font-weight:800;color:var(--color-text);margin:0;">Kartu Profil Publik Anda</h3>
              <p style="font-size:0.84rem;color:var(--color-muted);margin:0.2rem 0 0;">Pratinjau langsung bagaimana kartu usaha Anda tampil di direktori SisaBerkah dan Beranda.</p>
            </div>
            <a href="{{ route('mitra.index') }}#{{ $pId }}" id="previewPublicLink" target="_blank" class="btn-hero-primary" style="font-size:0.84rem;padding:0.6rem 1.15rem;">
              <i data-lucide="external-link" style="width:15px;height:15px;"></i>
              <span>Buka di Halaman Publik</span>
            </a>
          </div>

          <div style="max-width:440px;margin:0 auto;">
            <div class="home-partner-card" style="box-shadow:0 8px 30px rgba(0,0,0,0.08);">
              <div class="home-partner-img">
                <img id="previewImg" src="{{ $pImg }}" alt="{{ $pName }}" loading="lazy" onerror="this.src='{{ asset('assets/images/partner_doni.jpg') }}'">
                <span class="home-partner-badge" id="previewBadge">{{ $pCat }}</span>
              </div>
              <div class="home-partner-body">
                <h3 class="home-partner-title" id="previewTitle">{{ $pName }}</h3>
                <div class="home-partner-meta">
                  <i data-lucide="store" style="width:14px;height:14px;"></i>
                  <span id="previewOwner">{{ $pOwner }}</span>
                  <span>•</span>
                  <span id="previewLoc">{{ $pLoc }}</span>
                </div>
                <p style="font-size:0.85rem;color:var(--color-charcoal-light);line-height:1.5;margin-bottom:1rem;" id="previewDesc">
                  {{ $pDesc }}
                </p>
                <div class="home-partner-need-box">
                  <span class="home-partner-need-label">KEBUTUHAN BAHAN:</span>
                  <p class="home-partner-need-desc" id="previewNeed">
                    {{ $pNeed }}
                  </p>
                </div>
                <div style="font-size:0.82rem;color:var(--color-muted);margin-bottom:0.75rem;">
                  <strong>Estimasi Kebutuhan:</strong> <span id="previewAmount">{{ $pAmount }}</span>
                </div>
                <div style="background:rgba(217,119,6,0.08);border-left:3px solid #D97706;padding:0.5rem 0.75rem;font-size:0.78rem;color:#92400E;border-radius:4px;margin-bottom:1.25rem;">
                  <strong>Ketentuan:</strong> <span id="previewTerms">{{ $pTerms }}</span>
                </div>
                <div class="home-partner-actions">
                  <button type="button" class="btn-partner-profile" onclick="openTestModal()">Lihat Profil</button>
                  <a href="https://wa.me/{{ $pWa }}" target="_blank" rel="noopener noreferrer" class="btn-partner-whatsapp" id="previewWaBtn">
                    <i data-lucide="message-circle" style="width:15px;height:15px;"></i>
                    <span>Uji WhatsApp</span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- TAB 5: LOG PASOKAN MASUK -->
      <section id="tab-incoming" class="dashboard-tab-pane">
        <div style="background:#FFFFFF;border:1px solid var(--border-color);border-radius:18px;padding:2rem;">
          <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;flex-wrap:wrap;gap:1rem;">
            <div>
              <div style="display:flex;align-items:center;gap:0.6rem;margin-bottom:0.25rem;">
                <h3 style="font-family:var(--font-heading);font-size:1.25rem;font-weight:800;color:var(--color-text);margin:0;">Catatan Pasokan & Calon Penyalur Masuk</h3>
                <span id="pasokanCountBadge" style="background:#ECFDF5;color:#059669;font-size:0.75rem;font-weight:700;padding:0.2rem 0.65rem;border-radius:9999px;border:1px solid #A7F3D0;">
                  {{ count($pasokanList ?? []) }} Catatan
                </span>
              </div>
              <p style="font-size:0.84rem;color:var(--color-muted);margin:0;">Kelola daftar penyalur bahan organik, riwayat pasokan, dan kontak WhatsApp langsung.</p>
            </div>
            <button type="button" class="btn-hero-primary" onclick="openPasokanModal()" style="font-size:0.84rem;padding:0.65rem 1.25rem;display:inline-flex;align-items:center;gap:0.4rem;">
              <i data-lucide="plus" style="width:16px;height:16px;"></i>
              <span>Catat Pasokan Baru</span>
            </button>
          </div>

          <!-- Filter & Search Bar -->
          <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:0.75rem;margin-bottom:1.25rem;padding:0.75rem 1rem;background:#F8FAFC;border-radius:12px;border:1px solid #E2E8F0;">
            <div style="display:flex;align-items:center;gap:0.4rem;flex-wrap:wrap;" id="pasokanFilterPills">
              <button type="button" class="pasokan-filter-pill active" onclick="filterPasokanByStatus('all', this)">Semua</button>
              <button type="button" class="pasokan-filter-pill" onclick="filterPasokanByStatus('Rutin Mingguan', this)">Rutin Mingguan</button>
              <button type="button" class="pasokan-filter-pill" onclick="filterPasokanByStatus('Jadwal Penjemputan', this)">Jadwal Penjemputan</button>
              <button type="button" class="pasokan-filter-pill" onclick="filterPasokanByStatus('Selesai Diterima', this)">Selesai Diterima</button>
              <button type="button" class="pasokan-filter-pill" onclick="filterPasokanByStatus('Menunggu Konfirmasi', this)">Menunggu Konfirmasi</button>
            </div>
            <div style="position:relative;min-width:240px;flex:1;max-width:320px;">
              <i data-lucide="search" style="position:absolute;left:0.75rem;top:50%;transform:translateY(-50%);width:15px;height:15px;color:#94A3B8;"></i>
              <input type="text" id="pasokanSearchInput" oninput="handlePasokanSearch(this.value)" placeholder="Cari nama penyalur / bahan..." style="width:100%;padding:0.5rem 0.75rem 0.5rem 2.25rem;font-size:0.84rem;border:1px solid #CBD5E1;border-radius:8px;outline:none;background:#FFFFFF;transition:border-color 0.2s;" onfocus="this.style.borderColor='var(--color-primary)'" onblur="this.style.borderColor='#CBD5E1'">
            </div>
          </div>

          <div style="overflow-x:auto;">
            <table style="width:100%;border-collapse:collapse;text-align:left;font-size:0.88rem;" id="pasokanTable">
              <thead>
                <tr style="border-bottom:2px solid #E2E8F0;color:var(--color-muted);font-size:0.78rem;text-transform:uppercase;letter-spacing:0.5px;">
                  <th style="padding:0.85rem 1rem;">Tanggal</th>
                  <th style="padding:0.85rem 1rem;">Nama Penyalur / Usaha</th>
                  <th style="padding:0.85rem 1rem;">Jenis Bahan Organik</th>
                  <th style="padding:0.85rem 1rem;">Volume / Jumlah</th>
                  <th style="padding:0.85rem 1rem;">Status</th>
                  <th style="padding:0.85rem 1rem;text-align:center;">Aksi</th>
                </tr>
              </thead>
              <tbody id="pasokanTableBody" style="color:var(--color-text);">
                @forelse($pasokanList ?? [] as $item)
                  @php
                    $statusStyles = [
                      'Rutin Mingguan' => 'background:#E0F2FE;color:#0369A1;border:1px solid #BAE6FD;',
                      'Jadwal Penjemputan' => 'background:#FEF3C7;color:#B45309;border:1px solid #FDE68A;',
                      'Selesai Diterima' => 'background:#DCFCE7;color:#15803D;border:1px solid #BBF7D0;',
                      'Menunggu Konfirmasi' => 'background:#F3E8FF;color:#7E22CE;border:1px solid #E9D5FF;',
                      'Dibatalkan' => 'background:#FEE2E2;color:#B91C1C;border:1px solid #FECACA;',
                    ];
                    $badgeStyle = $statusStyles[$item->status] ?? 'background:#F1F5F9;color:#475569;border:1px solid #E2E8F0;';
                    $waClean = preg_replace('/[^0-9]/', '', $item->kontak_wa ?? '');
                    if ($waClean && str_starts_with($waClean, '0')) {
                      $waClean = '62' . substr($waClean, 1);
                    }
                  @endphp
                  <tr id="pasokanRow-{{ $item->id }}" data-status="{{ $item->status }}" data-search="{{ strtolower($item->nama_penyalur . ' ' . $item->jenis_bahan . ' ' . $item->volume) }}" style="border-bottom:1px solid #F1F5F1;transition:background 0.2s;" onmouseenter="this.style.background='#F8FAFC'" onmouseleave="this.style.background='transparent'">
                    <td style="padding:1rem;color:var(--color-muted);white-space:nowrap;">
                      {{ $item->tanggal ? $item->tanggal->translatedFormat('d M Y') : '-' }}
                    </td>
                    <td style="padding:1rem;">
                      <div style="font-weight:700;color:var(--color-text);">{{ $item->nama_penyalur }}</div>
                      @if($item->catatan)
                        <div style="font-size:0.75rem;color:var(--color-muted);margin-top:0.2rem;max-width:280px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;" title="{{ $item->catatan }}">
                          {{ $item->catatan }}
                        </div>
                      @endif
                    </td>
                    <td style="padding:1rem;color:var(--color-text);">{{ $item->jenis_bahan }}</td>
                    <td style="padding:1rem;font-weight:600;white-space:nowrap;">{{ $item->volume }}</td>
                    <td style="padding:1rem;white-space:nowrap;">
                      <span style="{{ $badgeStyle }}padding:0.25rem 0.7rem;border-radius:9999px;font-size:0.75rem;font-weight:700;display:inline-block;">
                        {{ $item->status }}
                      </span>
                    </td>
                    <td style="padding:1rem;text-align:center;white-space:nowrap;">
                      <div style="display:inline-flex;align-items:center;gap:0.4rem;">
                        @if($waClean)
                          <a href="https://wa.me/{{ $waClean }}?text={{ urlencode('Halo ' . $item->nama_penyalur . ', kami dari ' . ($profile->name ?? 'Mitra SisaBerkah') . ' ingin menindaklanjuti pasokan ' . $item->jenis_bahan . '.') }}" target="_blank" rel="noopener noreferrer" title="Hubungi Penyalur via WhatsApp" style="width:32px;height:32px;border-radius:8px;background:#ECFDF5;color:#059669;display:inline-flex;align-items:center;justify-content:center;text-decoration:none;transition:all 0.2s;" onmouseenter="this.style.background='#D1FAE5'" onmouseleave="this.style.background='#ECFDF5'">
                            <i data-lucide="message-circle" style="width:16px;height:16px;"></i>
                          </a>
                        @endif
                        <button type="button" onclick="editPasokan({{ json_encode([
                          'id' => $item->id,
                          'tanggal' => $item->tanggal ? $item->tanggal->format('Y-m-d') : '',
                          'nama_penyalur' => $item->nama_penyalur,
                          'kontak_wa' => $item->kontak_wa ?? '',
                          'jenis_bahan' => $item->jenis_bahan,
                          'volume' => $item->volume,
                          'status' => $item->status,
                          'catatan' => $item->catatan ?? ''
                        ]) }})" title="Ubah Catatan Pasokan" style="width:32px;height:32px;border-radius:8px;background:#EEF2FF;color:#4F46E5;border:none;cursor:pointer;display:inline-flex;align-items:center;justify-content:center;transition:all 0.2s;" onmouseenter="this.style.background='#E0E7FF'" onmouseleave="this.style.background='#EEF2FF'">
                          <i data-lucide="edit-3" style="width:15px;height:15px;"></i>
                        </button>
                        <button type="button" onclick="confirmDeletePasokan({{ $item->id }}, '{{ addslashes($item->nama_penyalur) }}')" title="Hapus Catatan" style="width:32px;height:32px;border-radius:8px;background:#FEF2F2;color:#DC2626;border:none;cursor:pointer;display:inline-flex;align-items:center;justify-content:center;transition:all 0.2s;" onmouseenter="this.style.background='#FEE2E2'" onmouseleave="this.style.background='#FEF2F2'">
                          <i data-lucide="trash-2" style="width:15px;height:15px;"></i>
                        </button>
                      </div>
                    </td>
                  </tr>
                @empty
                  <tr id="pasokanEmptyRow">
                    <td colspan="6" style="padding:3rem 1rem;text-align:center;color:var(--color-muted);">
                      <div style="width:56px;height:56px;border-radius:50%;background:#F1F5F9;color:#94A3B8;display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;">
                        <i data-lucide="inbox" style="width:28px;height:28px;"></i>
                      </div>
                      <div style="font-weight:700;font-size:1rem;color:var(--color-text);margin-bottom:0.35rem;">Belum Ada Catatan Pasokan</div>
                      <p style="font-size:0.85rem;max-width:400px;margin:0 auto 1.25rem;">Klik tombol "Catat Pasokan Baru" di atas untuk menambahkan riwayat atau calon penyalur limbah makanan Anda.</p>
                      <button type="button" class="btn-hero-primary" onclick="openPasokanModal()" style="font-size:0.82rem;padding:0.55rem 1.15rem;display:inline-flex;align-items:center;gap:0.4rem;">
                        <i data-lucide="plus" style="width:15px;height:15px;"></i>
                        <span>Catat Pasokan Pertama</span>
                      </button>
                    </td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </section>

      <!-- TAB 6: PENGATURAN AKUN & GANTI KATA SANDI -->
      <section id="tab-settings" class="dashboard-tab-pane">
        <div class="settings-grid">
          
          <div class="settings-card">
            <div class="settings-card-header">
              <div style="width:40px;height:40px;border-radius:12px;background:#FEE2E2;color:#DC2626;display:flex;align-items:center;justify-content:center;">
                <i data-lucide="shield-check" style="width:22px;height:22px;"></i>
              </div>
              <div>
                <h3>Keamanan Akun: Ganti Kata Sandi</h3>
                <p>Perbarui kata sandi akun mitra Anda untuk menjaga keamanan akses dashboard.</p>
              </div>
            </div>

            <div id="settingsAlertBox" class="settings-alert">
              <i data-lucide="alert-triangle" id="settingsAlertIcon" style="width:18px;height:18px;flex-shrink:0;"></i>
              <div id="settingsAlertMsg">Pesan peringatan</div>
            </div>

            <form id="formChangePassword" onsubmit="handleChangePassword(event)">
              <div class="form-group-custom">
                <label class="form-label-custom" for="oldPasswordInput">Kata Sandi Saat Ini (Lama)</label>
                <div class="pwd-input-wrap">
                  <input type="password" id="oldPasswordInput" class="form-input-custom" style="padding-left:1rem;padding-right:2.5rem;" placeholder="Masukkan kata sandi lama Anda..." required autocomplete="current-password">
                  <button type="button" class="pwd-toggle-btn" onclick="togglePasswordVisibility('oldPasswordInput', this)" aria-label="Lihat kata sandi">
                    <i data-lucide="eye" style="width:17px;height:17px;"></i>
                  </button>
                </div>
              </div>

              <div class="form-group-custom">
                <label class="form-label-custom" for="newPasswordInput">Kata Sandi Baru (Minimal 4 karakter)</label>
                <div class="pwd-input-wrap">
                  <input type="password" id="newPasswordInput" class="form-input-custom" style="padding-left:1rem;padding-right:2.5rem;" placeholder="Minimal 4 karakter..." required autocomplete="new-password">
                  <button type="button" class="pwd-toggle-btn" onclick="togglePasswordVisibility('newPasswordInput', this)" aria-label="Lihat kata sandi">
                    <i data-lucide="eye" style="width:17px;height:17px;"></i>
                  </button>
                </div>
              </div>

              <div class="form-group-custom">
                <label class="form-label-custom" for="confirmPasswordInput">Konfirmasi Kata Sandi Baru</label>
                <div class="pwd-input-wrap">
                  <input type="password" id="confirmPasswordInput" class="form-input-custom" style="padding-left:1rem;padding-right:2.5rem;" placeholder="Ketik ulang kata sandi baru..." required autocomplete="new-password">
                  <button type="button" class="pwd-toggle-btn" onclick="togglePasswordVisibility('confirmPasswordInput', this)" aria-label="Lihat kata sandi">
                    <i data-lucide="eye" style="width:17px;height:17px;"></i>
                  </button>
                </div>
              </div>

              <button type="submit" class="btn-save-mitra" id="btnSubmitPassword" style="width:100%;justify-content:center;margin-top:1.25rem;">
                <i data-lucide="key" style="width:16px;height:16px;"></i>
                <span>Perbarui Kata Sandi</span>
              </button>
            </form>
          </div>

          <div class="settings-card">
            <div class="settings-card-header">
              <div style="width:40px;height:40px;border-radius:12px;background:#E0F2FE;color:#0284C7;display:flex;align-items:center;justify-content:center;">
                <i data-lucide="user-check" style="width:22px;height:22px;"></i>
              </div>
              <div>
                <h3>Informasi Akun Mitra</h3>
                <p>Status registrasi dan kepemilikan akun Anda.</p>
              </div>
            </div>

            <div style="margin-bottom:1.5rem;">
              <div class="account-meta-row">
                <span class="account-meta-label">Nama Usaha:</span>
                <span class="account-meta-val" id="metaAccountName">{{ $pName }}</span>
              </div>
              <div class="account-meta-row">
                <span class="account-meta-label">Email Terdaftar:</span>
                <span class="account-meta-val" id="metaAccountEmail">{{ $pEmail }}</span>
              </div>
              <div class="account-meta-row">
                <span class="account-meta-label">ID Akun Mitra:</span>
                <span class="account-meta-val" id="metaAccountId">{{ $pId }}</span>
              </div>
              <div class="account-meta-row" style="border-bottom:none;">
                <span class="account-meta-label">Hak Akses:</span>
                <span class="account-meta-val" style="color:#059669;">Admin Mitra Penerima</span>
              </div>
            </div>

            <a href="{{ route('logout') }}" class="sidebar-footer-link logout" style="background:#FEF2F2;border-color:#FCA5A5;justify-content:center;padding:0.75rem;text-decoration:none;">
              <i data-lucide="log-out" style="width:16px;height:16px;"></i>
              <span>Keluar dari Dashboard (Logout)</span>
            </a>
          </div>

          <!-- Danger Zone Card: Hapus Akun Mitra -->
          <div class="settings-card" style="border-color:#FECACA;background:#FFFBFB;grid-column:1 / -1;margin-top:0.5rem;">
            <div class="settings-card-header">
              <div style="width:40px;height:40px;border-radius:12px;background:#FEE2E2;color:#DC2626;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <i data-lucide="alert-octagon" style="width:22px;height:22px;"></i>
              </div>
              <div>
                <div style="display:inline-flex;align-items:center;gap:0.35rem;background:rgba(239,68,68,0.12);color:#DC2626;padding:0.18rem 0.6rem;border-radius:9999px;font-size:0.7rem;font-weight:700;text-transform:uppercase;margin-bottom:0.25rem;">
                  Zona Berbahaya
                </div>
                <h3 style="color:#991B1B;margin:0 0 2px;">Hapus Akun & Profil Usaha Mitra</h3>
                <p style="color:#7F1D1D;margin:0;">Tindakan permanen untuk menghapus akun login dan profil mitra dari platform.</p>
              </div>
            </div>

            <p style="font-size:0.86rem;color:#7F1D1D;line-height:1.55;margin:0 0 1.25rem;">
              Menghapus akun ini akan menghapus data profil usaha <strong>{{ $pName }}</strong> secara permanen dari katalog publik SisaBerkah, beserta seluruh catatan pasokan masuk yang telah terdaftar. Tindakan ini tidak dapat dibatalkan.
            </p>

            <button type="button" onclick="openDeleteMitraModal()" style="display:inline-flex;align-items:center;justify-content:center;gap:0.5rem;padding:0.75rem 1.35rem;background:#DC2626;color:#FFFFFF;border:none;border-radius:10px;font-weight:700;font-size:0.88rem;cursor:pointer;box-shadow:0 3px 10px rgba(220,38,38,0.25);transition:background 0.2s ease;">
              <i data-lucide="trash-2" style="width:16px;height:16px;"></i>
              <span>Hapus Akun & Profil Usaha Mitra</span>
            </button>
          </div>

        </div>
      </section>

    </div>
  </div>

  <!-- Modal Konfirmasi Hapus Akun Mitra -->
  <div class="modal-overlay" id="deleteMitraModal" onclick="closeDeleteMitraModal()">
    <div class="modal-card" style="max-width:480px;text-align:center;padding:2rem;" onclick="event.stopPropagation()">
      <div style="width:56px;height:56px;border-radius:50%;background:#FEE2E2;color:#DC2626;display:flex;align-items:center;justify-content:center;margin:0 auto 1.25rem;">
        <i data-lucide="alert-triangle" style="width:28px;height:28px;"></i>
      </div>

      <h3 style="font-family:var(--font-heading);font-size:1.25rem;font-weight:800;color:#0F172A;margin:0 0 0.5rem;">
        Konfirmasi Hapus Akun Mitra
      </h3>
      <p style="font-size:0.88rem;color:#64748B;margin:0 0 1.5rem;line-height:1.5;">
        Apakah Anda yakin ingin menghapus akun mitra <strong>{{ $pEmail }}</strong> beserta data profil usaha <strong>{{ $pName }}</strong>? Masukkan kata sandi akun Anda untuk konfirmasi:
      </p>

      <div id="deleteMitraModalAlert" style="display:none;padding:0.75rem 1rem;border-radius:10px;background:#FEF2F2;color:#991B1B;font-size:0.82rem;font-weight:600;margin-bottom:1.2rem;text-align:left;"></div>

      <form onsubmit="handleConfirmDeleteMitra(event)">
        <div class="form-group-custom" style="text-align:left;margin-bottom:1.5rem;">
          <label class="form-label-custom" for="deleteMitraConfirmPassword">Kata Sandi Akun Mitra</label>
          <div class="pwd-input-wrap">
            <input type="password" id="deleteMitraConfirmPassword" class="form-input-custom" style="padding-left:1rem;padding-right:2.5rem;" required placeholder="Masukkan kata sandi akun Anda...">
            <button type="button" class="pwd-toggle-btn" onclick="togglePasswordVisibility('deleteMitraConfirmPassword', this)" aria-label="Lihat kata sandi">
              <i data-lucide="eye" style="width:17px;height:17px;"></i>
            </button>
          </div>
        </div>

        <div style="display:flex;gap:0.75rem;">
          <button type="button" class="btn-cancel-modal" onclick="closeDeleteMitraModal()" style="flex:1;">
            Batal
          </button>
          <button type="submit" id="btnConfirmDeleteMitra" style="flex:1.2;padding:0.8rem 1rem;border-radius:10px;border:none;background:#DC2626;color:#FFFFFF;font-weight:700;font-size:0.88rem;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:0.4rem;">
            <i data-lucide="trash-2" style="width:16px;height:16px;"></i>
            <span>Ya, Hapus Permanen</span>
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- Test Preview Modal for WhatsApp -->
  <div class="modal-overlay" id="testPreviewModal" onclick="closeTestModal()">
    <div class="modal-card" style="max-width:540px;" onclick="event.stopPropagation()">
      <button type="button" class="modal-close-btn" onclick="closeTestModal()" aria-label="Tutup modal">
        &times;
      </button>
      <div id="testModalBody"></div>
    </div>
  </div>

  <!-- Modal Tambah & Ubah Pasokan Masuk -->
  <div class="modal-overlay" id="pasokanModal" onclick="closePasokanModal()">
    <div class="modal-card" style="max-width:560px;" onclick="event.stopPropagation()">
      <button type="button" class="modal-close-btn" onclick="closePasokanModal()" aria-label="Tutup modal">
        &times;
      </button>
      
      <div style="display:flex;align-items:center;gap:0.75rem;margin-bottom:1.25rem;">
        <div style="width:42px;height:42px;border-radius:12px;background:#ECFDF5;color:#059669;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
          <i data-lucide="truck" style="width:22px;height:22px;"></i>
        </div>
        <div>
          <h3 id="pasokanModalTitle" style="font-family:var(--font-heading);font-size:1.25rem;font-weight:800;color:var(--color-text);margin:0;">Catat Pasokan Baru</h3>
          <p id="pasokanModalSubtitle" style="font-size:0.82rem;color:var(--color-muted);margin:0.15rem 0 0;">Simpan data penyalur atau jadwal penerimaan bahan organik.</p>
        </div>
      </div>

      <div id="pasokanModalAlert" style="display:none;padding:0.75rem 1rem;border-radius:10px;font-size:0.84rem;margin-bottom:1rem;"></div>

      <form id="formPasokan" onsubmit="handlePasokanSubmit(event)">
        <input type="hidden" id="pasokanId" value="">
        
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:0.9rem;margin-bottom:0.9rem;">
          <div class="form-group-custom" style="margin-bottom:0;">
            <label class="form-label-custom" for="pasokanTanggal">Tanggal Pasokan / Kontak *</label>
            <input type="date" id="pasokanTanggal" class="form-input-custom" required value="{{ date('Y-m-d') }}">
          </div>
          <div class="form-group-custom" style="margin-bottom:0;">
            <label class="form-label-custom" for="pasokanStatus">Status Alur Pasokan *</label>
            <select id="pasokanStatus" class="form-input-custom" required style="cursor:pointer;">
              <option value="Rutin Mingguan">Rutin Mingguan</option>
              <option value="Jadwal Penjemputan">Jadwal Penjemputan</option>
              <option value="Selesai Diterima">Selesai Diterima</option>
              <option value="Menunggu Konfirmasi" selected>Menunggu Konfirmasi</option>
              <option value="Dibatalkan">Dibatalkan</option>
            </select>
          </div>
        </div>

        <div class="form-group-custom" style="margin-bottom:0.9rem;">
          <label class="form-label-custom" for="pasokanNamaPenyalur">Nama Penyalur / Usaha / Mitra *</label>
          <input type="text" id="pasokanNamaPenyalur" class="form-input-custom" placeholder="Contoh: Pabrik Tahu Sumber Rejeki (Pak RT)" required>
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:0.9rem;margin-bottom:0.9rem;">
          <div class="form-group-custom" style="margin-bottom:0;">
            <label class="form-label-custom" for="pasokanKontakWa">No. WhatsApp Penyalur</label>
            <input type="text" id="pasokanKontakWa" class="form-input-custom" placeholder="Contoh: 081234567890">
          </div>
          <div class="form-group-custom" style="margin-bottom:0;">
            <label class="form-label-custom" for="pasokanVolume">Volume / Jumlah *</label>
            <input type="text" id="pasokanVolume" class="form-input-custom" placeholder="Contoh: 250 Kg / minggu" required>
          </div>
        </div>

        <div class="form-group-custom" style="margin-bottom:0.9rem;">
          <label class="form-label-custom" for="pasokanJenisBahan">Jenis Bahan Organik *</label>
          <input type="text" id="pasokanJenisBahan" class="form-input-custom" placeholder="Contoh: Ampas tahu putih segar, ampas kelapa, sayur katering" required>
        </div>

        <div class="form-group-custom" style="margin-bottom:1.25rem;">
          <label class="form-label-custom" for="pasokanCatatan">Catatan / Detail Tambahan (Opsional)</label>
          <textarea id="pasokanCatatan" class="form-input-custom" rows="2" placeholder="Contoh: Waktu penjemputan jam 16.00 WIB, lokasi jemput di belakang dapur..."></textarea>
        </div>

        <div style="display:flex;align-items:center;justify-content:flex-end;gap:0.75rem;padding-top:0.75rem;border-top:1px solid #E2E8F0;">
          <button type="button" onclick="closePasokanModal()" style="padding:0.65rem 1.25rem;border-radius:10px;background:#F1F5F9;color:#475569;border:none;font-weight:600;font-size:0.86rem;cursor:pointer;">
            Batal
          </button>
          <button type="submit" id="btnSubmitPasokan" class="btn-hero-primary" style="padding:0.65rem 1.4rem;font-size:0.86rem;display:inline-flex;align-items:center;gap:0.4rem;">
            <i data-lucide="save" style="width:16px;height:16px;"></i>
            <span id="btnSubmitPasokanText">Simpan Catatan</span>
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal Konfirmasi Hapus Pasokan -->
  <div class="modal-overlay" id="deletePasokanModal" onclick="closeDeletePasokanModal()">
    <div class="modal-card" style="max-width:440px;text-align:center;" onclick="event.stopPropagation()">
      <div style="width:52px;height:52px;border-radius:50%;background:#FEE2E2;color:#DC2626;display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;">
        <i data-lucide="alert-triangle" style="width:26px;height:26px;"></i>
      </div>
      <h3 style="font-family:var(--font-heading);font-size:1.2rem;font-weight:800;color:var(--color-text);margin:0 0 0.5rem;">Hapus Catatan Pasokan?</h3>
      <p style="font-size:0.86rem;color:var(--color-muted);margin:0 0 1.25rem;line-height:1.5;">
        Apakah Anda yakin ingin menghapus catatan pasokan dari <strong id="deletePasokanNama" style="color:var(--color-text);">-</strong>? Tindakan ini tidak dapat dibatalkan.
      </p>
      <input type="hidden" id="deletePasokanId" value="">
      <div style="display:flex;align-items:center;justify-content:center;gap:0.75rem;">
        <button type="button" onclick="closeDeletePasokanModal()" style="padding:0.65rem 1.25rem;border-radius:10px;background:#F1F5F9;color:#475569;border:none;font-weight:600;font-size:0.86rem;cursor:pointer;">
          Batal
        </button>
        <button type="button" id="btnConfirmDeletePasokan" onclick="executeDeletePasokan()" style="padding:0.65rem 1.35rem;border-radius:10px;background:#DC2626;color:#FFFFFF;border:none;font-weight:700;font-size:0.86rem;cursor:pointer;display:inline-flex;align-items:center;gap:0.4rem;">
          <i data-lucide="trash-2" style="width:15px;height:15px;"></i>
          <span>Ya, Hapus</span>
        </button>
      </div>
    </div>
  </div>

  <!-- Save Toast Notification -->
  <div class="save-toast-notification" id="saveToast">
    <i data-lucide="check-circle" style="width:20px;height:20px;color:#10B981;"></i>
    <div>
      <div style="font-weight:700;">Perubahan Berhasil Disimpan!</div>
      <div style="font-size:0.8rem;opacity:0.9;">Data profil Anda telah berhasil diperbarui di sistem publik.</div>
    </div>
  </div>

  <script>
    const activePartnerId = '{{ $pId }}';

    document.addEventListener('DOMContentLoaded', () => {
      if (window.lucide) {
        lucide.createIcons();
      }
    });

    function switchDashboardTab(tabId) {
      document.querySelectorAll('.sidebar-nav-btn').forEach(btn => {
        btn.classList.toggle('active', btn.dataset.tab === tabId);
      });

      document.querySelectorAll('.dashboard-tab-pane').forEach(pane => {
        pane.classList.toggle('active', pane.id === `tab-${tabId}`);
      });

      const headerTitle = document.getElementById('mainHeaderTitle');
      const headerSub = document.getElementById('mainHeaderSubtitle');
      
      const tabTitles = {
        overview: { title: 'Ikhtisar Dashboard', sub: 'Ringkasan operasional dan ketersediaan pasokan bahan organik Anda.' },
        profile: { title: 'Profil & Identitas Usaha', sub: 'Perbarui nama usaha, pengelola, alamat, dan foto profil Anda.' },
        needs: { title: 'Kebutuhan Bahan Organik', sub: 'Atur jenis bahan yang dicari, kapasitas mingguan, dan ketentuan penerimaan.' },
        preview: { title: 'Pratinjau Publik (Live)', sub: 'Lihat tampilan kartu publik dan uji coba respon tombol WhatsApp.' },
        incoming: { title: 'Log Pasokan Masuk', sub: 'Riwayat kontak penyalur dan pencatatan penawaran bahan sisa organik.' },
        settings: { title: 'Pengaturan Akun & Keamanan', sub: 'Kelola kata sandi akun dan informasi profil Anda.' }
      };

      if (tabTitles[tabId]) {
        headerTitle.textContent = tabTitles[tabId].title;
        headerSub.textContent = tabTitles[tabId].sub;
      }

      closeMobileSidebar();
      lucide.createIcons();
    }

    function toggleMobileSidebar() {
      const sidebar = document.getElementById('dashboardSidebar');
      const backdrop = document.getElementById('sidebarBackdrop');
      sidebar.classList.toggle('open');
      backdrop.classList.toggle('active');
    }

    function closeMobileSidebar() {
      const sidebar = document.getElementById('dashboardSidebar');
      const backdrop = document.getElementById('sidebarBackdrop');
      if (sidebar) sidebar.classList.remove('open');
      if (backdrop) backdrop.classList.remove('active');
    }

    function selectPresetImage(btn) {
      document.querySelectorAll('#imagePresetContainer .image-thumb-btn').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      const imgVal = btn.dataset.img;
      document.getElementById('editImg').value = imgVal;
      document.getElementById('sidebarAvatarImg').src = imgVal;
      updateLivePreview();
    }

    function deleteCustomImage(event) {
      if (event) {
        event.preventDefault();
        event.stopPropagation();
      }

      const customSlot = document.getElementById('customImageSlot');
      if (customSlot) {
        customSlot.style.display = 'none';
        customSlot.innerHTML = '';
      }

      const fileInput = document.getElementById('deviceFileInput');
      if (fileInput) fileInput.value = '';

      const btnRemove = document.getElementById('btnRemoveCustomPhoto');
      if (btnRemove) btnRemove.style.display = 'none';

      // Aktifkan kembali preset default (partner_doni)
      const defaultPreset = document.querySelector('#imagePresetContainer .image-thumb-btn[data-img="assets/images/partner_doni.jpg"]') 
        || document.querySelector('#imagePresetContainer .image-thumb-btn');

      if (defaultPreset) {
        selectPresetImage(defaultPreset);
      } else {
        const fallback = 'assets/images/partner_doni.jpg';
        document.getElementById('editImg').value = fallback;
        const avatar = document.getElementById('sidebarAvatarImg');
        if (avatar) avatar.src = "{{ asset('assets/images/partner_doni.jpg') }}";
        updateLivePreview();
      }

      showNotification('Foto kustom berhasil dihapus. Jangan lupa klik "Simpan Perubahan".', false);
    }

    function handleDeviceImageUpload(event) {
      const file = event.target.files && event.target.files[0];
      if (!file) return;

      const reader = new FileReader();
      reader.onload = function(e) {
        const tempImg = new Image();
        tempImg.onload = function() {
          const canvas = document.createElement('canvas');
          let width = tempImg.width;
          let height = tempImg.height;
          const maxDim = 800;
          if (width > maxDim || height > maxDim) {
            if (width > height) {
              height = Math.round((height * maxDim) / width);
              width = maxDim;
            } else {
              width = Math.round((width * maxDim) / height);
              height = maxDim;
            }
          }
          canvas.width = width;
          canvas.height = height;
          const ctx = canvas.getContext('2d');
          ctx.drawImage(tempImg, 0, 0, width, height);

          const compressedDataUrl = canvas.toDataURL('image/jpeg', 0.8);

          document.getElementById('editImg').value = compressedDataUrl;
          document.getElementById('sidebarAvatarImg').src = compressedDataUrl;

          const customSlot = document.getElementById('customImageSlot');
          customSlot.innerHTML = `
            <div class="custom-thumb-wrapper">
              <button type="button" class="image-thumb-btn active" data-img="${compressedDataUrl}" onclick="selectPresetImage(this)" title="Foto dari Perangkat Anda">
                <img src="${compressedDataUrl}" alt="Foto Anda">
              </button>
              <button type="button" class="btn-delete-custom-img" onclick="deleteCustomImage(event)" title="Hapus foto unggahan ini" aria-label="Hapus foto">
                <i data-lucide="x" style="width:12px;height:12px;"></i>
              </button>
            </div>
          `;
          customSlot.style.display = 'inline-flex';

          const btnRemove = document.getElementById('btnRemoveCustomPhoto');
          if (btnRemove) btnRemove.style.display = 'inline-flex';

          document.querySelectorAll('#imagePresetContainer .image-thumb-btn').forEach(btn => {
            if (btn.dataset.img !== compressedDataUrl) btn.classList.remove('active');
          });

          if (window.lucide) lucide.createIcons();
          updateLivePreview();
        };
        tempImg.src = e.target.result;
      };
      reader.readAsDataURL(file);
    }

    function setStatusToggle(status) {
      document.getElementById('editStatus').value = status;
      const openBtn = document.getElementById('statusBtnOpen');
      const closedBtn = document.getElementById('statusBtnClosed');
      const statVal = document.getElementById('statStatusVal');

      if (status === 'active') {
        openBtn.className = 'status-pill-btn active-open';
        closedBtn.className = 'status-pill-btn';
        if (statVal) {
          statVal.textContent = 'Buka / Aktif';
          statVal.style.color = '#2E7D32';
        }
      } else {
        openBtn.className = 'status-pill-btn';
        closedBtn.className = 'status-pill-btn active-closed';
        if (statVal) {
          statVal.textContent = 'Tutup Sementara';
          statVal.style.color = '#DC2626';
        }
      }
      updateLivePreview();
    }

    function getSelectedCategory() {
      const presetSelect = document.getElementById('editCategoryPreset');
      if (!presetSelect) return 'Peternakan';
      if (presetSelect.value === 'custom') {
        const customInput = document.getElementById('editCategoryCustom');
        return (customInput && customInput.value.trim()) ? customInput.value.trim() : 'Lainnya';
      }
      return presetSelect.value;
    }

    function handleCategoryPresetChange() {
      const presetSelect = document.getElementById('editCategoryPreset');
      const customWrap = document.getElementById('customCategoryWrap');
      const customInput = document.getElementById('editCategoryCustom');
      
      if (presetSelect.value === 'custom') {
        customWrap.style.display = 'block';
        if (customInput) {
          customInput.focus();
        }
      } else {
        customWrap.style.display = 'none';
      }
      if (window.lucide) {
        lucide.createIcons();
      }
      updateLivePreview();
    }

    function updateLivePreview() {
      const name = document.getElementById('editName').value || 'Nama Mitra';
      const owner = document.getElementById('editOwner').value || 'Nama Pemilik';
      const cat = getSelectedCategory();
      const loc = document.getElementById('editLoc').value || 'Lokasi';
      const img = document.getElementById('editImg').value || 'assets/images/partner_doni.jpg';
      const need = document.getElementById('editNeed').value || 'Belum ada kebutuhan bahan';
      const amount = document.getElementById('editAmount').value || '-';
      const terms = document.getElementById('editTerms').value || '-';
      const desc = document.getElementById('editDesc').value || '';
      const wa = document.getElementById('editWa').value.replace(/[^0-9]/g, '');

      document.getElementById('previewTitle').textContent = name;
      document.getElementById('previewOwner').textContent = owner;
      document.getElementById('previewLoc').textContent = loc.split(',')[0];
      document.getElementById('previewBadge').textContent = cat;
      document.getElementById('previewImg').src = img;
      document.getElementById('previewNeed').textContent = need;
      document.getElementById('previewAmount').textContent = amount;
      document.getElementById('previewTerms').textContent = terms;
      document.getElementById('previewDesc').textContent = desc;

      const waMsg = encodeURIComponent(
        `Halo ${owner} (${name}), salam kenal.\n\n` +
        `Saya mendapatkan informasi kontak Bapak/Ibu melalui platform SisaBerkah terkait kebutuhan bahan organik berupa "${need}".\n\n` +
        `Kebetulan kami memiliki pasokan bahan organik terpilah dan segar yang siap disalurkan secara rutin untuk mendukung ${name}.\n\n` +
        `Apakah saat ini masih menerima pasokan baru? Jika berkenan, kami ingin mendiskusikan perkiraan volume, jadwal penjemputan, serta ketentuan kualitas bahannya. Terima kasih banyak atas waktu dan perhatiannya.`
      );
      const waUrl = `https://wa.me/${wa}?text=${waMsg}`;
      document.getElementById('previewWaBtn').href = waUrl;
    }

    async function handleSaveProfile(e) {
      if (e) e.preventDefault();
      
      const submitBtns = [
        document.getElementById('btnSubmitSaveProfile'),
        document.getElementById('btnSubmitSaveNeeds')
      ];

      submitBtns.forEach(btn => {
        if (btn) {
          btn.disabled = true;
          btn.innerHTML = `<span>Menyimpan Perubahan...</span>`;
        }
      });

      const updatedData = {
        id: activePartnerId,
        name: document.getElementById('editName').value.trim(),
        owner: document.getElementById('editOwner').value.trim(),
        category: getSelectedCategory(),
        location: document.getElementById('editLoc').value.trim(),
        full_location: document.getElementById('editFullLoc').value.trim(),
        whatsapp: document.getElementById('editWa').value.replace(/[^0-9]/g, ''),
        image_url: document.getElementById('editImg').value,
        materials_needed: document.getElementById('editNeed').value.trim(),
        estimated_amount: document.getElementById('editAmount').value.trim(),
        terms_conditions: document.getElementById('editTerms').value.trim(),
        description: document.getElementById('editDesc').value.trim(),
        operating_hours: document.getElementById('editHours').value.trim(),
        status: document.getElementById('editStatus').value
      };

      try {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const response = await fetch("{{ route('mitra.update') }}", {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
          },
          body: JSON.stringify(updatedData)
        });

        const data = await response.json();

        submitBtns.forEach(btn => {
          if (btn) {
            btn.disabled = false;
            btn.innerHTML = `<i data-lucide="save" style="width:18px;height:18px;"></i><span>Simpan Perubahan</span>`;
          }
        });

        if (response.ok && data.success) {
          // Update overview labels
          document.getElementById('navPartnerName').textContent = updatedData.name;
          document.getElementById('sidebarPartnerName').textContent = updatedData.name;
          document.getElementById('sidebarOwnerName').textContent = updatedData.owner;
          document.getElementById('overviewWelcomeName').textContent = `Halo, ${updatedData.name}!`;
          document.getElementById('statCategoryVal').textContent = updatedData.category;
          document.getElementById('statCapacityVal').textContent = updatedData.estimated_amount;
          document.getElementById('statWaVal').textContent = '+' + updatedData.whatsapp;
          document.getElementById('overviewNeedsDesc').textContent = updatedData.materials_needed;
          document.getElementById('overviewTermsDesc').textContent = updatedData.terms_conditions;
          document.getElementById('overviewHoursDesc').textContent = updatedData.operating_hours;
          document.getElementById('metaAccountName').textContent = updatedData.name;

          // Show Toast
          const toast = document.getElementById('saveToast');
          toast.classList.add('show');
          setTimeout(() => toast.classList.remove('show'), 3500);
        } else {
          alert(data.message || 'Gagal menyimpan profil.');
        }
      } catch (err) {
        submitBtns.forEach(btn => {
          if (btn) {
            btn.disabled = false;
            btn.innerHTML = `<i data-lucide="save" style="width:18px;height:18px;"></i><span>Simpan Perubahan</span>`;
          }
        });
        alert('Terjadi kesalahan koneksi saat menyimpan.');
      }
      lucide.createIcons();
    }

    async function handleChangePassword(e) {
      e.preventDefault();
      const oldPwd = document.getElementById('oldPasswordInput').value.trim();
      const newPwd = document.getElementById('newPasswordInput').value.trim();
      const confPwd = document.getElementById('confirmPasswordInput').value.trim();
      const btn = document.getElementById('btnSubmitPassword');

      if (!oldPwd || !newPwd || !confPwd) {
        showSettingsAlert('Semua kolom kata sandi wajib diisi.', true);
        return;
      }

      if (newPwd.length < 4) {
        showSettingsAlert('Kata sandi baru minimal 4 karakter.', true);
        document.getElementById('newPasswordInput').focus();
        return;
      }

      if (newPwd !== confPwd) {
        showSettingsAlert('Konfirmasi kata sandi baru tidak cocok. Periksa kembali.', true);
        document.getElementById('confirmPasswordInput').focus();
        return;
      }

      btn.disabled = true;
      btn.innerHTML = `<span>Memproses Perubahan Sandi...</span>`;

      try {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const response = await fetch("{{ route('mitra.updatePassword') }}", {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
          },
          body: JSON.stringify({
            old_password: oldPwd,
            new_password: newPwd
          })
        });

        const data = await response.json();
        btn.disabled = false;
        btn.innerHTML = `<i data-lucide="key" style="width:16px;height:16px;"></i><span>Perbarui Kata Sandi</span>`;
        lucide.createIcons();

        if (response.ok && data.success) {
          showSettingsAlert(data.message || 'Kata sandi berhasil diperbarui!', false);
          document.getElementById('formChangePassword').reset();
        } else {
          showSettingsAlert(data.message || 'Gagal mengubah kata sandi.', true);
        }
      } catch (err) {
        btn.disabled = false;
        btn.innerHTML = `<i data-lucide="key" style="width:16px;height:16px;"></i><span>Perbarui Kata Sandi</span>`;
        lucide.createIcons();
        showSettingsAlert('Terjadi kesalahan jaringan.', true);
      }
    }

    function showSettingsAlert(msg, isError) {
      const alertBox = document.getElementById('settingsAlertBox');
      const alertMsg = document.getElementById('settingsAlertMsg');
      const alertIcon = document.getElementById('settingsAlertIcon');

      alertMsg.textContent = msg;
      alertBox.className = isError ? 'settings-alert error' : 'settings-alert success';
      alertBox.style.display = 'flex';
      alertIcon.setAttribute('data-lucide', isError ? 'alert-triangle' : 'check-circle');
      lucide.createIcons();
    }

    function togglePasswordVisibility(inputId, btn) {
      const input = document.getElementById(inputId);
      if (input.type === 'password') {
        input.type = 'text';
        btn.innerHTML = `<i data-lucide="eye-off" style="width:17px;height:17px;"></i>`;
      } else {
        input.type = 'password';
        btn.innerHTML = `<i data-lucide="eye" style="width:17px;height:17px;"></i>`;
      }
      lucide.createIcons();
    }

    function openTestModal() {
      const name = document.getElementById('editName').value.trim() || 'Nama Mitra';
      const owner = document.getElementById('editOwner').value.trim() || 'Nama Pemilik';
      const cat = getSelectedCategory() || 'Peternakan';
      const loc = document.getElementById('editFullLoc').value.trim() || document.getElementById('editLoc').value.trim() || 'Indonesia';
      const img = document.getElementById('editImg').value || 'assets/images/partner_doni.jpg';
      const need = document.getElementById('editNeed').value.trim() || 'Belum ada data kebutuhan bahan';
      const amount = document.getElementById('editAmount').value.trim() || '-';
      const terms = document.getElementById('editTerms').value.trim() || '-';
      const desc = document.getElementById('editDesc').value.trim() || 'Mitra penerima pasokan bahan organik terdaftar SisaBerkah.';
      const rawWa = (document.getElementById('editWa').value || '').replace(/[^0-9]/g, '');
      const wa = rawWa || '6283193738711';

      const waMsg = encodeURIComponent(
        `Halo ${owner} (${name}), salam kenal.\n\n` +
        `Saya mendapatkan informasi kontak Bapak/Ibu melalui platform SisaBerkah terkait kebutuhan bahan organik berupa "${need}".\n\n` +
        `Kebetulan kami memiliki pasokan bahan organik terpilah dan segar yang siap disalurkan secara rutin untuk mendukung ${name}.\n\n` +
        `Apakah saat ini masih menerima pasokan baru? Jika berkenan, kami ingin mendiskusikan perkiraan volume, jadwal penjemputan, serta ketentuan kualitas bahannya. Terima kasih banyak atas waktu dan perhatiannya.`
      );
      const waUrl = `https://wa.me/${wa}?text=${waMsg}`;

      const modalBody = document.getElementById('testModalBody');
      modalBody.innerHTML = `
        <div style="position:relative;height:220px;border-radius:16px;overflow:hidden;margin-bottom:1.35rem;">
          <img src="${img}" alt="${name}" style="width:100%;height:100%;object-fit:cover;" onerror="this.src='{{ asset('assets/images/partner_doni.jpg') }}'">
          <span class="home-partner-badge" style="position:absolute;top:14px;right:14px;">${cat}</span>
        </div>
        <h2 style="font-family:var(--font-heading);font-size:1.55rem;font-weight:800;color:var(--color-text);margin-bottom:0.35rem;line-height:1.2;">${name}</h2>
        <div style="font-size:0.86rem;color:var(--color-muted);margin-bottom:1rem;">
          Pemilik: <strong style="color:var(--color-text);">${owner}</strong> • Lokasi: <strong style="color:var(--color-text);">${loc}</strong>
        </div>
        <p style="font-size:0.92rem;color:var(--color-charcoal-light);line-height:1.6;margin-bottom:1.25rem;">${desc}</p>
        
        <div style="background:#EDF7EE;border:1px solid #C8E6C9;border-radius:12px;padding:1rem;margin-bottom:0.85rem;">
          <strong style="display:block;font-size:0.75rem;text-transform:uppercase;color:var(--color-primary-dark);letter-spacing:0.5px;margin-bottom:0.25rem;">Bahan yang Dibutuhkan:</strong>
          <span style="font-size:0.94rem;font-weight:700;color:var(--color-text);line-height:1.4;display:block;">${need}</span>
        </div>

        <div style="background:#F9F9FB;border:1px solid #E2E8F0;border-radius:10px;padding:0.85rem 1rem;margin-bottom:0.85rem;font-size:0.86rem;color:var(--color-text);">
          <strong style="color:var(--color-text);">Estimasi Kebutuhan:</strong> ${amount}
        </div>

        <div style="background:rgba(217,119,6,0.08);border-left:4px solid #D97706;border-radius:8px;padding:0.85rem 1rem;font-size:0.84rem;color:#92400E;line-height:1.5;margin-bottom:1.35rem;">
          <strong style="color:#78350F;">Ketentuan Penerimaan:</strong> ${terms}
        </div>

        <a href="${waUrl}" target="_blank" rel="noopener noreferrer" class="btn-partner-whatsapp" style="display:flex;padding:0.85rem;font-size:0.95rem;justify-content:center;align-items:center;gap:0.5rem;text-decoration:none;">
          <i data-lucide="message-circle" style="width:18px;height:18px;"></i>
          <span>Uji Kontak WhatsApp (+${wa})</span>
        </a>
      `;

      document.getElementById('testPreviewModal').classList.add('active');
      document.body.style.overflow = 'hidden';
      lucide.createIcons();
    }

    function closeTestModal() {
      const modal = document.getElementById('testPreviewModal');
      if (modal) modal.classList.remove('active');
      document.body.style.overflow = '';
    }

    function openDeleteMitraModal() {
      const modal = document.getElementById('deleteMitraModal');
      const pwdInput = document.getElementById('deleteMitraConfirmPassword');
      const alertBox = document.getElementById('deleteMitraModalAlert');
      if (pwdInput) pwdInput.value = '';
      if (alertBox) alertBox.style.display = 'none';
      if (modal) modal.classList.add('active');
      document.body.style.overflow = 'hidden';
      lucide.createIcons();
      setTimeout(() => { if (pwdInput) pwdInput.focus(); }, 100);
    }

    function closeDeleteMitraModal() {
      const modal = document.getElementById('deleteMitraModal');
      if (modal) modal.classList.remove('active');
      document.body.style.overflow = '';
    }

    async function handleConfirmDeleteMitra(e) {
      e.preventDefault();
      const btn = document.getElementById('btnConfirmDeleteMitra');
      const pwdInput = document.getElementById('deleteMitraConfirmPassword');
      const alertBox = document.getElementById('deleteMitraModalAlert');
      const password = pwdInput ? pwdInput.value.trim() : '';

      if (!password) {
        if (alertBox) {
          alertBox.textContent = 'Silakan ketikkan kata sandi akun mitra Anda.';
          alertBox.style.display = 'block';
        }
        return;
      }

      btn.disabled = true;
      btn.innerHTML = '<span>Menghapus Akun...</span>';
      if (alertBox) alertBox.style.display = 'none';

      try {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const res = await fetch("{{ route('mitra.delete') }}", {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
          },
          body: JSON.stringify({ password: password })
        });

        const data = await res.json();

        if (res.ok && data.success) {
          closeDeleteMitraModal();
          showNotification(data.message || 'Akun Mitra berhasil dihapus.', false);
          setTimeout(() => {
            window.location.href = data.redirect || "{{ route('login') }}";
          }, 1200);
        } else {
          if (alertBox) {
            alertBox.textContent = data.message || 'Gagal menghapus akun. Periksa kata sandi Anda.';
            alertBox.style.display = 'block';
          }
          btn.disabled = false;
          btn.innerHTML = '<i data-lucide="trash-2" style="width:16px;height:16px;"></i><span>Ya, Hapus Permanen</span>';
          lucide.createIcons();
        }
      } catch (err) {
        if (alertBox) {
          alertBox.textContent = 'Terjadi kesalahan jaringan atau server.';
          alertBox.style.display = 'block';
        }
        btn.disabled = false;
        btn.innerHTML = '<i data-lucide="trash-2" style="width:16px;height:16px;"></i><span>Ya, Hapus Permanen</span>';
        lucide.createIcons();
      }
    }

    // ==========================================
    // PASOKAN MASUK CRUD JAVASCRIPT HANDLERS
    // ==========================================
    let currentPasokanFilter = 'all';

    function escapeHtml(str) {
      if (!str) return '';
      return String(str)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');
    }

    function escapeJs(str) {
      if (!str) return '';
      return String(str).replace(/\\/g, '\\\\').replace(/'/g, "\\'").replace(/"/g, '\\"');
    }

    function getStatusBadgeHtml(status) {
      const statusStyles = {
        'Rutin Mingguan': 'background:#E0F2FE;color:#0369A1;border:1px solid #BAE6FD;',
        'Jadwal Penjemputan': 'background:#FEF3C7;color:#B45309;border:1px solid #FDE68A;',
        'Selesai Diterima': 'background:#DCFCE7;color:#15803D;border:1px solid #BBF7D0;',
        'Menunggu Konfirmasi': 'background:#F3E8FF;color:#7E22CE;border:1px solid #E9D5FF;',
        'Dibatalkan': 'background:#FEE2E2;color:#B91C1C;border:1px solid #FECACA;',
      };
      const style = statusStyles[status] || 'background:#F1F5F9;color:#475569;border:1px solid #E2E8F0;';
      return `<span style="${style}padding:0.25rem 0.7rem;border-radius:9999px;font-size:0.75rem;font-weight:700;display:inline-block;">${escapeHtml(status)}</span>`;
    }

    function renderPasokanRow(item) {
      const waClean = (item.kontak_wa || '').replace(/[^0-9]/g, '');
      const waFormatted = waClean.startsWith('0') ? '62' + waClean.substring(1) : waClean;
      const partnerName = '{{ addslashes($pName) }}';
      const waBtn = waFormatted ? `
        <a href="https://wa.me/${waFormatted}?text=${encodeURIComponent('Halo ' + item.nama_penyalur + ', kami dari ' + partnerName + ' ingin menindaklanjuti pasokan ' + item.jenis_bahan + '.')}" target="_blank" rel="noopener noreferrer" title="Hubungi Penyalur via WhatsApp" style="width:32px;height:32px;border-radius:8px;background:#ECFDF5;color:#059669;display:inline-flex;align-items:center;justify-content:center;text-decoration:none;transition:all 0.2s;" onmouseenter="this.style.background='#D1FAE5'" onmouseleave="this.style.background='#ECFDF5'">
          <i data-lucide="message-circle" style="width:16px;height:16px;"></i>
        </a>` : '';

      const itemJson = JSON.stringify(item).replace(/"/g, '&quot;');

      return `
        <tr id="pasokanRow-${item.id}" data-status="${escapeHtml(item.status)}" data-search="${escapeHtml((item.nama_penyalur + ' ' + item.jenis_bahan + ' ' + item.volume).toLowerCase())}" style="border-bottom:1px solid #F1F5F1;transition:background 0.2s;" onmouseenter="this.style.background='#F8FAFC'" onmouseleave="this.style.background='transparent'">
          <td style="padding:1rem;color:var(--color-muted);white-space:nowrap;">
            ${escapeHtml(item.tanggal_formatted || item.tanggal)}
          </td>
          <td style="padding:1rem;">
            <div style="font-weight:700;color:var(--color-text);">${escapeHtml(item.nama_penyalur)}</div>
            ${item.catatan ? `<div style="font-size:0.75rem;color:var(--color-muted);margin-top:0.2rem;max-width:280px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;" title="${escapeHtml(item.catatan)}">${escapeHtml(item.catatan)}</div>` : ''}
          </td>
          <td style="padding:1rem;color:var(--color-text);">${escapeHtml(item.jenis_bahan)}</td>
          <td style="padding:1rem;font-weight:600;white-space:nowrap;">${escapeHtml(item.volume)}</td>
          <td style="padding:1rem;white-space:nowrap;">
            ${getStatusBadgeHtml(item.status)}
          </td>
          <td style="padding:1rem;text-align:center;white-space:nowrap;">
            <div style="display:inline-flex;align-items:center;gap:0.4rem;">
              ${waBtn}
              <button type="button" onclick="editPasokan(${itemJson})" title="Ubah Catatan Pasokan" style="width:32px;height:32px;border-radius:8px;background:#EEF2FF;color:#4F46E5;border:none;cursor:pointer;display:inline-flex;align-items:center;justify-content:center;transition:all 0.2s;" onmouseenter="this.style.background='#E0E7FF'" onmouseleave="this.style.background='#EEF2FF'">
                <i data-lucide="edit-3" style="width:15px;height:15px;"></i>
              </button>
              <button type="button" onclick="confirmDeletePasokan(${item.id}, '${escapeJs(item.nama_penyalur)}')" title="Hapus Catatan" style="width:32px;height:32px;border-radius:8px;background:#FEF2F2;color:#DC2626;border:none;cursor:pointer;display:inline-flex;align-items:center;justify-content:center;transition:all 0.2s;" onmouseenter="this.style.background='#FEE2E2'" onmouseleave="this.style.background='#FEF2F2'">
                <i data-lucide="trash-2" style="width:15px;height:15px;"></i>
              </button>
            </div>
          </td>
        </tr>
      `;
    }

    function updatePasokanCount() {
      const rows = document.querySelectorAll('#pasokanTableBody tr[id^="pasokanRow-"]');
      const badge = document.getElementById('pasokanCountBadge');
      if (badge) {
        badge.textContent = `${rows.length} Catatan`;
      }
      const emptyRow = document.getElementById('pasokanEmptyRow');
      if (rows.length === 0) {
        if (!emptyRow) {
          const tbody = document.getElementById('pasokanTableBody');
          tbody.innerHTML = `
            <tr id="pasokanEmptyRow">
              <td colspan="6" style="padding:3rem 1rem;text-align:center;color:var(--color-muted);">
                <div style="width:56px;height:56px;border-radius:50%;background:#F1F5F9;color:#94A3B8;display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;">
                  <i data-lucide="inbox" style="width:28px;height:28px;"></i>
                </div>
                <div style="font-weight:700;font-size:1rem;color:var(--color-text);margin-bottom:0.35rem;">Belum Ada Catatan Pasokan</div>
                <p style="font-size:0.85rem;max-width:400px;margin:0 auto 1.25rem;">Klik tombol "Catat Pasokan Baru" di atas untuk menambahkan riwayat atau calon penyalur limbah makanan Anda.</p>
                <button type="button" class="btn-hero-primary" onclick="openPasokanModal()" style="font-size:0.82rem;padding:0.55rem 1.15rem;display:inline-flex;align-items:center;gap:0.4rem;">
                  <i data-lucide="plus" style="width:15px;height:15px;"></i>
                  <span>Catat Pasokan Pertama</span>
                </button>
              </td>
            </tr>
          `;
          if (window.lucide) lucide.createIcons();
        }
      } else if (emptyRow) {
        emptyRow.remove();
      }
    }

    function openPasokanModal(data = null) {
      const modal = document.getElementById('pasokanModal');
      const alertBox = document.getElementById('pasokanModalAlert');
      if (alertBox) alertBox.style.display = 'none';

      const titleEl = document.getElementById('pasokanModalTitle');
      const subEl = document.getElementById('pasokanModalSubtitle');
      const btnText = document.getElementById('btnSubmitPasokanText');

      if (data && data.id) {
        titleEl.textContent = 'Ubah Catatan Pasokan';
        subEl.textContent = 'Perbarui data penyalur atau alur pasokan bahan organik.';
        btnText.textContent = 'Perbarui Catatan';

        document.getElementById('pasokanId').value = data.id;
        document.getElementById('pasokanTanggal').value = data.tanggal || '';
        document.getElementById('pasokanStatus').value = data.status || 'Menunggu Konfirmasi';
        document.getElementById('pasokanNamaPenyalur').value = data.nama_penyalur || '';
        document.getElementById('pasokanKontakWa').value = data.kontak_wa || '';
        document.getElementById('pasokanVolume').value = data.volume || '';
        document.getElementById('pasokanJenisBahan').value = data.jenis_bahan || '';
        document.getElementById('pasokanCatatan').value = data.catatan || '';
      } else {
        titleEl.textContent = 'Catat Pasokan Baru';
        subEl.textContent = 'Simpan data penyalur atau jadwal penerimaan bahan organik.';
        btnText.textContent = 'Simpan Catatan';

        document.getElementById('formPasokan').reset();
        document.getElementById('pasokanId').value = '';
        document.getElementById('pasokanTanggal').value = new Date().toISOString().split('T')[0];
        document.getElementById('pasokanStatus').value = 'Menunggu Konfirmasi';
      }

      modal.classList.add('active');
      document.body.style.overflow = 'hidden';
      if (window.lucide) lucide.createIcons();
      setTimeout(() => document.getElementById('pasokanNamaPenyalur').focus(), 150);
    }

    function closePasokanModal() {
      const modal = document.getElementById('pasokanModal');
      if (modal) modal.classList.remove('active');
      document.body.style.overflow = '';
    }

    function editPasokan(data) {
      openPasokanModal(data);
    }

    async function handlePasokanSubmit(e) {
      e.preventDefault();
      const id = document.getElementById('pasokanId').value;
      const isEdit = Boolean(id);
      const url = isEdit ? `/kelola-mitra/pasokan/${id}/update` : `{{ route('mitra.pasokan.store') }}`;

      const payload = {
        tanggal: document.getElementById('pasokanTanggal').value,
        nama_penyalur: document.getElementById('pasokanNamaPenyalur').value.trim(),
        kontak_wa: document.getElementById('pasokanKontakWa').value.trim(),
        jenis_bahan: document.getElementById('pasokanJenisBahan').value.trim(),
        volume: document.getElementById('pasokanVolume').value.trim(),
        status: document.getElementById('pasokanStatus').value,
        catatan: document.getElementById('pasokanCatatan').value.trim(),
      };

      const btn = document.getElementById('btnSubmitPasokan');
      const btnText = document.getElementById('btnSubmitPasokanText');
      const origText = btnText.textContent;
      btn.disabled = true;
      btnText.textContent = 'Menyimpan...';

      const alertBox = document.getElementById('pasokanModalAlert');
      if (alertBox) alertBox.style.display = 'none';

      try {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const response = await fetch(url, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
          },
          body: JSON.stringify(payload)
        });

        const res = await response.json();
        btn.disabled = false;
        btnText.textContent = origText;

        if (response.ok && res.success) {
          const tbody = document.getElementById('pasokanTableBody');
          const emptyRow = document.getElementById('pasokanEmptyRow');
          if (emptyRow) emptyRow.remove();

          if (isEdit) {
            const existingRow = document.getElementById(`pasokanRow-${id}`);
            if (existingRow) {
              existingRow.outerHTML = renderPasokanRow(res.data);
            }
          } else {
            tbody.insertAdjacentHTML('afterbegin', renderPasokanRow(res.data));
          }

          updatePasokanCount();
          closePasokanModal();
          showSaveToast(res.message || 'Catatan pasokan berhasil disimpan!', 'Data telah berhasil disinkronkan.');
          if (window.lucide) lucide.createIcons();
        } else {
          if (alertBox) {
            alertBox.style.display = 'block';
            alertBox.style.background = '#FEE2E2';
            alertBox.style.color = '#B91C1C';
            alertBox.style.border = '1px solid #FCA5A5';
            alertBox.textContent = res.message || 'Gagal menyimpan catatan pasokan.';
          }
        }
      } catch (err) {
        btn.disabled = false;
        btnText.textContent = origText;
        if (alertBox) {
          alertBox.style.display = 'block';
          alertBox.style.background = '#FEE2E2';
          alertBox.style.color = '#B91C1C';
          alertBox.style.border = '1px solid #FCA5A5';
          alertBox.textContent = 'Terjadi kesalahan koneksi ke server.';
        }
      }
    }

    function confirmDeletePasokan(id, nama) {
      document.getElementById('deletePasokanId').value = id;
      document.getElementById('deletePasokanNama').textContent = nama;
      document.getElementById('deletePasokanModal').classList.add('active');
      document.body.style.overflow = 'hidden';
      if (window.lucide) lucide.createIcons();
    }

    function closeDeletePasokanModal() {
      const modal = document.getElementById('deletePasokanModal');
      if (modal) modal.classList.remove('active');
      document.body.style.overflow = '';
    }

    async function executeDeletePasokan() {
      const id = document.getElementById('deletePasokanId').value;
      if (!id) return;

      const btn = document.getElementById('btnConfirmDeletePasokan');
      btn.disabled = true;
      btn.innerHTML = `<span>Menghapus...</span>`;

      try {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const response = await fetch(`/kelola-mitra/pasokan/${id}/delete`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
          }
        });

        const res = await response.json();
        btn.disabled = false;
        btn.innerHTML = `<i data-lucide="trash-2" style="width:15px;height:15px;"></i><span>Ya, Hapus</span>`;

        if (response.ok && res.success) {
          const row = document.getElementById(`pasokanRow-${id}`);
          if (row) {
            row.style.transition = 'opacity 0.25s, transform 0.25s';
            row.style.opacity = '0';
            row.style.transform = 'translateX(10px)';
            setTimeout(() => {
              row.remove();
              updatePasokanCount();
            }, 250);
          }
          closeDeletePasokanModal();
          showSaveToast('Catatan Dihapus', res.message || 'Catatan pasokan berhasil dihapus.');
        } else {
          alert(res.message || 'Gagal menghapus catatan.');
        }
      } catch (err) {
        btn.disabled = false;
        btn.innerHTML = `<i data-lucide="trash-2" style="width:15px;height:15px;"></i><span>Ya, Hapus</span>`;
        alert('Terjadi kesalahan koneksi.');
      }
    }

    function filterPasokanByStatus(status, btn) {
      currentPasokanFilter = status;
      document.querySelectorAll('#pasokanFilterPills .pasokan-filter-pill').forEach(p => p.classList.remove('active'));
      if (btn) btn.classList.add('active');

      applyPasokanFilters();
    }

    function handlePasokanSearch(query) {
      applyPasokanFilters();
    }

    function applyPasokanFilters() {
      const search = (document.getElementById('pasokanSearchInput').value || '').toLowerCase().trim();
      const rows = document.querySelectorAll('#pasokanTableBody tr[id^="pasokanRow-"]');

      rows.forEach(row => {
        const rowStatus = row.getAttribute('data-status') || '';
        const rowSearch = row.getAttribute('data-search') || '';

        const matchesStatus = (currentPasokanFilter === 'all') || (rowStatus === currentPasokanFilter);
        const matchesSearch = !search || rowSearch.includes(search);

        if (matchesStatus && matchesSearch) {
          row.style.display = '';
        } else {
          row.style.display = 'none';
        }
      });
    }

    function showSaveToast(title = 'Perubahan Berhasil Disimpan!', msg = 'Data telah berhasil disimpan ke sistem.') {
      const toast = document.getElementById('saveToast');
      if (toast) {
        const titleEl = toast.querySelector('div > div:first-child');
        const msgEl = toast.querySelector('div > div:last-child');
        if (titleEl) titleEl.textContent = title;
        if (msgEl) msgEl.textContent = msg;
        toast.classList.add('show');
        setTimeout(() => toast.classList.remove('show'), 3500);
      }
    }

    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') {
        closeTestModal();
        closePasokanModal();
        closeDeletePasokanModal();
        closeDeleteMitraModal();
      }
    });

    if (window.lucide) {
      lucide.createIcons();
    }
  </script>
</body>
</html>
