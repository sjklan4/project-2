document.addEventListener('DOMContentLoaded', function() {
    let findEmailButton = document.getElementById('findEmail');
    let findPasswordButton = document.getElementById('findpassword');
    let findEmailDiv = document.querySelector('.findemail');
    let findPasswordDiv = document.querySelector('.findpsw');

    findEmailButton.addEventListener('click', function() {
        findEmailDiv.style.display = 'block';
        findPasswordDiv.style.display = 'none';
    });

    findPasswordButton.addEventListener('click', function() {
        findPasswordDiv.style.display = 'block';
        findEmailDiv.style.display = 'none';
    });
});