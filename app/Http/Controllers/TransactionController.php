<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        // Tarik semua data transaksi urut dari yang paling baru, sekalian bawa data detail & produknya
        $transactions = Transaction::with('details.product')->latest()->get();
        
        return view('riwayat.index', compact('transactions'));
    }
}