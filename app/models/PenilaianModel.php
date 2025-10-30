<?php
/**
 * PenilaianModel: Interaksi dengan tabel 'penilaian'.
 * Menyimpan Matriks Keputusan (Xij).
 */
class PenilaianModel extends BaseModel {
    protected $table = 'penilaian';

    /**
     * Mengambil skor penilaian untuk debitur tertentu.
     * @param int $debitur_id ID debitur.
     * @return array Skor [id_kriteria => nilai_skor].
     */
    public function getSkorByDebitur($debitur_id) {
        $sql = "SELECT id_kriteria, nilai_skor FROM {$this->table} WHERE id_debitur = ?";
        $data = $this->query($sql, [$debitur_id])->fetchAll();
        
        $skor_map = [];
        foreach ($data as $item) {
            $skor_map[$item['id_kriteria']] = $item['nilai_skor'];
        }
        return $skor_map;
    }
    
    /**
     * Menyimpan atau mengupdate skor penilaian (INSERT OR UPDATE).
     * @param int $debitur_id ID debitur.
     * @param int $kriteria_id ID kriteria.
     * @param int $nilai_skor Skor yang diberikan.
     * @return bool True jika berhasil.
     */
    public function saveOrUpdate($debitur_id, $kriteria_id, $nilai_skor) {
        // Cek apakah data penilaian sudah ada
        $check_sql = "SELECT id_penilaian FROM {$this->table} WHERE id_debitur = ? AND id_kriteria = ?";
        $existing = $this->query($check_sql, [$debitur_id, $kriteria_id])->fetch();

        if ($existing) {
            // Jika sudah ada, lakukan UPDATE
            $sql = "UPDATE {$this->table} SET nilai_skor = ? WHERE id_penilaian = ?";
            return $this->query($sql, [$nilai_skor, $existing['id_penilaian']]);
        } else {
            // Jika belum ada, lakukan INSERT
            $sql = "INSERT INTO {$this->table} (id_debitur, id_kriteria, nilai_skor) VALUES (?, ?, ?)";
            return $this->query($sql, [$debitur_id, $kriteria_id, $nilai_skor]);
        }
    }

    /**
     * Mengambil Matriks Keputusan lengkap (Xij) dalam format yang siap diproses oleh SawMethod.
     * @return array Matriks [id_debitur => ['nama_debitur' => 'X', id_kriteria => nilai_skor, ...]].
     */
    public function getMatriksKeputusan() {
        $sql = "
            SELECT 
                d.id_debitur, 
                d.nama_debitur, 
                p.id_kriteria, 
                p.nilai_skor
            FROM penilaian p
            JOIN debitur d ON p.id_debitur = d.id_debitur
            ORDER BY d.id_debitur, p.id_kriteria
        ";
        $result = $this->query($sql)->fetchAll();

        $matriks = [];
        foreach ($result as $row) {
            $debitur_id = $row['id_debitur'];
            
            if (!isset($matriks[$debitur_id])) {
                $matriks[$debitur_id] = [
                    'nama_debitur' => $row['nama_debitur']
                ];
            }
            // Masukkan skor kriteria
            $matriks[$debitur_id][$row['id_kriteria']] = (float)$row['nilai_skor'];
        }
        return $matriks;
    }
}