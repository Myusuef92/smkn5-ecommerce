<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = ['jurusan_id', 'nama_produk', 'harga', 'stok', 'deskripsi', 'gambar'];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }
}