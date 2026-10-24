<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MitraProfile extends Model
{
    protected $table = 'mitra_profiles';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    const CREATED_AT = null;
    const UPDATED_AT = 'updated_at';

    protected $fillable = [
        'id',
        'user_id',
        'name',
        'owner',
        'category',
        'location',
        'full_location',
        'whatsapp',
        'image_url',
        'materials_needed',
        'estimated_amount',
        'terms_conditions',
        'description',
        'operating_hours',
        'status',
    ];

    public function admin()
    {
        return $this->hasOne(AdminMitra::class, 'mitra_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(AdminMitra::class, 'user_id');
    }

    public function pasokan()
    {
        return $this->hasMany(PasokanMasuk::class, 'mitra_id', 'id')->orderBy('tanggal', 'desc');
    }
}
