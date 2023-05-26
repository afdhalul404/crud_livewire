<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;
    protected $table = 'buku';
    public $timestamps = false;
    public $fillable = ['kode_buku', 'judul_buku', 'penulis', 'penerbit', 'tahun_terbit', 'kategori', 'stok', 'cover'];
    const UPDATED_AT = null;
}
