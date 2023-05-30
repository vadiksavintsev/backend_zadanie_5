<?php
session_start();
 
$servername = "localhost";
$username = "u52989";
$password = "5004286";
$dbname = "u52989";
 
// Создание подключения
try {
    $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password, [
        PDO::ATTR_PERSISTENT => true,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
 
$login = $_POST['login'];
$entered_password = $_POST['pass'];
 
// Подготовленное выражение
$stmt = $db->prepare("SELECT id, pass FROM users WHERE login = :login");
$stmt->bindParam(':login', $login);
$stmt->execute();
 
if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    if (password_verify($entered_password, $row['pass'])) {
        $_SESSION['id'] = $row['id'];
        header("Location: form.php");
        exit();
    } else {
        $_SESSION['error'] = "Неверный логин или пароль";
        header("Location: login.php");
        exit();
    }
} else {
    $_SESSION['error'] = "Неверный логин или пароль";
    header("Location: login.php");
    exit();
}
?>
