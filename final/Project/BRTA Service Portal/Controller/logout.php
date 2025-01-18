<?php
session_start();
session_unset();
session_destroy();

// Send a success response for AJAX logout
echo json_encode(['success' => true, 'message' => 'Logged out successfully.']);
header('location: ../View/login.html')
    ?>