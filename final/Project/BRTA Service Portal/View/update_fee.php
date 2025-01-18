<?php
// Start session
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: ../View/adminlogin.html");
    exit;
}

// Include the fee model
require_once '../Model/feeModel.php';

// Fetch all application fees
$fees = getAllFees();
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
    <script>
        function validateForm() {
            var name = document.getElementById("application_name").value;
            var cost = document.getElementById("application_cost").value;
            if (name == "" || cost == "") {
                alert("Both fields are required.");
                return false;
            }
            if (isNaN(cost) || parseFloat(cost) <= 0) {
                alert("Please enter a valid cost.");
                return false;
            }
            return true;
        }

        function editFee(id) {
            var name = document.getElementById("edit_name_" + id).value;
            var cost = document.getElementById("edit_cost_" + id).value;

            if (name == "" || cost == "") {
                alert("Both fields are required.");
                return;
            }
            if (isNaN(cost) || parseFloat(cost) <= 0) {
                alert("Please enter a valid cost.");
                return;
            }

            var data = {
                fee_id: id,
                application_name: name,
                application_cost: parseFloat(cost)
            };

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "../Controller/editFeeController.php", true);
            xhr.setRequestHeader("Content-Type", "application/json");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    alert("Fee updated successfully!");
                    location.reload();
                }
            };
            xhr.send(JSON.stringify(data));
        }

        function deleteFee(id) {
            if (confirm("Are you sure you want to delete this fee?")) {
                var data = { fee_id: id };

                var xhr = new XMLHttpRequest();
                xhr.open("POST", "../Controller/deleteFeeController.php", true);
                xhr.setRequestHeader("Content-Type", "application/json");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        alert("Fee deleted successfully!");
                        location.reload();
                    }
                };
                xhr.send(JSON.stringify(data));
            }
        }
    </script>
</head>

<body>
    <header class="header-bar">
        <img src="../Asset/brta-logo-new.png" alt="BRTA Logo" class="header-logo">
        <h1>Update Application Fees</h1>
    </header>

    <!-- Add Fee -->
    <form method="POST" onsubmit="return validateForm()">
        <h3>Add New Fee</h3>
        <input type="text" id="application_name" name="application_name" placeholder="Application Name" required>
        <input type="text" id="application_cost" name="application_cost" placeholder="Application Cost" required>
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
                        <td>
                            <input type="text" id="edit_name_<?php echo $fee['id']; ?>"
                                value="<?php echo htmlspecialchars($fee['application_name']); ?>" />
                        </td>
                        <td>
                            <input type="text" id="edit_cost_<?php echo $fee['id']; ?>"
                                value="<?php echo htmlspecialchars($fee['application_cost']); ?>" />
                        </td>
                        <td>
                            <button type="button" onclick="editFee(<?php echo $fee['id']; ?>)" class="save">Save</button>
                            <button type="button" onclick="deleteFee(<?php echo $fee['id']; ?>)" class="delete">Delete</button>
                        </td>
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