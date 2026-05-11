<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
    {
        // Ubah kolom ENUM: tambahkan 'batal'
        DB::statement("ALTER TABLE janjitemu MODIFY status ENUM('menunggu', 'diterima', 'ditolak', 'batal') DEFAULT 'menunggu'");
    }

    public function down(): void
    {
        // Kembalikan ke ENUM awal (jika sebelumnya hanya ada 2 nilai)
        DB::statement("ALTER TABLE janjitemu MODIFY status ENUM('menunggu', 'diterima', 'ditolak') DEFAULT 'menunggu'");
    }

};
