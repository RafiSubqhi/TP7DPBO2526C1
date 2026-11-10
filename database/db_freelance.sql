CREATE DATABASE IF NOT EXISTS db_freelance;
USE db_freelance;

-- Tabel 1: Klien
CREATE TABLE klien (
    id_klien INT AUTO_INCREMENT PRIMARY KEY,
    nama_perusahaan VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE
);

-- Tabel 2: Freelancer
CREATE TABLE freelancer (
    id_freelancer INT AUTO_INCREMENT PRIMARY KEY,
    nama_freelancer VARCHAR(100) NOT NULL,
    skill_utama VARCHAR(100) NOT NULL
);

-- Tabel 3: Proyek (Memiliki Foreign Key)
CREATE TABLE proyek (
    id_proyek INT AUTO_INCREMENT PRIMARY KEY,
    judul_proyek VARCHAR(200) NOT NULL,
    harga INT NOT NULL,
    id_klien INT NOT NULL,
    id_freelancer INT NOT NULL,
    FOREIGN KEY (id_klien) REFERENCES klien(id_klien) ON DELETE CASCADE,
    FOREIGN KEY (id_freelancer) REFERENCES freelancer(id_freelancer) ON DELETE CASCADE
);

-- Insert Data Awal (Hardcode)
INSERT INTO klien (nama_perusahaan, email) VALUES ('Tech Nusantara', 'admin@technusantara.com');
INSERT INTO freelancer (nama_freelancer, skill_utama) VALUES ('Rafi Subqhi', 'C++ Programming');