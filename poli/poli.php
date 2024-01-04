<?php
include("koneksi.php");

// Fungsi untuk mendapatkan data poli dari database
function getPoliData() {
    global $mysqli;
    $result = $mysqli->query("SELECT * FROM poli");
    $poliData = [];
    while ($row = $result->fetch_assoc()) {
        $poliData[] = $row;
    }
    return $poliData;
}

// Tambahkan poli ke database
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['tambah_poli'])) {
    $nama_poli = $_POST['nama_poli'];
    $keterangan = $_POST['keterangan'];

    $query = "INSERT INTO poli (nama_poli, keterangan) VALUES ('$nama_poli', '$keterangan')";

    if ($mysqli->query($query)) {
        echo "Poli berhasil ditambahkan.";
    } else {
        echo "Error: " . $query . "<br>" . $mysqli->error;
    }
}

// Hapus poli dari database
if (isset($_GET['hapus_poli'])) {
    $id_poli = $_GET['hapus_poli'];

    $query = "DELETE FROM poli WHERE id = $id_poli";

    if ($mysqli->query($query)) {
        echo "Poli berhasil dihapus.";
    } else {
        echo "Error: " . $query . "<br>" . $mysqli->error;
    }
}

// Ambil data poli
$poliData = getPoliData();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Poli</title>
</head>
<body>

<h2>Data Poli</h2>

<!-- Form tambah poli -->
<form method="POST" action="index.php?page=poli">
    <label>Nama Poli:</label>
    <input type="text" name="nama_poli" required><br><br>
    <label>Keterangan:</label>
    <textarea name="keterangan" required></textarea><br><br>
    <input type="submit" name="tambah_poli" value="Tambah Poli">
</form>

<!-- Tabel data poli -->
<table class="table">
    <thead>
        <tr>
            <th>ID Poli</th>
            <th>Nama Poli</th>
            <th>Keterangan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($poliData as $poli): ?>
            <tr>
                <td><?php echo $poli['id']; ?></td>
                <td><?php echo $poli['nama_poli']; ?></td>
                <td><?php echo $poli['keterangan']; ?></td>
                <td>
                    <a href="index.php?page=edit_poli&id=<?php echo $poli['id']; ?>">Edit</a> | 
                    <a href="index.php?page=poli_hapus&id=<?php echo $poli['id']; ?>" onclick="return confirm('Hapus poli?')">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
