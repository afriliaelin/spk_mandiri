<?php
/**
 * Konfigurasi Koneksi Database
 * File ini menyimpan semua detail koneksi ke database MySQL.
 * Digunakan oleh BaseModel.php.
 */

// Konstanta Koneksi Database
// Pastikan HOST, USER, PASSWORD, dan DB_NAME sesuai dengan konfigurasi XAMPP/server Anda.
define('DB_HOST', 'localhost'); // Biasanya localhost jika menggunakan XAMPP
define('DB_USER', 'root');      // Ganti dengan username database Anda
define('DB_PASS', '');          // Ganti dengan password database Anda
define('DB_NAME', 'db_spk_mandiri'); // Nama database yang sudah kita buat

// Pilih metode koneksi: MySQLi atau PDO (PDO lebih disarankan untuk profesionalitas)
define('DB_DRIVER', 'pdo'); 
// Atau 'mysqli' jika Anda memilih MySQLi

// Tambahan: Pengaturan waktu (Opsional, tapi baik untuk profesionalisme)
date_default_timezone_set('Asia/Jakarta');

// Jika Anda ingin menggunakan PDO, Anda bisa mendefinisikan DSN (Data Source Name)
if (DB_DRIVER === 'pdo') {
    define('DB_DSN', 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4');
}

// Catatan: File ini hanya berisi parameter konfigurasi.
// Logika koneksi aktual akan berada di /app/models/BaseModel.php