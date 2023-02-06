<?php
$servername = "localhost";
$username = "id12166574_ardodata";
$password = "ArdoData";
$database = "id12166574_ardodata";
$mysqli = new mysqli($servername, $username, $password, $database);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>


