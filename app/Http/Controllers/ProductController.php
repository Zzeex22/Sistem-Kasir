<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('barang.index', compact('products'));
    }

    public function create()
    {
        return view('barang.create');
    }

    public function store(Request $request)
    {
        // 1. Validasi dulu biar datanya bersih
        $validated = $request->validate([
            'nama_barang' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
        ]);

        // 2. Simpan pakai data yang udah divalidasi
        Product::create($validated);
        
        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan!');
    }

    public function edit(Product $barang)
    {
        return view('barang.edit', compact('barang'));
    }

    public function update(Request $request, Product $barang)
    {
        // 1. Validasi ulang buat data yang mau diedit
        $validated = $request->validate([
            'nama_barang' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
        ]);

        // 2. Update datanya
        $barang->update($validated);
        
        return redirect()->route('barang.index')->with('success', 'Data barang berhasil diupdate!');
    }

    public function destroy(Product $barang)
    {
        $barang->delete();
        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus!');
    }
}