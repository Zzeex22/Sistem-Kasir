<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class KasirController extends Controller
{
    // 1. Fungsi buat nampilin halaman kasir dan sisa stok barang
    public function index()
    {
        $products = Product::all();
        return view('dashboard', compact('products'));
    }

    // 2. Fungsi buat nyimpan transaksi dari klik tombol "Konfirmasi Lunas"
    public function store(Request $request)
    {
        // Validasi data keranjang dari front-end
        $request->validate([
            'keranjang' => 'required|array',
            'total' => 'required|numeric'
        ]);

        // Pake DB::beginTransaction biar kalau ada error, datanya nggak setengah masuk
        DB::beginTransaction();
        try {
            // A. Buat nota di tabel transactions
            $transaction = Transaction::create([
                'invoice_number' => 'INV-' . strtoupper(Str::random(6)),
                'total_harga' => $request->total,
                'status_pembayaran' => 'lunas' 
            ]);

            // B. Masukin isi keranjang ke transaction_details & potong stok produk
            foreach ($request->keranjang as $item) {
                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $item['id'],
                    'qty' => 1, 
                    'subtotal' => $item['harga']
                ]);

                // Cari barangnya, lalu kurangi stoknya 1 tiap kali diklik
                $product = Product::find($item['id']);
                if ($product) {
                    $product->decrement('stok', 1);
                }
            }

            // Kalau aman semua, simpan permanen
            DB::commit();
            return response()->json([
                'success' => true, 
                'message' => 'Transaksi Berhasil Disimpan!'
            ]);

        } catch (\Exception $e) {
            // Kalau ada error, batalkan semua proses simpan
            DB::rollBack();
            return response()->json([
                'success' => false, 
                'message' => 'Transaksi Gagal: ' . $e->getMessage()
            ], 500);
        }
    }
}