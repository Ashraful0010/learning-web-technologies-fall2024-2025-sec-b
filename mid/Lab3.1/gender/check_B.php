<html>

<head>
    <title>gender</title>
</head>

<body>
    <fieldset>
        <table>
            <legend>Gender</legend>
            <form method="post" action="">
                <tr>
                    <td>
                        <input type="radio" name="gender" value="Male"> Male
                        <input type="radio" name="gender" value="Female"> Female
                        <input type="radio" name="gender" value="Other"> Other
                    </td>
                </tr>

                <tr>
                    <td>
                        <br>
                        <input type="submit" name="submit" value="submit">
                    </td>
                </tr>
            </form>
        </table>
    </fieldset>

    <?php
    session_start();

    if (isset($_POST['submit'])) {
        $gender = trim($_POST['gender']);

        if (empty($gender)) {
            echo "Select a gender!";
        } else {
            echo "Your gender is :  $gender !";
        }
    }
    ?>
</body>

</html>