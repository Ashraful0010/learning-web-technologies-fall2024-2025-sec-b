<?php
if (isset($_POST['submit'])) {
    if (empty($_POST['degree'])) {
        echo "At least two degrees must be selected!";
    } else {
        $selectedDegrees = $_POST['degree'];

        if (count($selectedDegrees) < 2) {
            echo "At least two degrees must be selected!";
        } else {
            echo "Your selected degrees are:<br>";
            foreach ($selectedDegrees as $degree) {
                echo "- " . $degree . "<br>";
            }
        }
    }
}
?>