<?php
$a = 100;
$b = 400;
$c = 800;

if ($a > $b and $a > $c) {
    echo "The largest number is " . $a;
} else if ($b > $a and $b > $c) {
    echo "The largest number is " . $b;
} else {
    echo "The largest number is " . $c;
}
?>