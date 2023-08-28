// Function to check if a user is logged in and retrieve session data
function checkLoginStatus() {
    fetch('https://app-aarc-api.morganserver.com/api/check_login') // Replace with the actual endpoint URL
      .then(response => response.json())
      .then(data => {
        if (data.loggedIn) {
          // User is logged in, retrieve additional session data if needed
          fetch('https://app-aarc-api.morganserver.com/api/profile') // Replace with the actual endpoint URL
            .then(response => response.text())
            .then(profileText => {
              // Display the user's profile information on the frontend
              document.getElementById('profile').textContent = profileText;
              document.getElementById('profile').textContent = "Welcome, " + username + "! This is your profile.";

            });
        } else {
          // User is not logged in, display a message or redirect to the login page
            document.getElementById('profile').textContent = "You are not logged in.";
        }
      });
  }
  
  // Call the checkLoginStatus function when your page loads or when needed
  checkLoginStatus();
  


  // Wait for the document to be ready
  $(document).ready(function () {
    // Select the login button by its id
    const loginButton = document.getElementById("login-button");

    // Add a click event listener to the login button
    loginButton.addEventListener("click", function () {
        // Get the values of the email and password fields
        const email = document.getElementById("work_email").value;
        const password = document.getElementById("password").value;

        // Create a JavaScript object with the email and password
        const userData = {
            work_email: email,
            password: password
        };

        // Send a POST request to your API to handle login
        $.ajax({
            url: "https://app-aarc-api.morganserver.com/api/login", // Replace with the actual API endpoint
            method: "POST",
            contentType: "application/json",
            data: JSON.stringify(userData),
            success: function (response) {
                // Handle a successful login
                alert(response.message); // You can customize how you handle success
                // Optionally, redirect to another page
                window.location.href = "https://app-aarc.morganserver.com/dashboard";
            },
            error: function (xhr, status, error) {
                // Handle login error
                const errorMessage = xhr.responseJSON.error;
                document.getElementById("error-message").innerHTML = errorMessage;
            }
        });
    });
});