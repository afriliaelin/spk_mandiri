<?php
/**
 * ErrorController: Controller untuk menangani halaman error 404 Not Found.
 * File ini harus dibuat agar tidak terjadi Fatal Error.
 */

class ErrorController extends BaseController {
    
    // Metode yang dipanggil ketika rute tidak ditemukan (sesuai routes.php)
    public function notFound() {
        // Set header response 404
        header("HTTP/1.0 404 Not Found");
        
        // Memuat view 404 (diasumsikan ada di /views/layout/not_found.php)
        require_once VIEW_PATH . '/layout/not_found.php';
        exit;
    }
}