<?php
function OpenCon()
{
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "test@123";
    $db = "crp";
 //   $dbuser = "pyrotech_crm";
 //   $dbpass = "Pyrotech@123";
//    $db = "pyrotech_crm";
    $conn = new mysqli($dbhost, $dbuser, $dbpass, $db) or die("Connect failed: %s\n" . $conn->error);

    return $conn;
}

function CloseCon($conn)
{
    $conn->close();
}

?>