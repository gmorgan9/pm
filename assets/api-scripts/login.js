// Attach an event listener to the form with the ID 'login-form'
document.getElementById('login-form').addEventListener('submit', handleLogin);

async function handleLogin(event) {
  event.preventDefault();

  const formData = new FormData(event.target); // Capture form data
  const work_email = formData.get('work_email'); // Get the work_email from the form data
  const password = formData.get('password'); // Get the password from the form data

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

      // Check if the login was successful based on the 'success' property in the response
      if (data.success) {
        // Redirect to a new page or update the UI for a successful login
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
