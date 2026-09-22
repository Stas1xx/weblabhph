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
    public static $interestRate = 0.05;

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
    <title>Лабораторна 4 - ООП</title>
    <style> body { font-family: sans-serif; margin: 20px; line-height: 1.6; } .success { color: green; } .error { color: red; font-weight: bold; } .block { background: #f4f4f4; padding: 15px; margin-bottom: 10px; border-radius: 5px; } </style>
</head>
<body>
    <h2>Тестування банківської системи</h2>

    <div class="block">
        <h3>1. Тестування звичайного рахунку</h3>
        <?php
        try {
            $myAccount = new BankAccount(100, "USD");
            echo "Відкрито рахунок. Баланс: <b>" . $myAccount->getBalance() . "</b><br>";
            
            $myAccount->deposit(50);
            echo "<span class='success'>Поповнено на 50.</span> Новий баланс: <b>" . $myAccount->getBalance() . "</b><br>";
            
            $myAccount->withdraw(30);
            echo "<span class='success'>Знято 30.</span> Новий баланс: <b>" . $myAccount->getBalance() . "</b><br>";
            
            echo "<i>Спроба зняти 500 USD</i><br>";
            $myAccount->withdraw(500); 
            
        } catch (Exception $e) {
            echo "<span class='error'>" . $e->getMessage() . "</span><br>";
        }
        ?>
    </div>

    <div class="block">
        <h3>2. Тестування накопичувального рахунку</h3>
        <?php
        try {
            $saveAccount = new SavingsAccount(1000, "EUR");
            echo "Відкрито накопичувальний рахунок. Баланс: <b>" . $saveAccount->getBalance() . "</b><br>";
            
            $saveAccount->applyInterest();
            echo "<span class='success'>Нараховано відсотки (" . (SavingsAccount::$interestRate * 100) . "%).</span> Новий баланс: <b>" . $saveAccount->getBalance() . "</b><br>";

            echo "<i>Спроба поповнити на -50 EUR</i><br>";
            $saveAccount->deposit(-50);

        } catch (Exception $e) {
            echo "<span class='error'>" . $e->getMessage() . "</span><br>";
        }
        ?>
    </div>
</body>
</html>