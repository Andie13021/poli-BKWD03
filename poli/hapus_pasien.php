<?php
include("koneksi.php");

// Fungsi untuk mendapatkan data pasien berdasarkan ID
function getPasienById($id) {
    global $mysqli;

    $query = "SELECT * FROM pasien WHERE id = $id";
    $result = $mysqli->query($query);

    return $result->fetch_assoc();
}

// Proses penghapusan data pasien
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Mendapatkan data pasien sebelum dihapus (opsional, bisa dihapus jika tidak diperlukan)
    $pasien = getPasienById($id);

    // Query untuk menghapus data pasien
    $query = "DELETE FROM pasien WHERE id = $id";

    if ($mysqli->query($query)) {
        echo "Data pasien berhasil dihapus.";
    } else {
        echo "Error: " . $mysqli->error;
    }
} else {
    echo "ID pasien tidak valid.";
}

echo '<br><br><a href="index.php?page=hapus_pasien">Kembali ke Data Pasien</a>';
?>
