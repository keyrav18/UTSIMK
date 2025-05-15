<?php
session_start();

// Jika sudah login, arahkan ke dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: pages/dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Selamat Datang</title>
</head>
<body>
<h1>Selamat Datang di Aplikasi UTS IMK</h1>
<p><a href="pages/login.php">Login</a> | <a href="pages/register.php">Register</a></p>
</body>
</html>
