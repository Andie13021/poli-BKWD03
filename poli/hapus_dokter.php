<?php
include("koneksi.php");

if (isset($_GET['id'])) {
    $id_dokter = $_GET['id'];

    // Prevent SQL Injection
    $id_dokter = $mysqli->real_escape_string($id_dokter);

    $query = "DELETE FROM dokter WHERE id = $id_dokter";

    if ($mysqli->query($query)) {
        header("Location: index.php?page=dokter");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . $mysqli->error;
    }
} else {
    echo "ID Dokter tidak valid.";
    exit();
}
?>
