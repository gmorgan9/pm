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
  const data = await response.json();

  if (data.success) {
    // Redirect to the URL provided in the response
    window.location.href = data.redirect;
  } else {
    // Display an error message to the user.
    const errorMessage = document.getElementById('error-message');
    errorMessage.textContent = data.message;
  }
} else {
  // Handle non-successful response (e.g., server error)
  console.error('Login request failed');
}
