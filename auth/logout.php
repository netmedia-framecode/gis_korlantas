<?php if (!isset($_SESSION)) {
  session_start();
}
require_once("../controller/script.php");
if (isset($_SESSION["project_gis_korlantas"])) {
  unset($_SESSION["project_gis_korlantas"]);
  header("Location: ./");
  exit();
}
