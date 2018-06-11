<?php
    global $con;
    $user="root";
    $pass="6d51b9e1e78a2ef67e414eadbca33172019fd1cf913a0f2d";
    $host="localhost";
    $db="casino_panel";
    $con = mysqli_connect($host,$user,$pass,$db);
    mysqli_set_charset($con,"utf8");
    @ini_set('display_errors', '1');
    if(!isset($_SESSION))
    {
        session_start();
    }
?>
