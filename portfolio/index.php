<?php
// database connection
include("config.php");

// Display project data 
$project_query = "SELECT * FROM project  ORDER BY id DESC";
$project_data = mysqli_query($conn, $project_query);
$project_total = mysqli_num_rows($project_data);

//Display service data
$service_query = "SELECT * FROM services  ORDER BY service_id  DESC";
$service_data = mysqli_query($conn, $service_query );
$service_total = mysqli_num_rows($service_data);

//Display about data
$about_query = "SELECT * FROM about";
$about_data = mysqli_query($conn, $about_query);
$row = mysqli_fetch_array($about_data)


// echo $total

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faizan</title>
    <!-- CSS -->
    <link rel="stylesheet" href="./assets/style.css">
    <link rel="stylesheet" href="./assets/media_query.css">
    <!-- fontawesom -->
    <script src="https://kit.fontawesome.com/e674bba739.js" crossorigin="anonymous"></script>
    <!-- favicon icon -->
    <link rel="icon" type="image" href="../images/favicon.ico">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>


<body>
    <!-- content-section -->
    <div>
        <!-- Header -->
        <header class="container">
            <nav class="navbar">
                <div class="logo">faiz<span>an</span> </div>
                <ul class="navMenu">
                    <li><a href="#">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#projects">Projects</a></li>
                    <li><a href="#services">Blog</a></li>
                    <li><a href="#contact" onclick="redirectToContactForm(event)">Contact</a></li>
                </ul>
                <div class="hamburger" id="hamburgerMenu">
                    <div class="bar"></div>
                    <div class="bar"></div>
                    <div class="bar"></div>
                </div>
            </nav>
            <div class="header-text">
                <h1>Hi,<br> I'm faizan khan</h1>
                <h2>Software Developer</h2>
            </div>
            <a class="btn" href="#contact" onclick="redirectToContactForm(event)"><i class="fa-solid fa-phone"></i>
                contact</a>
        </header>
        <nav class="mobile_navbar">
            <ul class="mobile_navmenu" id="mobileNavMenu">
                <a class="navLinks" href="#">Home</a>
                <a class="navLinks" href="#about">About</a>
                <a class="navLinks" href="#services">Services</a>
                <a class="navLinks" href="#projects">Projects</a>
                <a class="navLinks" href="#contact" onclick="redirectToContactForm(event)">Contact</a>
            </ul>
        </nav>
        <!-- ----------ABOUT---------- -->
        <div id="about">
            <div class="container">
                <div class="row">
                    <div class="about-col-1">

                        <img src="../uploads/profile_img/<?php echo $row['Profile_image']; ?>" alt="Profile Not found?">

                    </div>
                    <div class="about-col-2">
                        <div>
                            <h1 class="sub-title">About</h1>
                            <p>I am a passionate software developer with skills in both frontend and backend
                                technologies. I specialize in HTML/CSS, JavaScript, React.js, and Bootstrap for
                                front-end development, as well as server-side technologies such as Node.js, Express.js,
                                MySQL, Django, and PHP. I'm excited about taking on new projects and using my knowledge
                                to create impactful solutions. I am always eager to learn new technologies. I'm here to
                                turn your ideas into reality. Let's work together to build something awesome!
                            </p>
                        </div>
                        <div class="tab-titles">
                            <p class="tab-links active-link" onclick="openTab('skills')">Skills</p>
                            <p class="tab-links" onclick="openTab('education')">Education</p>
                            <p class="tab-links" onclick="openTab('Certifications')">Certifications</p>
                            <p class="tab-links" onclick="openTab('Resume')">Resume</p>
                        </div>
                        <div class="tab-contents active-tab" id="skills">
                            <ul>
                                <li>Web Development<br><span>Building Website / Web Apps</span></li>
                                <li>Worldpress Development<br><span>Database Management / SEO / Hosting</span></li>
                                <li>App Development<br><span>Building Android / iOS apps</span></li>
                            </ul>
                        </div>
                        <div class="tab-contents" id="Certifications">
                            <ul>
                                <li>Web Development offered by Coursera<br><a href="./static/Certificate.pdf"
                                        download>View</a></li>
                                <li>Entrepreneurship Development Programme<br><a href="/" download>View</a></li>
                                <li>Internship at eKart ecommerce. <br><a href="/" download>View</a></li>
                            </ul>
                        </div>
                        <div class="tab-contents" id="education">
                            <ul>
                                <li>Bachelor of Technology CSE-(AI)<br><span>2021-Current</span></li>
                                <li>Intermediate<br><span>2021</span></li>
                                <li>High School<br><span>2019</span></li>
                            </ul>
                        </div>
                        <div class="tab-contents" id="Resume">
                            <ul>
                                <li><a class="btn" href="./static/my_resume.pdf" download><i
                                            class="fa-solid fa-circle-down"></i>Download</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ----------PROJECTS--------- -->

        <div id="projects">
            <div class="container">
                <h1 class="sub-title">Projects</h1>
                <div class="work-list">
                    <!--   ../../uploads/project_img/austin-poon-JO_S6ewBqAk-unsplash.jpg   -->

                    <?php 
                        if ($project_total != 0) {
                            while ($row = mysqli_fetch_array($project_data)) {
                                echo "
                                <div class='work'>
                                    <img src='pic/". $row['image_src'] ."' alt='image not found'>
                                    <div class='layer'>
                                        <h2>" . $row['project_name'] . "</h2>
                                        <p>" . $row['description'] . "</p>
                                        <a href='" . $row['link'] . "' target='_blank'><i class='fas fa-external-link-alt'></i></a>
                                    </div>
                                </div>
                                ";
                            }
                        } else {
                            echo '<span class="No-email">No project are found?</span>';
                        } 
                    ?>

                </div>
                <a class="btn btn1" id="more2">more</a>
            </div>
        </div>

        <!-- ----------SERVICES------------>
        <div id="services">
            <div class="container">
                <h1 class="sub-title">Latest Blogs</h1>
                <div class="services-list">

                    <!-- ". $row['Service_icon'] . " -->
                    <?php 
                        if ($service_total  != 0) {
                            while ($row = mysqli_fetch_array($service_data)) {
                                echo "

                                <div class='service-item'>
                                    <img style='width: 50px;margin-bottom: 20px;' src='pic/". $row['Service_icon'] ."' alt='Image not found?' >
                                    <h2>" . $row['Service_name'] . "</h2>
                                    <p>" . $row['Service_discription'] . "</p>
                                    <a href='" . $row['Service_link'] . "' target='_blank'>Learn more</a>
                                </div>


                                ";
                            }
                        } else {
                            echo '<span >No service are found?</span>';
                        } 
                    ?>

                </div>
                <a class="btn btn1 " id="more1">more</a>
            </div>
        </div>


        <!-- ----------CONTACT---------- -->
        <div id="contact">
            <div class="container">
                <div class="row contact_row">
                    <div class="contact-left">
                        <h1 class="sub-title">Contact</h1>
                        <a href="mailto:faizanwriteme@gmail.com" target="_blank"
                            class="fas fa-paper-plane"><span>faizanwriteme@gmail.com</span></a>
                        <br>
                        <a href="https://wa.me/1187961267" target="_blank"
                            class="fas fa-brands fa-whatsapp"><span>1187961267</span></a>

                        <h2 class="follow-me">Follow on</h2>
                        <div class="social-icons">
                            <a href="https://www.linkedin.com/in/faizan-khan-84b640264/" target="_blank"><i
                                    class="fab fa-linkedin"></i></a>
                            <a target="_blank" href=" "><i class="fab fa-twitter-square"></i></a>
                            <a target="_blank" href="https://www.facebook.com/profile.php?id=100030858562675"><i
                                    class="fab fa-facebook"></i></a>
                            <a target="_blank" href="https://www.instagram.com/faizan_02.k/"><i
                                    class="fab fa-instagram"></i></a>
                        </div>
                    </div>

                    <div class="contact-right">
                        <h1 class="sub-field">Get in touch</h1>

                        <form id="myform" action="send_email.php" method="POST" enctype="multipart/form-data"
                            novalidate>
                            <input id="fullname" type="text" name="fullname" placeholder="Name">
                            <div class="error-msg">
                                <?php if(isset($response['error']['fullname'])) echo $response['error']['fullname']; ?>
                            </div>

                            <input id="email" type="email" name="email" placeholder="Email" autocomplete="off">
                            <div class="error-msg">
                                <?php if(isset($response['error']['email'])) echo $response['error']['email']; ?>
                            </div>

                            <textarea id="message" name="message" rows="10" placeholder="Write Message"></textarea>
                            <div class="error-msg">
                                <?php if(isset($response['error']['message'])) echo $response['error']['message']; ?>
                            </div>
                            <!-- submit data -->
                            <input type="submit" value="Send" class="btn btn3" name="submit">
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <footer>
            <p>all right reserved | created by @faiz<span>an</span></p>
        </footer>
    </div>
</body>
<script src="./assets/script.js"></script>
<script src="send_email.js"></script>
<!-- sweet alert CDN-->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</html>