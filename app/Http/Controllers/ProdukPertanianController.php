<?php

namespace App\Http\Controllers;

use App\Models\ProdukPertanian;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProdukPertanianController extends Controller
{
    /**
     * GET: Menampilkan daftar semua produk (mendukung filter ?jenis= & ?cari=)
     */
    public function index(Request $request): JsonResponse
    {
        $query = ProdukPertanian::with('user:id,name,nama_usaha,nomor_telepon,kota')->where('tersedia', true);

        if ($request->filled('jenis')) {
            $query->where('jenis_produk', $request->jenis);
        }

        if ($request->filled('cari')) {
            $query->where('nama_produk', 'like', '%' . $request->cari . '%');
        }

        return response()->json([
            'status' => 'success',
            'data' => $query->latest()->paginate(12)
        ], 200);
    }

    /**
     * POST: Menambahkan produk baru
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'jenis_produk' => 'required|in:hasil_tani,alat_tani',
            'kategori' => 'required|string|max:100',
            'harga' => 'required|numeric|min:0',
            'satuan' => 'required|string|max:50',
            'stok' => 'required|integer|min:0',
            'kondisi' => 'nullable|string|max:100',
            'merk' => 'nullable|string|max:100',
            'tanggal_panen' => 'nullable|date',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|url',
        ]);

        // Mengambil ID integer dari user pertama di database jika tidak ada session auth
        $firstUser = User::first();
        $validated['user_id'] = $request->user()?->getRawOriginal('id') ?? ($firstUser ? $firstUser->getRawOriginal('id') : 1);
        $validated['slug'] = Str::slug($validated['nama_produk']) . '-' . Str::random(5);
        $validated['tersedia'] = true;

        $produk = ProdukPertanian::create($validated);
        $produk->load('user:id,name,nama_usaha,nomor_telepon,kota');

        return response()->json([
            'status' => 'success',
            'message' => 'Produk mitra berhasil diterbitkan',
            'data' => $produk
        ], 201);
    }

    /**
     * GET by ID: Menampilkan detail produk (bisa pakai /1 atau /P001)
     */
    public function show($id): JsonResponse
    {
        $cleanId = (int) preg_replace('/[^0-9]/', '', $id);
        $produk = ProdukPertanian::with('user:id,name,nama_usaha,nomor_telepon,kota,alamat_lengkap')->findOrFail($cleanId);

        return response()->json([
            'status' => 'success',
            'data' => $produk
        ], 200);
    }

    /**
     * PUT: Memperbarui produk (bisa pakai /1 atau /P001)
     */
    public function update(Request $request, $id): JsonResponse
    {
        $cleanId = (int) preg_replace('/[^0-9]/', '', $id);
        $produk = ProdukPertanian::findOrFail($cleanId);

        $validated = $request->validate([
            'nama_produk' => 'sometimes|required|string|max:255',
            'jenis_produk' => 'sometimes|required|in:hasil_tani,alat_tani',
            'kategori' => 'sometimes|required|string|max:100',
            'harga' => 'sometimes|required|numeric|min:0',
            'satuan' => 'sometimes|required|string|max:50',
            'stok' => 'sometimes|required|integer|min:0',
            'kondisi' => 'nullable|string|max:100',
            'merk' => 'nullable|string|max:100',
            'tanggal_panen' => 'nullable|date',
            'deskripsi' => 'sometimes|required|string',
            'gambar' => 'nullable|url',
            'tersedia' => 'sometimes|boolean',
        ]);

        if (isset($validated['nama_produk'])) {
            $validated['slug'] = Str::slug($validated['nama_produk']) . '-' . Str::random(5);
        }

        $produk->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Data produk pertanian berhasil diperbarui',
            'data' => $produk
        ], 200);
    }

    /**
     * DELETE: Menghapus produk (bisa pakai /1 atau /P001)
     */
    public function destroy($id): JsonResponse
    {
        $cleanId = (int) preg_replace('/[^0-9]/', '', $id);
        $produk = ProdukPertanian::findOrFail($cleanId);
        $produk->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Produk berhasil dihapus'
        ], 200);
    }
}