<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategori = [
            'Ruang Kelas',
            'Laboratorium',
            'Toilet',
            'Perpustakaan',
            'Jaringan Internet',
            'Keamanan',
        ];

        foreach ($kategori as $item) {
            Kategori::query()->updateOrCreate([
                'ket_kategori' => $item,
            ]);
        }
    }
}
