<?php require_once("adminComp/header.php");
if(!isset($_SESSION['adminUserName'])) {
    header('location:adminLogin.php');
}
$error = "";
$err_image = "";
if (isset($_POST['submit'])) {
    if (empty($_POST['courseName']) || empty($_POST['details']) || empty($_POST['price']) ||  empty($_POST['level']) || empty($_POST['category']) || empty($_POST['duration']) || empty($_POST['requirements']) || empty($_POST['outcomes']) || empty($_POST['language'])) {
        $error = 'Please Fill All The Inputs';
    } else {
        $courseName = $_POST['courseName'];
        $details = $_POST['details'];
        $price = $_POST['price'];
        $requirements = $_POST['requirements'];
        $outcomes = $_POST['outcomes'];
        $category = $_POST['category'];
        $level = $_POST['level'];
        $duration = $_POST['duration'];
        $language = $_POST['language'];
        // directory name to store the uploaded image files
        // this should have sufficient read/write/execute permissions
        // if not already exists, please create it in the root of the
        // project folder
        $image =  $_FILES['file_image']['name'];
        // $image = $_FILES["image"]["name"];
        // $targetDir = "images/"; 
        $targetFile = "../images/" . basename($image);
        // $uploadOk = 1;
        // $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // // Validation of image ... 
        // $check = getimagesize($_FILES['image']['temp_name']);
        // if ($check === false) {
        //     $err_image = "File is not an image.";
        //     $uploadOk = 0;
        // }
        // if ($_FILES["image"]["size"] > 500000) {
        //     $err_image =  "Sorry, your file is too large.";
        //     $uploadOk = 0;
        // }
        // if (
        //     $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        //     && $imageFileType != "gif"
        // ) {
        //     $err_image = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        //     $uploadOk = 0;
        // }
        // if ($uploadOk == 1) {
        $insert = $conn->prepare('INSERT INTO courses (name_of_course , details , price , category , language , image , level , duration , owner_id) VALUES (:name_of_course , :details , :price , :category , :language , :image , :level , :duration , :owner_id) ');
        $insert->execute(
            [
                ':name_of_course' => $courseName,
                ':details' => $details,
                ':price' => $price,
                ':language' => $language,
                ':category' => $category,
                ':level' => $level,
                ':duration' => $duration,
                ':image' => $image,
                ':owner_id' => $_SESSION['adminId'],
            ]
        );
        $course_id = $conn->lastInsertId();
        $insert = $conn->prepare('INSERT INTO requirements (course_requirements , course_outcomes , course_id) VALUES (:course_requirements , :course_outcomes , :course_id)');
        $insert->execute(
            [
                ':course_requirements' => $requirements,
                ':course_outcomes' => $outcomes,
                ':course_id' => $course_id,
            ]
        );
        if (copy($_FILES['file_image']['tmp_name'], $targetFile)) {
            header('location:adminCourses.php');
        } else {
            $err_image = "Sorry, there was an error uploading your file.";
        }
    }
}


?>

<body>
    <div class="card">
        <h1 style="text-align: center; ">New Course</h1>
        <form enctype="multipart/form-data" action="adminCreateCourse.php" method="post" class="form-f">
            <label for="courseName">Course Name</label>
            <input id="courseName" class="login-input bord" name="courseName" type="text" placeholder="Enter course Name">
            <label for="details">details</label>
            <textarea id="details" rows="4" class="login-input bord" name="details" type="text" placeholder="Enter Course Details"></textarea>
            <label for="price">price</label>
            <input id="price" class="login-input bord" name="price" type="number" step="0.1" placeholder="Enter Your Price">
            <!-- <input id="username" class="login-input bord" name="password" type="text" placeholder="Enter a username"> -->
            <label for="Requirements">Requirements</label>
            <textarea name="requirements" rows="4" placeholder="Enter requirements"></textarea>
            <label for="outcomes">What will you learn</label>
            <textarea name="outcomes" id="outcomes" rows="4" placeholder="Enter outComes"></textarea>
            <label for="level">Level</label>
            <input id="level" class="login-input bord" name="level" type="text" placeholder="Enter Course Level">
            <label for="language">language</label>
            <input id="language" class="login-input bord" name="language" type="text" placeholder="Enter Course Language">
            <label for="image">course Image</label>
            <input id="image" class="login-input bord" name="file_image" type="file" required>
            <div><?php echo $err_image; ?></div>
            <label for="duration">duration</label>
            <input id="duration" class="login-input bord" name="duration" type="text" placeholder="Enter course Duration">
            <label for="category">Category</label>
            <select name="category" id="category">
                <option value="Category" selected hidden>choose one</option>
                <option value="web development">Web Development</option>
                <option value="data science">Data Science</option>
                <option value="network">Network</option>
                <option value="game development">Game Development</option>
                <option value="software design">Software Design</option>
                <option value="Database design">Database Design</option>
            </select>
            <input class="login-input send" type="submit" value="Create Course" name="submit">
            <div><?php echo $error; ?></div>
        </form>
    </div>
</body>



<?php require_once('adminComp/footer.php');
?>