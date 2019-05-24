<?php
  include_once './dblogin.php';
  /*$sql = "SELECT * FROM lab_web.lab6";
  $result = mysqli_query($conn, $sql);
  $result_check = mysqli_num_rows($result);
  /*if($result_check > 0) {
    while($row = mysqli_fetch_assoc($result)) {
      echo $row['title'];
    }
  }
  echo $result_check;*/
  $arrive = $_POST['arrive'];
  $depart = $_POST['depart'];
  $sql = "SELECT * FROM lab_web.lab6 WHERE ('".$arrive."' <= arrive AND arrive <= '".$depart."') OR ('".$arrive."' <= depart AND depart <= '".$depart."');";
  $result = mysqli_query($conn, $sql);
  if(!mysqli_num_rows($result)) {
    echo '<button id="btn" onclick="book(\''.$arrive.'\', \''.$depart.'\')">Book it!</button>';
  } else {
    echo 'Following days are reserved: <br />';
    while($row = mysqli_fetch_assoc($result)) {
      echo $row['arrive'].'...'.$row['depart'].'<Button id="pres" onclick="disable(\''.$row['arrive'].'\', \''.$row['depart'].'\')">Unbook it!</button>><br/>';
    }
  }
?>