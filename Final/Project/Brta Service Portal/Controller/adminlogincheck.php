<?php
// Start session
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input_username = trim($_POST['username'] ?? '');
    $input_password = $_POST['password'] ?? '';

    // Define admin credentials
    $admin_username = 'admin';
    $admin_password = 'admin';

    // Check if fields are empty
    if (empty($input_username) || empty($input_password)) {
        die("Both fields are required."); // Stop execution
    }

    // Validate admin credentials
    if ($input_username === $admin_username && $input_password === $admin_password) {
        // Store admin login status in the session
        $_SESSION['is_admin'] = true;

        // Redirect to the admin dashboard or homepage
        header("Location: ../View/adminHome.php");
        exit;
    } else {
        // Invalid credentials message
        echo "Invalid username or password.";
    }
} else {
    die("Invalid request method."); // Stop execution
}
?>