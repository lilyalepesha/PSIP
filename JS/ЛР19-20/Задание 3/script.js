  // Сохранение данных в Local Storage
  function saveData(event) {
    event.preventDefault();

    const fullName = document.getElementById('fullName').value;
    const email = document.getElementById('email').value;
    const birthdate = document.getElementById('birthdate').value;
    const birthplace = document.getElementById('birthplace').value;
    const hobbies = document.getElementById('hobbies').value;

    const userData = {
      fullName,
      email,
      birthdate,
      birthplace,
      hobbies
    };

    localStorage.setItem('userData', JSON.stringify(userData));
    console.log('Data saved to Local Storage.');
  }

  // Получение данных из Local Storage
  function retrieveData() {
    const userData = JSON.parse(localStorage.getItem('userData'));
    if (userData) {
      console.log('Retrieved data:', userData);
    } else {
      console.log('No data found in Local Storage.');
    }
  }

  // Очистка содержимого Local Storage
  function clearLocalStorage() {
    localStorage.removeItem('userData');
    console.log('Local Storage cleared.');
  }