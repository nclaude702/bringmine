<?php
session_start();
if (!isset($_SESSION['ad_id'])) {
  header('location:index.php');
}
else
{
  echo $id=$_SESSION["ad_id"];
  $names = $_SESSION["ad_names"];
  echo  $username = $_SESSION["ad_username"]; 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("ad_head.php"); ?>
    <title>User Profile</title>
</head>
<body>
    <?php include("ad_menu.php"); ?>

    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <h3 class="font-weight-bold">Welcome, <?php echo htmlspecialchars($names); ?></h3>
                    <div class="col-12 grid-margin">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">User Profile</h4>

                                <?php
                                include("code/con1.php");
                                $query = "SELECT * FROM `users` WHERE id = '$id'";
                                $result = mysqli_query($con, $query);
                                $user_data = mysqli_fetch_assoc($result);
                                ?>

                                <form class="form-sample">
                                    <div class="row justify-content-center">
                                        <div class="form-group text-center">
                                            <label>Profile</label>
                                            <br>
                                            <img src="<?php echo htmlspecialchars($user_data['profile']); ?>" alt="profile" class="img-fluid rounded-circle" style="width: 120px; height: 80px;" />
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>ID</label>
                                                <input type="text" class="form-control" value="<?php echo htmlspecialchars($user_data['id']); ?>" readonly />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Names</label>
                                                <input type="text" class="form-control" value="<?php echo htmlspecialchars($user_data['names']); ?>" readonly />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>E-mail</label>
                                                <input type="text" class="form-control" value="<?php echo htmlspecialchars($user_data['e_mail']); ?>" readonly />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Phone</label>
                                                <input type="text" class="form-control" value="<?php echo htmlspecialchars($user_data['phone']); ?>" readonly />
                                            </div>
                                        </div>
                                    </div>
                                     <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input type="text" class="form-control" value="<?php echo htmlspecialchars($user_data['username']); ?>" readonly />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" class="form-control" value="<?php echo htmlspecialchars($user_data['password']); ?>" readonly />
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row justify-content-center">
                                        <a href="ad_edit_profile.php" class="btn btn-primary">Edit</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include("ad_foot.php"); ?>
    </div>
</body>
</html>
