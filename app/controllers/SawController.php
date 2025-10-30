<?php

// SawController bertanggung jawab untuk memicu dan menampilkan hasil perhitungan
// Asumsikan SawMethod.php, DebiturModel.php, PenilaianModel.php, dan HasilSawModel.php sudah di-load

class SawController extends BaseController {

    public function prosesPerhitungan() {
        if (!Auth::check(['admin', 'manager'])) {
            $this->redirect('/login');
        }

        // 1. Ambil semua data yang dibutuhkan dari DB (Kriteria, Bobot, Matriks Penilaian)
        $kriteria = (new KriteriaModel())->getAll();
        $matriks_penilaian = (new PenilaianModel())->getMatriksKeputusan(); 

        // 2. Lakukan Perhitungan Inti SAW
        $sawMethod = new SawMethod($kriteria, $matriks_penilaian);
        $hasil_perhitungan = $sawMethod->hitung(); // Metode ini berisi Normalisasi, Pembobotan, dan Perankingan
        
        // 3. Simpan Hasil Akhir ke Tabel hasil_saw (untuk audit & laporan)
        (new HasilSawModel())->saveResults($hasil_perhitungan);

        $_SESSION['success'] = 'Perhitungan SAW berhasil diproses dan disimpan!';
        $this->redirect('/saw/hasil');
    }

    public function hasilIndex() {
        if (!Auth::check()) {
            $this->redirect('/login');
        }

        // Ambil data hasil akhir dari tabel hasil_saw
        $data['hasil'] = (new HasilSawModel())->getRankingWithDebiturName(); 

        $this->view('saw/hasil_saw', $data);
    }

    public function detailProses() {
        if (!Auth::check(['manager'])) {
            $this->redirect('/login');
        }

        // Ambil data untuk ditampilkan (Matriks Keputusan mentah dan Matriks Normalisasi)
        $data['kriteria'] = (new KriteriaModel())->getAll();
        $data['matriks_keputusan'] = (new PenilaianModel())->getMatriksKeputusan(); 
        
        // Ulangi perhitungan tanpa menyimpan untuk mendapatkan detail proses
        $sawMethod = new SawMethod($data['kriteria'], $data['matriks_keputusan']);
        $data['matriks_normalisasi'] = $sawMethod->getNormalizedMatrix(); 

        // Tampilkan view audit trail
        $this->view('saw/detail_proses', $data); 
    }
}