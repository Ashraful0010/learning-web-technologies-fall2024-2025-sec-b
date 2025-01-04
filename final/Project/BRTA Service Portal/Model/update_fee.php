<?php
// Start session
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: ../View/adminlogin.html");
    exit;
}

// Database connection
$conn = new mysqli('localhost', 'root', '', 'brta-project');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Add fee
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_fee'])) {
    $application_name = trim($_POST['application_name']);
    $application_cost = floatval($_POST['application_cost']);
    if (!empty($application_name) && $application_cost > 0) {
        $stmt = $conn->prepare("INSERT INTO application_fees (application_name, application_cost) VALUES (?, ?)");
        $stmt->bind_param("sd", $application_name, $application_cost);
        $stmt->execute();
        $stmt->close();

        // Redirect to avoid duplicate submissions
        header("Location: update_fee.php");
        exit;
    }
}

// Update fee
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_fee'])) {
    $fee_id = intval($_POST['fee_id']);
    $application_name = trim($_POST['application_name']);
    $application_cost = floatval($_POST['application_cost']);
    if (!empty($fee_id) && !empty($application_name) && $application_cost > 0) {
        $stmt = $conn->prepare("UPDATE application_fees SET application_name = ?, application_cost = ? WHERE id = ?");
        $stmt->bind_param("sdi", $application_name, $application_cost, $fee_id);
        $stmt->execute();
        $stmt->close();

        // Redirect to avoid duplicate submissions
        header("Location: update_fee.php");
        exit;
    }
}

// Delete fee
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_fee'])) {
    $fee_id = intval($_POST['fee_id']);
    if (!empty($fee_id)) {
        $stmt = $conn->prepare("DELETE FROM application_fees WHERE id = ?");
        $stmt->bind_param("i", $fee_id);
        $stmt->execute();
        $stmt->close();

        // Redirect to avoid duplicate submissions
        header("Location: update_fee.php");
        exit;
    }
}

// Fetch all application fees
$fees = $conn->query("SELECT * FROM application_fees")->fetch_all(MYSQLI_ASSOC);
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Fees</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }

        .header-bar {
            background-color: #0098be;
            color: white;
            text-align: center;
            padding: 20px 0;
            font-size: 1.2em;
            margin-bottom: 20px;
        }

        .header-logo {
            height: 50px;
            margin-bottom: 10px;
        }

        form {
            margin-bottom: 20px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1em;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
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
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button.add {
            background-color: #0098be;
            color: white;
        }

        button.save {
            background-color: #007bff;
            color: white;
        }

        button.delete {
            background-color: #c40000;
            color: white;
        }

        button:hover {
            opacity: 0.9;
        }

        .home-button {
            text-align: center;
            margin-top: 20px;
        }

        .home-button a {
            text-decoration: none;
            padding: 10px 20px;
            background-color: #006400;
            color: white;
            border-radius: 5px;
        }

        .home-button a:hover {
            background-color: #004b00;
        }
    </style>
</head>

<body>
    <header class="header-bar">
        <img src="../Asset/brta-logo-new.png" alt="BRTA Logo" class="header-logo">
        <h1>Update Application Fees</h1>
    </header>

    <!-- Add Fee -->
    <form method="POST">
        <h3>Add New Fee</h3>
        <input type="text" name="application_name" placeholder="Application Name" >
        <input type="text" name="application_cost" placeholder="Application Cost" >
        <button type="submit" name="add_fee" class="add">Add Fee</button>
    </form>

    <!-- Existing Fees -->
    <h3>Existing Fees</h3>
    <table>
        <thead>
            <tr>
                <th>Application Name</th>
                <th>Application Cost</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($fees)): ?>
                <?php foreach ($fees as $fee): ?>
                    <tr>
                        <form method="POST">
                            <td>
                                <input type="text" name="application_name"
                                    value="<?php echo htmlspecialchars($fee['application_name']); ?>" >
                                <input type="hidden" name="fee_id" value="<?php echo htmlspecialchars($fee['id']); ?>">
                            </td>
                            <td>
                                <input type="text" name="application_cost"
                                    value="<?php echo htmlspecialchars($fee['application_cost']); ?>" >
                            </td>
                            <td>
                                <button type="submit" name="edit_fee" class="save">Save</button>
                                <button type="submit" name="delete_fee" class="delete"
                                    onclick="return confirm('Are you sure you want to delete this fee?');">Delete</button>
                            </td>
                        </form>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">No fees available.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Back to Homepage -->
    <div class="home-button">
        <a href="../View/adminHome.php">Go Back to Homepage</a>
    </div>
</body>

</html>