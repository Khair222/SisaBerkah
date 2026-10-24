<!-- ========================================================== -->
<!-- SISABERKAH — Premium Preloader / Splash Screen Screen       -->
<!-- ========================================================== -->
<style>
  #sitePreloader {
    position: fixed;
    inset: 0;
    z-index: 999999;
    display: flex;
    align-items: center;
    justify-content: center;
    background: radial-gradient(circle at 50% 40%, #E6F7F0 0%, #D4F3E6 50%, #C3ECDC 100%);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    transition: opacity 0.5s cubic-bezier(0.4, 0, 0.2, 1), transform 0.5s cubic-bezier(0.4, 0, 0.2, 1), visibility 0.5s ease;
  }

  #sitePreloader.preloader-hidden {
    opacity: 0;
    transform: scale(1.03);
    visibility: hidden;
    pointer-events: none;
  }

  .preloader-card {
    background: rgba(255, 255, 255, 0.94);
    border: 1px solid rgba(255, 255, 255, 0.95);
    border-radius: 28px;
    padding: 2.6rem 2.4rem 2.2rem 2.4rem;
    width: 90%;
    max-width: 390px;
    box-shadow: 
      0 24px 50px -10px rgba(16, 185, 129, 0.16),
      0 10px 20px -5px rgba(0, 0, 0, 0.04),
      inset 0 1px 2px rgba(255, 255, 255, 0.9);
    text-align: center;
    animation: preloaderCardPop 0.55s cubic-bezier(0.16, 1, 0.3, 1) forwards;
  }

  @keyframes preloaderCardPop {
    0% {
      opacity: 0;
      transform: scale(0.92) translateY(12px);
    }
    100% {
      opacity: 1;
      transform: scale(1) translateY(0);
    }
  }

  .preloader-icon-wrap {
    position: relative;
    width: 78px;
    height: 78px;
    margin: 0 auto 1.4rem auto;
    border-radius: 50%;
    background: linear-gradient(135deg, #ECFDF5 0%, #D1FAE5 100%);
    border: 2px solid rgba(16, 185, 129, 0.3);
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 
      0 0 0 8px rgba(16, 185, 129, 0.09),
      0 0 0 16px rgba(16, 185, 129, 0.04);
    animation: preloaderPulse 2.4s ease-in-out infinite;
  }

  @keyframes preloaderPulse {
    0%, 100% {
      box-shadow: 
        0 0 0 8px rgba(16, 185, 129, 0.09),
        0 0 0 16px rgba(16, 185, 129, 0.04);
      transform: scale(1);
    }
    50% {
      box-shadow: 
        0 0 0 12px rgba(16, 185, 129, 0.14),
        0 0 0 22px rgba(16, 185, 129, 0.06);
      transform: scale(1.03);
    }
  }

  .preloader-icon-img {
    width: 44px;
    height: 44px;
    object-fit: contain;
    filter: drop-shadow(0 2px 5px rgba(16, 185, 129, 0.25));
    animation: preloaderFloat 3s ease-in-out infinite;
  }

  @keyframes preloaderFloat {
    0%, 100% {
      transform: translateY(0);
    }
    50% {
      transform: translateY(-3px);
    }
  }

  .preloader-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: #064E3B;
    margin: 0 0 0.45rem 0;
    letter-spacing: -0.01em;
    font-family: inherit;
  }

  .preloader-desc {
    font-size: 0.85rem;
    color: #4B5563;
    line-height: 1.5;
    margin: 0 0 1.85rem 0;
    padding: 0 0.5rem;
    font-family: inherit;
  }

  /* Progress Bar Track */
  .preloader-progress-track {
    width: 100%;
    height: 5px;
    background: rgba(16, 185, 129, 0.16);
    border-radius: 9999px;
    position: relative;
    overflow: visible;
  }

  /* Progress Bar Fill */
  .preloader-progress-bar {
    width: 0%;
    height: 100%;
    background: linear-gradient(90deg, #10B981 0%, #059669 100%);
    border-radius: 9999px;
    transition: width 0.25s ease-out;
    position: relative;
  }

  /* Glowing dot at the head of progress bar */
  .preloader-progress-bar::after {
    content: '';
    position: absolute;
    right: -4px;
    top: 50%;
    transform: translateY(-50%);
    width: 9px;
    height: 9px;
    border-radius: 50%;
    background: #047857;
    box-shadow: 0 0 8px rgba(16, 185, 129, 0.9);
  }

  /* ================= MOBILE RESPONSIVE PRELOADER ================= */
  @media (max-width: 640px) {
    #sitePreloader {
      padding: 1.25rem 1rem;
    }

    .preloader-card {
      width: 100%;
      max-width: 320px;
      padding: 1.75rem 1.25rem 1.5rem;
      border-radius: 22px;
      box-shadow: 
        0 18px 40px -8px rgba(16, 185, 129, 0.22),
        0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .preloader-icon-wrap {
      width: 64px;
      height: 64px;
      margin: 0 auto 1.1rem auto;
      box-shadow: 
        0 0 0 6px rgba(16, 185, 129, 0.1),
        0 0 0 12px rgba(16, 185, 129, 0.04);
    }

    .preloader-icon-img {
      width: 34px;
      height: 34px;
    }

    .preloader-title {
      font-size: 1.15rem;
      margin-bottom: 0.35rem;
    }

    .preloader-desc {
      font-size: 0.82rem;
      line-height: 1.45;
      margin-bottom: 1.35rem;
      padding: 0;
    }

    .preloader-progress-track {
      height: 4px;
    }
  }

  @media (max-width: 360px) {
    .preloader-card {
      padding: 1.4rem 1rem 1.25rem;
      border-radius: 18px;
      max-width: 290px;
    }

    .preloader-icon-wrap {
      width: 54px;
      height: 54px;
      margin-bottom: 0.85rem;
    }

    .preloader-icon-img {
      width: 28px;
      height: 28px;
    }

    .preloader-title {
      font-size: 1.05rem;
    }

    .preloader-desc {
      font-size: 0.76rem;
      margin-bottom: 1.15rem;
    }
  }
</style>

<div id="sitePreloader" role="dialog" aria-modal="true" aria-label="Memuat SisaBerkah">
  <div class="preloader-card">
    <div class="preloader-icon-wrap">
      <img src="{{ asset('assets/images/logo-icon.png') }}" alt="Logo SisaBerkah" class="preloader-icon-img" onerror="this.src='{{ asset('assets/images/logo.png') }}'">
    </div>

    <h2 class="preloader-title">Memuat SisaBerkah</h2>
    <p class="preloader-desc">Menyiapkan katalog mitra, AI scanner, dan ekonomi sirkular.</p>

    <div class="preloader-progress-track">
      <div class="preloader-progress-bar" id="preloaderBar"></div>
    </div>
  </div>
</div>

<script>
  (function () {
    const preloader = document.getElementById('sitePreloader');
    const bar = document.getElementById('preloaderBar');
    if (!preloader || !bar) return;

    let progress = 20;
    bar.style.width = '20%';
    const startTime = Date.now();
    let isHidden = false;

    // Simulasi progres bertahap yang mulus & cepat
    const interval = setInterval(() => {
      if (progress < 88) {
        progress += Math.floor(Math.random() * 14) + 10;
        if (progress > 88) progress = 88;
        bar.style.width = progress + '%';
      }
    }, 70);

    function hidePreloader() {
      if (isHidden) return;
      isHidden = true;
      clearInterval(interval);
      bar.style.width = '100%';

      // Jeda halus ramah mobile (cepat dan tidak membebani ponsel)
      const elapsed = Date.now() - startTime;
      const remainingWait = Math.max(100, 380 - elapsed);

      setTimeout(() => {
        preloader.classList.add('preloader-hidden');
        setTimeout(() => {
          preloader.style.display = 'none';
        }, 400);
      }, remainingWait);
    }

    // Hilangkan preloader saat seluruh halaman selesai dimuat
    if (document.readyState === 'complete') {
      hidePreloader();
    } else {
      window.addEventListener('load', hidePreloader);
    }

    // Touch-to-dismiss darurat: ketuk layar untuk lewati jika koneksi HP melambat
    preloader.addEventListener('click', function() {
      hidePreloader();
    });

    // Pengaman maksimal agar preloader tidak pernah macet di HP
    setTimeout(hidePreloader, 2200);
  })();
</script>
