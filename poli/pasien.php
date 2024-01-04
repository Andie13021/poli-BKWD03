<?php
include("koneksi.php");

// Fungsi untuk menambah pasien
function tambahPasien($nama, $alamat, $no_ktp, $no_hp, $no_rm) {
    global $mysqli;

    $query = "INSERT INTO pasien (nama, alamat, no_ktp, no_hp, no_rm) 
              VALUES ('$nama', '$alamat', '$no_ktp', '$no_hp', '$no_rm')";

    return $mysqli->query($query);
}

// Fungsi untuk mendapatkan data semua pasien
function semuaPasien() {
    global $mysqli;

    $query = "SELECT * FROM pasien";
    $result = $mysqli->query($query);

    $pasien = [];
    while ($row = $result->fetch_assoc()) {
        $pasien[] = $row;
    }

    return $pasien;
}

// Fungsi untuk mendapatkan data pasien berdasarkan ID
function getPasienById($id) {
    global $mysqli;

    $query = "SELECT * FROM pasien WHERE id = $id";
    $result = $mysqli->query($query);

    return $result->fetch_assoc();
}

// Fungsi untuk mengupdate data pasien
function updatePasien($id, $nama, $alamat, $no_ktp, $no_hp, $no_rm) {
    global $mysqli;

    $query = "UPDATE pasien 
              SET nama='$nama', alamat='$alamat', no_ktp='$no_ktp', no_hp='$no_hp', no_rm='$no_rm' 
              WHERE id = $id";

    return $mysqli->query($query);
}

// Fungsi untuk menghapus data pasien
function hapusPasien($id) {
    global $mysqli;

    $query = "DELETE FROM pasien WHERE id = $id";

    return $mysqli->query($query);
}

// Proses form pendaftaran pasien
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_ktp = $_POST['no_ktp'];
    $no_hp = $_POST['no_hp'];
    $no_rm = $_POST['no_rm'];

    if (tambahPasien($nama, $alamat, $no_ktp, $no_hp, $no_rm)) {
        echo "Pendaftaran pasien berhasil.";
    } else {
        echo "Error: " . $mysqli->error;
    }
}

// Menampilkan data pasien
$pasienList = semuaPasien();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Daftar Pasien</title>
</head>
<body>

<div class="container mt-5">
    <h2>Daftar Pasien</h2>

    <!-- Form Pendaftaran Pasien -->
    <form method="POST">
        <label>Nama:</label>
        <input type="text" name="nama" required><br><br>
        <label>Alamat:</label>
        <input type="text" name="alamat" required><br><br>
        <label>No. KTP:</label>
        <input type="text" name="no_ktp" required><br><br>
        <label>No. HP:</label>
        <input type="text" name="no_hp" required><br><br>
        <label>No. Rekam Medis:</label>
        <input type="text" name="no_rm" required><br><br>

        <input type="submit" value="Daftar Pasien">
    </form>

    <!-- Tabel Data Pasien -->
    <table class="table mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No. KTP</th>
                <th>No. HP</th>
                <th>No. Rekam Medis</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pasienList as $pasien) : ?>
                <tr>
                    <td><?= $pasien['id']; ?></td>
                    <td><?= $pasien['nama']; ?></td>
                    <td><?= $pasien['alamat']; ?></td>
                    <td><?= $pasien['no_ktp']; ?></td>
                    <td><?= $pasien['no_hp']; ?></td>
                    <td><?= $pasien['no_rm']; ?></td>
                    <td>
                        <a href="index.php?page=edit_pasien&id=<?= $pasien['id']; ?>">Edit</a> | 
                        <a href="index.php?page=hapus_pasien&id=<?= $pasien['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
