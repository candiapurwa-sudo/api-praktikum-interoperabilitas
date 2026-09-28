<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produk_pertanians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('nama_produk');
            $table->string('slug')->unique();
            $table->enum('jenis_produk', ['hasil_tani', 'alat_tani']);
            $table->string('kategori');
            $table->decimal('harga', 14, 2);
            $table->string('satuan');
            $table->integer('stok')->default(0);
            $table->string('kondisi')->nullable();
            $table->string('merk')->nullable();
            $table->date('tanggal_panen')->nullable();
            $table->text('deskripsi');
            $table->string('gambar')->nullable();
            $table->boolean('tersedia')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produk_pertanians');
    }
};