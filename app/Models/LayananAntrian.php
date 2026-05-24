<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LayananAntrian extends Model
{
    protected $fillable = [
        'nama_layanan',
        'kode_layanan',
        'is_active',
    ];

    public function antrian()
    {
        return $this->hasMany(Antrian::class, 'layanan_antrian_id');
    }
}
