CREATE DATABASE IF NOT EXISTS db_voting_kakang_senduk CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE db_voting_kakang_senduk;

CREATE TABLE users (
 id INT AUTO_INCREMENT PRIMARY KEY,
 nama VARCHAR(100) NOT NULL,
 email VARCHAR(100) NOT NULL UNIQUE,
 no_hp VARCHAR(20) NOT NULL,
 password VARCHAR(255) NOT NULL,
 role ENUM('admin','pemilih') NOT NULL DEFAULT 'pemilih',
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE kontestan (
 id INT AUTO_INCREMENT PRIMARY KEY,
 nomor_peserta VARCHAR(10) NOT NULL,
 nama VARCHAR(100) NOT NULL,
 kategori ENUM('Kakang','Senduk') NOT NULL,
 foto VARCHAR(255) DEFAULT NULL,
 asal_instansi VARCHAR(150) DEFAULT NULL,
 visi TEXT,
 misi TEXT,
 deskripsi TEXT,
 UNIQUE KEY unik_nomor_kategori(nomor_peserta,kategori)
) ENGINE=InnoDB;

CREATE TABLE periode_voting (
 id INT AUTO_INCREMENT PRIMARY KEY,
 nama_periode VARCHAR(100) NOT NULL,
 tanggal_mulai DATETIME NOT NULL,
 tanggal_selesai DATETIME NOT NULL,
 status ENUM('Aktif','Nonaktif') NOT NULL DEFAULT 'Nonaktif',
 harga_per_suara INT UNSIGNED NOT NULL DEFAULT 1000,
 rekening VARCHAR(60) DEFAULT NULL,
 pemilik_rekening VARCHAR(100) DEFAULT NULL
) ENGINE=InnoDB;

CREATE TABLE pembayaran (
 id INT AUTO_INCREMENT PRIMARY KEY,
 user_id INT NOT NULL,
 kontestan_id INT NOT NULL,
 periode_id INT NOT NULL,
 jumlah_suara INT UNSIGNED NOT NULL,
 total_bayar INT UNSIGNED NOT NULL,
 nama_pengirim VARCHAR(100) NOT NULL,
 bukti VARCHAR(255) NOT NULL,
 status ENUM('Menunggu','Disetujui','Ditolak') NOT NULL DEFAULT 'Menunggu',
 catatan_admin VARCHAR(255) DEFAULT NULL,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 diverifikasi_pada DATETIME DEFAULT NULL,
 CONSTRAINT fk_bayar_user FOREIGN KEY(user_id) REFERENCES users(id),
 CONSTRAINT fk_bayar_kontestan FOREIGN KEY(kontestan_id) REFERENCES kontestan(id),
 CONSTRAINT fk_bayar_periode FOREIGN KEY(periode_id) REFERENCES periode_voting(id)
) ENGINE=InnoDB;

CREATE TABLE voting (
 id INT AUTO_INCREMENT PRIMARY KEY,
 user_id INT NOT NULL,
 kontestan_id INT NOT NULL,
 kategori ENUM('Kakang','Senduk') NOT NULL,
 pembayaran_id INT NOT NULL UNIQUE,
 jumlah_suara INT UNSIGNED NOT NULL DEFAULT 1,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 UNIQUE KEY satu_suara_per_kategori(user_id,kategori),
 CONSTRAINT fk_vote_user FOREIGN KEY(user_id) REFERENCES users(id),
 CONSTRAINT fk_vote_kontestan FOREIGN KEY(kontestan_id) REFERENCES kontestan(id),
 CONSTRAINT fk_vote_pembayaran FOREIGN KEY(pembayaran_id) REFERENCES pembayaran(id)
) ENGINE=InnoDB;

-- Akun admin awal: buat hash password dengan PHP password_hash().
-- Setelah import database, jalankan file buat-admin.php satu kali, lalu hapus file tersebut.
