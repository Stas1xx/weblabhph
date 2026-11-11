<?php
require_once 'db.php';
session_start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!empty($username) && !empty($password)) {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            
            header("Location: welcome.php");
            exit();
        } else {
            $error = "Невірне ім'я користувача або пароль.";
        }
    } else {
        $error = "Будь ласка, заповніть усі поля.";
    }
}
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Авторизація</title>
</head>
<body style="font-family: sans-serif; margin: 40px;">
    <h2>Вхід у систему</h2>
    <?php if ($error): ?>
        <p style="color: red;"><?= $error ?></p>
    <?php endif; ?>
    <form method="POST">
        <label>Ім'я користувача:</label><br>
        <input type="text" name="username" required><br><br>
        
        <label>Пароль:</label><br>
        <input type="password" name="password" required><br><br>
        
        <input type="submit" value="Увійти">
    </form>
    <p>Ще немає акаунта? <a href="register.php">Зареєструватися</a></p>
</body>
</html>