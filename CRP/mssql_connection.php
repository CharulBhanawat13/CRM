<?php
function OpenCon()
{
    $dbhost = "90.0.0.199";
    $connectionInfo=array("Database"=>"CRM","UID"=>"sa","PWD"=>"lakecity");
    $conn = sqlsrv_connect($dbhost, $connectionInfo);
    if( $conn ) {

    }else{
        echo "Connection could not be established.<br />";
        die( print_r( sqlsrv_errors(), true));
    }
    return $conn;
}

function CloseCon($conn)
{
    sqlsrv_close($conn);
}

?>