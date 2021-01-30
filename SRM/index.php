<?php
session_start();

//session starts here
?>

<html>
<head>
    <link rel="stylesheet" href="css/theme.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <title>Login</title>

</head>
<body style="background-color: #f1f1f1 ">
<div >
<div class="container-small" style="box-shadow: 10px 10px 5px grey;">
    <form method="post" action="">

        <h1>Sign In</h1>

        <br>
        <label>Username</label>
        <input type="text" id="loginuser" class="form-control" placeholder="Username" name="username" autofocus>

        <label>Password</label>
        <input type="password" id="loginpass"class="form-control" placeholder="Password" name="pass" value="">

        <input type="submit" class="btn btn-success" value="Login" name="login">

    </form>
</div>
    </div>
</body>
</html>

<?php

include("db_connection.php");

if(isset($_POST['login']))
{
    $username=$_POST['username'];
    $password=$_POST['pass'];

    $check_user="select * from tbl_login WHERE cusername='$username' AND cpassword='$password'";
    $conn = OpenCon();
    $run=mysqli_query($conn,$check_user);

    $result = mysqli_fetch_assoc($run);
    $user_id=$result['nuserId'];

    define("USERNAME",$username);

    if(mysqli_num_rows($run))
    {
        $_SESSION['username']=$username;
        $_SESSION['user_id']=$user_id;


        echo "<script>window.open('dashboard.php','_self')</script>";
    }
    else
    {
        echo "<script>alert('Email or password is incorrect!')</script>";
    }


    CloseCon($conn);
}
?>