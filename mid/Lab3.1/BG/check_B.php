<html>

<head>
    <title>Blood Group</title>
</head>

<body>
    <form method="post" action="">
        <fieldset>
            <legend>Blood Group</legend>
            <table>
                <tr>
                    <td>
                        <select name="bg">
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" name="submit" value="Submit">
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>

    <?php
    session_start();

    if (isset($_POST['submit'])) {
        $bg = trim($_POST['bg']);

        if ($bg == null) {
            echo "No blood group selected !";
        } else {
            echo "Your blood group is : $bg";
        }
    }
    ?>
</body>

</html>