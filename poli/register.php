<?php
include('koneksi.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $role = $_POST['role'];

    // Hash password sebelum disimpan ke database
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Sesuaikan dengan struktur tabel admin dan users di database "poli"
    $table = ($role == 'admin') ? 'admin' : 'users';

    $query = "INSERT INTO $table (username, password, nama_lengkap) 
              VALUES ('$username', '$hashed_password', '$nama_lengkap')";

    if ($mysqli->query($query)) {
        echo "Registrasi Berhasil. Silakan login.";
    } else {
        echo "Error: " . $query . "<br>" . $mysqli->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>
    <form method="POST">
        <label>Username:</label>
        <input type="text" name="username" required><br><br>
        <label>Password:</label>
        <input type="password" name="password" required><br><br>
        <label>Nama Lengkap:</label>
        <input type="text" name="nama_lengkap" required><br><br>

        <!-- Tambahkan dropdown atau radio button untuk memilih role (admin/user) -->
        <label>Register Sebagai:</label>
        <select name="role">
            <option value="admin">Admin</option>
            <option value="user">User</option>
        </select><br><br>

        <input type="submit" value="Register">
    </form>
    <p>Sudah Punya Akun? <a href="login.php">Login</a></p>
</body>
</html>
