<?php
session_start();
include '../config/db.php';
$user_id = $_SESSION['user_id'];
global $conn;
$result = mysqli_query($conn, "SELECT * FROM activity_log WHERE user_id=$user_id ORDER BY waktu DESC");
?>

<h2>Riwayat Aktivitas</h2>
<a href="dashboard.php">← Kembali</a>
<ul>
    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <li><?= $row['waktu'] ?> - <?= $row['aktivitas'] ?></li>
    <?php endwhile; ?>
</ul>
