<?php
$conn = new mysqli('localhost', 'root', '', 'sms');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    if (empty($name) || empty($contact) || empty($username) || empty($password)) {
        die("All fields are required.");
    }

    $stmt = $conn->prepare("INSERT INTO emp (name, contact, username, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $contact, $username, $password);

    if ($stmt->execute()) {
        echo "Registration successful. <a href='login.php'>Login here</a>";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
$conn->close();
?>

<html>

<head>
    <title>Register</title>
</head>

<body>
    <h1>Register</h1>
    <form method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name">
        <br>
        <label for="contact">Contact No:</label>
        <input type="text" id="contact" name="contact">
        <br>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username">
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password">
        <br>
        <input type="submit" id="submit"></input>
    </form>
</body>

</html>