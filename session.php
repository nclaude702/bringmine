<?php
session_start();
if (!isset($_SESSION['id'])) {
  header('location:../index.php');
}
else
{
  echo $_SESSION["id"];
  echo $_SESSION["names"];
  echo $_SESSION["username"];
 // echo $_SESSION["email"];
 // echo $_SESSION["phone"];
  
?>
