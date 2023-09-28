<!DOCTYPE html>


<?php
require_once "../app/connection.php";
require_once "../path.php";
require_once "../app/functions.php";
session_start();

if(isset($_POST['login'])){
// $idno  = rand(1000000, 9999999); // figure how to not allow duplicates
$user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
$user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
$password = md5($_POST['password']);
$loggedin = $_POST['loggedin'];

$select = " SELECT * FROM users WHERE user_name = '$user_name' && password = '$password' ";

$result = mysqli_query($conn, $select);

if(mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_array($result);
    $sql = "UPDATE users SET logged_in='1' WHERE user_name='$user_name'";
    $_SESSION['user_id']          = $row['user_id'];
    $_SESSION['loggedin']         = $row['loggedin'];
    $_SESSION['username']         = $row['username'];
    $_SESSION['pass']             = $row['password'];
    header('location:' . BASE_URL . '/dashboard/');
}else{
    $error = '
<div role="alert" aria-live="assertive" aria-atomic="true" class="toast" data-bs-autohide="true" data-bs-delay="5000" style="position: fixed; bottom: 20px; right: 20px;">
    <div class="toast-header">
        <i class="bi bi-exclamation-octagon-fill text-danger"></i> &nbsp;&nbsp;
        <strong class="me-auto">Error</strong>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body text-start">
        The username or password entered is not registered on this site. Please try again.
    </div>
</div>';

}

};
?>



<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ProjectManager</title>
    <link rel="stylesheet" href="assets/styles/login-styles.css?v=5.1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .login_error {
                border-left: 4px solid #ff8080;
                padding: 12px;
                margin-left: 0;
                margin-bottom: 20px;
                background-color: #fff;
                box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
                word-wrap:break-word
            }
    </style>

<script>
    $(document).ready(function () {
        // Check if the $error variable is not empty
        <?php if (!empty($error)) { ?>
        // Show the error toast
        var toast = new bootstrap.Toast(document.querySelector('.toast'));
        toast.show();
        
        // Automatically hide the toast after 5 seconds
        setTimeout(function () {
            toast.hide();
        }, 5000);
        <?php } ?>
    });
</script>

</head>
<body style="background-color: #e3e3e3;">

<!-- Main Content -->
<div class="container">
    <img src="/assets/images/think-wyse.png" alt="">
    <div class="pb-5"></div>
    <h2>Welcome back!</h2>
    <p class="text-muted" style="font-size: 14px;">
        Log in to track and see the process of your audit process.
    </p>
    <div class="pb-3"></div>
    <?php echo $error; ?>
    <form id="login-form" autocomplete="off" action="#" method="POST">
        <div class="form-group">
            <input type="text" id="username" name="user_name" placeholder="Username" required>
        </div>
        <div class="form-group">
            <input type="password" id="password" name="password" placeholder="Password" required>
        </div>
        <button type="submit" name="login">Login</button>
    </form>
    
</div>



    <!-- <script src="/assets/scripts/email-validation.js?v=5.1.1"></script> -->

</body>
</html>
