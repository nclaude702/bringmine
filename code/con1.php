<?php
  $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "bringmine";

    // Establish database connection
    $con = mysqli_connect($servername, $username, $password, $db);
    $con2=new pdo("mysql:host=$servername;dbname=$db;",$username,$password);
?>