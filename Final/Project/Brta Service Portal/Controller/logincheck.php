<?php

session_start();
// Database connection
$host = 'localhost';
$dbname = 'brta-project';
$username = 'root';
$password = '';

// Create a connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input_username = trim($_POST['username'] ?? '');
    $input_password = $_POST['password'] ?? '';

    // Check if fields are empty
    if (empty($input_username) || empty($input_password)) {
        echo "Both fields are required.";
        exit;
    }

    // Prepare and execute the query
    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $input_username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($stored_password);
        $stmt->fetch();

        // Verify the password
        if (password_verify($input_password, $stored_password)) {
            // Store username in the session to track login
            $_SESSION['username'] = $input_username;
            header("Location: ../View/userHome.php"); // Redirect to homepage on success
            exit;
        } else {
            echo "Invalid username or password.";
        }
    } else {
        echo "Invalid username or password.";
    }

    $stmt->close();
} else {
    echo "Invalid request method.";
}

// Close connection
$conn->close();
?>