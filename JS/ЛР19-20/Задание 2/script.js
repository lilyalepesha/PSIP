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

function retrieveData() {
  const userDataString = localStorage.getItem('userData');
  if (userDataString) {
    const userData = JSON.parse(userDataString);
    console.log('Retrieved data:', userData);
  } else {
    console.log('No data found in Local Storage.');
  }
}