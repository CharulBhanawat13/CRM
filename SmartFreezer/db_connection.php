<?php
function OpenCon()
{
    $dbhost = "localhost";
  //  $dbuser = "pyrotech_BBR";
  //  $dbpass = "Pyrotech@123";
  //  $db = "pyrotech_bbr";
    $dbuser="root";
    $dbpass="test@123";
    $db="test";
    $conn = new mysqli($dbhost, $dbuser, $dbpass, $db) or die("Connect failed: %s\n" . $conn->connect_error);

    return $conn;
}

function CloseCon($conn)
{
    $conn->close();
}

?>