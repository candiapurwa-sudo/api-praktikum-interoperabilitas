<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukPertanianController;

Route::prefix('v1')->group(function () {
    Route::get('/produk-pertanian', [ProdukPertanianController::class, 'index']);
    Route::get('/produk-pertanian/{id}', [ProdukPertanianController::class, 'show']);
    Route::post('/produk-pertanian', [ProdukPertanianController::class, 'store']);
    Route::put('/produk-pertanian/{id}', [ProdukPertanianController::class, 'update']);
    Route::patch('/produk-pertanian/{id}', [ProdukPertanianController::class, 'update']);
    Route::delete('/produk-pertanian/{id}', [ProdukPertanianController::class, 'destroy']);
});