<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class AdminMitra extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'admin_mitra';

    protected $fillable = [
        'mitra_id',
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function profile()
    {
        return $this->belongsTo(MitraProfile::class, 'mitra_id', 'id');
    }
}
