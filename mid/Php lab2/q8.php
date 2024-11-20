<?php
$arr = [
    [1, 2, 3, 'A'],
    [1, 2, 'B', 'C'],
    [1, 'D', 'E', 'F'],
];

for ($i = 0; $i < count($arr); $i++) {
    for ($j = 0; $j < count($arr[$i]); $j++) {
        if (is_numeric($arr[$i][$j])) {
            echo $arr[$i][$j] . " ";
        }
    }
    echo "<br>";
}
echo "<br>";

for ($i = 0; $i < count($arr); $i++) {
    for ($j = 0; $j < count($arr[$i]); $j++) {
        if (is_string($arr[$i][$j])) {
            echo $arr[$i][$j] . " ";
        }
    }
    echo "<br>";
}
?>
