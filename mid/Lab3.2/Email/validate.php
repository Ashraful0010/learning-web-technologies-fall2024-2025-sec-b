<?php
if (isset($_POST['submit'])) {
    $email = trim($_POST['email']);

    if (empty($email)) {
        echo "Email cannot be empty!";
    } elseif (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email)) {
        echo "Invalid email format! Please use a valid email like example@example.com.";
    } else {
        echo "Valid email: $email";
    }
}
?>