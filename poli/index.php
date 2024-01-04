<?php
include("koneksi.php");

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Poliklinik</title>
    <style>
        body {
            padding-top: 30px;
            padding-bottom: 30px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Poliklinik</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <?php
                if (isset($_SESSION['username'])) {
                    // Tampilkan menu berdasarkan peran (Admin atau User)
                    if ($_SESSION['role'] == 'admin') {
                        echo '<li class="nav-item"><a class="nav-link" href="index.php?page=obat">Obat</a></li>';
                    } elseif ($_SESSION['role'] == 'user') {
                        echo '<li class="nav-item"><a class="nav-link" href="index.php?page=periksa">Periksa</a></li>';
                        echo '<li class="nav-item"><a class="nav-link" href="index.php?page=riwayat_pasien">Riwayat Pasien</a></li>';
                        echo '<li class="nav-item"><a class="nav-link" href="index.php?page=pasien">Pasien</a></li>';
                        echo '<li class="nav-item"><a class="nav-link" href="index.php?page=poli">Poli</a></li>';
                        echo '<li class="nav-item"><a class="nav-link" href="index.php?page=dokter">Dokter</a></li>'; // Tambahkan baris ini
                    }

                    echo '<li class="nav-item"><a class="nav-link" href="index.php?page=logout">Logout</a></li>';
                } else {
                    echo '<li class="nav-item"><a class="nav-link" href="index.php?page=login">Login</a></li>';
                    echo '<li class="nav-item"><a class="nav-link" href="index.php?page=register">Register</a></li>';
                }
                ?>
            </ul>
        </div>
    </div>
</nav>

<main class="container mt-5">
    <?php
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
        echo "<h2>$page</h2>";
        include("$page.php");
    } else {
        echo "<h2 class='text-center'>Selamat Datang di Sistem Informasi Poliklinik</h2>";
        echo "<div id='carouselExampleSlidesOnly' class='carousel slide mt-5' data-bs-ride='carousel'>
            <div class='carousel-inner'>
                <div class='carousel-item active'>
                    <img src='200.jpg' class='d-block w-50' alt='...'>
                </div>
                <div class='carousel-item'>
                    <img src='200.jpg' class='d-block w-50' alt='...'>
                </div>
                <div class='carousel-item'>
                    <img src='200.jpg' class='d-block w-50' alt='...'>
                </div>
            </div>
        </div>";
    }
    ?>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
