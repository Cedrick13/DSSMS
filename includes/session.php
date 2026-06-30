<?php
session_start();

if(!isset($_SESSION['user_id']))
{
    header("Location: /DSSMS/login.php");
    exit();
}
?>