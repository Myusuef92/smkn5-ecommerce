<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi')->unique();
            $table->foreignId('produk_id')->constrained('produks')->onDelete('cascade');
            $table->string('nama_pembeli');
            $table->string('no_wa_pembeli');
            $table->integer('jumlah');
            $table->decimal('total_harga', 12, 2);
            $table->enum('status', ['Pending', 'Selesai', 'Dibatalkan'])->default('Selesai');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};