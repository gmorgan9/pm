document.addEventListener('DOMContentLoaded', function () {
    // Check if an access token exists
    const accessToken = getCookie('access_token');

    if (!accessToken) {
        // Redirect the user to the login page
        window.location.href = 'https://app-aarc.morganserver.com/';
    }

    // Function to retrieve a specific cookie by name
    function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';').shift();
    }
});
