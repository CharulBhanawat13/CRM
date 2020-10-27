
<html>


<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="../css/theme.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>
<body>
<h1>Employee Details Page<h1>
<div class="container">
<a style="float:right" href="../modals/EmployeeModal.php" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus" aria-hidden="true"></i></a>
 <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">   
        
      </div>
      
    </div>
  </div>

</div>
<div id="editModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <p>Some text in the Modal..</p>
	<div data-include="../employee/EmployeeModal.html"></div>
  </div>

</div>




<?php
include '../db_connection.php';
session_start();
if(isset($_SESSION['userType']) && ($_SESSION['username'])){
	$userType=$_SESSION['userType'];
	$username=$_SESSION['username'];
}
 	if(isset($_SESSION['name_error'])){

	$name_error=$_SESSION['name_error'];
	echo "<script>alert('$name_error');</script>";
	unset($_SESSION['name_error']);
}
$conn = OpenCon();
$sql = 'SELECT cengineer_name, caddress,ccity,cstate,ccountry,cmobile_number,cemail_id,ckey_ac_manager,cuser_type,nengineer_id FROM tbl_employeeMaster 
where isActive=1 and (cuser_name = "'.$username.'" OR cuser_type<'.$userType.') ';
$retval = mysqli_query( $conn, $sql );
echo "<table id='employeeTable'  name='employeeTable' >
<thead> 
<tr>
<th style='display:none;'>ID</th>
<th>Engineer's Name</th>
	
<th>Adress</th>

<th>City</th>

<th>State</th>
<th>Country</th>
<th>Mobile Number</th>
<th>Email Id</th>
<th>Key A/C Manager</th>
<th>Delete</th>

</tr>
</thead>

	   <tbody>

";

   while ($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {
	echo "<tr>";  
	echo "<td style='display:none;'>" . $row['nengineer_id'] . "</td>";
    echo "<td><a href='../modals/EmployeeModal.php' data-toggle='modal' data-target='#myModal'>" . $row['cengineer_name'] . "</a></td>";
    echo "<td>" . $row['caddress'] . "</td>";
    echo "<td>" . $row['ccity'] . "</td>";
    echo "<td>" . $row['cstate'] . "</td>";
    echo "<td>" . $row['ccountry'] . "</td>";
    echo "<td>" . $row['cmobile_number'] . "</td>";
    echo "<td>" . $row['cemail_id'] . "</td>";
    echo "<td>" . $row['ckey_ac_manager'] . "</td>";
	echo "<td class='action-view'><i class='fa fa-trash fa-2x' style='color:#4CAF50;'</i></td>";

    echo "</tr>";
}
echo "</tbody></table>";

CloseCon($conn);
?>
<script>


$(document).ready(function() {
	 // Setup - add a text input to each footer cell
    $('#employeeTable thead tr').clone(true).appendTo( '#employeeTable thead' );
    $('#employeeTable thead tr:eq(1) th').each( function (i) {
        var title = $(this).text();
		if(i != 9){
        $(this).html( '<input class="form-control" type="text" placeholder="Search '+title+'" />' );
		}
		 $( 'input', this ).on( 'keyup change', function () {
            if ( table.column(i).search() !== this.value ) {
                table
                    .column(i)
                    .search( this.value )
                    .draw();
            }
        } );
   } );	
	var table =$('#employeeTable').DataTable({
		 orderCellsTop: true,
		 "dom": 'lrtip',
     }
    );  
$('#employeeTable').on('click','.action-view',function() {
    var ID = table.row($(this).parents('tr').first()).data()[0];
	alert(ID);
	 $.ajax({
			async: true,
            url:"../employee/saveEmployeeData.php",   
            type: "POST",    
           
            data:  {
			ID: ID
			},
			cache: false,
            success:function(result){
             window.location.reload();
            }
        });
});
} );
</script>

</body>
</html>
