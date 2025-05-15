<?php
// Mulai session hanya jika belum dimulai
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Hapus semua session
session_destroy();

// Redirect ke halaman login
header("Location: ../pages/login.php");
exit();
