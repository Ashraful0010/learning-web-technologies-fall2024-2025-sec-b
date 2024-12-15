<?php
session_start();

if (isset($_POST['login'])) {
    $id = trim($_POST['id']);
    $password = trim($_POST['password']);

    if (empty($id) || empty($password)) {
        echo "Id and password cannot be empty!";
        exit;
    }

    $file = fopen("users.txt", "r");
    $isValidUser = false;

    while ($line = fgets($file)) {
        list($stored_id, $stored_password, $name, $user_type) = explode(",", trim($line));

        if ($id === $stored_id && password_verify($password, $stored_password)) {
            $_SESSION['id'] = $stored_id;
            $_SESSION['name'] = $name;
            $_SESSION['user_type'] = $user_type;
            $isValidUser = true;

            if ($user_type === "Admin") {
                header("Location: admin_home.php");
            } else {
                header("Location: user_home.php");
            }
            exit;
        }
    }
    fclose($file);

    if (!$isValidUser) {
        echo "Invalid Id or Password!";
    }
} else {
    header('Location: login.html');
    exit;
}
?>