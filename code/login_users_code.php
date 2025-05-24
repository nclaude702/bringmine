<?php
session_start();

if (isset($_POST['login'])) {
    include("con1.php");

    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Sanitize user inputs to prevent SQL injection
    $my = mysqli_real_escape_string($con, $_POST['username']);
    $your = mysqli_real_escape_string($con, $_POST['password']);

    // Prepared statement to prevent SQL injection
    $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $my, $your);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result) {
        $fetch = mysqli_fetch_array($result);
        $names = $fetch['names'] ?? null;
        $idd = $fetch['id'] ?? null;
        $uname = $fetch['username'] ?? null;
        $email = $fetch['e_mail'] ?? null;
        $phone = $fetch['phone'] ?? null;
        $type = $fetch['type'] ?? null;

        $count = mysqli_num_rows($result);
        if ($count == 1) {
            if ($type == "user") {
                $_SESSION["id"] = $idd;
                $_SESSION["names"] = $names;
                $_SESSION["username"] = $uname;
                $_SESSION["email"] = $email;
                $_SESSION["phone"] = $phone;
                header("Location:../home.php?msg=Login%20successful!");
                exit();
            } elseif ($type == "admin") {
                $_SESSION["ad_id"] = $idd;
                $_SESSION["ad_names"] = $names;
                $_SESSION["ad_username"] = $uname;
                $_SESSION["ad_email"] = $email;
                $_SESSION["ad_phone"] = $phone;
                header("Location:../ad_home.php?msg=Login%20successful!");
                exit();
            } else {
                header("Location:../index.php?msg=Login%20not%20successful!");
                exit();
            }
        } else {
            header("Location:../index.php?msg=Invalid%20Username%20or%20Password!%20Please%20try%20again.");
            exit();
        }
    } else {
        echo "Error: " . mysqli_error($con);
    }

    // Close the database connection
    mysqli_close($con);
}
?>
