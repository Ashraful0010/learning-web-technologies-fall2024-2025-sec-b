<html>

<head>
    <title>Name</title>
</head>

<body>
    <fieldset>
        <legend>Name</legend>
        <form method="POST" action="">
            <table>
                <tr>
                    <td><input type="text" name="name" placeholder="Type your name here"></td>
                </tr>
                <br>
                <tr>
                    <td><input type="submit" name="submit" value="Submit"></td>
                </tr>
            </table>
        </form>
    </fieldset>

    <?php
    session_start();

    if (isset($_POST['submit'])) {
        $name = trim($_POST['name']);

        if ($name == null) {
            echo "Null name!";
        } else {

            echo "The name you entered is:  $name !";
        }
    }
    ?>
</body>

</html>

