<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class LaporanGangguan extends Model
{
    use HasUuids;
    protected $table = "laporan_gangguan";
    protected $fillable = [
        'lp_no',
        'LP No',
        'nama_pelapor',
        'korban',
        'terlapor',
        'saksi',
        'pasal',
        'barang_bukti',
        'uraian_kejadian',
        'waktu_kejadian',
        'tempat_kejadian',
        'waktu_dilaporkan',
        'satker',
        'foto',
        'polisi',
        'public',
    ];
}
