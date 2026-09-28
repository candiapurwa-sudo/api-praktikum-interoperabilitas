<?php

use Illuminate\Support\Facades\Route;
use App\Models\ProdukPertanian;
use Illuminate\Http\Request;

Route::get('/', function (Request $request) {
    $query = ProdukPertanian::with('user')->where('tersedia', true);

    if ($request->filled('jenis')) {
        $query->where('jenis_produk', $request->jenis);
    }

    if ($request->filled('cari')) {
        $query->where('nama_produk', 'like', '%' . $request->cari . '%');
    }

    $produk = $query->latest()->paginate(8);

    return view('welcome', compact('produk'));
})->name('home');

Route::get('/produk/{slug}', function ($slug) {
    $produk = ProdukPertanian::with('user')->where('slug', $slug)->firstOrFail();
    return view('produk.show', compact('produk'));
})->name('produk.detail');