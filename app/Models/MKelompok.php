<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class MKelompok extends Model
{
    use HasUuids;

    protected $table = "m_kelompok";

    protected $fillable = [
        'nama'
    ];

    public function personel()
    {
        return $this->hasMany(MPersonel::class);
    }
}
