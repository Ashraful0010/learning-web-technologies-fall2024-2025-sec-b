<?php

require_once '../Model/userModel.php';

// Response array
$response = ["success" => false, "error" => ""];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Decode JSON input
    $data = json_decode(file_get_contents("php://input"), true);

    if (!$data) {
        $response["error"] = "Invalid input data.";
        echo json_encode($response);
        exit;
    }

    // Extract fields
    $firstname = $data['firstname'] ?? '';
    $lastname = $data['lastname'] ?? '';
    $username = $data['username'] ?? '';
    $phone = $data['phone'] ?? '';
    $dob = $data['dob'] ?? '';
    $email = $data['email'] ?? '';
    $password = $data['password'] ?? '';
    $confirm_password = $data['confirm_password'] ?? '';

    // Validate server-side
    if (empty($firstname) || empty($lastname) || empty($username) || empty($phone) || empty($dob) || empty($email) || empty($password) || empty($confirm_password)) {
        $response["error"] = "All fields are required.";
        echo json_encode($response);
        exit;
    }

    if (strlen($username) < 5) {
        $response["error"] = "Username must be at least 5 characters long.";
        echo json_encode($response);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response["error"] = "Invalid email address.";
        echo json_encode($response);
        exit;
    }

    if (!preg_match('/^\d{11}$/', $phone)) {
        $response["error"] = "Phone number must be 11 digits.";
        echo json_encode($response);
        exit;
    }

    if ($password !== $confirm_password) {
        $response["error"] = "Passwords do not match.";
        echo json_encode($response);
        exit;
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Save user
    if (addUser($firstname, $lastname, $username, $phone, $dob, $email, $hashed_password)) {
        $response["success"] = true;
    } else {
        $response["error"] = "Failed to create an account.";
    }
} else {
    $response["error"] = "Invalid request method.";
}

// Output JSON response
echo json_encode($response);
?>