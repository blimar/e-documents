<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class LaporanPolisi extends Model
{
    use HasUuids;

    protected $table = "laporan_polisi";

    protected $fillable = [
        'lp_no',
        'tindak_pidana',
        'tanggal_kejadian',
        'tempat_kejadian',
        'korban',
        'terlapor',
        'saksi',
        'uraian',
        'sttlp',
    ];
}
