<?php
session_start();

// Выводим имя и значение идентификатора сессии
echo "Имя сессии: " . session_name() . "<br>";
echo "Значение сессии: " . session_id();
?>
