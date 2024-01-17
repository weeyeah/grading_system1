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


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $courseid = $_POST["courseid"];
    $instructorid = $_POST["instructorid"];
    $startdate = $_POST["startdate"];
    $endDate = $_POST["endDate"];

   $sql = "INSERT INTO courseInstructor (courseid, instructorid, startdate, endDate) VALUES ('$courseid', '$instructorid', '$startdate', '$endDate')";


    if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    header("Location: index.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Add CourseInstructor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body class="sb-nav-fixed">
    <section class="d-flex justify-content-center align-items-center">
    <div class="col-md-4">
        <div class="card shadow-md">
        <div class="card-body bg-secondary text-white rounded-2">
             <div class="card-title text-center p-2">
                <h2 class="fs-3 text-uppercase">Add New courseInstructor</h2>
            </div>
            <div class="card-title text-left p-2">
                <a href="index.php" class="bg-primary text-decoration-none text-black mt-3 mb-3"><i class="fas fa-arrow-left"></i>Go Back</a>
            </div>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="mb-3">
                    <label for="courseid" class="form-label">Course Name</label>
                    <input type="text" class="form-control" id="courseid" name="courseid" required>
                </div>
                <div class="mb-3">
                    <label for="instructorid" class="form-label">Instructor Full Name</label>
                    <input type="text" class="form-control" id="instructorid" name="instructorid" required>
                </div>
                <div class="mb-3">
                    <label for="startdate" class="form-label">Start Date</label>
                    <input type="date" class="form-control" id="startdate" name="startdate" required>
                </div>
                <div class="mb-3">
                    <label for="endDate" class="form-label">End Date</label>
                    <input type="date" class="form-control" id="endDate" name="endDate" required>
                </div>
                <div class="d-grid py-2">
                    <button type="submit" class="btn btn-primary rounded-pill">ADD CourseInstructor</button>
                </div>

                
            </form>
        </div>
    </div>    
    </section>


    

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>
