<?php
session_start();
if (!isset($_SESSION['ad_id'])) {
  header('location:index.php');
}
else
{
  echo $_SESSION["ad_id"];
  $names = $_SESSION["ad_names"];
  echo $_SESSION["ad_username"];
  
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include("ad_head.php"); ?>

  </head>
  <body>
    <?php include("ad_menu.php"); ?>
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
                          <i class="mdi mdi-calendar"></i> Register Found </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                          <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                <div class="brand-logo">
                  <img src="assets/images/search_owner.jpg" alt="logo">
                </div>
                <form class="pt-3" action="ad_code/insert_update_found.php" method="POST">
                  <div class="form-group">
                    <input type="text" class="form-control form-control-lg" id="exampleInputUsername1" placeholder="Enter your name" name="found_names">
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control form-control-lg" id="exampleInputUsername1" placeholder="Enter your phone number" name="found_phone">
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control form-control-lg" id="exampleInputUsername1" placeholder="Enter Your District" name="found_district">
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control form-control-lg" id="exampleInputUsername1" placeholder="Enter Your Sector" name="found_sector" name="found_sector">
                  </div>
                  <div class="form-group">
                    <select class="form-select form-select-lg" id="exampleFormControlSelect2" name="found_propert_name">
                      <option>Lost Property</option>
                      <option>national Id</option>
                      <option>Driving Licence</option>
                      <option>Degree</option>
                      <option>Other</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control form-control-lg" id="exampleInputUsername1" placeholder="Enter Property unique number(ID N)" name="propert_number">
                  </div>
                  
                  <div class="mb-4">
                   
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
                    <h1 class="card-title">Check if  there is your lost property</h1>
                    <div class="table-responsive pt-3">
                      <table class="table table-bordered">
                        <thead style="background-color: blue;">
        <tr class="table-danger">
            <th>#</th>
            <th>Found Name</th>
            <th>Phone</th>
            <th>District</th>
            <th>Sector</th>
            <th>Property Name</th>
            <th>Property Number</th>
            <th colspan="2">Status</th>
        </tr>
    </thead>
    <?php
    include("code/con1.php");

    // Query to fetch data from the `lostfound` table
    $query = "SELECT * FROM `lostfound` WHERE found_names!='' AND  propert_number!='' AND  found_propert_name!='' ORDER BY id DESC";
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
            $statusClass = "table-primary";  // Use 'table-warning' for Searching
        } elseif ($row['lost_found_status'] == 'Found') {
            $statusClass = "table-success";  // Use 'table-success' for Found
        }

        echo "<tr class='$statusClass'>";
        echo "<td>" . $index++ . "</td>";
        echo "<td>" . htmlspecialchars($row['found_names']) . "</td>";
        echo "<td>" . htmlspecialchars($row['found_phone']) . "</td>";
        echo "<td>" . htmlspecialchars($row['found_district']) . "</td>";
        echo "<td>" . htmlspecialchars($row['found_sector']) . "</td>";
        echo "<td>" . htmlspecialchars($row['found_propert_name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['propert_number']) . "</td>";
        echo "<td>" . htmlspecialchars($row['lost_found_status']) . "</td>";
         if ($row['lost_found_status'] == 'Searching') {
            echo "<td>No one has found your property yet.</td>";
        } else {
            echo "<td><a href='ad_check_lost_info.php?id=" . urlencode($row['id']) . "'>View Details</a></td>";
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
      
      <?php include("ad_foot.php"); ?>
  </body>
</html>
<?php } ?>