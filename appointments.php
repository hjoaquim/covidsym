<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'sim';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME) or die('Failed to connect to MySQL: ' . mysqli_error($connect));



?>