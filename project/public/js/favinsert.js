window.addEventListener('DOMContentLoaded', (event) => {
    const favbuttons = document.querySelectorAll('.favdietname');

    favbuttons.forEach(function(favbutton) {
        favbutton.addEventListener('click', function() {
            const greenBtn = document.getElementById('greenBtn');
            if (greenBtn) {
                greenBtn.disabled = false;
            }
        });
    });
});


window.addEventListener('DOMContentLoaded', (event) => {
    const dietname = document.querySelector('.dietname');

    dietname.addEventListener('click', function(event) {
        if (event.target.classList.contains('favdietname')) {
            const greenBtn = document.getElementById('greenBtn');
            if (greenBtn) {
                greenBtn.disabled = false;
            }
        }
    });
});