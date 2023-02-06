<?php
session_start();
if (!isset($_SESSION["loggedIn"])){
  header("location:registration.php");
}
else{
  if(isset($_POST["submit"])){
    $reply_to_email = "saumyashah717@gmail.com";
    $subject        = "Ardo Order Notification";
    date_default_timezone_set('Asia/Kolkata');
    $to = 'saumyashah717@gmail.com,'.$_SESSION["email"];
    $headers = "From:ardoOrders@gmail.com\r\n";
    $headers .= "Reply-To:saumyashah717@gmail.com\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    $username = strip_tags(stripslashes($_SESSION["username"]));
    $email = strip_tags(stripslashes($_SESSION["email"]));
    $type = strip_tags(stripslashes($_POST["orderType"]));
    $qty = strip_tags(stripslashes($_POST["orderQty"]));
    $size = strip_tags(stripslashes($_POST["orderSize"]));
    $otherDetails = strip_tags(stripslashes($_POST["orderOtherDetails"]));
    $id = strip_tags(stripslashes($_POST["orderId"]));
    $datetime = date("d-m-y H:i:s");
    
    $message = '<html><body><br><h1>Details of the Order:</h1><br>';
    $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
    $message .= "<tr style='background: #eee;'><td><b>Name of Orderer:</b> </td><td>" . $username . "</td></tr>";
    $message .= "<tr><td><b>Email of Donor:</b> </td><td>" . $email . "</td></tr>";
    $message .= "<tr><td><b>Type of material:</b> </td><td>" . $type . "</td></tr>";
    $message .= "<tr><td><b>Quantity:</b> </td><td>" . $qty . "</td></tr>";
    $message .= "<tr><td><b>Size</b> </td><td>" . $size ."</td></tr>";
    $message .= "<tr><td><b>Other Details:</b> </td><td>" . $otherDetails . "</td></tr>";
    $message .= "<tr><td><b>Product ID:</b> </td><td>" . $id . "</td></tr>";
    $message .= "<tr><td><b>Address:</b> </td><td>" . $_SESSION["address"] . "</td></tr>";
    $message .= "</table><br><br>";
    $message .= "<br><br><br><br><b>Timestamp: </b>".$datetime;
    $message .= "</body></html>";
    if (mail($to, $subject, $message, $headers)){
      echo("<script>alert('Your order has been placed!\\n
      It shall be delivered to the address linked to your account within the next 3 - 4 days.')</script>");
    }
    else{
      echo("Error in placing order. Please try again later.");
    }
  }
}
?>
<!DOCTYPE HTML>
<html>
    <head>
      <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
      <link rel='shortcut icon' type='image/x-icon' href='favicon.ico' />
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Order | Ardo</title>
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
  <h1 class = "dTitle">Order</h1><br><br>
  <img src = "searchIcon.png" style = "width:35px;height:35px;vertical-align:middle;"><input type="text" id = "searchBar" onkeyup = "filterByType('OrderElements');Search((this.value).toUpperCase())" placeholder = "Search...">
  <br><br>
<div id="TypeSelectionBtns">
  <button class = "btn active" onclick = "filterByType('OrderElements')">All</button>
  <button class = "btn" onclick = "filterByType('wood')"> Wood</button>
  <button class = "btn" onclick = "filterByType('stone')"> Stone</button>
  <button class = "btn" onclick = "filterByType('ceramic')"> Ceramic</button>
  <button class = "btn" onclick = "filterByType('paint')"> Paint/Dye</button>
  <button class = "btn" onclick = "filterByType('metal')"> Metals</button>
  <button class = "btn" onclick = "filterByType('tool')"> Tools</button>
  <button class = "btn" onclick = "filterByType('cement')"> Cement/Concrete</button>
  <button class = "btn" onclick = "filterByType('other')"> Others/Misc.</button>
</div><br><br>
<div class = "orderElementsContainer">
  <button onclick = "Order('Wood',3,1000,'cm3','Plywood', 'W001')" class = "OrderElements wood" id = "Plywood">
  <div class = "OrderDisplay">
  <img src="background.jpg" class="OrderImage" style="width:100%">
  <div class="middle">
    <div class="text"><b>Type: </b> Wood<br><b>Quantity: </b>3<br><b>Size: </b>1000 cm&sup3;<br><b>Other Details: </b>Plywood</div>
  </div>
</div>
  </button>
  <button onclick = "Order('stone',3,1000,'cm3','Pile of stones','S001')" class = "OrderElements stone" id = "Pile of stones">
    <div class = "OrderDisplay">
  <img src="background.jpg" class="OrderImage" style="width:100%">
  <div class="middle">
    <div class="text"><b>Type: </b> Stone<br><b>Quantity: </b>3<br><b>Size: </b>1000 cm&sup3;<br><b>Other Details: </b>Pile of stones</div>
  </div>
</div>
</button>
  <button onclick = "Order('ceramic',3,1000,'cm3','Marble','R001')" class = "OrderElements ceramic" id = "Marble">
  <div class = "OrderDisplay">
  <img src="background.jpg" class="OrderImage" style="width:100%">
  <div class="middle">
    <div class="text"><b>Type: </b> Ceramic<br><b>Quantity: </b>3<br><b>Size: </b>1000 cm&sup3;<br><b>Other Details: </b>Marble</div>
  </div>
</div>
  </button>
  <button onclick = "Order('paint',3,1000,'cm3','Blue Paint','P001')" class = "OrderElements paint" id = "Blue paint">
  <div class = "OrderDisplay">
  <img src="background.jpg" class="OrderImage" style="width:100%">
  <div class="middle">
    <div class="text"><b>Type: </b> Paint/Dye<br><b>Quantity: </b>3<br><b>Size: </b>1000 cm&sup3;<br><b>Other Details: </b>Blue Paint</div>
  </div>
</div></button>
  <button onclick = "Order('metal',3,1000,'cm3','Iron Rods','M001')" class = "OrderElements metal" id = "Iron rods">
  <div class = "OrderDisplay">
  <img src="background.jpg" class="OrderImage" style="width:100%">
  <div class="middle">
    <div class="text"><b>Type: </b> Metal<br><b>Quantity: </b>3<br><b>Size: </b>1000 cm&sup3;<br><b>Other Details: </b>Iron Rods</div>
  </div>
</div></button>
  <button onclick = "Order('tool',3,1000,'cm3','Wrenches','T001')" class = "OrderElements tool" id = "Wrenches">
  <div class = "OrderDisplay">
  <img src="background.jpg" class="OrderImage" style="width:100%">
  <div class="middle">
    <div class="text"><b>Type: </b> Tools<br><b>Quantity: </b>3<br><b>Size: </b>1000 cm&sup3;<br><b>Other Details: </b>Wrenches</div>
  </div>
</div>
</button>
  <button onclick = "Order('cement',3,1000,'cm3','Concrete','C001')" class = "OrderElements cement" id = "Concrete">
<div class = "OrderDisplay">
  <img src="background.jpg" class="OrderImage" style="width:100%">
  <div class="middle">
    <div class="text"><b>Type: </b> Cement/Concrete<br><b>Quantity: </b>3<br><b>Size: </b>1000 cm&sup3;<br><b>Other Details: </b>Concrete</div>
  </div>
</div>
    </button>
  <button onclick = "Order('other',3,1000,'cm3','Fabric strips','O001')" class = "OrderElements other" id = "Fabric Strips">
  <div class = "OrderDisplay">
  <img src="background.jpg" class="OrderImage" style = "width:100%">
  <div class="middle">
    <div class="text"><b>Type: </b> Others/Misc.<br><b>Quantity: </b>3<br><b>Size: </b>1000 cm&sup3;<br><b>Other Details: </b>Fabric Strips</div>
  </div>
</div>
</button>
</div>
<form action = "" method = "post" id = "orderForm" style = "display:none">
  <input name = "orderType" id = "orderType">
  <input name = "orderQty" id = "orderQty">
  <input name = "orderSize" id = "orderSize">
  <input name = "orderOtherDetails" id = "orderOtherDetails">
  <input name = "orderId" id = "orderId">
</form>
<button id = "orderBtn" name = "submit" type = "submit" style = "display:none;" form = "orderForm"></button>
<br><br><br><br><br>
</div>
<!--/BODY-->
</center>
<script>
var elements = document.getElementsByClassName("OrderElements");
function Order(type,qty,size,unit,otherDetails,id){
  document.getElementById("orderType").value = type;
  document.getElementById("orderQty").value = qty;
  document.getElementById("orderSize").value = size + " " + unit;
  document.getElementById("orderOtherDetails").value = otherDetails;
  document.getElementById("orderId").value = id;
  document.getElementById("orderBtn").innerHTML = "Order " + otherDetails;
  document.getElementById("orderBtn").style.display = "block";
}
function Search(filter) {
  for (i = 0; i < elements.length; i++) {
    if (((elements[i].id).toUpperCase()).indexOf(filter) > -1) {
      elements[i].style.display = "inline-block";
    } else {
      elements[i].style.display = "none";
    }
  }
}

function filterByType(type){
  for (i = 0;i < elements.length; i++){
    elements[i].style.display = "none";
  }
  var selection = document.getElementsByClassName(type);
  for (i = 0;i < selection.length; i++){
    selection[i].style.display = "inline-block";
  }
}
filterByType('OrderElements');
window.onscroll = function() {stickyNavbar(window.pageYOffset)};

var btnContainer = document.getElementById("TypeSelectionBtns");
var btns = btnContainer.getElementsByClassName("btn");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function() {
    var current = document.getElementsByClassName("active");
    current[0].className = current[0].className.replace(" active", "");
    this.className += " active";
  });
}


var navbar = document.getElementById("navbar");
var sticky = navbar.offsetTop;

function stickyNavbar(y) {
  if (y >= sticky) {
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}

function logOut(){
  var logout = confirm("Would you like to log out?");
  if (logout == true){
    window.location = "https://ardo1.000webhostapp.com/logout.php";
  }
}
</script>
</body>
</html>