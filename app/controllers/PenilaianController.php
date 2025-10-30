<?php
// Memastikan DebiturModel, KriteriaModel, dan PenilaianModel sudah dimuat

class PenilaianController extends BaseController {

    public function __construct() {
        parent::__construct();
        if (!Auth::check(['admin'])) { 
            $this->redirect('/login'); 
        }
    }

    // Menampilkan daftar debitur yang siap dinilai
    public function index() {
        $debiturModel = new DebiturModel();
        // Dapatkan semua debitur
        $data['debitur'] = $debiturModel->getAll(); 
        
        // Tampilkan view
        $this->view('penilaian/index', $data); 
    }

    // Menampilkan form input skor untuk debitur tertentu
    public function inputSkor($debitur_id) {
        $debiturModel = new DebiturModel();
        $kriteriaModel = new KriteriaModel();
        $penilaianModel = new PenilaianModel();

        $data['debitur'] = $debiturModel->findById($debitur_id);
        $data['kriteria'] = $kriteriaModel->getAll();
        // Ambil skor yang sudah ada (jika pernah dinilai)
        $data['skor_saat_ini'] = $penilaianModel->getSkorByDebitur($debitur_id); 
        
        if (!$data['debitur']) {
            $this->redirect('/404'); // Atau halaman error lain
        }
        
        $this->view('penilaian/input', $data);
    }

    // Memproses penyimpanan/pembaruan skor (POST)
    public function simpanSkor($debitur_id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $penilaianModel = new PenilaianModel();
            $skor = $_POST['skor'] ?? []; // Array berisi [id_kriteria => nilai_skor]
            $success_count = 0;

            // Simpan atau update setiap skor kriteria
            foreach ($skor as $id_kriteria => $nilai) {
                if ($penilaianModel->saveOrUpdate($debitur_id, $id_kriteria, (int)$nilai)) {
                    $success_count++;
                }
            }

            if ($success_count > 0) {
                $_SESSION['success'] = "Penilaian untuk debitur ID {$debitur_id} berhasil disimpan.";
            } else {
                $_SESSION['error'] = "Tidak ada skor yang disimpan. Pastikan input valid.";
            }
            $this->redirect('/penilaian');
        }
    }
}