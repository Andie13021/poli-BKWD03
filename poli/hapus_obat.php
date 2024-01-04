<?php
include("koneksi.php");

// Hapus obat dari database
if (isset($_GET['id_obat'])) {
    $id_obat = $_GET['id_obat'];

    $query = "DELETE FROM obat WHERE id = $id_obat";

    if ($mysqli->query($query)) {
        echo "Obat berhasil dihapus.";
        // Kembalikan ke halaman obat.php setelah proses hapus
        header("Location: index.php?page=obat");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . $mysqli->error;
    }
}
?>
