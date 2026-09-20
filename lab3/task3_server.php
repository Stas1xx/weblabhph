<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: task3_form.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
</head>
<body style="font-family: sans-serif; margin: 20px;">
    <h2>3. $_SERVER</h2>
    
    <div style="background: #f4f4f4; padding: 15px; border-radius: 5px; line-height: 1.8;">
        <b>IP-адреса клієнта:</b> <?= htmlspecialchars($_SERVER['REMOTE_ADDR']) ?><br>
        <b>Назва та версія браузера:</b> <?= htmlspecialchars($_SERVER['HTTP_USER_AGENT']) ?><br>
        <b>Назва скрипта:</b> <?= htmlspecialchars($_SERVER['PHP_SELF']) ?><br>
        <b>Метод запиту:</b> <span style="color: green;"><?= htmlspecialchars($_SERVER['REQUEST_METHOD']) ?></span><br>
        <b>Шлях до файлу на сервері:</b> <?= htmlspecialchars($_SERVER['SCRIPT_FILENAME']) ?>
    </div>
    
    <br>
    <a href="task3_form.php">Повернутися назад</a>
</body>
</html>