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