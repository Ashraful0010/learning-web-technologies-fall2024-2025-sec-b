<?php
require_once '../Model/userModel.php';

// Get the form data
$username = $_POST['username'];
$password = $_POST['password'];

// Call the function to check login credentials
if (checkUserLogin($username, $password)) {
    // If login is successful, redirect to the user home page
    header('Location: ../View/userHome.php');
    exit();
} else {
    // If login is not successful, show an error message
    echo "<script>alert('Invalid username or password'); window.location.href='../View/login.html';</script>";
}
?>