<?php
// Memastikan KriteriaModel sudah dimuat

class MasterController extends BaseController {

    private $kriteriaModel;

    public function __construct() {
        parent::__construct();
        // Hanya Admin/Manager yang bisa mengubah kriteria dan bobot
        if (!Auth::check(['admin', 'manager'])) { 
            $this->redirect('/login'); 
        }
        $this->kriteriaModel = new KriteriaModel();
    }

    // Menampilkan daftar kriteria dan bobot saat ini
    public function kriteriaIndex() {
        $data['kriteria'] = $this->kriteriaModel->getAll();
        $this->view('master/kriteria', $data);
    }

    // Memproses pembaruan Bobot dan Tipe Kriteria (POST)
    public function updateKriteria() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $kriteria_data = $_POST['kriteria'] ?? [];
            $total_bobot = 0;
            $success = true;

            // Loop untuk mengupdate setiap kriteria
            foreach ($kriteria_data as $id => $data) {
                $bobot = (float)$data['bobot'];
                $tipe = $data['tipe'];
                $total_bobot += $bobot;

                if ($bobot < 0 || $bobot > 1.0) {
                     $_SESSION['error'] = 'Bobot harus antara 0.00 hingga 1.00.';
                     $success = false;
                     break;
                }

                $this->kriteriaModel->update($id, ['bobot' => $bobot, 'tipe' => $tipe]);
            }

            // Validasi Total Bobot (Harus 1.00)
            if ($success && round($total_bobot, 2) != 1.00) {
                $_SESSION['error'] = 'Gagal! Total bobot harus 1.00. Saat ini: ' . $total_bobot;
                $success = false;
            }

            if ($success) {
                $_SESSION['success'] = 'Kriteria dan bobot berhasil diperbarui.';
            }
            
            $this->redirect('/kriteria');
        }
    }
}