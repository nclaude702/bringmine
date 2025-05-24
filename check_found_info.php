<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: ../index.php');
    exit;
}

// Include database connection file
include("code/con1.php");

$namess = $_SESSION["names"];

// Check if `id` parameter is valid
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<script>alert('Invalid request. Please provide a valid ID.'); window.location.href = 'some_default_page.php';</script>";
    exit;
}

$id = intval($_GET['id']); // Sanitize input

// Fetch lost/found details
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
        echo "<script>alert('No record found for the given ID.'); window.location.href = 'some_default_page.php';</script>";
        exit;
    }
} else {
    echo "Failed to prepare query: " . mysqli_error($con);
    exit;
}

// Handle SMS form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $phone = mysqli_real_escape_string($con, $_POST['phonenumber']);
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $message = mysqli_real_escape_string($con, $_POST['message']);
    $d=date("Y-m-d H:i:s");

    // Insert message into database
    $query = "INSERT INTO message (mid,username, message,r_date) VALUES ('','$username', '$message','$d')";
    if (mysqli_query($con, $query)) {
        echo json_encode(["status" => "success", "message" => "Message saved and SMS sent successfully!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error: " . mysqli_error($con)]);
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("head.php"); ?>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const form = document.querySelector("#smsForm");
            const showMessage = document.querySelector("#showMessage");

            form.addEventListener("submit", function (e) {
                e.preventDefault(); // Prevent form from reloading

                const formData = new FormData(form);
                const phoneNumber = formData.get("phonenumber");
                const message = formData.get("message");

                // Setup headers
                const myHeaders = new Headers();
                myHeaders.append("Authorization", "App 09ccf67471591c845562ce71d8e7c58e-9eaf0d70-1d08-444d-a0eb-a9dd53202b55");
                myHeaders.append("Content-Type", "application/json");
                myHeaders.append("Accept", "application/json");

                // Define the JSON payload for the SMS
                const newJSON = JSON.stringify({
                    "messages": [{
                        "destinations": [{ "to": phoneNumber }],
                        "from": "Syntax Flow",
                        "text": message
                    }]
                });

                // Send SMS via API
                fetch("https://kqxvk8.api.infobip.com/sms/2/text/advanced", {
                    method: "POST",
                    headers: myHeaders,
                    body: newJSON
                })
                .then(response => response.json())
                .then(() => {
                    // Save to database
                    return fetch("", { // Submitting to the same page
                        method: "POST",
                        body: formData
                    });
                })
                .then(response => response.json())
                .then(data => {
                    showMessage.innerHTML = `<div class='alert alert-success'>${data.message}</div>`;
                    form.reset();
                })
                .catch(error => {
                    showMessage.innerHTML = "<div class='alert alert-danger'>Failed to send SMS</div>";
                    console.error("Error:", error);
                });
            });
        });
    </script>
</head>
<body>
    <?php include("menu.php"); ?>
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
                                <tr><th>Found Name</th> <td><?php echo $fName; ?></td></tr>
                                <tr><th>Found Phone</th> <td><?php echo $fPhone; ?></td></tr>
                                <tr><th>Found District</th> <td><?php echo $fDistrict; ?></td></tr>
                                <tr><th>Found Sector</th> <td><?php echo $fSector; ?></td></tr>
                                <tr><th>Property Name</th> <td><?php echo $propertyName; ?></td></tr>
                                <tr><th>Property Number</th> <td><?php echo $propertyNumber; ?></td></tr>
                                <tr><th>Status</th> <td><?php echo $status; ?></td></tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="container">
                                                        
                                            <h2 class="text-center">Send SMS To Found my Property</h2>
                                            <form id="smsForm" method="POST" action="check_found_info.php">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Send Message on Mobile</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control" id="phonenumber" name="phonenumber" value="+25<?php echo $fPhone; ?>" required>
                                                    </div>
                                                    <label class="col-sm-3 col-form-label">Username</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control" name="username" value="<?php echo $namess; ?>" required> 
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <textarea class="form-control" name="message" id="message" placeholder="Enter your message..." required></textarea>
                                                        <button type="submit" class="btn btn-primary mt-2">Send SMS To Found my Property</button>
                                                    </div>
                                                </div>
                                            </form>
                                            <div id="showMessage" class="mt-3"></div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include("foot.php"); ?>
    </div>
</body>
</html>
