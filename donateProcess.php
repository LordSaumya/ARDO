<?php
session_start();
require_once "config.php";
if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_FILES['photoUL']) && isset($_SESSION['username'])){
    $reply_to_email = "saumyashah717@gmail.com";
    $subject        = "Ardo Donation Notification";
    date_default_timezone_set('Asia/Kolkata');
    $to = 'saumyashah717@gmail.com';
    $headers = "From:ardoDonations@gmail.com\r\n";
    $headers .= "Reply-To:saumyashah717@gmail.com\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    $imgTmp = $_FILES["photoUL"]["tmp_name"];
    $imgContent = addslashes(file_get_contents($imgTmp));
    $username = $mysqli-> real_escape_string(strip_tags(stripslashes($_SESSION["username"])));
    $email = $mysqli->real_escape_string(strip_tags(stripslashes($_SESSION["email"])));
    $type = $mysqli->real_escape_string(strip_tags(stripslashes($_POST["materialType"])));
    $qty = $mysqli->real_escape_string(strip_tags(stripslashes($_POST["qty"])));
    $size = $mysqli->real_escape_string(strip_tags(stripslashes($_POST["size"]." ".$_POST["unit"])));
    $colour = $mysqli->real_escape_string(strip_tags(stripslashes($_POST["colour"])));
    $otherDetails = $mysqli->real_escape_string(strip_tags(stripslashes($_POST["otherDetails"])));
    $siteLocation = $mysqli->real_escape_string(strip_tags(stripslashes($_POST["siteLocation"])));
    $datetime = date("d-m-y H:i:s");
    
    $sql = "SELECT ID FROM Donations ORDER BY ID DESC LIMIT 1";
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
    $LastId = $row['ID']+1;
    $sql = "INSERT INTO Donations (ID, Username, Type, Quantity, Size, Colour, OtherDetails,
    SiteLocation, Image, DateTime) VALUES ('$LastId','$username','$type','$qty','$size','$colour',
    '$otherDetails','$siteLocation','$imgContent','$datetime')";
    if($mysqli->query($sql)){
      $sql = "SELECT Image FROM Donations WHERE ID = '$LastId'";
      $result = $mysqli->query($sql);
      $imgData = $result->fetch_assoc();
      $image = $imgData["Image"];
      echo("<script>alert('Donation submitted!')</script>");
    $message = '<html><body><br><h1>Details of the Donation:</h1><br>';
    $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
    $message .= "<tr style='background: #eee;'><td><b>Name of Donor:</b> </td><td>" . $username . "</td></tr>";
    $message .= "<tr><td><b>Email of Donor:</b> </td><td>" . $email . "</td></tr>";
    $message .= "<tr><td><b>Type of material:</b> </td><td>" . $type . "</td></tr>";
    $message .= "<tr><td><b>Quantity:</b> </td><td>" . $qty . "</td></tr>";
    $message .= "<tr><td><b>Size</b> </td><td>" . $size ."</td></tr>";
    $message .= "<tr><td><b>Colour:</b> </td><td> <span style = 'color:black;
    display:inline-block;width:100%;height:100%;background-color:".$colour.";'>".
    $colour."</span></td></tr>";
    $message .= "<tr><td><b>Other Details:</b> </td><td>" . $otherDetails . "</td></tr>";
    $message .= "<tr><td><b>Site Location:</b> </td><td>" . $siteLocation . "</td></tr>";
    $message .= "</table><br><br>";
    $message .= "<br><br><br><br><b>Timestamp: </b>".$datetime;
    $message .= "<img src = '".$image."'>";
    $message .= "</body></html>";
    mail($to, $subject, $message, $headers);
    echo('<html><body><script type="text/javascript">window.location=\''."https://ardo1.000webhostapp.com/donate.php".
    '\';</script></body></html>');
    }else{echo("<script>alert('Error in donation. Please try again later!')</script>");}}else{
  echo($_SERVER['REQUEST_METHOD']."\n".isset($_FILES['photoUL']).isset($_SESSION['username']));}?>