<?php
  include_once './dblogin.php';
  $arrive = $_POST['arrive'];
  $depart = $_POST['depart'];
  $sql = "INSERT INTO `lab_web`.`lab6` (`arrive`, `depart`) VALUES ('".$arrive."', '".$depart."');";
  mysqli_query($conn, $sql);
?>