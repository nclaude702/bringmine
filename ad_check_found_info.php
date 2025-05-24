<?php
session_start();
if (!isset($_SESSION['ad_id'])) {
    header('location:index.php');
    exit;
}

$id = $_SESSION["ad_id"];
$namess = $_SESSION["ad_names"];
include("code/con1.php");

// Check if the `id` parameter is set in the GET request
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']); // Sanitize input

    // Prepare and execute the SQL query
    $query = "SELECT * FROM `lostfound` WHERE id = ?";
    $stmt = mysqli_prepare($con, $query);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            // Sanitize output data
            $fName = htmlspecialchars($row['found_names']);
            $fPhone = htmlspecialchars($row['found_phone']);
            $fDistrict = htmlspecialchars($row['found_district']);
            $fSector = htmlspecialchars($row['found_sector']);
            $propertyName = htmlspecialchars($row['found_propert_name']);
            $propertyNumber = htmlspecialchars($row['propert_number']);
            $status = htmlspecialchars($row['lost_found_status']);
        } else {
            // Handle case where no record is found for the given ID
            echo "<script>alert('No record found for the given ID.'); window.location.href = 'some_default_page.php';</script>";
            exit;
        }
    } else {
        // Handle query preparation failure
        echo "Failed to prepare query: " . mysqli_error($con);
        exit;
    }
} else {
    // Handle invalid or missing `id` parameter
    echo "<script>alert('Invalid request. Please provide a valid ID.'); window.location.href = 'some_default_page.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("ad_head.php"); ?>
</head>
<body>
    <?php include("ad_menu.php"); ?>
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <h3 class="font-weight-bold">Details of Lost Property</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Property Information</h4>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Found Name</th>
                                    <td><?php echo $fName; ?></td>
                                </tr>
                                <tr>
                                    <th>Found Phone</th>
                                    <td><?php echo $fPhone; ?></td>
                                </tr>
                                <tr>
                                    <th>Found District</th>
                                    <td><?php echo $fDistrict; ?></td>
                                </tr>
                                <tr>
                                    <th>Found Sector</th>
                                    <td><?php echo $fSector; ?></td>
                                </tr>
                                <tr>
                                    <th>Property Name</th>
                                    <td><?php echo $propertyName; ?></td>
                                </tr>
                                <tr>
                                    <th>Property Number</th>
                                    <td><?php echo $propertyNumber; ?></td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td><?php echo $status; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include("ad_foot.php"); ?>
    </div>
</body>
</html>
