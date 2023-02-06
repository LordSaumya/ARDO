<?php
session_start();
if (!isset($_SESSION["loggedIn"])){
  header("location:registration.php");
}
?>
<!DOCTYPE HTML>
<html>
    <head>
      <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
      <link rel='shortcut icon' type='image/x-icon' href='favicon.ico' />
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>  | Ardo</title>
      <link rel = "stylesheet" href = "ardo.css">
    </head>
  <!--HEADER-->
  <div class = "header">
    <div class = "logo-container">
    <img src = "Logo.png" alt = "logo" class = "logo">
    </div>
    <span class = "loginStatus" id = "loginStatus">
      <?php
      if (isset($_SESSION["loggedIn"])){
        echo("<span title = 'Click to log out' onclick = 'logOut()'>Logged in as ". $_SESSION['username']."</span>");
      }
      else{
        echo("<a href = 'registration.php'>Sign Up/Log In</a>");
      }
      ?>
      <a href = "registration.php" style = "color:white"></a>
      </span>&nbsp;&nbsp;&nbsp;
    <span class = "title">ARDO</span><br>
    </div>
    <div id = "navbar" class = "navbar">
  <a href="index.php" class = "homeL"><img src = "home-icon.png" style = "width:23px"></a><span class = "divider">|</span>
  <a href="donate.php" class = "nLink">Donate</a><span class = "divider">|</span>
  <a href="order.php" class = "nLink">Order</a>
</div>
<!--/HEADER-->
<center>
<!--BODY-->
<div class = "content"><br><br><br>
  <h1 class = "dTitle"> </h1><br><br>
  
</div>
<!--/BODY-->
</center>
<script>
window.onscroll = function() {stickyNavbar(window.pageYOffset)};

var navbar = document.getElementById("navbar");
var sticky = navbar.offsetTop;

function stickyNavbar(y) {
  if (y >= sticky) {
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}
</script>
</body>
</html>