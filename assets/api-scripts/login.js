// login.js

// Function to handle form submission
async function loginUser(event) {
    event.preventDefault();
  
    // Get form data
    const form = document.getElementById('login-form');
    const formData = new FormData(form);
  
    try {
      // Send a POST request to your backend
      const response = await fetch('https://api.morganserver.com/api/login', {
        method: 'POST',
        body: formData,
      });
  
      const data = await response.json();
  
      if (data.success) {
        // Login was successful, redirect or perform other actions
        window.location.href = '/dashboard'; // Redirect to a dashboard page
      } else {
        // Display an error message to the user
        const errorMessage = document.getElementById('error-message');
        errorMessage.textContent = data.message;
        errorMessage.style.display = 'block';
      }
    } catch (error) {
      console.error('Error:', error);
    }
  }
  
  // Attach the login function to the form's submit event
  const loginForm = document.getElementById('login-form');
  loginForm.addEventListener('submit', loginUser);
  