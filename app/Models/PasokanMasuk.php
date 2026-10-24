<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasokanMasuk extends Model
{
    protected $table = 'pasokan_masuk';

    protected $fillable = [
        'mitra_id',
        'tanggal',
        'nama_penyalur',
        'kontak_wa',
        'jenis_bahan',
        'volume',
        'status',
        'catatan',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
        ];
    }

    public function mitra()
    {
        return $this->belongsTo(MitraProfile::class, 'mitra_id', 'id');
    }
}
