<?php
session_start();

if (isset($_POST['submit'])) {
    $dob = trim($_POST['dob']);

    if ($dob == null) {
        echo "Null Date of birth!";
    } else {
        echo "The date you entered is:  $dob (yyy-mm-dd)";
    }
}
?>