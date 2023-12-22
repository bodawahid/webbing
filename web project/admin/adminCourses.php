<?php include_once "adminComp/header.php";
if(!isset($_SESSION['adminUserName'])) {
    header('location:adminLogin.php');
}
if($_SESSION['adminRole'] == 1) {
$adminId = $_SESSION['adminId'];
$data = $conn->query("SELECT * FROM courses where owner_id = '$adminId'");
$data->execute();
$courseData = $data->fetchAll(PDO::FETCH_ASSOC);
} else {
$data = $conn->query("SELECT * FROM courses");
$data->execute();
$courseData = $data->fetchAll(PDO::FETCH_ASSOC);

}

?>

<main class="content">
    <section>
        <h2>My Courses</h2>
    </section>
</main>

<head>
<style>
        .heading{

        }
        table {
            border: 2px aliceblue solid;
            /* position: absolute; */
            /* top: 30%;
            left: 20%;*/
            width: fit-content;
            border-collapse: separate;
        }

        th,
        td {
            padding: 10px;
            border: 2px aliceblue solid;
            text-align: center;
        }

        thead,
        tbody:nth-child(odd) {
            background-color: aliceblue;
        }

        .card {
            /* width: 80%; */
            position: relative;
            width: fit-content;
            height: fit-content;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-left: 11%;
            margin-top: 10%;
            margin-right: 1%;
            margin-bottom: 5%;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding-right: 2%;
        }

        .card-content {
            padding: 20px;
            width: 100%;
        }

        .btn:active,
        .btn {
            display: inline-block;
            padding: 8px 12px;
            color: gainsboro;
            background-color: #0079dd;
            text-decoration: none;
            border-radius: 3px;
            margin-top: 10px;
        }

        .card-content div {
            margin-left: 66%;
            /* margin: fit-content; */
        }

        .card-content div .btn {
            margin-top: 5%;
        }

        .mg {
            margin-bottom: 2%;
        }
        .courseImg{
            max-width: 40%;
            max-height: 40%;
        }
        .contentTable{
            margin: 10px;
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="card-content">
            <div class="mg">
                <a href="adminCreateCourse.php" class="btn">Create a new Course</a>
            </div>
            <table>
                <thead>
                    <th>
                        #
                    </th>
                    <th>
                        Course Image
                    </th>
                    <th>
                        Course Name
                    </th>
                    <th>
                        Course Details
                    </th>
                    <th>
                        Duration
                    </th>
                    <th>
                        Price
                    </th>
                    <th>
                        Update
                    </th>
                    <th>
                        Delete
                    </th>
                </thead>
                <?php foreach ($courseData as $data) : ?>
                    <tbody>
                        <td>
                            <img src="../images/<?php echo $data['image']; ?>">
                        </td>
                        <td>
                            <?php echo $data['id']; ?>
                        </td>
                        <td>
                            <?php echo $data['name_of_course'];  ?>
                        </td>
                        <td>
                            <?php echo $data['details'];  ?>
                        </td>
                        <td>
                            <?php echo $data['duration'];  ?>

                        </td>
                        <td>
                            <?php echo $data['price'];  ?>
                        </td>
                        <td>
                            <a href="adminUpdate.php?id=<?php echo $data['id']; ?>" class="btn">Update</a>

                        </td>
                        <td>
                            <a href="adminCourseDelete.php?id=<?php echo $data['id']; ?>" class="btn">Delete</a>

                        </td>
                    </tbody>
                <?php endforeach; ?>
            </table>
        </div>
    </div>

</body>

</html>
<?php include_once "adminComp/footer.php" ?>;