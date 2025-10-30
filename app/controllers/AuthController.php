<?php
/**
 * AuthController: Mengurus Login dan Logout.
 * File ini berada di /app/controllers/AuthController.php
 */
// Asumsikan UserModel, Loggable (Trait), dan BaseController sudah dimuat melalui autoloader

class AuthController extends BaseController {
    
    // Gunakan Trait Loggable untuk mencatat aktivitas (opsional, tapi disarankan)
    // use Loggable; 

    /**
     * Menampilkan halaman login.
     */
    public function index() {
        // PENTING: Karena halaman login tidak menggunakan Header/Sidebar admin, 
        // kita muat layout khusus auth.php langsung.
        require_once VIEW_PATH . '/layout/auth.php'; 
    }

    /**
     * Memproses data login (action="/do_login").
     */
    public function login() {
        // Pastikan hanya menerima permintaan POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            $userModel = new UserModel();
            $user = $userModel->findByUsername($username);

            // Cek apakah user ada DAN password cocok dengan hash di database
            if ($user && password_verify($password, $user['password'])) {
                
                // Login Berhasil: Set Session dengan data yang diperlukan
                $_SESSION[SESSION_NAME] = [
                    'id' => $user['id_user'],
                    'username' => $user['username'],
                    'nama_lengkap' => $user['nama_lengkap'], // Tambahkan nama lengkap
                    'level' => $user['level']
                ];
                
                // if (method_exists($this, 'logInfo')) {
                //     $this->logInfo("Login berhasil untuk user: {$username}");
                // }
                
                $this->redirect('/dashboard');

            } else {
                // Login Gagal
                $_SESSION['error'] = 'Username atau Password salah.';
                
                // if (method_exists($this, 'logError')) {
                //     $this->logError("Percobaan login gagal untuk user: {$username}");
                // }
                
                $this->redirect('/login');
            }
        } else {
            // Jika diakses non-POST, redirect kembali
            $this->redirect('/login');
        }
    }

    /**
     * Menghancurkan sesi dan mengarahkan ke halaman login.
     */
    public function logout() {
        // if (method_exists($this, 'logInfo')) {
        //     $this->logInfo("Logout berhasil untuk user: " . (Auth::user('username') ?? 'unknown'));
        // }
        
        session_destroy();
        // Memastikan semua cookie sesi terhapus
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        
        $this->redirect('/login');
    }
}