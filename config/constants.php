<?php
date_default_timezone_set('Europe/Sofia');
//start session
ob_start();
session_start();
//172.16.1.249
//Create consatans to Store Non Repeating values
define('SITEURL', "http://localhost/Moto_Krastev_Rent_&_Tour/");
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');

$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
$_SESSION['CREATE_DATABASE'] = "Yes";
//database connection
if($_SESSION['CREATE_DATABASE'] == "Yes"){
    define('DB_NAME', 'moto_krastev');
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error()); //select database name
}

?>