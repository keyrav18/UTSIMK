<?php
$host = "localhost";
$user = "root";
$pass = '';
$db = "uts_mahasiswa";
global $conn;

$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
    die("koneksi gagal : " . mysqli_connect_error());
}
