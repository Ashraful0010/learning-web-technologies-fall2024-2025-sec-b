
<?php
    session_start();
    if(!isset($_COOKIE['status'])){
        header('location: login.html');
    }

    $users = [
            ['username'=> 'alamin', 'email'=>'alamin@aiub.edu', 'password'=>123],
            ['username'=> 'abc', 'email'=>'abc@aiub.edu', 'password'=>123],
            ['username'=> 'xyz', 'email'=>'xyz@aiub.edu', 'password'=>123],
            ['username'=> 'xyz', 'email'=>'xyz@aiub.edu', 'password'=>123],
            ['username'=> 'xyz', 'email'=>'xyz@aiub.edu', 'password'=>123],
            ['username'=> 'xyz', 'email'=>'xyz@aiub.edu', 'password'=>123]
    ]
?>

<html>
<head>
    <title>View Users</title>
</head>
<body>
        <h2>User List</h2>
        <a href='home.php' > Back </a> | 
        <a href='logout.php' > logout </a>
        <br>
        <br>
        <table border=1>
            <tr>
                <td>Username</td>
                <td>Email</td>
                <td>Password</td>
                <td>Action</td>
            </tr>
           
            <?php
                for($i=0; $i<count($users); $i++){
            ?>
            <tr>
                <td><?php echo $users[$i]['username']; ?></td>
                <td><?php echo $users[$i]['email']; ?></td>
                <td><?=$users[$i]['username']?></td>
                <td>
                    <a href="edit.php?username=<?=$users[$i]['username']?>"> Edit </a> |
                    <a href="delete.php"> Delete </a>
                </td>
            </tr>
            <?php  } ?>
        </table>
 </body>
</html>
