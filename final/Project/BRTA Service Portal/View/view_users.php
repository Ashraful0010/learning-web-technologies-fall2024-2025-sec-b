<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: ../View/adminlogin.html");
    exit;
}
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
    <script>
        function loadUsers() {
            fetch("../Controller/userController.php?action=getAllUsers")
                .then(response => response.json())
                .then(data => {
                    const tableBody = document.querySelector("#users-table tbody");
                    tableBody.innerHTML = "";
                    data.forEach(user => {
                        tableBody.innerHTML += `
                            <tr>
                                <td>${user.firstname}</td>
                                <td>${user.lastname}</td>
                                <td>${user.username}</td>
                                <td>${user.email}</td>
                                <td>${user.phone}</td>
                                <td>${user.dob}</td>
                                <td>
                                    <button onclick='populateEditForm(${JSON.stringify(user)})'>Edit</button>
                                </td>
                            </tr>
                        `;
                    });
                });
        }

        function populateEditForm(user) {
            document.getElementById('edit-user-form').style.display = 'block';
            document.getElementById('edit-username').value = user.username;
            document.getElementById('edit-firstname').value = user.firstname;
            document.getElementById('edit-lastname').value = user.lastname;
            document.getElementById('edit-email').value = user.email;
            document.getElementById('edit-phone').value = user.phone;
            document.getElementById('edit-dob').value = user.dob;
        }

        function updateUser() {
            const data = {
                username: document.getElementById('edit-username').value,
                firstname: document.getElementById('edit-firstname').value,
                lastname: document.getElementById('edit-lastname').value,
                email: document.getElementById('edit-email').value,
                phone: document.getElementById('edit-phone').value,
                dob: document.getElementById('edit-dob').value,
            };
            fetch("../Controller/userController.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ action: "updateUser", ...data }),
            })
                .then(response => response.json())
                .then(result => {
                    if (result.success) {
                        alert("User updated successfully!");
                        document.getElementById('edit-user-form').style.display = 'none';
                        loadUsers();
                    } else {
                        alert("Error updating user!");
                    }
                });
        }

        window.onload = loadUsers;
    </script>
</head>

<body>
    <header class="header-bar">
        <h1>Registered Users</h1>
    </header>
    <div class="container">
        <table id="users-table">
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
            <tbody></tbody>
        </table>
        <div id="edit-user-form" class="edit-form" style="display: none;">
            <h2>Edit User</h2>
            <input type="hidden" id="edit-username">
            <input type="text" id="edit-firstname" placeholder="Firstname">
            <input type="text" id="edit-lastname" placeholder="Lastname">
            <input type="text" id="edit-email" placeholder="Email">
            <input type="text" id="edit-phone" placeholder="Phone">
            <input type="date" id="edit-dob">
            <button onclick="updateUser()">Update User</button>
        </div>
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