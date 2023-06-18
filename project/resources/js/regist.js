document.getElementById('chdeckEmail').addEventListener('click', function(e) {
    e.preventDefault();

    const email = document.getElementById('user_email').value;
    const signupButton = document.querySelector('input[type=submit]');

    fetch('/user/registdup', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ user_email: email })
    })
    .then(response => response.json())
    .then(data => {
        if(data.exists){
            alert('Email already exists.');
        } else {
            alert('Email is available.');
            signupButton.disabled = false;
        }
    })
    .catch((error) => {
        console.error('Error:', error);
    });
});





document.getElementById('button1').addEventListener('click', function() {
    // Enable Button 2 when Button 1 is clicked
    document.getElementById('button2').disabled = false;
});

document.getElementById('button2').addEventListener('click', function(event) {
    // Check if Button 2 is enabled
    if (!this.disabled) {
        // Perform the desired action for Button 2 when it is clicked
        alert('Button 2 was clicked!');
    } else {
        event.preventDefault(); // Prevent the default action of Button 2 if it's disabled
    }
});
