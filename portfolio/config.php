<?php
    error_reporting(E_ALL);
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "portfolio";

    $conn = mysqli_connect($servername,$username,$password,$dbname);

    if($conn){
        // echo "Database Successfully Connected";
    }

    else{
        echo "Database error";
    }
?>
