@extends('layouts.app')

@section('title', 'Profil Mitra yang Membutuhkan — SISABERKAH')
@section('meta_description', 'Direktori publik profil peternakan, pertanian, dan pengolah kompos yang sedang membutuhkan sisa bahan organik di SisaBerkah.')

@section('content')
  <!-- ========== PAGE HEADER ========== -->
  <header class="page-header-section">
    <div class="container">
      <div class="page-badge-pill">
        <i data-lucide="users" style="width:15px;height:15px;"></i>
        <span>Halaman Publik Mitra</span>
      </div>
      <h1 class="page-header-title">
        Profil Mitra yang <span>Membutuhkan Bahan Organik</span>
      </h1>
      <p class="page-header-desc">
        Temukan peternakan, lahan pertanian organik, dan unit pengolahan kompos yang siap menerima pasokan sisa bahan Anda. Hubungi pemilik usaha secara langsung via WhatsApp untuk menyepakati jumlah, standar bahan, dan pengiriman.
      </p>
    </div>
  </header>

  <!-- ========== MAIN CONTENT ========== -->
  <main class="page-main-section">
    <div class="container">

      <!-- Filter Bar -->
      <div class="filter-card-bar">
        <div class="filter-search-group">
          <div class="filter-search-box">
            <i data-lucide="search" style="width:18px;height:18px;color:var(--color-muted);"></i>
            <input type="text" id="mitraSearchInput" placeholder="Cari nama mitra, pemilik, lokasi, atau bahan yang dibutuhkan..." oninput="handleMitraSearch(event)">
          </div>
        </div>

        @php
          $allCategories = collect(['Peternakan', 'Pertanian', 'Pengolahan Kompos'])
            ->merge($mitras->pluck('category'))
            ->filter()
            ->unique()
            ->values();
        @endphp
        <div class="filter-pills-row" id="mitraCategoryTabs">
          <button type="button" class="filter-pill-btn active" onclick="filterMitra('Semua Kategori', this)">Semua Kategori</button>
          @foreach($allCategories as $c)
            <button type="button" class="filter-pill-btn" onclick="filterMitra('{{ $c }}', this)">{{ $c }}</button>
          @endforeach
        </div>
      </div>

      <!-- Partners Cards Grid -->
      <div class="home-partner-grid" id="mitraCardsContainer">
        @forelse($mitras as $mitra)
          @php
            $prefill = rawurlencode(
              "Halo {$mitra->owner} ({$mitra->name}), salam kenal.\n\n" .
              "Saya mendapatkan informasi kontak Bapak/Ibu melalui platform SisaBerkah terkait kebutuhan bahan organik berupa \"{$mitra->materials_needed}\".\n\n" .
              "Kebetulan kami memiliki pasokan bahan organik terpilah dan segar yang siap disalurkan secara rutin untuk mendukung {$mitra->name}.\n\n" .
              "Apakah saat ini masih menerima pasokan baru? Jika berkenan, kami ingin mendiskusikan perkiraan volume, jadwal penjemputan, serta ketentuan kualitas bahannya. Terima kasih banyak atas waktu dan perhatiannya."
            );
            $cleanWa = preg_replace('/[^0-9]/', '', $mitra->whatsapp ?: '6283193738711');
          @endphp

          <div class="home-partner-card" id="{{ $mitra->id }}" data-category="{{ $mitra->category }}">
            <div class="home-partner-img">
              <img src="{{ $mitra->display_image }}" alt="{{ $mitra->name }}" loading="lazy" onerror="this.src='{{ asset('assets/images/partner_doni.jpg') }}'">
              <span class="home-partner-badge">{{ $mitra->category }}</span>
            </div>
            <div class="home-partner-body">
              <h3 class="home-partner-title">{{ $mitra->name }}</h3>
              <div class="home-partner-meta">
                <i data-lucide="store" style="width:14px;height:14px;"></i>
                <span>{{ $mitra->owner }}</span>
                <span>•</span>
                <span>{{ $mitra->location }}</span>
              </div>
              <p style="font-size:0.85rem;color:var(--color-charcoal-light);line-height:1.5;margin-bottom:1rem;">
                {{ $mitra->description }}
              </p>
              <div class="home-partner-need-box">
                <span class="home-partner-need-label">KEBUTUHAN BAHAN:</span>
                <p class="home-partner-need-desc">{{ $mitra->materials_needed }}</p>
              </div>
              <div style="font-size:0.82rem;color:var(--color-muted);margin-bottom:0.75rem;">
                <strong>Estimasi Kebutuhan:</strong> {{ $mitra->estimated_amount }}
              </div>
              <div style="background:rgba(217,119,6,0.08);border-left:3px solid #D97706;padding:0.5rem 0.75rem;font-size:0.78rem;color:#92400E;border-radius:4px;margin-bottom:1.25rem;">
                <strong>Ketentuan:</strong> {{ $mitra->terms_conditions }}
              </div>
              <div class="home-partner-actions">
                <button type="button" class="btn-partner-profile" onclick="openDetailModal('{{ $mitra->id }}')">Lihat Profil</button>
                <a href="https://wa.me/{{ $cleanWa }}?text={{ $prefill }}" target="_blank" rel="noopener noreferrer" class="btn-partner-whatsapp">
                  <i data-lucide="message-circle" style="width:15px;height:15px;"></i>
                  <span>WhatsApp</span>
                </a>
              </div>
            </div>
          </div>
        @empty
          <div style="grid-column: 1 / -1; text-align: center; padding: 3rem; background: #FFF; border-radius: 16px;">
            <p style="color: var(--color-muted); font-size: 1.05rem;">Belum ada profil mitra yang terdaftar.</p>
          </div>
        @endforelse
      </div>
    </div>
  </main>

  <!-- Modal Detail Mitra -->
  <div class="modal-overlay" id="partnerDetailModal" onclick="closeDetailModal()">
    <div class="modal-card" onclick="event.stopPropagation()">
      <button type="button" class="modal-close-btn" onclick="closeDetailModal()">&times;</button>
      <div id="partnerModalBody"></div>
    </div>
  </div>
@endsection

@section('scripts')
<script>
  // Data lengkap mitra dari Laravel
  const mitraList = @json($mitras->keyBy('id'));

  function openDetailModal(id) {
    const data = mitraList[id];
    if (!data) return;

    const modal = document.getElementById('partnerDetailModal');
    const body = document.getElementById('partnerModalBody');

    const cleanWa = (data.whatsapp || '6283193738711').replace(/[^0-9]/g, '');
    const waMsg = encodeURIComponent(
      `Halo ${data.owner} (${data.name}), salam kenal.\n\n` +
      `Saya mendapatkan informasi kontak Bapak/Ibu melalui platform SisaBerkah terkait kebutuhan bahan organik berupa "${data.materials_needed}".\n\n` +
      `Kebetulan kami memiliki pasokan bahan organik terpilah dan segar yang siap disalurkan secara rutin untuk mendukung ${data.name}.\n\n` +
      `Apakah saat ini masih menerima pasokan baru? Jika berkenan, kami ingin mendiskusikan perkiraan volume, jadwal penjemputan, serta ketentuan kualitas bahannya. Terima kasih banyak atas waktu dan perhatiannya.`
    );
    const waUrl = `https://wa.me/${cleanWa}?text=${waMsg}`;
    const imgUrl = data.display_image || (data.image_url ? (data.image_url.startsWith('data:') || data.image_url.startsWith('http') ? data.image_url : `{{ asset('') }}${data.image_url.replace(/^\//, '')}`) : '{{ asset("assets/images/partner_doni.jpg") }}');

    body.innerHTML = `
      <div style="position:relative;height:240px;border-radius:var(--radius-xl);overflow:hidden;margin-bottom:1.5rem;">
        <img src="${imgUrl}" alt="${data.name}" style="width:100%;height:100%;object-fit:cover;" onerror="this.src='{{ asset('assets/images/partner_doni.jpg') }}'">
        <span class="home-partner-badge" style="top:16px;right:16px;">${data.category}</span>
      </div>
      <h2 style="font-family:var(--font-heading);font-size:1.6rem;font-weight:800;color:var(--color-text);margin-bottom:0.25rem;">${data.name}</h2>
      <div style="font-size:0.88rem;color:var(--color-muted);margin-bottom:1rem;">
        Pemilik: <strong>${data.owner}</strong> • Lokasi: <strong>${data.full_location || data.location}</strong>
      </div>
      <p style="font-size:0.95rem;color:var(--color-charcoal-light);line-height:1.6;margin-bottom:1.5rem;">${data.description}</p>
      
      <div style="background:var(--color-sage-light);border:1px solid var(--color-accent);border-radius:var(--radius-lg);padding:1rem;margin-bottom:1rem;">
        <strong style="display:block;font-size:0.78rem;text-transform:uppercase;color:var(--color-primary-dark);margin-bottom:0.2rem;">Bahan yang Dibutuhkan:</strong>
        <span style="font-size:0.95rem;font-weight:700;color:var(--color-text);">${data.materials_needed}</span>
      </div>

      <div style="background:var(--color-cream-light);border:1px solid var(--color-border);border-radius:var(--radius-md);padding:0.85rem;margin-bottom:1rem;font-size:0.88rem;">
        <strong>Estimasi Kebutuhan / Kapasitas:</strong> ${data.estimated_amount}
      </div>

      <div style="background:rgba(217,119,6,0.08);border-left:4px solid #D97706;border-radius:var(--radius-sm);padding:0.85rem;font-size:0.85rem;color:#92400E;line-height:1.5;margin-bottom:1.5rem;">
        <strong>Ketentuan Penerimaan:</strong> ${data.terms_conditions}
      </div>

      <a href="${waUrl}" target="_blank" rel="noopener noreferrer" class="btn-partner-whatsapp" style="display:flex;padding:0.85rem;font-size:1rem;justify-content:center;align-items:center;gap:0.5rem;text-decoration:none;">
        <i data-lucide="message-circle" style="width:20px;height:20px;"></i>
        <span>Hubungi via WhatsApp (+${cleanWa})</span>
      </a>
    `;

    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
    if (window.lucide && typeof window.lucide.createIcons === 'function') {
      lucide.createIcons();
    }
  }

  function closeDetailModal() {
    const modal = document.getElementById('partnerDetailModal');
    if (modal) modal.classList.remove('active');
    document.body.style.overflow = '';
  }

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeDetailModal();
  });

  // Filtering
  let currentCategory = 'Semua Kategori';
  let searchQuery = '';

  function filterMitra(cat, elem) {
    currentCategory = cat;
    document.querySelectorAll('#mitraCategoryTabs .filter-pill-btn').forEach(btn => btn.classList.remove('active'));
    if (elem) elem.classList.add('active');
    applyMitraFilters();
  }

  function handleMitraSearch(e) {
    searchQuery = e.target.value.toLowerCase();
    applyMitraFilters();
  }

  function applyMitraFilters() {
    const cards = document.querySelectorAll('#mitraCardsContainer .home-partner-card');
    cards.forEach(card => {
      const cat = card.dataset.category;
      const text = card.innerText.toLowerCase();
      const matchCat = (currentCategory === 'Semua Kategori' || cat === currentCategory);
      const matchSearch = (searchQuery === '' || text.includes(searchQuery));
      if (matchCat && matchSearch) {
        card.style.display = 'flex';
      } else {
        card.style.display = 'none';
      }
    });
  }

  // Check URL hash for smooth scrolling & highlight
  const hash = window.location.hash ? window.location.hash.substring(1) : '';
  if (hash) {
    const targetCard = document.getElementById(hash);
    if (targetCard) {
      setTimeout(() => {
        targetCard.scrollIntoView({ behavior: 'smooth', block: 'center' });
        targetCard.classList.add('card-highlight-pulse');
      }, 300);
    }
  }
</script>
@endsection
