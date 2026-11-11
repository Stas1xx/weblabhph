<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Захищена сторінка</title>
</head>
<body style="font-family: sans-serif; margin: 40px;">
    <h2>Вітаємо, <?= htmlspecialchars($_SESSION['username']) ?>!</h2>
    <p>Це захищена сторінка (Welcome.php), яка доступна тільки після успішної авторизації.</p>
    <br>
    <a href="logout.php" style="color: red; text-decoration: none; font-weight: bold;">Вийти з системи</a>
</body>
</html>