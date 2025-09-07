<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class LaporanHarian extends Model
{
    use HasUuids;

    protected $table = 'laporan_harian';

    protected $fillable = [
        'keterangan',
        'image'
    ];
}
