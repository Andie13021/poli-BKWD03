<?php
include("koneksi.php");

// Fungsi untuk mendapatkan data poli berdasarkan ID
function getPoliById($id) {
    global $mysqli;

    $query = "SELECT * FROM poli WHERE id = $id";
    $result = $mysqli->query($query);

    return $result->fetch_assoc();
}

// Proses form pengeditan poli
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nama_poli = $_POST['nama_poli'];
    $keterangan = $_POST['keterangan'];

    $query = "UPDATE poli 
              SET nama_poli='$nama_poli', keterangan='$keterangan'
              WHERE id = $id";

    if ($mysqli->query($query)) {
        echo "Pengeditan data poli berhasil.";
    } else {
        echo "Error: " . $mysqli->error;
    }
}

// Mendapatkan ID poli dari parameter URL
$id = $_GET['id'];
$poli = getPoliById($id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit Poli</title>
</head>
<body>

<div class="container mt-5">
    <h2>Edit Data Poli</h2>

    <!-- Form Pengeditan Poli -->
    <form method="POST" action="index.php?page=edit_poli&id=<?php echo $poli['id']; ?>"> <!-- Modifikasi action formulir -->
        <input type="hidden" name="id" value="<?= $poli['id']; ?>">
        
        <label>Nama Poli:</label>
        <input type="text" name="nama_poli" value="<?= $poli['nama_poli']; ?>" required><br><br>
        
        <label>Keterangan:</label>
        <textarea name="keterangan" required><?= $poli['keterangan']; ?></textarea><br><br>

        <input type="submit" value="Simpan Perubahan">
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
