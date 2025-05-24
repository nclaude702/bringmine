<?php
session_start();
include("con1.php");

// Ensure database connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve form data safely
$lost_names = mysqli_real_escape_string($con, $_POST['lost_names']);
$lost_phone = mysqli_real_escape_string($con, $_POST['lost_phone']);
$lost_district = mysqli_real_escape_string($con, $_POST['lost_district']);
$lost_sector = mysqli_real_escape_string($con, $_POST['lost_sector']);
$lost_property_name = mysqli_real_escape_string($con, $_POST['lost_property_name']);
$propert_number = mysqli_real_escape_string($con, $_POST['propert_number']);

$lost_found_status = "Searching";

try {
    // Check if the property number already exists
    $stmt = mysqli_prepare($con, "SELECT * FROM `lostfound` WHERE `propert_number` = ?");
    mysqli_stmt_bind_param($stmt, "s", $propert_number);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        // If found, update the record
        $update = mysqli_prepare($con, "UPDATE `lostfound` SET lost_names=?, lost_phone=?, lost_district=?, lost_sector=?, lost_property_name=?, lost_found_status='Found' WHERE propert_number=?");
        mysqli_stmt_bind_param($update, "ssssss", $lost_names, $lost_phone, $lost_district, $lost_sector, $lost_property_name, $propert_number);
        
        if (mysqli_stmt_execute($update)) {
            echo "<script>alert('Record updated successfully!'); window.location='../lost.php';</script>";
        } else {
            echo "<script>alert('Failed to update record.'); window.location='../lost.php';</script>";
        }
    } else {
        // Insert new record
        $insert = mysqli_prepare($con, "INSERT INTO `lostfound` (lost_names, lost_phone, lost_district, lost_sector, lost_property_name, propert_number, lost_found_status) VALUES (?, ?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($insert, "sssssss", $lost_names, $lost_phone, $lost_district, $lost_sector, $lost_property_name, $propert_number, $lost_found_status);

        if (mysqli_stmt_execute($insert)) {
            echo "<script>alert('Record saved successfully!'); window.location='../lost.php';</script>";
        } else {
            echo "<script>alert('Failed to save record.'); window.location='../lost.php';</script>";
        }
    }
} catch (Exception $e) {
    echo "<script>alert('Error: " . $e->getMessage() . "'); window.location='../lost.php';</script>";
}

mysqli_close($con);
?>
