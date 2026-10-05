CREATE DATABASE db_sistem_manajemen_perpustakaan;
USE db_sistem_manajemen_perpustakaan;

CREATE TABLE petugas (
    id_petugas INT AUTO_INCREMENT PRIMARY KEY,
    nama_petugas VARCHAR(100) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    PASSWORD VARCHAR(255) NOT NULL,
    ROLE ENUM('Admin', 'Pustakawan') NOT NULL
);

CREATE TABLE peminjam (
    NIS INT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    PASSWORD VARCHAR(255) NOT NULL
);

CREATE TABLE buku (
    id_buku INT AUTO_INCREMENT PRIMARY KEY,
    judul_buku VARCHAR(200) NOT NULL,
    pengarang VARCHAR(100),
    penerbit VARCHAR(100),
    tahun_terbit YEAR,
    stok INT DEFAULT 0
);

CREATE TABLE peminjaman (
    id_peminjaman INT AUTO_INCREMENT PRIMARY KEY,
    id_buku INT NOT NULL,
    NIS INT NOT NULL,
    id_petugas INT NOT NULL,
    tanggal_pinjam DATE NOT NULL,
    tanggal_tenggat DATE NOT NULL,
    tanggal_kembali DATE, 
    STATUS ENUM('Dipinjam', 'Dikembalikan') DEFAULT 'Dipinjam',

    FOREIGN KEY (id_buku) REFERENCES buku(id_buku) ON DELETE CASCADE,
    FOREIGN KEY (NIS) REFERENCES peminjam(NIS) ON DELETE CASCADE,
    FOREIGN KEY (id_petugas) REFERENCES petugas(id_petugas) ON DELETE CASCADE 
);

