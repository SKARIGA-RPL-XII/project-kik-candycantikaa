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
        Schema::create('hadiah', function (Blueprint $table) {
            $table->increments('id_hadiah');
            $table->string('gambar', 255);
            $table->string('nama_hadiah', 100);
            $table->integer('poin_dibutuhkan');
            $table->integer('stok');
            $table->string('deskripsi', 255);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hadiah');
    }
};
