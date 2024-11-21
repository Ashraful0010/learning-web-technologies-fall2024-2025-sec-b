<?php
    session_start();

    if(isset($_POST['submit'])){
        $name = trim($_POST['name']);

        if ($name == null){
            echo "Null name!";
    }
    else{
        echo "The name you entered is:  $name !";
    }
}
?>