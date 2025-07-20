<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class MJabatan extends Model
{
    use HasUuids;
    protected $table = "m_jabatan";

    protected $fillable = [
        'nama',
    ];

    public function personel()
    {
        return $this->hasMany(MPersonel::class);
    }
}
