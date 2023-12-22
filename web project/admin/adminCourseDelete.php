<?php require_once("adminComp/header.php");
if(!isset($_SESSION['adminUserName'])) {
    header('location:adminLogin.php');
}
$id = $_GET['id'] ; 
$deleteCourse = $conn->query("delete from courses where id = $id");
$deleteCourse->execute();  
header("location:adminCourses.php");
// exit();
?> 