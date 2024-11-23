<?php
session_start();
include("../db_conn.php");


if ($_POST['upload']) {
    // $id = $_POST['service_id'];
    $servicename = $_POST['Service_name'];
    $description = $_POST['Service_discription'];
    $link = $_POST['Service_link'];
    $filename = $_FILES["Service_icon"]["name"];
    
    if ($servicename != "" && $description != "" && $link != "" && $filename != "") {
        $tempname = $_FILES["Service_icon"]["tmp_name"];
        $folder = "service_icon_img/" . $filename;
        move_uploaded_file($tempname, $folder);
        
        $query = "INSERT INTO services values('$id','  $servicename','$description','$link','$folder')";
        $data = mysqli_query($conn, $query);
        
        if ($data) {
            $_SESSION['status'] = 'Service uploaded Successfully!';
            // Redirect back to projects.php
            header("Location: services.php");
            exit();
        } else {
            echo "Service not uploaded";
        }

    } else {
        echo "<script>alert('Please Enter Details');</script>";
        
    }
}
?>
