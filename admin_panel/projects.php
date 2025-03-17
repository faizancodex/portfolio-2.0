<?php
// for find error
error_reporting(0);

// database connection
include("./config.php");

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


// project data display quary
$query = "SELECT * FROM project  ORDER BY id DESC";
$data = mysqli_query($conn, $query);

$total = mysqli_num_rows($data);
  // echo $total;


?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="viewport" content="width=1200">
  <title>Projects</title>
  <script src="https://kit.fontawesome.com/e674bba739.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="./assets/style.css">
  <link rel="stylesheet" href="./assets/media_query.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="icon" type="image" href="../images/favicon.ico">

  <!-- <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"> -->

</head>

<?//php echo isset($_SESSION['AdminLoginId']) ? $_SESSION['AdminLoginId'] : ''; ?>

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
                <a href="services.php">View Services</a>
              </div>
            </div>


            <div class="item">
              <a><i class="dropbtn fa-solid fa-file-circle-check"></i>Projects<i class="fa-solid fa-angle-down"></i></a>
              <div class="dropdown-content">
                <a data-bs-toggle="modal" data-bs-target="#ProjectModal1">+Add New</a>
                <!-- <a onClick="window.location.reload();">View Projects</a> -->
              </div>
            </div>


          </div>
        </div>

      </div>

      <div class="right_sec">
        <nav>
          <span class="page-head">Projects</span>
          <div class="alert-box">
            <?php 
              if (isset($_SESSION['status']))
              {

            ?>
            <div class="alert-massege">
              <span class="alert-text">
                <?php  echo $_SESSION['status']; ?>
              </span>
              <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            </div>
            <?php
                unset($_SESSION['status']);
              }
            ?>

            <?php 
              if (isset($_SESSION['delete']))
              {

            ?>
            <div class="alert-massege alert-danger">
              <span class="alert-text">
                <?php  echo $_SESSION['delete']; ?>
              </span>
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
                    <th>Image</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>

                  
                  <?php
                    if ($total != 0) {
                        while ($row = mysqli_fetch_array($data)) {
                            echo 
                            "
                            <tr>
                                <td style='width: 130px;'>". $row['project_name']."</td>
                                <td style='width: 400px;'>". $row['description']."</td>
                                <td><a href=". $row['link'].">". $row['link']."</a></td>
                                <td><img width='80px' src='pic/". $row['image_src']."'></td>
                                <td>
                                    <div class='act-btn'>
                                        <a data-bs-toggle='modal' data-bs-target='#ProjectModal{$row["id"]}' class='btn btn-primary'>Edit</a>
                                        <a style='margin-left: 10px;' class='btn btn-danger' href='./controllers/delete_project.php?id=" . $row["id"] . "'>Delete</a>
                                    </div>
                                </td>
                            </tr>
                            ";
                            
                            // update projects
                            echo "
                            <div class='modal fade' id='ProjectModal{$row["id"]}' tabindex='-1' aria-labelledby='ModalLabel' aria-hidden='true'>
                                <div class='modal-dialog modal-lg'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <h1 class='modal-title fs-5' id='ModalLabel'>Update</h1>
                                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                        </div>
                                        <div class='modal-body'>
                                              <form action='./controllers/update_project.php' method='POST' enctype='multipart/form-data'>
                                                <div class='mb-3'>
                                                    <label>Title:</label>
                                                    <input maxlength='100' value='". $row['project_name'] ."' type='text' class='form-input' name='project'>
                                                </div>
                                                <div class='mb-3'>
                                                    <label>Description:</label>
                                                    <textarea maxlength='250' class='form-input' style='height: 110px;' name='description'>". $row['description'] ."</textarea>
                                                </div>
                                                <div class='mb-3'>
                                                    <label>Add Link:</label>
                                                    <input value='". $row['link'] ."' type='url' class='form-input' name='add_link'>
                                                </div>

                                                <div class='mb-3'>
                                                  <label>Add Image:</label><br>
                                                  <input name='add_image' type='file'>
                                                </div>
                                                <input type='hidden' name='project_id' value='{$row["id"]}'>
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
                        echo '<tr><td colspan="5"><span class="No-email">No projects are found?</span></td></tr>';
                    }
                  ?>

                </tbody>
              </table>


              <!-- <a data-bs-toggle="modal" data-bs-target="#ProjectModal1" class="btn btn-primary">+ Add Project</a> -->

              <!-- for upload Project -->
              <div class="modal fade" id="ProjectModal1" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="ModalLabel">Add New</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                      <form action="./controllers/upload_project.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                          <label>Title:</label>
                          <input maxlength="50" name="project" type="text" class="form-input">
                        </div>
                        <div class="mb-3">
                          <label>Description:</label>
                          <textarea maxlength="250" style="height: 110px;" name="description"
                            class="form-input"></textarea>
                        </div>
                        <div class="mb-3">
                          <label>Link:</label>
                          <input name="add_link" type="url" class="form-input">
                        </div>

                        <div class="mb-3">
                          <label>Image:</label>
                          <br>
                          <input name="add_image" type="file">
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
  integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
  </script>
  

</html>