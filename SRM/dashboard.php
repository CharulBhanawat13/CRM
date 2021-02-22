


<html>
<!--<body style="background-image: url('assests/1_o-2GzWThE0LHTC1QykYD7Q.png') ;-->
<!--  -webkit-background-size: cover;-->
<!--  -moz-background-size: cover;-->
<!--  -o-background-size: cover;-->
<!--  background-size: cover;opacity: ">-->
<body style="background-color: #f1f1f1">
<head>
    <link rel="stylesheet" href="css/theme.css">
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<div id="top">
    <label style="margin-left: 35%;font-size: x-large;margin-top: 10px"><b>Service Relationship Model</b></label>
    <a style="float:right;margin-right: 10px" href="logout.php"><i class="fa fa-sign-out" ></i>Logout</a>

</div>

<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="#">About</a>
    <a href="controllers/services.php">Services</a>
    <a href="controllers/customer.php">Customer</a>
    <a href="#">Contact</a>
</div>

<div>
    <span style="font-size:25px;z-index:2;position: relative" onclick="openNav()">&#9776; </span>

</div>
<script>
    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }
</script>
</body>
</html>
