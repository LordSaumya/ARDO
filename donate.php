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
      <title>Donate | Ardo</title>
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
  <h1 class = "dTitle">Donate</h1><br><br>
  <form method = "POST" class = "donateForm" id = "donateForm" action = "donateProcess.php" enctype= "multipart/form-data">
  <label>Type:</label><input name = "materialType" id = "materialType" style = "visibility:hidden;width:1%;" required>&nbsp;<div class="typeInput"><input type = "button" id = "typeInput" onclick="toggleDisplay()" class="dropbtn" value = "Type of material">
  <div id = "dropdown" class="dropdown-content">
    <a onclick = "changeType(this)">Wood</a>
    <a onclick = "changeType(this)" >Stone</a>
    <a onclick = "changeType(this)">Ceramic</a>
    <a onclick = "changeType(this)">Paint/Dye</a>
    <a onclick = "changeType(this)">Metal</a>
    <a onclick = "changeType(this)">Tools</a>
    <a onclick = "changeType(this)">Cement/Concrete</a>
    <a onclick = "changeType(this)">Other/Misc.</a>
  </div>
</div>
<br><br>
<label>Quantity:</label>&nbsp;<input min = "1" type = "number" class = "donateFormInput" placeholder = "Quantity" name = "qty" style = "width:30%" required>
&nbsp;&nbsp;&nbsp; <span class = "space2" style = "visibility:hidden">x</span><label>Size:</label>&nbsp;<input min = "1" type = "number" class = "donateFormInput" placeholder = "Size" name = "size" style = "width:30%" required>&nbsp;&nbsp;
<select name="unit" class = "donateFormInput" style = "width:100px" required>
  <option value="kg">kg</option>
  <option value="cm">cm</option>
  <option value="cm2">cm&sup2;</option>
  <option value="cm3">cm&sup3;</option>
  <option value="ml">ml</option>
</select><br><br>
<label>Colour:</label>&nbsp;<input type = "color" class = "donateFormInput-clr" name = "colour" required><span style = "width:20%;display:inline-block;visibility:hidden">spacer</span>
<label>Photo: </label><label for = "photoUpload" id = "photoUploadIcon"><img src = "Camera.png"></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type = "file" name = "photoUL" style = "display:none" id = "photoUpload" accept="image/*" oninput = "showPhotoName(this)" required><label style = "font-size:14px" id = "fileNameOutput"></label><br><br>
<label>Other Details:</label><br>
<textarea name = "otherDetails" class = "donateFormInput" rows = "6" required></textarea>
<br><br>
<label>Site Location:</label><br>
<textarea name = "siteLocation" class = "donateFormInput" rows = "6" required></textarea>
<br><br><br><input type="hidden" id = "fileNameOutputInp" name = "fileName">
<input type = "submit" name = "submitbutton" id = "submitBtn" value = "Submit Donation">
</form><br><br><br>
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

function changeType(item){
  document.getElementById("typeInput").value = item.innerHTML;
  document.getElementById("materialType").value = item.innerHTML;
}
function toggleDisplay() {
  document.getElementById("dropdown").classList.toggle("show");
}
window.onclick = function(e) {
  if (e.target.matches('.dropbtn') == false) {
    var dropdown = document.getElementsByClassName("dropdown-content")[0];
      if(dropdown.classList.contains('show')){
        dropdown.classList.remove('show');
      }
    }
}
function showPhotoName(file){
  document.getElementById("fileNameOutput").innerHTML = file.files[0].name;
  document.getElementById("fileNameOutputInp").value =
  document.getElementById("photoUpload").value;
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