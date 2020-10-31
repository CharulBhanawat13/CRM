
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
    <a style="float:right;margin-left: 15px;" href="../dashboard.php" ><i class="fa fa-home" ></i></a>
         <a style="float:right" href="../modals/EmployeeModal.php" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus" aria-hidden="true"></i></a>
         <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">   
        
      </div>
      
    </div>
  </div>
</div>

 <?php
include '../db_connection.php';
session_start();
if(isset($_SESSION['userType']) && ($_SESSION['username'])){
	$userType=$_SESSION['userType'];
	$username=$_SESSION['username'];
	$user_id=$_SESSION['user_id'];
}
 	if(isset($_SESSION['name_error'])){

	$name_error=$_SESSION['name_error'];
	echo "<script>alert('$name_error');</script>";
	unset($_SESSION['name_error']);
}
$conn = OpenCon();
$sql = 'SELECT cengineer_name, caddress,ccity,cstate,ccountry,cmobile_number,cemail_id,ckey_ac_manager,cuser_type,nid FROM tbl_employeeMaster
where isActive=1 and (cuser_name = "'.$username.'" OR cuser_type<'.$userType.') ';

//$sql="
//
//SELECT e.cengineer_name FROM tbl_employeemaster AS e
//WHERE e.ckey_ac_manager_id='$user_id'
//UNION
//select e1.cengineer_name from tbl_employeemaster As e1
//JOIN tbl_employeemaster e2
//ON e2.ckey_ac_manager_id=e1.nid
//WHERE e1.ckey_ac_manager_id='$user_id'
//
//UNION
//SELECT e3.cengineer_name FROM tbl_employeemaster AS e1
//JOIN tbl_employeemaster AS e2
//ON e2.ckey_ac_manager_id=e1.nid
//JOIN tbl_employeemaster AS e3
//ON e3.ckey_ac_manager_id=e2.nid
//
//WHERE e1.ckey_ac_manager_id='$user_id'
//";


$retval = mysqli_query( $conn, $sql );
echo "<table id='employeeTable'  name='employeeTable' >
<thead> 
<tr>
<th style='display:none;'>ID</th>
<th>Engineer's Name</th>
<th>Engineer's Name</th>
	
<th>Address</th>

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
	echo "<td style='display:none;'>" . $row['nid'] . "</td>";
	echo "<td ><a  href='#my_modal' data-toggle='modal' class='identifyingClass' data-id='my_id_value'><i class='fa fa-edit'></i></a></td>";
    echo "<td>" . $row['cengineer_name'] . "</td>";
	echo "<td>" . $row['caddress'] . "</td>";
    echo "<td>" . $row['ccity'] . "</td>";
    echo "<td>" . $row['cstate'] . "</td>";
    echo "<td>" . $row['ccountry'] . "</td>";
    echo "<td>" . $row['cmobile_number'] . "</td>";
    echo "<td>" . $row['cemail_id'] . "</td>";
    echo "<td>" . $row['ckey_ac_manager'] . "</td>";
	echo "<td class='action-view'><i class='fa fa-trash fa-2x' style='color:#4caf50;'</i></td>";
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
		if(i != 10 && i!=1){
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

    $('#city-dropdown').on('change', function() {
        var city_name = this.value;
        $.ajax({
            async: true,
            url: "../employee/states-by-cities.php",
            type: "POST",
            data: {
                city_name: city_name
            },
            cache: false,
            success: function(result) {
                $("#state-dropdown").html(result);


            }
        });
    });
    $('#city-dropdown').on('change', function() {
        var city_name = this.value;
        $.ajax({
            async: true,
            url: "../employee/country-by-state.php",
            type: "POST",
            data: {
                city_name: city_name
            },
            cache: false,
            success: function(result) {
                $("#country-dropdown").html(result);
            }
        });
    });

    $(function () {
        $(".identifyingClass").click(function () {
            var ID = table.row($(this).parents('tr').first()).data()[0];
            var name = table.row($(this).parents('tr').first()).data()[2];
            var address = table.row($(this).parents('tr').first()).data()[3];
            var city = table.row($(this).parents('tr').first()).data()[4];
            var state = table.row($(this).parents('tr').first()).data()[5];
            var country = table.row($(this).parents('tr').first()).data()[6];
            var mobileNumber = table.row($(this).parents('tr').first()).data()[7];
            //var altMobileNumber = table.row($(this).parents('tr').first()).data()[8];
            var email = table.row($(this).parents('tr').first()).data()[8];
            var keyAcManager = table.row($(this).parents('tr').first()).data()[9];



            $(".modal-body #name").val(name);
            $(".modal-body #address").val(address);
            $(".modal-body #city-dropdown").val(city);
            $(".modal-body #state-dropdown").val(state);
            $(".modal-body #country-dropdown").val(country);
            $(".modal-body #mobileNumber").val(mobileNumber);
            $(".modal-body #altMobileNumber").val(altMobileNumber);
            $(".modal-body #email").val(email);
            $(".modal-body #keyAcManager-dropdown").val(keyAcManager);

        })
    });
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
        <div class="modal fade" id="my_modal" tabindex="-1" role="dialog" aria-labelledby="my_modalLabel">
            <div class="modal-dialog" role="dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">UPDATE EMPLOYEE INFORMATION</h4>
                    </div>
                    <div class="modal-body">
                        <table>
                            <tr>
                                <td>Engineer&#39;s Name</td>
                                <td>
                                    <input type="text" name="name" id="name" class="form-control" maxlength="50"  required/>
                                </td>
                            </tr>
                            <tr>
                                <td>City</td>
                                <td>
                                    <select class="form-control" name="city" id="city-dropdown" required>
                                        <option value="">Select City</option>
                                        <?php
                                        require_once "../db_connection.php";
                                        $conn=OpenCon();
                                        $result = mysqli_query($conn,"SELECT * FROM tbl_city_state_country");
                                        while($row = mysqli_fetch_array($result)) {
                                            ?>
                                            <option value="<?php echo $row['ccity'];?>"><?php echo $row["ccity"];?></option>
                                            <?php
                                        }
                                        CloseCon($conn);
                                        ?>
                                    </select>

                                </td>
                            </tr>
                            <tr>
                                <td>State</td>
                                <td>
                                    <select class="form-control" name="state" id="state-dropdown" required>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Country</td>
                                <td>
                                    <select class="form-control" name="country" id="country-dropdown" required>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>
                                    <input type="text" name="address" id="address" class="form-control" required/>
                                </td>
                            </tr>

                            <tr>
                                <td>Mobile Number</td>
                                <td>
                                    <input type="text" name="mobilenumber" id="mobileNumber" maxlength="10" class="form-control" required/>
                                </td>
                            </tr>
                            <tr>
                                <td>Alternative Mobile Number</td>
                                <td>
                                    <input type="text" name="altmobilenumber" id="altMobileNumber" maxlength="10" class="form-control" required/>
                                </td>
                            </tr>

                            <tr>
                                <td>User Type</td>
                                <td>
                                    <select class="form-control" name="userType" id="userType-dropdown" required>
                                        <option value="">Choose one</option>
                                        <?php
                                        // A sample user type array
                                        $type = array('4'=>'Admin', '3'=>'Management', '2'=>'Manager','1'=> 'User');
                                        // Iterating through the product array
                                        foreach($type as $item => $value){
                                            echo "<option value='$item'>$value</option>";
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>

                                <td>Email id</td>
                                <td>
                                    <input type="text" name="emailId" id="email" class="form-control" maxlength="50" required/>
                                </td>
                            </tr>
                            <tr>
                                <td>Key A/C Manager</td>
                                <td>
                                    <select class="form-control" name="keyAcManagerId" id="keyAcManager-dropdown" required>

                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Username</td>
                                <td>
                                    <div <?php if (isset($name_error)): ?> class="form_error" <?php endif ?> >
                                        <input type="text" name="username" class="form-control" maxlength="50" required/>
                                        <?php if (isset($name_error)): ?>
                                            <span><?php echo $name_error; ?></span>
                                        <?php endif ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Password</td>
                                <td>
                                    <input type="password" name="password" class="form-control" maxlength="50" required/>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                        <button type="button" class="btn btn-primary">Yes</button>
                    </div>
                </div>
            </div>

</body>
</html>
