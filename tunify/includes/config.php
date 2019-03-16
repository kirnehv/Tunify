<?php
  ob_start();
  session_start(); //save varibale values accross pages

  $timezone = date_default_timezone_set("America/Los_Angeles");

  //login to mysql to access database
  $con = mysqli_connect("localhost", "root", "", "tunify");

  if(mysqli_connect_errno()){
    echo "Failed to connect: " . mysqli_connect_errno();
  }
?>
