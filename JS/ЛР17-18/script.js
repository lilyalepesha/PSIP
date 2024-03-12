// Валидация через атрибуты HTML5
function validateHtml5Form() {
    var htmlValidationResultElement = document.getElementById('htmlValidationResult');
    // Дополнительная валидация может быть добавлена здесь при необходимости

    // Пример использования метода String.match с регулярным выражением
    var username = document.getElementById('username').value;
    var matchedWords = username.match(/\b\w+\b/g);
    htmlValidationResultElement.innerHTML = 'Слова в имени пользователя: ' + (matchedWords ? matchedWords.join(', ') : 'нет');

    return true; // Вернуть true для отправки формы, false для предотвращения отправки
}

// Валидация через JavaScript и регулярные выражения
function validateJsForm() {
    var jsValidationResultElement = document.getElementById('jsValidationResult');
    var username = document.getElementById('jsUsername').value;
    var email = document.getElementById('jsEmail').value;
    var password = document.getElementById('jsPassword').value;

    // Провести проверки валидации
    if (username === '' || email === '' || password === '') {
        jsValidationResultElement.innerHTML = 'Все поля должны быть заполнены';
        return false;
    }

    // Пример: Валидация email с использованием регулярного выражения
    var emailRegex = /^\S+@\S+\.\S+$/;
    if (!emailRegex.test(email)) {
        jsValidationResultElement.innerHTML = 'Пожалуйста, введите корректный адрес электронной почты';
        return false;
    }

    // Пример использования метода String.match с регулярным выражением
    var matchedWords = username.match(/\b\w+\b/g);
    jsValidationResultElement.innerHTML = 'Слова в имени пользователя: ' + (matchedWords ? matchedWords.join(', ') : 'нет');

    // Пример использования метода String.replace с регулярным выражением
    var sanitizedPassword = password.replace(/[^a-zA-Z0-9]/g, '*');
    jsValidationResultElement.innerHTML += '<br>Санитарный пароль: ' + sanitizedPassword;

    // Дополнительная логика валидации может быть добавлена здесь при необходимости

    return true; // Вернуть true для отправки формы, false для предотвращения отправки
}
