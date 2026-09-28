<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgroNiaga - Marketplace Hasil Tani & Peralatan Pertanian</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-slate-50 text-slate-900 flex flex-col min-h-screen">
    <!-- Top Bar -->
    <div class="bg-emerald-900 text-emerald-200 text-xs py-2 px-4 text-center font-medium">
        Pusat Transaksi Produk Pertanian & Peralatan Terverifikasi Nasional
    </div>

    <!-- Navbar -->
    <header class="bg-white border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 h-20 flex items-center justify-between gap-6">
            <a href="/" class="flex items-center gap-2">
                <div class="w-10 h-10 bg-emerald-600 rounded-xl flex items-center justify-center text-white text-xl">🌾</div>
                <div>
                    <span class="text-xl font-extrabold tracking-tight text-slate-900">Agro<span class="text-emerald-600">Niaga</span></span>
                    <span class="block text-[10px] uppercase font-bold tracking-widest text-slate-400 -mt-1">Mitra Tani Terpadu</span>
                </div>
            </a>

            <form action="/" method="GET" class="flex-1 max-w-md hidden md:block">
                <input type="text" name="cari" value="{{ request('cari') }}" 
                       placeholder="Cari beras, cabai, traktor, sprayer..." 
                       class="w-full px-4 py-2 bg-slate-100 border border-slate-200 rounded-full text-xs outline-none focus:ring-2 focus:ring-emerald-600 focus:bg-white">
            </form>

            <div class="flex items-center gap-3">
                <a href="/api/v1/produk-pertanian" target="_blank" class="text-xs font-semibold px-4 py-2.5 rounded-lg text-emerald-800 bg-emerald-50 border border-emerald-200">
                    Endpoint API
                </a>
            </div>
        </div>
    </header>

    <!-- Banner -->
    <div class="bg-slate-900 text-white py-12 px-4">
        <div class="max-w-7xl mx-auto text-center">
            <span class="px-3 py-1 bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 rounded-full text-xs font-semibold uppercase">
                Langsung dari Berbagai Mitra Tani
            </span>
            <h1 class="text-3xl md:text-5xl font-black mt-4 mb-3">Produk Hasil Panen & Alat Mesin Pertanian</h1>
            <p class="text-slate-400 text-sm max-w-xl mx-auto mb-6">Dapatkan harga langsung dari petani binaan dan distributor alat mesin pertanian terpercaya.</p>
            <div class="flex justify-center gap-3">
                <a href="/?jenis=hasil_tani" class="px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-semibold text-xs transition">
                    🌾 Hasil Pertanian
                </a>
                <a href="/?jenis=alat_tani" class="px-5 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-200 border border-slate-700 font-semibold text-xs transition">
                    🚜 Peralatan Pertanian
                </a>
            </div>
        </div>
    </div>

    <!-- Filter Nav -->
    <div class="bg-white border-b border-slate-200 sticky top-20 z-40">
        <div class="max-w-7xl mx-auto px-4 py-3 flex gap-2 text-xs font-semibold overflow-x-auto">
            <a href="/" class="px-4 py-2 rounded-lg {{ !request('jenis') ? 'bg-emerald-600 text-white' : 'text-slate-600 hover:bg-slate-100' }}">Semua</a>
            <a href="/?jenis=hasil_tani" class="px-4 py-2 rounded-lg {{ request('jenis') == 'hasil_tani' ? 'bg-emerald-600 text-white' : 'text-slate-600 hover:bg-slate-100' }}">Hasil Panen</a>
            <a href="/?jenis=alat_tani" class="px-4 py-2 rounded-lg {{ request('jenis') == 'alat_tani' ? 'bg-emerald-600 text-white' : 'text-slate-600 hover:bg-slate-100' }}">Peralatan & Mesin</a>
        </div>
    </div>

    <!-- Grid Produk -->
    <main class="max-w-7xl mx-auto px-4 py-10 flex-grow">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($produk as $item)
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden hover:shadow-lg transition flex flex-col group">
                    <div class="relative h-44 bg-slate-100">
                        <img src="{{ $item->gambar }}" alt="{{ $item->nama_produk }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                        <span class="absolute top-3 left-3 px-2 py-0.5 text-[10px] font-bold rounded {{ $item->jenis_produk == 'hasil_tani' ? 'bg-emerald-600 text-white' : 'bg-amber-600 text-white' }}">
                            {{ $item->jenis_produk == 'hasil_tani' ? 'Panen' : 'Alsintan' }}
                        </span>
                    </div>
                    <div class="p-4 flex flex-col flex-grow">
                        <div class="text-[11px] text-slate-500 mb-1 flex justify-between">
                            <span class="font-semibold text-emerald-800">{{ $item->user->nama_usaha }}</span>
                            <span>{{ $item->user->kota }}</span>
                        </div>
                        <a href="{{ route('produk.detail', $item->slug) }}" class="font-bold text-slate-800 text-sm hover:text-emerald-600 transition line-clamp-2 mb-3">
                            {{ $item->nama_produk }}
                        </a>
                        <div class="mt-auto pt-3 border-t border-slate-100 flex items-baseline justify-between">
                            <div>
                                <span class="text-sm font-extrabold text-emerald-800">Rp {{ number_format($item->harga, 0, ',', '.') }}</span>
                                <span class="text-[10px] text-slate-500">/{{ $item->satuan }}</span>
                            </div>
                            <span class="text-[11px] text-slate-500">Stok: {{ $item->stok }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-16 text-center text-slate-500 text-sm">
                    Tidak ada produk pertanian yang ditemukan.
                </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $produk->links() }}
        </div>
    </main>

    <footer class="bg-slate-900 text-slate-500 py-6 text-center text-xs border-t border-slate-800">
        &copy; 2026 AgroNiaga Platform Agribisnis Terpadu.
    </footer>
</body>
</html>