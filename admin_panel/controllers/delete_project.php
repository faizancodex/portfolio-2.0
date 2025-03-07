<?php
session_start();
include("../config.php");

$id = $_GET['id'];

$query = "DELETE FROM project WHERE id = '$id' ";
$data = mysqli_query($conn, $query);

if ($data) {
    $_SESSION['delete'] = 'Project Deleted Successfully!';
    // Redirect back to projects.php
    header("Location: ../projects.php");
    exit();
} else {
    echo "<script>alert('Project Not Deleted');</script>";
}
?>