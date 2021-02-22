<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/theme.css">

</head>

<a style="float: right;margin-right: 10%" href="../dashboard.php" >Go Back to Dashboard</a>
<form id="setUserPass" method="post" action="fetchCustomers.php">
    <div class="container-small" style="background-color: #f1f1f1">
        <h3>Customer Mapping</h3>
        <span>Username</span>
        <input type="text" placeholder="abc@123" class="form-control" id="customerUser" name="username">
        <span>Password</span>
    <input type="password" placeholder="Passowrd" class="form-control" id="customerPassword" name="password">
    <select class="form-control" name="customer" id="customer-dropdown" required>
        <option value="">Select Customer</option>
        <?php
        require_once "../db_connection.php";
        $conn = OpenCon();

        $result = mysqli_query($conn, "SELECT * FROM tbl_customer");
        while ($row = mysqli_fetch_array($result)) {
            ?>
            <option value="<?php echo $row['ninternal_id']; ?>"><?php echo $row["ccustName"] . " &nbsp &nbsp ADDRESS  ".$row["ccustAddress"]; ?></option>
            <?php
        }
        CloseCon($conn);
        ?>
    </select>
        <input type="submit" name="setUserPass" style="margin-top: 5%" class="btn btn-primary" value="Assign">

    </div>
</form>


    <form id="showButton" method="post" action="fetchCustomers.php" >
        <input style="margin-left: 40%" class="btn btn-primary" name="fetchCustomers" type="submit" value="Fetch All Customers">

    </form>
</html>


