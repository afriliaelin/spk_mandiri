<?php
/**
 * Class Helper: Kumpulan Fungsi Bantuan (Utility Functions).
 */
class Helper {

    /**
     * Mencetak variabel dalam format yang mudah dibaca dan menghentikan eksekusi.
     * Berguna untuk debugging.
     * @param mixed $data Variabel yang ingin dicetak.
     */
    public static function dd($data) {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
        die;
    }

    /**
     * Mengambil nilai dari array POST dengan nilai default jika tidak ada.
     * @param string $key Kunci yang dicari.
     * @param mixed $default Nilai default jika kunci tidak ditemukan.
     * @return mixed Nilai POST atau default.
     */
    public static function post($key, $default = null) {
        return $_POST[$key] ?? $default;
    }

    /**
     * Menampilkan pesan flash (notifikasi).
     * @param string $key Kunci session ('success' atau 'error').
     * @return string HTML alert bootstrap (Contoh).
     */
    public static function flash($key = 'success') {
        if (isset($_SESSION[$key])) {
            $message = $_SESSION[$key];
            unset($_SESSION[$key]); // Hapus pesan setelah ditampilkan
            
            $class = ($key === 'success') ? 'alert-success' : 'alert-danger';
            
            return "<div class='alert {$class} alert-dismissible fade show' role='alert'>
                        {$message}
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
        }
        return '';
    }
}