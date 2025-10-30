<?php
/**
 * Class Validator: Untuk validasi data input (server-side validation).
 */
class Validator {
    
    protected $data;
    protected $errors = [];

    public function __construct($data) {
        $this->data = $data;
    }

    /**
     * Memulai proses validasi berdasarkan aturan yang diberikan.
     * @param array $rules Aturan validasi (e.g., ['nama' => 'required|max:150']).
     * @return bool True jika validasi berhasil, False jika ada error.
     */
    public function validate($rules) {
        $this->errors = [];
        foreach ($rules as $field => $rule_string) {
            $rules_array = explode('|', $rule_string);
            foreach ($rules_array as $rule) {
                $this->applyRule($field, $rule);
            }
        }
        return empty($this->errors);
    }

    /**
     * Menerapkan satu aturan validasi.
     */
    protected function applyRule($field, $rule) {
        $value = $this->data[$field] ?? null;
        
        if ($rule === 'required' && empty($value)) {
            $this->addError($field, "Bidang {$field} wajib diisi.");
        }
        
        // Contoh aturan 'numeric'
        if ($rule === 'numeric' && !is_numeric($value)) {
            $this->addError($field, "Bidang {$field} harus berupa angka.");
        }
        
        // Contoh aturan 'max:length'
        if (strpos($rule, 'max:') === 0) {
            $max = (int) explode(':', $rule)[1];
            if (strlen($value) > $max) {
                $this->addError($field, "Bidang {$field} tidak boleh lebih dari {$max} karakter.");
            }
        }
        // ... (Tambahkan aturan lain seperti 'min', 'email', 'unique', dll.)
    }

    /**
     * Menambahkan pesan error.
     */
    protected function addError($field, $message) {
        if (!isset($this->errors[$field])) {
            $this->errors[$field] = $message;
        }
    }

    /**
     * Mengambil semua pesan error.
     * @return array Pesan error.
     */
    public function getErrors() {
        return $this->errors;
    }
}