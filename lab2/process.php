<?php
$uploadDir = 'uploads/';

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['uploaded_file'])) {
    $file = $_FILES['uploaded_file'];
    
    if (is_uploaded_file($file['tmp_name'])) {
        
        $fileName = $file['name'];
        $fileSize = $file['size'];
        $fileType = $file['type'];
        $fileTmp = $file['tmp_name'];
        
        $allowedExtensions = ['jpg', 'jpeg', 'png'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        
        if (!in_array($fileExtension, $allowedExtensions)) {
            die("<b>Помилка:</b> Дозволено завантажувати лише зображення (png, jpg, jpeg). <a href='index.html'>Назад</a>");
        }
        
        if ($fileSize > 2097152) { 
            die("<b>Помилка:</b> Розмір файлу не повинен перевищувати 2 МБ. <a href='index.html'>Назад</a>");
        }
        
        $targetFilePath = $uploadDir . $fileName;
        if (file_exists($targetFilePath)) {
            $fileName = time() . '_' . $fileName;
            $targetFilePath = $uploadDir . $fileName;
            echo "<p style='color:orange;'>Файл з таким іменем вже існував. Автоматично перейменовано на: $fileName</p>";
        }
        
        if (move_uploaded_file($fileTmp, $targetFilePath)) {
            echo "<h3 style='color:green;'>Файл успішно завантажено!</h3>";
            
            echo "<p><strong>Ім'я файлу:</strong> $fileName</p>";
            echo "<p><strong>Тип файлу:</strong> $fileType</p>";
            echo "<p><strong>Розмір:</strong> " . round($fileSize / 1024, 2) . " КБ</p>";
            
            echo "<p><a href='$targetFilePath' download>Завантажити файл назад</a></p>";
            echo "<p><a href='index.html'>Повернутися до форм</a></p>";
        } else {
            echo "Помилка при збереженні файлу.";
        }
    } else {
        echo "Помилка завантаження файлу на сервер.";
    }
}
?>