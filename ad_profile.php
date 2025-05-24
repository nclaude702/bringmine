<?php
session_start();
if (!isset($_SESSION['ad_id'])) {
  header('location:../index.php');
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
        
         
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth px-0">
          <div class="row w-100 mx-0">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                <div class="brand-logo" style="align-items: center;">
                      <img src="assets/images/faces/face28.jpg" alt="profile"/>
                </div>
             
                <h3 class="font-weight-light"Profile</h3>
              

        <form class="pt-3" action="code/login_users_code.php" method="POST">
            <div class="form-group">
                <input type="text" class="form-control form-control-lg"  placeholder="Username" name="username" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control form-control-lg" placeholder="Password" name="password" required>
            </div>
            <div class="mt-3 d-grid gap-2">
                <button type="submit" name="login" class="btn btn-primary btn-lg btn-block">
                    <i class="ti-user"></i> LOGIN
                </button>
            </div>
            <div class="text-center mt-4 font-weight-light">
                Don't have an account? <a href="register.php" class="text-primary">Create Account</a>
            </div>
        </form>

              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
         
      <?php include("ad_foot.php"); ?>
  </body>
</html>
<?php } ?>