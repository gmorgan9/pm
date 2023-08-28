// app.js
const loginForm = document.getElementById('login-form');
const logoutButton = document.getElementById('logout-btn');
const userDetailsDiv = document.getElementById('user-details');

loginForm.addEventListener('submit', async (event) => {
    event.preventDefault();
    
    const workEmail = document.getElementById('work_email').value;
    const password = document.getElementById('password').value;

    try {
        const response = await fetch('https://app-aarc-api.morganserver.com/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            credentials: 'include', // Include credentials (cookies)
            mode: 'same-origin',    // Ensure same-origin requests
            body: JSON.stringify({ work_email: workEmail, password: password })
        });

        if (response.ok) {
            loginForm.style.display = 'none';
            logoutButton.style.display = 'block';
            getUserDetails();
        } else {
            console.error('Login failed');
        }
    } catch (error) {
        console.error('An error occurred:', error);
    }
});

logoutButton.addEventListener('click', async () => {
    try {
        const response = await fetch('https://app-aarc-api.morganserver.com/logout', {
            method: 'POST',
            credentials: 'include', // Include credentials (cookies)
            mode: 'same-origin'     // Ensure same-origin requests
        });

        if (response.ok) {
            loginForm.style.display = 'block';
            logoutButton.style.display = 'none';
            userDetailsDiv.textContent = '';
        } else {
            console.error('Logout failed');
        }
    } catch (error) {
        console.error('An error occurred:', error);
    }
});

async function getUserDetails() {
    try {
        const response = await fetch('https://app-aarc-api.morganserver.com/user', {
            method: 'GET',
            credentials: 'include', // Include credentials (cookies)
            mode: 'same-origin'     // Ensure same-origin requests
        });

        if (response.ok) {
            const data = await response.json();
            userDetailsDiv.textContent = `Logged in as: ${data.work_email}`;
        } else {
            console.error('Fetching user details failed');
        }
    } catch (error) {
        console.error('An error occurred:', error);
    }
}

// Check if a JWT token exists and fetch user details on page load
getUserDetails();
