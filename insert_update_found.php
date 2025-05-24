<?php
session_start();
include("con1.php");

// Retrieve form data
$found_names = $_POST['found_names'];
$found_phone = $_POST['found_phone'];
$found_district = $_POST['found_district'];
$found_sector = $_POST['found_sector'];
$found_propert_name = $_POST['found_propert_name'];
$propert_number = $_POST['propert_number'];

$lost_found_status = "Searching";

// Ensure database connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

try {
    // Check if the property number exists in the database
    $stmt = mysqli_prepare($con, "SELECT * FROM `lostfound` WHERE `propert_number` = ?");
    mysqli_stmt_bind_param($stmt, "s", $propert_number);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $lost_found_status = "Found";
        // If property number exists, update the existing record
        $update = mysqli_prepare($con, "
            UPDATE `lostfound` 
            SET 
                found_names = ?, 
                found_phone = ?, 
                found_district = ?, 
                found_sector = ?, 
                found_propert_name = ?, 
                lost_found_status = ?
            WHERE 
                propert_number = ?
        ");
        mysqli_stmt_bind_param($update, "sssssss", $found_names, $found_phone, $found_district, $found_sector, $found_propert_name, $lost_found_status, $propert_number);

        if (mysqli_stmt_execute($update)) {
            echo "<script>alert('Record updated successfully!'); window.location='../found.php';</script>";
        } else {
            echo "<script>alert('Failed to update the record. Please try again.'); window.location='../found.php';</script>";
        }
    } else {
        // Insert a new record
        $insert = mysqli_prepare($con, "
            INSERT INTO `lostfound` 
            (found_names, found_phone, found_district, found_sector, found_propert_name, propert_number, lost_found_status) 
            VALUES 
            (?, ?, ?, ?, ?, ?, ?)
        ");
        mysqli_stmt_bind_param($insert, "sssssss", $found_names, $found_phone, $found_district, $found_sector, $found_propert_name, $propert_number, $lost_found_status);

        if (mysqli_stmt_execute($insert)) {
            echo "<script>alert('Record saved successfully!'); window.location='../found.php';</script>";
        } else {
            echo "<script>alert('Failed to save the record. Please try again.'); window.location='../found.php';</script>";
        }
    }
} catch (Exception $e) {
    echo "<script>alert('An error occurred: " . $e->getMessage() . "'); window.location='../found.php';</script>";
}

// Close the database connection
mysqli_close($con);
?>
