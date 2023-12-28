<?php
$conn = mysqli_connect("localhost", "root", "", "gis_korlantas");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
