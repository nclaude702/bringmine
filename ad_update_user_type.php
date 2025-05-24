<?php
include("code/con1.php");

// Check if the `id` parameter is set in the URL
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']);

    // Fetch the current role of the user
    $query = "SELECT type FROM `users` WHERE id = '$id'";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $current_role = $row['type']; // Use 'type' as per your query

        // Toggle the role
        $new_role = ($current_role === 'user') ? 'admin' : 'user';

        // Update the user's role
        $update_query = "UPDATE `users` SET type = '$new_role' WHERE id = '$id'";
        $update_result = mysqli_query($con, $update_query);

        if ($update_result) {
            echo "<script>
                    alert('User role updated successfully!');
                    window.location.href ='ad_register_other.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Failed to update user role.');
                    window.location.href ='ad_register_other.php';
                  </script>";
        }
    } else {
        echo "<script>
                alert('User not found.');
                window.location.href ='ad_register_other.php';
              </script>";
    }
} else {
    echo "<script>
            alert('Invalid request. No user ID provided.');
            window.location.href ='ad_register_other.php';
          </script>";
}

// Close the database connection
mysqli_close($con);
?>