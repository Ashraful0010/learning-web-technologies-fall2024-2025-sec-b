<?php
// Start session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to login page if not logged in
    header("Location: ../View/login.html");
    exit;
}

// Database connection
$host = 'localhost';
$dbname = 'brta-project';
$username = 'root';
$password = '';

$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Fetch the logged-in user's current information
$user_username = $_SESSION['username']; // Use session variable directly
$stmt = $conn->prepare("SELECT firstname, lastname, username, phone, dob FROM users WHERE username = ?");
$stmt->bind_param("s", $user_username); 
$stmt->execute();
$stmt->bind_result($firstname, $lastname, $username, $phone, $dob);
$stmt->fetch();
$stmt->close();

// Handle form submission for updating user information
$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_firstname = trim($_POST['firstname'] ?? '');
    $new_lastname = trim($_POST['lastname'] ?? '');
    $new_username = trim($_POST['username'] ?? '');
    $new_phone = trim($_POST['phone'] ?? '');
    $new_dob = trim($_POST['dob'] ?? '');

    if (empty($new_firstname) || empty($new_lastname) || empty($new_username) || empty($new_phone) || empty($new_dob)) {
        $message = "All fields are required.";
    } elseif (!preg_match("/^\d{11}$/", $new_phone)) {
        $message = "Phone number must be exactly 11 digits.";
    } else {
        // Update user information in the database
        $stmt = $conn->prepare("UPDATE users SET firstname = ?, lastname = ?, username = ?, phone = ?, dob = ? WHERE username = ?");
        $stmt->bind_param("ssssss", $new_firstname, $new_lastname, $new_username, $new_phone, $new_dob, $user_username);

        if ($stmt->execute()) {
            $message = "Information updated successfully.";
            // Update session data if username was changed
            $_SESSION['username'] = $new_username;
        } else {
            $message = "Error updating information: " . $stmt->error;
        }
        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 400px;
            text-align: center;
        }

        h1 {
            margin-bottom: 20px;
            color: #006400;
        }

        form input {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        form button {
            padding: 10px 20px;
            background-color: #006400;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        form button:hover {
            background-color: #004b00;
        }

        .message {
            margin-top: 10px;
            color: #d9534f;
        }

        .success {
            color: #5cb85c;
        }

        .home-button {
            margin-top: 20px;
            display: inline-block;
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
        }

        .home-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h1>Edit Information</h1>
        <form method="POST" action="user_edit.php">
            <input type="text" name="firstname" placeholder="Firstname"
                value="<?php echo htmlspecialchars($firstname); ?>">
            <input type="text" name="lastname" placeholder="Lastname"
                value="<?php echo htmlspecialchars($lastname); ?>">
            <input type="text" name="username" placeholder="Username"
                value="<?php echo htmlspecialchars($username); ?>">
            <input type="text" name="phone" placeholder="Phone Number" value="<?php echo htmlspecialchars($phone); ?>">
            <input type="date" name="dob" value="<?php echo htmlspecialchars($dob); ?>">
            <button type="submit">Update Information</button>
        </form>
        <?php if (!empty($message)): ?>
            <p class="message <?php echo strpos($message, 'successfully') !== false ? 'success' : ''; ?>">
                <?php echo htmlspecialchars($message); ?>
            </p>
        <?php endif; ?>
        <a href="../View/userHome.php" class="home-button">Go to Homepage</a>
    </div>
</body>

</html>