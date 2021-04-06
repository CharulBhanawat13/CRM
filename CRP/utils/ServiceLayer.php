<?php
  


class ServiceLayer
{
    function getMaximumID($table_name,$column_name){
        $conn = OpenCon();
        $sql = "CALL GETMAXIMUM('$table_name','$column_name',@total)";
        $result = mysqli_query($conn, $sql);
        $sql="SELECT @total";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        if(is_null($row['@total'])){
            $internal_id=$row['@total']=1;
        }else{
            $internal_id=$row['@total']=$row['@total']+1;
        }
        CloseCon($conn);
        return $internal_id;
    }

    function  getGridInformation($table_name,$column_name,$user_id)
    {

        $conn = OpenCon();
        $sql = "Select T2.cperson_name from " . $table_name . " as T1 
        join tbl_contactperson AS T2
        ON T2.ncontact_person_id=T1." . $column_name . "
        where   T1.nlogged_in_user_id=$user_id";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $msg="You have a meeting with ";
            while ($row = mysqli_fetch_array($result)) {
                $msg=$msg ." ".$row['cperson_name'];
            }
        }else{
            $msg="You have no meetings for today";
        }
        return $msg;
        CloseCon(conn);

    }

function preparePermissionRoleQuery(){
      session_start();
    if (isset($_SESSION['user_id'])) {
        $user_id = (int)$_SESSION['user_id'];
    }
    $isAvailable=1;
    $sql="select * from(
    	(select e.nemployee_unique_id
        from tbl_employeemaster AS e where e.nemployee_unique_id=$user_id AND e.isAvailable=$isAvailable) 
        
        union (select e.nemployee_unique_id
       	from tbl_employeemaster AS e where e.nkey_ac_manager_id=$user_id AND e.isAvailable=$isAvailable) 
        
        union
        (select e2.nemployee_unique_id
        from tbl_employeemaster AS e1 
        JOIN tbl_employeemaster AS e2 
        ON e2.nkey_ac_manager_id=e1.nemployee_unique_id
        where e1.nkey_ac_manager_id=$user_id AND e2.isAvailable=$isAvailable) 
        
        union
        (select e3.nemployee_unique_id
         from tbl_employeemaster AS e1 
        JOIN tbl_employeemaster AS e2 
        ON e2.nkey_ac_manager_id=e1.nemployee_unique_id
        JOIN tbl_employeemaster AS e3 
        ON e3.nkey_ac_manager_id=e2.nemployee_unique_id
        where e1.nkey_ac_manager_id=$user_id AND e3.isAvailable=$isAvailable)
		) AS q1";
    return $sql;
    }

}


?>