<?php
$conn = new mysqli('localhost', 'root', '', 'sms');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['username'])) {
    $username = $_POST['username'];

    $stmt = $conn->prepare("DELETE FROM emp WHERE username = ?");
    $stmt->bind_param("s", $username);

    if ($stmt->execute()) {
        echo "Employee deleted successfully. <a href='dashboard.php'>Go to Dashboard</a>";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>