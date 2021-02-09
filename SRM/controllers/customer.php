<html>
<form id="setUserPass" method="post" action="fetchCustomers.php">
    <input type="text" name="username">
    <input type="password" name="password">
    <input type="submit" name="setUserPass" value="Assign">
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
</form>


    <form id="showButton" method="post" action="fetchCustomers.php" >
        <input class="btn btn-primary" name="fetchCustomers" type="submit" value="Fetch Data">

    </form>
</html>


