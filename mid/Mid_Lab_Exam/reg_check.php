<?php
if (isset($_POST['submit'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $username = trim($_POST['username']);
    //name validation
    if (empty($name)) {
        echo "Name cannot be empty!";

    } elseif (str_word_count($name) < 2) {
        echo "Name must contain at least two words!";
    } elseif (!ctype_alpha($name)) {
        echo "Name can contain a-z, A-Z only!";
    }

    //username validation
    elseif (empty($username)) {
    echo "Username cannot be empty";
    }
    elseif (str_word_count($username) > 1) {
        echo "No space is allowed in username";
    }
    //email validation
    elseif (empty($email)) {
        echo "Email cannot be empty! ";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format! Please use a valid email like example@example.com.";
    }
    //password validation
    elseif (empty($password)) {
        echo "Password cannot be empty!";
    } elseif (str_word_count($password) > 1) {
        echo "No spacing is allowd in password";
    } else {
        $_SESSION['user'] = [
            'name'=> $name,
            'email'=> $email,
            'username'=> $username,
            'password' => $password
        ];
        header('location: login.html');
    }

}
?>
