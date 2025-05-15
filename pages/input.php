<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    
    <!-- Inline CSS -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
            background-image: linear-gradient(135deg, #FFDAB9, #FFE5B4);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        form {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin: 10px 0 5px;
            font-size: 15px;
            color: #555;
        }

        input[type="text"], input[type="date"], textarea {
            width: 100%;
            padding: 10px;
            margin: 8px 0 20px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }

        textarea {
            height: 100px;
        }

        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }

        .success-message {
            text-align: center;
            color: green;
            font-size: 16px;
            margin-bottom: 20px;
        }

        small {
            font-size: 12px;
            color: #777;
            display: block;
            margin-top: -10px;
        }

        /* Style for logout button */
        .logout-button {
            position: fixed;
            top: 10px;
            right: 10px;
            background-color:rgb(255, 0, 0);
            color: white;
            padding: 2px 5px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 16px;
            text-align: center;
            z-index: 1000; /* Ensures it stays on top */
            transition: background-color 0.3s ease;
        }

        .logout-button:hover {
            background-color:rgb(255, 0, 0);
        }
    </style>
</head>
<body>

<!-- Logout Button positioned at the top-right -->
<button class="logout-button"><?php include '../components/logout_button.php'; ?></button>

<?php
if (isset($_GET['success']) && $_GET['success'] == 1) {
    echo "<p class='success-message'>Data berhasil ditambahkan!</p>";
}
?>

<form action="../actions/input_process.php" method="POST" onsubmit="return confirm('Apakah data yang Anda masukkan sudah benar?')">
    <input type="text" name="nama" placeholder="Nama" required><br>
    <input type="text" name="nim" placeholder="NIM" required><br>

    <label for="tanggal_lahir">Tanggal Lahir:</label>
    <input type="date" name="tanggal_lahir" id="tanggal_lahir" required>

    <textarea name="alamat" placeholder="Alamat" required></textarea><br>

    <input type="text" name="telepon" placeholder="Telepon"><br>
    <input type="text" name="kesukaan" placeholder="Kesukaan"><br>
    <button type="submit">Simpan</button>
</form>

</body>
</html>
