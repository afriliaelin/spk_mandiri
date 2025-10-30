<?php
/**
 * DebiturController: Mengurus manajemen data Calon Debitur (Alternatif).
 * Controller ini menangani operasi CRUD untuk data master debitur.
 * File ini berada di /app/controllers/DebiturController.php
 */

// Asumsikan Auth, DebiturModel, dan BaseController sudah dimuat melalui autoloader

class DebiturController extends BaseController {

    private $debiturModel;

    public function __construct() {
        parent::__construct(); 
        
        // 1. Cek Otentikasi & Otorisasi: Hanya Admin yang bisa mengakses CRUD
        if (!Auth::check() || Auth::user('level') !== 'admin') {
            $_SESSION['error'] = 'Anda tidak memiliki hak akses untuk mengelola data master.';
            $this->redirect('/dashboard'); 
        }
        
        $this->debiturModel = new DebiturModel();
    }

    // =========================================================================
    // R: READ
    // =========================================================================

    /**
     * Menampilkan daftar semua debitur.
     */
    public function index() {
        $data['debitur'] = $this->debiturModel->getAll();
        $this->view('debitur/index', $data);
    }

    /**
     * Menampilkan form tambah debitur.
     */
    public function create() {
        // Menggunakan view form tunggal untuk tambah (mode default)
        $this->view('debitur/form', ['mode' => 'create']); 
    }

    /**
     * Menampilkan form edit debitur berdasarkan ID.
     * @param int $id ID Debitur
     */
    public function edit($id) {
        // Menggunakan findById
        $data['debitur_data'] = $this->debiturModel->findById($id);

        if (!$data['debitur_data']) {
            $_SESSION['error'] = 'Data debitur tidak ditemukan.';
            $this->redirect('/debitur');
        }
        
        // Menggunakan view 'debitur/form' dan melewatkan data debitur untuk mode edit
        $this->view('debitur/form', $data); 
    }

    // =========================================================================
    // C: CREATE
    // =========================================================================

    /**
     * Memproses penambahan data debitur (POST).
     */
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $data_insert = [
                'nama_debitur' => $_POST['nama_debitur'] ?? '',
                'alamat'       => $_POST['alamat'] ?? '',
                'pekerjaan'    => $_POST['pekerjaan'] ?? '',
                'no_rek'       => $_POST['no_rek'] ?? ''
            ];

            // Validasi: nama_debitur wajib diisi
            if (empty($data_insert['nama_debitur'])) {
                 $_SESSION['error'] = 'Nama debitur tidak boleh kosong.';
                 $this->redirect('/debitur/create'); // Redirect kembali ke form
            }

            if ($this->debiturModel->insert($data_insert)) {
                $_SESSION['success'] = 'Data debitur berhasil ditambahkan.';
            } else {
                $_SESSION['error'] = 'Gagal menambahkan data debitur. Cek koneksi atau kolom DB.';
            }
        }
        $this->redirect('/debitur');
    }

    // =========================================================================
    // U: UPDATE
    // =========================================================================

    /**
     * Memproses pembaruan data debitur (POST, memerlukan ID).
     */
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $data_update = [
                'nama_debitur' => $_POST['nama_debitur'] ?? '',
                'alamat'       => $_POST['alamat'] ?? '',
                'pekerjaan'    => $_POST['pekerjaan'] ?? '',
                'no_rek'       => $_POST['no_rek'] ?? ''
            ];

            // Validasi
            if (empty($data_update['nama_debitur'])) {
                 $_SESSION['error'] = 'Nama debitur tidak boleh kosong.';
                 $this->redirect('/debitur/edit/' . $id);
            }
            
            // Update ke Model
            if ($this->debiturModel->update($id, $data_update)) {
                $_SESSION['success'] = 'Data debitur berhasil diperbarui.';
            } else {
                $_SESSION['info'] = 'Tidak ada perubahan pada data debitur.'; 
            }
        }
        $this->redirect('/debitur');
    }

    // =========================================================================
    // D: DELETE
    // =========================================================================

    /**
     * Menghapus debitur (memerlukan ID).
     * @param int $id ID Debitur
     */
    public function delete($id) {
        if ($this->debiturModel->delete($id)) {
            $_SESSION['success'] = 'Data debitur berhasil dihapus.';
        } else {
            $_SESSION['error'] = 'Gagal menghapus data debitur. Periksa log.';
        }
        $this->redirect('/debitur');
    }
}