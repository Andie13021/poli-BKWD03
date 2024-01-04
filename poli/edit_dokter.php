<?php
include("koneksi.php");

// Fungsi untuk mendapatkan data dokter berdasarkan ID
function getDokterById($mysqli, $id_dokter) {
    $result = $mysqli->query("SELECT * FROM dokter WHERE id=$id_dokter");

    if ($result->num_rows == 1) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_dokter'])) {
    $id_dokter = $_POST['id_dokter'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];
    $id_poli = $_POST['id_poli'];

    $query = "UPDATE dokter SET nama='$nama', alamat='$alamat', no_hp='$no_hp', id_poli=$id_poli WHERE id=$id_dokter";

    if ($mysqli->query($query)) {
        header("Location: index.php?page=dokter");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . $mysqli->error;
    }
}

// Ambil data dokter dari database
if (isset($_GET['id'])) {
    $id_dokter = $_GET['id'];
    $dokter = getDokterById($mysqli, $id_dokter);

    if (!$dokter) {
        echo "Dokter tidak ditemukan.";
        exit();
    }
} else {
    echo "ID Dokter tidak valid.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit Dokter</title>
</head>
<body>

<h2>Edit Dokter</h2>

<!-- Form edit dokter -->
<form method="POST" action="index.php?page=edit_dokter"> <!-- Tambahkan action -->
    <input type="hidden" name="id_dokter" value="<?php echo $dokter['id']; ?>">
    <label>Nama Dokter:</label>
    <input type="text" name="nama" value="<?php echo $dokter['nama']; ?>" required><br><br>
    <label>Alamat:</label>
    <input type="text" name="alamat" value="<?php echo $dokter['alamat']; ?>" required><br><br>
    <label>No. HP:</label>
    <input type="text" name="no_hp" value="<?php echo $dokter['no_hp']; ?>" required><br><br>
    <label>ID Poli:</label>
    <select name="id_poli" required>
        <?php
        $poliResult = $mysqli->query("SELECT * FROM poli");
        while ($row = $poliResult->fetch_assoc()) {
            echo '<option value="' . $row['id'] . '" ' . ($row['id'] == $dokter['id_poli'] ? 'selected' : '') . '>' . $row['nama_poli'] . '</option>';
        }
        ?>
    </select><br><br>
    <input type="submit" name="update_dokter" value="Update Dokter">
</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
