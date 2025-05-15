<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'mahasiswa') {
    header("Location: login.php");
    exit();
}

global $conn;

$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
$query = "SELECT * FROM mahasiswa";

if ($search) {
    $query .= " WHERE nama LIKE '%$search%' OR nim LIKE '%$search%'";
}

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Mahasiswa</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color:rgb(215, 236, 255);
            margin: 0;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .welcome {
            font-size: 16px;
        }

        .button, button {
            background-color: #4A90E2;
            color: white;
            padding: 8px 14px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .button:hover, button:hover {
            background-color: #357ABD;
        }

        .logout {
            background-color: #e74c3c;
        }

        .logout:hover {
            background-color: #c0392b;
        }

        input[type="text"] {
            padding: 7px;
            width: 220px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        form {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        th {
            background-color: #f4f6f9;
            font-weight: bold;
            color: #333;
        }

        tr:nth-child(even) {
            background-color: #f9fcff;
        }

        tr:hover {
            background-color: #eef7ff;
        }

        .action-links a {
            margin-right: 10px;
            color: #4A90E2;
            text-decoration: none;
        }

        .action-links a:hover {
            text-decoration: underline;
        }

        @media (max-width: 600px) {
            form, .top-bar {
                flex-direction: column;
                align-items: flex-start;
            }

            input[type="text"] {
                width: 100%;
            }

            table, thead, tbody, th, td, tr {
                font-size: 13px;
            }
        }
    </style>
</head>
<body>

<h2>Dashboard Mahasiswa</h2>

<div class="top-bar">
    <div class="welcome">
        Selamat datang, <strong><?= htmlspecialchars($_SESSION['username']) ?></strong>
    </div>
    <a href="../actions/logout.php" class="button logout">Logout</a>
</div>

<form method="GET" action="">
    <input type="text" name="search" placeholder="Cari Nama/NIM" value="<?= htmlspecialchars($search); ?>">
    <button type="submit">Cari</button>
</form>

<div style="margin-bottom: 20px;">
    <a href="input.php" class="button">Tambah Data</a>
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
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                    <td><?= htmlspecialchars($row['nama']) ?></td>
                    <td><?= htmlspecialchars($row['nim']) ?></td>
                    <td><?= htmlspecialchars($row['tanggal_lahir']) ?></td>
                    <td><?= htmlspecialchars($row['alamat']) ?></td>
                    <td><?= htmlspecialchars($row['telepon']) ?></td>
                    <td><?= htmlspecialchars($row['kesukaan']) ?></td>
                    <td class="action-links">
                        <a href="edit.php?id=<?= $row['id'] ?>">Edit</a>
                        <a href="../actions/delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Hapus data ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="7">Tidak ada data ditemukan.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

</body>
</html>
