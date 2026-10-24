@extends('layouts.app')

@section('title', 'Direktori & Potensi Limbah Organik — SISABERKAH')
@section('meta_description', 'Pelajari karakteristik, estimasi nutrisi, ketentuan pemilahan, dan potensi pemanfaatan kembali dari seluruh jenis bahan limbah organik di SISABERKAH.')

@section('content')
  <!-- ========== PAGE HEADER ========== -->
  <header class="page-header-section">
    <div class="container">
      <div class="page-badge-pill">
        <i data-lucide="recycle" style="width:15px;height:15px;"></i>
        <span>Ensiklopedia & Potensi Limbah</span>
      </div>
      <h1 class="page-header-title">
        Kenali Potensi <span>Limbah Organik</span>
      </h1>
      <p class="page-header-desc">
        Setiap sisa bahan organik memiliki nilai nutrisi dan potensi pemanfaatan yang tinggi jika terpilah dengan benar.
        Pelajari karakteristik dan peluang pengolahannya di bawah ini.
      </p>
    </div>
  </header>

  <!-- ========== DIRECTORY GRID ========== -->
  <main class="page-main-section">
    <div class="container">

      <!-- Filter Bar -->
      <div class="filter-card-bar">
        <div class="filter-search-group">
          <div class="filter-search-box">
            <i data-lucide="search" style="width:18px;height:18px;color:var(--color-muted);flex-shrink:0;"></i>
            <input type="text" id="wasteSearchInput" placeholder="Cari nama limbah, nutrisi, atau potensi olahan (misal: pakan maggot, kompos, jamur)..." oninput="applyWasteFilter()" autocomplete="off">
          </div>
        </div>

        <div class="filter-pills-row" id="wasteCategoryTabs">
          <button type="button" class="filter-pill-btn active" onclick="filterWaste('Semua', this)">Semua (12)</button>
          <button type="button" class="filter-pill-btn" onclick="filterWaste('Dapur & Sisa Makanan', this)">Dapur &amp; Sisa Makanan</button>
          <button type="button" class="filter-pill-btn" onclick="filterWaste('Pasar & Hijauan', this)">Pasar &amp; Hijauan</button>
          <button type="button" class="filter-pill-btn" onclick="filterWaste('Agroindustri & Olahan', this)">Agroindustri &amp; Olahan</button>
        </div>
      </div>

      <!-- Empty State -->
      <div id="wasteEmptyState" style="display:none;text-align:center;padding:4rem 1.5rem;background:#fff;border-radius:20px;border:1px dashed var(--color-border);margin-bottom:3rem;">
        <i data-lucide="search-x" style="width:48px;height:48px;color:var(--color-muted);margin:0 auto 1rem;display:block;"></i>
        <h3 style="font-family:var(--font-heading);font-size:1.25rem;color:var(--color-text);margin-bottom:0.5rem;">Tidak Ada Limbah yang Cocok</h3>
        <p style="color:var(--color-muted);font-size:0.92rem;max-width:420px;margin:0 auto 1.5rem;">Coba gunakan kata kunci lain atau pilih kategori berbeda untuk menemukan jenis limbah organik yang Anda cari.</p>
        <button type="button" onclick="resetWasteFilters()" class="filter-pill-btn" style="background:var(--color-primary);color:#fff;border-color:var(--color-primary);display:inline-block;">Reset Pencarian</button>
      </div>

      <!-- Waste Cards Grid (All 12 Items) -->
      <div class="waste-grid" id="wasteCardsGrid" style="margin-bottom: 3.5rem;">
        
        <!-- Card 1 -->
        <div class="waste-card" data-category="Pasar & Hijauan" data-keywords="sisa sayuran buah pasar wortel kubis sawi kulit jeruk semangka kompos maggot pupuk">
          <div class="waste-card-image">
            <img src="{{ asset('assets/images/waste_vegetables.jpg') }}" alt="Sisa sayuran dan buah" loading="lazy">
          </div>
          <div class="waste-card-body">
            <span class="home-partner-badge" style="position:static;display:inline-block;margin-bottom:0.6rem;align-self:flex-start;">Limbah Basah</span>
            <h3 class="waste-card-title">Sisa Sayuran dan Buah</h3>
            <p class="waste-card-desc">Kulit, batang, daun, dan sisa sayuran atau buah afkir segar yang kaya serat dan kadar air.</p>
            <button type="button" class="waste-card-link" onclick="openWasteModal('sayuran-buah')">
              <span>Lihat Detail Informasi</span>
              <i data-lucide="arrow-right" style="width:14px;height:14px;"></i>
            </button>
          </div>
        </div>

        <!-- Card 2 -->
        <div class="waste-card" data-category="Dapur & Sisa Makanan" data-keywords="sisa makanan food waste nasi lauk katering restoran maggot bsf biogas pakan ternak">
          <div class="waste-card-image">
            <img src="{{ asset('assets/images/waste_food.jpg') }}" alt="Sisa makanan" loading="lazy">
          </div>
          <div class="waste-card-body">
            <span class="home-partner-badge" style="position:static;display:inline-block;margin-bottom:0.6rem;align-self:flex-start;">Limbah Dapur</span>
            <h3 class="waste-card-title">Sisa Makanan (Food Waste)</h3>
            <p class="waste-card-desc">Nasi, lauk pauk, dan sisa sajian meja makan berkarbohidrat dan berprotein tinggi.</p>
            <button type="button" class="waste-card-link" onclick="openWasteModal('sisa-makanan')">
              <span>Lihat Detail Informasi</span>
              <i data-lucide="arrow-right" style="width:14px;height:14px;"></i>
            </button>
          </div>
        </div>

        <!-- Card 3 -->
        <div class="waste-card" data-category="Dapur & Sisa Makanan" data-keywords="ampas kopi teh coffee shop cafe seduhan nitrogen jamur tiram kompos bau kandang">
          <div class="waste-card-image">
            <img src="{{ asset('assets/images/waste_coffee.jpg') }}" alt="Ampas kopi dan teh" loading="lazy">
          </div>
          <div class="waste-card-body">
            <span class="home-partner-badge" style="position:static;display:inline-block;margin-bottom:0.6rem;align-self:flex-start;">Limbah Kafe</span>
            <h3 class="waste-card-title">Ampas Kopi dan Teh</h3>
            <p class="waste-card-desc">Ampas bubuk kopi dan sisa seduhan teh kaya nitrogen, antioksidan, dan penetral bau kandang.</p>
            <button type="button" class="waste-card-link" onclick="openWasteModal('ampas-kopi')">
              <span>Lihat Detail Informasi</span>
              <i data-lucide="arrow-right" style="width:14px;height:14px;"></i>
            </button>
          </div>
        </div>

        <!-- Card 4 -->
        <div class="waste-card" data-category="Pasar & Hijauan" data-keywords="daun kering sisa tanaman serasah ranting karbon cokelat kompos mulsa tanah cacing">
          <div class="waste-card-image">
            <img src="{{ asset('assets/images/waste_leaves.jpg') }}" alt="Daun dan sisa tanaman" loading="lazy">
          </div>
          <div class="waste-card-body">
            <span class="home-partner-badge" style="position:static;display:inline-block;margin-bottom:0.6rem;align-self:flex-start;">Limbah Hijauan</span>
            <h3 class="waste-card-title">Daun dan Sisa Tanaman</h3>
            <p class="waste-card-desc">Daun pangkasan kebun, serasah kering penyeimbang kompos, dan bahan pakan cacing lumbricus.</p>
            <button type="button" class="waste-card-link" onclick="openWasteModal('daun-tanaman')">
              <span>Lihat Detail Informasi</span>
              <i data-lucide="arrow-right" style="width:14px;height:14px;"></i>
            </button>
          </div>
        </div>

        <!-- Card 5 -->
        <div class="waste-card" data-category="Pasar & Hijauan" data-keywords="limbah pasar tradisional sayur buah tps3r tonase pakan sapi hijauan maggot pupuk cair">
          <div class="waste-card-image">
            <img src="{{ asset('assets/images/waste_market.jpg') }}" alt="Limbah organik pasar" loading="lazy">
          </div>
          <div class="waste-card-body">
            <span class="home-partner-badge" style="position:static;display:inline-block;margin-bottom:0.6rem;align-self:flex-start;">Pasar Tradisional</span>
            <h3 class="waste-card-title">Limbah Organik Pasar</h3>
            <p class="waste-card-desc">Volume besar sisa sayuran dan buah segar pasar induk untuk komposting tonase dan pakan sapi.</p>
            <button type="button" class="waste-card-link" onclick="openWasteModal('limbah-pasar')">
              <span>Lihat Detail Informasi</span>
              <i data-lucide="arrow-right" style="width:14px;height:14px;"></i>
            </button>
          </div>
        </div>

        <!-- Card 6 -->
        <div class="waste-card" data-category="Dapur & Sisa Makanan" data-keywords="limbah kuliner restoran katering hotel persiapan dapur kaldu asam amino maggot">
          <div class="waste-card-image">
            <img src="{{ asset('assets/images/waste_culinary.jpg') }}" alt="Limbah organik usaha kuliner" loading="lazy">
          </div>
          <div class="waste-card-body">
            <span class="home-partner-badge" style="position:static;display:inline-block;margin-bottom:0.6rem;align-self:flex-start;">Usaha Kuliner</span>
            <h3 class="waste-card-title">Limbah Organik Usaha Kuliner</h3>
            <p class="waste-card-desc">Sisa potongan bahan masakan segar dan olahan persiapan dapur restoran masakan padang dan kafe.</p>
            <button type="button" class="waste-card-link" onclick="openWasteModal('limbah-kuliner')">
              <span>Lihat Detail Informasi</span>
              <i data-lucide="arrow-right" style="width:14px;height:14px;"></i>
            </button>
          </div>
        </div>

        <!-- Card 7 -->
        <div class="waste-card" data-category="Agroindustri & Olahan" data-keywords="ampas tahu kedelai pabrik tahu protein kambing etawa domba pelet ikan fermentasi">
          <div class="waste-card-image">
            <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&w=600&q=80" onerror="this.src='{{ asset('assets/images/about_organic.jpg') }}'" alt="Ampas tahu dan kedelai" loading="lazy">
          </div>
          <div class="waste-card-body">
            <span class="home-partner-badge" style="position:static;display:inline-block;margin-bottom:0.6rem;align-self:flex-start;">Agroindustri</span>
            <h3 class="waste-card-title">Ampas Tahu dan Kedelai</h3>
            <p class="waste-card-desc">Ampas sisa perasan kedelai dengan protein kasar 21-27% sangat digemari peternak kambing dan domba.</p>
            <button type="button" class="waste-card-link" onclick="openWasteModal('ampas-tahu')">
              <span>Lihat Detail Informasi</span>
              <i data-lucide="arrow-right" style="width:14px;height:14px;"></i>
            </button>
          </div>
        </div>

        <!-- Card 8 -->
        <div class="waste-card" data-category="Agroindustri & Olahan" data-keywords="cangkang telur kalsium ayam petelur martabak bakery pupuk kalsium hama siput">
          <div class="waste-card-image">
            <img src="https://images.unsplash.com/photo-1582722872445-44dc5f7e3c8f?auto=format&fit=crop&w=600&q=80" onerror="this.src='{{ asset('assets/images/waste_culinary.jpg') }}'" alt="Cangkang telur organik" loading="lazy">
          </div>
          <div class="waste-card-body">
            <span class="home-partner-badge" style="position:static;display:inline-block;margin-bottom:0.6rem;align-self:flex-start;">Kalsium Alami</span>
            <h3 class="waste-card-title">Cangkang Telur Organik</h3>
            <p class="waste-card-desc">Sumber kalsium karbonat murni 95% dari bakery dan toko martabak untuk penguat cangkang telur unggas.</p>
            <button type="button" class="waste-card-link" onclick="openWasteModal('cangkang-telur')">
              <span>Lihat Detail Informasi</span>
              <i data-lucide="arrow-right" style="width:14px;height:14px;"></i>
            </button>
          </div>
        </div>

        <!-- Card 9 -->
        <div class="waste-card" data-category="Agroindustri & Olahan" data-keywords="roti afkir sisa bakery kedaluwarsa karbohidrat pakan sapi domba ayam ikan lele">
          <div class="waste-card-image">
            <img src="https://images.unsplash.com/photo-1509440159596-0249088772ff?auto=format&fit=crop&w=600&q=80" onerror="this.src='{{ asset('assets/images/partner_budi.jpg') }}'" alt="Roti afkir dan sisa bakery" loading="lazy">
          </div>
          <div class="waste-card-body">
            <span class="home-partner-badge" style="position:static;display:inline-block;margin-bottom:0.6rem;align-self:flex-start;">Karbohidrat Bersih</span>
            <h3 class="waste-card-title">Roti Afkir & Sisa Bakery</h3>
            <p class="waste-card-desc">Roti bersih tanpa jamur hitam kaya karbohidrat mudah cerna untuk penggemukan sapi dan ransum pakan.</p>
            <button type="button" class="waste-card-link" onclick="openWasteModal('roti-afkir')">
              <span>Lihat Detail Informasi</span>
              <i data-lucide="arrow-right" style="width:14px;height:14px;"></i>
            </button>
          </div>
        </div>

        <!-- Card 10 -->
        <div class="waste-card" data-category="Agroindustri & Olahan" data-keywords="minyak jelantah used cooking oil uco biodiesel sabun lilin energi terbarukan">
          <div class="waste-card-image">
            <img src="https://images.unsplash.com/photo-1474979266404-7eaacbcd87c5?auto=format&fit=crop&w=600&q=80" onerror="this.src='{{ asset('assets/images/waste_coffee.jpg') }}'" alt="Minyak jelantah nabati" loading="lazy">
          </div>
          <div class="waste-card-body">
            <span class="home-partner-badge" style="position:static;display:inline-block;margin-bottom:0.6rem;align-self:flex-start;">Energi & Sabun</span>
            <h3 class="waste-card-title">Minyak Jelantah Nabati</h3>
            <p class="waste-card-desc">Minyak goreng bekas pakai tersaring dari penjual gorengan dan resto untuk bahan baku biodiesel & lilin.</p>
            <button type="button" class="waste-card-link" onclick="openWasteModal('minyak-jelantah')">
              <span>Lihat Detail Informasi</span>
              <i data-lucide="arrow-right" style="width:14px;height:14px;"></i>
            </button>
          </div>
        </div>

        <!-- Card 11 -->
        <div class="waste-card" data-category="Agroindustri & Olahan" data-keywords="ampas kelapa parut santan kue basah serat asam laurat ayam itik kascing cacing">
          <div class="waste-card-image">
            <img src="https://images.unsplash.com/photo-1525385133512-2f3bdd039054?auto=format&fit=crop&w=600&q=80" onerror="this.src='{{ asset('assets/images/about_organic.jpg') }}'" alt="Ampas kelapa parut" loading="lazy">
          </div>
          <div class="waste-card-body">
            <span class="home-partner-badge" style="position:static;display:inline-block;margin-bottom:0.6rem;align-self:flex-start;">Serat Nabati</span>
            <h3 class="waste-card-title">Ampas Kelapa Parut</h3>
            <p class="waste-card-desc">Sisa perasan santan berlemak nabati ringan untuk pakan fermentasi unggas dan media ternak cacing kascing.</p>
            <button type="button" class="waste-card-link" onclick="openWasteModal('ampas-kelapa')">
              <span>Lihat Detail Informasi</span>
              <i data-lucide="arrow-right" style="width:14px;height:14px;"></i>
            </button>
          </div>
        </div>

        <!-- Card 12 -->
        <div class="waste-card" data-category="Agroindustri & Olahan" data-keywords="serbuk gergaji abu kayu jamur tiram baglog alas kandang amonia ph tanah asam">
          <div class="waste-card-image">
            <img src="https://images.unsplash.com/photo-1513836279014-a89f7a76ae86?auto=format&fit=crop&w=600&q=80" onerror="this.src='{{ asset('assets/images/hero_compost.jpg') }}'" alt="Serbuk gergaji dan abu kayu" loading="lazy">
          </div>
          <div class="waste-card-body">
            <span class="home-partner-badge" style="position:static;display:inline-block;margin-bottom:0.6rem;align-self:flex-start;">Karbon & Jamur</span>
            <h3 class="waste-card-title">Serbuk Gergaji & Abu Kayu</h3>
            <p class="waste-card-desc">Bahan lignoselulosa alami untuk media tanam baglog jamur tiram, alas kandang kering, dan penstabil pH.</p>
            <button type="button" class="waste-card-link" onclick="openWasteModal('serbuk-gergaji')">
              <span>Lihat Detail Informasi</span>
              <i data-lucide="arrow-right" style="width:14px;height:14px;"></i>
            </button>
          </div>
        </div>

      </div>

    </div>
  </main>

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
  let currentCategory = 'Semua';

  function filterWaste(cat, btn) {
    currentCategory = cat;
    document.querySelectorAll('#wasteCategoryTabs .filter-pill-btn').forEach(b => b.classList.remove('active'));
    if (btn) btn.classList.add('active');
    applyWasteFilter();
  }

  function applyWasteFilter() {
    const inputEl = document.getElementById('wasteSearchInput');
    const q = (inputEl ? inputEl.value : '').toLowerCase().trim();
    const cards = document.querySelectorAll('#wasteCardsGrid .waste-card');
    let visibleCount = 0;

    cards.forEach(card => {
      const cat = card.getAttribute('data-category') || '';
      const keywords = ((card.getAttribute('data-keywords') || '') + ' ' + card.innerText).toLowerCase();

      const matchCat = (currentCategory === 'Semua' || cat === currentCategory);
      const matchSearch = (!q || keywords.includes(q));

      if (matchCat && matchSearch) {
        card.style.display = 'flex';
        visibleCount++;
      } else {
        card.style.display = 'none';
      }
    });

    const empty = document.getElementById('wasteEmptyState');
    if (empty) {
      empty.style.display = visibleCount === 0 ? 'block' : 'none';
      if (visibleCount === 0 && window.lucide) {
        lucide.createIcons();
      }
    }
  }

  function resetWasteFilters() {
    const inputEl = document.getElementById('wasteSearchInput');
    if (inputEl) inputEl.value = '';
    const firstTab = document.querySelector('#wasteCategoryTabs .filter-pill-btn');
    filterWaste('Semua', firstTab);
  }

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
    },
    'ampas-tahu': {
      title: 'Ampas Tahu dan Kedelai',
      badge: 'Limbah Agroindustri Protein Tinggi',
      img: 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&w=600&q=80',
      source: 'Pabrik tahu tradisional/modern, industri tempe, dan olahan susu kedelai.',
      nutrients: 'Protein kasar (21-27%), serat pangan mudah cerna, kalsium, fosfor, dan asam amino.',
      uses: [
        { icon: 'milk', text: 'Pakan Utama Kambing Etawa & Domba' },
        { icon: 'fish', text: 'Bahan Tambahan Pelet Ikan Nila & Lele' },
        { icon: 'sprout', text: 'Pengkaya Nutrisi Organik Media Tanam' }
      ],
      tips: 'Harus segera dijemput dalam kondisi hangat/segar (maksimal 24 jam) agar belum berbau asam menusuk. Dapat difermentasi dengan bekatul dan tetes tebu.',
      partners: 'Sangat dibutuhkan oleh Peternakan Pak Doni (Pakem, Sleman).',
      linkMitra: '{{ route("mitra.index") }}#doni'
    },
    'cangkang-telur': {
      title: 'Cangkang Telur Organik',
      badge: 'Limbah Kalsium Murni Organik',
      img: 'https://images.unsplash.com/photo-1582722872445-44dc5f7e3c8f?auto=format&fit=crop&w=600&q=80',
      source: 'Pabrik roti/bakery, toko martabak telur, pedagang nasi goreng, dan katering.',
      nutrients: 'Kalsium Karbonat murni (95%), membran protein tipis, magnesium, dan selenium.',
      uses: [
        { icon: 'egg', text: 'Tepung Kalsium Pakan Ayam Petelur' },
        { icon: 'flower-2', text: 'Mencegah Busuk Ujung Buah Tomat/Cabai' },
        { icon: 'shield-alert', text: 'Pencegah Alami Serangan Hama Bekicot & Siput' }
      ],
      tips: 'Bilas cepat dengan air mengalir untuk membuang sisa putih telur lengket, jemur hingga garing di terik matahari sebelum dihaluskan.',
      partners: 'Dibutuhkan oleh Peternakan Pak Adam (Unggas) & Pertanian Pak Andi (Hortikultura).',
      linkMitra: '{{ route("mitra.index") }}'
    },
    'roti-afkir': {
      title: 'Roti Afkir & Sisa Bakery',
      badge: 'Limbah Karbohidrat Bersih',
      img: 'https://images.unsplash.com/photo-1509440159596-0249088772ff?auto=format&fit=crop&w=600&q=80',
      source: 'Pabrik roti, toko roti modern, agen roti keliling, dan supermarket.',
      nutrients: 'Karbohidrat pati mudah cerna (65%), gula, lemak nabati, dan energi tinggi.',
      uses: [
        { icon: 'beef', text: 'Pakan Penggemukan Sapi & Domba Pedaging' },
        { icon: 'egg', text: 'Pengganti Sebagian Dedak Pakan Bebek & Ayam' },
        { icon: 'fish', text: 'Umpan & Pakan Ikan Kolam Air Tawar' }
      ],
      tips: 'Hanya menerima roti yang belum ditumbuhi jamur hitam atau hijau beracun. Kemasan plastik, kawat pembungkus, dan tanggal kedaluwarsa harus dilepas.',
      partners: 'Sangat dibutuhkan oleh Peternakan Pak Budi (Cisarua, Bogor).',
      linkMitra: '{{ route("mitra.index") }}#budi'
    },
    'minyak-jelantah': {
      title: 'Minyak Jelantah (Used Cooking Oil)',
      badge: 'Limbah Lemak & Energi Terbarukan',
      img: 'https://images.unsplash.com/photo-1474979266404-7eaacbcd87c5?auto=format&fit=crop&w=600&q=80',
      source: 'Penjual gorengan, restoran siap saji, hotel, katering, dan dapur rumah tangga.',
      nutrients: 'Asam lemak bebas, trigliserida nabati tinggi energi kalorik.',
      uses: [
        { icon: 'fuel', text: 'Bahan Baku Utama Bahan Bakar Biodiesel' },
        { icon: 'sparkles', text: 'Sabun Cuci Ramah Lingkungan (Saponifikasi)' },
        { icon: 'flame', text: 'Lilin Aromaterapi & Penerangan Darurat' }
      ],
      tips: 'Saring sisa remah gorengan dengan kain bersih sebelum dimasukkan ke jeriken tertutup. Jangan sekali-kali dibuang ke saluran wastafel atau selokan!',
      partners: 'Dibutuhkan oleh unit pengolah energi biomassa dan UMKM sabun natural.',
      linkMitra: '{{ route("mitra.index") }}'
    },
    'ampas-kelapa': {
      title: 'Ampas Kelapa Parut',
      badge: 'Limbah Serat Nabati & Lemak Ringan',
      img: 'https://images.unsplash.com/photo-1525385133512-2f3bdd039054?auto=format&fit=crop&w=600&q=80',
      source: 'Kios pemerasan santan pasar tradisional, pedagang kelapa parut, dan industri kue basah.',
      nutrients: 'Serat kasar nabati, sisa asam laurat, minyak kelapa alami, dan mineral mikro.',
      uses: [
        { icon: 'bird', text: 'Pakan Fermentasi Ayam Kampung & Itik' },
        { icon: 'worm', text: 'Makanan Terbaik Budidaya Cacing Tanah Kascing' },
        { icon: 'sprout', text: 'Aerasi Campuran Media Tanam Pot Organik' }
      ],
      tips: 'Segera gunakan dalam 24 jam sebelum berlendir atau jemur sampai kering agar tahan disimpan berbulan-bulan tanpa bau tengik.',
      partners: 'Sangat dibutuhkan oleh Peternakan Pak Doni (Pakem) & Pak Adam (Malang).',
      linkMitra: '{{ route("mitra.index") }}#doni'
    },
    'serbuk-gergaji': {
      title: 'Serbuk Gergaji & Abu Kayu',
      badge: 'Limbah Serat Kayu & Karbon Alami',
      img: 'https://images.unsplash.com/photo-1513836279014-a89f7a76ae86?auto=format&fit=crop&w=600&q=80',
      source: 'Industri mebel kayu solid, pabrik pemotongan kayu sengon, dan dapur perapian.',
      nutrients: 'Lignoselulosa karbon murni (C), kalium oksida (pada abu kayu), dan silika.',
      uses: [
        { icon: 'flower-2', text: 'Media Utama Baglog Budidaya Jamur Tiram' },
        { icon: 'shield-check', text: 'Alas Kandang Higienis Penyerap Bau & Basah' },
        { icon: 'leaf', text: 'Abu Kayu untuk Menetralkan pH Tanah Asam' }
      ],
      tips: 'Pastikan berasal dari kayu alami tanpa campuran lem kimia sintetis, cat tiner, atau pernis beracun.',
      partners: 'Dibutuhkan oleh Pengolahan Kompos Pak Dedi & Peternakan Unggas Pak Adam.',
      linkMitra: '{{ route("mitra.index") }}#dedi'
    }
  };

  function openWasteModal(key) {
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
</script>
@endsection
