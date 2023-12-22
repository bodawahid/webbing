<?php require_once "conn.php"; ?>
<?php
$courses = $conn->query("SELECT Distinct category FROM courses");
$courses->execute();
$coursesList = $courses->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>

<head>
    <title> Benha university | Online E-learning platform</title>
    <meta charset="utf-8">
    <meta name="keywords" content="E-learning">
    <meta name="description" content="E-learning platform">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <!-- include library -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Ephesis&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Josefin+Sans&display=swap">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="page.css">
    <link rel="icon" href="images/uni_logo.png">
</head>

<body>
    <!-- header or nav bar -->
    <nav class="header">
        <div class="container">
            <div class="header-content"> <!-- to fix the float problem-->
                <div class="logo">
                    <a href="homepage.php">Benha university</a>
                    <!-- close logo div -->
                </div>

                <ul class="nav" id="nav">
                    <li><a href="homepage.php" class="active">Home</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Contact</a></li>
                    <li class="dropdown"><a href="#">Category</a>
                        <ul class="dropdown-menu">
                            <?php foreach ($coursesList as $cat) : ?>
                                <li>
                                    <a href="categoryPage.php?category=<?php echo $cat['category']; ?>"><?php echo $cat["category"]; ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>

                    </li>
                    <!-- added when user creates an email -->
                    <?php if (isset($_SESSION['username'])) : ?>
                        <li class="dropdown"><a href="#"><?php echo $_SESSION['username']; ?></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">My Courses</a></li>
                                <?php if (isset($_SESSION['adminUserName'])) : ?>
                                    <li><a href="admin/adminHome.php">Admin Page</a></li>
                                <?php else : ?>
                                    <li><a href="admin/adminRegister.php">become an instructor</a></li>
                                <?php endif; ?>
                                <li><a href="#">Account Settings</a></li>
                                <li><a href="logout.php">Log Out</a></li>
                            </ul>
                        </li>
                    <?php else : ?>
                        <li><a href="login.php">Login</a></li>
                        <li><a href="registeration.php">Registration</a></li>
                    <?php endif; ?>
                </ul>

                <div class="clear"></div> <!-- to solve float problem-->
                <!-- close header content  div -->

            </div>
            <!-- close container div -->

        </div>
        <!-- close header div -->
    </nav>

</body>