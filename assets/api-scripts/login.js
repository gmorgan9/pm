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

            // After the redirect, make a request to retrieve user data
            fetch('https://app-aarc-api.morganserver.com/api/userdata', {
                method: 'GET',
            })
            .then(response => response.json())
            .then(userData => {
                // Display user details in the div
                const userInfoDiv = document.getElementById('user-info');
                userInfoDiv.innerHTML = `
                    <p>User ID: ${userData.user_id}</p>
                    <p>Email: ${userData.work_email}</p>
                `;
            })
            .catch(error => {
                console.error('Error fetching user data:', error);
            });
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
