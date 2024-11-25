<?php
session_start();

if (isset($_POST['submit'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $errors = [];

    // Validate Name (used internet)
    if (empty($name)) {
        $errors[] = "Name cannot be empty!";
    } elseif (str_word_count($name) < 2) {
        $errors[] = "Name must contain at least two words!";
    } else {
        $isValidName = true;
        $allowedChars = range('a', 'z'); // Lowercase letters
        $allowedChars = array_merge($allowedChars, range('A', 'Z'), [' ']); // Add uppercase letters and spaces

        foreach (str_split($name) as $char) {
            if (!in_array($char, $allowedChars)) {
                $isValidName = false;
                break;
            }
        }

        if (!$isValidName) {
            $errors[] = "Name can contain only letters (a-z, A-Z) and spaces!";
        }
    }

    // Validate Email  (used internet)
    if (empty($email)) {
        $errors[] = "Email cannot be empty!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format! Please use a valid email like example@example.com.";
    }

    // Validate Username
    if (empty($username)) {
        $errors[] = "Username cannot be empty!";
    } elseif (str_word_count($username) > 1) {
        $errors[] = "No spaces are allowed in the username!";
    }

    // Validate Password
    if (empty($password)) {
        $errors[] = "Password cannot be empty!";
    } elseif (str_word_count($password) > 1) {
        $errors[] = "No spaces are allowed in the password!";
    } elseif (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters long!";
    }

    // Output Errors or Proceed
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "$error";
        }
    } else {
        // Store validated data in session
        $_SESSION['user'] = [
            'name' => $name,
            'email' => $email,
            'username' => $username,
            'password' => $password
        ];
        header('Location: login.html');
        exit;
    }
}
?>
