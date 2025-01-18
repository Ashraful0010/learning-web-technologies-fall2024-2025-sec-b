<?php
require_once 'db.php';

// Check user login credentials

function checkUserLogin($username, $password)
{
    $conn = getConnection();

    // Prepare the SQL query to fetch the user data based on the username
    $stmt = $conn->prepare("SELECT  username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the user exists
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify the password using password_verify()
        if (password_verify($password, $user['password'])) {
            // Start session and store user data
            session_start();
            $_SESSION['username'] = $user['username'];
            return true;
        }
    }

    // Return false if login failed
    return false;
}
// Register a new user

function addUser($firstname, $lastname, $username, $phone, $dob, $email, $password)
{
    $conn = getConnection();
    $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, username, phone, dob, email, password) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $firstname, $lastname, $username, $phone, $dob, $email, $password);

    $result = $stmt->execute();
    $stmt->close();
    $conn->close();

    return $result;
}


// Fetch all users
function getAllUsers()
{
    $conn = getConnection();
    $query = "SELECT firstname, lastname, username, email, phone, dob FROM users";
    $result = $conn->query($query);
    if (!$result) {
        return [];
    }
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Fetch user details by username
function getUserDetails($username)
{
    $conn = getConnection();
    $stmt = $conn->prepare("SELECT firstname, lastname, email, phone, dob FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    $conn->close();
    return $result;
}

// Update user details
function updateUser($username, $firstname, $lastname, $email, $phone, $dob)
{
    $conn = getConnection();
    $stmt = $conn->prepare("UPDATE users SET firstname = ?, lastname = ?, email = ?, phone = ?, dob = ? WHERE username = ?");
    $stmt->bind_param("ssssss", $firstname, $lastname, $email, $phone, $dob, $username);
    $result = $stmt->execute();
    $stmt->close();
    $conn->close();
    return $result;
}
?>