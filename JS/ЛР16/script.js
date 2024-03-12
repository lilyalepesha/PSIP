function submitForm() {
    // Извлекаем данные из формы
    var name = document.getElementById("name").value;
    var programmingLanguage = document.getElementById("programmingLanguage").value;

    var level;
    var levelOptions = document.getElementsByName("level");
    for (var i = 0; i < levelOptions.length; i++) {
        if (levelOptions[i].checked) {
            level = levelOptions[i].value;
            break;
        }
    }

    var topics = [];
    var topicsOptions = document.getElementsByName("topics");
    for (var i = 0; i < topicsOptions.length; i++) {
        if (topicsOptions[i].checked) {
            topics.push(topicsOptions[i].value);
        }
    }

    // Выводим данные на страницу или в диалоговое окно
    var message = "Имя: " + name + "\nЯзык программирования: " + programmingLanguage + "\nУровень: " + level + "\nТемы: " + topics.join(", ");

    alert(message);
}
