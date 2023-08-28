function checkLoginStatus() {
    console.log("Checking login status...");
    fetch('https://app-aarc-api.morganserver.com/api/check_login')
        .then(response => response.json())
        .then(data => {
            console.log("Received login status response:", data);
            if (data.loggedIn) {
                // User is logged in, retrieve additional session data if needed
                fetch('https://app-aarc-api.morganserver.com/api/profile', {
                    credentials: 'include'
                })
                .then(response => response.text())
                .then(profileText => {
                // Display the user's profile information on the frontend
                    document.getElementById('profile').textContent = profileText;
                });

            } else {
                // User is not logged in, display a message or redirect to the login page
                console.log("User is not logged in.");
                document.getElementById('profile').textContent = "You are not logged in.";
            }
        });
}
