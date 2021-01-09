<?php
function OpenCon()
{
    $dbhost = "localhost";
    $dbuser = "pyrotechlighting";
    $dbpass = "PY@LLigh%1254";
    $db = "pyrotech_BBR";
    $conn = new mysqli($dbhost, $dbuser, $dbpass, $db) or die("Connect failed: %s\n" . $conn->error);

    return $conn;
}

function CloseCon($conn)
{
    $conn->close();
}

?>