<?php
/**
 * File: /views/front/landing_page.php
 * Halaman depan aplikasi SPK Debitur Mikro Bank Mandiri Cabang Galang Kota
 * dengan background foto Bank Mandiri yang profesional dan jelas
 */
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?> | Selamat Datang</title>

    <!-- Bootstrap & Font -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            color: #fff;
            margin: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        /* ===== HERO SECTION ===== */
        .hero-section {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 80px 20px;
            position: relative;
            background: url('<?= BASE_URL ?>/assets/img/bank.jpg') center center/cover no-repeat;
        }

        /* Overlay biru lebih transparan agar gambar lebih kelihatan */
        .hero-section::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(13, 71, 161, 0.65), rgba(25, 118, 210, 0.55));
            z-index: 0;
        }

        .card-landing {
            background: rgba(255, 255, 255, 0.10);
            backdrop-filter: blur(18px);
            color: #ffffff;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.25);
            padding: 60px 50px;
            text-align: center;
            max-width: 820px;
            width: 100%;
            position: relative;
            z-index: 1;
            animation: fadeInUp 1s ease-in-out;
        }

        .logo-mandiri {
            width: 160px;
            margin-bottom: 25px;
            filter: drop-shadow(2px 2px 4px rgba(0,0,0,0.4));
        }

        .card-landing h1 {
            font-weight: 700;
            color: #fff;
            font-size: 2.2rem;
            margin-bottom: 12px;
        }

        .card-landing p {
            color: #eaf1fc;
            font-size: 1.05rem;
            margin: 1rem 0 2rem;
            line-height: 1.6;
        }

        .btn-masuk {
            background: linear-gradient(90deg, #ffca28, #ffb300);
            color: #0d47a1;
            font-weight: 600;
            border-radius: 10px;
            padding: 12px 32px;
            transition: all 0.3s ease;
            font-size: 1rem;
            border: none;
        }

        .btn-masuk:hover {
            background: linear-gradient(90deg, #ffb300, #ffa000);
            transform: translateY(-2px);
            box-shadow: 0 5px 12px rgba(0,0,0,0.25);
        }

        /* ===== INFO SECTION ===== */
        .info-section {
            background: #f5f7fa;
            color: #173f73;
            padding: 50px 20px;
            text-align: center;
            border-top: 5px solid #0d47a1;
        }

        .info-section h5 {
            font-weight: 700;
            margin-bottom: 15px;
        }

        .info-section p {
            color: #4e5d7a;
            font-size: 1rem;
            max-width: 720px;
            margin: 0 auto;
            line-height: 1.7;
        }

        /* ===== FOOTER ===== */
        footer {
            background: #0d47a1;
            color: #eee;
            text-align: center;
            padding: 18px;
            font-size: 0.95rem;
            letter-spacing: 0.3px;
        }

        footer a {
            color: #ffca28;
            text-decoration: none;
            font-weight: 600;
        }

        footer a:hover {
            text-decoration: underline;
        }

        /* ===== Animasi ===== */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsif */
        @media (max-width: 768px) {
            .card-landing {
                padding: 40px 25px;
            }
            .card-landing h1 {
                font-size: 1.6rem;
            }
            .btn-masuk {
                width: 100%;
            }
        }
    </style>
</head>
<body>

    <!-- HERO SECTION -->
    <section class="hero-section">
        <div class="card-landing">
            <img src="<?= BASE_URL ?>/assets/img/logo-mandiri.png" alt="Logo Bank Mandiri" class="logo-mandiri">
            <h1>Selamat Datang di SPK Debitur Mikro</h1>
            <p>
                Sistem Pendukung Keputusan Penentuan Debitur Terbaik (Feasible) pada 
                <b>PT Bank Mandiri Tbk. Cabang Galang Kota</b> menggunakan metode 
                <b>Simple Additive Weighting (SAW)</b>.
            </p>
            <a href="<?= BASE_URL ?>/login" class="btn btn-masuk shadow">
                <i class="fas fa-sign-in-alt me-2"></i> Masuk ke Sistem
            </a>
        </div>
    </section>

    <!-- INFO SECTION -->
    <section class="info-section">
        <h5><i class="fas fa-info-circle me-2 text-primary"></i> Tentang Aplikasi</h5>
        <p>
            Aplikasi ini dirancang untuk membantu proses analisis dan pengambilan keputusan 
            kredit mikro secara <b>objektif, cepat, dan efisien</b>. Dengan penerapan metode SAW, 
            sistem mampu memberikan rekomendasi <b>calon debitur terbaik</b> berdasarkan 
            kriteria yang telah ditetapkan oleh pihak Bank Mandiri.
        </p>
    </section>

    <!-- FOOTER -->
    <footer>
        © <?= date('Y') ?> <b>SPK Debitur Mikro</b> – PT Bank Mandiri Tbk. Cabang Galang Kota | 
        Dikembangkan oleh <a href="#">Tim IT STMIK Pelita Nusantara</a>
    </footer>

    <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
