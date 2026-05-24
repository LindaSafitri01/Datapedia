<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LayananAntrianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('layanan_antrians')->insert([
            [
                'nama_layanan' => 'Perpustakaan',
                'kode_layanan' => 'A',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_layanan' => 'Konsultasi',
                'kode_layanan' => 'B',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_layanan' => 'Penjualan',
                'kode_layanan' => 'C',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_layanan' => 'Rekomendasi',
                'kode_layanan' => 'D',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

}
