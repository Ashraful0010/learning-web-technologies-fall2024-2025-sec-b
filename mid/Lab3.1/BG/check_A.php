<?php
session_start();

if (isset($_POST['submit'])) {
    $bg = trim($_POST['bg']);

    if ($bg == null) {
        echo "No blood group selected !";
    } else {
        echo "Your blood group is : $bg";
    }
}
?>