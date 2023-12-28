<?php

if (!isset($_SESSION["project_gis_korlantas"]["users"])) {
  function alert($message, $message_type)
  {
    $_SESSION["project_gis_korlantas"] = [
      "message_$message_type" => $message,
      "time_message" => time()
    ];

    return true;
  }
}

if (isset($_SESSION["project_gis_korlantas"]["users"])) {
  function alert($message, $message_type)
  {
    global $conn;
    $id_user = valid($conn, $_SESSION["project_gis_korlantas"]["users"]["id"]);
    $id_role = valid($conn, $_SESSION["project_gis_korlantas"]["users"]["id_role"]);
    $role = valid($conn, $_SESSION["project_gis_korlantas"]["users"]["role"]);
    $email = valid($conn, $_SESSION["project_gis_korlantas"]["users"]["email"]);
    $name = valid($conn, $_SESSION["project_gis_korlantas"]["users"]["name"]);
    $image = valid($conn, $_SESSION["project_gis_korlantas"]["users"]["image"]);

    $_SESSION["project_gis_korlantas"]["users"] = [
      "id" => $id_user,
      "id_role" => $id_role,
      "role" => $role,
      "email" => $email,
      "name" => $name,
      "image" => $image,
      "message_$message_type" => $message,
      "time_message" => time()
    ];
  }
}
