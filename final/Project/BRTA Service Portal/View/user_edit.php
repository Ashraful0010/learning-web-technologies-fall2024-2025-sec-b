<?php
// Start session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to login page if not logged in
    header("Location: ../View/login.html");
    exit;
}

// Include the user model
require_once '../Model/userModel.php';

// Fetch the logged-in user's current information
$user_username = $_SESSION['username'];
$user_details = getUserDetails($user_username);

// Default values from the user data
$firstname = $user_details['firstname'];
$lastname = $user_details['lastname'];
$email = $user_details['email'];
$phone = $user_details['phone'];
$dob = $user_details['dob'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Information</title>
    <style>
        /* Your existing styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 400px;
            text-align: center;
        }

        h1 {
            margin-bottom: 20px;
            color: #006400;
        }

        form input {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        form button {
            padding: 10px 20px;
            background-color: #006400;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        form button:hover {
            background-color: #004b00;
        }

        .message {
            margin-top: 10px;
            color: #d9534f;
        }

        .success {
            color: #5cb85c;
        }

        .home-button {
            margin-top: 20px;
            display: inline-block;
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
        }

        .home-button:hover {
            background-color: #0056b3;
        }
    </style>

    <script>
        // JavaScript form validation
        function validateForm() {
            const firstname = document.getElementById("firstname").value;
            const lastname = document.getElementById("lastname").value;
            const email = document.getElementById("email").value;
            const phone = document.getElementById("phone").value;
            const dob = document.getElementById("dob").value;
            let valid = true;
            let message = "";

            // Validate all fields
            if (!firstname || !lastname || !email || !phone || !dob) {
                valid = false;
                message = "All fields are required.";
            } else if (!/\d{11}/.test(phone)) {
                valid = false;
                message = "Phone number must be exactly 11 digits.";
            }

            if (!valid) {
                document.getElementById("form-message").innerHTML = message;
            }
            return valid;
        }

        // Function to update user information via AJAX
        function updateUserInfo(event) {
            event.preventDefault(); // Prevent default form submission
            if (!validateForm()) return;

            const formData = new FormData(document.forms["updateForm"]);
            const data = {
                firstname: formData.get("firstname"),
                lastname: formData.get("lastname"),
                email: formData.get("email"),
                phone: formData.get("phone"),
                dob: formData.get("dob")
            };

            const xhr = new XMLHttpRequest();
            xhr.open("POST", "../Controller/updateUserController.php", true);
            xhr.setRequestHeader("Content-Type", "application/json");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.status === "success") {
                        document.getElementById("form-message").innerHTML = "Information updated successfully.";
                        document.getElementById("form-message").classList.add("success");
                    } else {
                        document.getElementById("form-message").innerHTML = "Error updating information.";
                    }
                }
            };
            xhr.send(JSON.stringify(data));
        }
    </script>
</head>

<body>
    <div class="form-container">
        <h1>Edit Information</h1>
        <form name="updateForm" onsubmit="updateUserInfo(event)">
            <input type="text" id="firstname" name="firstname" placeholder="Firstname"
                value="<?php echo htmlspecialchars($firstname); ?>">
            <input type="text" id="lastname" name="lastname" placeholder="Lastname"
                value="<?php echo htmlspecialchars($lastname); ?>">
            <input type="text" id="email" name="email" placeholder="Email"
                value="<?php echo htmlspecialchars($email); ?>">
            <input type="text" id="phone" name="phone" placeholder="Phone Number"
                value="<?php echo htmlspecialchars($phone); ?>">
            <input type="date" id="dob" name="dob" value="<?php echo htmlspecialchars($dob); ?>">
            <button type="submit">Update Information</button>
        </form>
        <p id="form-message" class="message"></p>
        <a href="../View/userHome.php" class="home-button">Go to Homepage</a>
    </div>
</body>

</html>