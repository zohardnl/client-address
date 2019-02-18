<?php

$server     = "localhost";
$username   = "anielde4_daniel";
$password   = "Zohardnl147!";
$db         = "anielde4_db";

// create a connection
$conn = mysqli_connect( $server, $username, $password, $db );

// check connection
if( !$conn ) {
    die( "Connection failed: " . mysqli_connect_error() );
}

?>