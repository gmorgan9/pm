<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ProjectManager</title>
    <link rel="stylesheet" href="assets/styles/login-styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body style="background-color: #e3e3e3;">

<!-- Main Content -->
<div class="container">
    <img src="/assets/images/aarc-360-logo-1.png" alt="">
    <div class="pb-5"></div>
    <h2>Welcome back!</h2>
    <p class="text-muted" style="font-size: 14px;">
        Log in to track and see the process of your audit process.
    </p>
    <div class="pb-3"></div>
    <div id="error-message"></div>
    <form id="login-form" autocomplete="off" action="#" method="POST">
        <div class="form-group">
            <input type="email" id="work_email" name="work_email" placeholder="name@company.com" required>
            <div id="email-validation-icon" class="validation-icon"></div>
        </div>
        <div class="form-group">
            <input type="password" id="password" name="password" placeholder="Password" required>
        </div>
        <button type="submit">Login</button>
    </form>
    
</div>


    <script src="/assets/scripts/email-validation.js?v=5.1.1"></script>

</body>
</html>
