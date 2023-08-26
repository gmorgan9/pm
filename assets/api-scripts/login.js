document.getElementById("login-form").addEventListener("submit", function(event) {
    event.preventDefault();

    const work_email = document.getElementById("work_email").value;
    const password = document.getElementById("password").value;

    fetch("https://app-aarc-api.morganserver.com/api/login", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            work_email: work_email,
            password: password
        })
    })
    .then(response => response.json())
    .then(data => {
        // Handle the response from the Flask API
        if (data.status === "success") {
            // Redirect to a success page or perform other actions
            window.location.href = "https://app-aarc.morganserver.com/dashboard/";
        } else {
            // Display an error message to the user
            const errorMessage = document.getElementById("error-message");
            errorMessage.innerHTML = data.message;
        }
    })
    .catch(error => {
        console.error("Error:", error);
    });
});