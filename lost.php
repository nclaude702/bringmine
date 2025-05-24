<?php
session_start();
if (!isset($_SESSION['id'])) {
  header('location:../index.php');
}
else
{
  echo $_SESSION["id"];
  $names = $_SESSION["names"];
  echo $_SESSION["username"];
 // echo $_SESSION["email"];
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("head.php"); ?>
</head>
<body>
    <?php include("menu.php"); ?>
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <h3 class="font-weight-bold">Welcome <?php echo htmlspecialchars($_SESSION["names"]); ?></h3>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Register Lost Property</h4>
                            <form action="code/insert_update_lost.php" method="POST">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Enter Your Name" name="lost_names" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Enter Your Phone Number" name="lost_phone" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Enter Your District" name="lost_district" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Enter Your Sector" name="lost_sector" required>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" name="lost_property_name" required>
                                        <option value="">Select Lost Property</option>
                                        <option value="National ID">National ID</option>
                                        <option value="Driving License">Driving License</option>
                                        <option value="Degree">Degree</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Enter Property Unique Number (ID, License, etc.)" name="propert_number" required>
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg btn-block">SAVE</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <h4 class="mt-4">View Status of Your Lost Property</h4>
            <table class="table table-bordered">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>#</th>
                        <th>Lost Name</th>
                        <th>Phone</th>
                        <th>District</th>
                        <th>Sector</th>
                        <th>Property Name</th>
                        <th>Property Number</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include("code/con1.php");
                    $query = "SELECT * FROM `lostfound` WHERE lost_names!='' AND propert_number!='' ORDER BY id DESC";
                    $result = mysqli_query($con, $query);
                    if (!$result) {
                        die("Query failed: " . mysqli_error($con));
                    }

                    $index = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $statusClass = ($row['lost_found_status'] == 'Searching') ? "table-warning" : "table-success";
                        echo "<tr class='$statusClass'>";
                        echo "<td>" . $index++ . "</td>";
                        echo "<td>" . htmlspecialchars($row['lost_names']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['lost_phone']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['lost_district']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['lost_sector']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['lost_property_name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['propert_number']) . "</td>";
                        echo "<td>";
                        if ($row['lost_found_status'] == 'Searching') {
                            echo "Not yet found";
                        } else {
                            echo "<a href='check_found_info.php?id=" . urlencode($row['id']) . "'>View Details</a>";
                        }
                        echo "</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
   </div>
    <?php include("foot.php"); ?>
</body>
</html>
<?php } ?>
