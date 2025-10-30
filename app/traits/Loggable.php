<?php
/**
 * Trait Loggable: Menyediakan fungsi untuk mencatat pesan log.
 * Trait ini dapat diimpor (use) ke Controller atau Model manapun
 * untuk mencatat error atau aktivitas penting ke file log.
 */
trait Loggable {

    /**
     * Metode untuk mencatat pesan ke file log.
     * @param string $message Pesan yang akan dicatat.
     * @param string $level Tingkat log (ERROR, INFO, WARNING).
     */
    protected function log($message, $level = 'INFO') {
        // Asumsikan konstanta ROOT_PATH sudah didefinisikan di constants.php
        
        // Tentukan path lengkap file log
        $log_file = ROOT_PATH . '/storage/logs/error.log';
        
        // Format waktu dan tanggal
        $timestamp = date('Y-m-d H:i:s');
        
        // Format baris log: [Waktu] [Level] Pesan
        $log_entry = "[{$timestamp}] [{$level}] " . $message . PHP_EOL;
        
        // Tulis log ke file
        // FILE_APPEND memastikan pesan ditambahkan ke akhir file
        // LOCK_EX memastikan file terkunci saat ditulis (penting untuk konkurensi)
        $result = file_put_contents($log_file, $log_entry, FILE_APPEND | LOCK_EX);

        // Opsional: Jika log gagal, tampilkan error (hanya saat development)
        // if ($result === false) {
        //     error_log("Gagal menulis log ke file: {$log_file}");
        // }
    }

    /**
     * Alias untuk mencatat pesan ERROR.
     * @param string $message Pesan error.
     */
    protected function logError($message) {
        $this->log($message, 'ERROR');
    }

    /**
     * Alias untuk mencatat pesan INFO.
     * @param string $message Pesan informasi.
     */
    protected function logInfo($message) {
        $this->log($message, 'INFO');
    }
}