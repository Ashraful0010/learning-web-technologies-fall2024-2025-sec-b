<?php
require_once 'db.php';

// Add a news item
function addNews($news_title, $news_content)
{
    $conn = getConnection();
    $stmt = $conn->prepare("INSERT INTO news (news_title, news_content) VALUES (?, ?)");
    $stmt->bind_param("ss", $news_title, $news_content);
    $result = $stmt->execute();
    $stmt->close();
    $conn->close();
    return $result;
}

// Fetch all news
function getAllNews()
{
    $conn = getConnection();
    $result = $conn->query("SELECT news_title, news_content FROM news");
    $news = $result->fetch_all(MYSQLI_ASSOC);
    $conn->close();
    return $news;
}
?>