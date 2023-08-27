$(document).ready(function() {
    $("#login-button").click(function() {
        var workEmail = $("#work_email").val();
        var password = $("#password").val();
        
        var data = {
            work_email: workEmail,
            password: password
        };

        $.ajax({
            type: "POST",
            url: "https://app-aarc-api.morganserver.com/api/login",
            contentType: "application/json",
            data: JSON.stringify(data),
            success: function(response) {
                alert(response.message);
                // You can redirect the user to a different page on successful login if needed.
            },
            error: function(xhr, status, error) {
                alert("Login failed. Please check your credentials.");
            }
        });
    });
});