document.getElementById('logout-link').addEventListener('click', function (e) {
    e.preventDefault();

    // Assuming you have some way to identify the logged-in user
    // In this example, let's assume you have a user_id variable
    const user_id = getUserId(); // You need to implement getUserId() to get the user's ID

    // Send a POST request to the logout endpoint
    fetch('https://app-aarc-api.morganserver.com/api/logout', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded', // Set the content type
        },
        body: `user_id=${user_id}`, // Send the user_id in the request body
    })
    .then(response => response.json())
    .then(data => {
        if (data.message === 'Logout successful') {
            // Redirect the user to the login page or perform any other desired action
            window.location.href = 'https://app-aarc.morganserver.com/'; // Change to your login page URL
        } else {
            // Handle logout failure
            alert('Logout failed. Please try again.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while logging out.');
    });
});

// Function to get the user's ID (you need to implement this)
function getUserId() {
    // Implement a way to retrieve the user's ID here
    // This could be from a session, JWT, or any other method
    // For example, if you have a session-based authentication:
    // return sessionStorage.getItem('user_id');
    // or if you're using JWT tokens:
    // return decodeJwtToken().user_id;
}