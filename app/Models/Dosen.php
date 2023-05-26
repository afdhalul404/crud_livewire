<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;
    protected $table = 'dosen';
    public $timestamps = false;
    public $fillable = ['nip', 'nama_dosen'];
    const UPDATED_AT = null;
}
