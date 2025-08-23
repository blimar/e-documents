<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class LaporanMutasi extends Model
{
    use HasUuids;
    protected $table = 'laporan_mutasi';
    protected $fillable = [
        'deskripsi',
        'ket'
    ];
}
