<?php
// Start session
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    // Redirect to login page if not logged in
    header("Location: ../View/adminlogin.html");
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

// Handle adding a rule
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_rule'])) {
    $rules = $_POST['rules'] ?? '';
    if (!empty($rules)) {
        $stmt = $conn->prepare("INSERT INTO rules (rules) VALUES (?)");
        $stmt->bind_param("s", $rules);
        $stmt->execute();
        $stmt->close();
    }
}

// Handle editing a rule
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_rule'])) {
    $serial = $_POST['serial'] ?? 0;
    $rules = $_POST['rules'] ?? '';
    if (!empty($serial) && !empty($rules)) {
        $stmt = $conn->prepare("UPDATE rules SET rules = ? WHERE serial = ?");
        $stmt->bind_param("si", $rules, $serial);
        $stmt->execute();
        $stmt->close();
    }
}

// Handle deleting a rule
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_rule'])) {
    $serial = $_POST['serial'] ?? 0;
    if (!empty($serial)) {
        $stmt = $conn->prepare("DELETE FROM rules WHERE serial = ?");
        $stmt->bind_param("i", $serial);
        $stmt->execute();
        $stmt->close();
    }
}

// Fetch all rules
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
    <title>Edit Rules</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .header-bar {
            background-color: rgb(0, 152, 190);


            color: white;
            text-align: center;
            padding: 20px 0;
            font-size: .7em;
            height: 100px;
            width: auto;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .header-logo {
            height: 50px;
            width: auto;
        }

        form {
            margin-bottom: 20px;
        }

        textarea {
            width: 100%;
            height: 60px;
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

        button {
            padding: 10px 15px;
            background-color: rgb(0, 152, 190);
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        button.delete {
            background-color: #c40000;
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
            <h1>BRTA Rules</h1>
        </div>
    </header>

    <!-- Add Rule Form -->
    <form method="POST">
        <h3>Add New Rule</h3>
        <textarea name="rules" placeholder="Enter new rule" required></textarea>
        <br>
        <button type="submit" name="add_rule">Add Rule</button>
    </form>

    <!-- Display Existing Rules -->
    <h3>Existing Rules</h3>
    <table>
        <thead>
            <tr>
                <th>Serial</th>
                <th>Rules</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($rules)): ?>
                <?php foreach ($rules as $rule): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($rule['serial']); ?></td>
                        <td>
                            <form method="POST" style="margin: 0;">
                                <input type="hidden" name="serial" value="<?php echo htmlspecialchars($rule['serial']); ?>">
                                <textarea name="rules"><?php echo htmlspecialchars($rule['rules']); ?></textarea>
                        </td>
                        <td>
                            <button type="submit" name="edit_rule">Save</button>
                            </form>
                            <form method="POST" style="display: inline;">
                                <input type="hidden" name="serial" value="<?php echo htmlspecialchars($rule['serial']); ?>">
                                <button type="submit" name="delete_rule" class="delete">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">No rules available.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!--Go back to Homepage button-->
    </div>
    <div style="text-align: center; margin-top: 20px;">
        <a href="../View/adminHome.php">
            <button
                style="padding: 10px 20px; background-color: #006400; color: white; cursor: pointer; border-radius: 5px;">
                Go Back to Homepage
            </button>
        </a>
    </div>
</body>

</html>
