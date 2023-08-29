const userDetailsDiv = document.getElementById('user-details');

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
                'Authorization': `Bearer ${getCookie('access_token')}`
            }
        });

        
        if (response.ok) {
            const data = await response.json();
            console.log(data);
            userDetailsDiv.textContent = `Logged in as: ${data.first_name} ${data.last_name} who is apart of this comapny: ${data.company_name}`;
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

const accessToken = getCookie('access_token');
if (accessToken) {
    getUserDetails();
}