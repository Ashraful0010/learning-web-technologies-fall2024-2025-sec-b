<?php
require_once '../Model/newsModel.php';
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
$action = $data['action'] ?? '';

switch ($action) {
    case 'add':
        $title = $data['news_title'] ?? '';
        $content = $data['news_content'] ?? '';

        if (!empty($title) && !empty($content)) {
            $result = addNews($title, $content);
            echo json_encode(['success' => $result, 'message' => $result ? 'News added successfully.' : 'Failed to add news.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Please fill in all fields.']);
        }
        break;

    case 'fetch':
        $news = getAllNews();
        echo json_encode(['success' => true, 'news' => $news]);
        break;

    default:
        echo json_encode(['success' => false, 'message' => 'Invalid action.']);
        break;
}
?>