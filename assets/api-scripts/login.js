document.getElementById('login-form').addEventListener('submit', async (e) => {
    e.preventDefault(); // Prevent default form submission
  
    const work_email = document.getElementById('work_email').value;
    const password = document.getElementById('password').value;
  
    try {
      const response = await fetch('https://api.morganserver.com/api/login', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ work_email, password }),
      });
  
      if (response.ok) {
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
        console.error('Login request failed');
      }
    } catch (error) {
      console.error('An error occurred during login', error);
    }
  });
  