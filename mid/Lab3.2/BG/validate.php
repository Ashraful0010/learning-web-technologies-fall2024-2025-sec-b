<?php
if (isset($_POST['submit'])) {
    if (!empty($_POST['blood_group'])) {
        echo "Selected blood group: " . $_POST['blood_group'];
    } else {
        echo "Blood group must be selected!";
    }
}
?>