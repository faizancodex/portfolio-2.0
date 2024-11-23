<?php
session_start();
// Include database connection file
include("../db_conn.php");

// Enable error reporting to display all errors (for development)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the form is submitted
if (isset($_POST['update'])) {
    $id = intval($_POST['about_id']); // Sanitize input
    $filename = $_FILES["Profile_image"]["name"];

    if (!empty($filename)) {
        $tempname = $_FILES["Profile_image"]["tmp_name"];
        $folder = "profile_img/" . basename($filename);

        // Check if the image was uploaded successfully
        if (move_uploaded_file($tempname, $folder)) {
            // Check if an image already exists for this about_id
            $checkQuery = "SELECT Profile_image FROM about WHERE about_id = ?";
            $stmtCheck = mysqli_prepare($conn, $checkQuery);
            mysqli_stmt_bind_param($stmtCheck, 'i', $id);
            mysqli_stmt_execute($stmtCheck);
            mysqli_stmt_bind_result($stmtCheck, $existingImage);
            mysqli_stmt_fetch($stmtCheck);
            mysqli_stmt_close($stmtCheck);

            if ($existingImage) {
                // If an image exists, update it
                $query = "UPDATE about SET Profile_image = ? WHERE about_id = ?";
                $stmt = mysqli_prepare($conn, $query);
                mysqli_stmt_bind_param($stmt, 'si', $folder, $id);
                if (mysqli_stmt_execute($stmt)) {
                    $_SESSION['profile'] = 'Profile image updated successfully!';
                } else {
                    echo "Error updating profile: " . mysqli_error($conn);
                }
            } else {
                // If no image exists, insert it
                $query = "INSERT INTO about (about_id, Profile_image) VALUES (?, ?)";
                $stmt = mysqli_prepare($conn, $query);
                mysqli_stmt_bind_param($stmt, 'is', $id, $folder);
                if (mysqli_stmt_execute($stmt)) {
                    $_SESSION['profile'] = 'Profile image uploaded successfully!';
                } else {
                    echo "Error inserting profile image: " . mysqli_error($conn);
                }
            }

            // Close the statement
            mysqli_stmt_close($stmt);
            // Redirect back to details.php
            header("Location: details.php");
            exit();
        } else {
            echo "<script>alert('Failed to upload image. Please try again.');</script>";
        }
    }
}
