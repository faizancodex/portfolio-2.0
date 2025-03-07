<?php
// database connection
include("config.php");

// start session
session_start();
if (!isset($_SESSION['AdminLoginId'])) {
  header(("location: admin_login_form.php"));
}

// exit session
if (isset($_POST['logout'])) {
  session_destroy();
  header("location: admin_login_form.php");
}

//Display service data
$service_query = "SELECT * FROM services  ORDER BY service_id  DESC";
$service_data = mysqli_query($conn, $service_query);
$service_total = mysqli_num_rows($service_data);


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="viewport" content="width=1200">
  <title>Dashboard</title>
  <script src="https://kit.fontawesome.com/e674bba739.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="./assets/style.css">
  <link rel="stylesheet" href="./assets/media_query.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="icon" type="image" href="../images/favicon.ico">

</head>

<? //php echo isset($_SESSION['AdminLoginId']) ? $_SESSION['AdminLoginId'] : ''; 
?>

<body>
  <div class="main">
    <div class="cntr">


      <div class="sidebar">

        <div class="menu">
          <div class="logo-container">
            <div class="logo">faiz<span>an</span> </div>
          </div>
          <div class="menu-container">

          
            <div class="item">
              <a href="details.php" id="details"><i class="fa-solid fa-pen-to-square"></i> Customize</a>
            </div>

            <div class="item">
              <a href="email.php"><i class="fa-solid fa-envelope"></i>Email</a>
            </div>

            <div class="item">
              <a><i class="dropbtn fa-solid fa-user-group"></i>Services<i class="fa-solid fa-angle-down"></i></a>
              <div class="dropdown-content">
                <a data-bs-toggle="modal" data-bs-target="#ServiceModal1">+Add New</a>
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
          <span class="page-head">services</span>
          <div class="alert-box">
            <?php
            if (isset($_SESSION['status'])) {

            ?>
              <div class="alert-massege">
                <span class="alert-text"><?php echo $_SESSION['status']; ?></span>
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
              </div>
            <?php
              unset($_SESSION['status']);
            }
            ?>
            <?php
            if (isset($_SESSION['delete'])) {

            ?>
              <div class="alert-massege alert-danger">
                <span class="alert-text"><?php echo $_SESSION['delete']; ?></span>
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
              </div>
            <?php
              unset($_SESSION['delete']);
            }
            ?>
          </div>

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

              <table>
                <thead>
                  <tr>
                    <th>Title</th>
                    <th>Discription</th>
                    <th>Link</th>
                    <th>Icon</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  if ($service_total  != 0) {
                    while ($row = mysqli_fetch_array($service_data)) {
                      echo "
                                <tr>
                                  <td style='width: 130px;text-transform: capitalize;'>" . $row['Service_name'] . "</td>
                                  <td style='width: 400px;'>" . $row['Service_discription'] . "</td>
                                  <td><a target='_blank' href='" . $row['Service_link'] . "'>" . $row['Service_link'] . "</a></td>
                                  <td><img width='50px' src='pic/". $row['Service_icon'] . "' alt='Image Not found?'></td>
                                  <td>
                                    <div class='act-btn'>
                                      <a data-bs-toggle='modal' data-bs-target='#ServiceModal2{$row["service_id"]}' class='btn btn-primary'>Edit</a>
                                      <a style='margin-left: 10px;' class='btn btn-danger' href='./controllers/delete_service.php?service_id=" . $row["service_id"] . "'>Delete</a>
                                    </div>
                                  </td>
                                </tr>
                              ";
       // for update service 
                      echo "
                              <div class='modal fade' id='ServiceModal2{$row["service_id"]}' tabindex='-1' aria-labelledby='ModalLabel' aria-hidden='true'>
                                <div class='modal-dialog modal-lg'>
                                  <div class='modal-content'>
                                    <div class='modal-header'>
                                      <h1 class='modal-title fs-5' id='ModalLabel'>Update</h1>
                                      <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                    </div>
                                    <div class='modal-body'>
                                      <form action='./controllers/update_service.php' method='POST' enctype='multipart/form-data'>
                                        <div class='mb-3'>
                                          <label >Title:</label>
                                          <input name='Service_name' value='" . $row['Service_name'] . "' type='text' class='form-input'>
                                        </div>
                                        <div class='mb-3'>
                                          <label>Discription:</label>
                                          <textarea name='Service_discription' class='form-input' style='height: 110px;'>" . $row['Service_discription'] . "</textarea>
                                        </div>
                                        <div class='mb-3'>
                                          <label>Add Link:</label>
                                          <input name='Service_link' value='" . $row['Service_link'] . "' type='url' class='form-input'>
                                        </div>
                                        <div class='mb-3'>
                                          <label>Add Icon:</label><br>
                                          <input name='Service_icon' type='file'>
                                        </div>
                                        <input type='hidden' name='service_id' value='{$row["service_id"]}'>
                                        <div class='modal-footer'>
                                        <input name='update' type='submit' class='btn btn-primary' value='Update'>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              ";
                    }
                  } else {
                    echo '<tr><td colspan="5"><span class="No-email">No service are found?</span></td></tr>';
                  }
                  ?>

                </tbody>
              </table>

              <!-- for upload Service -->
              <div class="modal fade" id="ServiceModal1" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="ModalLabel">Add New</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                      <form method="POST" action="./controllers/upload_service.php" enctype="multipart/form-data">
                        <div class="mb-3">
                          <label>Title:</label>
                          <input type="text" class="form-input" name="Service_name">
                        </div>
                        <div class="mb-3">
                          <label>Discription:</label>
                          <textarea style="height: 110px;" class="form-input" name="Service_discription"></textarea>
                        </div>
                        <div class="mb-3">
                          <label>Link:</label>
                          <input type="url" class="form-input" name="Service_link">
                        </div>
                        <div class="mb-3">
                          <label>Icon:</label>
                          <br>
                          <input style="margin-top: 5px;" type="file" name="Service_icon">
                        </div>
                        <div class="modal-footer">
                          <input name="upload" type="submit" class="btn btn-primary" value="Upload">
                        </div>
                      </form>
                    </div>
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

<script>
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }
</script>
<!-- sweet alert CDN-->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>



</html>