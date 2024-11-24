<?php
session_start();

if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (isset($_SESSION['user'])) {
        $storedUser = $_SESSION['user'];

        // Check credentials
        if ($storedUser['username'] === $username && $storedUser['password'] === $password) {
            header('Location: home.php');
            exit;
        } else {
            echo "Invalid username or password!";
        }
    }
}
?>
