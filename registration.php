<?php
session_start();
if (isset($_SESSION['loggedIn'])){
  echo('<script type="text/javascript">window.location=\''."https://ardo1.000webhostapp.com/index.php".'\';</script>');
}
require_once "config.php";
  unset($username_err);
  unset($email_err);
  unset($LogInErr);
  $opt = "s";
  $function = "CngS('".$opt."')";
if(isset($_POST['submit'])){
  if (isset($_POST["opt"])){
  $opt = "s";
  $username = $mysqli -> real_escape_string(stripslashes(strip_tags($_POST["Susername"])));
  $password = $mysqli -> real_escape_string(($_POST["Spassword"]));
  $email = $mysqli -> real_escape_string(stripslashes(strip_tags($_POST["Semail"])));
  $phone = $mysqli -> real_escape_string(stripslashes(strip_tags($_POST["Sphone"])));
  $address = $mysqli -> real_escape_string(stripslashes(strip_tags($_POST["Saddress"])));
  
  $sql = 'SELECT * FROM Accounts WHERE Username = "'.$username.'"';
  $result = $mysqli->query($sql);
  if ($result->num_rows > 0){
  $username_err = "This username is already taken!";
  }
  else{
  $sql = 'SELECT * FROM Accounts WHERE Email = "'.$email.'"';
  $result = $mysqli->query($sql);
  if ($result->num_rows > 0){
  $email_err = "This email is being used by another account!";
  }
  else{
    $sql= "SELECT ID FROM Accounts ORDER BY ID DESC LIMIT 1";
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
    $LastId = $row['ID']+1;
    $sql = "INSERT INTO Accounts (ID, Username, Password, Email, Phone, Address) VALUES ('$LastId','$username','$password','$email','$phone','$address')";
   if ($mysqli->query($sql)){
     echo("<script>alert('Account created!');</script>");
     $_SESSION["loggedIn"] = TRUE;
     $_SESSION["username"] = $username;
     $_SESSION["email"] = $email;
     $_SESSION["address"] = $address;
     
    $subject = "Ardo Account Notification";
    $to = $email;
    $headers = "From:ardoAccounts@gmail.com\r\n";
    $headers .= "Reply-To:saumyashah717@gmail.com\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    $mailPswd = substr_replace($password,"XXXX",0,4);
    $mailPhone = substr_replace($phone,"XXXXX",0,5);
    $msg = '
    <html>
    <body>
    <p style = "font-size:23px;font-family:Tahoma;padding:5px;color:#48494B">
    Dear '.$username.',<br>
    <img src = "headImg.png"><br><br>
    Thank you for registering on <a style = "text-decoration:none" href = "https://ardo1.000webhostapp.com/index.php">Ardo</a>!<br>
    Here are the details of your account:<br>
    <b>Username: </b>'.$username.'<br>
    <b>Password: </b>'.$mailPswd.'<br>
    <b>Email: </b>'.$email.'<br>
    <b>Phone Number: </b>'.$mailPhone.'<br>
    <br><br>
    Thanks,<br>
    Ardo Customer Service<br><br><br>
    <span style = "font-size:16px">For any queries, reply to this mail.<br>
    If you have not created this account, reply to this mail.</span>
    </p>
    </body>
    </html>
    ';
     mail($to,"Ardo | Registration", $msg, $headers);
     die('<script type="text/javascript">window.location=\''."https://ardo1.000webhostapp.com/index.php".'\';</script>');
   }
   else{
     echo($mysqli->error);
     echo("<script>alert('Error creating account. Please try again later. Error:'" ."($mysqli->error)". ");</script>");
   }
  }
  }
 }
if (isset($_POST['opt2'])){
  $opt = "l";
  $username = $mysqli -> real_escape_string(stripslashes(strip_tags($_POST["Lusername"])));
  $password = $mysqli -> real_escape_string($_POST["Lpassword"]);
  $sql = "SELECT * FROM Accounts WHERE Username = '$username'";
  $result = $mysqli->query($sql);
  if ($result->num_rows == 0){
    $LogInErr = "There is no account associated with this username!";
  }
  else{
    $sql = "SELECT * FROM Accounts WHERE Username = '".$username."'AND Password = '".$password."'";
    $result = $mysqli->query($sql);
    if($result->num_rows == 1){
      $row = $result->fetch_row();
      $_SESSION["loggedIn"] = TRUE;
      $_SESSION["username"] = $row[1];
      $_SESSION["email"] = $row[3];
      $_SESSION["address"] = $row[5];
      echo("<script>alert('Logged in!');</script>");
      echo('<script type="text/javascript">window.location=\''."https://ardo1.000webhostapp.
      com/index.php".'\';</script>');
    }
    else{
      $LogInErr = "Invalid username or password!";
    }
  }
 }
 $mysqli->close();
}
?>
<!DOCTYPE HTML>
<html>
    <head>
      <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
      <link rel='shortcut icon' type='image/x-icon' href='favicon.ico' />
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Registration | Ardo</title>
      <link rel = "stylesheet" href = "ardo.css">
    </head>
<body style = "background-image:none">
  <!--HEADER-->
  <div class = "header">
    <div class = "logo-container">
    <img src = "Logo.png" alt = "logo" class = "logo">
    </div>
    <span class = "title">ARDO</span>
    </div><hr style = "width:100%;margin:0"><div class = "regBtns">
  <a class = "nLink signUpBtn" id = "signUpBtn" onclick = "CngS('s')" style = "width:50%">Sign Up</a>
  <a class = "nLink logInBtn" id = "logInBtn" onclick = "CngS('l')" style = "width:50%;color:white">Log In</a>
  </div>
<!--/HEADER-->
<center>
<!--BODY-->
<div class = "content" style = "margin-top:0;background-color:RGBA(0,0,0,0)">
  <br><br><br><br><br>
  <form id = "signUpForm" method = "post">
    <div class = "labelWrapper"><label>Name: </label></div><input type = "text" name = "Susername" placeholder = "Name" pattern = ".{3,25}" required><br><br><br>
    <div class = "labelWrapper"><label>Password: </label></div><input type = "password" name = "Spassword" placeholder = "Password" pattern = ".{5,}" required><br><br><br>
    <div class = "labelWrapper"><label>Email: </label></div><input type = "email" name = "Semail" placeholder = "Email Address" pattern = ".{3,}" required><br><br><br>
    <div class = "labelWrapper"><label>Phone: </label></div><input type = "number" name = "Sphone" placeholder = "Phone Number" pattern = ".{10,10}" required><br><br><br>
    <div class = "labelWrapper"><label>Address: </label></div><textarea id = "textarea" pattern = ".{10,}" placeholder = "Address" name = "Saddress" required></textarea><br><br><br>
    <input type = "hidden" name = "opt" value = "s">
    <br><span class = "error_msg">
      <?php
      if (isset($username_err)){
        echo($username_err."<br>");
      }
      if (isset($email_err)){
        echo($email_err."<br>");
      }
      ?>
    </span>
    <button class = "submit" name = "submit" type = "submit">Sign Up</button>
  </form>
  <br><br>
  <form id = "logInForm" method = "post" action = "">
    <div class = "labelWrapper"><label>Name: </label></div><input type = "text" name = "Lusername" placeholder = "Name" pattern = ".{3,25}" required><br><br><br>
    <div class = "labelWrapper"><label>Password: </label></div><input type = "password" name = "Lpassword" placeholder = "Password" pattern = ".{5,}" required><br><br><br>
    <span class = "error_msg">
      <?php
      if (isset($LogInErr)){
        echo($LogInErr);
      }
      ?>
    </span>
    <input type = "hidden" name = "opt2" value = "l">
    <button class = "submit" type = "submit" name = "submit">Log In</button>
    <br>
  </form>
  <br><br>
</div>
<!--/BODY-->
</center>
<script>

function CngS(f){
  if (f == "s"){
    document.getElementById("signUpBtn").classList.add("signUpBtnC");
    document.getElementById("logInBtn").classList.remove("logInBtnC");
    document.getElementsByTagName("body")[0].style.backgroundImage = "radial-gradient(circle,#ccda46,#b0c026)";
    document.getElementsByTagName("body")[0].style.height = "auto";
    document.getElementById("logInForm").style.display = "none";
    document.getElementById("signUpForm").style.display = "block";
    document.getElementById("opt").value = "s";
  }
  else if (f == "l"){
    document.getElementById("logInBtn").classList.add("logInBtnC");
    document.getElementById("signUpBtn").classList.remove("signUpBtnC");
    document.getElementsByTagName("body")[0].style.backgroundImage = "radial-gradient(circle,#697c37,#3c471f)";
    document.getElementsByTagName("body")[0].style.height = "100vh";
    document.getElementById("logInForm").style.display = "block";
    document.getElementById("signUpForm").style.display = "none";
  }
}


  window.onscroll = function() {stickyNavbar(window.pageYOffset)};

// Get the navbar
var navbar = document.getElementById("navbar");
var sticky = navbar.offsetTop;

// Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
function stickyNavbar(y) {
  if (y >= sticky) {
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}
</script>
<?php
echo("<script>$function</script>");
?>
</body>
</html>