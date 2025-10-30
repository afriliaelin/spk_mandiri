<?php
/**
 * BaseController: Kelas Dasar untuk semua Controller.
 * Menyediakan fungsionalitas inti yang dibutuhkan oleh semua Controller turunan (View dan Redirect).
 * File ini berada di /app/controllers/BaseController.php
 */

// Asumsikan konstanta (VIEW_PATH, BASE_URL) sudah dimuat oleh init.php
// Asumsikan Helper dan ErrorController dimuat melalui Autoloader

class BaseController {
    
    /**
     * Constructor Controller.
     * Dipanggil oleh Controller turunan untuk mengamankan pewarisan.
     */
    public function __construct() {
        // Logika di sini minimal, hanya untuk menjamin pemanggilan parent::__construct() aman.
    }
    
    /**
     * Metode untuk memuat tampilan (View) ke dalam kerangka layout utama.
     * Menggunakan /views/layout/admin.php sebagai pembungkus utama (Header, Sidebar, Footer).
     * * @param string $view_name Nama file view (tanpa ekstensi .php), cth: 'dashboard/index'
     * @param array $data Data yang akan dilewatkan ke view.
     * @return void
     */
    protected function view(string $view_name, array $data = []): void { // Menambah tipe hint untuk profesionalisme
        
        // Ekstrak data agar variabel bisa diakses langsung di file view
        extract($data); 
        
        // 1. Tentukan path ke file konten spesifik
        $content_file_path = VIEW_PATH . '/' . $view_name . '.php'; 
        
        if (!file_exists($content_file_path)) {
            // Jika konten view tidak ditemukan, arahkan ke 404 melalui ErrorController
            (new ErrorController())->notFound();
            return;
        }

        // 2. Variabel $page_content digunakan di dalam /views/layout/admin.php
        $page_content = $content_file_path; 
        
        // 3. Muat layout utama yang akan membungkus konten
        $layout_file_path = VIEW_PATH . '/layout/admin.php';

        if (file_exists($layout_file_path)) {
            require_once $layout_file_path;
        } else {
            // Fallback darurat jika layout admin tidak ditemukan
            // Ini akan mempermudah debugging jika ada masalah path VIEW_PATH
            die("Error Fatal: Layout utama 'admin.php' tidak ditemukan di path: " . $layout_file_path); 
        }
    }

    /**
     * Metode untuk redirect (pindah halaman) menggunakan header HTTP.
     * * @param string $path Path setelah BASE_URL (e.g., '/dashboard')
     * @return void
     */
    protected function redirect(string $path): void { // Menambah tipe hint
        header("Location: " . BASE_URL . $path);
        exit(); // Wajib diakhiri dengan exit() setelah header redirect
    }
}