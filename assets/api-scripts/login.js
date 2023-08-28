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

            // Set the access token as an HttpOnly cookie
            document.cookie = `access_token=${data.access_token}; path=/; HttpOnly; SameSite=Strict`;

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
        // Send a request to the logout endpoint
        const response = await fetch('https://app-aarc-api.morganserver.com/logout', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            }
        });

        if (response.ok) {
            // Delete the access token cookie
            document.cookie = 'access_token=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
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
        // Send a request to the user endpoint
        const response = await fetch('https://app-aarc-api.morganserver.com/user', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
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
const accessToken = getCookie('access_token');
if (accessToken) {
    loginForm.style.display = 'none';
    logoutButton.style.display = 'block';
    getUserDetails();
}

// Function to get a cookie value by name
function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
}
