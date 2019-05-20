<?php
  include_once './php/dblogin.php';
  if(isset($_GET['submit'])) {
    $ok = true;
    $message = "";
    if('a' <= $_GET['name'][0] && $_GET['name'][0] <= 'z') {
      $ok = false;
      $message = "Wrong name!";
    }
    if(strlen($_GET['phone']) != 10 || $_GET['phone'][0] != '0') {
      $ok = false;
      $message = "Wrong phone number!";
    }
    $at = strpos($_GET['mail'], '@');
    if($at == false || $at == 0 || $at == strlen($_GET['mail'])-1) {
      $ok = false;
      $message = "Wrong email!";
    }
    if($ok == false) {
      //echo "<script type='text/javascript'>alert('$message');</script>";
    } else {
      $sql = "INSERT INTO lab_web.contacts VALUES (DEFAULT, \"".$_GET['name']."\", \"".$_GET['mail']."\", \"".$_GET['phone']."\", \"".$_GET['text']."\");";
      $result = mysqli_query($conn, $sql);
      date_default_timezone_set('Australia/Melbourne');
      //echo date('h:i:s', time());

      $sql = "INSERT INTO lab_web.information VALUES (DEFAULT, \"".$_SERVER['REMOTE_ADDR']."\", \"".date('Y-m-d', time())."\", \"".date('h:i:s', time())."\");";
      //echo $sql;
      $result = mysqli_query($conn, $sql);
      
      //echo 'User IP - '.$_SERVER['REMOTE_ADDR'];
      //$result_check = mysqli_num_rows($result);
      //if($result_check > 0) {
      //  while($row = mysqli_fetch_assoc($result)) {
      //    echo $row['advanced_filter'].'<br>';
      //  }
      // }
    }
  }
  if(isset($_GET['destroy'])) {
    $sql = "DELETE FROM lab_web.katalog_1 WHERE (id_p=".$_GET['destroy'].");";
    mysqli_query($conn, $sql);
    $sql = "DELETE FROM lab_web.katalog_2 WHERE (id_p=".$_GET['destroy'].");";
    mysqli_query($conn, $sql);
    $sql = "DELETE FROM lab_web.katalog_3 WHERE (id_p=".$_GET['destroy'].");";
    mysqli_query($conn, $sql);
  }
  if(isset($_POST['submit'])) {
    $sql = "SELECT * FROM lab_web.katalog_1 WHERE url='".$_SERVER['PHP_SELF']."';";
    $result = mysqli_query($conn, $sql);
    $id = mysqli_fetch_assoc($result)['id_p'];
    if(isset($_POST['title'])) {
      $sql = "UPDATE lab_web.katalog_2 SET title='".$_POST['title']."' WHERE id_p=".$id.";";
      mysqli_query($conn, $sql);
    }
    if(isset($_POST['description'])) {
      $sql = "UPDATE lab_web.katalog_2 SET description='".$_POST['description']."' WHERE id_p=".$id.";";
      mysqli_query($conn, $sql);
      $sql = "UPDATE lab_web.katalog_3 SET description='".$_POST['description']."' WHERE id_p=".$id.";";
      mysqli_query($conn, $sql);
    }
    if(isset($_POST['key'])) {
      $sql = "UPDATE lab_web.katalog_2 SET keywords='".$_POST['key']."' WHERE id_p=".$id.";";
      mysqli_query($conn, $sql);
    }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="uft-8">
    <meta name="viewport" content="width=device-width">
    <title>Andreas Online Shop | Welcome</title>
    <link rel="stylesheet" href=".\store.css">
  </head>
  <body onload="myMove()">
    <div class="container">
      <header><font size="8">
        <?php
          $sql = "SELECT * FROM lab_web.katalog_1 INNER JOIN lab_web.katalog_2 ON katalog_1.id_p=katalog_2.id_p WHERE url=\"".$_SERVER['PHP_SELF']."\"";
          $result = mysqli_query($conn, $sql);
          $result_check = mysqli_num_rows($result);
          if($result_check > 0) {
            while($row = mysqli_fetch_assoc($result)) {
              echo $row['title'];
            }
          }
        ?>
      </font></header>
      <div class="middle">
        <div class="menu">
          <?php
            $sql = "SELECT * FROM lab_web.katalog_1 INNER JOIN lab_web.katalog_2 ON katalog_1.id_p=katalog_2.id_p;";
            $result = mysqli_query($conn, $sql);
            $result_check = mysqli_num_rows($result);
            if($result_check > 0) {
              while($row = mysqli_fetch_assoc($result)) {
                echo "<a href='".$row['url']."'><font size=\"6\">".$row['title']."</font></a>";
              }
            }
          ?>
          <form method="POST">
            Title<br>
            <input type="text" name="title"><br>
            Description<br>
            <input type="text" name="description"><br>
            Key words<br>
            <input type="text" name="key"><br>
            <input type="submit" name="submit" value="submit">
          </form>
        </div>
        <div class="center">
          <form method="GET" onsubmit="return myFunction()">
            Name: <input type="text" id="name" size="20" name="name"><br>
            Phone: <input type="text" id="phone" size="20" name="phone"><br>
            E-mail: <input type="text" id="email" size="20" name="mail"><br><br>
            Text: <input type="text" id="text" size="20" name="text"><br><br>
            <input type="submit" name="submit" value="submit"> 
          </form>
          <?php
            $sql = "SELECT * FROM lab_web.katalog_2;";
            $result = mysqli_query($conn, $sql);
            $result_check = mysqli_num_rows($result);
            if($result_check > 0) {
              while($row = mysqli_fetch_assoc($result)) {
                echo "<a href='?destroy=".$row['id_p']."'>Destroy</a> ".$row['title']."<br>";
              }
            }
          ?>
          <script type="text/javascript" src="./store.js"></script>
        </div>
        <div class="left">
          <div class="dop">
            <div class="big" align="center">
              <div class="circle"></div>
            </div> 
          </div>
          <div class="catalog">
            <a href="/web-lab1/php/goods.php?id=1"><img src='./laptop1.jpg' alt='Italian Trulli'></img>
            <a href="/web-lab1/php/goods.php?id=2"><img src='./laptop2.jpg' alt='Italian Trulli'></img>
            <a href="/web-lab1/php/goods.php?id=3"><img src='./laptop3.jpg' alt='Italian Trulli'></img>
            <a href="/web-lab1/php/goods.php?id=4"><img src='./laptop4.jpg' alt='Italian Trulli'></img>
          </div>
        </div>
      </div>
      <footer>Contact us!
      </footer>
    </div>
    
  </body>
</html>