<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Untuk Praktikum 2

class ScanController extends Controller
{
    // ==========================================
    // PRAKTIKUM 1: SCAN QR / BARCODE (KAMERA)
    // ==========================================
    
    // Menampilkan halaman scan kamera
    public function scanCode()
    {
        return view('scankode');
    }

    // Menerima data dari hasil scan kamera (AJAX)
    public function processScan(Request $request)
    {
        $code = $request->input('code');

        // Respons JSON sesuai modul (belum mencari produk)
        return response()->json([
            'message' => 'Code processed successfully',
            'data' => $code
        ]);
    }


    // ==========================================
    // PRAKTIKUM 2: INPUT BARCODE + TABEL PRODUK
    // ==========================================

    // Menampilkan halaman input manual / scanner USB
    public function scanProduk()
    {
        return view('scandataproduk');
    }

    // Mencari produk berdasarkan SKU (dari input manual)
    public function processScanProduk(Request $request)
    {
        $request->validate([
            'code' => 'required|string'
        ]);

        // Cari produk berdasarkan SKU
        $product = Product::where('sku', $request->code)->first();

        if ($product) {
            return response()->json([
                'success' => true,
                'code' => $request->code,
                'product' => [
                    'name' => $product->name,
                    'sku' => $product->sku,
                    'price' => $product->price,
                    'description' => $product->description,
                    'image' => $product->image
                ]
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Produk tidak ditemukan.'
        ]);
    }
}