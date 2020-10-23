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
<h1><a href="logout.php" class="btn btn-danger">Logout</a><h1>
<marquee hspace="15%">Customer Relationship Management</marquee>



</body>
</html>