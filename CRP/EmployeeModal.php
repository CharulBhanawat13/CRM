<html>
  <head>
    <meta name="generator"
    content="HTML Tidy for HTML5 (experimental) for Windows https://github.com/w3c/tidy-html5/tree/c63cc39" />
    <title></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  </head>
  <body>
    <form action="saveEmployeeData.php" method="post">
      <link rel="stylesheet" href="theme.css" />
      <div class="modal-header" id="themodal">
        <button type="button" class="close" data-dismiss="modal">X</button>
        <h1>Add new Employee</h1>
      </div>
      <div class="modal-body">
        <div class="panel panel-default">
          <div class="panel-heading text-center">Employee Information</div>
          <div class="panel-body">
            <table>
              <tr>
                <td>Engineer&#39;s Name</td>
                <td>
                  <input type="text" name="name" class="form-control" maxlength="50" required/>
                </td>
              </tr>
			  <tr>
                <td>City</td>
                <td>
                  <select class="form-control" name="city" id="city-dropdown" required>
                        <option value="">Select City</option>
                        <?php
                           require_once "db_connection.php";
						   $conn=OpenCon();
                           $result = mysqli_query($conn,"SELECT * FROM tbl_city_state_country");
                           while($row = mysqli_fetch_array($result)) {
                           ?>
                        <option value="<?php echo $row['ccity'];?>"><?php echo $row["ccity"];?></option>
                        <?php
                         CloseCon($conn);
						 }
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
                  <input type="text" name="address" class="form-control" required/>
                </td>
              </tr>
               
              <tr>
                <td>Mobile Number</td>
                <td>
                  <input type="text" name="mobilenumber" maxlength="10" class="form-control" required/>
                </td>
              </tr>
			   <tr>
                <td>Alternative Mobile Number</td>
                <td>
                  <input type="text" name="altmobilenumber" maxlength="10" class="form-control" required/>
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
                  <input type="text" name="emailId" class="form-control" maxlength="50" required/>
                </td>
              </tr>
              <tr>
                <td>Key A/C Manager</td>
                <td>
				 <select class="form-control" name="keyAcManager" id="keyAcManager-dropdown" required>
                      
                     </select>
                </td>
              </tr>
              <tr>
                <td>Username</td>
                <td>
                  <input type="text" name="username" class="form-control" maxlength="50" required/>
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
        </div>
      </div>
      <div class="modal-footer">
        <div class="panel-footer">
        <button type="submit" class="btn btn-success" name="saveData">Save</button> 
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button></div>
      </div>
	  
    </form>
	<script>
      $(document).ready(function() {
    $('#city-dropdown').on('change', function() {
        var city_name = this.value;
        $.ajax({
			async: true,
            url: "states-by-cities.php",
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
			url: "country-by-state.php",
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
});
	$('#userType-dropdown').on('change', function() {
        var user_id = this.value;
		$.ajax({
			async: true,
			url: "keyacmanager-by-userType.php",
            type: "POST",
            data: {
                user_id: user_id
            },
            cache: false,
            success: function(result) {
                $("#keyAcManager-dropdown").html(result);
            }
        });
  });
      </script>
	
	
  </body>
</html>
