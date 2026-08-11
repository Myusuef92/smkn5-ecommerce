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
        Schema::create('jurusans', function (Blueprint $table) {
    $table->id();
    $table->string('nama_jurusan'); // Contoh: Rekayasa Perangkat Lunak (RPL)
    $table->string('slug')->unique(); // Untuk URL ramah SEO
    $table->text('deskripsi')->nullable();
    $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jurusans');
    }
};
