<?php
  include_once './dblogin.php';
  $id = $_GET['id'];
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="uft-8">
    <meta name="viewport" content="width=device-width">
    <title>Andreas Online Shop | Welcome</title>
    <link rel="stylesheet" href="..\store.css">
  </head>
  <body onload="myMove()">
    <div class="container">
      <header><font size="8">
        <?php
          $sql = "SELECT * FROM lab_web.laptop WHERE id_l=".$id;
          $result = mysqli_query($conn, $sql);
          $row = mysqli_fetch_assoc($result);
          echo $row['name'];
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
          
        </div>
        <div class="center">
          
        </div>
          <script type="text/javascript" src="../store.js"></script>
        <div class="left">
          <div class="dop">
            <div class="big" align="center">
              <div class="circle"></div>
            </div> 
          </div>
          <div class="catalog">
            <div class="description">
              <img style='float:left' src=<?php echo '../laptop'.$id.'.jpg'?>></img>
              <div style='float:left'>
                This laptom can be founded with next filter
                <?php
                  echo '<br>Developer is: ';
                  $sql = "SELECT * FROM lab_web.laptop WHERE id_l=".$id;
                  $res = mysqli_query($conn, $sql);
                  $row = mysqli_fetch_assoc($res);
                  $sql = "SELECT * FROM lab_web.advanced_filter WHERE id=".$row['developer_id'];
                  $result = mysqli_query($conn, $sql);
                  echo mysqli_fetch_assoc($result)['advanced_filter'];
                  echo '<br>Price is: ';
                  $sql = "SELECT * FROM lab_web.advanced_filter WHERE id=".$row['price_id'];
                  $result = mysqli_query($conn, $sql);
                  echo mysqli_fetch_assoc($result)['advanced_filter'];
                  echo '<br>Responce is: ';
                  $sql = "SELECT * FROM lab_web.advanced_filter WHERE id=".$row['response_id'];
                  $result = mysqli_query($conn, $sql);
                  echo mysqli_fetch_assoc($result)['advanced_filter'];
                  //echo $sql;
                ?><br>
              </div>
            </div>
          </div>
        </div>
      </div>
      <footer>Contact us!</footer>
    </div>
    
  </body>
</html>