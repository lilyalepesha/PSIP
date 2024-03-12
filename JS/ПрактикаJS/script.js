
function submitForm() {
    var formData = {
        name: document.getElementById("name").value,
        email: document.getElementById("email").value,
        delivery: document.getElementById("delivery").value,
        phone: document.getElementById("phone").value,
        productId: document.getElementById("productId").value,
        message: document.getElementsByName("message")[0].value,
        captcha: document.getElementById("captcha").value
    };

    // Валидация полей
    if (!validateForm()) {
        alert("Пожалуйста, заполните все поля корректно.");
        return;
    }

    // Вывод на текущую страницу
    for (var key in formData) {
        document.write(key + ": " + formData[key] + "<br>");
    }

    // Запись в Local Storage
    try {
        localStorage.setItem("formData", JSON.stringify(formData));
        console.log("Данные успешно сохранены в Local Storage");
    } catch (e) {
        console.error("Ошибка при сохранении данных в Local Storage:", e);
    }

    

    // Вывод из Local Storage
    var storedData = JSON.parse(localStorage.getItem("formData"));
    for (var key in storedData) {
        document.write(key + " from Local Storage: " + storedData[key] + "<br>");
    }

    // Сохранение в JSON-формате
    var jsonData = JSON.stringify(formData);
    console.log("JSON Data:", jsonData);
}

function validateForm() {
    var phonePattern = /^[0-9+-]+$/;
    var productIdPattern = /^[A-Za-z0-9]+$/;

    var name = document.getElementById("name").value;
    var email = document.getElementById("email").value;
    var delivery = document.getElementById("delivery").value;
    var phone = document.getElementById("phone").value;
    var productId = document.getElementById("productId").value;
    var captcha = document.getElementById("captcha").value;

    if (!name.match(/[A-Za-zА-Яа-яЁё\s]+/)) {
        return false;
    }

    if (!email.match(/^\S+@\S+\.\S+$/)) {
        return false;
    }

    if (!phone.match(phonePattern)) {
        return false;
    }

    if (!productId.match(productIdPattern)) {
        return false;
    }

    if (!captcha.match(/^[0-9]+$/)) {
        return false;
    }

    return true;
}
