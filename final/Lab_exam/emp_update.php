<?php
$conn = new mysqli('localhost', 'root', '', 'sms');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['emp_update'])) {
    $username = $_POST['username'] ?? 0;
    $name = $_POST['name'] ?? '';
    if (!empty($username) && !empty($contact)) {
        $stmt = $conn->prepare("UPDATE name SET name = ? WHERE username = ?");
        $stmt->bind_param("si", $name, $username);
        $stmt->execute();
        $stmt->close();
    }
}
$conn->close();
?>