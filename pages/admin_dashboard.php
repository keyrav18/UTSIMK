<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}
global $conn;

// Pencarian
$search = isset($_GET['search']) ? $_GET['search'] : '';
$search_query = "
    SELECT mahasiswa.*, users.username 
    FROM mahasiswa
    LEFT JOIN users ON mahasiswa.created_by = users.id
";
if (!empty($search)) {
    $search = mysqli_real_escape_string($conn, $search);
    $search_query .= " WHERE mahasiswa.nama LIKE '%$search%' OR mahasiswa.nim LIKE '%$search%'";
}
$search_query .= " ORDER BY mahasiswa.id DESC";
$mhs_result = mysqli_query($conn, $search_query);

// Log aktivitas
$log_query = "
    SELECT activity_log.*, users.username
    FROM activity_log
    LEFT JOIN users ON activity_log.user_id = users.id
    ORDER BY activity_log.created_at DESC
";
$log_result = mysqli_query($conn, $log_query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #121212;
            color: #f0f0f0;
            padding: 30px;
            margin: 0;
        }

        h1, h2 {
            color: #ffffff;
        }

        .logout-btn {
            float: right;
            margin-top: -40px;
            background-color: #e74c3c;
            color: white;
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .logout-btn:hover {
            background-color: #c0392b;
        }

        .search-box {
            margin: 20px 0;
        }

        .search-box input[type="text"] {
            padding: 8px;
            width: 250px;
            border-radius: 5px;
            border: 1px solid #333;
            background-color:rgb(255, 255, 255);
            color:rgb(0, 0, 0);
        }

        .search-box button {
            padding: 8px 14px;
            background-color: #3a3a3a;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .search-box button:hover {
            background-color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
            background-color: #1f1f1f;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
        }

        th, td {
            padding: 14px 16px;
            border-bottom: 1px solid #333;
            text-align: left;
            font-size: 14px;
        }

        th {
            background-color: #2a2a2a;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #252525;
        }

        tr:hover {
            background-color: #333;
        }

        a {
            color: #74b9ff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .notification {
            padding: 12px 20px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-weight: 500;
            border-left: 5px solid;
        }

        .success {
            background-color: #14532d;
            color: #a3f7bf;
            border-color: #27ae60;
        }

        .info {
            background-color: #1e3a8a;
            color: #cfe3ff;
            border-color: #3498db;
        }

        .warning {
            background-color: #7b1c1c;
            color: #f7bebe;
            border-color: #e74c3c;
        }

        @media (max-width: 768px) {
            .logout-btn {
                float: none;
                display: inline-block;
                margin-top: 10px;
            }

            table, thead, tbody, th, td {
                font-size: 13px;
            }
        }
    </style>
</head>
<body>

<?php if (isset($_GET['deleted'])): ?>
    <div class="notification success">✅ Data berhasil dihapus.</div>
<?php elseif (isset($_GET['updated'])): ?>
    <div class="notification info">🔄 Data berhasil diperbarui.</div>
<?php elseif (isset($_GET['error']) && $_GET['error'] === 'notfound'): ?>
    <div class="notification warning">⚠️ Data tidak ditemukan.</div>
<?php endif; ?>

<h1>Selamat Datang, Admin</h1>
<a href="../actions/logout.php" class="logout-btn">Logout</a>

<h2>Aktivitas Pengguna</h2>
<table>
    <thead>
        <tr>
            <th>Username</th>
            <th>Aktivitas</th>
            <th>Waktu</th>
        </tr>
    </thead>
    <tbody>
        <?php while($log = mysqli_fetch_assoc($log_result)) { ?>
            <tr>
                <td><?= htmlspecialchars($log['username']) ?: 'Tidak diketahui' ?></td>
                <td><?= htmlspecialchars($log['aktivitas']) ?></td>
                <td><?= htmlspecialchars($log['created_at']) ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<h2>Data Mahasiswa</h2>

<div class="search-box">
    <form method="GET" action="">
        <input type="text" name="search" placeholder="Cari Nama/NIM" value="<?= htmlspecialchars($search); ?>">
        <button type="submit">Cari</button>
    </form>
</div>

<table>
    <thead>
        <tr>
            <th>Nama</th>
            <th>NIM</th>
            <th>Tanggal Lahir</th>
            <th>Alamat</th>
            <th>Telepon</th>
            <th>Kesukaan</th>
            <th>Input oleh</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php while($mhs = mysqli_fetch_assoc($mhs_result)) { ?>
            <tr>
                <td><?= htmlspecialchars($mhs['nama']) ?></td>
                <td><?= htmlspecialchars($mhs['nim']) ?></td>
                <td><?= htmlspecialchars($mhs['tanggal_lahir']) ?></td>
                <td>
                    <a href="https://www.google.com/maps/search/?api=1&query=<?= urlencode($mhs['alamat']) ?>" target="_blank">
                        <?= htmlspecialchars($mhs['alamat']) ?>
                    </a>
                </td>
                <td><?= htmlspecialchars($mhs['telepon']) ?></td>
                <td><?= htmlspecialchars($mhs['kesukaan']) ?></td>
                <td><?= htmlspecialchars($mhs['username']) ?: 'Tidak diketahui' ?></td>
                <td>
                    <a href="edit.php?id=<?= $mhs['id'] ?>">Edit</a> |
                    <a href="../actions/delete.php?id=<?= $mhs['id'] ?>" onclick="return confirm('Hapus data ini?')">Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

</body>
</html>
