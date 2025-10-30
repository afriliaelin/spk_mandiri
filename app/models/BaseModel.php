<?php
/**
 * BaseModel: Kelas Dasar untuk semua Model.
 * Mengelola Koneksi Database (PDO) dan menyediakan fungsi dasar CRUD (Create, Read, Update, Delete).
 */

// Pastikan konfigurasi database sudah dimuat (APP_PATH dari init.php)
require_once APP_PATH . '/config/database.php'; 

class BaseModel {
    protected $db;       // Objek koneksi PDO
    protected $table;    // Nama tabel yang terkait

    public function __construct() {
        try {
            // Membuat koneksi PDO
            $this->db = new PDO(
                DB_DSN, 
                DB_USER, 
                DB_PASS,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, 
                ]
            );
        } catch (PDOException $e) {
            // Hentikan proses jika koneksi gagal
            die("FATAL ERROR KONEKSI DATABASE: Cek file /app/config/database.php dan status server Anda! Pesan: " . $e->getMessage());
        }
    }

    /**
     * Menjalankan query SQL dengan binding parameter.
     * @param string $sql Query SQL yang akan dieksekusi.
     * @param array $params Parameter yang akan di-binding.
     * @return PDOStatement Objek statement.
     */
    protected function query($sql, $params = []) {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
    
    // --- FUNGSI CRUD DASAR (SEKARANG PUBLIC UNTUK PEWARISAN) ---

    /**
     * Mengambil semua data dari tabel.
     * @return array Hasil data.
     */
    public function getAll() { // Diperbaiki: PUBLIC
        $sql = "SELECT * FROM {$this->table}";
        return $this->query($sql)->fetchAll();
    }

    /**
     * Mengambil data berdasarkan ID.
     * @param int $id ID data.
     * @return array Data tunggal.
     */
    public function findById($id) { // Diperbaiki: PUBLIC
        // Menggunakan id_{nama_tabel} sesuai konvensi yang kita tetapkan
        $sql = "SELECT * FROM {$this->table} WHERE id_{$this->table} = ?"; 
        $stmt = $this->query($sql, [$id]);
        return $stmt->fetch();
    }
    
    /**
     * Menyimpan data baru (INSERT).
     * @param array $data Data yang akan di-insert (kolom => nilai).
     * @return bool True jika berhasil, False jika gagal.
     */
    public function insert(array $data): boo { // Diperbaiki: PUBLIC
        if (empty($data)) return false;

        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));
        $values = array_values($data);
        $sql = "INSERT INTO {$this->table} ({$columns}) VALUES ({$placeholders})";
        
        try {
            $stmt = $this->db->prepare($sql);
            return $stmt->execute($values); 
        } catch (PDOException $e) {
            // AKTIFKAN DEBUGGING SEMENTARA UNTUK MELIHAT PESAN ERROR MYSQL
            echo "<h2 style='color:red;'>FATAL DEBUG: INSERT GAGAL!</h2>";
            echo "<p><strong>Table:</strong> {$this->table}</p>";
            echo "<p><strong>Query:</strong> " . $sql . "</p>";
            echo "<p><strong>Values:</strong> " . print_r($values, true) . "</p>";
            echo "<p><strong>MySQL Error:</strong> " . $e->getMessage() . "</p>";
            die(); // Hentikan proses untuk menampilkan error
        }
    }

    /**
     * Mengubah data (UPDATE).
     * @param int $id ID data yang akan di-update.
     * @param array $data Data baru (kolom => nilai).
     * @return bool True jika berhasil.
     */
    public function update($id, $data) { // Diperbaiki: PUBLIC
        if (empty($data)) return false;

        $set_parts = [];
        foreach (array_keys($data) as $col) {
            $set_parts[] = "{$col} = ?";
        }
        $set_clause = implode(', ', $set_parts);
        
        $values = array_values($data);
        $values[] = $id; 

        $sql = "UPDATE {$this->table} SET {$set_clause} WHERE id_{$this->table} = ?";
        
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute($values);
            return $stmt->rowCount() > 0; // Mengembalikan true jika ada baris yang terpengaruh
        } catch (PDOException $e) {
            return false;
        }
    }
    
    /**
     * Menghapus data (DELETE).
     * @param int $id ID data yang akan dihapus.
     * @return bool True jika berhasil.
     */
    public function delete($id) { // Diperbaiki: PUBLIC
        $sql = "DELETE FROM {$this->table} WHERE id_{$this->table} = ?";
        
        try {
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([$id]); 
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Menghitung total baris.
     * @return int Jumlah total baris.
     */
    public function countAll() { // Diperbaiki: PUBLIC
        $sql = "SELECT COUNT(*) AS total FROM {$this->table}";
        return $this->query($sql)->fetch()['total'] ?? 0;
    }
    
    /**
     * Mengambil ID terakhir yang dimasukkan (Berguna setelah INSERT).
     * @return string ID terakhir.
     */
    public function lastInsertId() {
        return $this->db->lastInsertId();
    }
}