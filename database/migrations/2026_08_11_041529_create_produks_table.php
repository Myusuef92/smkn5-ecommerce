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
       Schema::create('produks', function (Blueprint $table) {
    $table->id();
    $table->foreignId('jurusan_id')->constrained('jurusans')->onDelete('cascade'); // Relasi ke jurusan
    $table->string('nama_produk');
    $table->decimal('harga', 12, 2);
    $table->integer('stok')->default(0);
    $table->text('deskripsi')->nullable();
    $table->string('gambar')->nullable();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
