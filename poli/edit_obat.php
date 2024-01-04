<?php
include("koneksi.php");

// Fungsi untuk mendapatkan data obat berdasarkan ID
function getObatById($id_obat) {
    global $mysqli;
    $result = $mysqli->query("SELECT * FROM obat WHERE id = $id_obat");
    return $result->fetch_assoc();
}

// Jika parameter id_obat tidak ada, kembalikan ke obat.php
if (!isset($_GET['id_obat'])) {
    header("Location: index.php?page=obat");
    exit();
}

// Ambil data obat berdasarkan ID
$id_obat = $_GET['id_obat'];
$obat_edit = getObatById($id_obat);

// Jika data obat tidak ditemukan, kembalikan ke obat.php
if (!$obat_edit) {
    header("Location: index.php?page=obat");
    exit();
}

// Proses edit obat
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_obat'])) {
    $id_obat_edit = $_POST['id_obat_edit'];
    $nama_obat_edit = $_POST['nama_obat_edit'];
    $kemasan_edit = $_POST['kemasan_edit'];
    $harga_edit = $_POST['harga_edit'];

    $query = "UPDATE obat SET nama_obat='$nama_obat_edit', kemasan='$kemasan_edit', harga=$harga_edit WHERE id=$id_obat_edit";

    if ($mysqli->query($query)) {
        echo "Obat berhasil diupdate.";
        // Kembalikan ke halaman obat.php setelah proses edit
        header("Location: index.php?page=obat");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . $mysqli->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit Obat</title>
</head>
<body>

<h2>Edit Obat</h2>

<!-- Form edit obat -->
<form method="POST">
    <input type="hidden" name="id_obat_edit" value="<?php echo $obat_edit['id']; ?>">
    <label>Nama Obat:</label>
    <input type="text" name="nama_obat_edit" value="<?php echo $obat_edit['nama_obat']; ?>" required><br><br>
    <label>Kemasan:</label>
    <input type="text" name="kemasan_edit" value="<?php echo $obat_edit['kemasan']; ?>" required><br><br>
    <label>Harga:</label>
    <input type="number" name="harga_edit" value="<?php echo $obat_edit['harga']; ?>" required><br><br>
    <input type="submit" name="edit_obat" value="Simpan Perubahan">
</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
