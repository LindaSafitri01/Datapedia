<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class konsultan extends Model
{
    use HasFactory;
    protected $table = 'konsultans';

    protected $fillable = [
    "email",
    "nama",
    "image",
    "gambar",
    "posisi",
    "keahlian",
    "status",
    "status_updated_at",
    "alasan",
    "password",
    "no_hp",
    "created_at",
    "updated_at",
    "tanggal_mulai_tidak_tersedia",
    "tanggal_selesai_tidak_tersedia",
    ];
    public function jadwals()
{
    return $this->hasMany(jadwal::class);
}

    public function petugas(){
        return $this->hasMany(Petugas::class, 'konsultan_id');
    }

    public function petugasBerprestasi()
    {
        return $this->hasMany(PetugasBerprestasi::class, 'konsultan_id');
    }

}
