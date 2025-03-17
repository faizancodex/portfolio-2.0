<?php
session_start();
include("../config.php");

$id = $_GET['service_id'];

$query = "DELETE FROM services WHERE service_id = '$id' ";
$data = mysqli_query($conn, $query);

if ($data) {
    $_SESSION['delete'] = 'Service Deleted Successfully!';
    // Redirect back to service.php
    header("Location: ../services.php");
    exit();
} else {
    echo "<script>alert('Service Not Deleted');</script>";
}
?>