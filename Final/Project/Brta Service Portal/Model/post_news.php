<?php
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

// Handle form submission
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $news_title = $_POST['news_title'] ?? '';
    $news_content = $_POST['news_content'] ?? '';

    if (!empty($news_title) && !empty($news_content)) {
        // Prepare the SQL statement to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO news (news_title, news_content) VALUES (?, ?)");
        $stmt->bind_param("ss", $news_title, $news_content);

        if ($stmt->execute()) {
            $message = "News posted successfully!";
        } else {
            $message = "Error posting news: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $message = "Please fill in all fields.";
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post News</title>
    <style>
        .header-bar {
            background-color: #006400;
            color: white;
            text-align: center;
            padding: 20px 0;
            font-size: 1.5em;
            font-weight: bold;
            margin-bottom: 20px;
        }

        h1 {
            margin: 0;
        }

        .header-logo {
            height: 50px;
            width: auto;
        }

        form {
            margin: 0 auto;
            max-width: 600px;
        }

        input,
        textarea {
            width: 100%;
            margin-bottom: 15px;
            padding: 10px;
            font-size: 1em;
        }

        #submit {
            background-color: #006400;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }

        #submit:hover {
            background-color: #004d00;
        }

        .message {
            text-align: center;
            font-size: 1em;
            margin: 10px 0;
            color: green;
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>
    <header>
        <div class="header-bar">
            <img src="../Asset/brta-logo-new.png" alt="BRTA Logo" class="header-logo">
            <h1>Post News</h1>
        </div>
    </header>

    <!-- Display success/error message -->
    <?php if (!empty($message)): ?>
        <div class="message <?php echo strpos($message, 'Error') === 0 ? 'error' : ''; ?>">
            <?php echo htmlspecialchars($message); ?>
        </div>
    <?php endif; ?>

    <!-- Form for posting news -->
    <form action="post_news.php" method="POST">
        <label for="news-title">News Title:</label>
        <input type="text" id="news-title" name="news_title" placeholder="Enter news title" required>

        <label for="news_content">News Description:</label>
        <textarea id="news_content" name="news_content" rows="5" placeholder="Enter news content" required></textarea>

        <input type="submit" id="submit" value="Submit">
    </form>

    <!--Go back to Homepage button-->
    </div>
    <div style="text-align: center; margin-top: 20px;">
        <a href="../View/home.html">
            <button
                style="padding: 10px 20px; background-color: #006400; color: white; cursor: pointer; border-radius: 5px;">
                Go Back to Homepage
            </button>
        </a>
    </div>
</body>

</html>