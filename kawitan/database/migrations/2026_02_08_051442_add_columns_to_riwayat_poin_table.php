<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::table('riwayat_poin', function (Blueprint $table) {
            $table->integer('jumlah_poin')->after('poin');
            $table->string('keterangan')->nullable()->after('jumlah_poin');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('riwayat_poin', function (Blueprint $table) {
            $table->dropColumn(['jumlah_poin', 'keterangan']);
            $table->dropTimestamps();
        });
    }
};
