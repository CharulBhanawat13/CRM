<?php
function OpenMSSQLCon()
{
    $dbhost = "90.0.0.199";
    $connectionInfo=array("Database"=>"peplpack_new","UID"=>"sa","PWD"=>"lakecity");
    $conn = sqlsrv_connect($dbhost, $connectionInfo);
    if( $conn ) {
    }else{
        echo "Connection could not be established.<br />";
        die( print_r( sqlsrv_errors(), true));
    }
    return $conn;
}

function CloseMSSQLCon($conn)
{
    sqlsrv_close($conn);
}

?>