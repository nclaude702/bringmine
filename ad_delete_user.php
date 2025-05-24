<?php
include("code/con1.php");

// Check if the `id` parameter is set in the URL
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']);

    // Query to delete the user
    $query = "DELETE FROM `users` WHERE id = '$id'";
    $result = mysqli_query($con, $query);

    if ($result) {
        // User deleted successfully
        echo "<script>
                alert('User deleted successfully!');
                window.location.href ='ad_register_other.php';
              </script>";
    } else {
        // Failed to delete user
        echo "<script>
                alert('Failed to delete user. Error: " . mysqli_error($con) . "');
                window.location.href ='ad_register_other.php';
              </script>";
    }
} else {
    // No ID provided
    echo "<script>
            alert('Invalid request. No user ID provided.');
            window.location.href ='ad_register_other.php';
          </script>";
}

// Close the database connection
mysqli_close($con);
?>