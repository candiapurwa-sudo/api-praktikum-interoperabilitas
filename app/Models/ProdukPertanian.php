<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProdukPertanian extends Model
{
    use HasFactory;

    protected $table = 'produk_pertanians';

    protected $fillable = [
        'user_id',
        'nama_produk',
        'slug',
        'jenis_produk',
        'kategori',
        'harga',
        'satuan',
        'stok',
        'kondisi',
        'merk',
        'tanggal_panen',
        'deskripsi',
        'gambar',
        'tersedia',
    ];

    // Otomatis memunculkan kode_produk di output JSON
    protected $appends = ['kode_produk'];

    public function getKodeProdukAttribute(): string
    {
        return 'P' . str_pad($this->attributes['id'] ?? 1, 3, '0', STR_PAD_LEFT);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}