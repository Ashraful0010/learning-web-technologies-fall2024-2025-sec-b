<?php
if (isset($_POST['submit'])) {
    $day = $_POST['day'];
    $month = $_POST['month'];
    $year = $_POST['year'];

    if (empty($day) || empty($month) || empty($year)) {
        echo "Date of birth cannot be empty!";
    } elseif (!is_numeric($day) || !is_numeric($month) || !is_numeric($year)) {
        echo "Date of birth must be numeric!";
    } elseif ($day < 1 || $day > 31 || $month < 1 || $month > 12 || $year < 1953 || $year > 1998) {
        echo "Invalid date of birth!";
    } else {
        echo "Your date of birth is : $day/$month/$year";
    }
}
?>