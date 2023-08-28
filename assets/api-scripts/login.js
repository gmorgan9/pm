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
            setAccessTokenCookie(data.access_token);
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
                'Authorization': `Bearer ${getAccessTokenCookie()}`
            }
        });

        if (response.ok) {
            deleteAccessTokenCookie();
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
                'Authorization': `Bearer ${getAccessTokenCookie()}`
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

function setAccessTokenCookie(token) {
    document.cookie = `access_token=${token}; path=/; secure; HttpOnly`;
}

function getAccessTokenCookie() {
    const cookies = document.cookie.split('; ');
    for (const cookie of cookies) {
        const [name, value] = cookie.split('=');
        if (name === 'access_token') {
            return value;
        }
    }
    return null;
}

function deleteAccessTokenCookie() {
    document.cookie = 'access_token=; path=/; expires=Thu, 01 Jan 1970 00:00:00 UTC; secure; HttpOnly';
}

// Check if a JWT token exists and fetch user details on page load
const accessToken = getAccessTokenCookie();
if (accessToken) {
    loginForm.style.display = 'none';
    logoutButton.style.display = 'block';
    getUserDetails();
}
