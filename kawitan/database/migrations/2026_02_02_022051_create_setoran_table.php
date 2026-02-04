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
        Schema::create('setoran', function (Blueprint $table) {
            $table->id('id_setoran');

            $table->unsignedInteger('id_user');
            $table->unsignedBigInteger('id_jenis'); // FK ke jenis_sampah.id

            $table->float('berat');
            $table->integer('total_poin');
            $table->float('total_co2');
            $table->float('total_air');
            $table->float('total_energi');
            $table->dateTime('tanggal');

            $table->foreign('id_user')
                ->references('id_user')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('id_jenis')
                ->references('id_jenis')
                ->on('jenis_sampah')
                ->onDelete('cascade');
        });



    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setoran');
    }
};
