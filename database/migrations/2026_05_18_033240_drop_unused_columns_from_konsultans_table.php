<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('konsultans', function (Blueprint $table) {
            $table->dropColumn([
                'keahlian',
                'alasan',
                'tanggal_mulai_tidak_tersedia',
                'tanggal_selesai_tidak_tersedia',
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('konsultans', function (Blueprint $table) {
            $table->string('keahlian')->nullable()->after('posisi');
            $table->text('alasan')->nullable()->after('status_updated_at');
            $table->date('tanggal_mulai_tidak_tersedia')->nullable()->after('updated_at');
            $table->date('tanggal_selesai_tidak_tersedia')->nullable()->after('tanggal_mulai_tidak_tersedia');
        });
    }
};