<?php
if (!isset($_SESSION["project_gis_korlantas"]["users"])) {
  header("Location: ../auth/");
  exit;
}
