<?php
/**
 * FrontController: Mengurus halaman publik (Landing Page).
 * Controller ini menangani rute yang dapat diakses oleh semua pengguna (non-autentikasi).
 * File ini berada di /app/controllers/FrontController.php
 */

// Asumsikan BaseController sudah dimuat melalui autoloader

class FrontController extends BaseController {
    
    /**
     * Menampilkan Halaman Utama (Landing Page) saat user mengakses root URL ('/').
     */
    public function index() {
        // Tampilkan view landing_page.php
        // Karena ini adalah halaman publik, kita muat view langsung tanpa layout admin.php.
        // Asumsi /views/front/landing_page.php memiliki tag HTML dan styling lengkap di dalamnya.
        
        require_once VIEW_PATH . '/front/landing_page.php'; 
    }
    
    // CATATAN: Method showLogin() dihapus karena redirect ke /login
    // seharusnya ditangani langsung di link HTML pada landing_page.php
}