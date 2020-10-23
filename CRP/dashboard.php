<?php
session_start();
if($_SESSION['username']==''){
	header("location: index.php");
}
?>


<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/sidebar.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>


<div class="sidebar">
  <a class="active" href="home">Home</a>
  <a href="controllers/employeeDetails.php">Employee Details</a>
  <a href="controllers/deadStock.php">Dead Stock</a>
  <a href="tender">Tender</a>
  <a href="invoice">Invoice</a>
  <a href="dues">Dues</a>
  <a href="productionPlanning">Production Planning</a>

</div>
<h1>PEPL Dashboard</h1>
<h1><a href="logout.php" ><i class="fa fa-sign-out"  style='float:right'></i></a><h1>
<marquee hspace="15%">Customer Relationship Management</marquee>



</body>
</html>