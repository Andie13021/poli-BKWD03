<?php
include("koneksi.php");

// Fungsi untuk mendapatkan data dokter dari database
function getDokterData() {
    global $mysqli;
    $result = $mysqli->query("SELECT * FROM dokter");
    $dokterData = [];
    while ($row = $result->fetch_assoc()) {
        $dokterData[] = $row;
    }
    return $dokterData;
}

// Ambil data poli
function getPoliData() {
    global $mysqli;
    $result = $mysqli->query("SELECT * FROM poli");
    $poliData = [];
    while ($row = $result->fetch_assoc()) {
        $poliData[] = $row;
    }
    return $poliData;
}

// Tambahkan dokter ke database
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['tambah_dokter'])) {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];
    $id_poli = $_POST['id_poli'];

    $query = "INSERT INTO dokter (nama, alamat, no_hp, id_poli) VALUES ('$nama', '$alamat', '$no_hp', $id_poli)";

    if ($mysqli->query($query)) {
        echo "Dokter berhasil ditambahkan.";
    } else {
        echo "Error: " . $query . "<br>" . $mysqli->error;
    }
}

// Ambil data dokter dan poli
$dokterData = getDokterData();
$poliData = getPoliData();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Data Dokter</title>
</head>
<body>

<h2>Data Dokter</h2>

<!-- Form tambah dokter -->
<form method="POST" action="index.php?page=dokter"> <!-- Modifikasi action form -->
    <label>Nama Dokter:</label>
    <input type="text" name="nama" required><br><br>
    <label>Alamat:</label>
    <input type="text" name="alamat" required><br><br>
    <label>No. HP:</label>
    <input type="text" name="no_hp" required><br><br>
    <label>ID Poli:</label>
    <select name="id_poli" required>
        <?php foreach ($poliData as $poli): ?>
            <option value="<?php echo $poli['id']; ?>"><?php echo $poli['nama_poli']; ?></option>
        <?php endforeach; ?>
    </select><br><br>
    <input type="submit" name="tambah_dokter" value="Tambah Dokter">
</form>

<!-- Tabel data dokter -->
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Dokter</th>
            <th>Alamat</th>
            <th>No. HP</th>
            <th>ID Poli</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($dokterData as $dokter): ?>
            <tr>
                <td><?php echo $dokter['id']; ?></td>
                <td><?php echo $dokter['nama']; ?></td>
                <td><?php echo $dokter['alamat']; ?></td>
                <td><?php echo $dokter['no_hp']; ?></td>
                <td><?php echo $dokter['id_poli']; ?></td>
                <td>
                    <a href="index.php?page=edit_dokter&id=<?php echo $dokter['id']; ?>">Edit</a> <!-- Modifikasi link -->
                    <a href="index.php?page=hapus_dokter&id=<?php echo $dokter['id']; ?>" onclick="return confirm('Hapus dokter?')">Hapus</a> <!-- Modifikasi link -->
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
