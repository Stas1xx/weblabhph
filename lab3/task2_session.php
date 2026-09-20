<?php
session_start();

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: task2_session.php");
    exit();
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login_btn'])) {
    $login = trim($_POST['username']);
    $password = trim($_POST['password']);

    if ($login === 'admin' && $password === '12345') {
        $_SESSION['user'] = $login;
        header("Location: task2_session.php");
        exit();
    } else {
        $error = "Невірний логін або пароль!";
    }
}
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
</head>
<body style="font-family: sans-serif; margin: 20px;">
    <h2>2. $_SESSION</h2>

    <?php if (isset($_SESSION['user'])): ?>
        <h3 style="color: green;">Вітаємо, <?= htmlspecialchars($_SESSION['user']) ?>! Ви успішно увійшли.</h3>
        <p>Ваші дані збережено у безпечній серверній сесії.</p>
        
        <form method="POST">
            <input type="submit" name="logout" value="Вихід" style="color: red;">
        </form>
        
    <?php else: ?>
        <?php if ($error): ?>
            <p style="color: red;"><b><?= $error ?></b></p>
        <?php endif; ?>
        
        <p><i>Підказка: логін - <b>admin</b>, пароль - <b>12345</b></i></p>
        <form method="POST">
            <label>Логін:</label><br>
            <input type="text" name="username" required><br><br>
            
            <label>Пароль:</label><br>
            <input type="password" name="password" required><br><br>
            
            <input type="submit" name="login_btn" value="Увійти">
        </form>
    <?php endif; ?>
</body>
</html>