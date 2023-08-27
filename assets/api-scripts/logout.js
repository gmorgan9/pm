document.getElementById('logout-link').addEventListener('click', function (event) {
    console.log('Logout link clicked'); // Add this line
    event.preventDefault();

        // Make a POST request to the logout endpoint
        fetch('https://api.morganserver.com/api/logout', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
    },
    body: JSON.stringify({ token: 'jhduHDJhfF94J9mdjaadf89dfajLJ' }),
})

        .then((response) => {
            if (response.ok) {
                // Handle successful logout, e.g., redirect to a login page
                window.location.href = 'https://app-aarc.morganserver.com/';
            } else {
                // Handle logout error, e.g., display an error message
                console.error('Logout request failed');
            }
        })
        .catch((error) => {
            console.error('An error occurred during logout', error);
        });
    });
