<?php
// 1. Использование оператора включения include
include 'task2.php';
include 'task3.php';

// 4. Работа с массивами
$array = [5, 8, 2, 10, 3];
$min = min($array);
echo "Минимальный элемент массива: $min <br>";

// 5. Работа со строками
$S1 = "Я люблю Беларусь";
$S2 = "Я учусь в Политехническом колледже";
echo "Длина строки S1: " . strlen($S1) . "<br>";
$S2 = str_replace("учусь", "", $S2);
echo "Строка S2 после удаления подстроки: $S2 <br>";
$S1 = str_replace("ю", "*", $S1);
echo "Строка S1 после замены букв: $S1 <br>";

// 6. Пользовательская функция
function customFunction($x, $y)
{
    $f = (cos($x) - sin($y)) ** 3 / sqrt($x ** 2 + 1) + log($x * $y) ** 2;
    return $f;
}

$x = 0.5;
$y = 1.2;
$result = customFunction($x, $y);
echo "Результат выполнения пользовательской функции при x=$x и y=$y: $result <br>";