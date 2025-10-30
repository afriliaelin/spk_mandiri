<?php
/**
 * File: /views/layout/header.php
 * Topbar Navigasi Admin.
 * FINAL FIX: Menghilangkan Warning "Array to string conversion"
 * dan merapikan tampilan header.
 */

// Ambil data user dengan aman dan pastikan selalu berupa string
$userData = Auth::user() ?? [];
$nama_user = isset($userData['nama_lengkap']) ? (string) $userData['nama_lengkap'] : 'Pengguna';
$level_user = isset($userData['level']) ? (string) $userData['level'] : 'guest';
?>

<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Nama Aplikasi (tampil di mode mobile) -->
    <a class="navbar-brand d-md-none fw-bold text-primary" href="<?= BASE_URL ?>/dashboard">
        SPK MANDIRI
    </a>
    
    <!-- Tombol Toggle Sidebar (hanya untuk tampilan mobile) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle me-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ms-auto">

        <!-- Informasi User -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown"
               role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               
                <span class="me-2 d-none d-lg-inline text-gray-600 small">
                    Halo, <b><?= htmlspecialchars($nama_user) ?></b> (<?= ucfirst(htmlspecialchars($level_user)) ?>)
                </span>
                <i class="fas fa-user-circle fa-2x text-secondary"></i>
            </a>

            <!-- Dropdown User -->
            <div class="dropdown-menu dropdown-menu-end shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                    <i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>
                    Profil
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-danger" href="<?= BASE_URL ?>/logout">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>

    </ul>

</nav>
<!-- End of Topbar -->
