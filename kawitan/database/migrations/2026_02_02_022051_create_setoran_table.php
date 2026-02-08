<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('setoran', function (Blueprint $table) {

            $table->id('id_setoran');

            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_jenis');

            $table->decimal('berat', 10, 2);
            $table->integer('total_poin');
            $table->decimal('total_co2', 10, 2);
            $table->decimal('total_air', 10, 2);
            $table->decimal('total_energi', 10, 2);
            $table->date('tanggal');

            $table->foreign('id_user')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');

            $table->foreign('id_jenis')
                  ->references('id_jenis')
                  ->on('jenis_sampah')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('setoran');
    }
};
