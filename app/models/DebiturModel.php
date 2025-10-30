<?php
/**
 * DebiturModel: Interaksi dengan tabel 'debitur'.
 * Data master calon penerima kredit (Alternatif/Ai).
 * File ini berada di /app/models/DebiturModel.php
 */
class DebiturModel extends BaseModel {
    // Properti $table menentukan tabel mana yang digunakan Model ini di database
    protected $table = 'debitur'; 

    /**
     * Mengambil semua data debitur dari database.
     * @return array Data semua debitur.
     */
    public function getAll() {
        return parent::getAll(); 
    }

    /**
     * Mengambil data debitur berdasarkan ID.
     * @param int $id ID Debitur
     * @return array|false Data debitur tunggal atau false jika tidak ditemukan.
     */
    public function findById($id) {
        return parent::findById($id);
    }

    /**
     * Menghitung total jumlah debitur dalam tabel.
     * @return int Jumlah total debitur.
     */
    public function countAll() {
        return parent::countAll(); 
    }
    
    // CATATAN PENTING:
    // Method insert($data) secara otomatis diwarisi dari BaseModel.
    
        //Controller memanggil $this->debiturModel->insert($data_insert) yang mengeksekusi BaseModel::insert().
}
