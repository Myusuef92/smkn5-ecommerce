<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jurusan;
use Illuminate\Support\Str;

class JurusanSeeder extends Seeder
{
    public function run(): void
    {
        $daftarJurusan = [
            'Rekayasa Perangkat Lunak (RPL)',
            'Teknik Komputer & Jaringan (TKJ)',
            'Desain Komunikasi Visual (DKV)',
            'Teknik Kendaraan Ringan (TKR)',
            'Teknik Bisnis Sepeda Motor (TBSM)',
            'Akuntansi & Keuangan (AKL)',
            'Otomatisasi Tata Kelola (OTKP)',
            'Teknik Permesinan (TPM)',
            'Perhotelan (PH)',
            'Agribisnis Pengolahan Hasil Perikanan (APHPi)'
        ];

        foreach ($daftarJurusan as $jurusan) {
            Jurusan::create([
                'nama_jurusan' => $jurusan,
                'slug' => Str::slug($jurusan),
                'deskripsi' => 'Produk unggulan hasil karya unit produksi siswa-siswi jurusan ' . $jurusan . ' SMK Negeri 5 Kab. Tangerang.'
            ]);
        }
    }
}