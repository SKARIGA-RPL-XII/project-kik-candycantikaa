<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id_user');
            $table->string('username', 50);
            $table->string('email')->unique();
            $table->string('tlpn', 15);
            $table->string('password', 255);
            $table->enum('role', ['user', 'admin'])->default('user');
            $table->dateTime('created_at');
        });


        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->integer('id_user')->unsigned()->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();

            $table->foreign('id_user')
                  ->references('id_user')
                  ->on('users')
                  ->onDelete('cascade');
        });


        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};
