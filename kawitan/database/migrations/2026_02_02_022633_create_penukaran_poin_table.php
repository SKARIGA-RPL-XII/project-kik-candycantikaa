<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penukaran_poin', function (Blueprint $table) {
            $table->increments('id_penukaran');
            $table->integer('id_riwayat')->unsigned();
            $table->integer('id_hadiah')->unsigned();
            $table->integer('poin_dipakai');
            $table->dateTime('tanggal');
            $table->enum('status', ['menunggu', 'selesai', 'ditolak']);

            $table->foreign('id_riwayat')->references('id_riwayat')->on('riwayat_poin')->onDelete('cascade');
            $table->foreign('id_hadiah')->references('id_hadiah')->on('hadiah')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penukaran_poin');
    }
};
