<?php
include("koneksi.php");

// Ambil data dokter untuk dropdown
function getDokterData() {
    global $mysqli;
    $result = $mysqli->query("SELECT * FROM dokter");
    $dokterData = [];
    while ($row = $result->fetch_assoc()) {
        $dokterData[] = $row;
    }
    return $dokterData;
}

// Ambil data pasien untuk dropdown
function getPasienData() {
    global $mysqli;
    $result = $mysqli->query("SELECT * FROM pasien");
    $pasienData = [];
    while ($row = $result->fetch_assoc()) {
        $pasienData[] = $row;
    }
    return $pasienData;
}

// Ambil data obat untuk dropdown
function getObatData() {
    global $mysqli;
    $result = $mysqli->query("SELECT * FROM obat");
    $obatData = [];
    while ($row = $result->fetch_assoc()) {
        $obatData[] = $row;
    }
    return $obatData;
}

// Tambahkan data periksa ke database
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['tambah_periksa'])) {
    $id_dokter_poli = $_POST['id_dokter_poli'];
    $tgl_periksa = $_POST['tgl_periksa'];
    $cacatan = $_POST['cacatan'];
    $biaya_periksa = $_POST['biaya_periksa'];
    $id_pasien = $_POST['id_pasien'];
    $id_obat = $_POST['id_obat'];

    $query = "INSERT INTO periksa (id_dokter_poli, tgl_periksa, cacatan, biaya_periksa, id_pasien, id_obat) 
              VALUES ($id_dokter_poli, '$tgl_periksa', '$cacatan', $biaya_periksa, $id_pasien, $id_obat)";

    if ($mysqli->query($query)) {
        echo "Data periksa berhasil ditambahkan.";
    } else {
        echo "Error: " . $query . "<br>" . $mysqli->error;
    }
}

// Ambil data dokter, pasien, dan obat
$dokterData = getDokterData();
$pasienData = getPasienData();
$obatData = getObatData();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Periksa</title>
</head>
<body>

<h2>Form Periksa</h2>

<!-- Form tambah periksa -->
<form method="POST">
    <label>Dokter:</label>
    <select name="id_dokter_poli" required>
        <?php foreach ($dokterData as $dokter): ?>
            <option value="<?php echo $dokter['id']; ?>"><?php echo $dokter['nama']; ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Tanggal Periksa:</label>
    <input type="datetime-local" name="tgl_periksa" required><br><br>

    <label>Cacatan:</label>
    <textarea name="cacatan" required></textarea><br><br>

    <label>Biaya Periksa:</label>
    <input type="number" name="biaya_periksa" required><br><br>

    <label>Pasien:</label>
    <select name="id_pasien" required>
        <?php foreach ($pasienData as $pasien): ?>
            <option value="<?php echo $pasien['id']; ?>"><?php echo $pasien['nama']; ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Obat:</label>
    <select name="id_obat" required>
        <?php foreach ($obatData as $obat): ?>
            <option value="<?php echo $obat['id']; ?>"><?php echo $obat['nama_obat']; ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <input type="submit" name="tambah_periksa" value="Tambah Periksa">
</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
