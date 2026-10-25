<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\AdminMitra;
use App\Models\MitraProfile;
use App\Models\PasokanMasuk;

class MitraSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Pengguna Biasa (User)
        User::firstOrCreate(
            ['email' => 'user@sisaberkah.id'],
            [
                'name' => 'Pengguna SisaBerkah',
                'password' => Hash::make('user123'),
                'role' => 'user',
            ]
        );

        // 2. Akun Admin Mitra (Pak Doni)
        $adminDoni = AdminMitra::firstOrCreate(
            ['email' => 'doni@sisaberkah.id'],
            [
                'mitra_id' => 'doni',
                'name' => 'Peternakan Pak Doni',
                'password' => Hash::make('mitra123'),
            ]
        );

        // 3. Akun Admin Mitra (Khair Bio-Farm)
        AdminMitra::firstOrCreate(
            ['email' => 'khair@sisaberkah.id'],
            [
                'mitra_id' => 'mitra_khair_88af',
                'name' => 'Khair Bio-Farm & Maggot BSF',
                'password' => Hash::make('mitra123'),
            ]
        );

        // 4. Data Profil Mitra Lengkap
        $mitras = [
            [
                'id' => 'doni',
                'user_id' => $adminDoni->id,
                'name' => 'Peternakan Pak Doni',
                'owner' => 'Pak Doni Prasetyo',
                'category' => 'Peternakan',
                'location' => 'Pakem, Sleman',
                'full_location' => 'Jl. Kaliurang Km 18, Pakem, Sleman, D.I. Yogyakarta',
                'whatsapp' => '6283193738711',
                'image_url' => 'assets/images/partner_doni.jpg',
                'materials_needed' => 'Ampas tahu segar, ampas kelapa, & sisa sayuran hijau (sawi, kangkung, kubis)',
                'estimated_amount' => '150 - 500 Kg / minggu',
                'terms_conditions' => 'Ampas tahu maksimal 24 jam setelah produksi, bebas kantong kresek.',
                'description' => 'Peternakan kambing etawa dan domba pedesaan dengan kandang panggung modern, mengutamakan pakan berbasis hijauan dan ampas organik.',
                'operating_hours' => 'Senin - Sabtu, 07:00 - 16:00 WIB',
                'status' => 'active',
            ],
            [
                'id' => 'mitra_khair_88af',
                'user_id' => null,
                'name' => 'Khair Bio-Farm & Maggot BSF',
                'owner' => 'Fathul Khair',
                'category' => 'Peternakan',
                'location' => 'Ngaglik, Sleman',
                'full_location' => 'Jl. Kaliurang Km 10, Ngaglik, Sleman, D.I. Yogyakarta',
                'whatsapp' => '6283193738711',
                'image_url' => 'assets/images/partner_haris.jpg',
                'materials_needed' => 'Sisa makanan basah resto, sisa sayur katering, limbah buah pasar, & sisa nasi',
                'estimated_amount' => '200 - 500 Kg / minggu',
                'terms_conditions' => 'Bebas plastik, tusuk sate, dan bahan kimia, maksimal 48 jam.',
                'description' => 'Peternakan larva Black Soldier Fly (BSF / Maggot) dan unggas ramah lingkungan untuk pengurai sampah organik aktif.',
                'operating_hours' => 'Senin - Sabtu, 08:00 - 16:00 WIB',
                'status' => 'active',
            ],
            [
                'id' => 'mitra_unggas_berkah',
                'user_id' => null,
                'name' => 'Peternakan Unggas Berkah',
                'owner' => 'H. Bambang Sutrisno',
                'category' => 'Peternakan',
                'location' => 'Imogiri, Bantul',
                'full_location' => 'Jl. Imogiri Timur Km 14, Imogiri, Bantul, D.I. Yogyakarta',
                'whatsapp' => '6281234567801',
                'image_url' => 'assets/images/waste_market.jpg',
                'materials_needed' => 'Ampas jagung, dedak halus, sisa sayuran sawi & kubis pasar terpilah',
                'estimated_amount' => '300 - 700 Kg / minggu',
                'terms_conditions' => 'Bahan segar, tidak berbau busuk tajam, bebas paku atau kawat.',
                'description' => 'Peternakan ayam petelur dan itik modern ramah lingkungan dengan pemanfaatan pakan tambahan organik.',
                'operating_hours' => 'Senin - Sabtu, 07:00 - 16:30 WIB',
                'status' => 'active',
            ],
            [
                'id' => 'mitra_haris_sayur',
                'user_id' => null,
                'name' => 'Kebun Sayur Organik Pak Budi',
                'owner' => 'Budi Santoso',
                'category' => 'Pertanian',
                'location' => 'Cangkringan, Sleman',
                'full_location' => 'Jl. Merapi Golf Km 3, Cangkringan, Sleman, D.I. Yogyakarta',
                'whatsapp' => '6281234567802',
                'image_url' => 'assets/images/partner_budi.jpg',
                'materials_needed' => 'Daun-daunan hijau pangkasan, limbah sisa sayur pasar, ampas kelapa',
                'estimated_amount' => '400 - 800 Kg / minggu',
                'terms_conditions' => 'Bebas plastik dan residu pestisida kimia sintetis.',
                'description' => 'Perkebunan holtikultura dan sayuran organik lereng Gunung Merapi bersertifikat ramah lingkungan.',
                'operating_hours' => 'Senin - Sabtu, 06:30 - 15:00 WIB',
                'status' => 'active',
            ],
            [
                'id' => 'mitra_hidroponik_green',
                'user_id' => null,
                'name' => 'Green Agrotech Nusantara',
                'owner' => 'Ir. Siti Rahmawati',
                'category' => 'Pertanian',
                'location' => 'Berbah, Sleman',
                'full_location' => 'Kawasan Agroeduwisata Berbah, Sleman, D.I. Yogyakarta',
                'whatsapp' => '6281234567803',
                'image_url' => 'assets/images/waste_vegetables.jpg',
                'materials_needed' => 'Sisa kulit buah (jeruk, nanas, pepaya) untuk mikroba ekoenzim & POC',
                'estimated_amount' => '150 - 350 Kg / minggu',
                'terms_conditions' => 'Buah belum berjamur hitam tebal, kondisi bersih dari sabun atau deterjen.',
                'description' => 'Pusat budidaya tanaman pangan dan buah hortikultura berbasis pupuk fermentasi organik cair.',
                'operating_hours' => 'Senin - Jumat, 08:00 - 16:00 WIB',
                'status' => 'active',
            ],
            [
                'id' => 'mitra_rumah_kompos_adam',
                'user_id' => null,
                'name' => 'Rumah Kompos Adam Sejahtera',
                'owner' => 'Adam Pramono',
                'category' => 'Pengolahan Kompos',
                'location' => 'Kasihan, Bantul',
                'full_location' => 'Jl. Bibis Raya, Kasihan, Bantul, D.I. Yogyakarta',
                'whatsapp' => '6281234567805',
                'image_url' => 'assets/images/partner_adam.jpg',
                'materials_needed' => 'Limbah sayuran basah dapur resto, sisa nasi basi, & serbuk gergaji kayu',
                'estimated_amount' => '1 - 3 Ton / minggu',
                'terms_conditions' => 'Terpilah rapi, dapat dijemput dengan armada pick-up jika volume > 200 kg.',
                'description' => 'Unit pengolahan kompos terpadu yang memproduksi pupuk organik granular dan nutrisi tanah siap pakai.',
                'operating_hours' => 'Senin - Sabtu, 08:00 - 17:00 WIB',
                'status' => 'active',
            ],
            [
                'id' => 'mitra_kompos_lestari_jogja',
                'user_id' => null,
                'name' => 'Sentra Kompos Hijau Mandiri',
                'owner' => 'Dra. Endang Kusuma',
                'category' => 'Pengolahan Kompos',
                'location' => 'Umbulharjo, Kota Yogyakarta',
                'full_location' => 'Kawasan Pengelolaan Sampah Mandiri, Umbulharjo, Kota Yogyakarta',
                'whatsapp' => '6281234567806',
                'image_url' => 'assets/images/hero_compost.jpg',
                'materials_needed' => 'Ampas bubuk kopi kafe, kulit telur ayam, limbah sisa makanan hotel',
                'estimated_amount' => '500 - 1.500 Kg / minggu',
                'terms_conditions' => 'Dipisahkan antara sisa basah dan sisa kering, bebas kemasan sachet.',
                'description' => 'Fasilitas pengolahan kompos perkotaan yang bermitra dengan hotel, restoran, dan kafe di Yogyakarta.',
                'operating_hours' => 'Senin - Sabtu, 08:00 - 16:00 WIB',
                'status' => 'active',
            ],
        ];

        foreach ($mitras as $m) {
            MitraProfile::updateOrCreate(['id' => $m['id']], $m);
        }

        // 5. Sample Pasokan Masuk untuk Doni
        PasokanMasuk::firstOrCreate(
            ['mitra_id' => 'doni', 'tanggal' => '2026-10-23', 'nama_penyalur' => 'Pabrik Tahu Sumber Rejeki (Pak RT)'],
            [
                'kontak_wa' => '6281234567890',
                'jenis_bahan' => 'Ampas tahu putih segar (hangat)',
                'volume' => '250 Kg',
                'status' => 'Rutin Mingguan',
                'catatan' => 'Kualitas bagus, minim kadar air.',
            ]
        );

        PasokanMasuk::firstOrCreate(
            ['mitra_id' => 'doni', 'tanggal' => '2026-10-22', 'nama_penyalur' => 'Rumah Makan Padang Saiyo'],
            [
                'kontak_wa' => '6289876543210',
                'jenis_bahan' => 'Sisa sayuran kubis & ampas kelapa',
                'volume' => '120 Kg',
                'status' => 'Jadwal Penjemputan',
                'catatan' => 'Jadwal jemput tiap jam 16.00 WIB.',
            ]
        );
    }
}
