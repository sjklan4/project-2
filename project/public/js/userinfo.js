const today = new Date();
const birthDate = document.getElementById('user_birth'); 
const userage = document.getElementById('userage');
let age = today.getFullYear()
        - birthDate.getFullYear()
        + 1;

// document.userage(age);
userage.innerHTML = age;


