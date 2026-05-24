<?php

namespace App\Models;
use App\Models\akunuser;

use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
    protected $fillable = [
        'layanan_antrian_id',
        'user_id',
        'tanggal_antrian',
        'nomor_urut',
        'nomor_antrian',
        'kode_booking',
        'status',
        'nomor_meja',
        'printed_at',
        'called_at',
        'served_at',
        'expired_at',
        'cancelled_at',
    ];

    public function layanan()
    {
        return $this->belongsTo(LayananAntrian::class, 'layanan_antrian_id');
    }
    
    public function user()
    {
        return $this->belongsTo(akunuser::class, 'user_id');
    }    
}