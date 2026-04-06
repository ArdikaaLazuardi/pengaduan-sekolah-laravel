# Pengaduan Sarana Sekolah (Laravel + MySQL + Bootstrap 5)

Proyek ini adalah implementasi aplikasi **Pengaduan Sarana Sekolah** berbasis **Laravel 13**, **MySQL**, dan **Bootstrap 5**.

## Fitur Utama
### Siswa
- Login menggunakan NIS
- Input aspirasi/pengaduan sarana sekolah
- Melihat status penyelesaian
- Melihat histori aspirasi sendiri
- Melihat umpan balik admin
- Melihat progres perbaikan

### Admin
- Login username + password
- Melihat semua aspirasi
- Filter berdasarkan tanggal, bulan, siswa, kategori, dan status
- Mengubah status aspirasi
- Memberikan feedback
- Melihat histori progres
- Menghapus aspirasi

## Teknologi
- Laravel 13
- PHP 8.2+
- MySQL
- Bootstrap 5
- Blade
- Laravel Eloquent ORM

## Instalasi
> Folder ini berisi source code aplikasi. Folder `vendor` dan dependensi Composer tidak disertakan, sehingga Anda perlu menjalankan `composer install`.

### 1. Siapkan proyek
```bash
cd pengaduan-sekolah-laravel
cp .env.example .env
composer install
php artisan key:generate
```

### 2. Atur database pada `.env`
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pengaduan_sekolah
DB_USERNAME=root
DB_PASSWORD=
```

### 3A. Jalankan migrasi dan seeder
```bash
php artisan migrate --seed
```

### 3B. Atau import SQL manual
Import file: `database/sql/pengaduan_sekolah.sql`

### 4. Jalankan aplikasi
```bash
php artisan serve atau php -S 127.0.0.1:8000 -t public
```

Buka:
- Siswa: `http://127.0.0.1:8000/siswa/login`
- Admin: `http://127.0.0.1:8000/admin/login`

## Akun Demo
### Admin
- Username: `admin`
- Password: `admin123`

### Siswa
- NIS: `2025001`
- NIS: `2025002`

## Catatan Penting
- Login siswa hanya menggunakan NIS karena mengikuti kebutuhan soal.
- Untuk kebutuhan produksi, sebaiknya tambahkan password/OTP.
