<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // TAMBAHKAN BARIS INI (Daftar kolom yang boleh diisi)
    protected $fillable = [
        'name',
        'sku',
        'price',
        'description',
        'image',
    ];
}