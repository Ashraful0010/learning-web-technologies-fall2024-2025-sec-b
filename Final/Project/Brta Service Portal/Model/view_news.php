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

// Create a connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Fetch all news records
$sql = "SELECT news_title, news_content FROM news ";
$result = $conn->query($sql);

// Close the database connection at the end of the script
?>

<html>

<head>
    <title>View News</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 0;
            padding: 0;
        }

        .header-bar {
            background-color: #006400;
            color: white;
            text-align: center;
            padding: 20px 0;
            font-size: 1.5em;
            font-weight: bold;
        }

        h1 {
            margin: 0;
        }

        .header-logo {
            height: 50px;
            width: auto;
        }

        .news-container {
            width: 80%;
            margin: 20px auto;
        }

        .news-item {
            border: 1px solid #ccc;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .news-title {
            font-size: 1.5em;
            margin-bottom: 10px;
            color: #006400;
        }

        .news-content {
            font-size: 1.2em;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <header>
        <div class="header-bar">
            <img src="../Asset/brta-logo-new.png" alt="BRTA Logo" class="header-logo">
            <h1>News Portal</h1>
        </div>
    </header>

    <div class="news-container">
        <?php
        if ($result->num_rows > 0):
            // Loop through and display each news item
            while ($row = $result->fetch_assoc()):
                ?>
                <div class="news-item">
                    <div class="news-title"><?php echo htmlspecialchars($row['news_title']); ?></div>
                    <div class="news-content"><?php echo nl2br(htmlspecialchars($row['news_content'])); ?></div>
                </div>
                <?php
            endwhile;
        else:
            ?>
            <p>No news available to display.</p>
        <?php endif; ?>

        <?php
        // Close the database connection
        $conn->close();
        ?>

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
