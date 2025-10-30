<?php
// File sementara untuk membuat hash password
$password_teks_biasa = 'admin123';
$hash_password = password_hash($password_teks_biasa, PASSWORD_DEFAULT);

echo "Hash untuk 'admin123': <br>";
echo "<strong>" . $hash_password . "</strong><br><br>";
echo "Salin hash di atas dan masukkan ke tabel 'users' di phpMyAdmin.";
?>