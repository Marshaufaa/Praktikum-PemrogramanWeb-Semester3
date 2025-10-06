<?php

session_start();
if (isset($_SESSION['username'])) {
    header('Location: dashboard.php');
    exit;
}

$error = '';
if (isset($_GET['status'])) {
    if ($_GET['status'] === 'loggedout') {
        $message = 'Anda telah berhasil keluar (logout). Silakan login kembali.';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $valid_username = 'admin';
    $valid_password = 'rahasia'; 

    if ($username === $valid_username && $password === $valid_password) {
        $_SESSION['username'] = $username;
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Username atau password salah.';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Kopi Lih Marsha</title>
    <link rel="stylesheet" href="style.css" /> 
    <style>
        .login-container {
            width: 300px;
            margin: 100px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background: #fff;
        }
        .login-container input[type="text"], 
        .login-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
            border-radius: 4px;
        }
        .login-container button {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
            border-radius: 4px;
        }
        .error {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body class="body">
    <div class="login-container">
        <h2>Login Admin</h2>
        <?php if ($error): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="POST" action="login.php">
            <label for="username"><b>Username</b></label>
            <input type="text" placeholder="Masukkan Username" name="username" required>

            <label for="password"><b>Password</b></label>
            <input type="password" placeholder="Masukkan Password" name="password" required>
                
            <button type="submit">Login</button>
            <p style="text-align: center;"><a href="index.php">Kembali ke Beranda</a></p>
        </form>
    </div>
</body>
</html>