<?php

$serverAddress = 'localhost';
$username = 'root';
$password = '';
$dbName = 'competitiongp_db';

$dbc = mysqli_connect($serverAddress, $username, $password, $dbName) or
    die("'Error connecting to MySQL server." . mysqli_connect_error());

mysqli_set_charset($dbc, "utf8");

// if ($dbc) {
//     echo "Connected successfully";
// } else {
//     echo "Connection failed";
// }
?>