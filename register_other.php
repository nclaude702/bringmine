<?php 
session_start();
if (!isset($_SESSION['id'])) {
    header('location:../index.php');
    exit;
}

include("code/con1.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $names = mysqli_real_escape_string($con, $_POST['names']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    // Hash the password
   // $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Handle file upload
    $profile_picture = $_FILES['profile_picture'];
    $upload_dir = "assets/profile/";
    $upload_file = "";
    $upload_success = false;

    if ($profile_picture['size'] > 0) {
        // Validate file type
        $allowed_types = ['image/jpeg', 'image/png', 'image/jpg'];
        if (in_array($profile_picture['type'], $allowed_types)) {
            $file_name = uniqid() . '_' . basename($profile_picture['name']);
            $upload_file = $upload_dir . $file_name;

            if (move_uploaded_file($profile_picture['tmp_name'], $upload_file)) {
                $upload_success = true;
            } else {
                echo "Error uploading profile picture.";
            }
        } else {
            echo "Invalid file type. Only JPG, JPEG, and PNG are allowed.";
        }
    }

    // Check if username or email already exists
    $check_query = "SELECT * FROM `users` WHERE username='$username' OR e_mail='$email'";
    $check_result = mysqli_query($con, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>
                alert('Error: Username or Email already exists.');
                window.history.back();
              </script>";
    } else {
        // Insert query
        $insert_query = "INSERT INTO `users` (names, e_mail, phone, username, password";
        if ($upload_success) {
            $insert_query .= ", profile";
        }
        $insert_query .= ") VALUES ('$names', '$email', '$phone', '$username', '$password'";
        if ($upload_success) {
            $insert_query .= ", '$upload_file'";
        }
        $insert_query .= ")";

        if (mysqli_query($con, $insert_query)) {
            echo "<script>
                    alert('User registered successfully!');
                    window.location.href = 'register_other.php';
                  </script>";
            exit;
        } else {
            echo "Error inserting record: " . mysqli_error($con);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("head.php"); ?>
    <title>Register User</title>
</head>
<body>
    <?php include("menu.php"); ?>

    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <h3 class="font-weight-bold">Register User</h3>
                    <div class="col-12 grid-margin">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Fill in Your Details</h4>
                                <form class="form-sample" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Names</label>
                                                <input type="text" class="form-control" name="names" required />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>E-mail</label>
                                                <input type="email" class="form-control" name="email" required />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input type="text" class="form-control" name="username" required />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" class="form-control" name="password" required />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Phone</label>
                                                <input type="text" class="form-control" name="phone" required />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Profile Picture</label>
                                                <input type="file" class="form-control" name="profile_picture" />
                                                <small>Allowed types: JPG, JPEG, PNG</small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row justify-content-center">
                                        <button type="submit" class="btn btn-primary">Register</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <?php include("foot.php"); ?>
    </div>
</body>
</html>
