-- ==========================================================
-- SISABERKAH — Database Schema & Data untuk SUPABASE (PostgreSQL)
-- ==========================================================

-- 1. Table: users (Khusus Akun Pengguna Biasa)
CREATE TABLE IF NOT EXISTS users (
  id SERIAL PRIMARY KEY,
  name VARCHAR(150) NOT NULL,
  email VARCHAR(150) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 2. Table: admin_mitra (Khusus Akun Login Admin Mitra)
CREATE TABLE IF NOT EXISTS admin_mitra (
  id SERIAL PRIMARY KEY,
  mitra_id VARCHAR(64) NULL,
  name VARCHAR(150) NOT NULL,
  email VARCHAR(150) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE INDEX IF NOT EXISTS idx_admin_mitra_mitra_id ON admin_mitra(mitra_id);

-- 3. Table: mitra_profiles (Data Profil Usaha & Kebutuhan Mitra)
CREATE TABLE IF NOT EXISTS mitra_profiles (
  id VARCHAR(64) PRIMARY KEY,
  user_id INT NULL,
  name VARCHAR(150) NOT NULL,
  owner VARCHAR(150) NOT NULL,
  category VARCHAR(100) NOT NULL DEFAULT 'Peternakan',
  location VARCHAR(150) NOT NULL,
  full_location TEXT NULL,
  whatsapp VARCHAR(50) NOT NULL,
  image_url TEXT NULL,
  materials_needed TEXT NOT NULL,
  estimated_amount VARCHAR(100) NULL,
  terms_conditions TEXT NULL,
  description TEXT NULL,
  operating_hours VARCHAR(100) NULL,
  status VARCHAR(30) DEFAULT 'active',
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 4. Table: pasokan_masuk (Catatan Pasokan & Calon Penyalur Masuk)
CREATE TABLE IF NOT EXISTS pasokan_masuk (
  id SERIAL PRIMARY KEY,
  mitra_id VARCHAR(64) NOT NULL,
  tanggal DATE NOT NULL,
  nama_penyalur VARCHAR(150) NOT NULL,
  kontak_wa VARCHAR(50) NULL,
  jenis_bahan VARCHAR(255) NOT NULL,
  volume VARCHAR(100) NOT NULL,
  status VARCHAR(50) NOT NULL DEFAULT 'Menunggu Konfirmasi',
  catatan TEXT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE INDEX IF NOT EXISTS idx_pasokan_masuk_mitra_id ON pasokan_masuk(mitra_id);
CREATE INDEX IF NOT EXISTS idx_pasokan_masuk_status ON pasokan_masuk(status);

-- --------------------------------------------------------
-- Seed Data: Akun Admin Mitra Default (Peternakan Pak Doni)
-- Email: doni@sisaberkah.id | Password: mitra123
-- --------------------------------------------------------
INSERT INTO admin_mitra (id, mitra_id, name, email, password) 
VALUES (1, 'doni', 'Peternakan Pak Doni', 'doni@sisaberkah.id', '$2y$12$zPBXCgbxUi5wqMwF6fVXx.2caw.KSQvICdG6xxNEaVUHpU8vZYNTa')
ON CONFLICT (id) DO NOTHING;

SELECT setval('admin_mitra_id_seq', (SELECT COALESCE(MAX(id), 1) FROM admin_mitra));

-- --------------------------------------------------------
-- Seed Data: Profil Mitra
-- --------------------------------------------------------
INSERT INTO mitra_profiles (
  id, user_id, name, owner, category, location, full_location, 
  whatsapp, image_url, materials_needed, estimated_amount, 
  terms_conditions, description, operating_hours, status
) VALUES 
('doni', 1, 'Peternakan Pak Doni', 'Pak Doni Prasetyo', 'Peternakan', 'Pakem, Sleman', 
 'Jl. Kaliurang Km 18, Pakem, Sleman, D.I. Yogyakarta', '6283193738711', 
 'assets/images/partner_doni.jpg', 
 'Ampas tahu segar, ampas kelapa, & sisa sayuran hijau (sawi, kangkung, kubis)', 
 '150 - 500 Kg / minggu', 
 'Ampas tahu maksimal 24 jam setelah produksi, bebas kantong kresek.', 
 'Peternakan kambing etawa dan domba pedesaan dengan kandang panggung modern, mengutamakan pakan berbasis hijauan dan ampas organik.', 
 'Senin - Sabtu, 07:00 - 16:00 WIB', 'active'),

('mitra_khair_88af', 2, 'Khair Bio-Farm & Maggot BSF', 'Fathul Khair', 'Peternakan', 'Ngaglik, Sleman', 
 'Jl. Kaliurang Km 10, Ngaglik, Sleman, D.I. Yogyakarta', '6283193738711', 
 'assets/images/partner_haris.jpg', 
 'Sisa makanan basah resto, sisa sayur katering, limbah buah pasar, & sisa nasi', 
 '200 - 500 Kg / minggu', 
 'Bebas plastik, tusuk sate, dan bahan kimia, maksimal 48 jam.', 
 'Peternakan larva Black Soldier Fly (BSF / Maggot) dan unggas ramah lingkungan untuk pengurai sampah organik aktif.', 
 'Senin - Sabtu, 08:00 - 16:00 WIB', 'active'),

('mitra_unggas_berkah', NULL, 'Peternakan Unggas Berkah', 'H. Bambang Sutrisno', 'Peternakan', 'Imogiri, Bantul', 
 'Jl. Imogiri Timur Km 14, Imogiri, Bantul, D.I. Yogyakarta', '6281234567801', 
 'assets/images/waste_market.jpg', 
 'Ampas jagung, dedak halus, sisa sayuran sawi & kubis pasar terpilah', 
 '300 - 700 Kg / minggu', 
 'Bahan segar, tidak berbau busuk tajam, bebas paku atau kawat.', 
 'Peternakan ayam petelur dan itik modern ramah lingkungan dengan pemanfaatan pakan tambahan organik.', 
 'Senin - Sabtu, 07:00 - 16:30 WIB', 'active'),

('mitra_haris_sayur', NULL, 'Kebun Sayur Organik Pak Budi', 'Budi Santoso', 'Pertanian', 'Cangkringan, Sleman', 
 'Jl. Merapi Golf Km 3, Cangkringan, Sleman, D.I. Yogyakarta', '6281234567802', 
 'assets/images/partner_budi.jpg', 
 'Daun-daunan hijau pangkasan, limbah sisa sayur pasar, ampas kelapa', 
 '400 - 800 Kg / minggu', 
 'Bebas plastik dan residu pestisida kimia sintetis.', 
 'Perkebunan holtikultura dan sayuran organik lereng Gunung Merapi bersertifikat ramah lingkungan.', 
 'Senin - Sabtu, 06:30 - 15:00 WIB', 'active'),

('mitra_hidroponik_green', NULL, 'Green Agrotech Nusantara', 'Ir. Siti Rahmawati', 'Pertanian', 'Berbah, Sleman', 
 'Kawasan Agroeduwisata Berbah, Sleman, D.I. Yogyakarta', '6281234567803', 
 'assets/images/waste_vegetables.jpg', 
 'Sisa kulit buah (jeruk, nanas, pepaya) untuk mikroba ekoenzim & POC', 
 '150 - 350 Kg / minggu', 
 'Buah belum berjamur hitam tebal, kondisi bersih dari sabun atau deterjen.', 
 'Pusat budidaya tanaman pangan dan buah hortikultura berbasis pupuk fermentasi organik cair.', 
 'Senin - Jumat, 08:00 - 16:00 WIB', 'active'),

('mitra_kebun_buah_lestari', NULL, 'Agro Wisata Kebun Buah Lestari', 'Agus Wijaya', 'Pertanian', 'Nanggulan, Kulon Progo', 
 'Sentra Holtikultura Nanggulan, Kulon Progo, D.I. Yogyakarta', '6281234567804', 
 'assets/images/about_organic.jpg', 
 'Kulit pisang, sabut kelapa, kulit kacang, & dedaunan kering kebun', 
 '500 - 1.000 Kg / minggu', 
 'Kadar air sedang, bebas puntung rokok dan sampah anorganik.', 
 'Perkebunan buah melon dan semangka organik yang memanfaatkan mulsa dan pupuk kompos hayati mandiri.', 
 'Setiap Hari, 07:00 - 17:00 WIB', 'active'),

('mitra_rumah_kompos_adam', NULL, 'Rumah Kompos Adam Sejahtera', 'Adam Pramono', 'Pengolahan Kompos', 'Kasihan, Bantul', 
 'Jl. Bibis Raya, Kasihan, Bantul, D.I. Yogyakarta', '6281234567805', 
 'assets/images/partner_adam.jpg', 
 'Limbah sayuran basah dapur resto, sisa nasi basi, & serbuk gergaji kayu', 
 '1 - 3 Ton / minggu', 
 'Terpilah rapi, dapat dijemput dengan armada pick-up jika volume > 200 kg.', 
 'Unit pengolahan kompos terpadu yang memproduksi pupuk organik granular dan nutrisi tanah siap pakai.', 
 'Senin - Sabtu, 08:00 - 17:00 WIB', 'active'),

('mitra_kompos_lestari_jogja', NULL, 'Sentra Kompos Hijau Mandiri', 'Dra. Endang Kusuma', 'Pengolahan Kompos', 'Umbulharjo, Kota Yogyakarta', 
 'Kawasan Pengelolaan Sampah Mandiri, Umbulharjo, Kota Yogyakarta', '6281234567806', 
 'assets/images/hero_compost.jpg', 
 'Ampas bubuk kopi kafe, kulit telur ayam, limbah sisa makanan hotel', 
 '500 - 1.500 Kg / minggu', 
 'Dipisahkan antara sisa basah dan sisa kering, bebas kemasan sachet.', 
 'Fasilitas pengolahan kompos perkotaan yang bermitra dengan hotel, restoran, dan kafe di Yogyakarta.', 
 'Senin - Sabtu, 08:00 - 16:00 WIB', 'active'),

('mitra_bio_organik_nusantara', NULL, 'Bio-Fertilizer Makmur Abadi', 'Raden Hendra Kusumo', 'Pengolahan Kompos', 'Kalasan, Sleman', 
 'Jl. Solo Km 13, Kalasan, Sleman, D.I. Yogyakarta', '6281234567807', 
 'assets/images/waste_leaves.jpg', 
 'Daun kering taman, sisa pangkasan ranting pohon, ampas tahu fermentasi', 
 '800 - 2.000 Kg / minggu', 
 'Ranting maksimal diameter 3 cm, tidak tercampur kawat atau tali rafia.', 
 'Pabrik pupuk organik hayati dan pembenah tanah yang mendistribusikan pupuk alami untuk kelompok tani.', 
 'Senin - Jumat, 07:30 - 16:30 WIB', 'active')
ON CONFLICT (id) DO NOTHING;

-- --------------------------------------------------------
-- Seed Data: Akun Pengguna Biasa Default
-- Email: user@sisaberkah.id | Password: user123
-- --------------------------------------------------------
INSERT INTO users (id, name, email, password) 
VALUES (1, 'Pengguna SisaBerkah', 'user@sisaberkah.id', '$2y$12$Ic5xFY3Sx5XJi2zZfeS1UetrpgorYmx3ZtMa4N6LkQrUsi7B9H7U6')
ON CONFLICT (id) DO NOTHING;

SELECT setval('users_id_seq', (SELECT COALESCE(MAX(id), 1) FROM users));

-- --------------------------------------------------------
-- Seed Data: Pasokan Masuk untuk Mitra
-- --------------------------------------------------------
INSERT INTO pasokan_masuk (id, mitra_id, tanggal, nama_penyalur, kontak_wa, jenis_bahan, volume, status, catatan) 
VALUES 
(1, 'doni', '2026-10-23', 'Pabrik Tahu Sumber Rejeki (Pak RT)', '6281234567890', 'Ampas tahu putih segar (hangat)', '250 Kg', 'Rutin Mingguan', 'Kualitas bagus, minim kadar air.'),
(2, 'doni', '2026-10-22', 'Rumah Makan Padang Saiyo', '6289876543210', 'Sisa sayuran kubis & ampas kelapa', '120 Kg', 'Jadwal Penjemputan', 'Jadwal jemput tiap jam 16.00 WIB.'),
(3, 'doni', '2026-10-20', 'Katering Berkah Bersama (Ibu Siti)', '6281357924680', 'Potongan sayur sawi & wortel', '80 Kg', 'Selesai Diterima', 'Sudah dicacah rapi sebelum dikirim.'),
(4, 'mitra_khair_88af', '2026-10-24', 'Pabrik Tahu Sumber Barokah (Pak Haji)', '6281234567890', 'Ampas tahu kedelai segar (hangat)', '300 Kg / minggu', 'Rutin Mingguan', 'Diambil setiap Selasa & Jumat pagi jam 08.00.'),
(5, 'mitra_khair_88af', '2026-10-23', 'Restoran Padang Minang Saiyo', '6282198765432', 'Sisa sayuran sawi, kol, & ampas kelapa', '150 Kg', 'Jadwal Penjemputan', 'Lokasi dapur belakang, sudah dipisah dari plastik.'),
(6, 'mitra_khair_88af', '2026-10-21', 'Katering Berkah Ibu Hj. Siti', '6285277889900', 'Potongan wortel, labu siam, & sisa nasi', '85 Kg', 'Selesai Diterima', 'Bahan sudah diterima dalam kondisi bersih dan baik.'),
(7, 'mitra_khair_88af', '2026-10-19', 'Pasar Buah & Sayur Segar Jaya', '6287711223344', 'Kulit buah pisang, pepaya, & sayur hijau', '200 Kg', 'Menunggu Konfirmasi', 'Penyalur menanyakan konfirmasi jadwal armada pick up.'),
(8, 'mitra_khair_88af', '2026-10-18', 'Kedai Kopi & Juice Bar Sedap', '6281955667788', 'Ampas kopi basah & ampas perasan jeruk', '45 Kg / minggu', 'Rutin Mingguan', 'Pengambilan rutin tiap Sabtu sore setelah kedai tutup.')
ON CONFLICT (id) DO NOTHING;

SELECT setval('pasokan_masuk_id_seq', (SELECT COALESCE(MAX(id), 1) FROM pasokan_masuk));
