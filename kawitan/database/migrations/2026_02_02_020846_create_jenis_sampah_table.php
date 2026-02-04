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
        Schema::create('jenis_sampah', function (Blueprint $table) {
            $table->id('id_jenis');
            $table->string('nama_jenis');
            $table->integer('poin_per_kg');
            $table->decimal('co2_per_kg', 8, 2);   
            $table->decimal('air_per_kg', 8, 2);    
            $table->decimal('energi_per_kg', 8, 2);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_sampah');
    }
};
