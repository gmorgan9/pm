// Attach an event listener to the form with the ID 'login-form'
document.getElementById('login-form').addEventListener('submit', handleLogin);

async function handleLogin(event) {
  event.preventDefault();

  // Capture form data
  const formData = new FormData(event.target);
  const work_email = formData.get('work_email');
  const password = formData.get('password');

  try {
    // Send a POST request to the login endpoint
    const response = await fetch('https://api.morganserver.com/api/login', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ work_email, password }),
    });

    // Check if the response status indicates success (status codes 200-299)
    if (response.ok) {
      // Parse the JSON response data
      const data = await response.json();

      if (data.success) {
        // Login was successful, you can redirect or update the UI here.
        console.log('Login successful');
      } else {
        // Display an error message to the user.
        const errorMessage = document.getElementById('error-message');
        errorMessage.textContent = data.message;
      }
    } else {
      // Handle non-successful response (e.g., server error)
      console.error('Login request failed');
    }
  } catch (error) {
    // Handle JavaScript or network errors
    console.error('An error occurred during login', error);
  }
}
