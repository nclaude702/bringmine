<?php 
session_start();
if (!isset($_SESSION['id'])) {
    header('location:../index.php');
} else {
    $id = $_SESSION["id"];
}

include("code/con1.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $names = mysqli_real_escape_string($con, $_POST['names']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    // Handle file upload
    $profile_picture = $_FILES['profile_picture'];
    $upload_dir = "assets/profile/";
    $upload_file = $upload_dir . basename($profile_picture['name']);
    $upload_success = false;

    if ($profile_picture['size'] > 0) {
        // Validate file type
        $allowed_types = ['image/jpeg', 'image/png', 'image/jpg'];
        if (in_array($profile_picture['type'], $allowed_types)) {
            if (move_uploaded_file($profile_picture['tmp_name'], $upload_file)) {
                $upload_success = true;
            } else {
                echo "Error uploading profile picture.";
            }
        } else {
            echo "Invalid file type. Only JPG, JPEG, and PNG are allowed.";
        }
    }

    // Update query
    $update_query = "UPDATE `users` SET 
                        names='$names', 
                        e_mail='$email', 
                        phone='$phone', 
                        username='$username', 
                        password='$password'";
    if ($upload_success) {
        $update_query .= ", profile='$upload_file'";
    }
    $update_query .= " WHERE id='$id'";

    if (mysqli_query($con, $update_query)) {
        $_SESSION['names'] = $names;
        $_SESSION['username'] = $username;
        header('Location: profile1.php');
    } else {
        echo "Error updating record: " . mysqli_error($con);
    }
}

// Fetch user data
$query = "SELECT * FROM `users` WHERE id = '$id'";
$result = mysqli_query($con, $query);
$user_data = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("head.php"); ?>
    <title>Edit Profile</title>
</head>
<body>
    <?php include("menu.php"); ?>

    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <h3 class="font-weight-bold">Edit Profile</h3>
                    <div class="col-12 grid-margin">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Update Your Details</h4>
                                <form class="form-sample" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Names</label>
                                                <input type="text" class="form-control" name="names" value="<?php echo htmlspecialchars($user_data['names']); ?>" required />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>E-mail</label>
                                                <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($user_data['e_mail']); ?>" required />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input type="text" class="form-control" name="username" value="<?php echo htmlspecialchars($user_data['username']); ?>" required readonly/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" class="form-control" name="password" value="<?php echo htmlspecialchars($user_data['password']); ?>" required />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Phone</label>
                                                <input type="text" class="form-control" name="phone" value="<?php echo htmlspecialchars($user_data['phone']); ?>" required />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Profile Picture</label>
                                                <input type="file" class="form-control" name="profile_picture" />
                                                <small>Current: <?php echo htmlspecialchars($user_data['profile']); ?></small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row justify-content-center">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
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
