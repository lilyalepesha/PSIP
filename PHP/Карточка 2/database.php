<?php
// Подключение к базе данных (замените значения на ваши)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Прокат_товаров";

// Создание подключения
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



// Запрос на редактирование данных
$sql_edit = "UPDATE Прокат_товара SET Стоимость_проката_на_сутки = 5 WHERE Стоимость_проката_на_сутки = 3";

if ($conn->query($sql_edit) === TRUE) {
    echo "Данные успешно отредактированы";
} else {
    echo "Ошибка при редактировании данных: " . $conn->error;
}
// Запрос на получение данных из таблицы после редактирования
$sql_select = "SELECT * FROM `Прокат_товара`";

$result = $conn->query($sql_select);

// Вывод данных на страницу
if ($result->num_rows > 0) {
    echo "<table><tr><th>Фамилия</th><th>Серия и номер паспорта клиента</th><th>Домашний адрес клиента</th><th>Наименование товара</th><th>Дата выдачи</th><th>Дата возврата</th><th>Стоимость проката за сутки</th></tr>";
    // Вывод данных каждой строки
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["Фамилия"] . "</td><td>" . $row["Серия_и_номер_паспорта_клиента"] . "</td><td>" . $row["Домашний_адрес_клиента"] . "</td><td>" . $row["Наименование_товара"] . "</td><td>" . $row["Дата_выдачи"] . "</td><td>" . $row["Дата_возврата"] . "</td><td>" . $row["Стоимость_проката_на_сутки"] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 результатов";
}
// Закрытие соединения с базой данных
$conn->close();
