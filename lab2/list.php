<?php
$uploadDir = 'uploads/';

echo "<h2>Список завантажених файлів</h2>";

if (is_dir($uploadDir)) {
    $files = scandir($uploadDir);
    $hasFiles = false;

    echo "<ul>";
    foreach ($files as $file) {
        if ($file !== '.' && $file !== '..' && $file !== '.DS_Store') {
            $hasFiles = true;
            
            echo "<li><a href='" . $uploadDir . $file . "' download>" . htmlspecialchars($file) . "</a></li>";
        }
    }
    echo "</ul>";

    if (!$hasFiles) {
        echo "<p>Папка uploads наразі порожня.</p>";
    }
} else {
    echo "<p>Директорія uploads ще не створена (ви ще не завантажували файли).</p>";
}

echo "<br><a href='index.html'>Повернутися до форм</a>";
?>