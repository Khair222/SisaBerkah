@extends('layouts.app')

@section('title', 'AI Smart Waste Scanner — Deteksi & Cara Mengatasi Limbah Otomatis | SISABERKAH')
@section('meta_description', 'Pindai sisa makanan dan limbah organik Anda menggunakan teknologi AI Computer Vision. Dapatkan panduan cara mengatasi, edukasi pemilahan, dan rekomendasi mitra penampung terdekat.')

@section('styles')
<style>
  :root {
    --scanner-primary: #10B981;
    --scanner-dark: #064E3B;
    --scanner-bg-light: #F0FDF4;
    --scanner-border: rgba(16, 185, 129, 0.2);
  }

  .scanner-page {
    background: linear-gradient(180deg, #F9FAF7 0%, #F0F5EE 100%);
    padding: 3.5rem 0 5rem;
    min-height: 85vh;
  }

  /* Hero Section */
  .scanner-hero {
    text-align: center;
    max-width: 820px;
    margin: 0 auto 3rem;
  }

  .scanner-badge-pill {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: rgba(16, 185, 129, 0.12);
    color: #065F46;
    border: 1px solid rgba(16, 185, 129, 0.3);
    padding: 0.35rem 0.95rem;
    border-radius: 9999px;
    font-size: 0.8rem;
    font-weight: 700;
    letter-spacing: 0.5px;
    margin-bottom: 1rem;
    text-transform: uppercase;
  }

  .scanner-hero h1 {
    font-size: 2.5rem;
    font-weight: 800;
    color: #132E20;
    line-height: 1.25;
    margin-bottom: 1rem;
  }

  .scanner-hero h1 span {
    background: linear-gradient(135deg, #059669, #10B981);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }

  .scanner-hero p {
    font-size: 1.05rem;
    color: #4B6354;
    line-height: 1.65;
    margin-bottom: 0;
  }

  /* Main Scanner Card */
  .scanner-card {
    background: #FFFFFF;
    border-radius: 24px;
    border: 1px solid rgba(0, 0, 0, 0.07);
    box-shadow: 0 12px 35px rgba(19, 46, 32, 0.08);
    overflow: hidden;
    margin-bottom: 3rem;
  }

  /* Tab Navigation */
  .scanner-tabs {
    display: flex;
    background: #F4F6F2;
    border-bottom: 1px solid rgba(0,0,0,0.06);
    padding: 0.5rem;
    gap: 0.5rem;
  }

  .scanner-tab-btn {
    flex: 1;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.55rem;
    padding: 0.85rem 1.25rem;
    border: none;
    background: transparent;
    border-radius: 14px;
    font-weight: 700;
    font-size: 0.95rem;
    color: #4B6354;
    cursor: pointer;
    transition: all 0.25s ease;
  }

  .scanner-tab-btn.active {
    background: #FFFFFF;
    color: #065F46;
    box-shadow: 0 4px 12px rgba(0,0,0,0.06);
  }

  .scanner-tab-btn:hover:not(.active) {
    background: rgba(255, 255, 255, 0.5);
    color: #132E20;
  }

  /* Tab Content Panels */
  .scanner-panel {
    display: none;
    padding: 2.25rem;
  }

  .scanner-panel.active {
    display: block;
  }

  /* Camera Container */
  .camera-box {
    position: relative;
    max-width: 640px;
    margin: 0 auto;
    border-radius: 18px;
    overflow: hidden;
    background: #0D1A13;
    aspect-ratio: 4 / 3;
    box-shadow: 0 8px 24px rgba(0,0,0,0.25);
  }

  #cameraVideo {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
  }

  .camera-viewfinder {
    position: absolute;
    inset: 15%;
    border: 2px dashed rgba(34, 197, 94, 0.8);
    border-radius: 16px;
    pointer-events: none;
    box-shadow: 0 0 0 9999px rgba(0, 0, 0, 0.35);
  }

  .camera-viewfinder::before,
  .camera-viewfinder::after {
    content: '';
    position: absolute;
    width: 22px;
    height: 22px;
    border-color: #22C55E;
    border-style: solid;
  }

  .camera-viewfinder::before {
    top: -2px;
    left: -2px;
    border-width: 4px 0 0 4px;
  }

  .camera-viewfinder::after {
    bottom: -2px;
    right: -2px;
    border-width: 0 4px 4px 0;
  }

  .camera-actions {
    display: flex;
    justify-content: center;
    gap: 1rem;
    margin-top: 1.5rem;
  }

  .btn-camera-capture {
    background: linear-gradient(135deg, #10B981, #059669);
    color: #FFFFFF;
    border: none;
    padding: 0.85rem 1.8rem;
    border-radius: 9999px;
    font-weight: 700;
    font-size: 1rem;
    display: inline-flex;
    align-items: center;
    gap: 0.6rem;
    cursor: pointer;
    box-shadow: 0 6px 18px rgba(16, 185, 129, 0.35);
    transition: all 0.25s ease;
  }

  .btn-camera-capture:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(16, 185, 129, 0.45);
  }

  /* File Dropzone */
  .upload-dropzone {
    border: 2px dashed #93C5AA;
    background: #F8FAF7;
    border-radius: 20px;
    padding: 3.5rem 2rem;
    text-align: center;
    cursor: pointer;
    transition: all 0.25s ease;
    max-width: 680px;
    margin: 0 auto;
  }

  .upload-dropzone:hover,
  .upload-dropzone.dragover {
    border-color: #10B981;
    background: #F0FDF4;
    transform: scale(1.01);
  }

  .dropzone-icon {
    width: 68px;
    height: 68px;
    border-radius: 50%;
    background: rgba(16, 185, 129, 0.12);
    color: #059669;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1.25rem;
  }

  .dropzone-title {
    font-size: 1.25rem;
    font-weight: 800;
    color: #132E20;
    margin-bottom: 0.4rem;
  }

  .dropzone-subtitle {
    font-size: 0.92rem;
    color: #557262;
    margin-bottom: 1.25rem;
  }

  .btn-browse {
    background: #132E20;
    color: #FFFFFF;
    padding: 0.7rem 1.5rem;
    border-radius: 9999px;
    font-size: 0.9rem;
    font-weight: 700;
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    border: none;
    cursor: pointer;
    transition: all 0.2s;
  }

  .btn-browse:hover {
    background: #059669;
  }

  /* Demo Samples Grid */
  .samples-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
    gap: 1.25rem;
    max-width: 960px;
    margin: 0 auto;
  }

  .sample-card {
    background: #FFFFFF;
    border: 1px solid rgba(0,0,0,0.08);
    border-radius: 16px;
    overflow: hidden;
    cursor: pointer;
    transition: all 0.25s ease;
    text-align: left;
    box-shadow: 0 4px 12px rgba(0,0,0,0.03);
  }

  .sample-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 24px rgba(16, 185, 129, 0.18);
    border-color: #10B981;
  }

  .sample-img-wrap {
    height: 130px;
    width: 100%;
    overflow: hidden;
    background: #E5E7EB;
  }

  .sample-img-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
  }

  .sample-card:hover .sample-img-wrap img {
    transform: scale(1.08);
  }

  .sample-info {
    padding: 0.95rem;
  }

  .sample-tag {
    font-size: 0.7rem;
    font-weight: 800;
    text-transform: uppercase;
    color: #059669;
    letter-spacing: 0.5px;
    margin-bottom: 0.25rem;
    display: block;
  }

  .sample-title {
    font-size: 0.92rem;
    font-weight: 700;
    color: #132E20;
    margin: 0 0 0.5rem;
    line-height: 1.3;
  }

  .sample-action {
    display: flex;
    align-items: center;
    gap: 0.35rem;
    color: #059669;
    font-size: 0.8rem;
    font-weight: 700;
  }

  /* Scanning State Overlay */
  .scanning-overlay {
    display: none;
    text-align: center;
    padding: 4rem 2rem;
  }

  .scanning-preview-box {
    position: relative;
    width: 280px;
    height: 280px;
    border-radius: 20px;
    overflow: hidden;
    margin: 0 auto 2rem;
    box-shadow: 0 12px 30px rgba(0,0,0,0.2);
    border: 3px solid #10B981;
  }

  .scanning-preview-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .laser-line {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: #10B981;
    box-shadow: 0 0 16px #10B981, 0 0 30px rgba(34, 197, 94, 0.8);
    animation: laserScan 2s infinite ease-in-out alternate;
  }

  @keyframes laserScan {
    0% { top: 0%; }
    100% { top: calc(100% - 4px); }
  }

  .scanning-pulse {
    display: inline-flex;
    align-items: center;
    gap: 0.6rem;
    background: #ECFDF5;
    color: #065F46;
    padding: 0.6rem 1.4rem;
    border-radius: 9999px;
    font-size: 0.95rem;
    font-weight: 700;
    margin-bottom: 0.75rem;
  }

  .pulse-dot {
    width: 10px;
    height: 10px;
    background: #10B981;
    border-radius: 50%;
    box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
    animation: pulse 1.5s infinite;
  }

  @keyframes pulse {
    0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); }
    70% { transform: scale(1); box-shadow: 0 0 0 10px rgba(16, 185, 129, 0); }
    100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
  }

  .scanning-step-text {
    font-size: 0.9rem;
    color: #557262;
    font-style: italic;
  }

  /* ================= RESULT SECTION ================= */
  .result-section {
    display: none;
    animation: fadeIn 0.4s ease-out;
  }

  @keyframes fadeIn {
    from { opacity: 0; transform: translateY(12px); }
    to { opacity: 1; transform: translateY(0); }
  }

  /* Result Summary Hero Card */
  .result-hero-card {
    background: #FFFFFF;
    border-radius: 20px;
    padding: 2rem;
    border: 1px solid rgba(0,0,0,0.07);
    box-shadow: 0 8px 25px rgba(0,0,0,0.05);
    margin-bottom: 2rem;
    display: grid;
    grid-template-columns: 200px 1fr;
    gap: 2rem;
    align-items: center;
  }

  @media (max-width: 768px) {
    .result-hero-card {
      grid-template-columns: 1fr;
      text-align: center;
    }
  }

  .result-img-box {
    position: relative;
    width: 100%;
    aspect-ratio: 1;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 6px 18px rgba(0,0,0,0.1);
  }

  .result-img-box img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .result-confidence-badge {
    position: absolute;
    bottom: 8px;
    right: 8px;
    background: rgba(19, 46, 32, 0.85);
    backdrop-filter: blur(4px);
    color: #22C55E;
    font-size: 0.72rem;
    font-weight: 800;
    padding: 0.25rem 0.6rem;
    border-radius: 8px;
    border: 1px solid rgba(34, 197, 94, 0.3);
  }

  .result-hero-title {
    font-size: 1.85rem;
    font-weight: 800;
    color: #132E20;
    margin: 0 0 0.5rem;
  }

  .result-hero-desc {
    color: #4B6354;
    font-size: 0.98rem;
    line-height: 1.6;
    margin-bottom: 1.5rem;
  }

  .result-metrics-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(130px, 1fr));
    gap: 0.75rem;
  }

  .metric-badge {
    background: #F4F7F4;
    border: 1px solid rgba(0,0,0,0.05);
    padding: 0.75rem 1rem;
    border-radius: 12px;
  }

  .metric-label {
    font-size: 0.72rem;
    color: #557262;
    text-transform: uppercase;
    font-weight: 700;
    margin-bottom: 0.2rem;
    display: block;
  }

  .metric-val {
    font-size: 0.95rem;
    font-weight: 800;
    color: #132E20;
  }

  /* Two Column Grid for Cards */
  .result-cards-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.75rem;
    margin-bottom: 2rem;
  }

  @media (max-width: 992px) {
    .result-cards-grid {
      grid-template-columns: 1fr;
    }
  }

  .result-box-card {
    background: #FFFFFF;
    border-radius: 20px;
    border: 1px solid rgba(0,0,0,0.07);
    padding: 1.85rem;
    box-shadow: 0 8px 24px rgba(0,0,0,0.04);
  }

  .card-header-flex {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 1.25rem;
    border-bottom: 1px solid #F0F2EE;
    padding-bottom: 0.85rem;
  }

  .card-header-flex h3 {
    font-size: 1.25rem;
    font-weight: 800;
    color: #132E20;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 0.5rem;
  }

  /* Composition Bars */
  .comp-item {
    margin-bottom: 1.15rem;
  }

  .comp-item-header {
    display: flex;
    justify-content: space-between;
    font-size: 0.9rem;
    font-weight: 700;
    color: #132E20;
    margin-bottom: 0.4rem;
  }

  .comp-bar-bg {
    height: 10px;
    background: #E5E7EB;
    border-radius: 9999px;
    overflow: hidden;
  }

  .comp-bar-fill {
    height: 100%;
    border-radius: 9999px;
    transition: width 0.8s ease;
  }

  /* Suitability Cards */
  .suitability-list {
    display: flex;
    flex-direction: column;
    gap: 0.9rem;
  }

  .suit-card {
    border: 1px solid #E5E7EB;
    border-radius: 14px;
    padding: 1rem;
    transition: all 0.2s;
  }

  .suit-card.suit-yes {
    background: #F0FDF4;
    border-color: #86EFAC;
  }

  .suit-card.suit-no {
    background: #FFFBEB;
    border-color: #FDE68A;
  }

  .suit-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 0.35rem;
  }

  .suit-title {
    font-weight: 800;
    font-size: 0.95rem;
    color: #132E20;
  }

  .suit-badge {
    font-size: 0.72rem;
    font-weight: 800;
    padding: 0.2rem 0.6rem;
    border-radius: 9999px;
  }

  .suit-badge.yes {
    background: #22C55E;
    color: #04140D;
  }

  .suit-badge.warn {
    background: #F59E0B;
    color: #FFFFFF;
  }

  .suit-desc {
    font-size: 0.85rem;
    color: #4B6354;
    line-height: 1.5;
    margin: 0;
  }

  /* ================= FEATURED: CARA MENGATASI LIMBAH TERSEBUT ================= */
  .handling-guide-card {
    background: #FFFFFF;
    border-radius: 20px;
    border: 2px solid #10B981;
    padding: 2rem;
    box-shadow: 0 12px 35px rgba(16, 185, 129, 0.1);
    margin-bottom: 2rem;
  }

  .handling-guide-card .guide-title-wrap {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1.5rem;
  }

  .guide-icon-badge {
    width: 44px;
    height: 44px;
    background: rgba(16, 185, 129, 0.15);
    color: #059669;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .handling-guide-card h2 {
    font-size: 1.5rem;
    font-weight: 800;
    color: #132E20;
    margin: 0;
  }

  /* Steps List */
  .handling-steps-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    margin-bottom: 1.75rem;
  }

  .handling-step-item {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    background: #F8FAF7;
    border-radius: 14px;
    padding: 1rem 1.25rem;
    border-left: 4px solid #10B981;
  }

  .step-number {
    width: 28px;
    height: 28px;
    background: #10B981;
    color: #FFFFFF;
    font-weight: 800;
    font-size: 0.85rem;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }

  .step-text {
    font-size: 0.94rem;
    color: #1F2937;
    line-height: 1.5;
    margin: 0;
  }

  /* Warning & Upcycle Boxes */
  .guide-alert-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.25rem;
  }

  @media (max-width: 768px) {
    .guide-alert-grid {
      grid-template-columns: 1fr;
    }
  }

  .alert-box-burn {
    background: #FEF2F2;
    border: 1px solid #FCA5A5;
    border-radius: 14px;
    padding: 1.25rem;
  }

  .alert-box-burn h4 {
    font-size: 0.98rem;
    font-weight: 800;
    color: #B91C1C;
    margin: 0 0 0.4rem;
    display: flex;
    align-items: center;
    gap: 0.4rem;
  }

  .alert-box-burn p {
    font-size: 0.85rem;
    color: #7F1D1D;
    line-height: 1.55;
    margin: 0;
  }

  .alert-box-upcycle {
    background: #F0FDF4;
    border: 1px solid #86EFAC;
    border-radius: 14px;
    padding: 1.25rem;
  }

  .alert-box-upcycle h4 {
    font-size: 0.98rem;
    font-weight: 800;
    color: #047857;
    margin: 0 0 0.4rem;
    display: flex;
    align-items: center;
    gap: 0.4rem;
  }

  .alert-box-upcycle p {
    font-size: 0.85rem;
    color: #064E3B;
    line-height: 1.55;
    margin: 0;
  }

  /* Mitra Recommendations */
  .mitra-cards-wrap {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.25rem;
    margin-top: 1.25rem;
  }

  .scanner-mitra-card {
    background: #FFFFFF;
    border: 1px solid rgba(0,0,0,0.08);
    border-radius: 16px;
    padding: 1.25rem;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    transition: all 0.25s;
    box-shadow: 0 4px 14px rgba(0,0,0,0.03);
  }

  .scanner-mitra-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 24px rgba(0,0,0,0.08);
    border-color: #10B981;
  }

  .mitra-card-top {
    display: flex;
    gap: 1rem;
    margin-bottom: 0.9rem;
  }

  .mitra-thumb {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    object-fit: cover;
    flex-shrink: 0;
    background: #E5E7EB;
  }

  .mitra-name {
    font-size: 1rem;
    font-weight: 800;
    color: #132E20;
    margin: 0 0 0.2rem;
  }

  .mitra-category-pill {
    display: inline-block;
    font-size: 0.72rem;
    font-weight: 700;
    background: #ECFDF5;
    color: #059669;
    padding: 0.15rem 0.5rem;
    border-radius: 9999px;
    margin-bottom: 0.35rem;
  }

  .mitra-loc {
    font-size: 0.8rem;
    color: #557262;
    display: flex;
    align-items: center;
    gap: 0.25rem;
  }

  .mitra-needs-box {
    background: #F9FAF7;
    border-radius: 10px;
    padding: 0.65rem 0.85rem;
    font-size: 0.8rem;
    color: #4B6354;
    margin-bottom: 1rem;
    line-height: 1.45;
  }

  .mitra-btn-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0.5rem;
  }

  .btn-wa-direct {
    background: #25D366;
    color: #FFFFFF;
    text-decoration: none;
    font-weight: 700;
    font-size: 0.82rem;
    padding: 0.55rem;
    border-radius: 10px;
    text-align: center;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.35rem;
    transition: all 0.2s;
  }

  .btn-wa-direct:hover {
    background: #1EBE5D;
    color: #FFFFFF;
  }

  .btn-profile-direct {
    background: #F3F4F6;
    color: #1F2937;
    text-decoration: none;
    font-weight: 700;
    font-size: 0.82rem;
    padding: 0.55rem;
    border-radius: 10px;
    text-align: center;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s;
  }

  .btn-profile-direct:hover {
    background: #E5E7EB;
  }

  /* Impact & Action Bar */
  .impact-banner {
    background: linear-gradient(135deg, #064E3B 0%, #132E20 100%);
    border-radius: 18px;
    padding: 1.5rem 2rem;
    color: #FFFFFF;
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 2rem;
    flex-wrap: wrap;
    gap: 1.25rem;
  }

  .impact-title {
    font-size: 1.15rem;
    font-weight: 800;
    margin: 0 0 0.25rem;
    color: #86EFAC;
  }

  .impact-desc {
    font-size: 0.9rem;
    color: rgba(255, 255, 255, 0.8);
    margin: 0;
  }

  .impact-stat-pill {
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    padding: 0.6rem 1.25rem;
    border-radius: 12px;
    text-align: right;
  }

  .impact-stat-val {
    font-size: 1.35rem;
    font-weight: 800;
    color: #34D399;
  }

  .impact-stat-lbl {
    font-size: 0.72rem;
    text-transform: uppercase;
    color: rgba(255, 255, 255, 0.7);
  }

  .action-buttons-wrap {
    display: flex;
    justify-content: center;
    gap: 1rem;
    margin-top: 2rem;
    flex-wrap: wrap;
  }

  .btn-scan-again {
    background: #132E20;
    color: #FFFFFF;
    padding: 0.85rem 2rem;
    border-radius: 9999px;
    font-weight: 700;
    font-size: 0.95rem;
    border: none;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.2s;
  }

  .btn-scan-again:hover {
    background: #059669;
    transform: translateY(-2px);
  }

  .btn-print-summary {
    background: #FFFFFF;
    color: #132E20;
    border: 1px solid #D1D5DB;
    padding: 0.85rem 1.8rem;
    border-radius: 9999px;
    font-weight: 700;
    font-size: 0.95rem;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.2s;
  }

  .btn-print-summary:hover {
    background: #F9FAFB;
    border-color: #9CA3AF;
  }

  @media (max-width: 768px) {
    .scanner-page {
      padding: 1.75rem 0 3.5rem;
    }

    .scanner-hero {
      margin-bottom: 1.75rem;
    }

    .scanner-hero h1 {
      font-size: 1.65rem;
      line-height: 1.25;
      margin-bottom: 0.75rem;
    }

    .scanner-hero p {
      font-size: 0.88rem;
      line-height: 1.5;
    }

    .scanner-card {
      border-radius: 18px;
      margin-bottom: 2rem;
    }

    .scanner-tabs {
      gap: 0.35rem;
      padding: 0.35rem;
    }

    .scanner-tab-btn {
      padding: 0.65rem 0.75rem;
      font-size: 0.82rem;
      border-radius: 10px;
    }

    .camera-box {
      border-radius: 14px;
      max-height: 320px;
    }

    .camera-actions {
      flex-direction: column;
      width: 100%;
      gap: 0.65rem;
    }

    .btn-camera-capture,
    .btn-browse {
      width: 100%;
      justify-content: center;
      padding: 0.75rem 1rem;
      box-sizing: border-box;
    }

    .upload-dropzone {
      min-height: 200px;
      border-radius: 14px;
      padding: 1.5rem 1rem;
    }

    .dropzone-title {
      font-size: 1rem;
    }

    .dropzone-subtitle {
      font-size: 0.78rem;
    }

    /* Scanning / Loading laser animation on mobile */
    .scanning-overlay {
      padding: 2rem 1rem;
    }

    .scanning-preview-box {
      width: min(240px, 75vw);
      height: min(240px, 75vw);
      border-radius: 16px;
      margin-bottom: 1.35rem;
    }

    .scanning-pulse {
      font-size: 0.82rem;
      padding: 0.45rem 1rem;
    }

    .scanning-step-text {
      font-size: 0.8rem;
    }

    .result-hero-card {
      grid-template-columns: 1fr;
      padding: 1.25rem 1rem;
      border-radius: 16px;
      gap: 1.25rem;
    }

    .result-img-box {
      max-width: 200px;
      margin: 0 auto;
    }

    .suit-grid {
      grid-template-columns: 1fr;
      gap: 0.75rem;
    }

    .handling-guide-card {
      padding: 1.35rem 1rem;
      border-radius: 16px;
    }

    .handling-guide-card h2 {
      font-size: 1.25rem;
    }

    .handling-step-item {
      padding: 0.85rem 1rem;
      gap: 0.75rem;
    }

    .mitra-cards-wrap {
      grid-template-columns: 1fr;
      gap: 0.85rem;
    }

    .scanner-mitra-card {
      padding: 1rem;
      border-radius: 14px;
    }

    .mitra-btn-grid {
      grid-template-columns: 1fr;
      gap: 0.45rem;
    }

    .btn-wa-direct,
    .btn-profile-direct {
      width: 100%;
      padding: 0.65rem;
      box-sizing: border-box;
    }

    .impact-banner {
      padding: 1.25rem 1rem;
      flex-direction: column;
      text-align: center;
      border-radius: 14px;
      gap: 0.85rem;
    }

    .impact-stat-pill {
      width: 100%;
      text-align: center;
      box-sizing: border-box;
    }

    .action-buttons-wrap {
      flex-direction: column;
      width: 100%;
      gap: 0.65rem;
    }

    .btn-scan-again,
    .btn-print-summary {
      width: 100%;
      justify-content: center;
      box-sizing: border-box;
      padding: 0.8rem 1.25rem;
    }
  }

  @media (max-width: 480px) {
    .scanner-hero h1 {
      font-size: 1.45rem;
    }

    .scanner-badge-pill {
      font-size: 0.72rem;
      padding: 0.28rem 0.75rem;
    }
  }
</style>
@endsection

@section('content')
<div class="scanner-page">
  <div class="container">

    <!-- HERO HEADER -->
    <div class="scanner-hero">
      <div class="scanner-badge-pill">
        <i data-lucide="sparkles" style="width:14px;height:14px;color:#10B981;"></i>
        <span>AI Computer Vision — SisaBerkah</span>
      </div>
      <h1>AI Smart Waste Scanner: <span>Deteksi &amp; Solusi Otomatis</span></h1>
      <p>
        Arahkan kamera atau unggah foto sisa makanan Anda. AI akan menganalisis komponen, memberikan panduan <strong>Cara Mengatasi Limbah Tersebut</strong>, mengedukasi larangan membakar, serta mencocokkan mitra penampung terdekat secara instan.
      </p>
    </div>

    <!-- MAIN SCANNER CARD -->
    <div class="scanner-card" id="scannerInputCard">
      <!-- TABS -->
      <div class="scanner-tabs">
        <button type="button" class="scanner-tab-btn active" onclick="switchScannerTab('camera')">
          <i data-lucide="camera" style="width:18px;height:18px;"></i>
          <span>Kamera Langsung</span>
        </button>
        <button type="button" class="scanner-tab-btn" onclick="switchScannerTab('upload')">
          <i data-lucide="upload-cloud" style="width:18px;height:18px;"></i>
          <span>Unggah Foto File</span>
        </button>
      </div>

      <!-- PANEL 1: KAMERA LANGSUNG -->
      <div class="scanner-panel active" id="panelCamera">
        <div class="camera-box">
          <video id="cameraVideo" autoplay playsinline muted></video>
          <div class="camera-viewfinder"></div>
        </div>
        <canvas id="cameraCanvas" style="display:none;"></canvas>

        <div class="camera-actions">
          <button type="button" class="btn-camera-capture" id="btnCapturePhoto" onclick="captureAndAnalyze()">
            <i data-lucide="aperture" style="width:20px;height:20px;"></i>
            <span>Pindai Foto Sekarang</span>
          </button>
          <button type="button" class="btn-browse" onclick="toggleCameraStream()" id="btnToggleCam" title="Nyalakan / Ganti Kamera">
            <i data-lucide="refresh-cw" style="width:16px;height:16px;"></i>
            <span>Ganti Kamera</span>
          </button>
        </div>
      </div>

      <!-- PANEL 2: UNGGAH FOTO FILE -->
      <div class="scanner-panel" id="panelUpload">
        <form id="uploadForm" enctype="multipart/form-data">
          @csrf
          <input type="file" id="wasteFileInput" name="image" accept="image/*" style="display:none;" onchange="handleFileSelected(this)">
          <div class="upload-dropzone" id="dropzoneBox" onclick="document.getElementById('wasteFileInput').click()">
            <div class="dropzone-icon">
              <i data-lucide="image-plus" style="width:34px;height:34px;"></i>
            </div>
            <h3 class="dropzone-title">Seret &amp; Lepaskan Foto Sisa Makanan ke Sini</h3>
            <p class="dropzone-subtitle">Mendukung format JPG, PNG, WEBP (Maksimal 8MB)</p>
            <button type="button" class="btn-browse" onclick="event.stopPropagation(); document.getElementById('wasteFileInput').click()">
              <i data-lucide="folder-open" style="width:16px;height:16px;"></i>
              <span>Pilih Dari Perangkat</span>
            </button>
          </div>
        </form>
      </div>

      <!-- SCANNING OVERLAY (LASER RADAR ANIMATION) -->
      <div class="scanning-overlay" id="scanningOverlay">
        <div class="scanning-preview-box">
          <img src="" id="scanningPreviewImg" class="scanning-preview-img" alt="Scanning Preview">
          <div class="laser-line"></div>
        </div>
        <div class="scanning-pulse">
          <div class="pulse-dot"></div>
          <span id="scanStatusTitle">AI Sedang Memindai Citra Limbah...</span>
        </div>
        <p class="scanning-step-text" id="scanStatusSubtitle">Mendeteksi tekstur, kadar air, dan estimasi rasio C:N bahan organik...</p>
      </div>
    </div>

    <!-- ================= RESULT SECTION ================= -->
    <div class="result-section" id="resultSection">

      <!-- RESULT HERO CARD -->
      <div class="result-hero-card">
        <div class="result-img-box">
          <img src="" id="resImage" alt="Hasil Pindai">
          <div class="result-confidence-badge" id="resConfidence">Akurasi: 96%</div>
        </div>
        <div>
          <span style="font-size:0.75rem;font-weight:800;color:#059669;text-transform:uppercase;letter-spacing:0.8px;">HASIL ANALISIS AI COMPUTER VISION</span>
          <h2 class="result-hero-title" id="resWasteName">Limbah Organik Campuran Sayuran &amp; Buah</h2>
          <p class="result-hero-desc" id="resSummary">Memuat ringkasan hasil analisis...</p>

          <div class="result-metrics-grid">
            <div class="metric-badge">
              <span class="metric-label">💧 Kadar Air</span>
              <span class="metric-val" id="resMoisture">Sedang (62%)</span>
            </div>
            <div class="metric-badge">
              <span class="metric-label">🌿 Kesegaran</span>
              <span class="metric-val" id="resFreshness">Segar / Layu</span>
            </div>
            <div class="metric-badge">
              <span class="metric-label">⭐ Kelayakan</span>
              <span class="metric-val" id="resFeasibility" style="color:#059669;">95% Sangat Layak</span>
            </div>
            <div class="metric-badge">
              <span class="metric-label">👃 Potensi Bau</span>
              <span class="metric-val" id="resOdor">Rendah</span>
            </div>
          </div>
        </div>
      </div>

      <!-- TWO COLUMNS: COMPOSITION & SUITABILITY -->
      <div class="result-cards-grid">
        <!-- CARD 1: KOMPOSISI DETEKSI BAHAN -->
        <div class="result-box-card">
          <div class="card-header-flex">
            <h3>
              <i data-lucide="pie-chart" style="width:20px;height:20px;color:#10B981;"></i>
              <span>Komposisi Terdeteksi</span>
            </h3>
            <span style="font-size:0.8rem;color:#557262;font-weight:600;">Deteksi Multi-Objek</span>
          </div>

          <div id="compositionBarsList">
            <!-- Populated via JS -->
          </div>
        </div>

        <!-- CARD 2: KELAYAKAN PEMANFAATAN -->
        <div class="result-box-card">
          <div class="card-header-flex">
            <h3>
              <i data-lucide="check-circle" style="width:20px;height:20px;color:#10B981;"></i>
              <span>Kategori Pemanfaatan</span>
            </h3>
            <span style="font-size:0.8rem;color:#557262;font-weight:600;">Peluang Daur Ulang</span>
          </div>

          <div class="suitability-list" id="suitabilityList">
            <!-- Populated via JS -->
          </div>
        </div>
      </div>

      <!-- CARD 3: 🛠️ FEATURED: CARA MENGATASI LIMBAH TERSEBUT -->
      <div class="handling-guide-card">
        <div class="guide-title-wrap">
          <div class="guide-icon-badge">
            <i data-lucide="wrench" style="width:24px;height:24px;"></i>
          </div>
          <div>
            <span style="font-size:0.75rem;font-weight:800;color:#059669;text-transform:uppercase;letter-spacing:0.8px;">PANDUAN SOLUSI PRAKTIS</span>
            <h2>Cara Mengatasi Limbah Tersebut</h2>
          </div>
        </div>

        <!-- Actionable Steps -->
        <div class="handling-steps-list" id="handlingStepsList">
          <!-- Populated via JS -->
        </div>

        <!-- Grid Alerts: Upcycle vs Burn Warning -->
        <div class="guide-alert-grid">
          <!-- Upcycle / Kerajinan -->
          <div class="alert-box-upcycle">
            <h4 id="upcycleTitle">
              <i data-lucide="sparkles" style="width:18px;height:18px;"></i>
              <span>Potensi Kerajinan / Olahan Lain</span>
            </h4>
            <p id="upcycleDesc">Memuat informasi pemanfaatan kreatif...</p>
          </div>

          <!-- Dilarang Dibakar -->
          <div class="alert-box-burn">
            <h4 id="burnWarningTitle">
              <i data-lucide="alert-triangle" style="width:18px;height:18px;"></i>
              <span>Apakah Boleh Dibakar? DILARANG KERAS!</span>
            </h4>
            <p id="burnWarningReason">Membakar sampah organik basah menghasilkan asap pekat beracun dan emisi gas rumah kaca berbahaya.</p>
          </div>
        </div>

        <div style="margin-top:1.25rem;background:#F0FDF4;border-radius:12px;padding:0.9rem 1.25rem;border:1px dashed #86EFAC;display:flex;align-items:center;gap:0.75rem;">
          <i data-lucide="package-check" style="width:20px;height:20px;color:#059669;flex-shrink:0;"></i>
          <span style="font-size:0.88rem;color:#065F46;" id="storageTipsText">
            Tips Penyimpanan: Tiriskan air berlebih dan simpan di wadah berpenutup rapat sebelum diserahkan ke mitra.
          </span>
        </div>
      </div>

      <!-- CARD 4: REKOMENDASI MITRA PENAMPUNG -->
      <div class="result-box-card" style="margin-bottom:2rem;">
        <div class="card-header-flex">
          <div>
            <h3>
              <i data-lucide="users" style="width:20px;height:20px;color:#10B981;"></i>
              <span>Mitra Penampung SisaBerkah Terdekat</span>
            </h3>
            <p style="font-size:0.85rem;color:#557262;margin:0.2rem 0 0;">Mitra yang saat ini membuka penerimaan pasokan untuk jenis limbah yang terdeteksi:</p>
          </div>
        </div>

        <div class="mitra-cards-wrap" id="mitraCardsContainer">
          <!-- Populated via JS -->
        </div>
      </div>

      <!-- IMPACT BANNER -->
      <div class="impact-banner">
        <div>
          <h4 class="impact-title">🌱 Estimasi Dampak Berkah &amp; Lingkungan</h4>
          <p class="impact-desc" id="resYieldEst">Penyelamatan limbah ini berpotensi menghasilkan ~8 kg pakan larva Maggot BSF atau pupuk kompos siap pakai.</p>
        </div>
        <div class="impact-stat-pill">
          <div class="impact-stat-val" id="resCo2Val">~18.5 kg</div>
          <div class="impact-stat-lbl">Reduksi Emisi CO₂eq</div>
        </div>
      </div>

      <!-- BOTTOM ACTIONS -->
      <div class="action-buttons-wrap">
        <button type="button" class="btn-scan-again" onclick="resetScanner()">
          <i data-lucide="scan" style="width:18px;height:18px;"></i>
          <span>Pindai Sampah Lain</span>
        </button>
        <button type="button" class="btn-print-summary" onclick="window.print()">
          <i data-lucide="printer" style="width:18px;height:18px;"></i>
          <span>Cetak / Simpan Hasil Analisis</span>
        </button>
      </div>

    </div>

  </div>
</div>
@endsection

@section('scripts')
<script>
  let currentCameraStream = null;
  let useFacingMode = 'environment'; // environment (kamera belakang) or user (kamera depan)
  const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

  // Inisialisasi saat halaman dimuat
  document.addEventListener('DOMContentLoaded', () => {
    lucide.createIcons();
    initCameraStream();
    setupDropzone();
  });

  // Switch Tab
  function switchScannerTab(tab) {
    document.querySelectorAll('.scanner-tab-btn').forEach(btn => btn.classList.remove('active'));
    document.querySelectorAll('.scanner-panel').forEach(panel => panel.classList.remove('active'));

    if (tab === 'camera') {
      document.querySelectorAll('.scanner-tab-btn')[0].classList.add('active');
      document.getElementById('panelCamera').classList.add('active');
      initCameraStream();
    } else if (tab === 'upload') {
      document.querySelectorAll('.scanner-tab-btn')[1].classList.add('active');
      document.getElementById('panelUpload').classList.add('active');
      stopCameraStream();
    }
  }

  // Camera Management
  async function initCameraStream() {
    const video = document.getElementById('cameraVideo');
    stopCameraStream();

    if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
      console.warn('Akses kamera tidak didukung di browser ini.');
      return;
    }

    try {
      currentCameraStream = await navigator.mediaDevices.getUserMedia({
        video: {
          facingMode: useFacingMode,
          width: { ideal: 1280 },
          height: { ideal: 960 }
        },
        audio: false
      });
      video.srcObject = currentCameraStream;
    } catch (err) {
      console.warn('Kamera tidak dapat diakses atau diblokir izinnya:', err);
    }
  }

  function stopCameraStream() {
    if (currentCameraStream) {
      currentCameraStream.getTracks().forEach(track => track.stop());
      currentCameraStream = null;
    }
  }

  function toggleCameraStream() {
    useFacingMode = (useFacingMode === 'environment') ? 'user' : 'environment';
    initCameraStream();
  }

  // Ambil Foto dari Kamera
  function captureAndAnalyze() {
    const video = document.getElementById('cameraVideo');
    const canvas = document.getElementById('cameraCanvas');
    if (!video.videoWidth) {
      alert('Kamera belum aktif. Silakan gunakan opsi "Unggah Foto File" atau "Coba Sampel Demo".');
      return;
    }

    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    const ctx = canvas.getContext('2d');
    ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
    const base64Data = canvas.toDataURL('image/jpeg', 0.88);

    startScanAnimation(base64Data);

    // Kirim ke backend
    fetch('{{ route("ai-scanner.analyze") }}', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken
      },
      body: JSON.stringify({ image_base64: base64Data })
    })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        displayAnalysisResults(data.data);
      } else {
        alert(data.message || 'Gagal menganalisis foto.');
        resetScanner();
      }
    })
    .catch(err => {
      console.error(err);
      alert('Terjadi kesalahan koneksi saat memindai.');
      resetScanner();
    });
  }

  // Setup Drag & Drop File Upload
  function setupDropzone() {
    const dropzone = document.getElementById('dropzoneBox');
    if (!dropzone) return;

    ['dragenter', 'dragover'].forEach(eventName => {
      dropzone.addEventListener(eventName, (e) => {
        e.preventDefault();
        e.stopPropagation();
        dropzone.classList.add('dragover');
      }, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
      dropzone.addEventListener(eventName, (e) => {
        e.preventDefault();
        e.stopPropagation();
        dropzone.classList.remove('dragover');
      }, false);
    });

    dropzone.addEventListener('drop', (e) => {
      const dt = e.dataTransfer;
      const files = dt.files;
      if (files.length > 0) {
        uploadAndAnalyzeFile(files[0]);
      }
    });
  }

  function handleFileSelected(input) {
    if (input.files && input.files[0]) {
      uploadAndAnalyzeFile(input.files[0]);
    }
  }

  function uploadAndAnalyzeFile(file) {
    const reader = new FileReader();
    reader.onload = (e) => {
      startScanAnimation(e.target.result);
    };
    reader.readAsDataURL(file);

    const formData = new FormData();
    formData.append('image', file);

    fetch('{{ route("ai-scanner.analyze") }}', {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': csrfToken
      },
      body: formData
    })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        displayAnalysisResults(data.data);
      } else {
        alert(data.message || 'Gagal memproses gambar.');
        resetScanner();
      }
    })
    .catch(err => {
      console.error(err);
      alert('Terjadi kendala saat mengunggah foto.');
      resetScanner();
    });
  }

  // Preset Sample Analysis (Untuk Presentasi Cepat)
  function analyzePresetSample(sampleType) {
    let previewSrc = '';
    if (sampleType === 'sayur') previewSrc = '{{ asset("assets/images/waste_sayur.jpg") }}';
    else if (sampleType === 'buah') previewSrc = '{{ asset("assets/images/waste_buah.jpg") }}';
    else if (sampleType === 'makanan') previewSrc = '{{ asset("assets/images/waste_makanan.jpg") }}';
    else previewSrc = '{{ asset("assets/images/waste_batok.jpg") }}';

    startScanAnimation(previewSrc);

    fetch('{{ route("ai-scanner.analyze") }}', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken
      },
      body: JSON.stringify({ sample_type: sampleType })
    })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        displayAnalysisResults(data.data);
      } else {
        alert('Gagal memproses sampel.');
        resetScanner();
      }
    })
    .catch(err => {
      console.error(err);
      alert('Terjadi kendala.');
      resetScanner();
    });
  }

  // Scanning Animation State
  function startScanAnimation(imagePreviewUrl) {
    document.querySelectorAll('.scanner-panel').forEach(p => p.style.display = 'none');
    document.querySelector('.scanner-tabs').style.display = 'none';

    const overlay = document.getElementById('scanningOverlay');
    overlay.style.display = 'block';
    document.getElementById('scanningPreviewImg').src = imagePreviewUrl;

    const subtitles = [
      'Memindai tekstur dan kontur bahan sisa makanan...',
      'Mendeteksi estimasi kadar air & kandungan nutrisi...',
      'Menghitung kecocokan Maggot BSF dan Kompos Organik...',
      'Merumuskan panduan Cara Mengatasi Limbah Tersebut...',
      'Mencocokkan rekomendasi mitra penampung terdekat...'
    ];

    let step = 0;
    const interval = setInterval(() => {
      step = (step + 1) % subtitles.length;
      document.getElementById('scanStatusSubtitle').textContent = subtitles[step];
    }, 450);

    overlay.dataset.intervalId = interval;
  }

  // Tampilkan Hasil Analisis
  function displayAnalysisResults(d) {
    const overlay = document.getElementById('scanningOverlay');
    if (overlay.dataset.intervalId) {
      clearInterval(overlay.dataset.intervalId);
    }

    setTimeout(() => {
      document.getElementById('scannerInputCard').style.display = 'none';
      const resultSec = document.getElementById('resultSection');
      resultSec.style.display = 'block';

      // 1. Hero Summary
      document.getElementById('resImage').src = d.image_url;
      document.getElementById('resConfidence').textContent = `Akurasi AI: ${d.confidence}%`;
      document.getElementById('resWasteName').textContent = d.waste_name;
      document.getElementById('resSummary').textContent = d.summary;

      document.getElementById('resMoisture').textContent = d.parameters.moisture || 'Sedang';
      document.getElementById('resFreshness').textContent = d.parameters.freshness || 'Baik';
      document.getElementById('resFeasibility').textContent = `${d.parameters.feasibility_score || 95}% Layak`;
      document.getElementById('resOdor').textContent = d.parameters.odor_potential || 'Rendah';

      // 2. Composition Bars
      const compContainer = document.getElementById('compositionBarsList');
      compContainer.innerHTML = '';
      if (d.composition && d.composition.length) {
        d.composition.forEach(item => {
          const div = document.createElement('div');
          div.className = 'comp-item';
          div.innerHTML = `
            <div class="comp-item-header">
              <span>${item.name}</span>
              <span>${item.percentage}%</span>
            </div>
            <div class="comp-bar-bg">
              <div class="comp-bar-fill" style="width: 0%; background: ${item.color || '#10B981'};"></div>
            </div>
          `;
          compContainer.appendChild(div);
          setTimeout(() => {
            div.querySelector('.comp-bar-fill').style.width = `${item.percentage}%`;
          }, 100);
        });
      }

      // 3. Suitability List
      const suitContainer = document.getElementById('suitabilityList');
      suitContainer.innerHTML = '';
      const suits = d.suitability || {};

      const suitItems = [
        { key: 'maggot', icon: '🪱', label: 'Pakan Maggot BSF', data: suits.maggot },
        { key: 'kompos', icon: '🌿', label: 'Bahan Baku Kompos Organik', data: suits.kompos },
        { key: 'ternak', icon: '🐔', label: 'Pakan Ternak Langsung', data: suits.ternak }
      ];

      suitItems.forEach(item => {
        if (!item.data) return;
        const isYes = item.data.suitable;
        const div = document.createElement('div');
        div.className = `suit-card ${isYes ? 'suit-yes' : 'suit-no'}`;
        div.innerHTML = `
          <div class="suit-header">
            <span class="suit-title">${item.icon} ${item.label}</span>
            <span class="suit-badge ${isYes ? 'yes' : 'warn'}">${item.data.badge || (isYes ? 'Cocok' : 'Perlu Diolah')} (${item.data.score}%)</span>
          </div>
          <p class="suit-desc">${item.data.reason}</p>
        `;
        suitContainer.appendChild(div);
      });

      // 4. 🛠️ FEATURED: CARA MENGATASI LIMBAH TERSEBUT
      const stepsContainer = document.getElementById('handlingStepsList');
      stepsContainer.innerHTML = '';
      const guide = d.handling_guide || {};
      const steps = guide.steps || [];

      steps.forEach((stepTxt, idx) => {
        const stepDiv = document.createElement('div');
        stepDiv.className = 'handling-step-item';
        stepDiv.innerHTML = `
          <div class="step-number">${idx + 1}</div>
          <p class="step-text">${stepTxt}</p>
        `;
        stepsContainer.appendChild(stepDiv);
      });

      // Upcycle & Burn Warning
      const upcycle = guide.upcycle_craft || {};
      document.getElementById('upcycleTitle').querySelector('span').textContent = upcycle.title || 'Potensi Kerajinan / Olahan Lain';
      document.getElementById('upcycleDesc').textContent = upcycle.description || 'Tidak dianjurkan untuk kerajinan padat karena kadar air tinggi.';

      const burn = guide.burn_warning || {};
      document.getElementById('burnWarningTitle').querySelector('span').textContent = burn.title || 'Apakah Boleh Dibakar? DILARANG!';
      document.getElementById('burnWarningReason').textContent = burn.reason || 'Dilarang membakar sampah organik karena menghasilkan asap pekat beracun.';

      document.getElementById('storageTipsText').textContent = 'Tips Penanganan: ' + (guide.storage_tips || 'Tiriskan kuah dan simpan di wadah tertutup sebelum dijemput mitra.');

      // 5. Mitra Recommendations
      const mitraContainer = document.getElementById('mitraCardsContainer');
      mitraContainer.innerHTML = '';
      const mitras = d.recommended_mitras || [];

      if (mitras.length === 0) {
        if (d.primary_category === 'anorganik') {
          mitraContainer.innerHTML = `
            <div style="grid-column:1/-1;background:#F0F9FF;border:1px solid #BAE6FD;border-radius:14px;padding:1.5rem;text-align:center;">
              <p style="color:#0369A1;font-weight:800;font-size:1rem;margin-bottom:0.4rem;">♻️ Limbah Anorganik Terdeteksi</p>
              <p style="color:#0C4A6E;font-size:0.88rem;margin:0;line-height:1.6;">Mitra di platform SisaBerkah berfokus mengolah limbah organik (Maggot BSF &amp; Kompos Pupuk). Untuk limbah plastik, kaleng, kardus, atau kaca ini, silakan kumpulkan dan serahkan ke <strong>Bank Sampah</strong> atau <strong>Pengepul Daur Ulang</strong> terdekat.</p>
            </div>
          `;
        } else {
          mitraContainer.innerHTML = '<p style="color:#6B7280;font-size:0.9rem;text-align:center;grid-column:1/-1;">Belum ada mitra penampung terdaftar untuk kategori ini.</p>';
        }
      } else {
        mitras.forEach(m => {
          const waPhone = (m.whatsapp || '6281234567890').replace(/\D/g, '');
          const waText = encodeURIComponent(`Halo ${m.name}, saya mendapatkan rekomendasi dari AI Waste Scanner SisaBerkah untuk menyetorkan pasokan limbah (${d.waste_name}). Apakah masih menerima pasokan hari ini?`);
          const waLink = `https://wa.me/${waPhone}?text=${waText}`;

          const mDiv = document.createElement('div');
          mDiv.className = 'scanner-mitra-card';
          mDiv.innerHTML = `
            <div>
              <div class="mitra-card-top">
                <img src="${m.image_url || '{{ asset("assets/images/partner_adam.jpg") }}'}" alt="${m.name}" class="mitra-thumb" onerror="this.src='{{ asset('assets/images/partner_adam.jpg') }}'">
                <div>
                  <span class="mitra-category-pill">${m.category}</span>
                  <h4 class="mitra-name">${m.name}</h4>
                  <div class="mitra-loc">
                    <i data-lucide="map-pin" style="width:13px;height:13px;color:#EF4444;"></i>
                    <span>${m.location}</span>
                  </div>
                </div>
              </div>
              <div class="mitra-needs-box">
                <strong style="display:block;margin-bottom:0.15rem;color:#132E20;">Bahan yang Diterima:</strong>
                <span>${m.materials_needed ? m.materials_needed.substring(0, 95) + '...' : 'Sisa makanan organik segar'}</span>
              </div>
            </div>
            <div class="mitra-btn-grid">
              <a href="${waLink}" target="_blank" class="btn-wa-direct">
                <i data-lucide="message-circle" style="width:14px;height:14px;"></i>
                <span>Hubungi WA</span>
              </a>
              <a href="${m.detail_url}" class="btn-profile-direct">
                <span>Lihat Profil</span>
              </a>
            </div>
          `;
          mitraContainer.appendChild(mDiv);
        });
      }

      // 6. Impact
      const impact = d.environmental_impact || {};
      document.getElementById('resCo2Val').textContent = `~${impact.co2_saved_kg || '18.4'} kg`;
      document.getElementById('resYieldEst').textContent = impact.organic_yield_est || 'Penyelamatan limbah ini menghemat pakan ternak konvensional dan mengurangi emisi gas metana di TPA.';

      // Re-trigger icons
      lucide.createIcons();

      // Scroll smoothly to results
      resultSec.scrollIntoView({ behavior: 'smooth' });

    }, 1200);
  }

  // Reset Scanner
  function resetScanner() {
    stopCameraStream();
    document.getElementById('scanningOverlay').style.display = 'none';
    document.getElementById('resultSection').style.display = 'none';
    document.getElementById('scannerInputCard').style.display = 'block';
    document.querySelector('.scanner-tabs').style.display = 'flex';
    document.querySelectorAll('.scanner-panel').forEach(p => p.style.display = '');

    switchScannerTab('camera');
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }
</script>
@endsection
