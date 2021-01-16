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
<body style="background-color:  #eee;height: 100%">
<div>
<div class="sidebar">
    <img src="assets/pepl.jpg" alt="CRM" height="15%" width="200px">
    <a class="active" href="dashboard.php"><i class="fa fa-tachometer" style="font-size: large; width: 20% " ></i>Dashboard</a>
    <a href="controllers/employeeDetails.php"><i class="fa fa-users" style="font-size: large; width: 20% " ></i>Employee Details</a>
    <a href="controllers/segment.php"><i class="fa fa-car" style="font-size: large; width: 20% " ></i>Segment </a>
    <a href="controllers/organisationGroup.php"><i class="fa fa-building-o" style="font-size: large; width: 20% " ></i>Organisation Groups </a>
    <a href="controllers/organisation.php"><i class="fa fa-building-o" style="font-size: large; width: 20% " ></i>Organisation</a>
    <a href="controllers/contactPerson.php"><i class="fa fa-address-book" style="font-size: large; width: 20% " ></i>Contact Person</a>
    <a href="controllers/callList.php"><i class="fa fa-phone" style="font-size: large; width: 20% " ></i>Call List</a>
    <a href="controllers/visitPlan.php"><i class="fa fa-car" style="font-size: large; width: 20% " ></i>Visit Plan</a>
    <a href="controllers/tour.php"><i class="fa fa-globe" style="font-size: large; width: 20% " ></i>Tour</a>
    <a href="controllers/stock.php"><i class="fa fa-houzz" style="font-size: x-large;width: 20% " ></i>
        Stock </a>
    <a href="controllers/facilities.php"><i class="fa fa-globe" style="font-size: large; width: 20% " ></i>Facilities</a>

</div>


    <h5>
        <div style="background-color: white;width: 100%;height: 40px;font-size: large;padding-top:0.5%">
            <b>
                𝐂𝐔𝐒𝐓𝐎𝐌𝐄𝐑 𝐑𝐄𝐋𝐀𝐓𝐈𝐎𝐍𝐒𝐇𝐈𝐏 𝐌𝐀𝐍𝐀𝐆𝐄𝐌𝐄𝐍𝐓

            </b>
            <a style="float:right;" href="logout.php"><i class="fa fa-sign-out" ></i>Logout</a>
            <div style="float: right"> <?php echo "𝐖𝐞𝐥𝐜𝐨𝐦𝐞 " . $_SESSION["username"] . "  ."; ?></div>
        </div>
    </h5>


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

        <div class="chat-popup" id="chatForm">
            <form action="/dashboard.php" class="form-container">
                <h1>Chat</h1>

                <label for="msg"><b>Message</b></label>
                <textarea placeholder="Type message.." name="msg" required></textarea>

                <button type="submit" class="btn">Send</button>
                <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
            </form>
        </div>

    <a class="open-button"><i class="fa fa-comments-o" style="font-size: 48px;color: #4CAF50" onclick="openForm()"></i></a>
        <script>

    function openForm() {
        document.getElementById("chatForm").style.display = "block";
    }

    function closeForm() {
        document.getElementById("chatForm").style.display = "none";
    }

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
</div>
</body>
</html>