<?php
/**
 * File: /views/dashboard/index.php
 * Dashboard Profesional SPK Bank Mandiri
 * By: Afrilia Elin ✨
 */
?>

<style>
/* ===== Tema Warna Mandiri Premium ===== */
:root {
    --mandiri-blue: #003399;
    --mandiri-yellow: #FFD100;
    --mandiri-light: #f7f9fc;
    --mandiri-dark: #1b1b2f;
}

body {
    background-color: var(--mandiri-light);
    font-family: "Poppins", "Nunito", sans-serif;
}

/* ===== Heading Dashboard ===== */
.dashboard-header {
    background: linear-gradient(90deg, var(--mandiri-blue), #0055cc);
    color: white;
    padding: 1.5rem;
    border-radius: 1rem;
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.dashboard-header h1 {
    font-weight: 700;
    font-size: 1.5rem;
    margin: 0;
}
.dashboard-header .btn-warning {
    font-weight: 600;
    background-color: var(--mandiri-yellow);
    border: none;
    color: var(--mandiri-dark);
    transition: 0.3s ease;
}
.dashboard-header .btn-warning:hover {
    background-color: #f4c400;
}

/* ====== Card Statistik ====== */
.card {
    border-radius: 1rem;
    transition: all 0.25s ease-in-out;
}
.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 0.75rem 1rem rgba(0, 0, 0, 0.15);
}

/* Garis Kiri Kartu */
.border-left-primary {
    border-left: 0.4rem solid var(--mandiri-blue) !important;
}
.border-left-success {
    border-left: 0.4rem solid #1cc88a !important;
}
.border-left-info {
    border-left: 0.4rem solid #36b9cc !important;
}
.border-left-warning {
    border-left: 0.4rem solid var(--mandiri-yellow) !important;
}

/* ===== Card Header ===== */
.card-header {
    background-color: var(--mandiri-blue);
    color: white;
    border-top-left-radius: 1rem;
    border-top-right-radius: 1rem;
}
.card-body {
    background: white;
}

/* ===== Text Styling ===== */
.text-primary {
    color: var(--mandiri-blue) !important;
}
.text-warning {
    color: var(--mandiri-yellow) !important;
}
h6.m-0 {
    font-weight: 600;
}
</style>

<!-- Header Dashboard -->
<div class="dashboard-header mb-4">
    <h1>📊 Dashboard Sistem Pendukung Keputusan</h1>
    <a href="<?= BASE_URL ?>/saw/proses" class="btn btn-warning shadow-sm">
        <i class="fas fa-calculator fa-sm"></i> Proses Ulang SAW
    </a>
</div>

<!-- Statistik Ringkasan -->
<div class="row">

    <!-- Card 1 -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-3 px-2">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="text-xs fw-bold text-primary text-uppercase mb-1">
                            Total Calon Debitur
                        </div>
                        <div class="h5 mb-0 fw-bold text-dark">
                            <?= number_format($total_debitur) ?> Debitur
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-400"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card 2 -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-3 px-2">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="text-xs fw-bold text-success text-uppercase mb-1">
                            Jumlah Kriteria
                        </div>
                        <div class="h5 mb-0 fw-bold text-dark">
                            <?= number_format($total_kriteria) ?> Kriteria
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-list-alt fa-2x text-gray-400"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card 3 -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-3 px-2">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="text-xs fw-bold text-info text-uppercase mb-1">
                            Debitur Terbaik (Rank 1)
                        </div>
                        <div class="h5 mb-0 fw-bold text-dark">
                            <?= $debitur_terbaik['nama'] ?? 'Belum Diproses' ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-trophy fa-2x text-gray-400"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card 4 -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-3 px-2">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="text-xs fw-bold text-warning text-uppercase mb-1">
                            Nilai SAW Tertinggi (V<sub>i</sub>)
                        </div>
                        <div class="h5 mb-0 fw-bold text-dark">
                            <?= number_format($debitur_terbaik['nilai'] ?? 0, 4) ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-percent fa-2x text-gray-400"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Info Tambahan -->
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 fw-bold">Informasi Proses SPK</h6>
            </div>
            <div class="card-body">
                <p>
                    Sistem ini menggunakan metode <strong>Simple Additive Weighting (SAW)</strong> 
                    untuk menentukan ranking kelayakan debitur. Pastikan data kriteria dan penilaian 
                    selalu diperbarui agar hasil perhitungan lebih akurat dan relevan.
                </p>
                <a href="<?= BASE_URL ?>/penilaian" class="btn btn-primary">
                    <i class="fas fa-eye"></i> Lihat Daftar Penilaian
                </a>
            </div>
        </div>
    </div>
</div>
