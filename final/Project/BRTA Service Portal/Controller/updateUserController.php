<?php
// Include the user model
require_once '../Model/userModel.php';

// Start the session
session_start();

// Ensure user is logged in
if (!isset($_SESSION['username'])) {
    echo json_encode(["status" => "error", "message" => "User is not logged in"]);
    exit();
}

// Get JSON input
$data = json_decode(file_get_contents('php://input'), true);

// Validate data
if (empty($data['firstname']) || empty($data['lastname']) || empty($data['email']) || empty($data['phone']) || empty($data['dob'])) {
    echo json_encode(["status" => "error", "message" => "All fields are required."]);
    exit();
}

// Extract data
$firstname = $data['firstname'];
$lastname = $data['lastname'];
$email = $data['email'];
$phone = $data['phone'];
$dob = $data['dob'];
$username = $_SESSION['username']; // Use session data for the logged-in user

// Update the user information
if (updateUser($username, $firstname, $lastname, $email, $phone, $dob)) {
    echo json_encode(["status" => "success", "message" => "Information updated successfully."]);
} else {
    echo json_encode(["status" => "error", "message" => "Error updating information."]);
}
?>