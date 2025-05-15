<?php
include '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = 'mahasiswa'; // role diset otomatis

    global $conn;

    // Cek apakah username sudah digunakan
    $cek = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
    if (mysqli_num_rows($cek) > 0) {
        echo "Username sudah digunakan. Silakan <a href='../pages/register.php'>coba lagi</a>.";
    } else {
        $query = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";
        if (mysqli_query($conn, $query)) {
            echo "Registrasi berhasil. <a href='../pages/login.php'>Login sekarang</a>";
        } else {
            echo "Gagal registrasi: " . mysqli_error($conn);
        }
    }
} else {
    header("Location: ../pages/register.php");
}
?>
