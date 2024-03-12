<?php

header('Content-Type: text/html; charset=UTF-8');
session_start();

// Получаем данные из формы
$name = $_POST['name'];
$address = $_POST['address'];
$send = $_POST['send'];

// Сохраняем данные в сессионных переменных
$_SESSION['user_address'] = $address;
$_SESSION['send_to'] = $send;

// Передаем данные на страницу 2
header("Location: ССтраница2.php <br>");

// Получаем данные из формы
$name = $_POST['name'];
$address = $_POST['address'];

// Записываем данные в файл
$file = fopen("fio.txt", "w");
if ($file) {
    fwrite($file, "Имя: " . $name . "\n");
    fwrite($file, "Адрес: " . $address);
    fclose($file);
    echo "Данные успешно записаны в файл!";
} else {
    echo "Ошибка при открытии файла для записи!";
}

// Выводим имя и значение идентификатора сессии
echo "<br>"."Имя сессии: " . session_name() . "<br>";
echo "Значение сессии: " . session_id();

echo  "<br>". $_SESSION['user_address'] . "<br>";
echo $_SESSION['send_to'] . "<br>";

