<?php
if (isset($_POST['submit'])) {
    $name = trim($_POST['name']);

    //rule A
    if (empty($name)) {
        echo "Name cannot be empty!";
    
    }
    //rule B
    elseif (str_word_count($name) < 2) {
        echo "Name must contain at least two words!";
    
    }
    //rule C & D
    elseif (!preg_match("/^[a-zA-Z][a-zA-Z .-]*$/", $name)) {
        echo "Name can contain a-z, A-Z, period, dash only !";
    }
    else{
        echo "Valid name: $name";
    }
}
?>