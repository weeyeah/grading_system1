<?php

require_once("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $username = $_POST["username"];
  $password = $_POST["password"];

  $checkQuery = "SELECT * FROM user WHERE username = '$username'";
  $checkResult = mysqli_query($conn, $checkQuery);

  if (mysqli_num_rows($checkResult) > 0) {
    echo "Username '$username' already exist, Please choose a different username.";
  } else {
    $insertQuery = "INSERT INTO user (username, password) VALUES ('$username', '$password')";
    $insertResult =  mysqli_query($conn, $insertQuery);

    if ($insertResult) {
      echo "Registration successful";

  } else {
    echo "Error: " . mysqli_error($conn);

  }
}

mysqli_close($conn);
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Grading System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
      <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card mt-5">
          <div class="card-header">
            <h1 class="text-center">Grading System</h1>
            <h2 class="text-center">Registration Form</h2>
          </div>
          <div class="card-body">
            <?php if (isset($error_message)) echo "<p class='text-danger text-center'>$error_message</p>"; ?>
            <form method="post" action="login.php">
              <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" name="username" required>
              </div><br>
              <div class="form-group">
                <label for="password">Passwod:</label>
                <input type="password" class="form-control" name="password" required>
              </div><br>
              <button type="submit" class="btn btn-primary btn-block">Register</button>

              <a href="login.php">Register new account</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>