<?php
include ('db_connection.php');
session_start();
if ($_SESSION['username'] == '') {
    header("location: index.php");
}else{
    $username = $_SESSION['username'];

}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/sidebar.css">

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
    <!--    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>-->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css";

</head>
<body style="background-color:  #eee">
<!---->
<!--<div class="sidebar">-->
<!--    <a href="dashboard.php"><i class="fa fa-home fa-lg" aria-hidden="true"></i></a>-->
<!--    <a href="controllers/productList.php"><i class="fa fa-list fa-lg" aria-hidden="true"></i></a>-->
<!---->
<!--</div>-->
<div id="nav-placeholder">

<script>
    $(function(){
        $("#nav-placeholder").load("nav.html");
    });
</script>

</body>
</html>