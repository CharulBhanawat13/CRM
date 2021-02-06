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
}