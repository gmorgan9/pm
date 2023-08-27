// Attach an event listener to the form with the ID 'login-form'
document.getElementById('login-form').addEventListener('submit', handleLogin);

async function handleLogin(event) {
  event.preventDefault();

  // Capture form data
  const form = event.target;
  const formData = new FormData(form);
  
  // Extract the values of 'work_email' and 'password' fields from the form data
  const work_email = formData.get('work_email');
  const password = formData.get('password');

  try {
    // Create an object with the login data
    const loginData = { work_email, password };

    // Send a POST request to the login endpoint
    console.log('Sending POST request...');

    // Inside the response handling section of your client-side code
    const response = await fetch('https://api.morganserver.com/api/login', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(loginData),
    });
  
    console.log('Server Response:', response);
  

    // Check if the response status indicates success (status codes 200-299)
    if (response.ok) {
      // Parse the JSON response data
      const data = await response.json();

      if (data.success) {
        // Redirect to the dashboard upon successful login
        window.location.href = 'https://app-aarc.morganserver.com/dashboard/';
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
