<?php
include("koneksi.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM dokter WHERE id=$id";

    if ($mysqli->query($query)) {
        header("Location: dokter.php");
    } else {
        echo "Error: " . $query . "<br>" . $mysqli->error;
    }
} else {
    header("Location: dokter.php");
}
?>
