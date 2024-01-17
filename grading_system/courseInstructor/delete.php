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

    $sql = "DELETE FROM courseInstructor WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo '<script>
                var confirmation = confirm("Record deleted successfully.");
                if (confirmation) {
                    window.location.href = "index.php"; // Redirect to your main page
                } else {
                    window.location.href = "index.php"; // Redirect to your main page
                }
              </script>';
    } else {
        echo '<script>
                alert("Error deleting record.");
                window.location.href = "index.php"; // Redirect to your main page
              </script>';
    }

    $stmt->close();
}

$conn->close();
?>
