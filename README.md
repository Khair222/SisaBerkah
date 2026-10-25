# 🌱 SISABERKAH — Dari Sisa Menjadi Berkah
> **Platform Digital Sirkular Pemanfaatan Limbah Organik & Sisa Makanan Berbasis Artificial Intelligence (AI)**

[![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.3%2B-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-v4.0-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white)](https://tailwindcss.com)
[![Vite](https://img.shields.io/badge/Vite-6.x%2F8.x-646CFF?style=for-the-badge&logo=vite&logoColor=white)](https://vitejs.dev)
[![Google Gemini](https://img.shields.io/badge/Google_Gemini-Vision_%26_Chat-8E75B2?style=for-the-badge&logo=google&logoColor=white)](https://ai.google.dev/)
[![MySQL](https://img.shields.io/badge/MySQL-8.x%20%2F%20MariaDB-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com/)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg?style=for-the-badge)](LICENSE)

---

## 📖 1. Deskripsi Singkat

**SisaBerkah** adalah platform digital inovatif yang dirancang untuk mengatasi permasalahan *food waste* dan limbah organik di tingkat hulu (restoran, hotel, katering, kafe, pasar tradisional, dan rumah tangga) dengan menghubungkannya langsung ke sektor hilir yang produktif, yaitu **peternakan**, **pertanian**, **budidaya maggot BSF (Black Soldier Fly)**, dan **sentra pengolahan kompos**.

Alih-alih berakhir di Tempat Pembuangan Akhir (TPA) yang memicu emisi gas metana atau dibakar yang merusak lingkungan, limbah organik dialirkan kembali ke dalam siklus ekonomi sirkular (*circular economy*).

### 🌟 Fitur Utama Unggulan
1. **🔍 AI Waste Scanner (Computer Vision Multimodal)**
   - Menganalisis foto limbah organik secara *real-time* via kamera webcam langsung, unggah berkas gambar, atau sampel uji coba.
   - Menggunakan model **Google Gemini AI Multimodal** yang dikombinasikan dengan sistem analisis cerdas untuk mendeteksi:
     - Jenis limbah organik (ampas tahu, sayuran hijau, sisa buah, nasi, sisa makanan hewani, dll.)
     - Tingkat kesegaran dan kelayakan bahan
     - Tingkat kontaminasi (plastik, tusuk sate, deterjen)
     - Rekomendasi peruntukan optimal (Pakan Kambing/Sapi, Unggas, Maggot BSF, atau Kompos Ekoenzim)
     - Rekomendasi otomatis mitra penampung terdekat yang membutuhkan bahan tersebut
2. **🤖 BerkahBot (AI Assistant Konsultasi Organik)**
   - Asisten virtual pintar interaktif berbasis **Gemini 2.5 Flash / 2.0 Flash**.
   - Siap menjawab konsultasi cara pemilahan limbah, pembuatan kompos ramah lingkungan, budidaya larva maggot BSF, formula pupuk cair organik (POC/Eco-enzyme), hingga mencarikan kontak WhatsApp mitra terdekat.
3. **🤝 Direktori & Profil Kemitraan Terverifikasi**
   - Katalog lengkap mitra peternak dan sentra daur ulang organik di wilayah D.I. Yogyakarta dan sekitarnya.
   - Informasi transparan mencakup: jenis bahan yang dibutuhkan, kuota/kapasitas mingguan, syarat & ketentuan penerimaan, alamat lengkap, dan integrasi tombol WhatsApp *One-Click Chat*.
4. **📊 Dashboard Manajemen Mitra (Admin Mitra)**
   - Ruang kerja khusus mitra untuk mengelola profil usaha, foto operasional, jenis pasokan yang sedang dicari, kapasitas mingguan, dan jam terima.
   - **Pencatatan Pasokan Masuk**: Sistem manajemen log pasokan bahan masuk (nama penyalur, tanggal, volume, status konfirmasi/penjemputan/selesai, catatan mutu).
5. **👤 Portal Pengguna (Donatur / Penyalur)**
   - Manajemen akun pengguna perorangan / pelaku usaha kuliner.
   - Kelola identitas, riwayat kontribusi limbah, dan pembaruan kata sandi.
6. **🔐 Multi-Guard Authentication**
   - Sistem autentikasi terpisah antara akun Pengguna Biasa (`guard: web`) dan Admin Pengelola Mitra (`guard: mitra`) untuk proteksi akses data yang ketat.

---

## 🛠️ 2. Arsitektur & Teknologi (Tech Stack)

| Lapisan (Layer) | Teknologi yang Digunakan |
|---|---|
| **Core Framework** | [Laravel 12.x](https://laravel.com) (PHP 8.3+) |
| **Arsitektur Auth** | Multi-Guard Authentication (`web` & `mitra` guards) |
| **Frontend UI** | Blade Templating Engine, Tailwind CSS v4, Custom Design System (`public/style.css`) |
| **Ikon & Tipografi** | Lucide Icons, Plus Jakarta Sans / Instrument Sans |
| **AI / Machine Learning** | Google Gemini API (`gemini-2.5-flash`, `gemini-2.0-flash`, `gemini-1.5-flash`) |
| **Database** | MySQL / MariaDB (Didukung juga SQLite & PostgreSQL) |
| **Asset Bundler** | [Vite 6 / 8](https://vitejs.dev) dengan `@tailwindcss/vite` |
| **HTTP & Interaktivitas** | Vanilla JS, Fetch API (AJAX JSON), WebRTC MediaDevices API (Camera Scanner) |

---

## 💻 3. Prasyarat Sistem (System Requirements)

Sebelum memulai instalasi, pastikan perangkat Anda telah terpasang perangkat lunak berikut:

- **PHP** versi `8.2` atau `8.3` ke atas
  - Ekstensi PHP yang wajib aktif: `pdo_mysql` (atau `pdo_sqlite`), `curl`, `mbstring`, `fileinfo`, `openssl`, `bcmath`.
- **Composer** (versi 2.x ke atas) — [getcomposer.org](https://getcomposer.org/)
- **Node.js** (versi 18.x / 20.x ke atas) & **NPM** — [nodejs.org](https://nodejs.org/)
- **Database Server**:
  - **MySQL / MariaDB** (melalui XAMPP, Laragon, Docker, atau instalasi native)
- **Web Browser Modern** (Google Chrome, Microsoft Edge, Firefox) dengan dukungan WebRTC kamera & Javascript aktif.

---

## 🚀 4. Langkah-Langkah Instalasi (Installation Guide)

Ikuti langkah-langkah terstruktur di bawah ini untuk memasang SisaBerkah di komputer lokal Anda:

### Langkah 1: Siapkan Direktori Proyek
Buka terminal (PowerShell / Command Prompt / Git Bash), lalu pastikan Anda berada di direktori proyek:
```bash
cd c:\Users\Lenovo\Downloads\SisaBerkah
```

### Langkah 2: Pasang Dependensi Backend (Composer)
Jalankan perintah berikut untuk mengunduh seluruh dependensi pustaka PHP:
```bash
composer install
```

### Langkah 3: Pasang Dependensi Frontend (NPM)
Jalankan instalasi pustaka JavaScript dan CSS Tailwind:
```bash
npm install
```

### Langkah 4: Konfigurasi File Lingkungan (`.env`)
Salin berkas template lingkungan `.env.example` menjadi `.env`:
- **Di Windows PowerShell:**
  ```powershell
  Copy-Item .env.example .env
  ```
- **Di Git Bash / Linux / macOS:**
  ```bash
  cp .env.example .env
  ```

### Langkah 5: Generate Application Encryption Key
Jalankan generator kunci aplikasi Laravel:
```bash
php artisan key:generate
```

### Langkah 6: Konfigurasi Database

#### Opsi A: Menggunakan MySQL (Disarankan - Sesuai Pengaturan XAMPP / Laragon)
1. Nyalakan service **MySQL** pada kontrol panel **XAMPP** atau **Laragon**.
2. Buat database baru bernama `sisaberkah_db` melalui **phpMyAdmin** (`http://localhost/phpmyadmin`) atau terminal:
   ```sql
   CREATE DATABASE sisaberkah_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```
3. Pastikan parameter database pada berkas `.env` sudah sesuai (secara default `.env.example` sudah disesuaikan):
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=sisaberkah_db
   DB_USERNAME=root
   DB_PASSWORD=
   ```
4. **Siapkan Tabel & Data Awal (Pilih salah satu cara berikut):**
   - **Cara 1 (Import SQL - Sangat Mudah via phpMyAdmin):**
     Buka phpMyAdmin > klik database `sisaberkah_db` > pilih tab **Import** > pilih berkas `database/database.sql` > klik **Import**.
     *(Atau via terminal: `mysql -u root -p sisaberkah_db < database/database.sql`)*
   - **Cara 2 (Via Artisan Migration & Seeder):**
     ```bash
     php artisan migrate --seed
     ```

#### Opsi B: Menggunakan SQLite (Opsi Cepat Tanpa MySQL)
Jika ingin menggunakan basis data lokal tanpa XAMPP:
1. Buat berkas database SQLite:
   - **Windows PowerShell:**
     ```powershell
     if (!(Test-Path database/database.sqlite)) { New-Item -ItemType File database/database.sqlite }
     ```
   - **Linux / macOS / Git Bash:**
     ```bash
     touch database/database.sqlite
     ```
2. Ubah baris database di `.env`:
   ```env
   DB_CONNECTION=sqlite
   # Berikan tanda komentar (#) pada DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD
   ```
3. Jalankan migrasi dan isi data awal:
   ```bash
   php artisan migrate --seed
   ```

### Langkah 7: Konfigurasi Google Gemini API (Fitur AI)
Untuk mengaktifkan kemampuan pemindaian limbah (**AI Scanner**) dan asisten virtual (**BerkahBot**), tambahkan API Key Google AI Studio Anda ke berkas `.env`:
```env
GEMINI_API_KEY=masukkan_api_key_gemini_anda_disini
GEMINI_MODEL=gemini-2.5-flash
```
> 💡 *Catatan: Anda dapat memperoleh API Key gratis secara langsung di [Google AI Studio](https://aistudio.google.com/). Apabila API Key belum diisi atau kuota habis, AI Scanner tetap memiliki sistem heuristik fallback cerdas.*

### Langkah 8: Buat Simbolik Link Media Storage
Agar foto profil mitra dan gambar hasil pemindaian limbah dapat diakses secara publik:
```bash
php artisan storage:link
```

---

## ▶️ 5. Panduan Menjalankan Program (How to Run)

Untuk menjalankan aplikasi di lingkungan pengembangan (*local development*), jalankan dua komponen berikut:

### 1. Menjalankan Server Aplikasi Laravel
Buka terminal dan jalankan:
```bash
php artisan serve
```
Aplikasi backend akan aktif dan dapat diakses di:
👉 **[http://127.0.0.1:8000](http://127.0.0.1:8000)**

### 2. Menjalankan Vite Dev Server (Hot Module Replacement)
Buka terminal baru (tab/jendela kedua) dan jalankan:
```bash
npm run dev
```
Vite akan memantau perubahan CSS, Blade, dan JavaScript secara instan.

---

> ⚡ **Tips Praktis (Menjalankan Sekaligus):**
> Anda juga dapat menjalankan backend dan frontend secara bersamaan dengan satu perintah bawaan Composer:
> ```bash
> composer run dev
> ```

---

### 3. Build Aset untuk Mode Produksi (Opsional)
Jika Anda ingin mengompilasi seluruh aset statis agar siap diunggah ke server *production*:
```bash
npm run build
```

---

## 🔑 6. Akun Uji Coba Default (Demo Credentials)

Aplikasi telah dilengkapi dengan data *seed* akun bawaan untuk memudahkan pengujian semua fitur:

### 🌾 Akun Admin Mitra (Pengelola Peternakan / Sentra Kompos)
Gunakan akun ini untuk menguji **Dashboard Mitra**, mengubah profil penerimaan bahan, dan mengelola log pasokan masuk.

| Atribut | Kredensial Uji Coba |
|---|---|
| **URL Login** | `http://127.0.0.1:8000/login?role=mitra` |
| **Email** | `doni@sisaberkah.id` *(atau ketik `doni`)* |
| **Kata Sandi** | `mitra123` |
| **Peran** | Pengelola Usaha "Peternakan Pak Doni" (Pakem, Sleman) |
| **Akses Halaman** | `/kelola-mitra` (Dashboard Kelola Mitra) |

---

### 👤 Akun Pengguna Biasa (Donatur / Penyalur Limbah)
Gunakan akun ini untuk menguji fitur profil penyalur dan alur pengguna umum.

| Atribut | Kredensial Uji Coba |
|---|---|
| **URL Login** | `http://127.0.0.1:8000/login?role=user` |
| **Email** | `user@sisaberkah.id` |
| **Kata Sandi** | `user123` |
| **Peran** | Pengguna Publik / Penyalur Sisa Makanan |
| **Akses Halaman** | `/profil-saya` (Profil Akun Pengguna) |

---

## 📂 7. Struktur Direktori Utama

Berikut ringkasan struktur folder penting dalam proyek SisaBerkah:

```plaintext
SisaBerkah/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── AiScannerController.php    # Pemrosesan gambar AI Vision & pencocokan mitra
│   │       ├── AuthController.php         # Alur Multi-Guard login, register, & logout
│   │       ├── ChatbotController.php      # Integrasi BerkahBot via Gemini API
│   │       ├── HomeController.php         # Halaman beranda & edukasi jenis limbah
│   │       ├── MitraController.php        # Direktori publik & CRUD dashboard mitra
│   │       └── UserController.php         # Profil akun pengguna biasa
│   └── Models/
│       ├── AdminMitra.php                 # Model otentikasi admin mitra
│       ├── MitraProfile.php               # Data profil usaha, kapasitas & kebutuhan mitra
│       ├── PasokanMasuk.php               # Catatan riwayat pasokan limbah masuk
│       └── User.php                       # Model pengguna biasa
├── config/
│   ├── auth.php                           # Definisi guard 'web' dan 'mitra'
│   └── services.php                       # Kredensial Google Gemini API
├── database/
│   ├── database.sql                       # Dump skema MySQL lengkap dengan seed data siap pakai
│   ├── database_postgres.sql              # Dump skema alternatif untuk PostgreSQL
│   ├── database.sqlite                    # Basis data SQLite lokal
│   └── migrations/                        # Berkas migrasi skema tabel Laravel
├── public/
│   ├── assets/
│   │   ├── images/                        # Koleksi foto mitra, limbah organik, avatar bot
│   │   └── js/                            # Skrip pendukung (Lucide icons, Mitra auth)
│   ├── style.css                          # Lembar gaya utama (Design System & Komponen)
│   └── uploads/                           # Direktori penyimpanan unggahan scan & foto
├── resources/
│   ├── css/                               # Entry Tailwind CSS v4 (@import 'tailwindcss')
│   └── views/
│       ├── ai-scanner.blade.php           # Tampilan antarmuka AI Waste Scanner
│       ├── auth/                          # Template halaman Login dan Register
│       ├── home.blade.php                 # Landing page utama SisaBerkah
│       ├── jenis-limbah.blade.php         # Panduan & edukasi pengelompokan limbah
│       ├── layouts/                       # Master template aplikasi (layouts/app.blade.php)
│       ├── mitra/                         # Direktori mitra & Dashboard kelola pasokan
│       ├── partials/                      # Komponen reusable (BerkahBot modal, preloader)
│       └── user/                          # Tampilan profil pengguna
├── routes/
│   └── web.php                            # Definisi seluruh rute web dan API internal
├── .env.example                           # Contoh konfigurasi environment
├── composer.json                          # Daftar dependensi PHP Laravel
├── package.json                           # Daftar dependensi frontend Vite & Tailwind
└── README.md                              # Dokumentasi komprehensif proyek
```

---

## 🧭 8. Peta Rute & Halaman (Route List)

| Metode | URL / Path | Keterangan Halaman | Akses |
|---|---|---|---|
| `GET` | `/` | Beranda (Landing Page) & Mitra Unggulan | Publik |
| `GET` | `/jenis-limbah` | Ensiklopedia & Panduan Pemilahan Limbah Organik | Publik |
| `GET` | `/ai-scanner` | Antarmuka AI Waste Scanner (Webcam / Upload) | Publik |
| `POST` | `/ai-scanner/analyze` | API Analisis Gambar Limbah Organik | Publik |
| `POST` | `/chatbot/message` | API Komunikasi Asisten Virtual BerkahBot | Publik |
| `GET` | `/mitra` | Direktori Katalog Semua Mitra Penerima Limbah | Publik |
| `GET` | `/mitra-detail/{id}` | API Rincian Lengkap Profil Kemitraan (JSON) | Publik |
| `GET` | `/login` | Halaman Masuk (Tab Admin Mitra & Tab Pengguna) | Tamu (*Guest*) |
| `GET` | `/register` | Halaman Pendaftaran Akun Baru | Tamu (*Guest*) |
| `GET` | `/kelola-mitra` | **Dashboard Mitra**: Kelola profil & mutasi pasokan | Khusus Admin Mitra |
| `GET` | `/profil-saya` | **Profil Pengguna**: Informasi akun & donatur | Khusus Pengguna |
| `GET/POST`| `/logout` | Keluar dari sesi login saat ini | Terautentikasi |

---

## ❓ 9. Solusi Masalah Umum (Troubleshooting FAQ)

<details>
<summary><b>1. Error: "SQLSTATE[HY000] [1049] Unknown database 'sisaberkah_db'"</b></summary>

Database belum dibuat di MySQL Anda. Buka phpMyAdmin atau jalankan query SQL:
```sql
CREATE DATABASE sisaberkah_db;
```
Lalu impor berkas `database/database.sql`.
</details>

<details>
<summary><b>2. Tampilan web terlihat berantakan / tidak ada styling</b></summary>

Pastikan Anda telah menjalankan Vite dev server di terminal terpisah:
```bash
npm run dev
```
Atau jika untuk kebutuhan rilis, jalankan `npm run build`.
</details>

<details>
<summary><b>3. Kamera pada fitur AI Scanner tidak mau menyala</b></summary>

- Pastikan Anda memberikan izin akses kamera (*Camera Permission*) pada browser saat dialog konfirmasi muncul.
- Browser modern mewajibkan protokol aman (`https://` atau domain lokal `http://localhost` / `http://127.0.0.1`). Pastikan Anda mengakses via `http://127.0.0.1:8000` atau `http://localhost:8000`.
</details>

<details>
<summary><b>4. AI Scanner atau BerkahBot lambat / tidak merespons</b></summary>

- Periksa kembali apakah parameter `GEMINI_API_KEY` di berkas `.env` sudah valid dan tidak terdapat spasi berlebih.
- Jika limit kuota API Google habis, sistem akan secara otomatis mengalihkan proses ke modul pendeteksian heuristik cadangan.
</details>

<details>
<summary><b>5. Pesan: "Target class [Controller] does not exist" atau Autoload Error</b></summary>

Segarkan mapping kelas Composer dengan perintah:
```bash
composer dump-autoload
php artisan optimize:clear
```
</details>

---

## 📄 10. Lisensi

Proyek ini dirilis di bawah lisensi terbuka [MIT License](LICENSE). Anda diperbolehkan untuk menggunakan, memodifikasi, dan mengembangkan perangkat lunak ini untuk keperluan edukasi, riset, maupun komersial dengan tetap menyertakan atribusi asli pengembang.

---

<p align="center">
  <b>SisaBerkah — Mengubah Sisa Menjadi Berkah untuk Bumi yang Lebih Lestari.</b><br>
  Dibuat dengan ❤️ untuk pelestarian lingkungan dan keberlanjutan ekonomi sirkular Indonesia.
</p>
