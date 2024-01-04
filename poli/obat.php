<?php
include("koneksi.php");

// Fungsi untuk mendapatkan data obat dari database
function getObatData() {
    global $mysqli;
    $result = $mysqli->query("SELECT * FROM obat");
    $obatData = [];
    while ($row = $result->fetch_assoc()) {
        $obatData[] = $row;
    }
    return $obatData;
}

// Tambahkan obat ke database
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['tambah_obat'])) {
    $nama_obat = $_POST['nama_obat'];
    $kemasan = $_POST['kemasan'];
    $harga = $_POST['harga'];

    $query = "INSERT INTO obat (nama_obat, kemasan, harga) VALUES ('$nama_obat', '$kemasan', $harga)";

    if ($mysqli->query($query)) {
        echo "Obat berhasil ditambahkan.";
    } else {
        echo "Error: " . $query . "<br>" . $mysqli->error;
    }
}

// Hapus obat dari database
if (isset($_GET['action']) && $_GET['action'] == 'hapus_obat' && isset($_GET['id_obat'])) {
    include('hapus_obat.php');
}

// Ambil data obat
$obatData = getObatData();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Obat</title>
</head>
<body>

<h2>Data Obat</h2>

<!-- Form tambah obat -->
<form method="POST">
    <label>Nama Obat:</label>
    <input type="text" name="nama_obat" required><br><br>
    <label>Kemasan:</label>
    <input type="text" name="kemasan" required><br><br>
    <label>Harga:</label>
    <input type="number" name="harga" required><br><br>
    <input type="submit" name="tambah_obat" value="Tambah Obat">
</form>

<!-- Tabel data obat -->
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Obat</th>
            <th>Kemasan</th>
            <th>Harga</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($obatData as $obat): ?>
            <tr>
                <td><?php echo $obat['id']; ?></td>
                <td><?php echo $obat['nama_obat']; ?></td>
                <td><?php echo $obat['kemasan']; ?></td>
                <td><?php echo $obat['harga']; ?></td>
                <td>
                    <a href="index.php?page=obat&action=hapus_obat&id_obat=<?php echo $obat['id']; ?>" onclick="return confirm('Hapus obat?')">Hapus</a>
                    <!-- Tambah link edit dengan parameter id obat -->
                    <a href="index.php?page=edit_obat&id_obat=<?php echo $obat['id']; ?>">Edit</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
