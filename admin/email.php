<?php
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

$query = "SELECT * FROM email_inbox ORDER BY id DESC";
$data = mysqli_query($conn, $query);

$total = mysqli_num_rows($data);

// echo $total

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
  <link rel="stylesheet" href="media_query.css">
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
              <a href="dashboard.php"><i class="fa-solid fa-border-all "></i>Dashboard</a>
            </div>
            <div class="item">
              <a onClick="window.location.reload();"><i class="fa-solid fa-envelope"></i>Email</a>
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

            <?php
              if ($total != 0) {
                while ($row = mysqli_fetch_assoc($data)) {
                  echo
                  "
                  <div class='email-content'>
                    <span class='date_time'>".$row["date_time"]."</span>
                    <h2 class='name-heading'>Name: <br> <span class='faizan'>" . $row["fname"] . "</span></h2>
                    <h2 class='form-headings'>Email <br> <span>" . $row["email"] . "</span></h2>
                    <h2 class='form-headings'>Messages <br> <span class='message-box'>" . $row["message"] . "</span></h2>
                    <div class='int-btn'>
                    <a href='mailto:" . $row["email"] . "'><button class='btn btn-primary mx-2'>Reply</button></a>
                    <a class='btn btn-danger' href='delete_email.php?id=" . $row["id"] . "'>Delete</a> 
                    </div>
                  </div>

                  ";
                }
              } else {
                echo '<span class="No-email mx-2">No Emails found</span>';
              }
            ?>
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