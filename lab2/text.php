<?php
$logFile = 'log.txt';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['log_text'])) {
    $textToSave = date('Y-m-d H:i:s') . " - " . $_POST['log_text'] . PHP_EOL;
    file_put_contents($logFile, $textToSave, FILE_APPEND);
    echo "<p style='color:green;'>Текст успішно збережено!</p>";
}

echo "<h3>Вміст файлу log.txt:</h3>";

if (file_exists($logFile)) {
    $content = file_get_contents($logFile);
    echo "<div style='background:#f4f4f4; padding:15px; border:1px solid #ccc;'>";
    echo nl2br(htmlspecialchars($content));
    echo "</div>";
} else {
    echo "<p>Файл log.txt ще порожній.</p>";
}

echo "<br><a href='index.html'>Повернутися до форм</a>";
?>