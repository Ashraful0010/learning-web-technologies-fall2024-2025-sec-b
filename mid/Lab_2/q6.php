<?php

$numbers = array(10, 20, 30, 40, 50, 60, 70, 80, 90);
$searchElement = 40;
$found = false;

for ($i = 0; $i < count($numbers); $i++) {
    if ($numbers[$i] == $searchElement) {
        echo "Element found at index " . $i . "\r\n";
        $found = true;
        break;
    }
}

if (!$found) {
    echo "Element not found in the array.";
}
?>