<?php
  include_once './dblogin.php';
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
    if(!$ok) {
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
    <link rel="stylesheet" href="..\store.css">
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
          <?php
            
          ?>
          <script type="text/javascript" src="../store.js"></script>
        </div>
        <div class="left">
          <div class="dop">
            <div class="big" align="center">
              <div class="circle"></div>
            </div> 
          </div>
          Google AdSense Publishers Need a Privacy Policy
Google AdSense provides clear terms on which it will allow a publisher to participate in its program. When you sign up as a publisher, you agree to Google’s AdSense Online Terms of Service. Here’s part of what you’re agreeing to:

A Privacy Policy is Required By Law
To make the most out of Google AdSense, you’ll want as many people as possible to visit your website and click on your ads. Even if you’re operating in a country or state that doesn’t have strict privacy laws (and there are increasingly few), you’re still going to have to abide by the rules of the places from which your users are visiting your website.

European Union
The EU’s General Data Protection Regulation (GDPR) requires anyone who processes the personal data of EU citizens to publish a information about their data processing activities in a “concise, transparent, intelligible and easily accessible form, using clear and plain language.” This means you need a Privacy Policy. If you’re a Google AdSense publisher whose website gets EU traffic – this means you.

United States
The California Online Privacy Protection Act (CalOPPA) means that any “web site or online service that collects personally identifiable information through the Internet about individual consumers residing in California” must “conspicuously post its privacy policy on its web site.”

If you’re processing personal data on your website, and you want it to be accessed in California, you have to abide by CalOPPA – no matter where the website is hosted.

Other Places
The Australian Privacy Act 1988 requires you to have a Privacy Policy if you’re processing the personal data of Australia residents.
Canada’s Personal Information Protection and Electronic Documents Act (PIPEDA) requires companies who are processing the personal data of Canadians to have a Privacy Policy available on request.
Singapore’s Personal Data Protection Act (PDPA) requires you to inform Singapore residents of your purposes for collecting their personal data. This amounts to the requirement for a Privacy Policy.
Cookies and Privacy Law
Google AdSense uses cookies to help it display ads that are relevant to your website’s visitors. Because of the information that these particular cookies provide about your visitors, they constitute personal data.

Google requires its users to be transparent about how their websites use cookies. This requirement includes displaying a Privacy Policy:

Privacy law also specifically requires you to provide information about the cookies your website uses.

The EU has been regulating cookie usage since Section 25 of the ePrivacy Directive 2002 stated that use of cookies “should be allowed on condition that users are provided with clear and precise information” about their use. The Directive also states that “users should have the opportunity to refuse” cookies.

The GDPR only mentions cookies once, in Recital 30. However, this small mention is enough to establish that cookies that identify a user’s device are a type of personal data, and so should be treated as such.

The GDPR’s rules on transparency and security apply to cookies as much as it applies to a person’s name or phone number.

Section 22577(a)(7) of CalOPPA gives a definition of “personally identifiable information” which includes “information concerning a user that the Web site or online service collects online from the user and maintains in personally identifiable form.” Certain cookies fit this definition.

Google AdSense Requirements
You’re required you to have a Privacy Policy, and it must include some specific information:

There are a number of ways you might write a Privacy Policy or adapt your existing Privacy Policy to comply with this. But it may seem a little daunting. Let’s break it all down so you can understand how to implement it.
        </div>
      </div>
      <footer>Contact us!
      </footer>
    </div>
    
  </body>
</html>