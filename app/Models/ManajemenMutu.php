<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManajemenMutu extends Model
{
    use HasFactory;
    protected $table = 'manajemen_mutus';

    protected $fillable = [
        "judul",
        "kategori",
        "file",
    ];
}