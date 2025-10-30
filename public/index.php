<?php
/**
 * index.php: FRONT CONTROLLER
 * Semua permintaan (request) dialihkan ke file ini untuk diproses.
 */

// Muat file inisialisasi utama
require_once dirname(__DIR__) . '/init.php';

// Mendapatkan URI yang diminta
$uri = $_SERVER['REQUEST_URI'];
// GANTI 'SPK_MANDIRI' DENGAN NAMA FOLDER PROYEK YANG TEPAT!
// Contoh: Jika URL Anda http://localhost/SPK_MANDIRI/public/
$base_path = '/SPK_MANDIRI/public'; 

// Hapus base path dan query string dari URI
$request_uri = str_replace($base_path, '', $uri);

// Hapus query string (misal: ?foo=bar)
$request_uri = parse_url($request_uri, PHP_URL_PATH);

// Bersihkan slash di awal dan akhir.
$request_uri = trim($request_uri, '/');

// PERBAIKAN KRITIS: Jika setelah dibersihkan hasilnya adalah 'index.php' (karena user mengakses /public/index.php) 
// atau string kosong, pastikan menjadi string kosong ('').
if (empty($request_uri) || $request_uri === 'index.php') {
    $request_uri = '';
}


// --- ROUTING CORE LOGIC ---
$controller_name = null;
$method_name = null;
$params = [];
$found = false;

// Cek rute statis (termasuk rute '' untuk Landing Page)
if (array_key_exists($request_uri, $routes)) {
    list($controller_name, $method_name) = $routes[$request_uri];
    $found = true;

} else {
    // Logika untuk rute dengan parameter (misalnya: /debitur/edit/5)
    $parts = explode('/', $request_uri);
    
    // Cari rute yang memiliki pola /segment1/segment2
    if (count($parts) >= 2) {
        $pattern = $parts[0] . '/' . $parts[1];
        if (array_key_exists($pattern, $routes)) {
            list($controller_name, $method_name) = $routes[$pattern];
            $params = array_slice($parts, 2); 
            $found = true;
        }
    }
    // Jika masih belum ditemukan, cek rute dengan 1 segmen dan parameter
    if (!$found && count($parts) >= 1) {
         $pattern = $parts[0];
         if (array_key_exists($pattern, $routes)) {
             list($controller_name, $method_name) = $routes[$pattern];
             $params = array_slice($parts, 1);
             $found = true;
         }
    }
}

// Jika tidak ada rute yang cocok, gunakan rute 404
if (!$found) {
    list($controller_name, $method_name) = $routes['404'];
}

// 6. Buat Instansi Controller dan Panggil Metode
$controller_class = $controller_name . 'Controller';

if (class_exists($controller_class)) {
    $controller = new $controller_class();
    
    if (method_exists($controller, $method_name)) {
        // Panggil metode Controller dengan parameter
        call_user_func_array([$controller, $method_name], $params);
    } else {
        // Jika method tidak ditemukan (Error 404)
        call_user_func_array([(new ErrorController()), 'notFound'], []); 
    }
} else {
    // Jika Controller class tidak ditemukan (Fatal Error)
    call_user_func_array([(new ErrorController()), 'notFound'], []);
}