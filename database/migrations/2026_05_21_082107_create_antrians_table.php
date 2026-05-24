<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('antrians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('layanan_antrian_id')
                ->constrained('layanan_antrians')
                ->cascadeOnDelete();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->date('tanggal_antrian');
            $table->integer('nomor_urut');
            $table->string('nomor_antrian');
            $table->string('nama_pengunjung')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('kode_booking')->unique();

            $table->enum('status', [
                'pending',
                'printed',
                'called',
                'served',
                'expired',
                'cancelled'
            ])->default('pending');

            $table->timestamp('printed_at')->nullable();
            $table->timestamp('called_at')->nullable();
            $table->timestamp('served_at')->nullable();
            $table->timestamp('expired_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();

            $table->timestamps();

            $table->unique([
                'layanan_antrian_id',
                'tanggal_antrian',
                'nomor_urut'
            ], 'unique_nomor_antrian_per_layanan_per_hari');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('antrians');
    }
};
