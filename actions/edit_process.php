<?php
session_start();
include '../config/db.php';

$id = $_POST['id'];
$nama = $_POST['nama'];
$nim = $_POST['nim'];
$tanggal = $_POST['tanggal_lahir'];
$alamat = $_POST['alamat'];
$telepon = $_POST['telepon'];
$kesukaan = $_POST['kesukaan'];
$user_id = $_SESSION['user_id'];
global $conn;

// Ambil data lama
$old = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM mahasiswa WHERE id = $id"));

$query = "UPDATE mahasiswa SET 
            nama='$nama', nim='$nim', tanggal_lahir='$tanggal', 
            alamat='$alamat', telepon='$telepon', kesukaan='$kesukaan'
          WHERE id=$id";
mysqli_query($conn, $query);

// Bandingkan dan catat perubahan
$changes = [];
if ($old['nama'] != $nama) $changes[] = "Nama dari '{$old['nama']}' menjadi '$nama'";
if ($old['nim'] != $nim) $changes[] = "NIM dari '{$old['nim']}' menjadi '$nim'";
if ($old['tanggal_lahir'] != $tanggal) $changes[] = "Tanggal Lahir dari '{$old['tanggal_lahir']}' menjadi '$tanggal'";
if ($old['alamat'] != $alamat) $changes[] = "Alamat dari '{$old['alamat']}' menjadi '$alamat'";
if ($old['telepon'] != $telepon) $changes[] = "Telepon dari '{$old['telepon']}' menjadi '$telepon'";
if ($old['kesukaan'] != $kesukaan) $changes[] = "Kesukaan dari '{$old['kesukaan']}' menjadi '$kesukaan'";

if (!empty($changes)) {
    $log = "Mengedit data mahasiswa: " . implode(", ", $changes);
    $log = mysqli_real_escape_string($conn, $log); // Escape karakter berbahaya
    mysqli_query($conn, "INSERT INTO activity_log(user_id, aktivitas) VALUES($user_id, '$log')");
}


header("Location: ../pages/admin_dashboard.php?updated=1");
exit();
