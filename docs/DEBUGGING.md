# Catatan Debugging

## 1. Siswa login tanpa password
**Masalah:** Soal hanya mensyaratkan login dengan NIS, sehingga kurang aman untuk produksi.  
**Solusi:** Pada implementasi ini tetap digunakan session guard Laravel, tetapi autentikasi siswa dilakukan setelah NIS tervalidasi. Untuk produksi, disarankan menambah password, OTP, atau integrasi SSO sekolah.

## 2. Query daftar aspirasi lambat
**Masalah:** N+1 query saat mengambil data siswa dan kategori.  
**Solusi:** Menggunakan eager loading `with(['siswa', 'kategori'])`.

## 3. Filter laporan kompleks
**Masalah:** Filter tanggal, bulan, siswa, dan kategori mudah membuat controller panjang.  
**Solusi:** Dipindahkan ke `scopeFilter()` pada model `Aspirasi`.

## 4. Edit data yang sudah diproses
**Masalah:** Siswa tidak boleh mengubah aspirasi yang sudah ditindaklanjuti.  
**Solusi:** Controller siswa memblokir edit/hapus bila status bukan `Menunggu`.

## 5. Sinkronisasi status dan progress
**Masalah:** Status `Selesai` harus konsisten dengan progress.  
**Solusi:** Saat admin memilih `Selesai`, progress otomatis diset ke `100%`. Saat `Menunggu`, progress diset `0%`.
