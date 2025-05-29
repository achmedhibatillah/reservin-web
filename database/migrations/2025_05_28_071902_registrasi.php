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
        Schema::create('registrasi', function(Blueprint $table) {
            $table->string('registrasi_id', 35)->primary();
            $table->string('registrasi_info', 12);
            $table->string('registrasi_url', 40);
            $table->string('registrasi_fullname', 255);
            $table->string('registrasi_email', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('registrasi');
    }
};
