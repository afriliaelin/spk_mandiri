<?php 
// Di sini Anda bisa menggunakan layout minimal jika mau
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>404 | Halaman Tidak Ditemukan</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/vendor/bootstrap/css/bootstrap.min.css">
</head>
<body class="text-center" style="padding-top: 100px;">
    <div class="container">
        <h1 class="display-1 text-danger">404</h1>
        <h2>Halaman Tidak Ditemukan</h2>
        <p class="lead">Maaf, halaman yang Anda cari tidak ada atau telah dipindahkan.</p>
        <a href="<?= BASE_URL ?>/dashboard" class="btn btn-primary">Kembali ke Dashboard</a>
    </div>
</body>
</html>