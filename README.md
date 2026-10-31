<p align="center">
  <img src="posterSisaBerkah.png" alt="SisaBerkah" width="650"/>
</p>

<h1 align="center">SisaBerkah</h1>
<p align="center">
  <em>Dari Sisa Menjadi Berkah — Platform pengelolaan dan distribusi limbah organik berbasis web</em>
</p>

---

## 📖 Deskripsi

**SisaBerkah** adalah platform web yang hadir sebagai jembatan antara penghasil sisa bahan organik — seperti rumah tangga, warung makan, pasar tradisional, dan katering — dengan mitra penerima yang membutuhkan, seperti peternak Maggot BSF, pengelola kompos, dan peternak unggas.

Di Indonesia, jutaan ton sisa makanan dan limbah organik terbuang sia-sia setiap harinya, mencemari lingkungan dan menambah beban TPA. SisaBerkah hadir dengan pendekatan teknologi untuk mengubah masalah ini menjadi peluang: sisa sayur bisa menjadi pakan maggot, kulit buah bisa menjadi eco-enzyme, dan batok kelapa bisa menjadi briket arang bernilai ekspor.

Dengan sistem yang mudah digunakan, siapa pun dapat menemukan mitra penerima limbah terdekat, memindai jenis limbah menggunakan AI, hingga berkonsultasi langsung dengan chatbot cerdas — semua dalam satu platform.

---

## ✨ Fitur Utama

### 🔍 AI Scanner — Analisis Limbah Berbasis Kecerdasan Buatan
Pengguna dapat mengunggah foto, mengambil gambar via kamera, atau memilih sampel demo untuk dianalisis secara otomatis. Sistem menggunakan **Google Gemini Vision AI** untuk mengidentifikasi jenis limbah, komposisinya, tingkat kelayakan, serta merekomendasikan penanganan terbaik — apakah cocok untuk pakan maggot, kompos, atau pakan ternak. Tersedia juga fallback engine berbasis heuristik cerdas jika API tidak tersedia.

### 🤖 BerkahBot — Chatbot Asisten AI
Asisten virtual berbasis **Google Gemini** yang siap menjawab pertanyaan seputar pengelolaan limbah organik: cara budidaya Maggot BSF, pembuatan kompos, bahaya membakar sampah, hingga merekomendasikan mitra terdekat lengkap dengan kontak WhatsApp. BerkahBot mendukung percakapan multi-turn (konteks percakapan tersimpan).

### 🤝 Direktori Mitra
Halaman khusus yang menampilkan daftar seluruh mitra aktif berikut profil lengkapnya: nama usaha, kategori (Peternakan, Pengolahan Kompos, Pertanian), lokasi, bahan yang dibutuhkan, jam operasional, syarat & ketentuan, serta kontak WhatsApp langsung.

### 📋 Dashboard Mitra
Mitra memiliki akun khusus untuk mengelola platform mereka sendiri: memperbarui profil usaha, mencatat log pasokan bahan masuk (termasuk nama penyalur, jenis bahan, volume, dan status konfirmasi), serta mengelola sandi akun mereka secara mandiri.

### 👤 Manajemen Akun Pengguna
Sistem autentikasi lengkap untuk dua jenis pengguna: **pengguna umum** (masyarakat yang ingin menyalurkan sisa bahan) dan **akun mitra**. Masing-masing memiliki halaman profil sendiri dengan fitur pembaruan data dan penghapusan akun.

### 🌿 Panduan Jenis Limbah
Halaman informatif yang menjelaskan berbagai kategori limbah organik — mulai dari limbah sayuran, buah, sisa makanan, hingga biomassa kering seperti batok kelapa — beserta cara penanganan yang tepat dan dampak lingkungannya.

---

## ⚙️ Persyaratan Sistem

| Kebutuhan | Versi Minimum |
|-----------|--------------|
| PHP | >= 8.3 |
| Composer | >= 2.x |
| Node.js & NPM | >= 18.x |
| Database | MySQL / SQLite |

> **Opsional:** Gemini API Key untuk mengaktifkan fitur AI Scanner dan BerkahBot secara penuh. Tanpa API Key, sistem tetap berjalan menggunakan engine fallback bawaan.

---

## 🚀 Instalasi

```bash
# 1. Clone repositori
git clone https://github.com/Khair222/SisaBerkah.git
cd SisaBerkah

# 2. Install dependensi PHP
composer install

# 3. Salin file environment
cp .env.example .env

# 4. Generate application key
php artisan key:generate

# 5. Sesuaikan konfigurasi database di file .env
#    DB_CONNECTION, DB_DATABASE, DB_USERNAME, DB_PASSWORD

# 6. (Opsional) Tambahkan Gemini API Key di .env untuk fitur AI
#    GEMINI_API_KEY=your_api_key_here

# 7. Jalankan migrasi database
php artisan migrate

# 8. Install dependensi frontend
npm install

# 9. Build assets frontend (Tailwind CSS + Vite)
npm run build
```

---

## ▶️ Menjalankan Program

### Mode Produksi

```bash
php artisan serve
```

Akses aplikasi di browser: **http://localhost:8000**

### Mode Development (Semua Layanan Sekaligus)

```bash
composer run dev
```

> Perintah ini menjalankan Laravel server, queue worker, dan Vite hot-reload secara bersamaan dalam satu terminal.

---

## 📁 Struktur Direktori Utama

```
SisaBerkah/
├── app/Http/Controllers/   # Logic utama (Auth, Home, Mitra, AI Scanner, Chatbot)
├── database/migrations/    # Skema database (users, mitra_profiles, pasokan_masuk)
├── resources/              # Tampilan (views) & assets frontend
├── routes/web.php          # Definisi seluruh rute aplikasi
└── public/                 # File yang dapat diakses publik (uploads, assets)
```
