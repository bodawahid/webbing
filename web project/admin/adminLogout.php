<?php require_once("adminComp/header.php"); 
if(!isset($_SESSION['adminUserName'])) {
    header('location:adminLogin.php');
}
session_unset();    
session_destroy();   
header("location:adminLogin.php");

?> 



