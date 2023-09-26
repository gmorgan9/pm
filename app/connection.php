<!-- WORKING -->
<?php

$servername = "localhost";
$username = "dbadmin";
$password = "DBadmin123!";
$database = "projectmanager";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
} else {
    echo "hello"; // Use 'echo' instead of 'print'
}
?>
