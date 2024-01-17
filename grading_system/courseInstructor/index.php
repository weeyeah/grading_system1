<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "grading_system";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

$sql = "SELECT courseinstructor.id, courseinstructor.courseid, courseinstructor.instructorid, courseinstructor.startdate, courseinstructor.endDate, CONCAT(course.COURSE_NAME, ' ', courseinstructor.courseid) AS COURSENAME, CONCAT(instructor.FIRSTNAME, ' ', instructor.LASTNAME) AS InstructorFullName FROM courseinstructor LEFT JOIN course ON courseinstructor.courseid = course.COURSE_ID LEFT JOIN instructor ON courseinstructor.instructorid = instructor.INST_ID";

$result = $conn->query($sql);


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body class="sb-nav-fixed">
        <div class="container ">
             <h1 class="text-center">CourseInstructor Dashboard</h1>
             <div class="d-flex justify-content-between align-items-center">
                  <a href="../home.php" class="btn btn-transparent mt-3 mb-3"><i class="fas fa-arrow-left"></i> Go Back
                 </a>
                 <a href='add.php' class='btn btn-primary'>Add</a>
             </div>
                <table class="table table-striped">
                <thead>
                    <tr>
                        <th hidden>ID</th>
                        <th>Course ID</th>
                        <th>Instructor ID</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td hidden>" . $row["id"] . "</td>";
                            echo "<td>" . $row["courseid"] . "</td>";
                            echo "<td>" . $row["instructorid"] . "</td>";
                            echo "<td>" . $row["startdate"] . "</td>";
                            echo "<td>" . $row["endDate"] . "</td>";
                            echo "<td>
                                    <a href='edit.php?id=" . $row["id"] . "' class='btn btn-primary'>Edit</a>
                                    <a href='delete.php?id=" . $row["id"] . "' class='btn btn-danger'>Delete</a>
                                </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>No courseInstructor found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>

<?php
$conn->close();
?>
                    
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>