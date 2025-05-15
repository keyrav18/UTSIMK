<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: linear-gradient(135deg, #FFDAB9, #FFE5B4);
        }

        .login-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 12px 15px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
            color: #555;
        }

        input[type="text"]::placeholder, input[type="password"]::placeholder {
            color: #aaa;
            font-style: 'Arial', sans-serif;
        }

        button[type="submit"] {
            width: 100%;
            padding: 12px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }

        p {
            font-size: 14px;
            color: #666;
        }

        a {
            color: #4CAF50;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .form-footer {
            margin-top: 15px;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Form Registrasi</h2>
    <form action="../actions/register_process.php" method="POST">
        <input type="text" name="username" id="username" placeholder="Username" required>

        <input type="password" name="password" id="password" placeholder="Password" required>

        <button type="submit">Register</button>
    </form>

    <div class="form-footer">
        <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
    </div>
</div>

</body>
</html>
