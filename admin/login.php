<?php
require_once '../config/database.php';
require_once '../config/auth.php';

if (isAdminLoggedIn()) {
    header('Location: index.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'] ?? '';
    if (empty($password)) {
        $error = 'Please enter your password.';
    } elseif (!attemptLogin($password)) {
        sleep(1); // throttle brute-force
        $error = 'Invalid password. Please try again.';
    } else {
        header('Location: index.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="robots" content="noindex,nofollow">
<title>Admin Login — Titus Buyers Agent</title>
<link href="../assets/css/quicksand.css" rel="stylesheet">
<style>
*, *::before, *::after { box-sizing: border-box; }
body {
    font-family: 'Quicksand', sans-serif;
    background: #0d1b2a;
    min-height: 100vh;
    display: flex; align-items: center; justify-content: center;
    padding: 20px;
}
.login-card {
    background: #fff;
    border-radius: 16px;
    padding: 50px 44px;
    width: 100%; max-width: 420px;
    box-shadow: 0 24px 60px rgba(0,0,0,.3);
}
.login-card .logo { text-align: center; margin-bottom: 32px; }
.login-card .logo img { height: 56px; }
.login-card h1 { font-size: 24px; font-weight: 800; color: #0d1b2a; text-align: center; margin-bottom: 6px; }
.login-card p  { font-size: 14px; color: #6c8795; text-align: center; margin-bottom: 32px; }
label { font-size: 13px; font-weight: 700; color: #4a6a79; display: block; margin-bottom: 6px; }
input[type=password] {
    width: 100%; padding: 13px 16px;
    border: 1.5px solid #dde8ed; border-radius: 10px;
    font-family: 'Quicksand', sans-serif; font-size: 15px;
    transition: border-color .2s; outline: none;
}
input[type=password]:focus { border-color: #8FA9B5; box-shadow: 0 0 0 3px rgba(143,169,181,.15); }
.btn-login {
    width: 100%; padding: 14px;
    background: #8FA9B5; color: #fff;
    border: none; border-radius: 10px;
    font-family: 'Quicksand', sans-serif; font-size: 16px; font-weight: 700;
    cursor: pointer; margin-top: 20px; transition: background .2s;
}
.btn-login:hover { background: #6d8a98; }
.error-msg { background: #fde8e8; border-left: 4px solid #e74c3c; color: #7a1a1a; padding: 12px 16px; border-radius: 8px; font-size: 14px; font-weight: 600; margin-bottom: 20px; }
.back-link { display: block; text-align: center; margin-top: 20px; font-size: 13px; color: #8fa4b0; text-decoration: none; }
.back-link:hover { color: #8FA9B5; }
</style>
</head>
<body>
<div class="login-card">
    <div class="logo"><img src="../assets/images/logo.png" alt="Titus Buyers Agent"></div>
    <h1>Admin Panel</h1>
    <p>Enter your password to manage the website</p>

    <?php if ($error): ?>
    <div class="error-msg" role="alert"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form method="post" action="login.php" autocomplete="off">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter admin password" required autofocus>
        <button type="submit" class="btn-login">Sign In</button>
    </form>
    <a href="../index.php" class="back-link">← Back to website</a>
</div>
</body>
</html>
