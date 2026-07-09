<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // GET: Ambil semua data produk
    public function index()
    {
        return response()->json(Product::all(), 200);
    }

    // POST: Tambah produk baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'sku' => 'required|unique:products',
            'price' => 'required|numeric',
        ]);

        $product = Product::create($request->all());
        return response()->json($product, 201);
    }

    // GET: Ambil detail 1 produk berdasarkan ID
    public function show($id)
    {
        return response()->json(Product::findOrFail($id), 200);
    }

    // PUT: Update data produk
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());
        return response()->json($product, 200);
    }

    // DELETE: Hapus produk
    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return response()->json(null, 204);
    }

    public function qr($id)
{
    $product = Product::findOrFail($id);
    $qrUrl = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=" . urlencode($product->sku);
    return response()->json([
        'product' => $product,
        'qr_code_url' => $qrUrl
    ]);
}
}