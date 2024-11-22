<?php
session_start();

if (isset($_POST['submit'])) {
    if (!empty($_POST['degree'])) {
        echo "Your selected degrees: ";
        foreach ($_POST['degree'] as $degree) {
            echo $degree . " ";
        }
    } else {
        echo "No degree selected!";
    }
}
?>