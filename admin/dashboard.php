<?php
// for find error
error_reporting(0);
// database connection
include("../db_conn.php");

// start session
session_start();
if (!isset($_SESSION['AdminLoginId'])) {
  header(("location: admid_login_form.php"));
}

// exit session
if (isset($_POST['logout'])) {
  session_destroy();
  header("location: admid_login_form.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="viewport" content="width=1200">
  <title>Dashboard</title>
  <script src="https://kit.fontawesome.com/e674bba739.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="style.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="icon" type="image" href="../images/favicon.ico">

</head>

<?//php echo isset($_SESSION['AdminLoginId']) ? $_SESSION['AdminLoginId'] : ''; ?>

<body>
  <div class="main">
    <div class="cntr">


      <div class="sidebar">

        <div class="menu">
          <div class="menu-container">
            <div class="item">
              <a onClick="window.location.reload();"><i class="fa-solid fa-border-all "></i>Dashboard</a>
            </div>
            <div class="item">
              <a href="email.php"><i class="fa-solid fa-envelope"></i>Email</a>
            </div>
            <div class="item">
              <a href="details.php" class="sub-btn">
                <i class="fa-solid fa-pen-to-square"></i>Edit details
              </a>
            </div>

            <div class="item">
              <a><i class="dropbtn fa-solid fa-user-group"></i>Services<i class="fa-solid fa-angle-down"></i></a>
              <div class="dropdown-content">
                <a href="services.php">View Services</a>
              </div>
            </div>

            <div class="item">
              <a><i class="dropbtn fa-solid fa-file-circle-check"></i>Projects<i class="fa-solid fa-angle-down"></i></a>
              <div class="dropdown-content">
                <!-- <a data-bs-toggle="modal" data-bs-target="#ProjectModal1">+Add New</a> -->
                <a href="projects.php">View Projects</a>
              </div>
            </div>
          </div>
        </div>


        
      </div>

      <div class="right_sec">

        <nav>
          <div class="user">

            <span>Admin</span>
            <div class="dropdown">
              <button class="btn dropdown-toggle  " data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-user"></i>
              </button>

              <ul class="dropdown-menu my-3 border-0">
                <li><a class="dropdown-item" href="/faizan/index.php" target="_blank">Portfolio</a></li>
                <li>
                  <form method="POST">
                    <button class="dropdown-item" id="logout-btn" name="logout">Log Out</button>
                  </form>
                </li>
              </ul>

            </div>
          </div>
        </nav>

        <div class="mid">
          <div class="page_scroll">
            <div class="content-container">
              <h2 class="Overview">Overview</h2>

              <div class="dashboard-container gap-4">
                <div class="twodashboard">
                  <div class="dashboard1 gap-4">
                    <div class="card ">



                      <i class="fa-solid fa-eye"></i>
                      <h2>50k</h2>
                      <span>Total Visit</span>
                    </div>
                    <div class="card ">
                      <i class="fa-solid fa-dollar-sign"></i>
                      <h2>20</h2>
                      <span>Earning</span>
                    </div>
                    <div class="card ">
                      <i class="fa-solid fa-user-group"></i>
                      <h2>20k</h2>
                      <span>Total Follower</span>
                    </div>

                    <div class="card ">
                      <i class="fa-solid fa-envelope"></i>
                      <h2>200</h2>
                      <span>Total Email</span>
                    </div>
                  </div>

                  <div class="card card2">
                    <h2>Summary</h2>
                    <span>Total Email</span>
                  </div>
                </div>

                <div>
                  <div class="card card3">
                    <h2>faizan</h2>
                    <span>Total Email</span>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>

      </div>

    </div>
  </div>

</body>
<script src="script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>