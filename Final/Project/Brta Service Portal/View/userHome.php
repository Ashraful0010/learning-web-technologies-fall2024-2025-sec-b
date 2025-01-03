<?php
// Start session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to login page if not logged in
    header("Location: ../View/login.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Home</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        /* Header Section */
        .header-bar {
            background-color: #006400;
            color: white;
            text-align: center;
            padding: 15px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .header-bar img {
            height: 50px;
        }

        .header-bar h1 {
            margin: 5px 0 0;
            font-size: 1.5em;
        }

        /* Logout Button Styling */
        .logout-button {
            background-color: #ff4d4d;
            color: white;
            margin-left: 1200px;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .logout-button:hover {
            background-color: #ff1a1a;
        }

        .container {
            text-align: center;
            padding: 20px;
        }

        h2 {
            color: #006400;
            margin-bottom: 30px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            width: 80%;
            max-width: 600px;
            margin: 0 auto;
        }

        .card {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .card img {
            width: 80px;
            height: 80px;
            margin-bottom: 15px;
        }

        .card p {
            font-size: 1.2em;
            font-weight: bold;
            color: #333;
            margin: 0;
        }
    </style>
</head>

<body>
    <!-- Header Section -->
    <header class="header-bar">
        <div>
            <img src="../Asset/brta-logo-new.png" alt="BRTA Logo">
            <h1>User Homepage</h1>
        </div>
        <a href="../Controller/logout.php" class="logout-button">Logout</a>
    </header>

    <!-- Main Content -->
    <div class="container">
        <h2>Welcome to the Homepage</h2>
        <div class="grid">
            <!-- Option 1: View Application Fees -->
            <div class="card" onclick="location.href='fee.php'">
                <img src="../Asset/fee_logo.png" alt="View Application Fees logo">
                <p>View Application Fees</p>
            </div>

            <!-- Option 2: Open News Portal -->
            <div class="card" onclick="location.href='../Model/view_news.php'">
                <img src="../Asset/news_logo.png" alt="Open News Portal logo">
                <p>Open News Portal</p>
            </div>

            <!-- Option 3: Rulebook -->
            <div class="card" onclick="location.href='../Model/view_rules.php'">
                <img src="../Asset/rules_logo.png" alt="Rulebook logo">
                <p>Rulebook</p>
            </div>

            <!-- Option 4: Edit Information -->
            <div class="card" onclick="location.href='../Model/user_edit.php'">
                <img src="../Asset/edit_info_logo.png" alt="Edit Information logo">
                <p>Edit Information</p>
            </div>
        </div>
    </div>
</body>

</html>