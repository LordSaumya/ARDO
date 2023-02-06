<?php
session_start();
?>
<!DOCTYPE HTML>
<html>
    <head>
      <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
      <link rel='shortcut icon' type='image/x-icon' href='favicon.ico' />
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Home | Ardo</title>
      <link rel = "stylesheet" href = "ardo.css">
    </head>
<body onload = "autoSlides()">
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
  <p class = "quote">
    We borrow from nature the space upon which we build.<br><br>
  </p>
  <p class = "quote-author">~ Tadao Ando</p><br>
  <div class = "headline"><span>The Green Construction Materials Bazaar</span><br><span class = "subheadline">The unique ecosystem for designers to reduce carbon footprint</span></div><br>
  <div class = "mission"><b class = "mission-title">Mission:</b><br><span class = "mission-statement">To create a win-win platform for the designer, end user and environment for resource utilisation in the construction industry.</span></div>
  <br>
  <!-- Slideshow container -->
<div class="slideshow-container">
  <div class="Slide fade" name = "Slide">
    <a href = "order.html"><img src="img1.jpg" title = "Image Source: Sexton, Joe. Stack of plywood. Digital image. Actual Plywood Thickness and Size. Inch Calculator, 22 Oct. 2017. Web. 2020. &lt;https://www.inchcalculator.com/wp-content/uploads/2017/10/plywood-thickness-624x334.jpg&gt;." style="width:100%"></a>
    <div class="caption">Plywood</div>
  </div>

  <div class="Slide fade" name = "Slide">
    <a href = "order.html"><img src="img2.jpg" title = "Image Source: Stone Blocks. Digital image. Stone Blocks. RGBStock, 8 Aug. 2008. Web. 2020. &lt;https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcRNr5BQHc-fzOucgBrEy-R2djvtOFVvLHI3wJ7YoqfgU5HQrTwE&gt;." style="width:100%"></a>
    <div class="caption">Stone blocks</div>
  </div>

  <div class="Slide fade" name = "Slide">
    <a href = "order.html"><img src="img3.jpg" title = "Image Source: GR40 GR60 Steel Rebar, Deformed Steel Bar, Iron Rods for Construction. Digital image. Alibaba. Alibaba, 2010. Web. &lt;https://www.alibaba.com/product-detail/GR40-GR60-steel-rebar-deformed-steel_60761760968.html&gt;." style="width:100%"></a>
    <div class="caption">Iron rods</div>
  </div>
  <a class="prev" style = "left:0" onclick="cngSlides(-1)">&#10094;</a>
  <a class="next" onclick="cngSlides(1)">&#10095;</a>
</div>
<br>
</div>
<!--/BODY-->
</center>
<script>
window.onscroll = function() {stickyNavbar(window.pageYOffset)};

// Get the navbar
var navbar = document.getElementById("navbar");
var sticky = navbar.offsetTop;
// Add the sticky class to the navbar when you
//reach its scroll position. Remove "sticky" when you
//leave the scroll position
function stickyNavbar(y) {
  if (y >= sticky) {
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}
//SLIDESHOW{
  var index = 0;
  var to;
  var slides = document.getElementsByName("Slide");
function autoSlides(){
  //Changes slide
  cngSlides(1);
  //Runs this function again after 3 seconds.
  to = setTimeout(autoSlides, 3000);
}
function cngSlides(n){
  //Changes index
  index += n;
  //Makes sure index stays between 1 and slide length
  if (index < 1){
    index = slides.length;
  }
  if (index > slides.length) {
    index = 1;
  }
  //Resets timeout for autoSlides;
  clearTimeout(to);
  to = setTimeout(autoSlides, 3000);
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  //Makes selected slide visible
  slides[index-1].style.display = "block";
}

//}SLIDESHOW
function logOut(){
  var logout = confirm("Would you like to log out?");
  if (logout == true){
    window.location = "https://ardo1.000webhostapp.com/logout.php";
  }
}
</script>
</body>
</html>