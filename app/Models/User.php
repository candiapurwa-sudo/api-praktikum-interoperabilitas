<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'nama_usaha',
        'nomor_telepon',
        'kota',
        'alamat_lengkap',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Menyertakan kode_user di JSON
    protected $appends = ['kode_user'];

    public function getKodeUserAttribute(): string
    {
        return 'M' . str_pad($this->attributes['id'] ?? 1, 3, '0', STR_PAD_LEFT);
    }

    public function produkPertanian(): HasMany
    {
        return $this->hasMany(ProdukPertanian::class, 'user_id');
    }
}