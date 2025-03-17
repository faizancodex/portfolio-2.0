<?php
session_start();
include("../config.php");

if ($_POST['update']) {
    // Retrieve project details from the form
    $id = $_POST['project_id']; // Assuming you have a hidden input field for project_id in your form
    $project = $_POST['project'];
    $description = $_POST['description'];
    $link = $_POST['add_link'];
    $filename = $_FILES["add_image"]["name"];

    if (!empty($filename)) {
        $tempname = $_FILES["add_image"]["tmp_name"];
        $folder = "../../uploads/project_img/" . $filename;
        move_uploaded_file($tempname, $folder);
        // Update query with image_src
        $query = "UPDATE project 
                  SET project_name = '$project',
                      description = '$description',
                      link = '$link', 
                      image_src = '$folder' 
                  WHERE id = $id";
    } else {
        // Update query without image_src
        $query = "UPDATE project 
                  SET project_name = '$project', 
                      description = '$description', 
                      link = '$link'
                  WHERE id = $id";
    }

    $data = mysqli_query($conn, $query);

    if ($data) {
        $_SESSION['status'] = 'Updated Successfully!';
        // Redirect back to projects.php
        header("Location: ../projects.php");
        exit();
    } else {
        echo "Project not updated";
    }
}
?>
