<?php
/**
 * Class Auth: Untuk Manajemen Otentikasi dan Otorisasi Pengguna.
 * File ini berada di /app/libraries/Auth.php
 */
class Auth {
    
    /**
     * Memeriksa apakah pengguna sudah login, dan secara opsional, apakah levelnya diizinkan.
     * * @param array $allowed_levels Array berisi level yang diizinkan (e.g., ['admin', 'manager']).
     * @return bool True jika diizinkan (login dan level cocok), False jika tidak.
     */
    public static function check($allowed_levels = []) {
        // 1. Cek Dasar: Apakah session login ada dan tidak kosong?
        // Catatan: SESSION_NAME harus didefinisikan di constants.php
        if (!isset($_SESSION[SESSION_NAME]) || empty($_SESSION[SESSION_NAME])) {
            return false; // Belum login atau sesi kosong
        }

        // Jika tidak ada level yang ditentukan, kembalikan true (cukup sudah login)
        if (empty($allowed_levels)) {
            return true;
        }

        // 2. Cek Otorisasi: Apakah level diizinkan?
        // Menggunakan operator ?? (null coalescing) untuk keamanan
        $user_level = $_SESSION[SESSION_NAME]['level'] ?? '';
        
        return in_array($user_level, $allowed_levels); // Cek apakah level user ada di array yang diizinkan
    }

    /**
     * Mengambil data pengguna yang sedang login.
     * * @param string $key Kunci data yang ingin diambil (e.g., 'level', 'username').
     * @return mixed Nilai data, seluruh array sesi, atau null jika tidak ditemukan.
     */
    public static function user($key = null) {
        // Gunakan method check() untuk validasi status login dasar
        if (self::check()) { 
            if ($key && isset($_SESSION[SESSION_NAME][$key])) {
                return $_SESSION[SESSION_NAME][$key];
            }
            return $_SESSION[SESSION_NAME]; // Kembalikan seluruh array sesi
        }
        return null; // Tidak ada user yang login
    }
}