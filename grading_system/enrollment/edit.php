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

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM enrollment WHERE ENROLLMENTID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $id = $row['ENROLLMENTID'];
        $studentid = $row['STUDID'];
        $courseid = $row['COURSEID'];
        $date_enrolled = $row['DATE_ENROLLED'];
    } else {
        echo "Enrollment not found.";
        exit();
    }

    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $studentid = $_POST['studentid'];
    $courseid = $_POST['courseid'];
    $date_enrolled = $_POST['date_enrolled'];

    $sql = "UPDATE enrollment SET STUDID=?, COURSEID=?, DATE_ENROLLED=? WHERE ENROLLMENTID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issi", $studentid, $courseid, $date_enrolled, $id);

    $stmt->execute();
    $stmt->close();

    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Edit Enrollment</title>
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
                <h2 class="fs-3 text-uppercase">Edit Enrollment</h2>
            </div>
            <div class="card-title text-left p-2">
                <a href="index.php" class="bg-primary text-decoration-none text-black mt-3 mb-3"><i class="fas fa-arrow-left"></i>Go Back</a>
            </div>
                        <form method="post" action="">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <div class="form-group">
                                    <label for="studentid">StudentID:</label>
                                        <input type="text" class="form-control" name="studentid" value="<?php echo $studentid; ?>" required>
                                        </div>
                                        <br>
                                    <div class="form-group">
                                <label for="courseid">CourseID:</label>
                            <input type="text" class="form-control" name="courseid" value="<?php echo $courseid; ?>" required>
                        </div>
                        <br>
                            <div class="form-group">
                                <label for="date_enrolled">Date Enrolled:</label>
                                    <input type="date" class="form-control" name="date_enrolled" value="<?php echo $date_enrolled; ?>" required>
                                </div>
                            <button type="submit" class="btn btn-primary btn-block">Edit</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>

<?php
$conn->close();
?>
