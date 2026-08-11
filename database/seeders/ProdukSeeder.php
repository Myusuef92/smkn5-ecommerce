<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jurusan;
use App\Models\Produk;

class ProdukSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil semua data jurusan yang sudah ada di database
        $jurusans = Jurusan::all();

        foreach ($jurusans as $jurusan) {
            // Contoh produk unggulan berbeda berdasarkan nama jurusan
            if (str_contains($jurusan->nama_jurusan, 'RPL')) {
                Produk::create([
                    'jurusan_id' => $jurusan->id,
                    'nama_produk' => 'Aplikasi Kasir Berbasis Web (POS)',
                    'harga' => 250000,
                    'stok' => 10,
                    'deskripsi' => 'Aplikasi manajemen toko hasil karya siswa RPL untuk UMKM.'
                ]);
            } elseif (str_contains($jurusan->nama_jurusan, 'TKJ')) {
                Produk::create([
                    'jurusan_id' => $jurusan->id,
                    'nama_produk' => 'Paket Crimping Tools & LAN Tester',
                    'harga' => 125000,
                    'stok' => 15,
                    'deskripsi' => 'Alat instalasi jaringan komputer standar industri.'
                ]);
            } elseif (str_contains($jurusan->nama_jurusan, 'Kuliner')) {
                Produk::create([
                    'jurusan_id' => $jurusan->id,
                    'nama_produk' => 'Box Kue Kering Premium Aneka Rasa',
                    'harga' => 65000,
                    'stok' => 25,
                    'deskripsi' => 'Produk kuliner higienis olahan chef muda Tata Boga.'
                ]);
            } else {
                // Produk umum untuk jurusan lainnya
                Produk::create([
                    'jurusan_id' => $jurusan->id,
                    'nama_produk' => 'Produk Unggulan Unit Produksi ' . $jurusan->nama_jurusan,
                    'harga' => 100000,
                    'stok' => 20,
                    'deskripsi' => 'Hasil karya praktik terbaik siswa-siswi kompetensi keahlian terkait.'
                ]);
            }
        }
    }
}