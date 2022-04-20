CREATE DATABASE IF NOT EXISTS mial_db;

CREATE TABLE user (
    id VARCHAR(37) NOT NULL PRIMARY KEY,
    nama_lengkap VARCHAR(255) NOT NULL,
    nim VARCHAR(24),
    nip VARCHAR(24),
    url_transkrip_mk VARCHAR(2048),
    ipk FLOAT NOT NULL DEFAULT 0.0,
    semester INT NOT NULL DEFAULT 1,
    nomor_rekening VARCHAR(20),
    nomor_telepon VARCHAR(20),
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(129) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT NOW()
);

CREATE TABLE notifikasi (
    id VARCHAR(37) NOT NULL PRIMARY KEY,
    mahasiswa_id VARCHAR(37) NOT NULL,
    jenis CHAR(1) NOT NULL,
    pesan VARCHAR(255) NOT NULL,
    dibaca CHAR(1) NOT NULL DEFAULT 'N',
    created_at DATETIME NOT NULL DEFAULT NOW(),
    INDEX (mahasiswa_id),
    CONSTRAINT fk_notifikasi_mahasiswa_id_user_id FOREIGN KEY (mahasiswa_id) REFERENCES user (id)
);

CREATE TABLE mata_kuliah (
    id VARCHAR(37) NOT NULL PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    semester INT NOT NULL,
    kode VARCHAR(12) NOT NULL
);

CREATE TABLE lowongan (
    id VARCHAR(37) NOT NULL PRIMARY KEY,
    dosen_id VARCHAR(37) NOT NULL,
    mata_kuliah_id VARCHAR(37) NOT NULL,
    kode_kelas VARCHAR(8) NOT NULL,
    gaji INT NOT NULL DEFAULT 0,
    tanggal_mulai DATE NOT NULL,
    tanggal_selesai DATE NOT NULL,
    deskripsi TEXT,
    terbuka CHAR(1) NOT NULL DEFAULT 'N',
    created_at DATETIME NOT NULL DEFAULT NOW(),
    INDEX (dosen_id),
    INDEX (mata_kuliah_id),
    CONSTRAINT fk_lowongan_dosen_id_user_id FOREIGN KEY (dosen_id) REFERENCES user(id),
    CONSTRAINT fk_lowongan_mata_kuliah_id_mata_kuliah_id FOREIGN KEY (mata_kuliah_id) REFERENCES mata_kuliah (id)
);

CREATE TABLE asisten_dosen (
    mahasiswa_id VARCHAR(37) NOT NULL,
    lowongan_id VARCHAR(37) NOT NULL,
    diterima CHAR(1) NOT NULL DEFAULT 'N',
    dibayar CHAR(1) NOT NULL DEFAULT 'N',
    created_at DATETIME NOT NULL DEFAULT NOW(),
    INDEX (mahasiswa_id),
    INDEX (lowongan_id),
    CONSTRAINT fk_asisten_dosen_mahasiswa_id_user_id FOREIGN KEY (mahasiswa_id) REFERENCES user (id),
    CONSTRAINT fk_asisten_dosen_lowongan_id_lowongan_id FOREIGN KEY (lowongan_id) REFERENCES lowongan (id)
);