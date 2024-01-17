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

    $sql = "DELETE FROM tblstudent WHERE S_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo '<script>
        if ($stmt->execute()) {
        echo "Are you sure you want to delete this";
        header("Location: index.php");
    } else {
        echo "Error deleting record: " . $stmt->error;
    }

    $stmt->close();
});
                window.location.href = "index.php";
              </script>';
    }

    $stmt->close();
}

$conn->close();
?>

