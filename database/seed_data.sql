-- --------------------------------------------------------
-- FILE: database/seed_data.sql
-- Digunakan untuk mengisi data awal (users, kriteria default)
-- --------------------------------------------------------

-- 1. Data Pengguna (Users)
-- Password: admin123
SET @ADMIN_HASH = '$2y$10$C823jQW.tD8j4Ld6tO9YDu5Yg8h1/L1/l4sJ9iL.vG.8S/l2hT9fR'; 
-- Password: manager123
SET @MANAGER_HASH = '$2y$10$1/G0tV7fF1vR4sH9jG2hE8qP4wA2eU6cM0yX8bO5iN3kD7lJ0fR'; 

INSERT INTO `users` (`username`, `password`, `nama_lengkap`, `level`) VALUES
('admin', @ADMIN_HASH, 'Admin Cabang Galang', 'admin'),
('manager', @MANAGER_HASH, 'Manager Mikro Galang', 'manager')
ON DUPLICATE KEY UPDATE 
`password` = VALUES(`password`), `nama_lengkap` = VALUES(`nama_lengkap`), `level` = VALUES(`level`);


-- 2. Data Kriteria Default
INSERT INTO `kriteria` (`id_kriteria`, `kode_kriteria`, `nama_kriteria`, `tipe`, `bobot`) VALUES
(1, 'C1', 'Karakter (Integritas)', 'benefit', 0.20),
(2, 'C2', 'Kapasitas (Kemampuan Bayar)', 'benefit', 0.35),
(3, 'C3', 'Jaminan (Kualitas Agunan)', 'benefit', 0.15),
(4, 'C4', 'Plafond Kredit', 'cost', 0.10),
(5, 'C5', 'Riwayat Kredit (SLIK OJK)', 'benefit', 0.20)
ON DUPLICATE KEY UPDATE 
`bobot` = VALUES(`bobot`), `tipe` = VALUES(`tipe`);
