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

// Handle delete action
if (isset($_GET['delete_username'])) {
    $delete_username = $_GET['delete_username'];
    $stmt = $conn->prepare("DELETE FROM users WHERE username = ?");
    $stmt->bind_param("s", $delete_username);
    if ($stmt->execute()) {
        $message = "User deleted successfully.";
    } else {
        $message = "Error deleting user: " . $stmt->error;
    }
    $stmt->close();
}

// Handle edit action
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_username'])) {
    $edit_username = $_POST['edit_username'];
    $new_firstname = trim($_POST['firstname']);
    $new_lastname = trim($_POST['lastname']);
    $new_email = trim($_POST['email']);
    $new_phone = trim($_POST['phone']);
    $new_dob = trim($_POST['dob']);

    if (empty($new_firstname) || empty($new_lastname) || empty($new_email) || empty($new_phone) || empty($new_dob)) {
        $message = "All fields are required for editing.";
    } elseif (!preg_match("/^\d{11}$/", $new_phone)) {
        $message = "Phone number must be exactly 11 digits.";
    } else {
        $stmt = $conn->prepare("UPDATE users SET firstname = ?, lastname = ?, email = ?, phone = ?, dob = ? WHERE username = ?");
        $stmt->bind_param("ssssss", $new_firstname, $new_lastname, $new_email, $new_phone, $new_dob, $edit_username);
        if ($stmt->execute()) {
            $message = "User information updated successfully.";
        } else {
            $message = "Error updating user information: " . $stmt->error;
        }
        $stmt->close();
    }
}

// Fetch all users
$result = $conn->query("SELECT firstname, lastname, username, email, phone, dob FROM users");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Users</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .header-bar {
            background-color: rgb(0, 152, 190);
            color: white;
            text-align: center;
            padding: 15px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .header-bar h1 {
            margin: 0;
            font-size: 1.5em;
        }

        .container {
            padding: 20px;
        }

        .message {
            color: #006400;
            font-size: 1.1em;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: rgb(0, 152, 190);
            color: white;
        }

        .edit-form {
            margin-top: 20px;
            border: 1px solid #ddd;
            padding: 15px;
            background-color: white;
            border-radius: 5px;
            width: 100%;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        .edit-form h2 {
            color: rgb(0, 152, 190);
        }

        .edit-form input,
        .edit-form button {
            width: 90%;
            padding: 10px;
            margin: 10px auto;
            display: block;
            font-size: 1em;
        }

        .action-buttons a {
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 5px;
            margin: 0 5px;
            font-size: 14px;
            color: white;
        }

        .edit-button {
            background-color: #007bff;
        }

        .edit-button:hover {
            background-color: #0056b3;
        }

        .delete-button {
            background-color: #ff4d4d;
        }

        .delete-button:hover {
            background-color: #ff1a1a;
        }

        .home-button {
            display: inline-block;
            background-color: rgb(0, 152, 190);
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            margin-top: 20px;
        }

        .home-button:hover {
            background-color: #004b00;
        }
    </style>
</head>

<body>
    <!-- Header Section -->
    <header class="header-bar">
        <h1>Registered Users</h1>
    </header>

    <div class="container">
        <?php if (!empty($message)): ?>
            <p class="message"><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>

        <!-- Users Table -->
        <table>
            <thead>
                <tr>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Date of Birth</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['firstname']); ?></td>
                        <td><?php echo htmlspecialchars($row['lastname']); ?></td>
                        <td><?php echo htmlspecialchars($row['username']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['phone']); ?></td>
                        <td><?php echo htmlspecialchars($row['dob']); ?></td>
                        <td class="action-buttons">
                            <a href="view_users.php?edit_username=<?php echo htmlspecialchars($row['username']); ?>"
                                class="edit-button">Edit</a>
                            <a href="view_users.php?delete_username=<?php echo htmlspecialchars($row['username']); ?>"
                                class="delete-button"
                                onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Edit Form -->
        <?php if (isset($_GET['edit_username'])):
            $edit_username = $_GET['edit_username'];
            $stmt = $conn->prepare("SELECT firstname, lastname, email, phone, dob FROM users WHERE username = ?");
            $stmt->bind_param("s", $edit_username);
            $stmt->execute();
            $stmt->bind_result($edit_firstname, $edit_lastname, $edit_email, $edit_phone, $edit_dob);
            $stmt->fetch();
            $stmt->close();
            ?>
            <form method="POST" class="edit-form">
                <h2>Edit User: <?php echo htmlspecialchars($edit_username); ?></h2>
                <input type="hidden" name="edit_username" value="<?php echo htmlspecialchars($edit_username); ?>">
                <input type="text" name="firstname" placeholder="Firstname"
                    value="<?php echo htmlspecialchars($edit_firstname); ?>">
                <input type="text" name="lastname" placeholder="Lastname"
                    value="<?php echo htmlspecialchars($edit_lastname); ?>">
                <input type="text" name="email" placeholder="Email" value="<?php echo htmlspecialchars($edit_email); ?>">
                <input type="text" name="phone" placeholder="Phone" value="<?php echo htmlspecialchars($edit_phone); ?>">
                <input type="date" name="dob" value="<?php echo htmlspecialchars($edit_dob); ?>">
                <button type="submit">Update User</button>
            </form>
        <?php endif; ?>

        <!-- Back to Admin Home -->
        <a href="../View/adminHome.php" class="home-button">Back to Admin Home</a>
    </div>
</body>

</html>