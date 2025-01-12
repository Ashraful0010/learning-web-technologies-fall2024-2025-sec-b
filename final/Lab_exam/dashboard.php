<?php
$conn = new mysqli('localhost', 'root', '', 'sms');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM emp");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>

<body >
    
    <h1>Employee Management</h1>
    <a href="reg.php">Add New Employee</a><br>
    <form action="" >
    <table border="1">
        <tr>
            <th>Name</th>
            <th>Contact</th>
            <th>Username</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['contact']; ?></td>
                <td><?php echo $row['username']; ?></td>
                <td>
                    <a href="emp_update.php?id= <?php echo $row['username']; ?>">Update</a>
                    <a href="emp_delete.php?id= <?php echo $row['username']; ?>">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
    </form>
</body>

</html>