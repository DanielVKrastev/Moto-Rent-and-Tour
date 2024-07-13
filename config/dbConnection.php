<?php
include('constants.php');

//$_SESSION['CREATE_DATABASE'] = "Yes";
//database connection
if($conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error())){
    define('DB_NAME', 'moto_krastev');
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());
}