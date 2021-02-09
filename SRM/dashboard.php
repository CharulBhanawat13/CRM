
<html>
<body style="background-color: #f1f1f1">
<head>
    <link rel="stylesheet" href="css/theme.css">
    <link rel="stylesheet" href="css/sidebar.css">

</head>
<div id="top">
    <label style="margin-left: 35%;font-size: x-large;margin-top: 10px"><b>Service Relationship Model</b></label>
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
