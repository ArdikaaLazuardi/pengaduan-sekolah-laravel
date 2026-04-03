<?php

namespace Database\Seeders;

use App\Models\Aspirasi;
use App\Models\ProgressUpdate;
use Illuminate\Database\Seeder;

class AspirasiSeeder extends Seeder
{
    public function run(): void
    {
        $aspirasi = Aspirasi::query()->updateOrCreate(
            ['nis' => '2025001', 'lokasi' => 'Lab Komputer 2'],
            [
                'kategori_id' => 2,
                'ket' => 'Beberapa komputer di Lab Komputer 2 tidak dapat menyala saat praktikum.',
                'status' => 'Proses',
                'feedback' => 'Teknisi sedang memeriksa power supply dan RAM.',
                'progress_persen' => 60,
                'admin_id' => 1,
            ]
        );

        ProgressUpdate::query()->updateOrCreate(
            ['aspirasi_id' => $aspirasi->id, 'progress_persen' => 60],
            [
                'catatan' => 'Penggantian RAM untuk 4 unit dan pengecekan kabel listrik.',
                'admin_id' => 1,
            ]
        );
    }
}
