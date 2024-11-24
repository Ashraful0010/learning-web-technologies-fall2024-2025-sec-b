<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.html'); // Redirect if not logged in
    exit;
}

$user = $_SESSION['user'];
?>

<html>
<head>
    <title>Home</title>
</head>
<body>
    <h1>Welcome to your Home Page!</h1>
    <p><strong>Name:</strong> <?php echo htmlspecialchars($user['name']); ?></p>
    <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
    <p><strong>Password:</strong> <?php echo htmlspecialchars($user['password']); ?></p> <!-- Not secure; for demo purposes only -->
    <a href="logout.php">Logout</a>
</body>
</html>
