<?php
require_once 'db.php';
session_start();

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!empty($username) && !empty($email) && !empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        try {
            $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $stmt->execute([$username, $email, $hashedPassword]);
            
            $message = "Реєстрація успішна! Тепер ви можете <a href='login.php'>увійти</a>.";
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                $message = "Помилка: Користувач з таким ім'ям або email вже існує.";
            } else {
                $message = "Помилка бази даних: " . $e->getMessage();
            }
        }
    } else {
        $message = "Будь ласка, заповніть усі поля.";
    }
}
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Реєстрація</title>
</head>
<body style="font-family: sans-serif; margin: 40px;">
    <h2>Реєстрація користувача</h2>
    <?php if ($message): ?>
        <p style="color: blue;"><?= $message ?></p>
    <?php endif; ?>
    <form method="POST">
        <label>Ім'я користувача:</label><br>
        <input type="text" name="username" required><br><br>
        
        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>
        
        <label>Пароль:</label><br>
        <input type="password" name="password" required><br><br>
        
        <input type="submit" value="Зареєструватися">
    </form>
    <p>Вже є акаунт? <a href="login.php">Увійти</a></p>
</body>
</html>