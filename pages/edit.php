<?php
include '../config/db.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
global $conn;

$result = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE id = '$id'");
$data = mysqli_fetch_assoc($result);

if (!$data) {
    echo "<div style='padding: 20px; color: white; background-color: #ff5733;'>❌ Data tidak ditemukan.</div>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Mahasiswa</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
            color: #333;
            padding: 40px;
            margin: 0;
        }

        h2 {
            margin-bottom: 30px;
            color: #ff6f61;
            font-size: 2em;
            text-align: center;
        }

        form {
            max-width: 600px;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin: 0 auto;
            border-top: 6px solid #ff6f61;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            color: #ff6f61;
        }

        input[type="text"],
        input[type="date"],
        textarea {
            width: 100%;
            padding: 12px;
            border-radius: 6px;
            border: 1px solid #ff6f61;
            background-color: #fff5f3;
            color: #333;
            margin-bottom: 20px;
            font-size: 16px;
            box-sizing: border-box;
        }

        textarea {
            min-height: 80px;
        }

        button[type="submit"] {
            background-color: #ff6f61;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
            width: 100%;
        }

        button[type="submit"]:hover {
            background-color: #ff4e40;
        }

        a.back-link {
            display: inline-block;
            margin-top: 20px;
            color: #ff6f61;
            text-decoration: none;
            font-weight: bold;
        }

        a.back-link:hover {
            text-decoration: underline;
        }

        .notification {
            padding: 20px;
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            border-radius: 4px;
            margin-bottom: 20px;
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>
<body>

<?php if (isset($_GET['success'])): ?>
    <div class="notification">
        ✅ Data berhasil diperbarui!
    </div>
<?php endif; ?>

<h2>Edit Data Mahasiswa</h2>

<form action="../actions/edit_process.php" method="POST">
    <input type="hidden" name="id" value="<?= $data['id'] ?>">

    <label for="nama">Nama:</label>
    <input type="text" id="nama" name="nama" value="<?= htmlspecialchars($data['nama']) ?>" required>

    <label for="nim">NIM:</label>
    <input type="text" id="nim" name="nim" value="<?= htmlspecialchars($data['nim']) ?>" required>

    <label for="tanggal_lahir">Tanggal Lahir:</label>
    <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="<?= htmlspecialchars($data['tanggal_lahir']) ?>" required>

    <label for="alamat">Alamat:</label>
    <textarea id="alamat" name="alamat" required><?= htmlspecialchars($data['alamat']) ?></textarea>

    <label for="telepon">Telepon:</label>
    <input type="text" id="telepon" name="telepon" value="<?= htmlspecialchars($data['telepon']) ?>" required>

    <label for="kesukaan">Kesukaan:</label>
    <input type="text" id="kesukaan" name="kesukaan" value="<?= htmlspecialchars($data['kesukaan']) ?>" required>

    <button type="submit">💾 Simpan Perubahan</button>
</form>

<a href="dashboard.php" class="back-link">← Kembali ke Dashboard</a>

</body>
</html>
