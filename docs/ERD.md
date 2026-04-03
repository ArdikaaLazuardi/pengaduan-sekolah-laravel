# ERD Aplikasi Pengaduan Sarana Sekolah

## Entitas utama
1. **admins**
   - id
   - name
   - username
   - password

2. **siswas**
   - nis (PK)
   - nama
   - kelas

3. **kategoris**
   - id (PK)
   - ket_kategori

4. **aspirasis**
   - id (PK)
   - nis (FK ke siswas.nis)
   - kategori_id (FK ke kategoris.id)
   - lokasi
   - ket
   - status
   - feedback
   - progress_persen
   - admin_id (FK ke admins.id)

5. **progress_updates**
   - id (PK)
   - aspirasi_id (FK ke aspirasis.id)
   - progress_persen
   - catatan
   - admin_id (FK ke admins.id)

## Relasi
- Satu **siswa** dapat memiliki banyak **aspirasi**.
- Satu **kategori** dapat digunakan oleh banyak **aspirasi**.
- Satu **admin** dapat memperbarui banyak **aspirasi**.
- Satu **aspirasi** dapat memiliki banyak **progress update**.

## Catatan desain
Untuk implementasi Laravel, tabel `Input Aspirasi` dan `Aspirasi` pada soal digabung menjadi satu tabel transaksi `aspirasis` agar CRUD lebih sederhana, query lebih efisien, dan histori tetap tercatat lewat tabel `progress_updates`.
