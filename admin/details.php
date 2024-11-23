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

// about data display quary
$query = "SELECT * FROM about ";
$data = mysqli_query($conn, $query);
$row = mysqli_fetch_array($data);

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

<? //php echo isset($_SESSION['AdminLoginId']) ? $_SESSION['AdminLoginId'] : ''; 
?>

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
              <a href="email.php"><i class="fa-solid fa-envelope"></i>Email</a>
            </div>
            <div class="item">
              <a onClick="window.location.reload();" class="sub-btn">
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

          <div class="alert-box">
            <?php
            if (isset($_SESSION['profile'])) {
            ?>
              <div class="alert-massege">
                <span class="alert-text"><?php echo $_SESSION['profile']; ?></span>
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
              </div>
            <?php
              unset($_SESSION['profile']);
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

              <h2>Profile</h2>
              <div class="int-box">
                <img src="<?php echo $row['Profile_image']; ?>" alt="Profile Not found?">
                <div class="int-btn">
                  <button style="margin-right: 10px;" type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#Modal5">Edit</button>

                  <!-- update profile -->
                  <div class="modal fade" id="Modal5" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="ModalLabel">Edit Profile</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                          <form method="POST" action="update_profile.php" enctype="multipart/form-data">
                            <div class="mb-3">
                              <label for="up-image" class="col-form-label">Upload Image:</label>
                              <input type="file" class="form-control" id="up-image" name="Profile_image" accept="image/*" required onchange="previewImage(event)">
                            </div>

                            <div class="mb-3">
                              <img id="image-preview" src="#" alt="Image Preview" style="display:none; max-width: 100%; height: auto;" />
                            </div>

                            <input type="hidden" name="about_id" value="<?php echo htmlspecialchars($row['about_id']); ?>">
                            <div class='modal-footer'>
                              <input name='update' type='submit' class='btn btn-primary' value='Update'>
                            </div>

                            <?php if (isset($_SESSION['error'])): ?>
                              <div class="alert alert-danger">
                                <?php echo htmlspecialchars($_SESSION['error']);
                                unset($_SESSION['error']); ?>
                              </div>
                            <?php endif; ?>

                            <?php if (isset($_SESSION['profile'])): ?>
                              <div class="alert alert-success">
                                <?php echo htmlspecialchars($_SESSION['profile']);
                                unset($_SESSION['profile']); ?>
                              </div>
                            <?php endif; ?>
                          </form>

                          <script>
                            function previewImage(event) {
                              const preview = document.getElementById('image-preview');
                              const file = event.target.files[0];

                              if (file) {
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                  preview.src = e.target.result;
                                  preview.style.display = 'block';
                                };
                                reader.readAsDataURL(file);
                              } else {
                                preview.src = "#";
                                preview.style.display = 'none';
                              }
                            }
                          </script>

                        </div>
                      </div>
                    </div>
                  </div>

                  <a class="btn btn-danger " href="">Delete</a>
                </div>
              </div>

              <h2>About</h2>
              <div class="int-box">I'm Faizan Khan, a software developer. I love building websites that look great and work
                smoothly. I'm all about making things easy to use and visually appealing. With my skills in both
                front-end and back-end development, Let's collaborate to transform your vision into reality and leave
                a
                lasting impact in the digital world.
                <div class="int-btn">
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#Modal1">Edit</button>

                  <div class="modal fade" id="Modal1" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="ModalLabel">About</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form>
                            <div class="mb-3">
                              <textarea class="form-control" style="height: 200px;">I'm Faizan Khan, a software developer. I love building websites that look great and work smoothly. I'm all about making things easy to use and visually appealing. With my skills in both front-end and back-end development, Let's collaborate to transform your vision into reality and leave a lasting impact in the digital world.
                    </textarea>

                            </div>
                          </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-primary">Update</button>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
              </div>

              <h2>Skills</h2>
              <div class="int-box">
                <ul>
                  <div>
                    <div class="icon-cntr">
                      <!-- for Update Skill -->
                      <a class="fa-solid fa-pen" data-bs-toggle="modal" data-bs-target="#updateskill"></a>
                      <a href="/"> <i class="fa-solid fa-trash"></i></a>
                    </div>
                    <li>Web Development<br><span>Building Website / Web Apps</span></li>
                  </div>
                  <div>
                    <div class="icon-cntr">
                      <!-- for Update Skill -->
                      <a class="fa-solid fa-pen" data-bs-toggle="modal" data-bs-target="#updateskill"></a>
                      <a href="/"> <i class="fa-solid fa-trash"></i></a>
                    </div>
                    <li>Web Development<br><span>Building Website / Web Apps</span></li>
                  </div>
                  <div>
                    <div class="icon-cntr">
                      <!-- for Update Skill -->
                      <a class="fa-solid fa-pen" data-bs-toggle="modal" data-bs-target="#updateskill"></a>
                      <a href="/"> <i class="fa-solid fa-trash"></i></a>
                    </div>
                    <li>Web Development<br><span>Building Website / Web Apps</span></li>
                  </div>
                </ul>
                <div class="int-btn">

                  <!-- for + Add Skill -->
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Modal2">+ Add
                    Skill</button>
                  <div class="modal fade" id="Modal2" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="ModalLabel">Add Skill</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form>
                            <div class="mb-3">
                              <label for="Skill-name" class="col-form-label">Enter Skill:</label>
                              <input type="text" class="form-control" id="Skill-name">
                            </div>
                            <div class="mb-3">
                              <label for="message-text" class="col-form-label">Discription:</label>
                              <textarea class="form-control" id="message-text"></textarea>
                            </div>
                          </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-primary">Upload</button>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- for Update Skill -->
                  <div class="modal fade" id="updateskill" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalLabel">Update Skill</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form>
                            <div class="mb-3">
                              <label for="s-name" class="col-form-label">Skill:</label>
                              <input value="Web Development" type="text" class="form-control" id="s-name">
                            </div>
                            <div class="mb-3">
                              <label for="message-text" class="col-form-label">Discription:</label>
                              <input value="Building Website / Web Apps" class="form-control" id="message-text">
                            </div>
                          </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-primary">Update</button>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
              </div>


              <h2>Education</h2>
              <div class="int-box">
                <ul>
                  <div>
                    <div class="icon-cntr">
                      <!-- for Update Education -->
                      <a data-bs-toggle="modal" data-bs-target="#UpdateEducation"><i class="fa-solid fa-pen"></i></a>
                      <a href="/"> <i class="fa-solid fa-trash"></i></a>
                    </div>
                    <li>Bachelor of Technology CSE-(AI)<br><span>2021-Current</span></li>
                  </div>
                  <div>
                    <div class="icon-cntr">
                      <!-- for Update Education -->
                      <a data-bs-toggle="modal" data-bs-target="#UpdateEducation"><i class="fa-solid fa-pen"></i></a>
                      <a href="/"> <i class="fa-solid fa-trash"></i></a>
                    </div>
                    <li>Bachelor of Technology CSE-(AI)<br><span>2021-Current</span></li>
                  </div>
                  <div>
                    <div class="icon-cntr">
                      <!-- for Update Education -->
                      <a data-bs-toggle="modal" data-bs-target="#UpdateEducation"><i class="fa-solid fa-pen"></i></a>
                      <a href="/"> <i class="fa-solid fa-trash"></i></a>
                    </div>
                    <li>Bachelor of Technology CSE-(AI)<br><span>2021-Current</span></li>
                  </div>
                </ul>

                <div class="int-btn">
                  <!-- for upload Education -->
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Modal3">+ Add
                    Education</button>
                  <div class="modal fade" id="Modal3" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="ModalLabel">Add Education</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form>
                            <div class="mb-3">
                              <label for="Course-name" class="col-form-label">Enter Course:</label>
                              <input type="text" class="form-control" id="Course-name">
                            </div>
                            <div class="mb-3">
                              <label for="pass-year" class="col-form-label">Passing Year:</label>
                              <input class="form-control" id="pass-year"></input>
                            </div>
                          </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-primary">Upload</button>
                        </div>
                      </div>
                    </div>
                  </div>


                  <!-- for Update Education -->
                  <div class="modal fade" id="UpdateEducation" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalLabel">Update Education</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form>
                            <div class="mb-3">
                              <label for="s-name" class="col-form-label">Enter Course:</label>
                              <input value="Bachelor of Technology CSE-(AI)" type="text" class="form-control"
                                id="s-name">
                            </div>
                            <div class="mb-3">
                              <label for="year-text" class="col-form-label">Passing Year:</label>
                              <input value="2021-Current" class="form-control" id="year-text">
                            </div>
                          </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-primary">Update</button>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
              </div>

              <h2>Certifications</h2>
              <div class="int-box">
                <ul>

                  <div>
                    <div class="icon-cntr">
                      <!-- for Update Certification -->
                      <a data-bs-toggle="modal" data-bs-target="#UpdateCertication"><i class="fa-solid fa-pen"></i></a>
                      <a href="/"> <i class="fa-solid fa-trash"></i></a>
                    </div>
                    <li>Web Development offered by Coursera<br><a href="images/Certificate.pdf" download>View</a></li>
                  </div>
                  <div>
                    <div class="icon-cntr">
                      <!-- for Update Certification -->
                      <a data-bs-toggle="modal" data-bs-target="#UpdateCertication"><i class="fa-solid fa-pen"></i></a>
                      <a href="/"> <i class="fa-solid fa-trash"></i></a>
                    </div>
                    <li>Web Development offered by Coursera<br><a href="images/Certificate.pdf" download>View</a></li>
                  </div>

                </ul>

                <div class="int-btn">

                  <!-- for upload certification -->
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Modal4">+ Add
                    Certificate</button>
                  <div class="modal fade" id="Modal4" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="ModalLabel">Add Certificate</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form>
                            <div class="mb-3">
                              <label for="Certificate-name" class="col-form-label">Certificate Name:</label>
                              <input type="text" class="form-control" id="Certificate-name">
                            </div>
                            <div class="mb-3">
                              <label for="up-certificate" class="col-form-label">Upload Certificate:</label>
                              <input type="file" class="form-control" id="up-certificate"></input>
                            </div>
                          </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-primary">Upload</button>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- for Update Certification -->
                  <div class="modal fade" id="UpdateCertication" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalLabel">Update Certificate</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form>
                            <div class="mb-3">
                              <label for="Certificate-name" class="col-form-label">Certificate Name:</label>
                              <input value="Web Development offered by Coursera" type="text" class="form-control"
                                id="Certificate-name">
                            </div>
                            <div class="mb-3">
                              <label for="year-text" class="col-form-label">Upload Certificate:</label>
                              <input type="file" value="2021-Current" class="form-control" id="year-text">
                            </div>
                          </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-primary">Update</button>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
              </div>

              <h2>Resume</h2>
              <div class="int-box">

                <ul>
                  <div class="icon-cntr">
                    <a data-bs-toggle="modal" data-bs-target="#Resumemodel"><i class="fa-solid fa-pen"></i></a>
                    <a href="/"> <i class="fa-solid fa-trash"></i></a>
                  </div>
                  <li><a href="images/my-resume.pdf" download>Download</a></li>
                </ul>

                <div class="modal fade" id="Resumemodel" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="ModalLabel">Add Resume</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form>
                          <div class="mb-3">
                            <label for="up-resume" class="col-form-label">Upload Resume:</label>
                            <input type="file" class="form-control" id="up-resume">
                          </div>
                        </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-primary">Update</button>
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
  </div>

</body>
<script src="script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>