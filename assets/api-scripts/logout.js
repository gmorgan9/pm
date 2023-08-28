const logoutButton = document.getElementById('logout-link');

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

        } else {
            console.error('Logout failed');
        }
    } catch (error) {
        console.error('An error occurred:', error);
    }
});