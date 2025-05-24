<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>User Registration</title>
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/images/favicon.png">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="col-lg-5">
            <div class="card shadow p-4">
                <div class="text-center mb-3">
                    <img src="assets/images/logoo.jpg" alt="logo" width="100">
                </div>
                <h4 class="text-center mb-3">Create an Account</h4>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group mb-3">
                        <input type="text" class="form-control" name="names" placeholder="Full Name" required>
                    </div>
                    <div class="form-group mb-3">
                        <input type="text" class="form-control" name="username" placeholder="Username" required>
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>
                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" required>
                        <label class="form-check-label">I agree to all Terms & Conditions</label>
                    </div>
                    <button type="submit" name="register" class="btn btn-primary w-100">SIGN UP</button>
                    <div class="text-center mt-3">
                        Already have an account? <a href="index.php" class="text-primary">Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="assets/js/vendor.bundle.base.js"></script>
    <script src="assets/js/template.js"></script>
</body>
</html>
<?php
include("code/con1.php");

if (isset($_POST['register'])) {
    $names = mysqli_real_escape_string($con, $_POST['names']);
    $user = mysqli_real_escape_string($con, $_POST['username']);
    $pass = mysqli_real_escape_string($con, $_POST['password']);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $profile_path = ""; // Default empty

    // Check if username already exists
    $check_query = "SELECT * FROM users WHERE username='$username'";
    $check_result = mysqli_query($con, $check_query);
    
    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>alert('Username already exists! Try a different one.');</script>";
    } 

     else{   // Insert into the database
        $insert_query = "INSERT INTO users (id,names, username, password, type, profile) 
                         VALUES ('','$names', '$user', '$pass', 'user', '$profile_path')";

        if (mysqli_query($con, $insert_query)) {
            echo "<script>
                    alert('User registered successfully!');
                    window.location.href = 'index.php';
                  </script>";
            exit;
        } else {
            echo "Error: " . mysqli_error($con);
        }
    }
}
?>
