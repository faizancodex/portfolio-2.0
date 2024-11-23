<?php
error_reporting(E_ALL);
include("db_conn.php");

$fname = $_POST['fullname'];
$email = $_POST['email'];
$message = $_POST['message'];

// Capture current date and time
date_default_timezone_set('Asia/Kolkata');
$currentDateTime = (new DateTime())->format('d F Y, H:i');



$response = array('success' => false, 'error' => array());
// validate Name fields
if(empty($_POST['fullname'])){
    $response['error']['fullname'] = 'Please Enter Your Name';
}

// validate Email field
if(empty($_POST['email'])){
    $response['error']['email'] = 'Please Enter Your Email';
} elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $response['error']['email'] = 'Invalid Email format';
}
// validate massege field
if(empty($_POST['message'])){
    $response['error']['message'] = 'Please write a message';
}




if(empty($response['error'])){

    // Sanitize inputs to prevent SQL injection
    $fname = mysqli_real_escape_string($conn, $fname);
    $email = mysqli_real_escape_string($conn, $email);
    $message = mysqli_real_escape_string($conn, $message);

    // Prepare and execute the query
    $query = "INSERT INTO email_inbox (fname, email, message, date_time) VALUES ('$fname', '$email', '$message', '$currentDateTime')";
    $data = mysqli_query($conn, $query);

    // Check if query executed successfully
    if($data){
        // display success alert
        $response['success'] = true;
    } else {
        // display error alert
        $response['success'] = false;
        $response['error']['database'] = 'Error in executing query: ' . mysqli_error($conn);
    }
}

// Output JSON response
echo json_encode($response);
?>
