<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skripsi extends Model
{
    use HasFactory;
    protected $table = 'skripsi';
    public $timestamps = false;
    const UPDATED_AT = null;

    public function dosen1()
    {
        return $this->belongsTo(Dosen::class, 'pembimbing1', 'nip');
    }

    public function dosen2()
    {
        return $this->belongsTo(Dosen::class, 'pembimbing2', 'nip');
    }

    public function dosen3()
    {
        return $this->belongsTo(Dosen::class, 'penguji1', 'nip');
    }

    public function dosen4()
    {
        return $this->belongsTo(Dosen::class, 'penguji2', 'nip');
    }
    public function dosen5()
    {
        return $this->belongsTo(Dosen::class, 'penguji3', 'nip');
    }

    public function fileSkripsi()
    {
        return $this->hasOne(FileSkripsi::class, 'id', 'id');
    }

}
