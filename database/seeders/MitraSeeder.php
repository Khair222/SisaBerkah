<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\MitraProfile;

class MitraSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Ensure User Accounts
        $doniUser = User::firstOrCreate(
            ['email' => 'doni@sisaberkah.id'],
            [
                'name' => 'Peternakan Pak Doni',
                'password' => Hash::make('mitra123'),
                'role' => 'mitra',
            ]
        );

        User::firstOrCreate(
            ['email' => 'user@sisaberkah.id'],
            [
                'name' => 'Pengguna SisaBerkah',
                'password' => Hash::make('user123'),
                'role' => 'user',
            ]
        );

        // 2. Default 6 Mitra Profiles
        $mitras = [
            [
                'id' => 'doni',
                'user_id' => $doniUser->id,
                'name' => 'Peternakan Pak Doni',
                'owner' => 'Pak Doni Prasetyo',
                'category' => 'Peternakan',
                'location' => 'Pakem, Sleman',
                'full_location' => 'Jl. Kaliurang Km 18, Pakem, Sleman, D.I. Yogyakarta',
                'whatsapp' => '6283193738711',
                'image_url' => 'assets/images/partner_doni.jpg',
                'materials_needed' => 'Ampas tahu segar, ampas kelapa, & sisa sayuran hijau (sawi, kangkung, kubis)',
                'estimated_amount' => '150 – 500 Kg / minggu',
                'terms_conditions' => 'Ampas tahu maksimal 24 jam setelah produksi, bebas kantong kresek.',
                'description' => 'Peternakan kambing etawa dan domba pedesaan dengan kandang panggung modern, mengutamakan pakan berbasis hijauan dan ampas organik.',
                'operating_hours' => 'Senin - Sabtu, 07:00 - 16:00 WIB',
                'status' => 'active',
            ],
            [
                'id' => 'budi',
                'user_id' => null,
                'name' => 'Peternakan Pak Budi',
                'owner' => 'Pak Budi Santoso',
                'category' => 'Peternakan',
                'location' => 'Cisarua, Bogor',
                'full_location' => 'Cisarua, Bogor, Jawa Barat',
                'whatsapp' => '6283193738711',
                'image_url' => 'assets/images/partner_budi.jpg',
                'materials_needed' => 'Roti afkir & sisa bahan roti yang tidak berjamur',
                'estimated_amount' => '100 – 300 Kg / minggu',
                'terms_conditions' => 'Bebas staples, kantong plastik, dan jamur hitam beracun.',
                'description' => 'Peternakan sapi perah & potong yang membuka peluang kerja sama dengan pemasok bahan organik terpilah yang sesuai untuk kebutuhan pakan ternaknya.',
                'operating_hours' => 'Setiap hari, 06:00 - 17:00 WIB',
                'status' => 'active',
            ],
            [
                'id' => 'adam',
                'user_id' => null,
                'name' => 'Peternakan Pak Adam',
                'owner' => 'Pak Adam Firmansyah',
                'category' => 'Peternakan',
                'location' => 'Karangploso, Malang',
                'full_location' => 'Karangploso, Malang, Jawa Timur',
                'whatsapp' => '6283193738711',
                'image_url' => 'assets/images/partner_adam.jpg',
                'materials_needed' => 'Sisa sayuran segar pasar, buah afkir (pepaya, semangka, pisang), & sisa karbohidrat bersih',
                'estimated_amount' => '50 – 200 Kg / minggu',
                'terms_conditions' => 'Belum busuk berlendir parah, tidak tercampur minyak jelantah kotor.',
                'description' => 'Peternakan ayam kampung dan unggas semi-umbaran ramah lingkungan dengan formulasi pakan alami bernutrisi seimbang.',
                'operating_hours' => 'Senin - Sabtu, 08:00 - 15:00 WIB',
                'status' => 'active',
            ],
            [
                'id' => 'haris',
                'user_id' => null,
                'name' => 'Peternakan Pak Haris',
                'owner' => 'Pak Haris Maulana',
                'category' => 'Peternakan',
                'location' => 'Cipondoh, Tangerang',
                'full_location' => 'Cipondoh, Tangerang, Banten',
                'whatsapp' => '6283193738711',
                'image_url' => 'assets/images/partner_haris.jpg',
                'materials_needed' => 'Sisa makanan katering, sisa dapur restoran, & sisa potongan sayur hotel',
                'estimated_amount' => '300 – 800 Kg / minggu',
                'terms_conditions' => 'Wajib terpisah dari tusuk sate, plastik, dan tulang sapi besar.',
                'description' => 'Sentra biokonversi Maggot Black Soldier Fly (BSF) perkotaan. Mengolah limbah makanan organik basah menjadi pakan berprotein tinggi.',
                'operating_hours' => 'Setiap hari, 08:00 - 17:00 WIB',
                'status' => 'active',
            ],
            [
                'id' => 'andi',
                'user_id' => null,
                'name' => 'Pertanian Pak Andi',
                'owner' => 'Pak Andi Wijaya',
                'category' => 'Pertanian',
                'location' => 'Cisaat, Sukabumi',
                'full_location' => 'Cisaat, Sukabumi, Jawa Barat',
                'whatsapp' => '6283193738711',
                'image_url' => 'assets/images/about_organic.jpg',
                'materials_needed' => 'Daun gugur kering, serasah kebun, kulit buah manis, & pangkasan tanaman',
                'estimated_amount' => '200 – 600 Kg / minggu',
                'terms_conditions' => 'Bebas dari pestisida kimia sintetis, bersih dalam karung goni.',
                'description' => 'Lahan perkebunan hortikultura organik dan tanaman buah tropis. Menggunakan sistem pertanian regeneratif dan pembuatan pupuk organik cair (POC).',
                'operating_hours' => 'Senin - Jumat, 07:00 - 15:00 WIB',
                'status' => 'active',
            ],
            [
                'id' => 'dedi',
                'user_id' => null,
                'name' => 'Pengolahan Kompos Pak Dedi',
                'owner' => 'Pak Dedi Kusuma',
                'category' => 'Pengolahan Kompos',
                'location' => 'Lembang, Bandung',
                'full_location' => 'Lembang, Bandung, Jawa Barat',
                'whatsapp' => '6283193738711',
                'image_url' => 'assets/images/hero_compost.jpg',
                'materials_needed' => 'Ampas kopi espresso/tubruk, sisa teh celup lepas, & sisa sayuran pasar',
                'estimated_amount' => '500 – 1.200 Kg / minggu',
                'terms_conditions' => 'Bebas puntung rokok, kantong teh sintetis, dan staples.',
                'description' => 'Pusat produksi kompos organik granular dan vermikompos untuk penghijauan kota. Menerima bahan kaya nitrogen dan karbon dari berbagai usaha.',
                'operating_hours' => 'Setiap hari, 07:00 - 16:30 WIB',
                'status' => 'active',
            ],
        ];

        foreach ($mitras as $m) {
            MitraProfile::updateOrCreate(['id' => $m['id']], $m);
        }
    }
}
