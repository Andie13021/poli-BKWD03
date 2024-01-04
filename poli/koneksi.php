<?php
$host = "localhost";
$user = "root"; // Sesuaikan jika berbeda
$pass = ""; // Sesuaikan jika berbeda
$db = "poli";
$mysqli = new mysqli($host, $user, $pass, $db);

// Cek koneksi
if ($mysqli->connect_error) {
    die("Koneksi Gagal: " . $mysqli->connect_error);
}
?>
