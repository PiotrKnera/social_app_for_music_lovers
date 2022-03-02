<?php

$servername = "localhost";
$dbname = "spolecznosciowa_aplikacja_webowa";
$username = "Your_username";
$password = "Your_password";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn -> query ('SET NAMES utf8');
  $conn -> query ('SET CHARACTER_SET utf8_unicode_ci');
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo "<br><br>Connection failed: <br>" . $e->getMessage();
}

 ?>
