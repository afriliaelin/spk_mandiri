<?php
/**
 * DashboardController: Mengurus logika tampilan halaman dashboard utama.
 * Controller ini menampilkan ringkasan data penting setelah pengguna berhasil login.
 * File ini berada di /app/controllers/DashboardController.php
 */

// Asumsikan Auth, DebiturModel, KriteriaModel, HasilSawModel, dan BaseController 
// sudah dimuat melalui autoloader.

class DashboardController extends BaseController {

    private $debiturModel;
    private $kriteriaModel;
    private $hasilSawModel;

    /**
     * Constructor Controller.
     * Menginisialisasi Models dan memastikan pengguna sudah terautentikasi.
     */
    public function __construct() {
        // PENTING: Panggil constructor BaseController.
        parent::__construct(); 
        
        // 1. Cek Otentikasi Wajib
        if (!Auth::check()) {
            $this->redirect('/login');
        }
        
        // Opsional: Cek Otorisasi berdasarkan level jika dashboard hanya untuk admin/manager tertentu
        // if (!Auth::check(['admin', 'manager'])) {
        //     $this->redirect('/unauthorized'); 
        // }
        
        // 2. Inisialisasi Models
        $this->debiturModel = new DebiturModel();
        $this->kriteriaModel = new KriteriaModel();
        $this->hasilSawModel = new HasilSawModel();
    }

    /**
     * Menampilkan halaman Dashboard utama dengan ringkasan statistik SPK.
     */
    public function index() {
        // 1. Ambil data statistik wajib
        $data['total_debitur'] = $this->debiturModel->countAll();
        $data['total_kriteria'] = $this->kriteriaModel->countAll();

        // 2. Ambil Data Debitur Terbaik (Rank 1)
        $terbaik = $this->hasilSawModel->getTopRankedDebitur();
        
        // 3. Persiapkan data untuk View
        if ($terbaik) {
            $data['debitur_terbaik'] = [
                'nama' => $terbaik['nama_debitur'],
                'nilai' => (float) $terbaik['nilai_akhir'] // Pastikan casting float
            ];
        } else {
             // Nilai default jika belum ada hasil perhitungan di database
             $data['debitur_terbaik'] = [
                 'nama' => 'Belum Diproses',
                 'nilai' => 0.0000
             ];
        }

        // Memuat view dashboard
        $this->view('dashboard/index', $data); 
    }
}