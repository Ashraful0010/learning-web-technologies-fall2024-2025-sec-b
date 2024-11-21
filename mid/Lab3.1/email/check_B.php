<html>

<head>
    <title>Email</title>
</head>

<body>
    <fieldset>
        <legend>Email</legend>
        <form method="post" action="">
            <table>
                <tr>
                    <td><input type="email" name="email" placeholder="Type your email"></td>
                    <td>
                        <abbr title="hint: sample@example.com">
                            <button>i</button>
                        </abbr>
                    </td>
                </tr>
                <tr>
                    <td>
                        <br>
                        <input type="submit" name="submit" value="Submit">
                        </a>
                    </td>
                </tr>
            </table>
        </form>
    </fieldset>

    <?php
    session_start();

    if (isset($_POST['submit'])) {
        $email = trim($_POST['email']);
        if ($email == null) {
            echo "Null email !";
        } else {
            echo "The email you entered is:  $email";
        }
    }
    ?>

</body>

</html>