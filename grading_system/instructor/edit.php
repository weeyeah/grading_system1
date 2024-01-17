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

    $sql = "SELECT * FROM instructor WHERE INST_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $id = $row['INST_ID'];
        $firstname = $row['FIRSTNAME'];
        $lastname = $row['LASTNAME'];
        $inst_email = $row['INST_EMAIL'];


    } else {
        echo "Instructor not found.";
        exit();
    }

    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $inst_email = $_POST['inst_email'];

    $sql = "UPDATE instructor SET FIRSTNAME=?, LASTNAME=?, INST_EMAIL=? WHERE INST_ID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $firstname, $lastname, $inst_email, $id);
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
    <title>Edit Instructor</title>
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
                <h2 class="fs-3 text-uppercase">Edit Instructor</h2>
            </div>
            <div class="card-title text-left p-2">
                <a href="index.php" class="bg-primary text-decoration-none text-black mt-3 mb-3"><i class="fas fa-arrow-left"></i>Go Back</a>
            </div>
                        <form method="post" action="">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <div class="form-group">
                                <label for="firstname">First Name:</label>
                                <input type="text" class="form-control" name="firstname" value="<?php echo $firstname; ?>" required>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="lastname">Last Name:</label>
                                <input type="text" class="form-control" name="lastname" value="<?php echo $lastname; ?>" required>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="inst_email">INST_EMAIL:</label>
                                <input type="text" class="form-control" name="inst_email" value="<?php echo $inst_email; ?>" required>
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
