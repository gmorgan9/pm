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

if (response.ok) {
  // Parse the JSON response data
  try {
    const data = await response.json();

    if (data.success) {
      // Redirect to the URL provided in the response
      window.location.href = data.redirect;
    } else {
      // Display an error message to the user.
      const errorMessage = document.getElementById('error-message');
      errorMessage.textContent = data.message;
    }
  } catch (error) {
    console.error('Error parsing JSON response:', error);
  }
} else {
  // Handle non-successful response (e.g., server error)
  console.error('Login request failed');
}
