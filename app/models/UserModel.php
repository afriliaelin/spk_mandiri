<?php
/**
 * UserModel: Interaksi dengan tabel 'users'.
 * Digunakan untuk login dan manajemen hak akses.
 */
class UserModel extends BaseModel {
    protected $table = 'users';

    /**
     * Mencari pengguna berdasarkan username untuk proses login.
     * @param string $username Username yang dicari.
     * @return array Data pengguna atau false jika tidak ditemukan.
     */
    public function findByUsername($username) {
        $sql = "SELECT * FROM {$this->table} WHERE username = ?";
        $stmt = $this->query($sql, [$username]);
        return $stmt->fetch();
    }
}