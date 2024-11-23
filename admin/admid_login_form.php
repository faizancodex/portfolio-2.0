<?php
    // Start the session and include necessary files
    session_start();
    include("../db_conn.php");

    // Check for form submission
    if (isset($_POST['signin'])) {
        // Perform login logic
        $query = "SELECT * FROM `admin_login` WHERE `email`='$_POST[emailaddress]' AND `password`='$_POST[loginpassword]'";
        $result = mysqli_query($conn, $query);
    
        if (mysqli_num_rows($result) == 1) {
            $_SESSION['AdminLoginId'] = $_POST['emailaddress'];
            header("location: dashboard.php");
            exit();
        } else {
            echo "<script>alert('Incorrect Email or Password');</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="media_query.css">
  <!-- favicon icon -->
  <link rel="icon" type="image" href="../images/favicon.ico">
</head>
<style>
  body {
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
  }
</style>

<body>
  <div class="form-cntr">
    <form method="POST" class="border p-4" enctype="multipart/form-data">
      <h1 class="h4 mb-3 fw-medium">Sign in</h1>
      <div class="form-floating ">
        <input type="email" name="emailaddress" class="form-control" id="floatingInput" placeholder="name@example.com" required>
        <label for="floatingInput">Email address</label>
      </div>
      <div class="form-floating">
        <input type="password" name="loginpassword" class="form-control my-2" id="floatingPassword" placeholder="Password" required>
        <label for="floatingPassword">Password</label>
      </div>

      <input value="Sign in" type="submit" name="signin" class="btn btn-primary w-100 py-2 my-3 "></input>
      <a class="text-decoration-none fs-6" href="">Forgot password?</a>
    </form>

  </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>