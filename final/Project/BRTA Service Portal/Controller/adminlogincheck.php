<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Decode JSON data from the AJAX request
    $data = json_decode(file_get_contents("php://input"), true);
    $input_username = trim($data['username'] ?? '');
    $input_password = $data['password'] ?? '';

    // Admin credentials
    $admin_username = 'admin';
    $admin_password = 'admin';

    if (empty($input_username) || empty($input_password)) {
        echo json_encode(['success' => false, 'message' => 'Both fields are required.']);
        exit;
    }

    // Validate admin credentials
    if ($input_username === $admin_username && $input_password === $admin_password) {
        $_SESSION['is_admin'] = true; // Set admin session
        echo json_encode(['success' => true, 'message' => 'Login successful!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid username or password.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>