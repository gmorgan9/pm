function validateEmail() {
    var email = document.getElementById("work_email").value;
    var emailIcon = document.getElementById("email-validation-icon");
    var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

    if (!emailPattern.test(email)) {
        // Display red X for invalid format
        emailIcon.innerHTML = '<i class="bi bi-x" style="color: red;"></i>';
    } else {
        // Display green checkmark for valid format
        emailIcon.innerHTML = '<i class="bi bi-check" style="color: green;"></i>';
    }
}
