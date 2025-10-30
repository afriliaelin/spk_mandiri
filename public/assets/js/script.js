/**
 * script.js: Skrip JavaScript Kustom
 * Memuat fungsi-fungsi yang memerlukan interaksi di sisi klien.
 */

$(document).ready(function() {
    
    // --- FUNGSI UMUM ---
    
    // Auto-hide alert setelah 5 detik
    $(".alert-dismissible").fadeTo(5000, 500).slideUp(500, function(){
        $(".alert-dismissible").alert('close');
    });

    // --- FUNGSI KHUSUS SPK ---
    
    // Contoh: Konfirmasi sebelum proses ulang SAW
    $('.btn-warning.btn-sm[href*="/saw/proses"]').on('click', function(e) {
        if (!confirm('Anda akan memproses ulang perhitungan SAW. Data hasil sebelumnya akan ditimpa. Lanjutkan?')) {
            e.preventDefault();
        }
    });

    // Contoh: Inisialisasi DataTable (jika Anda menggunakan library DataTable di folder vendor)
    /*
    if ($.fn.DataTable) {
        $('#dataTable').DataTable();
    }
    */
});