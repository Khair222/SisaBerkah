@extends('layouts.app')

@section('title', 'SISABERKAH — Dari Sisa Menjadi Berkah | Pemanfaatan Limbah Organik')
@section('meta_description', 'Platform digital yang menghubungkan limbah organik dengan peluang pemanfaatan kembali untuk menciptakan lingkungan yang lebih bersih dan nilai ekonomi yang berkelanjutan.')

@section('content')
  <!-- ========== HERO SECTION ========== -->
  <section class="hero" id="beranda">
    <!-- Decorative Leaves -->
    <svg class="leaf-decor leaf-1" viewBox="0 0 120 160" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M60 0C60 0 100 40 100 100C100 130 80 160 60 160C40 160 20 130 20 100C20 40 60 0 60 0Z" fill="#79A96B"
        opacity="0.25" />
      <path d="M60 20V140" stroke="#245C43" stroke-width="1.5" opacity="0.2" />
      <path d="M60 50C75 60 85 75 88 95" stroke="#245C43" stroke-width="1" opacity="0.15" fill="none" />
      <path d="M60 70C45 80 35 95 32 110" stroke="#245C43" stroke-width="1" opacity="0.15" fill="none" />
    </svg>
    <svg class="leaf-decor leaf-2" viewBox="0 0 100 140" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M50 0C50 0 90 35 90 85C90 115 70 140 50 140C30 140 10 115 10 85C10 35 50 0 50 0Z" fill="#245C43"
        opacity="0.12" />
      <path d="M50 15V125" stroke="#245C43" stroke-width="1.2" opacity="0.15" />
    </svg>
    <svg class="leaf-decor leaf-3" viewBox="0 0 80 120" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M40 0C40 0 75 30 75 70C75 95 60 120 40 120C20 120 5 95 5 70C5 30 40 0 40 0Z" fill="#79A96B"
        opacity="0.2" />
      <path d="M40 10V110" stroke="#245C43" stroke-width="1" opacity="0.15" />
    </svg>
    <svg class="leaf-decor leaf-4" viewBox="0 0 90 130" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M45 0C45 0 85 32 85 78C85 105 65 130 45 130C25 130 5 105 5 78C5 32 45 0 45 0Z" fill="#245C43"
        opacity="0.08" />
      <path d="M45 12V118" stroke="#245C43" stroke-width="1" opacity="0.1" />
    </svg>
    <svg class="leaf-decor leaf-5" viewBox="0 0 70 100" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M35 0C35 0 65 25 65 58C65 80 52 100 35 100C18 100 5 80 5 58C5 25 35 0 35 0Z" fill="#79A96B"
        opacity="0.18" />
    </svg>
    <svg class="leaf-decor leaf-6" viewBox="0 0 60 90" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M30 0C30 0 55 22 55 52C55 72 45 90 30 90C15 90 5 72 5 52C5 22 30 0 30 0Z" fill="#245C43" opacity="0.1" />
    </svg>

    <div class="container">
      <div class="hero-content fade-in">
        <span class="hero-label">Platform Ekonomi Sirkular</span>
        <h1 class="hero-title">
          Dari Sisa<br>Menjadi <span>Berkah</span>
        </h1>
        <p class="hero-desc">
          Platform digital yang menghubungkan limbah organik dengan peluang pemanfaatan kembali untuk menciptakan
          lingkungan yang lebih bersih dan nilai ekonomi yang berkelanjutan.
        </p>
        <div class="hero-buttons">
          <a href="#cara-kerja" class="btn-primary" id="btn-explore">
            Jelajahi Platform
            <i data-lucide="arrow-right" style="width:18px;height:18px;"></i>
          </a>
          <a href="#cara-kerja" class="btn-secondary" id="btn-learn">
            Pelajari Cara Kerja
          </a>
        </div>
        <div class="hero-features">
          <div class="hero-feature">
            <div class="hero-feature-icon">
              <i data-lucide="handshake" style="width:20px;height:20px;"></i>
            </div>
            <span class="hero-feature-text">Menghubungkan<br>penghasil dan pemanfaat</span>
          </div>
          <div class="hero-feature">
            <div class="hero-feature-icon">
              <i data-lucide="recycle" style="width:20px;height:20px;"></i>
            </div>
            <span class="hero-feature-text">Mendorong<br>ekonomi sirkular</span>
          </div>
          <div class="hero-feature">
            <div class="hero-feature-icon">
              <i data-lucide="leaf" style="width:20px;height:20px;"></i>
            </div>
            <span class="hero-feature-text">Mendukung<br>lingkungan berkelanjutan</span>
          </div>
        </div>
      </div>

      <div class="hero-visual fade-in-right">
        <div class="hero-image-wrapper">
          <div class="hero-blob hero-blob-1"></div>
          <div class="hero-blob hero-blob-2"></div>
          <div class="hero-image-main">
            <img src="{{ asset('assets/images/hero_compost.jpg') }}" alt="Limbah organik yang siap dimanfaatkan kembali"
              loading="eager">
          </div>
          <div class="hero-badge">
            <div class="hero-badge-icon">
              <i data-lucide="trending-up" style="width:16px;height:16px;"></i>
            </div>
            <span>Sampah baru itu,<br>sumber daya yang lama.</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ========== ABOUT SECTION ========== -->
  <section class="about" id="tentang">
    <div class="container">
      <div class="about-visual fade-in-left">
        <div class="about-accent"></div>
        <div class="about-image">
          <img src="{{ asset('assets/images/about_organic.jpg') }}" alt="Limbah organik yang memiliki potensi untuk dimanfaatkan"
            loading="lazy">
        </div>
        <div class="about-floating-card">
          Limbah baru itu,<br>kemudian awal dari.
        </div>
      </div>
      <div class="about-content fade-in-right">
        <span class="section-label">Tentang SisaBerkah</span>
        <h2 class="section-title">
          Mengubah Permasalahan<br>Menjadi <span>Peluang</span>
        </h2>
        <p class="section-desc">
          Limbah organik yang sering dianggap tidak berguna sebenarnya memiliki potensi besar untuk dimanfaatkan
          kembali. SISABERKAH hadir sebagai jembatan antara penghasil limbah dan pihak yang dapat mengolahnya menjadi
          produk bernilai guna dan bernilai ekonomi.
        </p>
        <a href="#cara-kerja" class="btn-outline" id="btn-about-learn">
          Lebih Mengenal Kami
          <i data-lucide="arrow-right" style="width:18px;height:18px;"></i>
        </a>
      </div>
    </div>
  </section>

  <!-- ========== HOW IT WORKS ========== -->
  <section class="how-it-works" id="cara-kerja">
    <div class="container">
      <div class="section-header fade-in">
        <span class="section-label">Cara Kerja</span>
        <h2 class="section-title">
          Perjalanan Sisa Menjadi <span>Berkah</span>
        </h2>
        <p class="section-desc">
          Proses sederhana yang menghubungkan limbah organik dengan peluang pemanfaatan kembali.
        </p>
      </div>

      <!-- Connected Process Flow Layout -->
      <div class="steps-flow-container">
        <!-- SVG Connecting Curved Dashed Track -->
        <div class="steps-curve-wrapper" aria-hidden="true">
          <svg class="steps-curve-svg" viewBox="0 0 1000 170" fill="none" preserveAspectRatio="none">
            <path class="steps-curve-glow"
              d="M 125 85 C 195 10, 305 10, 375 85 C 445 160, 555 160, 625 85 C 695 10, 805 10, 875 85" />
            <path class="steps-curve-track"
              d="M 125 85 C 195 10, 305 10, 375 85 C 445 160, 555 160, 625 85 C 695 10, 805 10, 875 85" />
          </svg>
        </div>

        <div class="steps-flow-grid">
          <!-- Step 1: Kumpulkan -->
          <div class="step-flow-item fade-in" style="transition-delay: 0.1s;">
            <div class="step-card-visual">
              <div class="card-browser-mockup">
                <div class="browser-header">
                  <div class="browser-dots">
                    <span class="dot dot-red"></span>
                    <span class="dot dot-yellow"></span>
                    <span class="dot dot-green"></span>
                  </div>
                  <div class="browser-address-bar">
                    <span class="browser-address-pill"></span>
                  </div>
                </div>
                <div class="browser-body">
                  <div class="browser-icon-badge">
                    <i data-lucide="scan-line" style="width:20px;height:20px;"></i>
                  </div>
                  <div class="browser-skeleton">
                    <div class="skel-line skel-wide"></div>
                    <div class="skel-line skel-narrow"></div>
                  </div>
                  <div class="browser-action-btn">
                    <span>Pilah Organik</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="step-info-block">
              <span class="step-num-pill">01</span>
              <h3 class="step-title">Kumpulkan</h3>
              <p class="step-desc">Identifikasi &amp; pilah limbah organik berkualitas di sekitar Anda.</p>
            </div>
          </div>

          <!-- Step 2: Hubungkan -->
          <div class="step-flow-item fade-in" style="transition-delay: 0.2s;">
            <div class="step-card-visual">
              <div class="card-scanner-mockup">
                <div class="scanner-notch"></div>
                <div class="scanner-screen">
                  <div class="scanner-viewfinder">
                    <span class="vf-corner vf-tl"></span>
                    <span class="vf-corner vf-tr"></span>
                    <span class="vf-corner vf-bl"></span>
                    <span class="vf-corner vf-br"></span>
                    <div class="scanner-target-icon">
                      <i data-lucide="link-2" style="width:20px;height:20px;"></i>
                    </div>
                  </div>
                  <div class="scanner-status-pill">
                    <span>Cari Mitra</span>
                  </div>
                </div>
                <div class="scanner-home-btn"></div>
              </div>
            </div>
            <div class="step-info-block">
              <span class="step-num-pill">02</span>
              <h3 class="step-title">Hubungkan</h3>
              <p class="step-desc">Temukan pihak yang membutuhkan atau mampu mengolah limbah.</p>
            </div>
          </div>

          <!-- Step 3: Manfaatkan -->
          <div class="step-flow-item fade-in" style="transition-delay: 0.3s;">
            <div class="step-card-visual">
              <div class="card-process-mockup">
                <div class="process-header">
                  <div class="process-badge-tag">
                    <i data-lucide="settings" style="width:13px;height:13px;"></i>
                    <span>Olah Kompos</span>
                  </div>
                  <div class="process-status-dot"></div>
                </div>
                <div class="process-body">
                  <div class="process-flow-visual">
                    <div class="p-node p-source" title="Limbah Organik">
                      <i data-lucide="apple" style="width:14px;height:14px;"></i>
                    </div>
                    <div class="p-arrow">
                      <i data-lucide="arrow-right" style="width:12px;height:12px;"></i>
                    </div>
                    <div class="p-node p-target" title="Kompos &amp; Pupuk">
                      <i data-lucide="sprout" style="width:14px;height:14px;"></i>
                    </div>
                  </div>
                  <div class="process-progress-box">
                    <div class="progress-bar-track">
                      <div class="progress-bar-fill"></div>
                    </div>
                    <span class="progress-label">Daur Ulang 100% Siap</span>
                  </div>
                  <div class="process-action-btn">
                    <span>Proses Olah</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="step-info-block">
              <span class="step-num-pill">03</span>
              <h3 class="step-title">Manfaatkan</h3>
              <p class="step-desc">Olah limbah menjadi kompos, pupuk, atau pakan bergizi.</p>
            </div>
          </div>

          <!-- Step 4: Berdayakan -->
          <div class="step-flow-item fade-in" style="transition-delay: 0.4s;">
            <div class="step-card-visual">
              <div class="card-receipt-mockup">
                <div class="receipt-header">
                  <div class="receipt-icon-box">
                    <i data-lucide="banknote" style="width:16px;height:16px;"></i>
                  </div>
                  <div class="receipt-header-bars">
                    <span class="bar bar-thick"></span>
                    <span class="bar bar-thin"></span>
                  </div>
                </div>
                <div class="receipt-body">
                  <div class="receipt-row">
                    <span class="row-line row-line-long"></span>
                    <span class="row-badge row-badge-dark"></span>
                  </div>
                  <div class="receipt-row">
                    <span class="row-line row-line-short"></span>
                    <span class="row-badge row-badge-dark-sm"></span>
                  </div>
                </div>
                <div class="receipt-footer">
                  <span class="receipt-pill-gray"></span>
                  <div class="receipt-action-btn">
                    <span>Dampak Hijau</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="step-info-block">
              <span class="step-num-pill">04</span>
              <h3 class="step-title">Berdayakan</h3>
              <p class="step-desc">Ciptakan peluang ekonomi dan dampak hijau berkelanjutan.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ========== WASTE TYPES ========== -->
  <section class="waste-types" id="jenis-limbah">
    <div class="container">
      <div class="section-header-row fade-in">
        <div class="section-header-left">
          <span class="section-label">Jenis Limbah Organik</span>
          <h2 class="section-title">
            Kenali Potensi <span>Limbah Organik</span>
          </h2>
          <p class="section-desc">
            Beragam jenis limbah organik di sekitar kita dapat dimanfaatkan kembali dengan metode yang tepat.
          </p>
        </div>
        <div class="section-header-action">
          <a href="{{ route('jenis-limbah') }}" class="btn-all-partners" id="btn-all-waste">
            <span>Lihat Semua (12)</span>
            <i data-lucide="arrow-right" style="width:14px;height:14px;"></i>
          </a>
        </div>
      </div>

      <div class="waste-grid" id="wasteCardsGrid">
        <!-- Card 1 -->
        <div class="waste-card fade-in" style="transition-delay: 0.05s;">
          <div class="waste-card-image">
            <img src="{{ asset('assets/images/waste_vegetables.jpg') }}" alt="Sisa sayuran dan buah" loading="lazy">
          </div>
          <div class="waste-card-body">
            <h3 class="waste-card-title">Sisa Sayuran dan Buah</h3>
            <p class="waste-card-desc">Kulit, batang, dan sisa sayuran atau buah yang tidak terkonsumsi.</p>
            <button type="button" class="waste-card-link" onclick="openWasteModal('sayuran-buah')">
              <span>Lihat Detail</span>
              <i data-lucide="arrow-right" style="width:14px;height:14px;"></i>
            </button>
          </div>
        </div>

        <!-- Card 2 -->
        <div class="waste-card fade-in" style="transition-delay: 0.1s;">
          <div class="waste-card-image">
            <img src="{{ asset('assets/images/waste_food.jpg') }}" alt="Sisa makanan" loading="lazy">
          </div>
          <div class="waste-card-body">
            <h3 class="waste-card-title">Sisa Makanan</h3>
            <p class="waste-card-desc">Nasi, lauk, dan sisa makanan yang tidak terkonsumsi.</p>
            <button type="button" class="waste-card-link" onclick="openWasteModal('sisa-makanan')">
              <span>Lihat Detail</span>
              <i data-lucide="arrow-right" style="width:14px;height:14px;"></i>
            </button>
          </div>
        </div>

        <!-- Card 3 -->
        <div class="waste-card fade-in" style="transition-delay: 0.15s;">
          <div class="waste-card-image">
            <img src="{{ asset('assets/images/waste_coffee.jpg') }}" alt="Ampas kopi dan teh" loading="lazy">
          </div>
          <div class="waste-card-body">
            <h3 class="waste-card-title">Ampas Kopi dan Teh</h3>
            <p class="waste-card-desc">Ampas kopi, teh celup, dan sisa seduhan yang kaya nutrisi.</p>
            <button type="button" class="waste-card-link" onclick="openWasteModal('ampas-kopi')">
              <span>Lihat Detail</span>
              <i data-lucide="arrow-right" style="width:14px;height:14px;"></i>
            </button>
          </div>
        </div>

        <!-- Card 4 -->
        <div class="waste-card fade-in" style="transition-delay: 0.2s;">
          <div class="waste-card-image">
            <img src="{{ asset('assets/images/waste_leaves.jpg') }}" alt="Daun dan sisa tanaman" loading="lazy">
          </div>
          <div class="waste-card-body">
            <h3 class="waste-card-title">Daun dan Sisa Tanaman</h3>
            <p class="waste-card-desc">Daun kering, rumputan, dan sisa tanaman yang bisa dikomposkan.</p>
            <button type="button" class="waste-card-link" onclick="openWasteModal('daun-tanaman')">
              <span>Lihat Detail</span>
              <i data-lucide="arrow-right" style="width:14px;height:14px;"></i>
            </button>
          </div>
        </div>

        <!-- Card 5 -->
        <div class="waste-card fade-in" style="transition-delay: 0.25s;">
          <div class="waste-card-image">
            <img src="{{ asset('assets/images/waste_market.jpg') }}" alt="Limbah organik pasar" loading="lazy">
          </div>
          <div class="waste-card-body">
            <h3 class="waste-card-title">Limbah Organik Pasar</h3>
            <p class="waste-card-desc">Sisa sayuran, buah, dan bahan organik dari pasar tradisional.</p>
            <button type="button" class="waste-card-link" onclick="openWasteModal('limbah-pasar')">
              <span>Lihat Detail</span>
              <i data-lucide="arrow-right" style="width:14px;height:14px;"></i>
            </button>
          </div>
        </div>

        <!-- Card 6 -->
        <div class="waste-card fade-in" style="transition-delay: 0.3s;">
          <div class="waste-card-image">
            <img src="{{ asset('assets/images/waste_culinary.jpg') }}" alt="Limbah organik usaha kuliner" loading="lazy">
          </div>
          <div class="waste-card-body">
            <h3 class="waste-card-title">Limbah Organik Usaha Kuliner</h3>
            <p class="waste-card-desc">Sisa bahan masakan, kulit, dan sisa olahan dari usaha kuliner.</p>
            <button type="button" class="waste-card-link" onclick="openWasteModal('limbah-kuliner')">
              <span>Lihat Detail</span>
              <i data-lucide="arrow-right" style="width:14px;height:14px;"></i>
            </button>
          </div>
        </div>
      </div>

      <div class="waste-note fade-in">
        <i data-lucide="info" style="width:16px;height:16px;"></i>
        <span>Metode pemanfaatan limbah organik bergantung pada kondisi, ketersediaan, dan karakteristik masing-masing jenis limbah.</span>
      </div>
    </div>
  </section>

  <!-- ========== SECTION: PROFIL MITRA SPOTLIGHT ========== -->
  <section class="home-mitra-spotlight" id="mitra-spotlight">
    <div class="container">
      <div class="section-header-row fade-in">
        <div class="section-header-left">
          <span class="section-label">
            <i data-lucide="handshake" style="width:15px;height:15px;"></i>
            Mitra Penerima Bahan Organik
          </span>
          <h2 class="section-title">
            Profil Mitra yang <span>Membutuhkan</span>
          </h2>
          <p class="section-desc">
            Temukan mitra peternakan, pertanian, dan pengolah kompos terpercaya yang siap menyerap sisa bahan organik
            Anda untuk pemanfaatan berkelanjutan.
          </p>
        </div>
        <div class="section-header-action">
          <a href="{{ route('mitra.index') }}" class="btn-all-partners" id="btn-all-mitra">
            <span>Lihat Semua ({{ \App\Models\MitraProfile::where('status', 'active')->count() }})</span>
            <i data-lucide="arrow-right" style="width:14px;height:14px;"></i>
          </a>
        </div>
      </div>

      <div class="home-partner-grid">
        @forelse($featuredMitras as $idx => $m)
          @php
            $waMsg = "Halo {$m->owner} ({$m->name}), salam kenal.\n\nSaya mendapatkan informasi kontak Bapak/Ibu melalui platform SisaBerkah terkait kebutuhan bahan organik berupa \"{$m->materials_needed}\".\n\nKebetulan kami memiliki pasokan bahan organik terpilah dan segar yang siap disalurkan secara rutin untuk mendukung {$m->name}.\n\nApakah saat ini masih menerima pasokan baru? Jika berkenan, kami ingin mendiskusikan perkiraan volume, jadwal penjemputan, serta ketentuan kualitas bahannya. Terima kasih banyak atas waktu dan perhatiannya.";
            $waLink = "https://wa.me/" . preg_replace('/[^0-9]/', '', $m->whatsapp) . "?text=" . rawurlencode($waMsg);
            $imgSrc = $m->display_image;
          @endphp
          <div class="home-partner-card fade-in" data-partner-id="{{ $m->id }}" style="transition-delay: {{ $idx * 0.1 }}s;">
            <div class="home-partner-img">
              <img src="{{ $imgSrc }}" alt="{{ $m->name }}" loading="lazy" onerror="this.src='{{ asset('assets/images/partner_doni.jpg') }}'">
              <span class="home-partner-badge">{{ $m->category }}</span>
            </div>
            <div class="home-partner-body">
              <h3 class="home-partner-title">{{ $m->name }}</h3>
              <div class="home-partner-meta">
                <i data-lucide="store" style="width:14px;height:14px;"></i>
                <span>{{ $m->owner }}</span>
                <span>•</span>
                <span>{{ $m->city ?? explode(',', $m->location)[0] }}</span>
              </div>
              <div class="home-partner-need-box">
                <span class="home-partner-need-label">KEBUTUHAN BAHAN:</span>
                <p class="home-partner-need-desc">{{ $m->materials_needed }}</p>
              </div>
              <div class="home-partner-actions">
                <button type="button" class="btn-partner-profile" onclick="openDetailModal('{{ $m->id }}')">Lihat Profil</button>
                <a href="{{ $waLink }}" target="_blank" rel="noopener noreferrer" class="btn-partner-whatsapp">
                  <i data-lucide="message-circle" style="width:15px;height:15px;"></i>
                  <span>WhatsApp</span>
                </a>
              </div>
            </div>
          </div>
        @empty
          <p style="grid-column: 1/-1; text-align: center; color: var(--color-muted);">Belum ada mitra spotlight tersedia saat ini.</p>
        @endforelse
      </div>

    </div>
  </section>

  <!-- ========== IMPACT / BENEFITS ========== -->
  <section class="impact" id="dampak">
    <div class="container">
      <div class="impact-content fade-in-left">
        <span class="section-label">Manfaat dan Dampak</span>
        <h2 class="section-title">
          Langkah Kecil,<br><span>Dampak Berarti</span>
        </h2>
        <p class="section-desc">
          Bersama SISABERKAH, limbah organik dapat menjadi sumber daya yang bermanfaat bagi lingkungan, masyarakat, dan
          ekonomi lokal.
        </p>

        <div class="impact-list">
          <div class="impact-item">
            <div class="impact-item-icon">
              <i data-lucide="trash-2" style="width:18px;height:18px;"></i>
            </div>
            <span class="impact-item-text">Mengurangi limbah organik yang terbuang percuma di tempat pembuangan akhir.</span>
          </div>
          <div class="impact-item">
            <div class="impact-item-icon">
              <i data-lucide="refresh-cw" style="width:18px;height:18px;"></i>
            </div>
            <span class="impact-item-text">Membuka peluang pemanfaatan kembali melalui pengomposan dan pengolahan.</span>
          </div>
          <div class="impact-item">
            <div class="impact-item-icon">
              <i data-lucide="sprout" style="width:18px;height:18px;"></i>
            </div>
            <span class="impact-item-text">Mendukung pengelolaan kompos dan bahan organik secara berkelanjutan.</span>
          </div>
          <div class="impact-item">
            <div class="impact-item-icon">
              <i data-lucide="building-2" style="width:18px;height:18px;"></i>
            </div>
            <span class="impact-item-text">Membangun ekonomi sirkular yang menghubungkan UMKM, petani, dan komunitas.</span>
          </div>
          <div class="impact-item">
            <div class="impact-item-icon">
              <i data-lucide="trees" style="width:18px;height:18px;"></i>
            </div>
            <span class="impact-item-text">Mendukung lingkungan yang lebih bersih dan sehat untuk generasi mendatang.</span>
          </div>
        </div>

        <a href="#kontak" class="btn-outline" id="btn-impact-more">
          Lihat Dampak Lebih Lanjut
          <i data-lucide="arrow-right" style="width:18px;height:18px;"></i>
        </a>
      </div>

      <div class="impact-visual fade-in-right">
        <div class="impact-stat-card">
          <div class="impact-stat-icon">
            <i data-lucide="trash-2" style="width:22px;height:22px;"></i>
          </div>
          <div class="impact-stat-title">Mengurangi Limbah</div>
          <p class="impact-stat-desc">Limbah organik yang terbuang dapat diminimalisir</p>
        </div>
        <div class="impact-stat-card">
          <div class="impact-stat-icon">
            <i data-lucide="refresh-cw" style="width:22px;height:22px;"></i>
          </div>
          <div class="impact-stat-title">Pemanfaatan Kembali</div>
          <p class="impact-stat-desc">Membuka peluang pengolahan yang bernilai</p>
        </div>
        <div class="impact-stat-card">
          <div class="impact-stat-icon">
            <i data-lucide="coins" style="width:22px;height:22px;"></i>
          </div>
          <div class="impact-stat-title">Ekonomi Sirkular</div>
          <p class="impact-stat-desc">Mendorong pertumbuhan ekonomi lokal</p>
        </div>
        <div class="impact-stat-card">
          <div class="impact-stat-icon">
            <i data-lucide="heart" style="width:22px;height:22px;"></i>
          </div>
          <div class="impact-stat-title">Lingkungan Sehat</div>
          <p class="impact-stat-desc">Menciptakan lingkungan lebih bersih dan sehat</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ========== TESTIMONIALS & FAQ ========== -->
  <section class="social-proof-section" id="faq">
    <div class="container">
      <!-- Section 1: Apa Kata Mereka? -->
      <div class="testimonials-block fade-in">
        <h2 class="section-title text-center">Apa Kata Mereka?</h2>
        <div class="testimonials-grid">
          <div class="testimonial-card">
            <div class="testimonial-avatar">
              <img src="{{ asset('assets/images/testimonial_andi.jpg') }}" alt="Andi Prasetyo" loading="lazy">
            </div>
            <div class="testimonial-content">
              <div class="testimonial-stars" aria-label="Rating 5 bintang">
                <i data-lucide="star" class="star-filled"></i>
                <i data-lucide="star" class="star-filled"></i>
                <i data-lucide="star" class="star-filled"></i>
                <i data-lucide="star" class="star-filled"></i>
                <i data-lucide="star" class="star-filled"></i>
              </div>
              <p class="testimonial-quote">
                "Sangat terbantu mendapatkan pasokan sisa sayuran dan ampas kelapa rutin untuk pakan ternak. Biaya pakan jauh lebih hemat dan kualitasnya terjamin."
              </p>
              <span class="testimonial-author">- Andi, Mitra Peternak Maggot &amp; Unggas</span>
            </div>
          </div>

          <div class="testimonial-card">
            <div class="testimonial-avatar">
              <img src="{{ asset('assets/images/testimonial_sarah.jpg') }}" alt="Sarah Amanda" loading="lazy">
            </div>
            <div class="testimonial-content">
              <div class="testimonial-stars" aria-label="Rating 5 bintang">
                <i data-lucide="star" class="star-filled"></i>
                <i data-lucide="star" class="star-filled"></i>
                <i data-lucide="star" class="star-filled"></i>
                <i data-lucide="star" class="star-filled"></i>
                <i data-lucide="star" class="star-filled"></i>
              </div>
              <p class="testimonial-quote">
                "Limbah buah dan sayur dari kedai kami kini dijemput terjadwal oleh mitra pengolah. Konsepnya unik, tidak menumpuk busuk, dan sangat bermanfaat."
              </p>
              <span class="testimonial-author">- Sarah, Pelaku UMKM Buah &amp; Jus</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Section 2: Pertanyaan Umum -->
      <div class="faq-block fade-in" style="transition-delay: 0.15s;">
        <h2 class="section-title text-center">Pertanyaan Umum</h2>
        <div class="faq-grid">
          <!-- Left Column -->
          <div class="faq-col">
            <div class="faq-item">
              <button type="button" class="faq-question" aria-expanded="false">
                <span>Apa itu SisaBerkah?</span>
                <i data-lucide="chevron-down" class="faq-chevron"></i>
              </button>
              <div class="faq-answer">
                <p>SisaBerkah adalah platform digital ekonomi sirkular yang menghubungkan pemilik limbah organik (UMKM pangan, pasar, restoran, rumah tangga) dengan pihak pemanfaat seperti peternak, petani, dan pengolah kompos.</p>
              </div>
            </div>

            <div class="faq-item">
              <button type="button" class="faq-question" aria-expanded="false">
                <span>Bagaimana sistem penyalurannya?</span>
                <i data-lucide="chevron-down" class="faq-chevron"></i>
              </button>
              <div class="faq-answer">
                <p>Anda dapat mendaftarkan jenis dan perkiraan pasokan limbah organik, lalu memilih mitra terdekat yang membutuhkan bahan tersebut untuk terhubung langsung dan berkoordinasi via WhatsApp.</p>
              </div>
            </div>

            <div class="faq-item">
              <button type="button" class="faq-question" aria-expanded="false">
                <span>Apakah bahan organik diambil atau diantar?</span>
                <i data-lucide="chevron-down" class="faq-chevron"></i>
              </button>
              <div class="faq-answer">
                <p>Metode serah terima disepakati bersama. Sebagian besar mitra peternak dan pengolah kompos bersedia menjemput langsung ke lokasi Anda dengan jadwal berkala.</p>
              </div>
            </div>
          </div>

          <!-- Right Column -->
          <div class="faq-col">
            <div class="faq-item">
              <button type="button" class="faq-question" aria-expanded="false">
                <span>Bagaimana jika kualitas bahan belum sesuai?</span>
                <i data-lucide="chevron-down" class="faq-chevron"></i>
              </button>
              <div class="faq-answer">
                <p>Bahan organik harus dipilah bebas dari plastik, logam, atau zat kimia. Anda dapat mengirimkan foto kondisi bahan terlebih dahulu kepada mitra sebelum proses pengambilan dilakukan.</p>
              </div>
            </div>

            <div class="faq-item">
              <button type="button" class="faq-question" aria-expanded="false">
                <span>Apakah ada biaya untuk bergabung?</span>
                <i data-lucide="chevron-down" class="faq-chevron"></i>
              </button>
              <div class="faq-answer">
                <p>Tidak ada biaya pendaftaran. Pencarian informasi potensi limbah organik dan direktori mitra di SisaBerkah bersifat gratis untuk mendukung pengurangan timbulan sampah organik.</p>
              </div>
            </div>

            <div class="faq-item">
              <button type="button" class="faq-question" aria-expanded="false">
                <span>Metode kesepakatan apa saja yang tersedia?</span>
                <i data-lucide="chevron-down" class="faq-chevron"></i>
              </button>
              <div class="faq-answer">
                <p>Kesepakatan harga jual-beli (jika bernilai ekonomis atau disumbangkan cuma-cuma) serta jadwal penjemputan didiskusikan secara transparan dan fleksibel langsung melalui WhatsApp.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ========== CTA SECTION ========== -->
  <section class="cta-section" id="kontak">
    <div class="container">
      <div class="cta-content fade-in-left">
        <span class="section-label">Bergabung Bersama Kami</span>
        <h2 class="cta-title">
          Jangan Biarkan Potensi<br>Berakhir Menjadi Sampah
        </h2>
        <p class="cta-desc">
          Mari berikan aksi nyata dari limbah organik dan jadilah bagian dari perubahan menuju yang lebih berkelanjutan.
        </p>
        <div class="cta-buttons">
          <a href="{{ route('register') }}" class="btn-white" id="btn-cta-join">
            Bergabung dengan SISABERKAH
            <i data-lucide="arrow-right" style="width:18px;height:18px;"></i>
          </a>
          <a href="#tentang" class="btn-ghost" id="btn-cta-contact">
            Hubungi Kami
          </a>
        </div>
      </div>
      <div class="cta-quote fade-in-right">
        <p class="cta-quote-text">
          "Dari <span>sisa</span>,<br>tumbuh <span>masa depan</span>."
        </p>
      </div>
    </div>
  </section>

  <!-- Modal Detail Mitra -->
  <div class="modal-overlay" id="partnerDetailModal" onclick="closeDetailModal()">
    <div class="modal-card" onclick="event.stopPropagation()">
      <button type="button" class="modal-close-btn" onclick="closeDetailModal()">&times;</button>
      <div id="partnerModalBody"></div>
    </div>
  </div>

  <!-- Modal Detail Jenis Limbah Organik -->
  <div class="modal-overlay" id="wasteDetailModal" onclick="closeWasteModal()">
    <div class="modal-card" style="max-width: 680px;" onclick="event.stopPropagation()">
      <button type="button" class="modal-close-btn" onclick="closeWasteModal()">&times;</button>
      <div id="wasteModalBody"></div>
    </div>
  </div>
@endsection

@section('scripts')
<script>
  const isAuth = {{ auth()->check() ? 'true' : 'false' }};
  const loginUrl = "{{ route('login') }}";

  function redirectToLogin(targetUrl) {
    if (targetUrl && !targetUrl.startsWith('#')) {
      window.location.href = `${loginUrl}?redirect=${encodeURIComponent(targetUrl)}`;
    } else {
      window.location.href = loginUrl;
    }
  }

  // Global Click Interceptor for guests
  document.addEventListener('click', function (e) {
    if (isAuth) return;

    // Khusus BerkahBot Chatbot: bebas akses langsung tanpa perlu login
    if (e.target.closest('#berkahbot-widget-container')) {
      return;
    }

    const btn = e.target.closest(
      'button, .btn-primary, .btn-secondary, .btn-outline, .btn-all-partners, ' +
      '.btn-partner-profile, .btn-partner-whatsapp, .waste-card-link, .btn-white, ' +
      '.btn-ghost, a[href*="mitra"], a[href*="jenis-limbah"]'
    );

    if (!btn) return;

    if (
      btn.id === 'menuToggle' ||
      btn.classList.contains('menu-toggle') ||
      btn.classList.contains('faq-question') ||
      btn.classList.contains('modal-close-btn') ||
      btn.id === 'navPortalMitraBtn' ||
      btn.classList.contains('nav-user-badge') ||
      btn.classList.contains('nav-logout-btn') ||
      btn.classList.contains('nav-login-btn') ||
      btn.closest('#berkahbot-widget-container')
    ) {
      return;
    }

    e.preventDefault();
    e.stopPropagation();
    e.stopImmediatePropagation();

    const href = btn.getAttribute('href') || '';
    redirectToLogin(href);
  }, true);

  // Mitra Data
  @php
    $mitrasForJs = \App\Models\MitraProfile::where('status', 'active')->get()->keyBy('id')->map(function($item) {
      return [
        'id' => $item->id,
        'name' => $item->name,
        'owner' => $item->owner,
        'cat' => $item->category,
        'loc' => $item->location,
        'img' => $item->display_image,
        'need' => $item->materials_needed,
        'desc' => $item->description,
        'amount' => $item->estimated_amount,
        'terms' => $item->terms_conditions,
        'wa' => preg_replace('/[^0-9]/', '', $item->whatsapp)
      ];
    });
  @endphp
  const mitraDataMap = @json($mitrasForJs);

  function openDetailModal(id) {
    if (!isAuth) {
      redirectToLogin("{{ route('mitra.index') }}");
      return;
    }
    const data = mitraDataMap[id];
    if (!data) return;

    const modal = document.getElementById('partnerDetailModal');
    const body = document.getElementById('partnerModalBody');

    const waText = encodeURIComponent(
      `Halo ${data.owner} (${data.name}), salam kenal.\n\n` +
      `Saya mendapatkan informasi kontak Bapak/Ibu melalui platform SisaBerkah terkait kebutuhan bahan organik berupa "${data.need}".\n\n` +
      `Kebetulan kami memiliki pasokan bahan organik terpilah dan segar yang siap disalurkan secara rutin untuk mendukung ${data.name}.\n\n` +
      `Apakah saat ini masih menerima pasokan baru? Jika berkenan, kami ingin mendiskusikan perkiraan volume, jadwal penjemputan, serta ketentuan kualitas bahannya. Terima kasih banyak atas waktu dan perhatiannya.`
    );
    const waUrl = `https://wa.me/${data.wa}?text=${waText}`;

    body.innerHTML = `
      <div style="position:relative;border-radius:16px;overflow:hidden;height:200px;margin-bottom:1.25rem;">
        <img src="${data.img}" alt="${data.name}" style="width:100%;height:100%;object-fit:cover;" onerror="this.src='{{ asset('assets/images/partner_budi.jpg') }}'">
        <span class="home-partner-badge" style="top:16px;right:16px;">${data.cat}</span>
      </div>
      <h2 style="font-family:var(--font-heading);font-size:1.55rem;font-weight:800;color:var(--color-text);margin-bottom:0.25rem;">${data.name}</h2>
      <div style="font-size:0.88rem;color:var(--color-muted);margin-bottom:1rem;">
        Pemilik: <strong>${data.owner}</strong> • Lokasi: <strong>${data.loc}</strong>
      </div>
      <p style="font-size:0.92rem;color:var(--color-text);line-height:1.6;margin-bottom:1.25rem;">${data.desc}</p>
      
      <div style="background:var(--color-sage);border:1px solid var(--color-accent);border-radius:var(--radius-lg);padding:1rem;margin-bottom:1rem;">
        <strong style="display:block;font-size:0.75rem;text-transform:uppercase;color:var(--color-primary);margin-bottom:0.25rem;letter-spacing:0.5px;">Bahan yang Dibutuhkan:</strong>
        <span style="font-size:0.95rem;font-weight:700;color:var(--color-text);">${data.need}</span>
      </div>

      <div style="background:#F9FBF8;border:1px solid var(--color-border);border-radius:var(--radius-md);padding:0.85rem;margin-bottom:1rem;font-size:0.88rem;">
        <strong>Estimasi Kebutuhan / Kapasitas:</strong> ${data.amount}
      </div>

      <div style="background:rgba(217,119,6,0.08);border-left:4px solid #D97706;border-radius:var(--radius-sm);padding:0.85rem;font-size:0.85rem;color:#92400E;line-height:1.5;margin-bottom:1.5rem;">
        <strong>Ketentuan Penerimaan:</strong> ${data.terms}
      </div>

      <div style="display:grid;grid-template-columns:1fr 1fr;gap:0.75rem;">
        <a href="{{ route('mitra.index') }}#${id}" class="btn-partner-profile" style="text-align:center;">Lihat di Direktori</a>
        <a href="${waUrl}" target="_blank" rel="noopener noreferrer" class="btn-partner-whatsapp" style="display:flex;justify-content:center;gap:0.5rem;">
          <i data-lucide="message-circle" style="width:18px;height:18px;"></i>
          <span>WhatsApp</span>
        </a>
      </div>
    `;

    modal.classList.add('active');
    lucide.createIcons();
  }

  function closeDetailModal() {
    const modal = document.getElementById('partnerDetailModal');
    if (modal) modal.classList.remove('active');
  }

  // Waste Data
  const wasteDataMap = {
    'sayuran-buah': {
      title: 'Sisa Sayuran dan Buah',
      badge: 'Limbah Basah / Cepat Terurai',
      img: '{{ asset("assets/images/waste_vegetables.jpg") }}',
      source: 'Pasar tradisional, supermarket sayur/buah, restoran, dan rumah tangga.',
      nutrients: 'Kadar air 85-90%, serat selulosa, vitamin A & C, glukosa alami, dan kalium.',
      uses: [
        { icon: 'sprout', text: 'Kompos Bahan Hijau (Kaya Nitrogen)' },
        { icon: 'egg', text: 'Pakan Fermentasi Unggas & Bebek' },
        { icon: 'bug', text: 'Pakan Maggot BSF Kualitas Super' },
        { icon: 'droplet', text: 'Eco-Enzyme & Pupuk Organik Cair (POC)' }
      ],
      tips: 'Pisahkan dari plastik kresek, karet gelang, dan staples pengikat. Hindari sayuran yang sudah berlendir busuk parah atau terkontaminasi minyak jelantah kotor.',
      partners: 'Sangat dibutuhkan oleh Peternakan Pak Adam (Malang) & Pertanian Pak Andi (Sukabumi).',
      linkMitra: '{{ route("mitra.index") }}'
    },
    'sisa-makanan': {
      title: 'Sisa Makanan (Food Waste)',
      badge: 'Limbah Olahan Dapur & Meja Makan',
      img: '{{ asset("assets/images/waste_food.jpg") }}',
      source: 'Restoran, katering pesta, kantin karyawan/kampus, hotel, dan rumah tangga.',
      nutrients: 'Karbohidrat (nasi, mie), protein hewani/nabati, lemak, dan mineral.',
      uses: [
        { icon: 'bug', text: 'Super Pakan Budidaya Larva Maggot BSF' },
        { icon: 'flame', text: 'Bahan Baku Biogas Energi Bersih' },
        { icon: 'beef', text: 'Pakan Ternak Fermentasi Probiotik EM4' },
        { icon: 'recycle', text: 'Pengolahan Biokonversi Berkelanjutan' }
      ],
      tips: 'Gunakan ember tertutup rapat dengan kran tiris air lindi. Bebas dari tusuk gigi kayu/plastik, tulang besar keras, tisu makan, dan puntung rokok. Disarankan pengambilan rutin 1x24 jam.',
      partners: 'Sangat dibutuhkan oleh Peternakan Pak Haris (Bogor - Maggot & Unggas).',
      linkMitra: '{{ route("mitra.index") }}'
    },
    'ampas-kopi': {
      title: 'Ampas Kopi dan Teh',
      badge: 'Limbah Kafe & Minuman Seduh',
      img: '{{ asset("assets/images/waste_coffee.jpg") }}',
      source: 'Coffee shop, kedai kopi lokal, pabrik minuman botol, dan rumah tangga.',
      nutrients: 'Nitrogen organik (2%), kalium, fosfor, magnesium, antioksidan, dan serat halus.',
      uses: [
        { icon: 'flower-2', text: 'Media Tanam Jamur Tiram Konsumsi' },
        { icon: 'leaf', text: 'Pembenah Struktur Tanah & Penggembur' },
        { icon: 'shield-alert', text: 'Pengusir Hama Siput, Semut & Kucing Liar' },
        { icon: 'sparkles', text: 'Penetral Bau Amonia di Kandang Ternak' }
      ],
      tips: 'Tiriskan air seduhan dan angin-anginkan di nampan terbuka agar tidak mudah ditumbuhi jamur biru liar. Bebas dari sedotan plastik dan kantong teh sintetis.',
      partners: 'Sangat dibutuhkan oleh Pengolahan Kompos Pak Dedi (Lembang, Bandung).',
      linkMitra: '{{ route("mitra.index") }}'
    },
    'daun-tanaman': {
      title: 'Daun dan Sisa Tanaman',
      badge: 'Limbah Hijauan & Serasah Kebun',
      img: '{{ asset("assets/images/waste_leaves.jpg") }}',
      source: 'Pekarangan, taman kota, perkebunan hortikultura, dan pangkasan ranting.',
      nutrients: 'Karbon alami tinggi (unsur C/Brown material), lignin, selulosa, dan kalium.',
      uses: [
        { icon: 'trees', text: 'Bahan Cokelat Penyeimbang Kompos' },
        { icon: 'shield-check', text: 'Mulsa Penutup Tanah Pencegah Gulma' },
        { icon: 'flame', text: 'Briket Biomassa Ramah Lingkungan' },
        { icon: 'worm', text: 'Pakan Kascing Cacing Tanah Lumbricus' }
      ],
      tips: 'Cacah daun dan ranting hingga ukuran 3-5 cm untuk mempercepat proses dekomposisi mikroba. Kumpulkan dalam karung goni berpori.',
      partners: 'Sangat dibutuhkan oleh Pertanian Pak Andi (Cisaat, Sukabumi).',
      linkMitra: '{{ route("mitra.index") }}'
    },
    'limbah-pasar': {
      title: 'Limbah Organik Pasar Tradisional',
      badge: 'Limbah Komersial Skala Besar',
      img: '{{ asset("assets/images/waste_market.jpg") }}',
      source: 'Pasar induk buah/sayur, lapak pedagang kaki lima, dan pasar induk sayuran.',
      nutrients: 'Campuran hijauan segar, gula buah alami, selulosa, dan kadar air tinggi.',
      uses: [
        { icon: 'milk', text: 'Pakan Hijauan Sapi Perah & Kambing' },
        { icon: 'factory', text: 'Komposting Skala Tonase di TPS3R Kota' },
        { icon: 'bug', text: 'Pakan Massal Rumah Maggot Organik' },
        { icon: 'droplet', text: 'Pupuk Cair Konsentrat Tanaman Buah' }
      ],
      tips: 'Lakukan pemilahan langsung di kios pedagang agar tidak tercampur limbah anorganik pasar (kresek hitam, karung plastik rusak, kawat pengikat peti kayu).',
      partners: 'Sangat dibutuhkan oleh Peternakan Pak Adam (Malang) & Pengolahan Kompos Pak Dedi.',
      linkMitra: '{{ route("mitra.index") }}'
    },
    'limbah-kuliner': {
      title: 'Limbah Organik Usaha Kuliner',
      badge: 'Limbah Persiapan Dapur Resto',
      img: '{{ asset("assets/images/waste_culinary.jpg") }}',
      source: 'Restoran masakan padang, kafe, katering pesta, dan dapur hotel.',
      nutrients: 'Protein hewani, karbohidrat bumbu, minyak nabati, dan garam mineral.',
      uses: [
        { icon: 'soup', text: 'Kaldu Rebus Pakan Basah Unggas & Babi' },
        { icon: 'bug', text: 'Biokonversi Cepat Biomassa Larva BSF' },
        { icon: 'sparkles', text: 'Fermentasi Pupuk Asam Amino Tanaman' }
      ],
      tips: 'Pisahkan minyak jelantah di wadah tersendiri. Jangan mencampurkan air sabun cuci piring atau pembersih lantai dapur ke dalam tong bahan organik.',
      partners: 'Sangat dibutuhkan oleh Peternakan Pak Haris (Cileungsi).',
      linkMitra: '{{ route("mitra.index") }}'
    }
  };

  function openWasteModal(key) {
    if (!isAuth) {
      redirectToLogin("{{ route('jenis-limbah') }}");
      return;
    }
    const data = wasteDataMap[key];
    if (!data) return;
    const modal = document.getElementById('wasteDetailModal');
    const body = document.getElementById('wasteModalBody');

    const usesHtml = data.uses.map(u => `
      <div style="display:flex;align-items:center;gap:0.6rem;padding:0.6rem 0.85rem;background:#F4F8F3;border-radius:10px;border:1px solid #DDE5DA;">
        <i data-lucide="${u.icon}" style="width:16px;height:16px;color:var(--color-primary);flex-shrink:0;"></i>
        <span style="font-size:0.85rem;font-weight:600;color:var(--color-text);">${u.text}</span>
      </div>
    `).join('');

    body.innerHTML = `
      <div style="position:relative;border-radius:16px;overflow:hidden;height:205px;margin-bottom:1.25rem;">
        <img src="${data.img}" alt="${data.title}" onerror="this.src='{{ asset('assets/images/waste_market.jpg') }}'" style="width:100%;height:100%;object-fit:cover;">
        <span class="home-partner-badge" style="top:14px;right:14px;background:var(--color-primary);">${data.badge}</span>
      </div>
      
      <h2 style="font-family:var(--font-heading);font-size:1.55rem;font-weight:800;color:var(--color-text);margin-bottom:0.25rem;">${data.title}</h2>
      <p style="font-size:0.86rem;color:var(--color-muted);margin-bottom:1.15rem;">
        <i data-lucide="map-pin" style="width:14px;height:14px;vertical-align:middle;margin-right:2px;color:var(--color-accent);"></i>
        Sumber Penghasil: <strong>${data.source}</strong>
      </p>

      <div style="background:var(--color-sage);border:1px solid var(--color-accent);border-radius:var(--radius-lg);padding:0.85rem 1.15rem;margin-bottom:1.15rem;">
        <strong style="display:block;font-size:0.75rem;text-transform:uppercase;color:var(--color-primary);margin-bottom:0.25rem;letter-spacing:0.5px;">
          Karakteristik & Potensi Kandungan Nutrisi:
        </strong>
        <span style="font-size:0.9rem;font-weight:600;color:var(--color-text);line-height:1.5;">${data.nutrients}</span>
      </div>

      <div style="margin-bottom:1.25rem;">
        <strong style="display:block;font-family:var(--font-heading);font-size:0.9rem;color:var(--color-text);margin-bottom:0.6rem;">
          Potensi Pemanfaatan Kembali:
        </strong>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:0.5rem;">
          ${usesHtml}
        </div>
      </div>

      <div style="background:rgba(217,119,6,0.08);border-left:4px solid #D97706;border-radius:var(--radius-sm);padding:0.85rem 1rem;font-size:0.84rem;color:#92400E;line-height:1.55;margin-bottom:1.25rem;">
        <strong style="display:block;margin-bottom:0.2rem;">Ketentuan Pemilahan & Kualitas:</strong>
        ${data.tips}
      </div>

      <div style="background:#F9FBF8;border:1px solid var(--color-border);border-radius:var(--radius-md);padding:0.75rem 1rem;margin-bottom:1.5rem;font-size:0.85rem;color:var(--color-text);">
        <i data-lucide="handshake" style="width:16px;height:16px;color:var(--color-primary);vertical-align:middle;margin-right:4px;"></i>
        <strong>Mitra Terkait:</strong> ${data.partners}
      </div>

      <div style="display:grid;grid-template-columns:1fr 1fr;gap:0.75rem;margin-top:0.5rem;">
        <button type="button" onclick="closeWasteModal()" class="btn-partner-profile" style="text-align:center;cursor:pointer;border:1.5px solid var(--color-border);background:#fff;font-weight:600;display:flex;align-items:center;justify-content:center;padding:0.65rem 1rem;border-radius:var(--radius-md);color:var(--color-text);transition:all 0.2s ease;">
          Tutup
        </button>
        <a href="${data.linkMitra}" class="btn-all-partners" style="justify-content:center;padding:0.65rem 1rem;font-size:0.9rem;">
          <span>Cari Mitra Penerima</span>
          <i data-lucide="arrow-right" style="width:16px;height:16px;"></i>
        </a>
      </div>
    `;

    modal.classList.add('active');
    lucide.createIcons();
  }

  function closeWasteModal() {
    const modal = document.getElementById('wasteDetailModal');
    if (modal) modal.classList.remove('active');
  }

  // Scroll animations & FAQ accordion
  document.addEventListener('DOMContentLoaded', () => {
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.1, rootMargin: '0px 0px -60px 0px' });

    document.querySelectorAll('.fade-in, .fade-in-left, .fade-in-right').forEach(el => observer.observe(el));

    // FAQ Accordion
    document.querySelectorAll('.faq-question').forEach(btn => {
      btn.addEventListener('click', function () {
        const item = this.closest('.faq-item');
        const isActive = item.classList.contains('active');
        const parentCol = item.closest('.faq-col');
        if (parentCol) {
          parentCol.querySelectorAll('.faq-item').forEach(other => {
            if (other !== item) {
              other.classList.remove('active');
              const otherBtn = other.querySelector('.faq-question');
              if (otherBtn) otherBtn.setAttribute('aria-expanded', 'false');
            }
          });
        }
        item.classList.toggle('active');
        this.setAttribute('aria-expanded', !isActive);
      });
    });

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        const href = this.getAttribute('href');
        if (href === '#' || !href.startsWith('#')) return;
        const target = document.querySelector(href);
        if (target) {
          e.preventDefault();
          const offset = 80;
          const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - offset;
          window.scrollTo({ top: targetPosition, behavior: 'smooth' });
        }
      });
    });
  });
</script>
@endsection
