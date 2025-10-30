<?php
/**
 * init.php: File Inisialisasi Utama Aplikasi (Bootstrap).
 * Mengatur lingkungan, memulai sesi, dan memuat autoloader.
 */

// Mulai Sesi (PENTING untuk Auth)
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// 1. Definisikan Path Dasar Aplikasi (HANYA DI SINI)
define('ROOT_PATH', __DIR__);

// 2. Muat File Konfigurasi
// Pastikan nama folder dan file sudah benar (e.g., SPK_MANDIRI)
require_once ROOT_PATH . '/app/config/constants.php';
require_once ROOT_PATH . '/app/config/database.php';
require_once ROOT_PATH . '/app/config/routes.php';

// 3. Autoloader Sederhana (Penting untuk mengatasi Class Not Found)
spl_autoload_register(function ($class_name) {
    
    // Daftar semua folder yang berisi class
    $directories = [
        '/app/controllers/',
        '/app/models/',
        '/app/libraries/',
        '/app/traits/',
    ];

    // Loop untuk mencoba memuat class
    foreach ($directories as $dir_path) {
        $file = ROOT_PATH . $dir_path . $class_name . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
    
    // Pastikan BaseController juga dimuat
    if ($class_name === 'BaseController') {
        $file_base = ROOT_PATH . '/app/controllers/BaseController.php';
        if (file_exists($file_base)) {
            require_once $file_base;
        }
    }
});
// 4. Perbaikan ErrorController di Index.php akan memastikan ini terpanggil.