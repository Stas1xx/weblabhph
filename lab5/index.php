<?php
interface AccountInterface {
    public function deposit($amount);
    public function withdraw($amount);
    public function getBalance();
}

class BankAccount implements AccountInterface {
    const MIN_BALANCE = 0;
    
    protected $balance;
    protected $currency;

    public function __construct($initialBalance = 0, $currency = "USD") {
        $this->balance = $initialBalance;
        $this->currency = $currency;
    }

    public function deposit($amount) {
        if ($amount <= 0) {
            throw new Exception("Помилка: Сума поповнення має бути більшою за нуль.");
        }
        $this->balance += $amount;
    }

    public function withdraw($amount) {
        if ($amount <= 0) {
            throw new Exception("Помилка: Сума зняття має бути більшою за нуль.");
        }
        if (($this->balance - $amount) < self::MIN_BALANCE) {
            throw new Exception("Недостатньо коштів");
        }
        $this->balance -= $amount;
    }

    public function getBalance() {
        return $this->balance . " " . $this->currency;
    }
}

class SavingsAccount extends BankAccount {
    public static $interestRate = 0.07;

    public function applyInterest() {
        $interest = $this->balance * self::$interestRate;
        $this->balance += $interest;
    }
}

?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: sans-serif; margin: 20px; line-height: 1.6; }
        .success { color: green; }
        .error { color: red; font-weight: bold; }
        .block { background: #f9f9f9; padding: 15px; margin-bottom: 15px; border-left: 4px solid #007bff; border-radius: 4px; }
    </style>
</head>
<body>
    <h2>№5</h2>

    <div class="block">
        <h3>Тестування класу BankAccount</h3>
        <?php
        try {
            $account = new BankAccount(200, "USD");
            echo "Створено рахунок. Баланс: <b>" . $account->getBalance() . "</b><br>";
            
            $account->deposit(100);
            echo "<span class='success'>Поповнено на 100 USD.</span> Баланс: <b>" . $account->getBalance() . "</b><br>";
            
            $account->withdraw(50);
            echo "<span class='success'>Знято 50 USD.</span> Баланс: <b>" . $account->getBalance() . "</b><br>";
            
            echo "<i>Спроба зняти 1000 USD (перевірка винятку)...</i><br>";
            $account->withdraw(1000);

        } catch (Exception $e) {
            echo "<span class='error'>Виняток перехоплено: " . $e->getMessage() . "</span><br>";
        }
        ?>
    </div>

    <div class="block">
        <h3>Тестування класу SavingsAccount</h3>
        <?php
        try {
            $savings = new SavingsAccount(1500, "EUR");
            echo "Створено накопичувальний рахунок. Баланс: <b>" . $savings->getBalance() . "</b><br>";
            
            $savings->applyInterest();
            echo "<span class='success'>Нараховано відсотки (" . (SavingsAccount::$interestRate * 100) . "%).</span> Баланс: <b>" . $savings->getBalance() . "</b><br>";

            echo "<i>Спроба передати некоректну (від'ємну) суму поповнення...</i><br>";
            $savings->deposit(-200);

        } catch (Exception $e) {
            echo "<span class='error'>Виняток перехоплено: " . $e->getMessage() . "</span><br>";
        }
        ?>
    </div>
</body>
</html>