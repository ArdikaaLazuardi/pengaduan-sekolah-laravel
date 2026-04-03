CREATE DATABASE IF NOT EXISTS pengaduan_sekolah;
USE pengaduan_sekolah;

DROP TABLE IF EXISTS progress_updates;
DROP TABLE IF EXISTS aspirasis;
DROP TABLE IF EXISTS kategoris;
DROP TABLE IF EXISTS siswas;
DROP TABLE IF EXISTS admins;

CREATE TABLE admins (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
) ENGINE=InnoDB;

CREATE TABLE siswas (
    nis VARCHAR(20) PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    kelas VARCHAR(20) NOT NULL,
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    INDEX idx_kelas (kelas)
) ENGINE=InnoDB;

CREATE TABLE kategoris (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    ket_kategori VARCHAR(50) NOT NULL UNIQUE,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
) ENGINE=InnoDB;

CREATE TABLE aspirasis (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nis VARCHAR(20) NOT NULL,
    kategori_id BIGINT UNSIGNED NOT NULL,
    lokasi VARCHAR(100) NOT NULL,
    ket TEXT NOT NULL,
    status ENUM('Menunggu', 'Proses', 'Selesai') NOT NULL DEFAULT 'Menunggu',
    feedback TEXT NULL,
    progress_persen TINYINT UNSIGNED NOT NULL DEFAULT 0,
    admin_id BIGINT UNSIGNED NULL,
    closed_at TIMESTAMP NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    CONSTRAINT fk_aspirasis_siswa FOREIGN KEY (nis) REFERENCES siswas(nis) ON DELETE CASCADE,
    CONSTRAINT fk_aspirasis_kategori FOREIGN KEY (kategori_id) REFERENCES kategoris(id) ON DELETE CASCADE,
    CONSTRAINT fk_aspirasis_admin FOREIGN KEY (admin_id) REFERENCES admins(id) ON DELETE SET NULL,
    INDEX idx_aspirasis_created_status (created_at, status),
    INDEX idx_aspirasis_nis_kategori (nis, kategori_id)
) ENGINE=InnoDB;

CREATE TABLE progress_updates (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    aspirasi_id BIGINT UNSIGNED NOT NULL,
    progress_persen TINYINT UNSIGNED NOT NULL,
    catatan TEXT NOT NULL,
    admin_id BIGINT UNSIGNED NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    CONSTRAINT fk_progress_aspirasi FOREIGN KEY (aspirasi_id) REFERENCES aspirasis(id) ON DELETE CASCADE,
    CONSTRAINT fk_progress_admin FOREIGN KEY (admin_id) REFERENCES admins(id) ON DELETE SET NULL,
    INDEX idx_progress_aspirasi_created (aspirasi_id, created_at)
) ENGINE=InnoDB;

INSERT INTO admins (name, username, password, created_at, updated_at) VALUES
('Administrator Sekolah', 'admin', '$2y$12$ofG6fz5Ne2LTG8y6j8TDIe.Wx6m4QzzmI6s0wA8xVXqvN7zh7ONf2', NOW(), NOW());
-- password: admin123

INSERT INTO siswas (nis, nama, kelas, created_at, updated_at) VALUES
('2025001', 'Andi Pratama', 'XII RPL 1', NOW(), NOW()),
('2025002', 'Bunga Lestari', 'XII RPL 1', NOW(), NOW()),
('2025003', 'Cahyo Saputra', 'XII RPL 2', NOW(), NOW());

INSERT INTO kategoris (ket_kategori, created_at, updated_at) VALUES
('Ruang Kelas', NOW(), NOW()),
('Laboratorium', NOW(), NOW()),
('Toilet', NOW(), NOW()),
('Perpustakaan', NOW(), NOW()),
('Jaringan Internet', NOW(), NOW()),
('Keamanan', NOW(), NOW());

INSERT INTO aspirasis (nis, kategori_id, lokasi, ket, status, feedback, progress_persen, admin_id, created_at, updated_at) VALUES
('2025001', 2, 'Lab Komputer 2', 'Beberapa komputer di Lab Komputer 2 tidak dapat menyala saat praktikum.', 'Proses', 'Teknisi sedang memeriksa power supply dan RAM.', 60, 1, NOW(), NOW());

INSERT INTO progress_updates (aspirasi_id, progress_persen, catatan, admin_id, created_at, updated_at) VALUES
(1, 60, 'Penggantian RAM untuk 4 unit dan pengecekan kabel listrik.', 1, NOW(), NOW());
