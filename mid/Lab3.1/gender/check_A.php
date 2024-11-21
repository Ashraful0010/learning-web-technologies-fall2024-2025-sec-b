<?php
session_start();

if (isset($_POST['submit'])) {
    $gender = trim($_POST['gender']);

    if (empty($gender)) {
        echo "Select a gender!";
    } else {
        echo "Your gender is :  $gender !";
    }
}
?>