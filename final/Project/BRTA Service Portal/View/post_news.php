<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: ../View/adminlogin.html");
    exit;
}
?>

<html>

<head>
    <title>Post News</title>
    <style>
        .header-bar {
            background-color: rgb(0, 152, 190);
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
            background-color: rgb(0, 152, 190);
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

    <!-- Form for posting news -->
    <form id="post-news-form">
        <label for="news-title">News Title:</label>
        <input type="text" id="news-title" name="news_title" placeholder="Enter news title">

        <label for="news_content">News Description:</label>
        <textarea id="news_content" name="news_content" rows="5" placeholder="Enter news content"></textarea>

        <input type="button" id="submit" value="Submit">
    </form>

    <!-- Success/Error message -->
    <div id="message" class="message"></div>

    <!-- Go back to Homepage button -->
    <div style="text-align: center; margin-top: 20px;">
        <a href="../View/adminHome.php">
            <button
                style="padding: 10px 20px; background-color: #006400; color: white; cursor: pointer; border-radius: 5px;">
                Go Back to Homepage
            </button>
        </a>
    </div>

    <script>
        document.getElementById('submit').addEventListener('click', function () {
            const title = document.getElementById('news-title').value.trim();
            const content = document.getElementById('news_content').value.trim();
            const messageDiv = document.getElementById('message');

            // Form validation
            if (!title || !content) {
                messageDiv.textContent = 'Please fill in all fields.';
                messageDiv.className = 'message error';
                return;
            }

            // AJAX request
            fetch('../Controller/newsController.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ action: 'add', news_title: title, news_content: content })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        messageDiv.textContent = data.message;
                        messageDiv.className = 'message';
                        document.getElementById('post-news-form').reset();
                    } else {
                        messageDiv.textContent = data.message;
                        messageDiv.className = 'message error';
                    }
                })
                .catch(error => {
                    messageDiv.textContent = 'Error submitting news.';
                    messageDiv.className = 'message error';
                });
        });
    </script>
</body>

</html>
