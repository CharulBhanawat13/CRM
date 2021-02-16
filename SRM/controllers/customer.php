<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>


<form id="setUserPass" method="post" action="fetchCustomers.php">
    <div >
    <input type="text" class="form-controls" name="username">
    <input type="password" class="form-controls" name="password">
    <input type="submit" name="setUserPass" class="form-controls" class="btn btn-primary" value="Assign">
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
    </div>
</form>


    <form id="showButton" method="post" action="fetchCustomers.php" >
        <input class="btn btn-primary" name="fetchCustomers" type="submit" value="Fetch Data">

    </form>
</html>


