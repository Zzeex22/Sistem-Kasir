<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relasi: Satu transaksi punya banyak detail barang
    public function details()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}