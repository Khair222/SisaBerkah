<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Tabel admin_mitra (Otentikasi Login Admin Mitra)
        if (!Schema::hasTable('admin_mitra')) {
            Schema::create('admin_mitra', function (Blueprint $table) {
                $table->id();
                $table->string('mitra_id', 64)->nullable()->index();
                $table->string('name', 150);
                $table->string('email', 150)->unique();
                $table->string('password', 255);
                $table->rememberToken();
                $table->timestamps();
            });
        }

        // 2. Tabel mitra_profiles (Profil Kemitraan & Kebutuhan Bahan)
        if (!Schema::hasTable('mitra_profiles')) {
            Schema::create('mitra_profiles', function (Blueprint $table) {
                $table->string('id', 64)->primary();
                $table->unsignedBigInteger('user_id')->nullable();
                $table->string('name', 150);
                $table->string('owner', 150);
                $table->string('category', 100)->default('Peternakan');
                $table->string('location', 150);
                $table->text('full_location')->nullable();
                $table->string('whatsapp', 50);
                $table->longText('image_url')->nullable();
                $table->text('materials_needed');
                $table->string('estimated_amount', 100)->nullable();
                $table->text('terms_conditions')->nullable();
                $table->text('description')->nullable();
                $table->string('operating_hours', 100)->nullable();
                $table->string('status', 30)->default('active');
                $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            });
        }

        // 3. Tabel pasokan_masuk (Catatan Log Pasokan Limbah Masuk)
        if (!Schema::hasTable('pasokan_masuk')) {
            Schema::create('pasokan_masuk', function (Blueprint $table) {
                $table->id();
                $table->string('mitra_id', 64)->index();
                $table->date('tanggal');
                $table->string('nama_penyalur', 150);
                $table->string('kontak_wa', 50)->nullable();
                $table->string('jenis_bahan', 255);
                $table->string('volume', 100);
                $table->string('status', 50)->default('Menunggu Konfirmasi')->index();
                $table->text('catatan')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasokan_masuk');
        Schema::dropIfExists('mitra_profiles');
        Schema::dropIfExists('admin_mitra');
    }
};
