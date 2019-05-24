<?php
  include_once './dblogin.php';
  $arrive = $_POST['arrive'];
  $depart = $_POST['depart'];
  if($_POST['stan'])
    $sql = "INSERT INTO `lab_web`.`lab6` (`arrive`, `depart`) VALUES ('".$arrive."', '".$depart."');";
  else
    $sql = "DELETE FROM `lab_web`.`lab6` WHERE (`arrive` = '".$arrive."');";
    mysqli_query($conn, $sql);
?>