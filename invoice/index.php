


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
    <label style="margin-left: 35%;font-size: x-large;margin-top: 10px"><b>Invoice</b></label>

</div>

<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="controllers/invoice.php">Invoice</a>
    <a href="#">Debit Note</a>
    <a href="#">Credit Note</a>
    <a href="#">Purchase Return</a>

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

