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
            
            // Instead of storing the token in localStorage, set it as a cookie
            document.cookie = `access_token=${data.access_token}; path=/;`;

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
                'Authorization': `Bearer ${getCookie('access_token')}` // Retrieve the token from cookies
            }
        });

        if (response.ok) {
            // Remove the access token cookie
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
        const accessToken = getCookie('access_token'); // Retrieve the token from cookies
        if (!accessToken) {
            console.error('Access token not found');
            return;
        }

        const response = await fetch('https://app-aarc-api.morganserver.com/user', {
            method: 'GET',
            headers: {
                'Authorization': `Bearer ${accessToken}` // Use the retrieved token
            }
        });

        if (response.ok) {
            const data = await response.json();
            userDetailsDiv.textContent = `Logged in as: ${data.work_email}`;
        } else {
            console.error('Fetching user details failed - login.js');
        }
    } catch (error) {
        console.error('An error occurred:', error);
    }
}


// Function to retrieve a specific cookie by name
function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
}

// Check if an access token cookie exists and fetch user details on page load
const accessToken = getCookie('access_token');
if (accessToken) {
    loginForm.style.display = 'none';
    logoutButton.style.display = 'block';
    getUserDetails();
}
