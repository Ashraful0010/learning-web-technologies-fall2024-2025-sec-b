<html>

<head>
    <title>Date of Birth</title>
</head>

<body>
    <fieldset>
        <legend>Date of Birth</legend>
        <form method="post" action="">
            <table>
                <tr>
                    <td><input type="date" name="dob"></td>
                </tr>
                <tr>
                    <td><input type="submit" name="submit" value="Submit"></td>
                </tr>
            </table>
        </form>
    </fieldset>

    <?php
    session_start();

    if (isset($_POST['submit'])) {
        $dob = trim($_POST['dob']);

        if ($dob == null) {
            echo "Null Date of birth!";
        } else {
            echo "The date you entered is:  $dob (yyy-mm-dd)";
        }
    }
    ?>

</body>

</html>
