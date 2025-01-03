<?php
// Start session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to login page if not logged in
    header("Location: ../View/login.html");
    exit;
}
?>

<html>

<head>
    <title>Application Fee List</title>
</head>
<style>
    .header-bar {
        background-color: #006400;


        color: white;
        text-align: center;
        padding: 20px 0;
        font-size: .7em;
        font-weight: bold;
        margin-bottom: 20px;
    }

    h1 {
        margin: 0;
    }

    .header-logo {
        height: 50px;
        width: auto;
    }

    .fee-table {
        margin: 0 auto;
    }
</style>

<body>

    <header>
        <div class="header-bar">
            <img src="../Asset/brta-logo-new.png" alt="brta logo" class="header-logo">
            <h1>BRTA Service Fee</h1>
        </div>

    </header>


    <table border="1" cellspacing="0" cellpadding="10" class="fee-table">
        <thead>
            <tr>
                <th>Serial Number</th>
                <th>Application Type</th>
                <th>Application Cost</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Driving License Application</td>
                <td>7,500 Taka</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Vehicle Registration</td>
                <td>25,000 Taka</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Road Permit Application</td>
                <td>5,000 Taka</td>
            </tr>
            <tr>
                <td>4</td>
                <td>Tax Token Renewal</td>
                <td>4,000 Taka</td>
            </tr>
            <tr>
                <td>5</td>
                <td>License Renewal</td>
                <td>5,000 Taka</td>
            </tr>
            <tr>
                <td>6</td>
                <td>Learner License Application</td>
                <td>1,500 Taka</td>
            </tr>
        </tbody>
    </table>
    <!--Go back to Homepage button-->
    </div>
    <div style="text-align: center; margin-top: 20px;">
        <a href="userHome.php">
            <button
                style="padding: 10px 20px; background-color: #006400; color: white; cursor: pointer; border-radius: 5px;">
                Go Back to Homepage
            </button>
        </a>
    </div>
</body>

</html>