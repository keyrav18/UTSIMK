<?php
session_start();
include '../config/db.php';
global $conn;

$username = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = $user['role'];

    // Redirect sesuai role
    if ($user['role'] === 'admin') {
        header("Location: ../pages/admin_dashboard.php");
    } elseif ($user['role'] === 'mahasiswa') {
        header("Location: ../pages/input.php");
    } else {
        header("Location: ../pages/login.php?error=invalidrole");
    }
    exit();
} else {
    header("Location: ../pages/login.php?error=1");
    exit();
}
