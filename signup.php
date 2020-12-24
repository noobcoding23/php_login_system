<?php
$showAlert = false;
$showError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include 'partials/_dbconnect.php';
  $username = $_POST["username"];
  $password = $_POST["password"];
  $cpassword = $_POST["cpassword"];
  // $exists = false;
  // Check whether this username Exists
  $existSql = "SELECT * FROM `users` WHERE username = '$username'";
  $result = mysqli_query($conn, $existSql);
  $numExistRows = mysqli_num_rows($result);
  if ($numExistRows > 0) {
    // $exists = true;
    $showError = "Username already exists";
  }

  else {
    // $exists = false;
    if (($password == $cpassword)) {
      $sql = "INSERT INTO `users` (`username`, `password`, `dt`) VALUES ('$username', '$password', CURRENT_TIMESTAMP)";
      $result = mysqli_query($conn, $sql);
      if ($result) {
        $showAlert = true;
      }
    }
    
    else {
      $showError = "Passwords don't match";
    }
  }

}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="/CSS/master.css" />

    <title>SignUp</title>
  </head>
  <body>
    <?php require 'partials/_nav.php' ?>
    <?php
      if ($showAlert) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Your account is now created and now you can login
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="alert"
              aria-label="Close"
            ></button>
          </div>';
      }
      if ($showError) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> '. $showError .'
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="alert"
              aria-label="Close"
            ></button>
          </div>';
      }
    ?>

    <div class="container my-4">
      <h1 class="text-center">Signup to our website</h1>

      <form action="/signup.php" method="post">
        <div class="mb-3 my-4">
          <label for="username" class="form-label">Username</label>
          <input
            type="text"
            class="form-control"
            id="username"
            name="username"
            aria-describedby="emailHelp"
            required
          />
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input
            type="password"
            class="form-control"
            id="password"
            name="password"
            required
          />
        </div>
        <div class="mb-3">
          <label for="cpassword" class="form-label">Confirm Password</label>
          <input
            type="password"
            class="form-control"
            id="cpassword"
            name="cpassword"
            required
          />
          <div id="emailHelp" class="form-text">
            Make sure to type the same password
          </div>
        </div>
        <button type="submit" class="btn btn-primary">SignUp</button>
      </form>
    </div>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
