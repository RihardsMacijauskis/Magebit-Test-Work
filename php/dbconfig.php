<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'login');
 
//Connecting to mysql database
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Checking connection
if($link === false){
    die("Couldn't create a connection: " . mysqli_connect_error());
}
?>