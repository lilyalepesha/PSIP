<?php
header('Content-Type: text/html; charset=UTF-8');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Форма</title>
</head>
<body>
<form action="обработчик.php" method="post">
    <span>Нажмите "Сброс" и заполните заказ</span>
    <br>
    <input type="reset" value="Сбросить">
    <br><br>
    <label for="name">Ваше имя:</label><br>
    <input type="text" id="name" name="name"><br>
    <label for="address">Ваш адрес:</label><br>
    <input type="text" id="address" name="address"><br>
    <label for="send">Прислать:</label><br>
    <input type="text" id="send" name="send"><br><br>
    <input type="submit" value="Послать заказ">
    <button type="button" onclick="location.href='database.php';">Выполнить скрипт 4 задания</button>
</form>
</body>
</html>
