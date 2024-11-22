<?php
if (isset($_POST['submit'])) {
    if (isset($_POST['gender'])) {
        echo "Your gender is : " . $_POST['gender'];
    } else {
        echo "Gender must be selected!";
    }
}
?>