<?php
/**
 * KriteriaModel: Interaksi dengan tabel 'kriteria'.
 * Model ini bertanggung jawab menyediakan data Kriteria, Tipe (Benefit/Cost), dan Bobot (Wj) 
 * yang sangat penting untuk perhitungan SAW.
 */
class KriteriaModel extends BaseModel {
    // Properti $table menentukan tabel mana yang digunakan Model ini
    protected $table = 'kriteria';

    /**
     * Mengambil semua data kriteria dari database, diurutkan berdasarkan kode.
     * @return array Semua data kriteria (id_kriteria, kode_kriteria, tipe, bobot, dsb.).
     */
    public function getAll() {
        $sql = "SELECT * FROM {$this->table} ORDER BY kode_kriteria ASC";
        return $this->query($sql)->fetchAll();
    }

    /**
     * Mengambil bobot (Wj) dan tipe kriteria yang dibutuhkan untuk normalisasi SAW.
     * Mengembalikan data dalam format array asosiatif yang mudah diproses.
     * @return array Map [id_kriteria => ['bobot' => float, 'tipe' => string]].
     */
    public function getKriteriaSawMap() {
        $data = $this->getAll();
        $saw_map = [];
        
        foreach ($data as $item) {
            $saw_map[$item['id_kriteria']] = [
                'bobot' => (float)$item['bobot'],
                'tipe' => $item['tipe']
            ];
        }
        
        return $saw_map;
    }
    
    // CATATAN: Method asli getBobotMap() dihapus dan diganti dengan getKriteriaSawMap()
    // agar data bobot DAN tipe (benefit/cost) diambil sekaligus, yang lebih efisien 
    // untuk logika perhitungan SAW.
}