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
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
    <!--    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>-->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css";

</head>
<body style="background-color:  #eee">

<div class="sidebar">
    <img src="assets/CRM1.jpg" alt="CRM" height="15%" width="200px">
    <a class="active" href="dashboard.php">Dashboard</a>
    <a href="controllers/employeeDetails.php">Employee Details</a>
    <a href="controllers/segment.php">Segment </a>
    <a href="controllers/organisationGroup.php">Organisation Groups </a>
    <a href="controllers/organisation.php">Organisation</a>
    <a href="controllers/contactPerson.php">Contact Person</a>
    <a href="controllers/callList.php">Call List</a>
    <a href="controllers/visitPlan.php">Visit Plan</a>
    <a href="controllers/tour.php">Tour</a>
    <a href="controllers/stock.php">Stock </a>


</div>
    <h1 id='bloc1' style="margin-left: 41%;color: #0077c7">PEPL DASHBOARD</h1>
<h4 id='bloc2'  style='float:right;'><a href="logout.php"><i class="fa fa-sign-out" ></i>Logout</a></h4>

<h2  style='float:right'><?php echo "Welcome " . $_SESSION["username"] . "  ."; ?></h2>
<h5><b>CUSTOMER RELATIONSHIP MANAGEMENT</b><h5>


    <div id="gridLayout">

        <button type="button" class="accordion" data-container="body" data-toggle="popover" data-placement="top"
                data-content="<?php
                $sql= ServiceLayer::getGridInformation('tbl_callList','nperson_id',$user_id);
                echo $sql ?> "><i class="fa fa-bell"></i><b>Call List</b>
        </button>

        <button type="button" class="accordion" data-container="body" data-toggle="popover" data-placement="top"
                data-content="<?php
                $sql= ServiceLayer::getGridInformation('tbl_visitplan','nperson_to_meet_id',$user_id);
                echo $sql ?> "><i class="fa fa-bell"></i><b>Visit Plan</b>
        </button>

        <button type="button" class="accordion" data-container="body" data-toggle="popover" data-placement="top"
                data-content="<?php
                $sql= ServiceLayer::getGridInformation('tbl_tour','nperson_to_meet_id',$user_id);
                echo $sql ?> "><i class="fa fa-bell"></i><b>Tour</b>
        </button>


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
    $(document).ready(function(){
        $('[data-toggle="popover"]').popover();
    });
</script>

</body>
</html>