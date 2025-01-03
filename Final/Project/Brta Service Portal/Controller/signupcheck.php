<?php
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

// Initialize variables
$errors = [];
$redirectUrl = "../View/signup.html"; // Redirect back to signup page on error

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = trim($_POST['firstname'] ?? '');
    $lastname = trim($_POST['lastname'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $dob = $_POST['dob'] ?? '';
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Check if any field is empty
    if (empty($firstname) || empty($lastname) || empty($username) || empty($phone) || empty($dob) || empty($email) || empty($password) || empty($confirm_password)) {
        $errors[] = "All fields are required.";
    }

    // Validation
    // 1. Firstname and Lastname: Only letters and spaces
    if (!empty($firstname) && !preg_match("/^[a-zA-Z\s]+$/", $firstname)) {
        $errors[] = "Firstname can only contain letters and spaces.";
    }
    if (!empty($lastname) && !preg_match("/^[a-zA-Z\s]+$/", $lastname)) {
        $errors[] = "Lastname can only contain letters and spaces.";
    }

    // 2. Username: At least 5 characters, no spaces
    if (!empty($username) && (!preg_match("/^[\w@!#\$%\^&\*\(\)-]{5,}$/", $username) || preg_match("/\s/", $username))) {
        $errors[] = "Username must be at least 5 characters, contain no spaces, and can include special characters.";
    }

    // 3. Phone Number: Exactly 11 digits
    if (!empty($phone) && !preg_match("/^\d{11}$/", subject: $phone)) {
        $errors[] = "Phone number must be exactly 11 digits.";
    }

    // 4. Email: Valid email format
    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    }

    // 5. Password: Must contain uppercase, lowercase, number, special character, no spaces, and be at least 8 characters
    if (
        !empty($password) &&
        (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/", subject: $password) || preg_match("/\s/", $password))
    ) {
        $errors[] = "Password must be at least 8 characters, contain both uppercase and lowercase letters, include a number, and have no spaces.";
    }

    // 6. Confirm password: Matches the password
    if (!empty($password) && !empty($confirm_password) && $password !== $confirm_password) {
        $errors[] = "Password and Confirm Password do not match.";
    }

    // If no errors, insert data into the database
    if (empty($errors)) {
        // Hash the password for security
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Prepare SQL statement
        $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, username, phone, dob, email, password) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $firstname, $lastname, $username, $phone, $dob, $email, $hashed_password);

        if ($stmt->execute()) {
            // Redirect to login page
            header("Location: ../View/login.html");
            exit;
        } else {
            $errors[] = "Error saving data: " . $stmt->error;
        }

        $stmt->close();
    }

    // Close the database connection
    $conn->close();
}

// If there are errors, display them and redirect back
if (!empty($errors)) {
    echo "<h3>The following errors occurred:</h3><ul>";
    foreach ($errors as $error) {
        echo "<li>" . htmlspecialchars($error) . "</li>";
    }
    echo "</ul>";
    echo "<p><a href='$redirectUrl'>Go back to the signup page</a></p>";
}
?>