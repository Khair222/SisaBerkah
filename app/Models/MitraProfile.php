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

    protected $appends = ['display_image', 'image'];

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

    /**
     * Alias accessor agar $profile->image selalu mengembalikan image_url.
     */
    public function getImageAttribute()
    {
        return $this->attributes['image_url'] ?? null;
    }

    /**
     * Alias mutator agar $profile->image = ... mengisi image_url.
     */
    public function setImageAttribute($value)
    {
        $this->attributes['image_url'] = $value;
    }

    /**
     * Dapatkan URL foto yang aman dan siap ditampilkan di tag <img src>.
     * Mendukung data URI (base64 upload), URL eksternal (http/https), aset lokal (assets/), atau storage.
     */
    public function getDisplayImageAttribute()
    {
        $img = $this->attributes['image_url'] ?? null;
        if (empty($img)) {
            return asset('assets/images/partner_doni.jpg');
        }
        if (str_starts_with($img, 'data:image/') || str_starts_with($img, 'http://') || str_starts_with($img, 'https://')) {
            return $img;
        }
        if (str_starts_with($img, 'assets/')) {
            return asset($img);
        }
        return asset('storage/' . $img);
    }
}
