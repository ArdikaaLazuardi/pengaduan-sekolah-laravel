<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('app:about-pengaduan', function () {
    $this->comment('Aplikasi Pengaduan Sarana Sekolah siap digunakan.');
})->purpose('Menampilkan status singkat aplikasi pengaduan sekolah');
