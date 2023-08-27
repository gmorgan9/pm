// Function to handle the form submission
document.getElementById('login-form').addEventListener('submit', function (e) {
    e.preventDefault();

    // Get form data
    const formData = new FormData(this);

    // Send a POST request to the login API endpoint
    fetch('https://app-aarc-api.morganserver.com/api/login', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.message === 'Login successful') {
            // Redirect the user or display a success message
            window.location.href = 'https://app-aarc.morganserver.com/dashboard'; // Change to your dashboard URL
        } else {
            // Display an error message
            alert('Login failed. Please check your credentials.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while logging in.');
    });
});