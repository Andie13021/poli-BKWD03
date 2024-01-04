<?php
include('koneksi.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Sesuaikan dengan struktur tabel admin dan users di database Anda
    $table = ($role == 'admin') ? 'admin' : 'users';

    $query = "SELECT * FROM $table WHERE username = '$username'";
    $result = mysqli_query($mysqli, $query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Login berhasil
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role;
            header("Location: index.php");
        } else {
            echo "Password salah.";
        }
    } else {
        echo "Pengguna tidak ditemukan.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form method="POST">
        <label>Username:</label>
        <input type="text" name="username" required><br><br>
        <label>Password:</label>
        <input type="password" name="password" required><br><br>

        <!-- Tambahkan dropdown atau radio button untuk memilih role (admin/user) -->
        <label>Login Sebagai:</label>
        <select name="role">
            <option value="admin">Admin</option>
            <option value="user">User</option>
        </select><br><br>

        <input type="submit" value="Login">
    </form>
    <p>Belum Punya Akun? <a href="index.php?page=register">Daftar di sini</a></p>
</body>
</html>
