<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            ALTER TABLE konsultasi_klik
            MODIFY posisi ENUM(
                'asn',
                'karyawan_swasta',
                'wiraswasta',
                'peneliti',
                'pelajar_mahasiswa',
                'lainnya'
            ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE konsultasi_klik
            MODIFY posisi VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL
        ");
    }
};