// Function to fetch user information
async function getUserInfo() {
    try {
        const response = await fetch('https://app-aarc-api.morganserver.com/api/user');
        if (response.ok) {
            const user = await response.json();
            // Display user information on the page
            document.getElementById('user-info').textContent = `Logged in as: ${user.work_email}`;
        } else {
            console.error('Error fetching user information');
        }
    } catch (error) {
        console.error('An error occurred:', error);
    }
}

// Call the function when the page loads
window.onload = getUserInfo;