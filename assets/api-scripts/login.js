const loginForm = document.getElementById('login-form');
const logoutButton = document.getElementById('logout-btn');
const userDetailsDiv = document.getElementById('user-details');

loginForm.addEventListener('submit', async (event) => {
    event.preventDefault();
    
    const workEmail = document.getElementById('work_email').value;
    const password = document.getElementById('password').value;

    try {
        fetch('https://app-aarc-api.morganserver.com/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ work_email: workEmail, password: password }),
            credentials: 'include' // Include cookies with the request
        });


        if (response.ok) {
            const data = await response.json();
        
            // Instead of storing the token in localStorage, set it as an HTTP-only cookie
            setCookie('access_token', data.access_token, 7); // Replace '7' with your desired cookie expiration in days
        
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
                'Authorization': `Bearer ${getCookie('access_token')}`
            }
        });

        if (response.ok) {
            // Remove the access token cookie
            deleteCookie('access_token');

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
        const accessToken = getCookie('access_token');
        if (!accessToken) {
            console.error('Access token not found');
            return;
        }

        const response = await fetch('https://app-aarc-api.morganserver.com/user', {
            method: 'GET',
            headers: {
                'Authorization': `Bearer ${accessToken}`
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

function setCookie(name, value, days) {
    const date = new Date();
    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
    const expires = `expires=${date.toUTCString()}`;
    // const secure = location.protocol === 'https:' ? 'Secure;' : ''; // Add Secure attribute for HTTPS
    document.cookie = `${name}=${value};${expires};SameSite=Strict; Secure`;
    // document.cookie = "testCookie=testValue; SameSite=Strict; Secure";

}


// Function to delete a cookie
function deleteCookie(name) {
    document.cookie = `${name}=;expires=Thu, 01 Jan 1970 00:00:00 UTC;path=/;`;
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
