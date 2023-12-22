<?php include_once "../conn.php"; 

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin.css">
    <title>Admin Page</title>
</head>

<body>

    <header>
        <h1>Admin Dashboard</h1>
        <?php if(isset($_SESSION['adminUserName'])) : ?>    
        <a href="adminLogout.php" style="z-index:5 ; color: wheat;">logout</a>
        <?php endif ; ?>
    </header>
    <div class="sidenav">
        <?php if(isset($_SESSION['adminUserName'])) : ?>    
        <a href="adminHome.php">Home</a>
        <a href="adminCourses.php">Courses</a>
        <a href="adminInsert.php">Insert Video</a>
        <?php if($_SESSION['adminRole'] != 1) : ?>
        <a href="adminShow.php">Admin</a>
        <?php endif ; ?>
        <?php endif; ?>
    </div>