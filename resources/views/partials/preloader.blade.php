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

    let progress = 15;
    bar.style.width = '15%';
    const startTime = Date.now();
    let isHidden = false;

    // Simulasi progres bertahap yang mulus
    const interval = setInterval(() => {
      if (progress < 85) {
        progress += Math.floor(Math.random() * 10) + 8;
        if (progress > 85) progress = 85;
        bar.style.width = progress + '%';
      }
    }, 100);

    function hidePreloader() {
      if (isHidden) return;
      isHidden = true;
      clearInterval(interval);
      bar.style.width = '100%';

      // Berikan jeda halus agar progress 100% terlihat sejenak
      const elapsed = Date.now() - startTime;
      const remainingWait = Math.max(220, 750 - elapsed);

      setTimeout(() => {
        preloader.classList.add('preloader-hidden');
        setTimeout(() => {
          preloader.style.display = 'none';
        }, 550);
      }, remainingWait);
    }

    // Hilangkan preloader saat seluruh halaman selesai dimuat
    if (document.readyState === 'complete') {
      hidePreloader();
    } else {
      window.addEventListener('load', hidePreloader);
    }

    // Pengaman maksimal agar preloader tidak pernah macet
    setTimeout(hidePreloader, 3200);
  })();
</script>
