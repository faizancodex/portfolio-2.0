<?php
session_start();
include("../db_conn.php");

if ($_POST['update']) {
    // Retrieve project details from the form
    $id = $_POST['service_id']; // Assuming you have a hidden input field for project_id in your form
    $service_name = $_POST['Service_name'];
    $service_description = $_POST['Service_discription'];
    $service_link = $_POST['Service_link'];
    $filename = $_FILES["Service_icon"]["name"];

    if (!empty($filename)) {
        $tempname = $_FILES["Service_icon"]["tmp_name"];
        $folder = "service_icon_img/" . $filename;
        move_uploaded_file($tempname, $folder);
        // Update query with image_src
        $query = "UPDATE services 
                  SET Service_name = '$service_name',
                      Service_discription = '$service_description',
                      Service_link = '$service_link', 
                      Service_icon = '$folder' 
                  WHERE service_id = $id";
    } else {
        // Update query without image_src
        $query = "UPDATE services 
                  SET Service_name = '$service_name', 
                      Service_discription = '$service_description', 
                      Service_link = '$service_link'
                  WHERE service_id = $id";
    }

    $data = mysqli_query($conn, $query);

    if ($data) {
        $_SESSION['status'] = 'Service updated Successfully!';
        // Redirect back to services.php
        header("Location: services.php");
        exit();
    } else {
        echo "Service not updated";
    }
}
?>
