document.addEventListener('DOMContentLoaded', function() {
    var findEmailButton = document.getElementById('findEmail');
    var findPasswordButton = document.getElementById('findpassword');
    var findEmailDiv = document.querySelector('.findemail');
    var findPasswordDiv = document.querySelector('.findpsw');

    findEmailButton.addEventListener('click', function() {
        findEmailDiv.style.display = 'block';
        findPasswordDiv.style.display = 'none';
    });

    findPasswordButton.addEventListener('click', function() {
        findPasswordDiv.style.display = 'block';
        findEmailDiv.style.display = 'none';
    });
});