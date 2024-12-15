<?php
session_start();

if (isset($_POST['SignUp'])) {
    $id = trim($_POST['id']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    $name = trim($_POST['name']);
    $user_type = isset($_POST['user_type']) ? $_POST['user_type'] : null;


    if (empty($id) || empty($password) || empty($name) || empty($user_type)) {
        echo "All fields are required!";
    } elseif ($password !== $confirm_password) {
        echo "Passwords do not match!";
    } else {
        $file = fopen("users.txt", "a");
        fwrite($file, "$id,$hashed_password,$name,$user_type\n");
        fclose($file);

        echo "Registration successful! <a href='login.html'>Login here</a>";
    }
} else {
    header('Location: reg.html');
    exit;
}
?>