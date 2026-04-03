# Deskripsi Program

Aplikasi **Pengaduan Sarana Sekolah** adalah sistem berbasis web untuk membantu siswa menyampaikan aspirasi atau pengaduan terkait sarana dan prasarana sekolah.

## Tujuan
- Mempermudah input pengaduan.
- Mempercepat tindak lanjut admin.
- Menyediakan status, feedback, dan progres perbaikan yang transparan.

## Peran pengguna
### 1. Siswa
- Login menggunakan NIS.
- Menambahkan aspirasi/pengaduan.
- Melihat status, feedback, histori, dan progres.
- Mengubah atau menghapus aspirasi selama status masih `Menunggu`.

### 2. Admin
- Login menggunakan username dan password.
- Melihat seluruh aspirasi.
- Memfilter berdasarkan tanggal, bulan, siswa, kategori, dan status.
- Mengubah status, feedback, dan progres.
- Melihat histori progres setiap aspirasi.
- Menghapus data aspirasi bila diperlukan.

## Alur singkat
1. Siswa login dengan NIS.
2. Siswa mengisi form aspirasi.
3. Data masuk ke tabel `aspirasis`.
4. Admin login dan memfilter data.
5. Admin memperbarui status, feedback, dan progres.
6. Siswa melihat hasil tindak lanjut di halaman histori/detail.

## Keunggulan implementasi
- Menggunakan Eloquent relationship.
- Query list memakai eager loading.
- Filter menggunakan scope model.
- Form memakai validasi Laravel.
- UI responsif menggunakan Bootstrap 5.
