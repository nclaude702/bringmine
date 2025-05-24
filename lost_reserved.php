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
 // echo $_SESSION["phone"];
  
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include("head.php"); ?>

  </head>
  <body>
    <?php include("menu.php"); ?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-md-12 grid-margin">
                <div class="row">
                  <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Welcome <?php echo $names; ?></h3>
                   
                  </div>
                  <div class="col-12 col-xl-4">
                    <div class="justify-content-end d-flex">
                      <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                        <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                          <i class="mdi mdi-calendar"></i> Register Lost </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                          <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                <div class="brand-logo">
                  <img src="assets/images/search_lost.jpg" alt="logo">
                </div>
               
                <form class="pt-3" action="code/insert_update_lost.php" method="POST" onsubmit="return validateForm()">
  <div class="form-group">
    <input type="text" class="form-control form-control-lg" placeholder="Enter your name" name="lost_names" required>
  </div>
 
  <div class="form-group">
    <input type="text" class="form-control form-control-lg" placeholder="Enter Your District" name="lost_district" required>
  </div>
  <div class="form-group">
    <input type="text" class="form-control form-control-lg" placeholder="Enter Your Sector" name="lost_sector" required>
  </div>
  <div class="form-group">
    <select
      class="form-select form-select-lg"
      name="lost_property_name">
      <option value="">Select Lost Property</option>
      <option value="National Id">National ID</option>
      <option value="Driving Licence">Driving License</option>
      <option value="Degree">Degree</option>
      <option value="Other">Other</option>
    </select>
  </div>
  <div class="form-group" style="display: none;">
    <input
      type="text"
      class="form-control form-control-lg"
      placeholder="Enter Property Name"
      name="other_property_name"
    >
  </div>
  <div class="form-group">
    <input
      type="text"
      class="form-control form-control-lg"
      placeholder="Enter Property Unique Number (ID N)"
      name="propert_number"
    >
  </div>
  <div class="mt-3 d-grid gap-2">
    <button type="submit" class="btn btn-primary btn-lg btn-block">SAVE</button>
  </div>
</form>




              </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              
              <div class="col-lg-12 stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">View status of your lost property</h4>
                    
                    <div class="table-responsive pt-3">
                     <table class="table table-bordered">
    <thead style="background-color: blue;">
        <tr class="table-danger">
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
    <?php
    include("code/con1.php");

    // Query to fetch data from the `lostfound` table
    $query = "SELECT * FROM `lostfound` WHERE lost_names!='' AND propert_number!='' AND lost_property_name!='' ORDER BY id DESC";
    $result = mysqli_query($con, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($con));
    }
    ?>
    <tbody>
    <?php
    $index = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        // Determine the class based on the 'lost_found_status'
        $statusClass = "";
        if ($row['lost_found_status'] == 'Searching') {
            $statusClass = "table-primary"; // Searching
        } elseif ($row['lost_found_status'] == 'Found') {
            $statusClass = "table-success"; // Found
        }

        echo "<tr class='$statusClass'>";
        echo "<td>" . $index++ . "</td>"; 
        echo "<td>" . htmlspecialchars($row['lost_names']) . "</td>";
        echo "<td>" . htmlspecialchars($row['lost_phone']) . "</td>";
        echo "<td>" . htmlspecialchars($row['lost_district']) . "</td>";
        echo "<td>" . htmlspecialchars($row['lost_sector']) . "</td>";
        echo "<td>" . htmlspecialchars($row['lost_property_name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['propert_number']) . "</td>";

        // Add a clickable link or message to the Status column
        if ($row['lost_found_status'] == 'Searching') {
            echo "<td>No one has found your property yet.</td>";
        } else {
            echo "<td><a href='check_found_info.php?id=" . urlencode($row['id']) . "'>View Details</a></td>";
        }
        echo "</tr>";
    }
    ?>
    </tbody>
</table>


                       
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
       
      <?php include("foot.php"); ?>
  </body>
</html>
<?php } ?>