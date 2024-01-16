<?php if (!isset($_SESSION[""])) {
  session_start();
}
error_reporting(~E_NOTICE & ~E_DEPRECATED);
require_once("db_connect.php");
require_once(__DIR__ . "/../models/sql.php");
require_once("functions.php");

$messageTypes = ["success", "info", "warning", "danger", "dark"];

$baseURL = "http://$_SERVER[HTTP_HOST]/apps/tugas/gis_korlantas/";
$name_website = "Digital Satlantas Kota Kupang";

$select_auth = "SELECT * FROM auth";
$views_auth = mysqli_query($conn, $select_auth);

$select_laka = "SELECT laka.*, informasi_khusus.informasi_khusus, kondisi_cahaya.kondisi_cahaya, cuaca.kondisi, tingkat_kecelakaan.tingkat_kecelakaan, kecelakaan_menonjol.kecelakaan_menonjol, fungsi_jalan.fungsi_jalan, kelas_jalan.kelas_jalan, tipe_jalan.tipe_jalan, permukaan_jalan.permukaan_jalan, kemiringan_jalan.kemiringan_jalan, status_jalan.status_jalan, polres.nama_polres, polres.alamat, polres.telepon, polres.email, polres.jumlah_anggota, titik_rawan.nama_jalan_rawan
FROM laka
JOIN informasi_khusus ON laka.id_informasi_khusus=informasi_khusus.id_informasi_khusus
JOIN kondisi_cahaya ON laka.id_kondisi_cahaya=kondisi_cahaya.id_kondisi_cahaya
JOIN cuaca ON laka.id_cuaca=cuaca.id_cuaca
JOIN tingkat_kecelakaan ON laka.id_tingkat_kecelakaan=tingkat_kecelakaan.id_tingkat_kecelakaan
JOIN kecelakaan_menonjol ON laka.id_kecelakaan_menonjol=kecelakaan_menonjol.id_kecelakaan_menonjol
JOIN fungsi_jalan ON laka.id_fungsi_jalan=fungsi_jalan.id_fungsi_jalan
JOIN kelas_jalan ON laka.id_kelas_jalan=kelas_jalan.id_kelas_jalan
JOIN tipe_jalan ON laka.id_tipe_jalan=tipe_jalan.id_tipe_jalan
JOIN permukaan_jalan ON laka.id_permukaan_jalan=permukaan_jalan.id_permukaan_jalan
JOIN kemiringan_jalan ON laka.id_kemiringan_jalan=kemiringan_jalan.id_kemiringan_jalan
JOIN status_jalan ON laka.id_status_jalan=status_jalan.id_status_jalan
JOIN polres ON laka.id_polres=polres.id_polres
JOIN titik_rawan ON laka.id_titik_rawan=titik_rawan.id_titik_rawan
";
$views_laka = mysqli_query($conn, $select_laka);
$select_polres = "SELECT * FROM polres JOIN laka ON polres.id_polres=laka.id_polres JOIN titik_rawan ON laka.id_titik_rawan=titik_rawan.id_titik_rawan GROUP BY polres.id_polres";
$views_polres = mysqli_query($conn, $select_polres);
$select_titik_rawan_maps_details = "SELECT titik_rawan.* FROM titik_rawan JOIN laka ON laka.id_titik_rawan=titik_rawan.id_titik_rawan";
$views_titik_rawan_maps_details = mysqli_query($conn, $select_titik_rawan_maps_details);
$select_titik_rawan_maps = "SELECT * FROM titik_rawan";
$views_titik_rawan_maps = mysqli_query($conn, $select_titik_rawan_maps);
$select_titik_rawan_overview = "SELECT titik_rawan.*, SUM(laka.jumlah_luka_ringan) AS total_jumlah_luka_ringan, SUM(laka.jumlah_luka_berat) AS total_jumlah_luka_berat, SUM(laka.jumlah_meninggal) AS total_jumlah_meninggal, COUNT(laka.id_laka) AS total_laka, polres.nama_polres
                                  FROM titik_rawan
                                  LEFT JOIN laka ON laka.id_titik_rawan = titik_rawan.id_titik_rawan
                                  LEFT JOIN polres ON laka.id_polres = polres.id_polres
                                  GROUP BY titik_rawan.id_titik_rawan";
$views_titik_rawan_overview = mysqli_query($conn, $select_titik_rawan_overview);
$select_titik_rawan = "SELECT * FROM titik_rawan";
$views_titik_rawan = mysqli_query($conn, $select_titik_rawan);
$select_tingkat_kecelakaan = "SELECT * FROM tingkat_kecelakaan";
$views_tingkat_kecelakaan = mysqli_query($conn, $select_tingkat_kecelakaan);
$select_pesan_kapolri = "SELECT * FROM pesan_kapolri";
$views_pesan_kapolri = mysqli_query($conn, $select_pesan_kapolri);
$select_sejarah = "SELECT * FROM sejarah";
$views_sejarah = mysqli_query($conn, $select_sejarah);
$select_visi_misi = "SELECT * FROM visi_misi";
$views_visi_misi = mysqli_query($conn, $select_visi_misi);

if (isset($_POST['pencarian_kecelakaan'])) {
  $nama_jalan = valid($conn, $_POST['keyword']);
  $_SESSION["project_gis_korlantas"]["place"] = $nama_jalan;
  header("Location: place");
  exit();
}

if (isset($_POST["kontak"])) {
  $validated_post = array_map(function ($value) use ($conn) {
    return valid($conn, $value);
  }, $_POST);
  if (kontak($conn, $validated_post, $action = 'insert') > 0) {
    $message = "Pesan anda berhasil terkirim.";
    $message_type = "success";
    alert($message, $message_type);
    header("Location: kontak");
    exit();
  }
}

if (!isset($_SESSION["project_gis_korlantas"]["users"])) {
  if (isset($_SESSION["project_gis_korlantas"]["time_message"]) && (time() - $_SESSION["project_gis_korlantas"]["time_message"]) > 2) {
    foreach ($messageTypes as $type) {
      if (isset($_SESSION["project_gis_korlantas"]["message_$type"])) {
        unset($_SESSION["project_gis_korlantas"]["message_$type"]);
      }
    }
    unset($_SESSION["project_gis_korlantas"]["time_message"]);
  }
  if (isset($_POST["register"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (register($conn, $validated_post, $action = 'insert') > 0) {
      header("Location: verification?en=" . $_SESSION['data_auth']['en_user']);
      exit();
    }
  }
  if (isset($_POST["re_verifikasi"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (re_verifikasi($conn, $validated_post, $action = 'update') > 0) {
      $message = "Kode token yang baru telah dikirim ke email anda.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: verification?en=" . $_SESSION['data_auth']['en_user']);
      exit();
    }
  }
  if (isset($_POST["verifikasi"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (verifikasi($conn, $validated_post, $action = 'update') > 0) {
      $message = "Akun anda berhasil di verifikasi.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: ./");
      exit();
    }
  }
  if (isset($_POST["forgot_password"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (forgot_password($conn, $validated_post, $action = 'update', $baseURL) > 0) {
      $message = "Kami telah mengirim link ke email anda untuk melakukan reset kata sandi.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: ./");
      exit();
    }
  }
  if (isset($_POST["new_password"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (new_password($conn, $validated_post, $action = 'update') > 0) {
      $message = "Kata sandi anda telah berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: ./");
      exit();
    }
  }
  if (isset($_POST["login"])) {
    if (login($conn, $_POST) > 0) {
      header("Location: ../views/");
      exit();
    }
  }
}

if (isset($_SESSION["project_gis_korlantas"]["users"])) {
  $id_user = valid($conn, $_SESSION["project_gis_korlantas"]["users"]["id"]);
  $id_role = valid($conn, $_SESSION["project_gis_korlantas"]["users"]["id_role"]);
  $role = valid($conn, $_SESSION["project_gis_korlantas"]["users"]["role"]);
  $email = valid($conn, $_SESSION["project_gis_korlantas"]["users"]["email"]);
  $name = valid($conn, $_SESSION["project_gis_korlantas"]["users"]["name"]);
  if (isset($_SESSION["project_gis_korlantas"]["users"]["time_message"]) && (time() - $_SESSION["project_gis_korlantas"]["users"]["time_message"]) > 2) {
    foreach ($messageTypes as $type) {
      if (isset($_SESSION["project_gis_korlantas"]["users"]["message_$type"])) {
        unset($_SESSION["project_gis_korlantas"]["users"]["message_$type"]);
      }
    }
    unset($_SESSION["project_gis_korlantas"]["users"]["time_message"]);
  }

  $count_polres = "SELECT * FROM polres";
  $count_polres = mysqli_query($conn, $count_polres);
  $counts_polres = mysqli_num_rows($count_polres);
  $count_laka = "SELECT * FROM laka";
  $count_laka = mysqli_query($conn, $count_laka);
  $counts_laka = mysqli_num_rows($count_laka);
  $count_titik_rawan = "SELECT * FROM titik_rawan";
  $count_titik_rawan = mysqli_query($conn, $count_titik_rawan);
  $counts_titik_rawan = mysqli_num_rows($count_titik_rawan);

  $select_profile = "SELECT users.*, user_role.role, user_status.status 
                      FROM users
                      JOIN user_role ON users.id_role=user_role.id_role 
                      JOIN user_status ON users.id_active=user_status.id_status 
                      WHERE users.id_user='$id_user'
                    ";
  $view_profile = mysqli_query($conn, $select_profile);
  if (isset($_POST["edit_profil"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (profil($conn, $validated_post, $action = 'update', $id_user) > 0) {
      $message = "Profil Anda berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: profil");
      exit();
    }
  }
  if (isset($_POST["setting"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (setting($conn, $validated_post, $action = 'update') > 0) {
      $message = "Setting pada system login berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: setting");
      exit();
    }
  }

  $select_users = "SELECT users.*, user_role.role, user_status.status 
                    FROM users
                    JOIN user_role ON users.id_role=user_role.id_role 
                    JOIN user_status ON users.id_active=user_status.id_status
                  ";
  $views_users = mysqli_query($conn, $select_users);
  $select_user_role = "SELECT * FROM user_role";
  $views_user_role = mysqli_query($conn, $select_user_role);
  if (isset($_POST["edit_users"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (users($conn, $validated_post, $action = 'update') > 0) {
      $message = "data users berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: users");
      exit();
    }
  }
  if (isset($_POST["add_role"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (role($conn, $validated_post, $action = 'insert') > 0) {
      $message = "Role baru berhasil ditambahkan.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: role");
      exit();
    }
  }
  if (isset($_POST["edit_role"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (role($conn, $validated_post, $action = 'update') > 0) {
      $message = "Role " . $_POST['roleOld'] . " berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: role");
      exit();
    }
  }
  if (isset($_POST["delete_role"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (role($conn, $validated_post, $action = 'delete') > 0) {
      $message = "Role " . $_POST['role'] . " berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: role");
      exit();
    }
  }

  $select_menu = "SELECT * 
                    FROM user_menu 
                    ORDER BY menu ASC
                  ";
  $views_menu = mysqli_query($conn, $select_menu);
  if (isset($_POST["add_menu"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (menu($conn, $validated_post, $action = 'insert') > 0) {
      $message = "Menu baru berhasil ditambahkan.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: menu");
      exit();
    }
  }
  if (isset($_POST["edit_menu"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (menu($conn, $validated_post, $action = 'update') > 0) {
      $message = "Menu " . $_POST['menuOld'] . " berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: menu");
      exit();
    }
  }
  if (isset($_POST["delete_menu"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (menu($conn, $validated_post, $action = 'delete') > 0) {
      $message = "Menu " . $_POST['menu'] . " berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: menu");
      exit();
    }
  }

  $select_sub_menu = "SELECT user_sub_menu.*, user_menu.menu, user_status.status 
                        FROM user_sub_menu 
                        JOIN user_menu ON user_sub_menu.id_menu=user_menu.id_menu 
                        JOIN user_status ON user_sub_menu.id_active=user_status.id_status 
                        ORDER BY user_sub_menu.title ASC
                      ";
  $views_sub_menu = mysqli_query($conn, $select_sub_menu);
  $select_user_status = "SELECT * 
                          FROM user_status
                        ";
  $views_user_status = mysqli_query($conn, $select_user_status);
  if (isset($_POST["add_sub_menu"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (sub_menu($conn, $validated_post, $action = 'insert', $baseURL) > 0) {
      $message = "Sub Menu baru berhasil ditambahkan.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: sub-menu");
      exit();
    }
  }
  if (isset($_POST["edit_sub_menu"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (sub_menu($conn, $validated_post, $action = 'update', $baseURL) > 0) {
      $message = "Sub Menu " . $_POST['titleOld'] . " berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: sub-menu");
      exit();
    }
  }
  if (isset($_POST["delete_sub_menu"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (sub_menu($conn, $validated_post, $action = 'delete', $baseURL) > 0) {
      $message = "Sub Menu " . $_POST['title'] . " berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: sub-menu");
      exit();
    }
  }

  $select_user_access_menu = "SELECT user_access_menu.*, user_role.role, user_menu.menu
                                FROM user_access_menu 
                                JOIN user_role ON user_access_menu.id_role=.user_role.id_role 
                                JOIN user_menu ON user_access_menu.id_menu=user_menu.id_menu
                              ";
  $views_user_access_menu = mysqli_query($conn, $select_user_access_menu);
  $select_menu_check = "SELECT user_menu.* 
                    FROM user_menu 
                    ORDER BY user_menu.menu ASC
                  ";
  $views_menu_check = mysqli_query($conn, $select_menu_check);
  if (isset($_POST["add_menu_access"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (menu_access($conn, $validated_post, $action = 'insert') > 0) {
      $message = "Akses ke menu berhasil ditambahkan.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: menu-access");
      exit();
    }
  }
  if (isset($_POST["edit_menu_access"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (menu_access($conn, $validated_post, $action = 'update') > 0) {
      $message = "Akses menu " . $_POST['menu'] . " berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: menu-access");
      exit();
    }
  }
  if (isset($_POST["delete_menu_access"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (menu_access($conn, $validated_post, $action = 'delete') > 0) {
      $message = "Akses menu " . $_POST['menu'] . " berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: menu-access");
      exit();
    }
  }

  $select_user_access_sub_menu = "SELECT user_access_sub_menu.*, user_role.role, user_sub_menu.title
                                    FROM user_access_sub_menu 
                                    JOIN user_role ON user_access_sub_menu.id_role=.user_role.id_role 
                                    JOIN user_sub_menu ON user_access_sub_menu.id_sub_menu=user_sub_menu.id_sub_menu
                                  ";
  $views_user_access_sub_menu = mysqli_query($conn, $select_user_access_sub_menu);
  $select_sub_menu_check = "SELECT user_sub_menu.*, user_menu.menu
                              FROM user_sub_menu 
                              JOIN user_menu ON user_sub_menu.id_menu=user_menu.id_menu
                              ORDER BY user_sub_menu.title ASC
                            ";
  $views_sub_menu_check = mysqli_query($conn, $select_sub_menu_check);
  if (isset($_POST["add_sub_menu_access"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (sub_menu_access($conn, $validated_post, $action = 'insert') > 0) {
      $message = "Akses ke sub menu berhasil ditambahkan.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: sub-menu-access");
      exit();
    }
  }
  if (isset($_POST["edit_sub_menu_access"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (sub_menu_access($conn, $validated_post, $action = 'update') > 0) {
      $message = "Akses sub menu " . $_POST['title'] . " berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: sub-menu-access");
      exit();
    }
  }
  if (isset($_POST["delete_sub_menu_access"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (sub_menu_access($conn, $validated_post, $action = 'delete') > 0) {
      $message = "Akses sub menu " . $_POST['title'] . " berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: sub-menu-access");
      exit();
    }
  }

  $select_informasi_khusus = "SELECT * FROM informasi_khusus";
  $views_informasi_khusus = mysqli_query($conn, $select_informasi_khusus);
  if (isset($_POST["add_informasi_khusus"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (informasi_khusus($conn, $validated_post, $action = 'insert') > 0) {
      $message = "Data informasi khusus berhasil ditambahkan.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: informasi-khusus");
      exit();
    }
  }
  if (isset($_POST["edit_informasi_khusus"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (informasi_khusus($conn, $validated_post, $action = 'update') > 0) {
      $message = "Data informasi khusus yang anda pilih berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: informasi-khusus");
      exit();
    }
  }
  if (isset($_POST["delete_informasi_khusus"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (informasi_khusus($conn, $validated_post, $action = 'delete') > 0) {
      $message = "Data informasi khusus yang anda pilih berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: informasi-khusus");
      exit();
    }
  }

  $select_cuaca = "SELECT * FROM cuaca";
  $views_cuaca = mysqli_query($conn, $select_cuaca);
  if (isset($_POST["add_cuaca"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (cuaca($conn, $validated_post, $action = 'insert') > 0) {
      $message = "Data kondisi cuaca berhasil ditambahkan.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: cuaca");
      exit();
    }
  }
  if (isset($_POST["edit_cuaca"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (cuaca($conn, $validated_post, $action = 'update') > 0) {
      $message = "Data kondisi cuaca yang anda pilih berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: cuaca");
      exit();
    }
  }
  if (isset($_POST["delete_cuaca"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (cuaca($conn, $validated_post, $action = 'delete') > 0) {
      $message = "Data kondisi cuaca yang anda pilih berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: cuaca");
      exit();
    }
  }

  if (isset($_POST["add_tingkat_kecelakaan"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (tingkat_kecelakaan($conn, $validated_post, $action = 'insert') > 0) {
      $message = "Data tingkat kecelakaan berhasil ditambahkan.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: tingkat-kecelakaan");
      exit();
    }
  }
  if (isset($_POST["edit_tingkat_kecelakaan"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (tingkat_kecelakaan($conn, $validated_post, $action = 'update') > 0) {
      $message = "Data tingkat kecelakaan yang anda pilih berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: tingkat-kecelakaan");
      exit();
    }
  }
  if (isset($_POST["delete_tingkat_kecelakaan"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (tingkat_kecelakaan($conn, $validated_post, $action = 'delete') > 0) {
      $message = "Data tingkat kecelakaan yang anda pilih berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: tingkat-kecelakaan");
      exit();
    }
  }

  $select_kecelakaan_menonjol = "SELECT * FROM kecelakaan_menonjol";
  $views_kecelakaan_menonjol = mysqli_query($conn, $select_kecelakaan_menonjol);
  if (isset($_POST["add_kecelakaan_menonjol"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (kecelakaan_menonjol($conn, $validated_post, $action = 'insert') > 0) {
      $message = "Data kecelakaan menonjol berhasil ditambahkan.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: kecelakaan-menonjol");
      exit();
    }
  }
  if (isset($_POST["edit_kecelakaan_menonjol"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (kecelakaan_menonjol($conn, $validated_post, $action = 'update') > 0) {
      $message = "Data kecelakaan menonjol yang anda pilih berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: kecelakaan-menonjol");
      exit();
    }
  }
  if (isset($_POST["delete_kecelakaan_menonjol"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (kecelakaan_menonjol($conn, $validated_post, $action = 'delete') > 0) {
      $message = "Data kecelakaan menonjol yang anda pilih berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: kecelakaan-menonjol");
      exit();
    }
  }

  $select_fungsi_jalan = "SELECT * FROM fungsi_jalan";
  $views_fungsi_jalan = mysqli_query($conn, $select_fungsi_jalan);
  if (isset($_POST["add_fungsi_jalan"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (fungsi_jalan($conn, $validated_post, $action = 'insert') > 0) {
      $message = "Data fungsi jalan berhasil ditambahkan.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: fungsi-jalan");
      exit();
    }
  }
  if (isset($_POST["edit_fungsi_jalan"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (fungsi_jalan($conn, $validated_post, $action = 'update') > 0) {
      $message = "Data fungsi jalan yang anda pilih berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: fungsi-jalan");
      exit();
    }
  }
  if (isset($_POST["delete_fungsi_jalan"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (fungsi_jalan($conn, $validated_post, $action = 'delete') > 0) {
      $message = "Data fungsi jalan yang anda pilih berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: fungsi-jalan");
      exit();
    }
  }

  $select_kelas_jalan = "SELECT * FROM kelas_jalan";
  $views_kelas_jalan = mysqli_query($conn, $select_kelas_jalan);
  if (isset($_POST["add_kelas_jalan"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (kelas_jalan($conn, $validated_post, $action = 'insert') > 0) {
      $message = "Data kelas jalan berhasil ditambahkan.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: kelas-jalan");
      exit();
    }
  }
  if (isset($_POST["edit_kelas_jalan"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (kelas_jalan($conn, $validated_post, $action = 'update') > 0) {
      $message = "Data kelas jalan yang anda pilih berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: kelas-jalan");
      exit();
    }
  }
  if (isset($_POST["delete_kelas_jalan"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (kelas_jalan($conn, $validated_post, $action = 'delete') > 0) {
      $message = "Data kelas jalan yang anda pilih berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: kelas-jalan");
      exit();
    }
  }

  $select_tipe_jalan = "SELECT * FROM tipe_jalan";
  $views_tipe_jalan = mysqli_query($conn, $select_tipe_jalan);
  if (isset($_POST["add_tipe_jalan"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (tipe_jalan($conn, $validated_post, $action = 'insert') > 0) {
      $message = "Data tipe jalan berhasil ditambahkan.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: tipe-jalan");
      exit();
    }
  }
  if (isset($_POST["edit_tipe_jalan"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (tipe_jalan($conn, $validated_post, $action = 'update') > 0) {
      $message = "Data tipe jalan yang anda pilih berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: tipe-jalan");
      exit();
    }
  }
  if (isset($_POST["delete_tipe_jalan"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (tipe_jalan($conn, $validated_post, $action = 'delete') > 0) {
      $message = "Data tipe jalan yang anda pilih berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: tipe-jalan");
      exit();
    }
  }

  $select_permukaan_jalan = "SELECT * FROM permukaan_jalan";
  $views_permukaan_jalan = mysqli_query($conn, $select_permukaan_jalan);
  if (isset($_POST["add_permukaan_jalan"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (permukaan_jalan($conn, $validated_post, $action = 'insert') > 0) {
      $message = "Data permukaan jalan berhasil ditambahkan.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: permukaan-jalan");
      exit();
    }
  }
  if (isset($_POST["edit_permukaan_jalan"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (permukaan_jalan($conn, $validated_post, $action = 'update') > 0) {
      $message = "Data permukaan jalan yang anda pilih berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: permukaan-jalan");
      exit();
    }
  }
  if (isset($_POST["delete_permukaan_jalan"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (permukaan_jalan($conn, $validated_post, $action = 'delete') > 0) {
      $message = "Data permukaan jalan yang anda pilih berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: permukaan-jalan");
      exit();
    }
  }

  $select_kemiringan_jalan = "SELECT * FROM kemiringan_jalan";
  $views_kemiringan_jalan = mysqli_query($conn, $select_kemiringan_jalan);
  if (isset($_POST["add_kemiringan_jalan"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (kemiringan_jalan($conn, $validated_post, $action = 'insert') > 0) {
      $message = "Data kemiringan jalan berhasil ditambahkan.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: kemiringan-jalan");
      exit();
    }
  }
  if (isset($_POST["edit_kemiringan_jalan"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (kemiringan_jalan($conn, $validated_post, $action = 'update') > 0) {
      $message = "Data kemiringan jalan yang anda pilih berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: kemiringan-jalan");
      exit();
    }
  }
  if (isset($_POST["delete_kemiringan_jalan"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (kemiringan_jalan($conn, $validated_post, $action = 'delete') > 0) {
      $message = "Data kemiringan jalan yang anda pilih berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: kemiringan-jalan");
      exit();
    }
  }

  $select_status_jalan = "SELECT * FROM status_jalan";
  $views_status_jalan = mysqli_query($conn, $select_status_jalan);
  if (isset($_POST["add_status_jalan"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (status_jalan($conn, $validated_post, $action = 'insert') > 0) {
      $message = "Data status jalan berhasil ditambahkan.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: status-jalan");
      exit();
    }
  }
  if (isset($_POST["edit_status_jalan"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (status_jalan($conn, $validated_post, $action = 'update') > 0) {
      $message = "Data status jalan yang anda pilih berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: status-jalan");
      exit();
    }
  }
  if (isset($_POST["delete_status_jalan"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (status_jalan($conn, $validated_post, $action = 'delete') > 0) {
      $message = "Data status jalan yang anda pilih berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: status-jalan");
      exit();
    }
  }

  if (isset($_POST["add_polres"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (polres($conn, $validated_post, $action = 'insert') > 0) {
      $message = "Data polres berhasil ditambahkan.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: polres");
      exit();
    }
  }
  if (isset($_POST["edit_polres"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (polres($conn, $validated_post, $action = 'update') > 0) {
      $message = "Data polres yang anda pilih berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: polres");
      exit();
    }
  }
  if (isset($_POST["delete_polres"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (polres($conn, $validated_post, $action = 'delete') > 0) {
      $message = "Data polres yang anda pilih berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: polres");
      exit();
    }
  }

  $select_kondisi_cahaya = "SELECT * FROM kondisi_cahaya";
  $views_kondisi_cahaya = mysqli_query($conn, $select_kondisi_cahaya);
  if (isset($_POST["add_kondisi_cahaya"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (kondisi_cahaya($conn, $validated_post, $action = 'insert') > 0) {
      $message = "Data kondisi cahaya berhasil ditambahkan.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: kondisi-cahaya");
      exit();
    }
  }
  if (isset($_POST["edit_kondisi_cahaya"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (kondisi_cahaya($conn, $validated_post, $action = 'update') > 0) {
      $message = "Data kondisi cahaya yang anda pilih berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: kondisi-cahaya");
      exit();
    }
  }
  if (isset($_POST["delete_kondisi_cahaya"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (kondisi_cahaya($conn, $validated_post, $action = 'delete') > 0) {
      $message = "Data kondisi cahaya yang anda pilih berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: kondisi-cahaya");
      exit();
    }
  }

  if (isset($_POST["add_laka"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (laka($conn, $validated_post, $action = 'insert') > 0) {
      $message = "Data kecelakaan berhasil ditambahkan.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: pemetaan");
      exit();
    }
  }
  if (isset($_POST["ubah_pemetaan"])) {
    $id_laka = valid($conn, $_POST['id_laka']);
    $_SESSION["project_gis_korlantas"]["id_pemetaan"] = $id_laka;
    header("Location: ubah-pemetaan");
    exit();
  }
  if (isset($_POST["edit_laka"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (laka($conn, $validated_post, $action = 'update') > 0) {
      $message = "Data kecelakaan yang anda pilih berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: data-pemetaan");
      exit();
    }
  }
  if (isset($_POST["delete_laka"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (laka($conn, $validated_post, $action = 'delete') > 0) {
      $message = "Data kecelakaan yang anda pilih berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: data-pemetaan");
      exit();
    }
  }

  if (isset($_POST["add_titik_rawan"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (titik_rawan($conn, $validated_post, $action = 'insert') > 0) {
      $message = "Data titik rawan kecelakaan berhasil ditambahkan.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: titik-rawan");
      exit();
    }
  }
  if (isset($_POST["edit_titik_rawan"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (titik_rawan($conn, $validated_post, $action = 'update') > 0) {
      $message = "Data titik rawan kecelakaan yang anda masukan berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: titik-rawan");
      exit();
    }
  }
  if (isset($_POST["delete_titik_rawan"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (titik_rawan($conn, $validated_post, $action = 'delete') > 0) {
      $message = "Data titik rawan kecelakaan yang anda masukan berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: titik-rawan");
      exit();
    }
  }

  if (isset($_POST["edit_pesan_kapolri"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (pesan_kapolri($conn, $validated_post, $action = 'update', $deskripsi = $_POST['deskripsi']) > 0) {
      $message = "Data pesan kapolri yang anda masukan berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: pesan-kapolri");
      exit();
    }
  }

  if (isset($_POST["edit_sejarah"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (sejarah($conn, $validated_post, $action = 'update', $deskripsi = $_POST['deskripsi']) > 0) {
      $message = "Data sejarah yang anda masukan berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: sejarah");
      exit();
    }
  }

  if (isset($_POST["edit_visi_misi"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (visi_misi($conn, $validated_post, $action = 'update', $deskripsi = $_POST['deskripsi']) > 0) {
      $message = "Data visi misi yang anda masukan berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: visi-misi");
      exit();
    }
  }

  $select_kontak = "SELECT * FROM kontak";
  $views_kontak = mysqli_query($conn, $select_kontak);
}
