<?php
include("koneksi.php");

if (isset($_GET['id'])) {
    $id_riwayat = $_GET['id'];

    $query = "DELETE FROM periksa WHERE id = $id_riwayat";

    if ($mysqli->query($query)) {
        header("Location: index.php?page=riwayat_pasien");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . $mysqli->error;
    }
} else {
    echo "ID Riwayat tidak valid.";
}
?>
