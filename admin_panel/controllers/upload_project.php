<?php
session_start();
include("../config.php");


if ($_POST['upload']) {
    // $id = $_POST['id'];
    $project = $_POST['project'];
    $description = $_POST['description'];
    $link = $_POST['add_link'];
    $filename = $_FILES["add_image"]["name"];
    
    if ($project != "" && $description != "" && $link != "" && $filename != "") {
        $tempname = $_FILES["add_image"]["tmp_name"];
        $folder = "../../uploads/project_img/" . $filename;
        move_uploaded_file($tempname, $folder);
        
        $query = "INSERT INTO project values('$id','$project','$description','$link','$folder')";
        $data = mysqli_query($conn, $query);
        
        if ($data) {

            $_SESSION['status'] = 'Project uploaded Successfully!';
            // Redirect back to projects.php
            header("Location: ../projects.php");
            exit();
        } else {
            echo "Project not submitted";
        }

    } else {
        echo "<script>alert('Please Enter Details');</script>";
    }
}
?>
