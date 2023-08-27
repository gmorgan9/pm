// Function to handle form submission
document.getElementById('login-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the form from submitting normally

    // Get form values
    const workEmail = document.getElementById('work_email').value;
    const password = document.getElementById('password').value;
    const csrfToken = document.querySelector('[name=csrf_token]').value;

    // Create a data object to send in the request
    const data = {
        work_email: workEmail,
        password: password,
        csrf_token: csrfToken
    };

    // Send a POST request to your Flask API
    fetch('https://app-aarc-api.morganserver.com/api/login', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
    })
    .then(response => response.json())
    .then(data => {
        if (data.message === 'Login successful') {
            // Redirect or perform other actions on successful login
            window.location.href = '/dashboard'; // Replace with the URL of your dashboard
        } else {
            // Display error message
            document.getElementById('error-message').textContent = data.message;
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});