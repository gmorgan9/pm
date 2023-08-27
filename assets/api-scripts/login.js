// Function to handle form submission
async function handleSubmit(event) {
    event.preventDefault();
    
    // Get form input values
    const work_email = document.getElementById('work_email').value;
    const password = document.getElementById('password').value;

    // Create an object to send as JSON data
    const data = {
        work_email,
        password
    };

    try {
        const response = await fetch('https://app-aarc-api.morganserver.com/api/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        });

        if (response.ok) {
            const result = await response.json();
            // Assuming the token is returned in the response
            const token = result.token;

            // You can store the token in localStorage or a cookie for later use
            localStorage.setItem('token', token);

            // Redirect or perform other actions as needed
            window.location.href = '/dashboard'; // Redirect to the dashboard
        } else {
            const errorData = await response.json();
            // Display the error message to the user
            document.getElementById('error-message').textContent = errorData.message;
        }
    } catch (error) {
        console.error('Error:', error);
    }
}

// Add an event listener to the form
const loginForm = document.getElementById('login-form');
loginForm.addEventListener('submit', handleSubmit);