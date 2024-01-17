<?php

require_once("db.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $password = $_POST["password"];
    

    $sql = "UPDATE user SET password = ? WHERE password = ?";
    $stmt = $conn->prepare($sql);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt->bind_param("ss", $hashed_password, $_GET["token"]);

    if ($stmt->execute()) {
      
        header("Location: login.php");
        exit();
    } else {
   
        $error_message = "Password reset failed.";
    }

    $stmt->close();
}


if (isset($_GET["token"])) {
    $token = $_GET["token"];
    $sql = "SELECT * FROM user WHERE password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (!$user) {
  
        $error_message = "Invalid or expired token.";
    }

    $stmt->close();
} else {
    
    $error_message = "Token not provided.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body>
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                <div class="card-body">

    <?php if (isset($error_message)) : ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php endif; ?>

    <form method="post" action="">
        <label for="password">New Password:</label>
        <input type="password" name="password" required>

        <!-- Add other input fields as needed -->

        <input type="submit" value="Reset Password">
    </form>
                      </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>

</body>
</html>
