<?php 
//include constants.php fpr siteurl
include('../config/constants.php');
    //1. destroy the session    
    session_destroy(); //unserts $_SESSION['user']

    //2. redirect to login page
    header("location:".SITEURL."administrator/login.php");
?>