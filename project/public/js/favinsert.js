// window.addEventListener('DOMContentLoaded', (event) => {
//     const favbuttons = document.querySelectorAll('.favdietname');

//     favbuttons.forEach(function(favbutton) {
//         favbutton.addEventListener('click', function() {
//             const greenBtn = document.getElementById('greenBtn');
//             if (greenBtn) {
//                 greenBtn.disabled = false;
//             }
//         });
//     });
// });


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


window.addEventListener('DOMContentLoaded', (event) => {
    const dietname = document.querySelector('.dietname');
    const greenBtn = document.getElementById('greenBtn');

    // Check if we have a saved state
    if (localStorage.getItem('buttonActive') === 'true') {
        greenBtn.disabled = false;
    }

    dietname.addEventListener('click', function(event) {
        if (event.target.classList.contains('favdietname')) {
            // Save the state
            localStorage.setItem('buttonActive', 'true');

            if (greenBtn) {
                greenBtn.disabled = false;
            }
        }
    });
});