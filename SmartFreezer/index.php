<?php
session_start();//session starts here
?>

<html>
<head>
    <link rel="stylesheet" href="css/theme.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <title>Login</title>

</head>
<body>
<div class="container-small">
    <form method="post" action="">
        <h1>Sign Up</h1>
        <label>Username</label>
        <input type="text" id="loginuser" class="form-control" placeholder="Username" name="username" autofocus>

        <label>Password</label>
        <input type="password" id="loginpass" class="form-control" placeholder="Password" name="pass" value="">

      <input type="submit" class="btn btn-success" value="login" name="login">

    </form>
</div>
</body>
</html>

<?php

include("db_connection.php");

if(isset($_POST['login']))
{
    $username=$_POST['username'];
    $password=$_POST['pass'];

    $check_user="select * from users WHERE username='$username'AND password='$password'";
    $conn = OpenCon();
    $run=mysqli_query($conn,$check_user);

    $result = mysqli_fetch_assoc($run);
    if(mysqli_num_rows($run))
    {
        $_SESSION['username']=$username;
        $_SESSION['bloodBankId']=(int)$result['bloodBankId'];
        $_SESSION['isAdmin']=(int)$result['isAdmin'];
        echo "<script>window.open('dashboard.php','_self')</script>";
    }
    else
    {
        echo "<script>alert('Email or password is incorrect!')</script>";
    }
    CloseCon($conn);
}
?>