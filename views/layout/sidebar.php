<?php
// Pastikan Auth::user('level') sudah tersedia
$user_level = Auth::user('level');
?>
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= BASE_URL ?>/dashboard">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-hand-holding-usd"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SPK MANDIRI</div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item active">
        <a class="nav-link" href="<?= BASE_URL ?>/dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Manajemen Data
    </div>

    <?php if ($user_level == 'admin'): ?>
    <li class="nav-item">
        <a class="nav-link" href="<?= BASE_URL ?>/debitur">
            <i class="fas fa-fw fa-users"></i>
            <span>Data Debitur</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="<?= BASE_URL ?>/kriteria">
            <i class="fas fa-fw fa-cogs"></i>
            <span>Kriteria & Bobot</span></a>
    </li>
    
    <li class="nav-item">
        <a class="nav-link" href="<?= BASE_URL ?>/penilaian">
            <i class="fas fa-fw fa-edit"></i>
            <span>Input Penilaian</span></a>
    </li>
    <?php endif; ?>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Sistem Pendukung Keputusan
    </div>

    <li class="nav-item">
        <a class="nav-link" href="<?= BASE_URL ?>/saw/proses">
            <i class="fas fa-fw fa-calculator"></i>
            <span>Proses SAW</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="<?= BASE_URL ?>/saw/hasil">
            <i class="fas fa-fw fa-chart-line"></i>
            <span>Hasil & Ranking</span></a>
    </li>
    
    <?php if ($user_level == 'manager'): ?>
    <li class="nav-item">
        <a class="nav-link" href="<?= BASE_URL ?>/laporan">
            <i class="fas fa-fw fa-file-pdf"></i>
            <span>Laporan (Audit)</span></a>
    </li>
    <?php endif; ?>

    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle" onclick="document.body.classList.toggle('sidebar-toggled')">
            <i class="fas fa-angle-left"></i>
        </button>
    </div>

</ul>