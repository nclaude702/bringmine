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
 // echo $_SESSION["email"];
 // echo $_SESSION["phone"];
  
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
                  
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card tale-bg">
                  <div class="card-people mt-auto">
                    <img src="assets/images/dashboard/people.svg" alt="people">
                    <div class="weather-info">
                      <div class="d-flex">
                        <div>
                          <h2 class="mb-0 font-weight-normal"> </h2>
                        </div>
                        <div class="ms-2">
                          <h4 class="location font-weight-normal"> </h4>
                          <h6 class="font-weight-normal"> </h6>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 grid-margin transparent">
                <div class="row" style="margin-top: 50">
                  <div class="col-md-6 mb-4 stretch-card transparent">
                    <div class="card card-tale">
                      <div class="card-body">
                        <p class="mb-4">All Searching Lost/Found</p>
                        <?php 
                                include("code/con1.php"); 
                                $query = "SELECT COUNT(*) AS total FROM `lostfound`";
                                $result = mysqli_query($con, $query);

                                if ($result) {
                                   $row = mysqli_fetch_assoc($result);
                                    $totalRecords = $row['total'];
                                  } else {
                                       $totalRecords = 0; // Default to 0 if query fails
                                    }
                                   ?>

                             <p class="fs-30 mb-2"><?php echo $totalRecords; ?></p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 mb-4 stretch-card transparent">
                    <div class="card card-dark-blue">
                      <div class="card-body">
                        <p class="mb-4">Number of property reach to owner</p><?php
                         include("code/con1.php");
                       $query = "SELECT COUNT(*) AS total FROM `lostfound` WHERE found_names !='' and  lost_found_status='Found'";
                       $result = mysqli_query($con, $query);

                       if ($result) {
                           $row = mysqli_fetch_assoc($result);
                           $totalRecords = $row['total'];
                           } else {
                          $totalRecords = 0; 
                          }
                       ?>
                      <p class="fs-30 mb-2"><?php echo $totalRecords; ?></p>
                        <p> </p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row" style="margin-top: 100">
                  <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                    <div class="card card-light-blue">
                      <div class="card-body">
                        <p class="mb-4">Number of found</p><?php
                         include("code/con1.php");
                       $query = "SELECT COUNT(*) AS total FROM `lostfound` WHERE found_names !='' and  lost_found_status='Searching'";
                       $result = mysqli_query($con, $query);

                       if ($result) {
                           $row = mysqli_fetch_assoc($result);
                           $totalRecords = $row['total'];
                           } else {
                          $totalRecords = 0; 
                          }
                       ?>
                      <p class="fs-30 mb-2"><?php echo $totalRecords; ?></p>
                        <p> </p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 stretch-card transparent">
                    <div class="card card-light-danger">
                      <div class="card-body">
                        <p class="mb-4">Number of Lost</p><?php
                         include("code/con1.php");
                       $query = "SELECT COUNT(*) AS total FROM `lostfound` WHERE lost_names !='' and  lost_found_status='Searching'";
                       $result = mysqli_query($con, $query);

                       if ($result) {
                           $row = mysqli_fetch_assoc($result);
                           $totalRecords = $row['total'];
                           } else {
                          $totalRecords = 0; 
                          }
                       ?>
                      <p class="fs-30 mb-2"><?php echo $totalRecords; ?></p>
                        <p> </p>
                      </div>
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
