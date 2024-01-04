<?php
include("koneksi.php");

// Fungsi untuk mendapatkan data riwayat periksa pasien dari database
function getRiwayatPasienData() {
    global $mysqli;
    $result = $mysqli->query("SELECT periksa.*, dokter.id_poli, obat.nama_obat
                             FROM periksa
                             JOIN dokter ON periksa.id_dokter_poli = dokter.id
                             JOIN obat ON periksa.id_obat = obat.id");
    $riwayatPasienData = [];
    while ($row = $result->fetch_assoc()) {
        $riwayatPasienData[] = $row;
    }
    return $riwayatPasienData;
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

// Ambil data pasien
$pasienData = getPasienData();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Riwayat Pasien</title>
</head>
<body>

<h2>Riwayat Pasien</h2>

<?php
$riwayatPasienData = getRiwayatPasienData();

// Tampilkan riwayat periksa pasien
if (empty($riwayatPasienData)) {
    echo "Tidak ada riwayat periksa untuk pasien ini.";
} else {
    ?>
    <!-- Tabel riwayat periksa -->
    <table class="table">
        <thead>
            <tr>
                <th>ID Periksa</th>
                <th>Tanggal Periksa</th>
                <th>Cacatan</th>
                <th>Biaya Periksa</th>
                <th>ID Dokter</th>
                <th>ID Obat</th>
                <th>Nama Obat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($riwayatPasienData as $riwayat): ?>
                <tr>
                    <td><?php echo $riwayat['id']; ?></td>
                    <td><?php echo $riwayat['tgl_periksa']; ?></td>
                    <td><?php echo $riwayat['cacatan']; ?></td>
                    <td><?php echo $riwayat['biaya_periksa']; ?></td>
                    <td><?php echo $riwayat['id_dokter_poli']; ?></td>
                    <td><?php echo $riwayat['id_obat']; ?></td>
                    <td><?php echo $riwayat['nama_obat']; ?></td>
                    <td>
                        <a href="hapus_riwayat.php?id=<?php echo $riwayat['id']; ?>" onclick="return confirm('Hapus riwayat periksa?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php
}
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
