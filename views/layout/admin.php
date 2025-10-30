<?php
/**
 * File: /views/layout/admin.php
 * Layout Utama untuk Halaman Administrasi (Dashboard, Master Data, SPK).
 * Menggunakan Bootstrap 5 CDN.
 */
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?> | Dashboard</title>
    
    <!-- CDN Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <!-- CDN Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" xintegrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- Muat Custom CSS (Lokal) -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
    
    <style>
        /* CSS Kustom untuk Tata Letak Admin */
        #wrapper { 
            display: flex; /* Mengaktifkan Flexbox untuk Sidebar dan Content */
            min-height: 100vh;
        }
        
        /* Gaya Sidebar - Panel Kiri */
        .sidebar {
            flex: 0 0 250px; /* Lebar tetap 250px */
            background-color: #2c3e50; /* Warna dasar sidebar gelap */
            color: #ddd;
            position: sticky;
            top: 0;
            height: 100vh;
            padding: 0;
        }
        .sidebar .nav-item .nav-link {
            color: #ddd;
            padding: 12px 15px;
            display: block;
            transition: background-color 0.2s;
        }
        .sidebar .nav-item .nav-link:hover {
            background-color: #3e5e7e;
            color: white;
        }
        .sidebar-brand {
            padding: 20px 15px;
            font-size: 1.2rem;
            font-weight: bold;
            color: white;
            text-align: center;
            display: block;
            text-decoration: none;
            background-color: #1a293a; /* Warna header sidebar */
        }
        .sidebar-heading {
            color: #aebfd4;
            padding: 10px 15px 5px;
            font-size: 0.75rem;
            text-transform: uppercase;
        }

        /* Gaya Konten Utama - Panel Kanan */
        #content-wrapper { 
            flex-direction: column; 
            width: 100%;
            background-color: #f4f6f9; /* Latar belakang konten */
        }
        #content { 
            flex: 1 0 auto; /* Memastikan konten mengisi sisa ruang */
        } 
    </style>
</head>
<body id="page-top"> 
    <div id="wrapper">
        
        <?php 
        // 1. MEMUAT SIDEBAR (Sidebar akan menerima class 'sidebar' dari style di atas)
        require_once VIEW_PATH . '/layout/sidebar.php'; 
        ?>

        <div id="content-wrapper" class="d-flex flex-column">
            
            <div id="content">
                
                <?php 
                // 2. AKTIFKAN HEADER (Navigasi Atas)
                require_once VIEW_PATH . '/layout/header.php'; 
                ?>

                <div class="container-fluid pt-4">
                    
                    <!-- Notifikasi Flash Message -->
                    <?= Helper::flash('success') ?>
                    <?= Helper::flash('error') ?>
                    
                    <!-- Konten spesifik halaman (Dashboard/Master Data/dll.) -->
                    <?php 
                    if (isset($page_content)) {
                        require_once $page_content; 
                    }
                    ?>
                    
                </div>
            </div>

            <?php 
            // 3. MEMUAT FOOTER
            require_once VIEW_PATH . '/layout/footer.php'; 
            ?>
            
        </div>
    </div>
    
    <!-- Bootstrap JS (dibiarkan di akhir) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <!-- Custom JS -->
    <script src="<?= BASE_URL ?>/assets/js/script.js"></script>

</body>
</html>
