<?php
require_once '../Model/userModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action'])) {
    if ($_GET['action'] === 'getAllUsers') {
        $users = getAllUsers();
        echo json_encode($users);
        exit;
    }
    if ($_GET['action'] === 'getUserDetails' && isset($_GET['username'])) {
        $username = $_GET['username'];
        $userDetails = getUserDetails($username);
        echo json_encode($userDetails);
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'updateUser') {
        $data = json_decode(file_get_contents("php://input"), true);
        $result = updateUser(
            $data['username'],
            $data['firstname'],
            $data['lastname'],
            $data['email'],
            $data['phone'],
            $data['dob']
        );
        echo json_encode(['success' => $result]);
        exit;
    }
}
?>