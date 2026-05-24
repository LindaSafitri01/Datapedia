<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::rename('maklumats', 'manajemen_mutus');

        Schema::table('manajemen_mutus', function (Blueprint $table) {
            $table->string('kategori', 100)
                ->default('Maklumat Pelayanan')
                ->after('judul');
        });
    }

    public function down(): void
    {
        Schema::table('manajemen_mutus', function (Blueprint $table) {
            $table->dropColumn('kategori');
        });

        Schema::rename('manajemen_mutus', 'maklumats');
    }
};