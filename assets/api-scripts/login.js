document.getElementById('login-form').addEventListener('submit', handleLogin);

async function handleLogin(event) {
    event.preventDefault();

    const form = event.target;
    const formData = new FormData(form);
    const work_email = formData.get('work_email');
    const password = formData.get('password');

    try {
        const loginData = { work_email, password };

        const response = await fetch('https://api.morganserver.com/api/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(loginData),
        });

        if (response.ok) {
            const data = await response.json();

            if (data.success) {
                console.log('Login successful-client'); // Add this line
                // Redirect to the dashboard page upon successful login
                // window.location.href = 'https://app-aarc.morganserver.com/dashboard/';
                console.log('Redirecting...'); // Add this line
            } else {
                // Display an error message to the user.
                const errorMessage = document.getElementById('error-message');
                errorMessage.textContent = data.message;
            }
            
        } else {
            console.error('Login request failed');
        }
    } catch (error) {
        console.error('An error occurred during login', error);
    }
}
