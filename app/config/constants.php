<?php
/**
 * Konstanta Global Aplikasi
 * File ini mengasumsikan ROOT_PATH sudah didefinisikan di init.php.
 */

// 1. Pengaturan URL Dasar
// Ganti nilai 'YOUR_BASE_URL' dengan URL dasar proyek Anda.
define('BASE_URL', 'http://localhost/SPK_MANDIRI/public'); // HARUS SAMA PERSIS CASING-nya

// 2. Pengaturan PATH Sistem
// Hati-hati! Asumsikan ROOT_PATH sudah ada dari init.php
// Jika Anda ingin mengamankan, tambahkan cek 'if (!defined('ROOT_PATH')) { die('System init failed'); }'

// PATH ke folder App (untuk memuat controllers, models, dll.)
define('APP_PATH', ROOT_PATH . '/app');

// PATH ke folder Views
define('VIEW_PATH', ROOT_PATH . '/views');


// 3. Pengaturan Aplikasi Lain
define('APP_NAME', 'SPK Debitur Mikro Bank Mandiri Galang');
define('APP_VERSION', '1.0.0');

// 4. Pengaturan Sesi (Penting untuk Auth)
define('SESSION_NAME', 'spk_mandiri_session');
define('SESSION_LIFETIME', 3600); // 1 jam dalam detik
