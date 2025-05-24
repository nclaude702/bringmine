<?php
session_start();
include("../code/con1.php");

// Check if required POST data is set
if (isset($_POST['save'])) {
    // Sanitize POST data
    $lost_names = mysqli_real_escape_string($con, $_POST['lost_names']);
    $lost_phone = mysqli_real_escape_string($con, $_POST['lost_phone']);
    $lost_district = mysqli_real_escape_string($con, $_POST['lost_district']);
    $lost_sector = mysqli_real_escape_string($con, $_POST['lost_sector']);
    $lost_property_name = mysqli_real_escape_string($con, $_POST['lost_property_name']);
    $propert_number = mysqli_real_escape_string($con, $_POST['propert_number']);

    $found_names = '';
    $found_phone = '';
    $found_district = '';
    $found_sector = '';
    $found_propert_name = '';
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
            // If property number exists, update the existing record
            $lost_found_status = "Found";
            $update = mysqli_prepare($con, "
                UPDATE `lostfound` 
                SET 
                    lost_names = ?, 
                    lost_phone = ?, 
                    lost_district = ?, 
                    lost_sector = ?, 
                    lost_property_name = ?, 
                    lost_found_status = ?
                WHERE 
                    propert_number = ?
            ");
            mysqli_stmt_bind_param($update, "sssssss", $lost_names, $lost_phone, $lost_district, $lost_sector, $lost_property_name, $lost_found_status, $propert_number);

            if (mysqli_stmt_execute($update)) {
                echo "<script>alert('Record updated successfully!'); window.location='../ad_lost.php';</script>";
            } else {
                echo "<script>alert('Failed to update the record. Please try again.'); window.location='../ad_lost.php';</script>";
            }
        } else {
            // Insert a new record
            $insert = mysqli_prepare($con, "
                INSERT INTO `lostfound` 
                (lost_names, lost_phone, lost_district, lost_sector, lost_property_name, propert_number, found_names, found_phone, found_district, found_sector, found_propert_name, lost_found_status) 
                VALUES 
                (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            ");
            mysqli_stmt_bind_param($insert, "ssssssssssss", $lost_names, $lost_phone, $lost_district, $lost_sector, $lost_property_name, $propert_number, $found_names, $found_phone, $found_district, $found_sector, $found_propert_name, $lost_found_status);

            if (mysqli_stmt_execute($insert)) {
                echo "<script>alert('Record saved successfully!'); window.location='../ad_lost.php';</script>";
            } else {
                echo "<script>alert('Failed to save the record. Please try again.'); window.location='../ad_lost.php';</script>";
            }
        }
    } catch (Exception $e) {
        echo "<script>alert('An error occurred: " . $e->getMessage() . "'); window.location='../ad_lost.php';</script>";
    }

    // Close the database connection
    mysqli_close($con);
}
?>
