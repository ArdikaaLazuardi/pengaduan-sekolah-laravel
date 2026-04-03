<?php

namespace Database\Seeders;

use App\Models\Siswa;
use Illuminate\Database\Seeder;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nis' => '2025001', 'nama' => 'Andi Pratama', 'kelas' => 'XII RPL 1'],
            ['nis' => '2025002', 'nama' => 'Bunga Lestari', 'kelas' => 'XII RPL 1'],
            ['nis' => '2025003', 'nama' => 'Cahyo Saputra', 'kelas' => 'XII RPL 2'],
        ];

        foreach ($data as $siswa) {
            Siswa::query()->updateOrCreate(['nis' => $siswa['nis']], $siswa);
        }
    }
}
