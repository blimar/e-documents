<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class MPersonel extends Model
{
    use HasUuids;

    protected $table = "m_personel";

    protected $fillable = [
        'm_jabatan_id',
        'm_pangkat_id',
        'm_kelompok_id',
        'nama',
        'nrp'
    ];

    public function jabatan()
    {
        return $this->belongsTo(MJabatan::class);
    }

    public function pangkat()
    {
        return $this->belongsTo(MPangkat::class);
    }

    public function kelompok()
    {
        return $this->belongsTo(MKelompok::class);
    }
}
