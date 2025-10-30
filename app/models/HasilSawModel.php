<?php
/**
 * HasilSawModel: Interaksi dengan tabel 'hasil_saw'.
 * Menyimpan dan mengambil hasil akhir perhitungan SAW.
 * File ini berada di /app/models/HasilSawModel.php
 */
class HasilSawModel extends BaseModel {
    protected $table = 'hasil_saw'; 

    /**
     * Menyimpan hasil akhir perhitungan SAW (V) dan ranking.
     * Metode ini dipanggil setelah SawMethod->hitung().
     * @param array $results Hasil perhitungan SAW (berisi id_debitur, nilai_akhir, ranking).
     * @return bool True jika berhasil, False jika gagal.
     */
    public function saveResults($results) {
        // Gunakan transaksi untuk memastikan semua data tersimpan atau tidak sama sekali
        $this->db->beginTransaction();
        try {
            // Hapus data lama untuk perhitungan baru
            // PENTING: Menggunakan $this->table
            $this->db->exec("DELETE FROM {$this->table}"); 

            $sql = "INSERT INTO {$this->table} (id_debitur, nilai_akhir, ranking) VALUES (?, ?, ?)";
            $stmt = $this->db->prepare($sql);

            foreach ($results as $result) {
                // Binding data untuk keamanan
                $stmt->execute([
                    $result['id_debitur'],
                    $result['nilai_akhir'],
                    $result['ranking']
                ]);
            }
            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            // Dalam implementasi nyata, logger harus dipanggil di sini:
            // $this->logError("Gagal menyimpan hasil SAW: " . $e->getMessage()); 
            return false;
        }
    }

    /**
     * Mengambil ranking debitur terbaik (Rank 1) untuk Dashboard.
     * @return array|false Data debitur terbaik (nama_debitur, nilai_akhir), atau false jika tidak ada.
     */
    public function getTopRankedDebitur() {
        // PENTING: Gunakan $this->table dan join dengan tabel 'debitur'
        $sql = "SELECT h.nilai_akhir, d.nama_debitur 
                FROM {$this->table} h
                JOIN debitur d ON h.id_debitur = d.id_debitur
                WHERE h.ranking = 1 
                LIMIT 1"; // Limit 1 sudah cukup
        return $this->query($sql)->fetch();
    }
    
    /**
     * Mengambil semua hasil ranking dengan nama debitur untuk halaman Hasil & Ranking.
     * @return array Hasil ranking dengan nama debitur.
     */
    public function getRankingWithDebiturName() {
        // PENTING: Gunakan $this->table dan join dengan tabel 'debitur'
        $sql = "SELECT h.*, d.nama_debitur 
                FROM {$this->table} h
                JOIN debitur d ON h.id_debitur = d.id_debitur
                ORDER BY h.ranking ASC";
        return $this->query($sql)->fetchAll();
    }
}