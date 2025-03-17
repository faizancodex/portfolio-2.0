<?php
include("../config.php");

$id = $_GET['id'];

$query = "DELETE FROM email_inbox WHERE id = '$id' ";
$data = mysqli_query($conn, $query);

if ($data) {
    echo "<script>alert('Email deleted');</script>";
?>
    <meta http-equiv="refresh" content=" 0 url = ../email.php" />

<?php
} else {
    echo "<script>alert('Failed');</script>";
}
?>