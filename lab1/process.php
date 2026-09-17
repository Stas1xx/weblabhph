<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = trim($_POST["firstname"]);
    $lastname = trim($_POST["lastname"]);

    if (empty($firstname) || empty($lastname)) {
        echo "Помилка: Всі поля повинні бути заповнені!";
    } else {
        echo "Привіт, " . htmlspecialchars($firstname) . " " . htmlspecialchars($lastname) . "!";
    }
}
?>