<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $produk->nama_produk }} - AgroNiaga</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-slate-50 text-slate-900 py-10">
    <div class="max-w-4xl mx-auto px-4">
        <!-- Tombol Kembali -->
        <a href="/" class="text-xs font-semibold text-emerald-700 hover:underline mb-4 inline-block">&larr; Kembali ke Katalog Utama</a>
        
        <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden grid md:grid-cols-2 gap-8 p-6 md:p-8 shadow-sm">
            <!-- Kolom Gambar & Lokasi -->
            <div>
                <img src="{{ $produk->gambar }}" alt="{{ $produk->nama_produk }}" class="w-full h-80 object-cover rounded-xl border border-slate-200 mb-3">
                <div class="p-3 bg-slate-50 rounded-lg text-xs text-slate-600">
                    📍 Lokasi Mitra: <strong>{{ $produk->user->alamat_lengkap }}, {{ $produk->user->kota }}</strong>
                </div>
            </div>

            <!-- Kolom Rincian Produk & Pemesanan -->
            <div class="flex flex-col">
                <span class="text-xs font-bold text-emerald-700 uppercase mb-1">{{ $produk->kategori }}</span>
                <h1 class="text-2xl font-black text-slate-900 mb-3">{{ $produk->nama_produk }}</h1>

                <!-- Kotak Harga -->
                <div class="p-4 bg-emerald-50 rounded-xl border border-emerald-200 mb-4">
                    <span class="text-xs text-emerald-900 block">Harga Satuan Mitra</span>
                    <span class="text-2xl font-black text-emerald-800">Rp {{ number_format($produk->harga, 0, ',', '.') }}</span>
                    <span class="text-xs text-slate-600">/ {{ $produk->satuan }}</span>
                    <div class="text-xs text-slate-600 mt-2">
                        Stok Tersedia: <strong>{{ $produk->stok }} {{ $produk->satuan }}</strong> • Kondisi: <strong>{{ $produk->kondisi ?? '-' }}</strong>
                    </div>
                </div>

                <!-- Informasi Toko Mitra -->
                <div class="p-3 bg-slate-50 rounded-lg text-xs text-slate-700 mb-4">
                    Toko Mitra: <strong>{{ $produk->user->nama_usaha }}</strong> ({{ $produk->user->name }})
                </div>

                <!-- Deskripsi & Keterangan Tambahan -->
                <div class="text-xs text-slate-600 leading-relaxed mb-6">
                    <strong class="text-slate-800 block mb-1">Deskripsi Produk:</strong>
                    <p>{{ $produk->deskripsi }}</p>
                    @if($produk->tanggal_panen)
                        <p class="mt-2 text-emerald-800 font-semibold">🗓️ Tanggal Panen: {{ $produk->tanggal_panen }}</p>
                    @endif
                    @if($produk->merk)
                        <p class="mt-2 text-slate-700 font-semibold">⚙️ Merk Alat: {{ $produk->merk }}</p>
                    @endif
                </div>

                <!-- Tombol Transaksi WhatsApp -->
                <div class="mt-auto">
                    <a href="https://wa.me/{{ $produk->user->nomor_telepon }}?text=Halo%20{{ urlencode($produk->user->nama_usaha) }},%20saya%20tertarik%20dengan%20produk%20pertanian%20{{ urlencode($produk->nama_produk) }}" 
                       target="_blank" 
                       class="block w-full py-3 text-center bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-xs font-bold transition shadow-md">
                        Hubungi & Pesan via WhatsApp Mitra
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>