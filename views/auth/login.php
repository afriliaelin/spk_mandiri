<?php
/**
 * File: /views/layout/auth.php
 * Layout login modern SPK Debitur Mikro Bank Mandiri Galang Kota
 * Dirancang profesional dan responsif
 */
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?> | Login</title>

    <!-- Font & Library -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f6f9;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .main-container {
            display: flex;
            width: 90%;
            max-width: 1100px;
            border-radius: 15px;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        }

        /* Panel kiri (informasi) */
        .left-panel {
            flex: 1;
            background: #2e5aac;
            color: white;
            padding: 3rem 2.5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            border-top-left-radius: 15px;
            border-bottom-left-radius: 15px;
        }

        .left-panel i {
            font-size: 4rem;
            margin-bottom: 1.5rem;
        }

        .left-panel h1 {
            font-weight: 700;
            font-size: 1.9rem;
            line-height: 1.3;
        }

        .left-panel p.lead {
            font-size: 1rem;
            margin-top: 1rem;
            line-height: 1.6;
            opacity: 0.95;
        }

        .left-panel p.footer {
            margin-top: 2.5rem;
            font-size: 0.9rem;
            color: #ffd54f;
        }

        /* Panel kanan (form login) */
        .right-panel {
            flex: 1;
            padding: 3rem 4rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background-color: #fff;
        }

        .right-panel .text-center i {
            font-size: 3.5rem;
            color: #2e5aac;
        }

        .right-panel h3 {
            font-weight: 700;
            color: #2e2e2e;
        }

        .form-label {
            font-weight: 600;
        }

        .form-control {
            border-radius: 10px;
            padding: 0.8rem;
        }

        .btn-login {
            background-color: #2e5aac;
            color: #fff;
            font-weight: 600;
            border-radius: 10px;
            padding: 0.8rem;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background-color: #1e3f84;
        }

        .copyright {
            text-align: center;
            margin-top: 2rem;
            font-size: 0.9rem;
            color: #777;
        }

        /* Responsif */
        @media (max-width: 992px) {
            .main-container {
                flex-direction: column;
                height: auto;
                box-shadow: none;
            }

            .left-panel {
                border-radius: 0;
                text-align: center;
                align-items: center;
            }

            .right-panel {
                padding: 2rem;
            }
        }
    </style>
</head>

<body>
    <div class="main-container">
        <!-- Panel kiri -->
        <div class="left-panel">
            <i class="fas fa-university"></i>
            <h1>Sistem Pendukung Keputusan<br>Debitur Mikro</h1>
            <p class="lead">
                Sistem ini dirancang untuk mendukung pengambilan keputusan yang transparan 
                dan akuntabel dalam penetapan debitur terbaik (feasible) untuk unit mikro 
                Bank Mandiri Galang Kota.
            </p>
            <p class="footer">Dikelola oleh <strong>PT Bank Mandiri Tbk. Cabang Galang Kota</strong></p>
        </div>

        <!-- Panel kanan -->
        <div class="right-panel">
            <div class="text-center mb-4">
                <i class="fas fa-user-circle"></i>
                <h3 class="mt-3">Masuk ke Sistem</h3>
            </div>

            <?= Helper::flash('success') ?>
            <?= Helper::flash('error') ?>

            <form action="<?= BASE_URL ?>/do_login" method="POST">
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" placeholder="Masukkan Username" required>
                </div>

                <div class="mb-4">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Masukkan Password" required>
                </div>

                <button type="submit" class="btn btn-login w-100">
                    <i class="fas fa-sign-in-alt me-2"></i> Masuk
                </button>
            </form>

            <div class="copyright">
                © <?= date('Y') ?> SPK Debitur Mikro Bank Mandiri Galang Kota
            </div>
        </div>
    </div>

    <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
