<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class LaporanKehilangan extends Model
{
    use HasUuids;
    protected $table = "laporan_kehilangan";

    protected $fillable = [
        'no',
        'keterangan',
        'waktu_dilaporkan',
        'foto'
    ];
}
