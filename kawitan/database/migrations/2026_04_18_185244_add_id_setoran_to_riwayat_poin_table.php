<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('riwayat_poin', function (Blueprint $table) {
            $table->unsignedBigInteger('id_setoran')->nullable()->after('id_user');
            $table->foreign('id_setoran')->references('id_setoran')->on('setoran')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('riwayat_poin', function (Blueprint $table) {
            $table->dropForeign(['id_setoran']);
            $table->dropColumn('id_setoran');
        });
    }
};