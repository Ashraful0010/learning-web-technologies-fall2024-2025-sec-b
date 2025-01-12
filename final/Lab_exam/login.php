<?php
$conn = new mysqli('localhost', 'root', '', 'sms');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT password FROM emp WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();
        if (password_verify($password, $hashed_password)) {
            header("Location: dashboard.php");
        } else {
            echo "Invalid credentials.";
        }
    } else {
        echo "No user found with this username.";
    }
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <script>
        // Function to validate the form fields
        function validateForm() {
            let username = document.getElementById('username').value;
            let password = document.getElementById('password').value;
            let errorMessage = document.getElementById('error-message');

            // Clear previous error message
            errorMessage.textContent = '';

            if (username === '' || password === '') {
                errorMessage.textContent = 'Both fields are required.';
                errorMessage.style.color = 'red';
                return false; // Prevent form submission
            }
            return true; // Allow form submission
        }
    </script>
</head>

<body>
    <h1>Login</h1>
    <form method="POST" onsubmit="return validateForm()">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username">
        <br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password">
        <br><br>
        <button type="submit">Login</button>
    </form>

    <p id="error-message"></p> <!-- Error message will be displayed here -->
</body>

</html>