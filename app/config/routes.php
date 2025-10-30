<?php
/**
 * Konfigurasi Routing Sederhana
 */
$routes = [
    // PERBAIKAN UTAMA: Root path ('') harus diarahkan ke Login

 '' => ['Front', 'index'],     // Root path yang di-trim akan diarahkan ke Login
    
    // Rute Otentikasi
    'login' => ['Auth', 'index'],   
    'do_login' => ['Auth', 'login'],
    'logout' => ['Auth', 'logout'], 

    // Rute Dashboard 
    'dashboard' => ['Dashboard', 'index'],

    // Rute Master Data Debitur (Menggunakan pola /debitur/id)
    'debitur' => ['Debitur', 'index'], 
    'debitur/tambah' => ['Debitur', 'create'], 
    'debitur/edit' => ['Debitur', 'edit'],       
    'debitur/delete' => ['Debitur', 'delete'],   

    // Rute Master Kriteria
    'kriteria' => ['Master', 'kriteriaIndex'], 
    'kriteria/update' => ['Master', 'updateKriteria'], 

    // Rute Penilaian
    'penilaian' => ['Penilaian', 'index'], 
    'penilaian/input' => ['Penilaian', 'inputSkor'], 

    // Rute SPK SAW
    'saw/proses' => ['Saw', 'prosesPerhitungan'], 
    'saw/hasil' => ['Saw', 'hasilIndex'],        
    'saw/audit' => ['Saw', 'detailProses'],      

    // Rute Laporan
    'laporan' => ['Laporan', 'index'],
    
    // Default Route untuk Error 404 
    '404' => ['Error', 'notFound'] 
];