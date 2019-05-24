<?php
  include_once './php/dblogin.php';
?>
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
<!DOCTYPE html>
<script src='store.js'>
 
</script>
<html>
  <head>
    <meta charset="uft-8">
    <meta name="viewport" content="width=device-width">
    <title>Andreas Online Shop | Welcome</title>
    <link rel="stylesheet" href="store.css">
  </head>
  <body>
    <div class="container">
      <header><font size="8">
        Booking
      </font></header>
      <div class="middle">
        <div class="search" align="center">
          <form>
            Arrive: <input type="date" id="arrive" name="arrive">
            Depart: <input type="date" id="depart" name="depart">
          </form>
          <button onclick="work()">Search</button>
        </div>
        <div class="info"align="center">
        </div>
        <div class="dop" align="center"></div>
      </div>
      <footer>Contact us!
      </footer>
    </div>
  </body>
</html>