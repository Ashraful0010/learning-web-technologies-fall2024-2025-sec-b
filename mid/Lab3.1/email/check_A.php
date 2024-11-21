<?php
session_start();

if (isset($_POST['submit'])) {
    $email = trim($_POST['email']);
    if ($email == null) {
        echo "Null email !";
    } else {
        echo "The email you entered is:  $email";
    }
}
?>