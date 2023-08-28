document.getElementById('login-form').addEventListener('submit', function (e) {
    e.preventDefault(); // Prevent the default form submission

    // Get the form input values
    const workEmail = document.getElementById('work_email').value;
    const password = document.getElementById('password').value;

    // Create an object with the login data
    const loginData = {
        work_email: workEmail,
        password: password
    };

    // Send a POST request to the /api/login endpoint
    fetch('https://app-aarc-api.morganserver.com/api/login', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(loginData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.message === 'Login successful') {
            // Store the JWT token in local storage
            localStorage.setItem('jwt', data.accessToken);

            // Redirect to the user's dashboard or perform other actions on successful login
            window.location.href = '/dashboard/';
        } else {
            // Display an error message
            document.getElementById('error-message').textContent = 'Invalid credentials';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        // Handle any network or other errors here
    });
});
