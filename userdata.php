<?php
header('Content-Type: text/html; charset=utf-8');
require_once 'index.php';

if (!isset($_SESSION['login']) || !isset($_SESSION['password'])) {
    header("Location: form.php");
    exit();
}

$login = $_SESSION['login'];
$pass = $_SESSION['pass'];
$id = $_SESSION['id'];

try {

    unset($_SESSION['login']);
    unset($_SESSION['pass']);
} catch (PDOException $e) {
    print('Error : ' . $e->getMessage());
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Data</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <div class="container">
        <h1>Welcome!</h1>
        <p>Login: <?php echo htmlspecialchars($login); ?></p>
        <p>Password: <?php echo htmlspecialchars($pass); ?></p>
        <p><a href="form.php">To index</a></p>
    </div>
</body>
</html>
