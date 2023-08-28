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
            body: JSON.stringify({ work_email: workEmail, password: password })
        });

        if (response.ok) {
            const data = await response.json();
            localStorage.setItem('access_token', data.access_token);
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
            headers: {
                'Authorization': `Bearer ${localStorage.getItem('access_token')}`
            }
        });

        if (response.ok) {
            localStorage.removeItem('access_token');
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
            headers: {
                'Authorization': `Bearer ${localStorage.getItem('access_token')}`
            }
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
const accessToken = localStorage.getItem('access_token');
if (accessToken) {
    loginForm.style.display = 'none';
    logoutButton.style.display = 'block';
    getUserDetails();
}