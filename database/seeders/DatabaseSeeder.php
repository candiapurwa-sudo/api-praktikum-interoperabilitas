<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\ProdukPertanian;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Mitra 1: Kelompok Tani
        $petani = User::create([
            'name' => 'Pak Slamet',
            'email' => 'slamet@mitratani.test',
            'password' => bcrypt('password123'),
            'nama_usaha' => 'Gapoktan Subur Makmur',
            'nomor_telepon' => '6281234567890',
            'kota' => 'Banyuwangi',
            'alamat_lengkap' => 'Jl. Raya Rogojampi No. 12',
        ]);

        // Mitra 2: Toko Alsintan
        $tokoAlat = User::create([
            'name' => 'Budi Hendarto',
            'email' => 'budi@tokotani.test',
            'password' => bcrypt('password123'),
            'nama_usaha' => 'CV Sumber Mesin Pertanian',
            'nomor_telepon' => '6281987654321',
            'kota' => 'Surabaya',
            'alamat_lengkap' => 'Sentra Industri Alsintan Blok D-4',
        ]);

        // 1. Hasil Pertanian
        ProdukPertanian::create([
            'user_id' => $petani->id,
            'nama_produk' => 'Beras Organik Sintanur Wangi Premium',
            'slug' => 'beras-organik-sintanur-wangi-premium',
            'jenis_produk' => 'hasil_tani',
            'kategori' => 'Beras & Pangan',
            'harga' => 17000,
            'satuan' => 'kg',
            'stok' => 2000,
            'kondisi' => 'Grade AAA Organik',
            'tanggal_panen' => '2026-09-20',
            'deskripsi' => 'Dipanen langsung dari sawah organik terasering. Pulen alami tanpa bahan kimia dan tanpa pemutih sintetis.',
            'gambar' => 'https://images.unsplash.com/photo-1586201375761-83865001e31c?auto=format&fit=crop&w=700&q=80',
            'tersedia' => true,
        ]);

        ProdukPertanian::create([
            'user_id' => $petani->id,
            'nama_produk' => 'Cabai Rawit Merah Super Segar',
            'slug' => 'cabai-rawit-merah-super-segar',
            'jenis_produk' => 'hasil_tani',
            'kategori' => 'Hortikultura',
            'harga' => 38000,
            'satuan' => 'kg',
            'stok' => 250,
            'kondisi' => 'Petik Segar Hari Ini',
            'tanggal_panen' => '2026-09-28',
            'deskripsi' => 'Sortir standar pasar induk dan horeka, kesegaran dan tingkat kepedasan maksimal.',
            'gambar' => 'https://images.unsplash.com/photo-1592924357228-91a4daadcfea?auto=format&fit=crop&w=700&q=80',
            'tersedia' => true,
        ]);

        // 2. Alat Pertanian
        ProdukPertanian::create([
            'user_id' => $tokoAlat->id,
            'nama_produk' => 'Traktor Tangan Quick Capung Metal Diesel',
            'slug' => 'traktor-tangan-quick-capung-metal-diesel',
            'jenis_produk' => 'alat_tani',
            'kategori' => 'Mesin Olah Tanah',
            'harga' => 14500000,
            'satuan' => 'unit',
            'stok' => 5,
            'kondisi' => 'Baru & Garansi Resmi',
            'merk' => 'Quick / Honda GX 200',
            'deskripsi' => 'Mesin hand tractor tangguh 6.5 HP bodi baja cor, siap olah sawah basah dan tegalan kering.',
            'gambar' => 'https://images.unsplash.com/photo-1594771804886-a933bb2d609b?auto=format&fit=crop&w=700&q=80',
            'tersedia' => true,
        ]);

        ProdukPertanian::create([
            'user_id' => $tokoAlat->id,
            'nama_produk' => 'Sprayer Elektrik CBA Ultra 16 Liter',
            'slug' => 'sprayer-elektrik-cba-ultra-16-liter',
            'jenis_produk' => 'alat_tani',
            'kategori' => 'Penyemprot Hama',
            'harga' => 475000,
            'satuan' => 'unit',
            'stok' => 30,
            'kondisi' => 'Baru',
            'merk' => 'CBA',
            'deskripsi' => 'Kapasitas 16 Liter dengan baterai 12V 8Ah tahan 6-8 jam kerja, semprotan kabut presisi.',
            'gambar' => 'https://images.unsplash.com/photo-1527977966376-1c8408f9f108?auto=format&fit=crop&w=700&q=80',
            'tersedia' => true,

        ]);
        
        // Tambahan 1: Hasil Pertanian (Komoditas Perkebunan)
        ProdukPertanian::create([
            'user_id' => $petani->id,
            'nama_produk' => 'Biji Kopi Robusta Lereng Ijen Asli (Green Bean)',
            'slug' => 'biji-kopi-robusta-lereng-ijen-green-bean',
            'jenis_produk' => 'hasil_tani',
            'kategori' => 'Perkebunan',
            'harga' => 65000,
            'satuan' => 'kg',
            'stok' => 850,
            'kondisi' => 'Kadar Air 12% Defect Rendah',
            'tanggal_panen' => '2026-08-15',
            'deskripsi' => 'Green bean Robusta petik merah dari lereng Gunung Ijen. Cocok untuk roastery dan kebutuhan kafe skala menengah hingga besar.',
            'gambar' => 'https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?auto=format&fit=crop&w=700&q=80',
            'tersedia' => true,
        ]);

        // Tambahan 2: Peralatan Pertanian (Teknologi Irigasi)
        ProdukPertanian::create([
            'user_id' => $tokoAlat->id,
            'nama_produk' => 'Paket Smart Drip Irrigation Otomatis 100M dengan Timer Digital',
            'slug' => 'paket-smart-drip-irrigation-otomatis-100m',
            'jenis_produk' => 'alat_tani',
            'kategori' => 'Sistem Irigasi',
            'harga' => 850000,
            'satuan' => 'unit',
            'stok' => 15,
            'kondisi' => 'Baru & Lengkap Selang + Nozzle',
            'merk' => 'AgroDrip Pro',
            'deskripsi' => 'Kit sistem pengairan tetes otomatis lengkap dengan timer digital bertenaga baterai. Efisiensi penggunaan air hingga 70% untuk lahan kebun dan greenhouse.',
            'gambar' => 'https://images.unsplash.com/photo-1563514227147-6d2ff665a6a0?auto=format&fit=crop&w=700&q=80',
            'tersedia' => true,
        ]);
    }
}