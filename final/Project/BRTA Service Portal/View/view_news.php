<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: ../View/login.html");
    exit;
}
?>

<html>

<head>
    <title>View News</title>
    <style>
        body {
            font-family: 'Arial', Times, serif;
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

    <div class="news-container" id="news-container">
        <!-- News items will be dynamically inserted here -->
    </div>

    <!-- Go back to Homepage button -->
    <div style="text-align: center; margin-top: 20px;">
        <a href="../View/userHome.php">
            <button
                style="padding: 10px 20px; background-color: #006400; color: white; cursor: pointer; border-radius: 5px;">
                Go Back to Homepage
            </button>
        </a>
    </div>

    <script>
        // Fetch and display news using AJAX
        fetch('../Controller/newsController.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ action: 'fetch' })
        })
            .then(response => response.json())
            .then(data => {
                const newsContainer = document.getElementById('news-container');
                if (data.success) {
                    data.news.forEach(news => {
                        const newsItem = document.createElement('div');
                        newsItem.className = 'news-item';

                        const newsTitle = document.createElement('div');
                        newsTitle.className = 'news-title';
                        newsTitle.textContent = news.news_title;

                        const newsContent = document.createElement('div');
                        newsContent.className = 'news-content';
                        newsContent.textContent = news.news_content;

                        newsItem.appendChild(newsTitle);
                        newsItem.appendChild(newsContent);
                        newsContainer.appendChild(newsItem);
                    });
                } else {
                    newsContainer.innerHTML = '<p>No news available to display.</p>';
                }
            })
            .catch(error => {
                document.getElementById('news-container').innerHTML = '<p>Error loading news.</p>';
            });
    </script>
</body>

</html>