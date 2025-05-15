<?php
session_start();
include '../config/db.php';

// Ambil data dari form
$nama = $_POST['nama'];
$nim = $_POST['nim'];
$tanggal  = $_POST['tanggal_lahir'];
$alamat = $_POST['alamat'];
$telepon = $_POST['telepon'];
$kesukaan = $_POST['kesukaan'];


$user_id = $_SESSION['user_id'];

global $conn;

// Simpan ke tabel mahasiswa
$query = "INSERT INTO mahasiswa (nama, nim, tanggal_lahir, alamat, telepon, kesukaan, created_by)
          VALUES ('$nama', '$nim', '$tanggal', '$alamat', '$telepon', '$kesukaan', '$user_id')";
mysqli_query($conn, $query);

// Catat ke log aktivitas
$log = "Menambahkan data mahasiswa dengan NIM $nim";
mysqli_query($conn, "INSERT INTO activity_log (user_id, aktivitas) VALUES ('$user_id', '$log')");

// Redirect ke input.php dengan pesan sukses
header("Location: ../pages/input.php?success=1");
exit();
?>
