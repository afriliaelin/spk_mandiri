<?php
/**
 * Class SawMethod: Implementasi Algoritma Simple Additive Weighting.
 * Menangani Normalisasi Matriks Keputusan (R) dan Perankingan Akhir (V).
 */
class SawMethod {
    
    private $kriteria;          // Data Kriteria dan Bobot (Cj, Wj)
    private $matriks_keputusan; // Matriks Keputusan Mentah (Xij)
    private $matriks_normalisasi = []; // Matriks Normalisasi (Rij)

    public function __construct($kriteria, $matriks_keputusan) {
        $this->kriteria = $kriteria;
        $this->matriks_keputusan = $matriks_keputusan;
    }

    /**
     * Mendapatkan Nilai Maks/Min untuk setiap kriteria (untuk Normalisasi).
     * @return array Array berisi [id_kriteria => ['max' => value, 'min' => value]].
     */
    private function getMinMaxValues() {
        $min_max = [];
        
        // Inisialisasi Max/Min dari kriteria
        foreach ($this->kriteria as $k) {
            $min_max[$k['id_kriteria']] = ['max' => null, 'min' => null];
        }

        // Cari Max dan Min dari semua skor
        foreach ($this->matriks_keputusan as $debitur_id => $skor_debitur) {
            foreach ($skor_debitur as $kriteria_id => $nilai_skor) {
                
                $nilai = (float) $nilai_skor;

                if (is_null($min_max[$kriteria_id]['max']) || $nilai > $min_max[$kriteria_id]['max']) {
                    $min_max[$kriteria_id]['max'] = $nilai;
                }
                
                if (is_null($min_max[$kriteria_id]['min']) || $nilai < $min_max[$kriteria_id]['min']) {
                    $min_max[$kriteria_id]['min'] = $nilai;
                }
            }
        }
        return $min_max;
    }

    /**
     * Melakukan proses Normalisasi Matriks Keputusan (X) menjadi Matriks Normalisasi (R).
     * Rumus:
     * Tipe BENEFIT: Rij = Xij / Max(Xj)
     * Tipe COST: Rij = Min(Xj) / Xij
     */
    private function normalisasi() {
        $min_max = $this->getMinMaxValues();
        $kriteria_tipe = array_column($this->kriteria, 'tipe', 'id_kriteria'); // Map ID ke Tipe

        $this->matriks_normalisasi = [];
        
        foreach ($this->matriks_keputusan as $debitur_id => $skor_debitur) {
            $this->matriks_normalisasi[$debitur_id] = [
                'nama_debitur' => $skor_debitur['nama_debitur'], // Tambahkan nama untuk kemudahan
            ];
            
            foreach ($skor_debitur as $kriteria_id => $nilai_skor) {
                if ($kriteria_id === 'nama_debitur') continue;

                $nilai_x = (float) $nilai_skor;
                $tipe = $kriteria_tipe[$kriteria_id];
                $max = $min_max[$kriteria_id]['max'];
                $min = $min_max[$kriteria_id]['min'];
                $rij = 0; // Nilai normalisasi

                if ($tipe === 'benefit' && $max != 0) {
                    // Benefit: Rij = Xij / Max(Xj)
                    $rij = $nilai_x / $max;
                } elseif ($tipe === 'cost' && $nilai_x != 0) {
                    // Cost: Rij = Min(Xj) / Xij
                    $rij = $min / $nilai_x;
                }
                
                $this->matriks_normalisasi[$debitur_id][$kriteria_id] = round($rij, 4); // Bulatkan 4 angka di belakang koma
            }
        }
    }
    
    /**
     * Melakukan proses Perankingan Akhir (V).
     * Rumus: Vi = Sigma(Rij * Wj)
     * @return array Hasil akhir perankingan.
     */
    private function perankingan() {
        $hasil_akhir = [];
        $kriteria_bobot = array_column($this->kriteria, 'bobot', 'id_kriteria'); // Map ID ke Bobot (Wj)

        foreach ($this->matriks_normalisasi as $debitur_id => $data_normalisasi) {
            $nilai_v = 0; // Nilai akhir Vi
            
            foreach ($data_normalisasi as $kriteria_id => $rij) {
                if ($kriteria_id === 'nama_debitur') continue;

                $bobot = (float) $kriteria_bobot[$kriteria_id]; // Wj
                $nilai_v += $rij * $bobot; // Vi = Vi + (Rij * Wj)
            }

            $hasil_akhir[$debitur_id] = [
                'id_debitur' => $debitur_id,
                'nama_debitur' => $data_normalisasi['nama_debitur'],
                'nilai_akhir' => round($nilai_v, 4)
            ];
        }

        // Lakukan pengurutan (Ranking) secara DESC (Nilai V terbesar adalah terbaik)
        uasort($hasil_akhir, function($a, $b) {
            return $b['nilai_akhir'] <=> $a['nilai_akhir'];
        });

        // Berikan peringkat (1, 2, 3, dst.)
        $ranking = 1;
        foreach ($hasil_akhir as $id => &$hasil) {
            $hasil['ranking'] = $ranking++;
        }

        return $hasil_akhir;
    }

    /**
     * Metode utama untuk menjalankan seluruh proses SAW.
     * @return array Hasil perankingan akhir.
     */
    public function hitung() {
        $this->normalisasi();
        return $this->perankingan();
    }
    
    /**
     * Mengambil matriks normalisasi (untuk keperluan audit trail/SawController).
     * @return array Matriks Normalisasi (Rij).
     */
    public function getNormalizedMatrix() {
        $this->normalisasi();
        return $this->matriks_normalisasi;
    }
}