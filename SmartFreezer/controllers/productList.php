<?php
session_start();
if ($_SESSION['username'] == '') {
    header("location: index.php");
}else{
    $username = $_SESSION['username'];
    $bloodBankId=$_SESSION['bloodBankId'];
    $isAdmin=$_SESSION['isAdmin'];
}

?>
<html>
<head>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/theme.css">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/theme.css">
    <link rel="stylesheet" href="../css/sidebar.css">
    <script src="https://cdn.datatables.net/fixedheader/3.1.7/js/dataTables.fixedHeader.min.js"></script>

</head>

<body style="background-color: #eeeeee">

<div id="header" ;>
<img style="margin-left: 8%" src="../assests/pepl.jpg" width="100px" height="50px"" >
    <span id='servertime'  class="label label-default" id="servertime">Servertime: <?php echo date('d-m-Y H:i:s'); ?></span>

</div>

<div id="sidebar" style="z-index: 1" class="sidebar">
    <a href="../dashboard.php"><i class="fa fa-home fa-lg"></i></a>
    <a href="productList.php"><i class="fa fa-list fa-lg"></i></a>
</div>


<div id="bbrdiv" >
    <div  class="container">
        <span style="float: right;font-size: x-large;margin-right: 2%;margin-top: 1%"> Welcome <?php  echo $_SESSION['username']?></span>
        <a style="float: right;margin-right: 2%" href="../logout.php"><i class="fa fa-sign-out" ></i>Logout</a>

    </div>

    <?php


    include '../db_connection.php';

    $conn = OpenCon();
    if($isAdmin){
        $sql = "select * from bbr_data
                where (Serial_no, date) 
                in (select Serial_no, max(date) from bbr_data group by Serial_no)";
    }else{
        $sql="select * from bbr_data
                where (Serial_no, date) 
                in (select Serial_no, max(date) from bbr_data group by Serial_no) AND  BloodBankID=$bloodBankId;";
    }

    $count=1;
    $retval = mysqli_query($conn, $sql);
    echo "<table  style='background-color: white;width: 80%;' id='bbrTable'  name='bbrTable' >
                <thead> 
                <tr>
                <th style='display: none'>Serial_no</th>
                <th>VIEW</th>
                <th>SN</th>
                <th>BB ID</th>  
                <th>Blood Bank</th>
                <th>Prod ID</th>  
                <th>Product Name</th>
                <th>Time</th>
                <th>Serial No.</th>
                <th>Max Temp(deg C)</th>
                <th>Min Temp(deg C)</th>
                <th>Temparature</th>
                <th>Temp status</th>
                <th>Compressor</th>
                <th>Door</th>
                <th>Chamber light</th>
                <th>Blower</th>
                <th>Defrost status</th>
                <th>Alarm</th>
                <th>SMS</th>
                <th>User No.</th>
                <th>User Id</th>
                
                </tr>
                </thead>
                       <tbody>
                ";
    while ($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {
        echo "<tr>";
        echo "<td style='display: none'>".$row['Serial_no']."</td>";
        echo "<td ><a class='opendetails'><i class='fa fa-eye fa-2x'></i></a></td>";
        echo "<td>" . $count++ . "</td>";
        echo "<td>" . $row['BloodBankID'] . "</td>";
        echo "<td>" . $row['Blood_bank'] . "</td>";
        echo "<td>" . $row['ProductID'] . "</td>";
        echo "<td>" . $row['Product_name'] . "</td>";
        echo "<td style='text-align: center'>" .$row['date']. "</td>";
        echo "<td style='text-align: center'>" .$row['Serial_no']. "</td>";
        echo "<td style='text-align: center'>" . $row['SET_high_temp'] . "</td>";
        echo "<td style='text-align: center'>" . $row['SET_low_temp'] . "</td>";
        echo "<td style='text-align: center'>" . $row['Temperature'] . "</td>";
        echo "<td style='text-align: center'>" .$row['Temperature_status'] . "</td>";
        echo "<td style='text-align: center'>" .$row['Compressor'] . "</td>";
        echo "<td style='text-align: center'>" . $row['Door'] . "</td>";
        echo "<td style='text-align: center'>" .$row['Chamber_light'] . "</td>";
        echo "<td style='text-align: center'>" . $row['Blower'] . "</td>";
        echo "<td style='text-align: center'>" .$row['defrost_status'] . "</td>";
        echo "<td style='text-align: center'>" . $row['Alarm'] . "</td>";
        echo "<td style='text-align: center'>" . $row['SMS'] . "</td>";
        echo "<td style='text-align: center'>" . $row['user_no'] . "</td>";
        echo "<td style='text-align: center'>" . $row['userid'] . "</td>";

        echo "</tr>";
    }
    echo "</tbody></table>";
    CloseCon($conn);


    ?>
</div>
<script>

    $(document).ready(function () {
        var table = $('#bbrTable').DataTable({

                "dom": 'lrtip',
                "ordering": false,
            "scrollX": true


            }
        );
        $('#bbrTable tbody').on('click', '.opendetails', function () {
            var data = table.row($(this).parents('tr').first()).data()[0];
            var serial_no=data;
            window.open('../bbrdata.php?serial_no='+serial_no);


        } );
    });

</script>
</body>
</html>