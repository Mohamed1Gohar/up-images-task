<?php

session_start();

$server = "localhost";
$dbName = "task-files";
$dbUser = "admin";
$dbPassword = "N3w_p@ssw0rD.";


$con =  mysqli_connect($server, $dbUser, $dbPassword, $dbName);

if (!$con) {
    die('Error : ' . mysqli_connect_error());
}
