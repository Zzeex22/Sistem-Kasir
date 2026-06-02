<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Ini kuncinya biar gak muncul error MassAssignment lagi
    protected $fillable = ['nama_barang', 'harga', 'stok'];
}