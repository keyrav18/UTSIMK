<?php
session_start();
include '../config/db.php';

if (!isset($_GET['id']) || !isset($_SESSION['user_id'])) {
    header("Location: ../pages/admin_dashboard.php");
    exit();
}

$id = intval($_GET['id']);
$user_id = $_SESSION['user_id'];
global $conn;

$result = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE id=$id");
if (mysqli_num_rows($result) === 0) {
    header("Location: ../pages/admin_dashboard.php?error=notfound");
    exit();
}

$data = mysqli_fetch_assoc($result);
$nim = $data['nim'];
$log = "Menghapus data mahasiswa dengan NIM $nim";

mysqli_query($conn, "DELETE FROM mahasiswa WHERE id=$id");
mysqli_query($conn, "INSERT INTO activity_log(user_id, aktivitas) VALUES($user_id, '$log')");

header("Location: ../pages/admin_dashboard.php?deleted=1");
exit();
