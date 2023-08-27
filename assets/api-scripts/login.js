// Function to decode JWT token and get user email
function getUserEmailFromToken(token) {
    try {
        const decodedToken = jwt_decode(token); // You'll need to include a JWT decoding library like jwt-decode
        return decodedToken.work_email; // Assuming 'work_email' is the key for the email in your token
    } catch (error) {
        console.error('Error decoding token:', error);
        return null;
    }
}

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

            // Store the token in localStorage for later use
            localStorage.setItem('token', token);

            // Get the user's email from the token
            const userEmail = getUserEmailFromToken(token);

            // Display the user's email (replace 'user-email-element' with the actual HTML element ID)
            document.getElementById('user-email-element').textContent = userEmail;

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
