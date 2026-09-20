<?php
session_start();

$timeout_duration = 300;
$timeout_msg = "";

if (isset($_SESSION['last_activity'])) {
    if (time() - $_SESSION['last_activity'] > $timeout_duration) {
        session_unset();     
        session_destroy();   
        session_start();     
        $timeout_msg = "Ваша сесія закінчилася через неактивність. Корзину очищено.";
    }
}
$_SESSION['last_activity'] = time();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_to_cart'])) {
    $_SESSION['cart'][] = htmlspecialchars($_POST['item']);
    header("Location: task4_cart.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['checkout'])) {
    if (!empty($_SESSION['cart'])) {
        $history = isset($_COOKIE['previous_purchases']) ? json_decode($_COOKIE['previous_purchases'], true) : [];
        
        $history = array_merge($history, $_SESSION['cart']);
        
        setcookie('previous_purchases', json_encode($history), time() + (30 * 24 * 60 * 60), "/");
        
        $_SESSION['cart'] = [];
        header("Location: task4_cart.php");
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['clear_history'])) {
    setcookie('previous_purchases', '', time() - 3600, "/");
    header("Location: task4_cart.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
</head>
<body style="font-family: sans-serif; margin: 20px;">
    <h2>4. Корзина покупок  $_SESSION, $_COOKIE</h2>

    <?php if ($timeout_msg): ?>
        <p style="color: red; font-weight: bold;"><?= $timeout_msg ?></p>
    <?php endif; ?>

    <div style="display: flex; gap: 40px;">
        <div>
            <h3>Список товарів</h3>
            <form method="POST">
                <input type="hidden" name="item" value="Ноутбук">
                <input type="submit" name="add_to_cart" value="Купити Ноутбук">
            </form><br>
            <form method="POST">
                <input type="hidden" name="item" value="Смартфон">
                <input type="submit" name="add_to_cart" value="Купити Смартфон">
            </form><br>
            <form method="POST">
                <input type="hidden" name="item" value="Навушники">
                <input type="submit" name="add_to_cart" value="Купити Навушники">
            </form>
        </div>

        <div style="background: #e8f5e9; padding: 15px; border-radius: 8px; min-width: 200px;">
            <h3 style="margin-top: 0;">Корзина</h3>
            <?php if (empty($_SESSION['cart'])): ?>
                <p>Корзина порожня.</p>
            <?php else: ?>
                <ul>
                    <?php foreach ($_SESSION['cart'] as $product): ?>
                        <li><?= $product ?></li>
                    <?php endforeach; ?>
                </ul>
                <form method="POST">
                    <input type="submit" name="checkout" value="Оформити замовлення" style="background: green; color: white; padding: 5px 10px; border: none; border-radius: 3px; cursor: pointer;">
                </form>
            <?php endif; ?>
        </div>

        <div style="background: #e3f2fd; padding: 15px; border-radius: 8px; min-width: 200px;">
            <h3 style="margin-top: 0;">Минулі покупки</h3>
            <?php
            if (isset($_COOKIE['previous_purchases'])) {
                $history = json_decode($_COOKIE['previous_purchases'], true);
                if (!empty($history)) {
                    echo "<ul>";
                    foreach ($history as $past_item) {
                        echo "<li>" . htmlspecialchars($past_item) . "</li>";
                    }
                    echo "</ul>";
                    echo '<form method="POST"><input type="submit" name="clear_history" value="Очистити історію"></form>';
                } else {
                    echo "<p>Ви ще нічого не купували.</p>";
                }
            } else {
                echo "<p>Ви ще нічого не купували.</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>