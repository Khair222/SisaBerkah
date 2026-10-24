<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'SISABERKAH — Dari Sisa Menjadi Berkah | Pemanfaatan Limbah Organik')</title>
  <meta name="description" content="@yield('meta_description', 'Platform digital penghubung limbah organik dengan peternakan, pertanian, dan sentra kompos untuk masa depan berkelanjutan.')">
  
  <link rel="icon" type="image/png" href="{{ asset('assets/images/logo-icon.png') }}">
  <link rel="stylesheet" href="{{ asset('style.css') }}">
  <script src="{{ asset('assets/js/lucide.min.js') }}"></script>
  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>

  <style>
    .nav-user-badge {
      background: rgba(34, 197, 94, 0.12);
      color: #15803D;
      border: 1px solid rgba(34, 197, 94, 0.25);
      padding: 0.42rem 0.95rem;
      border-radius: 9999px;
      font-size: 0.85rem;
      font-weight: 700;
      display: inline-flex;
      align-items: center;
      gap: 0.4rem;
    }

    .nav-logout-btn {
      background: rgba(239, 68, 68, 0.1);
      color: #EF4444;
      border: 1px solid rgba(239, 68, 68, 0.25);
      padding: 0.42rem 0.85rem;
      border-radius: 9999px;
      font-size: 0.8rem;
      font-weight: 600;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 0.35rem;
      text-decoration: none;
      transition: all 0.2s ease;
    }

    .nav-logout-btn:hover {
      background: #EF4444;
      color: #FFFFFF;
    }
  </style>

  @yield('styles')
</head>

<body class="@yield('body_class', '')">
  @include('partials.preloader')

  <!-- ========== NAVBAR ========== -->
  <nav class="navbar" id="navbar">
    <div class="container">
      <a href="{{ route('home') }}" class="navbar-brand">
        <img src="{{ asset('assets/images/logo.png') }}" alt="SISABERKAH — Dari Sisa Menjadi Berkah" class="navbar-logo-img">
      </a>

      <div class="navbar-nav" id="navbarNav">
        <!-- Drawer Header for Mobile -->
        <div class="nav-drawer-header">
          <div class="nav-drawer-brand">
            <img src="{{ asset('assets/images/logo-icon.png') }}" alt="Logo" class="nav-drawer-icon" onerror="this.src='{{ asset('assets/images/logo.png') }}'">
            <span>Menu SisaBerkah</span>
          </div>
          <button type="button" class="nav-drawer-close-btn" onclick="closeMobileNav()" aria-label="Tutup Menu">
            &times;
          </button>
        </div>

        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a>
        <a href="{{ route('home') }}#tentang">Tentang</a>
        <a href="{{ route('home') }}#cara-kerja">Cara Kerja</a>
        <a href="{{ route('jenis-limbah') }}" class="{{ request()->routeIs('jenis-limbah') ? 'active' : '' }}">Jenis Limbah</a>
        <a href="{{ route('ai-scanner') }}" class="{{ request()->routeIs('ai-scanner') ? 'active' : '' }}">AI Scanner</a>
        <a href="{{ route('mitra.index') }}" class="{{ request()->routeIs('mitra.index') ? 'active' : '' }}">Profil Mitra</a>
        <a href="{{ route('home') }}#faq">FAQ</a>

        <div class="navbar-actions">
          @if(Auth::guard('mitra')->check())
            <a href="{{ route('mitra.dashboard') }}" class="nav-login-btn logged-in-mitra" style="background:#22C55E;color:#04140D;font-weight:700;display:inline-flex;align-items:center;gap:0.4rem;padding:0.45rem 1.05rem;border-radius:9999px;text-decoration:none;border:none;">
              <i data-lucide="layout-dashboard" style="width:15px;height:15px;"></i>
              <span>Dashboard Mitra</span>
            </a>
            <a href="{{ route('logout') }}" class="nav-logout-btn" title="Keluar">
              <i data-lucide="log-out" style="width:13px;height:13px;"></i>
              <span>Keluar</span>
            </a>
          @elseif(Auth::guard('web')->check())
            <a href="{{ route('user.profile') }}" class="nav-user-badge {{ request()->routeIs('user.profile') ? 'active' : '' }}" style="text-decoration:none;transition:all 0.2s ease;" title="Buka Profil Saya">
              <i data-lucide="user" style="width:14px;height:14px;"></i>
              <span>Profil Saya ({{ Auth::guard('web')->user()->name }})</span>
            </a>
            <a href="{{ route('logout') }}" class="nav-logout-btn" title="Keluar">
              <i data-lucide="log-out" style="width:13px;height:13px;"></i>
              <span>Keluar</span>
            </a>
          @else
            <a href="{{ route('login') }}" class="nav-login-btn" id="navPortalMitraBtn">
              <i data-lucide="log-in" style="width:14px;height:14px;"></i>
              <span>Masuk</span>
            </a>
          @endif
        </div>
      </div>

      <button type="button" class="menu-toggle" id="menuToggle" aria-label="Toggle navigation menu" onclick="toggleMobileNav(event)">
        <span></span>
        <span></span>
        <span></span>
      </button>
    </div>

    <!-- Mobile overlay inside navbar for unified stacking context -->
    <div class="mobile-overlay" id="mobileOverlay" onclick="closeMobileNav()"></div>
  </nav>

  <!-- Content -->
  @yield('content')

  <!-- ========== FOOTER ========== -->
  <footer class="footer">
    <div class="container">
      <div class="footer-grid">
        <div class="footer-brand">
          <a href="{{ route('home') }}" class="footer-logo-wrap">
            <img src="{{ asset('assets/images/logo.png') }}" alt="SISABERKAH — Dari Sisa Menjadi Berkah" class="footer-logo-img">
          </a>
          <p class="footer-brand-desc">
            Platform digital yang menghubungkan limbah organik dengan peluang pemanfaatan kembali.
          </p>
        </div>

        <div>
          <h4 class="footer-heading">Navigasi</h4>
          <div class="footer-links">
            <a href="{{ route('home') }}">Beranda</a>
            <a href="{{ route('ai-scanner') }}">AI Waste Scanner</a>
            <a href="{{ route('home') }}#tentang">Tentang Kami</a>
            <a href="{{ route('home') }}#cara-kerja">Cara Kerja</a>
            <a href="{{ route('home') }}#faq">Testimoni &amp; FAQ</a>
            <a href="{{ route('home') }}#kontak">Kontak</a>
          </div>
        </div>

        <div>
          <h4 class="footer-heading">Jenis Limbah</h4>
          <div class="footer-links">
            <a href="{{ route('jenis-limbah') }}">Sisa Sayuran</a>
            <a href="{{ route('jenis-limbah') }}">Sisa Makanan</a>
            <a href="{{ route('jenis-limbah') }}">Ampas Kopi</a>
            <a href="{{ route('jenis-limbah') }}">Limbah Pasar</a>
          </div>
        </div>

        <div>
          <h4 class="footer-heading">Ikuti Perkembangan</h4>
          <div class="footer-links">
            <a href="#">Informasi terbaru seputar SISABERKAH dan pemanfaatan limbah organik.</a>
            <a href="#">Kebijakan Privasi</a>
            <a href="#">Syarat &amp; Ketentuan</a>
          </div>
        </div>
      </div>

      <div class="footer-bottom">
        <span>&copy; {{ date('Y') }} SISABERKAH. Semua hak dilindungi.</span>
        <div class="footer-bottom-links">
          <a href="#">Kebijakan Privasi</a>
          <a href="#">Syarat &amp; Ketentuan</a>
        </div>
      </div>
    </div>
  </footer>

  <!-- ========== BERKAHBOT AI CHATBOT ========== -->
  @include('partials.berkahbot')

  <script>
    // Global mobile nav toggle and close functions
    window.closeMobileNav = function() {
      const menuToggle = document.getElementById('menuToggle');
      const navbarNav = document.getElementById('navbarNav');
      const mobileOverlay = document.getElementById('mobileOverlay');
      if (menuToggle) menuToggle.classList.remove('active');
      if (navbarNav) navbarNav.classList.remove('open');
      if (mobileOverlay) mobileOverlay.classList.remove('active');
      document.body.style.overflow = '';
    };

    window.toggleMobileNav = function(event) {
      if (event) {
        event.preventDefault();
        event.stopPropagation();
      }
      const menuToggle = document.getElementById('menuToggle');
      const navbarNav = document.getElementById('navbarNav');
      const mobileOverlay = document.getElementById('mobileOverlay');
      if (!menuToggle || !navbarNav) return;

      const isOpen = navbarNav.classList.toggle('open');
      menuToggle.classList.toggle('active', isOpen);
      if (mobileOverlay) mobileOverlay.classList.toggle('active', isOpen);
      document.body.style.overflow = isOpen ? 'hidden' : '';
    };

    document.addEventListener('DOMContentLoaded', () => {
      if (window.lucide && typeof window.lucide.createIcons === 'function') {
        lucide.createIcons();
      }

      // Automatically close drawer when clicking on navigation links
      const navbarNav = document.getElementById('navbarNav');
      if (navbarNav) {
        const links = navbarNav.querySelectorAll('a, button:not(.nav-drawer-close-btn)');
        links.forEach(link => {
          link.addEventListener('click', () => {
            setTimeout(window.closeMobileNav, 100);
          });
        });
      }

      // Close on Escape key
      document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
          window.closeMobileNav();
        }
      });
    });
  </script>

  @yield('scripts')
</body>
</html>
