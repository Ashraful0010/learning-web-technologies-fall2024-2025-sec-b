<html>

<head>
    <title>Degree</title>
</head>

<body>
    <form method="post" action="">
        <fieldset>
            <legend><strong>Degree</legend>
            <table>
                <tr>
                    <td>
                        <input type="checkbox" name="degree[]" value="SSC"> SSC
                        <input type="checkbox" name="degree[]" value="HSC"> HSC
                        <input type="checkbox" name="degree[]" value="BSc"> BSc
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
        if (!empty($_POST['degree'])) {
            echo "Your selected degrees: ";
            foreach ($_POST['degree'] as $degree) {
                echo $degree . " ";
            }
        } else {
            echo "No degree selected!";
        }
    }
    ?>
</body>

</html>