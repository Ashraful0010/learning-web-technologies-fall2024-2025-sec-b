<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: ../View/adminlogin.html");
    exit;
}

// Include the model
require_once '../Model/ruleModel.php';

// Fetch all rules
$rules = getAllRules();
?>
<!DOCTYPE html>
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
            font-size: 1em;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .header-logo {
            height: 50px;
            width: auto;
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
    <script>
        function addRule() {
            const ruleText = document.getElementById('newRule').value.trim();
            if (!ruleText) {
                alert('Rule cannot be empty.');
                return;
            }

            fetch('../Controller/ruleController.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ action: 'add', rule: ruleText }),
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) location.reload();
                    else alert(data.message || 'Failed to add rule.');
                });
        }

        function editRule(serial) {
            const ruleText = document.getElementById(`rule-${serial}`).value.trim();
            if (!ruleText) {
                alert('Rule cannot be empty.');
                return;
            }

            fetch('../Controller/ruleController.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ action: 'edit', serial, rule: ruleText }),
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) alert('Rule updated successfully.');
                    else alert(data.message || 'Failed to update rule.');
                });
        }

        function deleteRule(serial) {
            if (!confirm('Are you sure you want to delete this rule?')) return;

            fetch('../Controller/ruleController.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ action: 'delete', serial }),
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) location.reload();
                    else alert(data.message || 'Failed to delete rule.');
                });
        }
    </script>
</head>

<body>
    <header>
        <div class="header-bar">
            <img src="../Asset/brta-logo-new.png" alt="BRTA Logo" class="header-logo">
            <h1>BRTA Rules Management</h1>
        </div>
    </header>

    <form onsubmit="event.preventDefault(); addRule();">
        <h3>Add New Rule</h3>
        <textarea id="newRule" placeholder="Enter new rule"></textarea>
        <br>
        <button type="submit">Add Rule</button>
    </form>

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
                            <textarea
                                id="rule-<?php echo $rule['serial']; ?>"><?php echo htmlspecialchars($rule['rules']); ?></textarea>
                        </td>
                        <td>
                            <button onclick="editRule(<?php echo $rule['serial']; ?>)">Save</button>
                            <button class="delete" onclick="deleteRule(<?php echo $rule['serial']; ?>)">Delete</button>
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

    <div style="text-align: center; margin-top: 20px;">
        <a href="../View/adminHome.php">
            <button>Go Back to Homepage</button>
        </a>
    </div>
</body>

</html>