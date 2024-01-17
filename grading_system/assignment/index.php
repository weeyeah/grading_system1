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

$sql = "SELECT *, CONCAT(`COURSE_ID`, ' - ', `ASSIGNNAME`) AS 'COURSE_NAME' FROM assignment";
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
             <h1 class="text-center">Assignment Dashboard</h1>
             <div class="d-flex justify-content-between align-items-center">
                  <a href="../home.php" class="btn btn-transparent mt-3 mb-3"><i class="fas fa-arrow-left"></i> Go Back
                 </a>
                 <a href='add.php' class='btn btn-primary'>Add</a>
             </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th hidden>ID</th>
                            <th>Course_Name</th>
                            <th>Name</th>
                            <th>Total Points</th>
                            <th>Due Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td hidden>" . $row["ASSIGN_ID"] . "</td>";
                            echo "<td>" . $row["COURSE_NAME"] . "</td>";
                            echo "<td>" . $row["ASSIGNNAME"] . "</td>";
                            echo "<td>" . $row["TOTAL_POINTS"] . "</td>";
                            echo "<td>" . $row["DUE_DATE"] . "</td>";
                            echo "<td>
                                    <a href='edit.php?id=" . $row["ASSIGN_ID"] . "' class='btn btn-primary'>Edit</a>
                                    <a href='delete.php?id=" . $row["ASSIGN_ID"] . "' class='btn btn-danger'>Delete</a>
                                </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>No students found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


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
