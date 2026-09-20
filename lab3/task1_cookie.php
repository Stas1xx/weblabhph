<?php
if (isset($_POST['delete_cookie'])) {
    setcookie("username", "", time() - 3600, "/");
    header("Location: task1_cookie.php");
    exit();
}

if (isset($_POST['username']) && !empty(trim($_POST['username']))) {
    $username = htmlspecialchars(trim($_POST['username']));
    setcookie("username", $username, time() + (7 * 24 * 60 * 60), "/");
    header("Location: task1_cookie.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
</head>
<body style="font-family: sans-serif; margin: 20px;">
    <h2>1. $_COOKIE</h2>

    <?php if (isset($_COOKIE['username'])): ?>
        <h3 style="color: green;">Привіт, <?= htmlspecialchars($_COOKIE['username']) ?>!</h3>
        <p>Ми запам'ятали тебе за допомогою Cookie на 7 днів.</p>
        
        <form method="POST">
            <input type="submit" name="delete_cookie" value="Видалити cookie" style="color: red;">
        </form>
        
    <?php else: ?>
        <form method="POST">
            <label>Введіть ваше ім'я:</label><br><br>
            <input type="text" name="username" required>
            <input type="submit" value="Зберегти ім'я">
        </form>
    <?php endif; ?>
</body>
</html>