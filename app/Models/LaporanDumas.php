<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class LaporanDumas extends Model
{
    use HasUuids;

    protected $table = 'laporan_dumas';

    protected $fillable = [
        'id',
        'no',
        'nama_pengadu',
        'nama_teradu',
        'kronologi',
        'barang_bukti',
        'modus',
        'satker',
        'foto',
        'waktu_dilaporkan',
    ];
}
