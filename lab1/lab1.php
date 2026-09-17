<?php
echo "Hello, World!<br>"; 

$stringVar = "Текст";
$intVar = 10;
$floatVar = 3.14;
$boolVar = true;

echo $stringVar . ", " . $intVar . ", " . $floatVar . ", " . $boolVar . "<br>";

var_dump($stringVar);
var_dump($intVar);
var_dump($floatVar);
var_dump($boolVar);
echo "<br>";

$str1 = "Привіт, ";
$str2 = "світ!";
echo $str1 . $str2 . "<br>";

$num = 4;
if ($num % 2 == 0) {
    echo "Число $num парне<br>";
} else {
    echo "Число $num непарне<br>";
}

for ($i = 1; $i <= 10; $i++) {
    echo $i . " ";
}
echo "<br>";

$j = 10;
while ($j >= 1) {
    echo $j . " ";
    $j--;
}
echo "<br>";

$student = [
    "ім'я" => "Станіслав",
    "прізвище" => "Іванченко",
    "вік" => 19,
    "спеціальність" => "Комп'ютерні науки"
];
foreach ($student as $key => $value) {
    echo $key . ": " . $value . "<br>";
}
$student["середній_бал"] = 92.5;
var_dump($student);
?>