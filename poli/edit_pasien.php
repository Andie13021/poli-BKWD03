<?php
include("koneksi.php");

// Fungsi untuk mendapatkan data pasien berdasarkan ID
function getPasienById($id) {
    global $mysqli;

    $query = "SELECT * FROM pasien WHERE id = $id";
    $result = $mysqli->query($query);

    return $result->fetch_assoc();
}

// Proses form pengeditan pasien
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_ktp = $_POST['no_ktp'];
    $no_hp = $_POST['no_hp'];
    $no_rm = $_POST['no_rm'];

    $query = "UPDATE pasien 
              SET nama='$nama', alamat='$alamat', no_ktp='$no_ktp', no_hp='$no_hp', no_rm='$no_rm' 
              WHERE id = $id";

    if ($mysqli->query($query)) {
        echo "Pengeditan data pasien berhasil.";
    } else {
        echo "Error: " . $mysqli->error;
    }
}

// Mendapatkan ID pasien dari parameter URL
$id = $_GET['id'];
$pasien = getPasienById($id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit Pasien</title>
</head>
<body>

<div class="container mt-5">
    <h2>Edit Data Pasien</h2>

    <!-- Form Pengeditan Pasien -->
    <form method="POST" action="index.php?page=edit_pasien&id=<?php echo $pasien['id']; ?>">
        <input type="hidden" name="id" value="<?= $pasien['id']; ?>">
        
        <label>Nama:</label>
        <input type="text" name="nama" value="<?= $pasien['nama']; ?>" required><br><br>
        
        <label>Alamat:</label>
        <input type="text" name="alamat" value="<?= $pasien['alamat']; ?>" required><br><br>
        
        <label>No. KTP:</label>
        <input type="text" name="no_ktp" value="<?= $pasien['no_ktp']; ?>" required><br><br>
        
        <label>No. HP:</label>
        <input type="text" name="no_hp" value="<?= $pasien['no_hp']; ?>" required><br><br>
        
        <label>No. Rekam Medis:</label>
        <input type="text" name="no_rm" value="<?= $pasien['no_rm']; ?>" required><br><br>

        <input type="submit" value="Simpan Perubahan">
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
