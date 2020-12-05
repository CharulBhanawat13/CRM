<?php
require_once('utils/ServiceLayer.php');
include ('db_connection.php');
session_start();
if ($_SESSION['username'] == '') {
    header("location: index.php");
}else{
    $user_id = (int)$_SESSION['user_id'];

}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/sidebar.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css";

</head>
<body>

<div class="sidebar">
    <a class="active" href="dashboard.php">Dashboard</a>
    <a href="controllers/employeeDetails.php">Employee Details</a>
    <a href="controllers/organisation.php">Organisation</a>
    <a href="controllers/contactPerson.php">Contact Person</a>
    <a href="controllers/callList.php">Call List</a>
    <a href="controllers/visitPlan.php">Visit Plan</a>
    <a href="controllers/tour.php">Tour</a>
    <!--    <a href="controllers/test.php">Test</a>-->

</div>
<h1>PEPL Dashboard</h1>

<h2 id="bloc1" style='float:right'><a href="logout.php"><i class="fa fa-sign-out" ></i></a></h2>
<h2 id="bloc2" style='float:right'><?php echo "Welcome " . $_SESSION["username"] . "  ."; ?></h2>

<div id="gridLayout">
        <button id="call_list_button" name="call_list_button" class="accordion">Call List</button>
        <div class="panel">
            <p><?php
                $sql= ServiceLayer::getGridInformation('tbl_callList','nperson_id',$user_id);
            echo $sql?></p>
        </div>


        <button class="accordion">Visit Plan</button>
        <div class="panel">
            <p><?php
                $sql= ServiceLayer::getGridInformation('tbl_visitplan','nperson_to_meet_id',$user_id);
                echo $sql?></p>
        </div>

        <button class="accordion">Tour</button>
        <div class="panel">
            <p><?php
                $sql= ServiceLayer::getGridInformation('tbl_tour','nperson_to_meet_id',$user_id);
                echo $sql?></p>
        </div>
</div>


    <script>
        var acc = document.getElementsByClassName("accordion");
        var i;

        for (i = 0; i < acc.length; i++) {
            acc[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var panel = this.nextElementSibling;
                if (panel.style.maxHeight) {
                    panel.style.maxHeight = null;
                } else {
                    panel.style.maxHeight = panel.scrollHeight + "px";
                }
            });
        }
        </script>
</body>
</html>