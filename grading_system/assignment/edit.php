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

$id = $course_name = $coursedesc = "";

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM assignment WHERE ASSIGN_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $assign_id = $row['ASSIGN_ID'];
        $course_id = $row['COURSE_ID'];
        $assignname = $row['ASSIGNNAME'];
        $total_points=$row['TOTAL_POINTS'];
        $due_date=$row['DUE_DATE'];
    } else {
        echo "Assignment not found.";
        exit();
    }

    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $assign_id = $_POST['assign_id'];
    $course_id = $_POST['course_id'];
    $assignname = $_POST['assignname'];
    $total_points = $_POST['total_points'];
    $due_date = $_POST['due_date'];

    $sql = "UPDATE assignment SET COURSE_ID=?, ASSIGNNAME=?, TOTAL_POINTS=?, DUE_DATE=? WHERE ASSIGN_ID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssi", $course_id, $assignname, $total_points, $due_date, $assign_id);
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
    <title>Edit Assignment</title>
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
                <h2 class="fs-3 text-uppercase">Edit New Assignment</h2>
            </div>
            <div class="card-title text-left p-2">
                <a href="index.php" class="bg-primary text-decoration-none text-black mt-3 mb-3"><i class="fas fa-arrow-left"></i>Go Back</a>
            </div>
                        <form method="post" action="">
                            <input type="hidden" name="assign_id" value="<?php echo $assign_id; ?>">
                            <div class="form-group">
                                <label for="course_id">Course ID:</label>
                                <input type="text" class="form-control" name="course_id" value="<?php echo $course_id; ?>" required>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="assignname">Assign Name:</label>
                                <input type="text" class="form-control" name="assignname" value="<?php echo $assignname; ?>" required>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="total_points">Total Points:</label>
                                <input type="text" class="form-control" name="total_points" value="<?php echo $total_points; ?>" required>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="due_date">Due Date:</label>
                                <input type="text" class="form-control" name="due_date" value="<?php echo $due_date; ?>" required>
                            </div>
                            <br>
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
