-- --------------------------------------------------------
-- FILE: database/schema.sql
-- Digunakan untuk membuat ulang struktur tabel database SPK Mandiri.
-- --------------------------------------------------------

-- 1. Tabel users
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `username` VARCHAR(50) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `nama_lengkap` VARCHAR(100) NOT NULL,
  `level` ENUM('admin', 'manager') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 2. Tabel kriteria
CREATE TABLE IF NOT EXISTS `kriteria` (
  `id_kriteria` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `kode_kriteria` VARCHAR(5) NOT NULL UNIQUE,
  `nama_kriteria` VARCHAR(100) NOT NULL,
  `tipe` ENUM('benefit', 'cost') NOT NULL,
  `bobot` DECIMAL(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 3. Tabel debitur
CREATE TABLE IF NOT EXISTS `debitur` (
  `id_debitur` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nama_debitur` VARCHAR(150) NOT NULL,
  `no_rek` VARCHAR(20) DEFAULT NULL,
  `alamat` TEXT,
  `pekerjaan` VARCHAR(100) NOT NULL,
  `tgl_input` DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 4. Tabel penilaian (Matriks Keputusan)
CREATE TABLE IF NOT EXISTS `penilaian` (
  `id_penilaian` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `id_debitur` INT(11) NOT NULL,
  `id_kriteria` INT(11) NOT NULL,
  `nilai_skor` INT(11) NOT NULL,
  UNIQUE KEY `debitur_kriteria_unique` (`id_debitur`, `id_kriteria`),
  CONSTRAINT `fk_debitur_penilaian` FOREIGN KEY (`id_debitur`) REFERENCES `debitur` (`id_debitur`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_kriteria_penilaian` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 5. Tabel hasil_saw
CREATE TABLE IF NOT EXISTS `hasil_saw` (
  `id_hasil` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `id_debitur` INT(11) NOT NULL UNIQUE,
  `nilai_akhir` DECIMAL(10,4) NOT NULL,
  `ranking` INT(11) NOT NULL,
  `tgl_proses` DATETIME DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT `fk_debitur_hasil` FOREIGN KEY (`id_debitur`) REFERENCES `debitur` (`id_debitur`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
