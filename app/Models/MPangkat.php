<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class MPangkat extends Model
{
    use HasUuids;

    protected $table = "m_pangkat";

    protected $fillable = [
        'nama'
    ];

    public function persone()
    {
        return $this->hasMany(MPersonel::class);
    }
}
