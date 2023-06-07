<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileKp extends Model
{
    use HasFactory;
    protected $table = 'file_kp';
    public $timestamps = false;
    const UPDATED_AT = null;
    protected $nullable = ['kp_cover', 'kp_abstrak'];

    public function kp()
    {
        return $this->belongsTo(Skripsi::class, 'id', 'id');
    }
}
