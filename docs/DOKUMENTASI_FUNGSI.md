# Dokumentasi Fungsi / Prosedur Utama

## `App\Models\Aspirasi::scopeFilter(array $filters)`
Memproses filter daftar aspirasi berdasarkan tanggal, bulan, siswa, kategori, dan status.

## `App\Http\Controllers\Auth\AdminLoginController::store()`
Memvalidasi login admin dan mengaktifkan session guard `admin`.

## `App\Http\Controllers\Auth\SiswaLoginController::store()`
Memvalidasi NIS siswa dan mengaktifkan session guard `siswa`.

## `App\Http\Controllers\Siswa\AspirasiController::store()`
Menyimpan aspirasi baru siswa dengan status awal `Menunggu`.

## `App\Http\Controllers\Siswa\AspirasiController::update()`
Memperbarui aspirasi milik siswa selama status belum diproses admin.

## `App\Http\Controllers\Admin\AspirasiController::index()`
Menampilkan dashboard admin, ringkasan jumlah aspirasi, serta filter laporan.

## `App\Http\Controllers\Admin\AspirasiController::update()`
Memperbarui status, feedback, dan progress. Saat ada catatan progres baru, sistem membuat histori pada tabel `progress_updates`.

## Middleware `EnsureAdmin` dan `EnsureSiswa`
Membatasi akses halaman berdasarkan guard yang sedang login.
