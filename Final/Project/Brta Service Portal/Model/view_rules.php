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

// Fetch rules from the database
$result = $conn->query("SELECT * FROM rules");
$rules = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $rules[] = $row;
    }
}
$conn->close();
?>

<html>

<head>
    <title>View Rules</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .header-bar {
            background-color: #006400;
            color: white;
            text-align: center;
            padding: 20px 0;
            font-size: 1.5em;
            margin-bottom: 20px;
        }

        .header-logo {
            height: 50px;
            width: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        .no-data {
            text-align: center;
            margin: 20px 0;
            font-size: 1.2em;
            color: #666;
        }

        button {
            padding: 10px 15px;
            background-color: #006400;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        button:hover {
            opacity: 0.9;
        }
    </style>
</head>

<body>
    <header>
        <div class="header-bar">
            <img src="../Asset/brta-logo-new.png" alt="brta logo" class="header-logo">
            <h1>BRTA Service Fee</h1>
        </div>
    </header>

    <h3>List of Rules</h3>
    <?php if (!empty($rules)): ?>
        <table>
            <thead>
                <tr>
                    <th>Serial</th>
                    <th>Rules</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rules as $rule): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($rule['serial']); ?></td>
                        <td><?php echo htmlspecialchars($rule['rules']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="no-data">No rules available to display.</p>
    <?php endif; ?>

    <!--Go back to Homepage button-->
    </div>
    <div style="text-align: center; margin-top: 20px;">
        <a href="../View/userHome.php">
            <button
                style="padding: 10px 20px; background-color: #006400; color: white; cursor: pointer; border-radius: 5px;">
                Go Back to Homepage
            </button>
        </a>
    </div>
</body>

</html>
