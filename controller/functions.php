<?php
function valid($conn, $value)
{
  $valid = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $value))));
  return $valid;
}

function separateAlphaNumeric($string)
{
  $alpha = "";
  $numeric = "";
  // Mengiterasi setiap karakter dalam string
  for ($i = 0; $i < strlen($string); $i++) {
    // Memeriksa apakah karakter adalah huruf
    if (ctype_alpha($string[$i])) {
      $alpha .= $string[$i];
    }
    // Memeriksa apakah karakter adalah angka
    if (ctype_digit($string[$i])) {
      $numeric .= $string[$i];
    }
  }
  // Mengembalikan array yang berisi huruf dan angka terpisah
  return array(
    "alpha" => $alpha,
    "numeric" => $numeric
  );
}

function generateToken()
{
  // Generate a random 6-digit number
  $token = mt_rand(100000, 999999);
  return $token;
}

function compressImage($source, $destination, $quality)
{
  // mendapatkan info image
  $imgInfo = getimagesize($source);
  $mime = $imgInfo['mime'];
  // membuat image baru
  switch ($mime) {
      // proses kode memilih tipe tipe image 
    case 'image/jpeg':
      $image = imagecreatefromjpeg($source);
      break;
    case 'image/png':
      $image = imagecreatefrompng($source);
      break;
    default:
      $image = imagecreatefromjpeg($source);
  }

  // Menyimpan image dengan ukuran yang baru
  imagejpeg($image, $destination, $quality);

  // Return image
  return $destination;
}

if (!isset($_SESSION["project_gis_korlantas"]["users"])) {
  function register($conn, $data, $action)
  {
    if ($action == "insert") {
      $checkEmail = "SELECT * FROM users WHERE email='$data[email]'";
      $checkEmail = mysqli_query($conn, $checkEmail);
      if (mysqli_num_rows($checkEmail) > 0) {
        $message = "Maaf, email yang anda masukan sudah terdaftar.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      } else {
        if ($data['password'] !== $data['re_password']) {
          $message = "Maaf, konfirmasi password yang anda masukan belum sama.";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        } else {
          $password = password_hash($data['password'], PASSWORD_DEFAULT);
          $token = generateToken();
          $en_user = password_hash($token, PASSWORD_DEFAULT);
          $en_user = str_replace("$", "", $en_user);
          $en_user = str_replace("/", "", $en_user);
          $en_user = str_replace(".", "", $en_user);
          require_once("mail.php");
          $to       = $data['email'];
          $subject  = "Account Verification - GIS Korlantas";
          $message  = "<!doctype html>
          <html>
            <head>
                <meta name='viewport' content='width=device-width'>
                <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
                <title>Account Verification</title>
                <style>
                    @media only screen and (max-width: 620px) {
                        table[class='body'] h1 {
                            font-size: 28px !important;
                            margin-bottom: 10px !important;}
                        table[class='body'] p,
                        table[class='body'] ul,
                        table[class='body'] ol,
                        table[class='body'] td,
                        table[class='body'] span,
                        table[class='body'] a {
                            font-size: 16px !important;}
                        table[class='body'] .wrapper,
                        table[class='body'] .article {
                            padding: 10px !important;}
                        table[class='body'] .content {
                            padding: 0 !important;}
                        table[class='body'] .container {
                            padding: 0 !important;
                            width: 100% !important;}
                        table[class='body'] .main {
                            border-left-width: 0 !important;
                            border-radius: 0 !important;
                            border-right-width: 0 !important;}
                        table[class='body'] .btn table {
                            width: 100% !important;}
                        table[class='body'] .btn a {
                            width: 100% !important;}
                        table[class='body'] .img-responsive {
                            height: auto !important;
                            max-width: 100% !important;
                            width: auto !important;}}
                    @media all {
                        .ExternalClass {
                            width: 100%;}
                        .ExternalClass,
                        .ExternalClass p,
                        .ExternalClass span,
                        .ExternalClass font,
                        .ExternalClass td,
                        .ExternalClass div {
                            line-height: 100%;}
                        .apple-link a {
                            color: inherit !important;
                            font-family: inherit !important;
                            font-size: inherit !important;
                            font-weight: inherit !important;
                            line-height: inherit !important;
                            text-decoration: none !important;
                        .btn-primary table td:hover {
                            background-color: #d5075d !important;}
                        .btn-primary a:hover {
                            background-color: #000 !important;
                            border-color: #000 !important;
                            color: #fff !important;}}
                </style>
            </head>
            <body class style='background-color: #e1e3e5; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;'>
                <table role='presentation' border='0' cellpadding='0' cellspacing='0' class='body' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; background-color: #e1e3e5; width: 100%;' width='100%' bgcolor='#e1e3e5'>
                <tr>
                    <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>&nbsp;</td>
                    <td class='container' style='font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto;' width='580' valign='top'>
                    <div class='content' style='box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;'>
            
                        <!-- START CENTERED WHITE CONTAINER -->
                        <table role='presentation' class='main' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; background: #ffffff; border-radius: 3px; width: 100%;' width='100%'>
            
                        <!-- START MAIN CONTENT AREA -->
                        <tr>
                            <td class='wrapper' style='font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;' valign='top'>
                            <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; width: 100%;' width='100%'>
                                <tr>
                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>
                                    <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Hi " . $data['name'] . ",</p>
                                    <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Selamat akun kamu sudah terdaftar, tinggal satu langkah lagi kamu sudah bisa menggunakan akun. Silakan salin kode token dibawah ini untuk memverifikasi akun kamu.</p>
                                    <table role='presentation' border='0' cellpadding='0' cellspacing='0' class='btn btn-primary' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; box-sizing: border-box; min-width: 100%; width: 100%;' width='100%'>
                                    <tbody>
                                        <tr>
                                        <td align='left' style='font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;' valign='top'>
                                            <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: auto; width: auto;'>
                                            <tbody>
                                                <tr>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: center; font-weight: bold;' valign='top' bgcolor='#ffffff' align='center'>" . $token . "</td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </td>
                                        </tr>
                                    </tbody>
                                    </table>
                                    <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Terima kasih telah mendaftar di GIS Korlantas.</p>
                                    <small>Peringatan! Ini adalah pesan otomatis sehingga Anda tidak dapat membalas pesan ini.</small>
                                </td>
                                </tr>
                            </table>
                            </td>
                        </tr>
            
                        <!-- END MAIN CONTENT AREA -->
                        </table>
                        
                        <!-- START FOOTER -->
                        <div class='footer' style='clear: both; margin-top: 10px; text-align: center; width: 100%;'>
                        <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; width: 100%;' width='100%'>
                            <tr>
                            <td class='content-block' style='font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #9a9ea6; font-size: 12px; text-align: center;' valign='top' align='center'>
                                <span class='apple-link' style='color: #9a9ea6; font-size: 12px; text-align: center;'>Workarea Jln. S. K. Lerik, Kota Baru, Kupang, NTT, Indonesia. (0380) 8438423</span>
                            </td>
                            </tr>
                            <tr>
                            <td class='content-block powered-by' style='font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #9a9ea6; font-size: 12px; text-align: center;' valign='top' align='center'>
                                Powered by <a href='https://www.netmedia-framecode.com' style='color: #9a9ea6; font-size: 12px; text-align: center; text-decoration: none;'>Netmedia Framecode</a>.
                            </td>
                            </tr>
                        </table>
                        </div>
                        <!-- END FOOTER -->
            
                    <!-- END CENTERED WHITE CONTAINER -->
                    </div>
                    </td>
                    <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>&nbsp;</td>
                </tr>
                </table>
            </body>
          </html>";
          smtp_mail($to, $subject, $message, "", "", 0, 0, true);
          $_SESSION['data_auth'] = ['en_user' => $en_user];
          $sql = "INSERT INTO users(en_user,token,name,email,password) VALUES('$en_user','$token','$data[name]','$data[email]','$password')";
        }
      }
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function re_verifikasi($conn, $data, $action)
  {
    if ($action == "update") {
      $checkEN = "SELECT * FROM users WHERE en_user='$data[en_user]'";
      $checkEN = mysqli_query($conn, $checkEN);
      if (mysqli_num_rows($checkEN) == 0) {
        $message = "Maaf, sepertinya ada kesalahan saat mendaftar.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      } else if (mysqli_num_rows($checkEN) > 0) {
        $row = mysqli_fetch_assoc($checkEN);
        $name = $row['name'];
        $email = $row['email'];
        $token = generateToken();
        $reen_user = password_hash($token, PASSWORD_DEFAULT);
        $reen_user = str_replace("$", "", $reen_user);
        $reen_user = str_replace("/", "", $reen_user);
        $reen_user = str_replace(".", "", $reen_user);
        require_once("mail.php");
        $to       = $email;
        $subject  = "Account Verification - GIS Korlantas";
        $message  = "<!doctype html>
        <html>
          <head>
              <meta name='viewport' content='width=device-width'>
              <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
              <title>Account Verification</title>
              <style>
                  @media only screen and (max-width: 620px) {
                      table[class='body'] h1 {
                          font-size: 28px !important;
                          margin-bottom: 10px !important;}
                      table[class='body'] p,
                      table[class='body'] ul,
                      table[class='body'] ol,
                      table[class='body'] td,
                      table[class='body'] span,
                      table[class='body'] a {
                          font-size: 16px !important;}
                      table[class='body'] .wrapper,
                      table[class='body'] .article {
                          padding: 10px !important;}
                      table[class='body'] .content {
                          padding: 0 !important;}
                      table[class='body'] .container {
                          padding: 0 !important;
                          width: 100% !important;}
                      table[class='body'] .main {
                          border-left-width: 0 !important;
                          border-radius: 0 !important;
                          border-right-width: 0 !important;}
                      table[class='body'] .btn table {
                          width: 100% !important;}
                      table[class='body'] .btn a {
                          width: 100% !important;}
                      table[class='body'] .img-responsive {
                          height: auto !important;
                          max-width: 100% !important;
                          width: auto !important;}}
                  @media all {
                      .ExternalClass {
                          width: 100%;}
                      .ExternalClass,
                      .ExternalClass p,
                      .ExternalClass span,
                      .ExternalClass font,
                      .ExternalClass td,
                      .ExternalClass div {
                          line-height: 100%;}
                      .apple-link a {
                          color: inherit !important;
                          font-family: inherit !important;
                          font-size: inherit !important;
                          font-weight: inherit !important;
                          line-height: inherit !important;
                          text-decoration: none !important;
                      .btn-primary table td:hover {
                          background-color: #d5075d !important;}
                      .btn-primary a:hover {
                          background-color: #000 !important;
                          border-color: #000 !important;
                          color: #fff !important;}}
              </style>
          </head>
          <body class style='background-color: #e1e3e5; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;'>
              <table role='presentation' border='0' cellpadding='0' cellspacing='0' class='body' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; background-color: #e1e3e5; width: 100%;' width='100%' bgcolor='#e1e3e5'>
              <tr>
                  <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>&nbsp;</td>
                  <td class='container' style='font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto;' width='580' valign='top'>
                  <div class='content' style='box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;'>
          
                      <!-- START CENTERED WHITE CONTAINER -->
                      <table role='presentation' class='main' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; background: #ffffff; border-radius: 3px; width: 100%;' width='100%'>
          
                      <!-- START MAIN CONTENT AREA -->
                      <tr>
                          <td class='wrapper' style='font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;' valign='top'>
                          <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; width: 100%;' width='100%'>
                              <tr>
                              <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>
                                  <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Hi " . $name . ",</p>
                                  <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Selamat akun kamu sudah terdaftar, tinggal satu langkah lagi kamu sudah bisa menggunakan akun. Silakan salin kode token dibawah ini untuk memverifikasi akun kamu.</p>
                                  <table role='presentation' border='0' cellpadding='0' cellspacing='0' class='btn btn-primary' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; box-sizing: border-box; min-width: 100%; width: 100%;' width='100%'>
                                  <tbody>
                                      <tr>
                                      <td align='left' style='font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;' valign='top'>
                                          <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: auto; width: auto;'>
                                          <tbody>
                                              <tr>
                                              <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: center; font-weight: bold;' valign='top' bgcolor='#ffffff' align='center'>" . $token . "</td>
                                              </tr>
                                          </tbody>
                                          </table>
                                      </td>
                                      </tr>
                                  </tbody>
                                  </table>
                                  <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Terima kasih telah mendaftar di GIS Korlantas.</p>
                                  <small>Peringatan! Ini adalah pesan otomatis sehingga Anda tidak dapat membalas pesan ini.</small>
                              </td>
                              </tr>
                          </table>
                          </td>
                      </tr>
          
                      <!-- END MAIN CONTENT AREA -->
                      </table>
                      
                      <!-- START FOOTER -->
                      <div class='footer' style='clear: both; margin-top: 10px; text-align: center; width: 100%;'>
                      <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; width: 100%;' width='100%'>
                          <tr>
                          <td class='content-block' style='font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #9a9ea6; font-size: 12px; text-align: center;' valign='top' align='center'>
                              <span class='apple-link' style='color: #9a9ea6; font-size: 12px; text-align: center;'>Workarea Jln. S. K. Lerik, Kota Baru, Kupang, NTT, Indonesia. (0380) 8438423</span>
                          </td>
                          </tr>
                          <tr>
                          <td class='content-block powered-by' style='font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #9a9ea6; font-size: 12px; text-align: center;' valign='top' align='center'>
                              Powered by <a href='https://www.netmedia-framecode.com' style='color: #9a9ea6; font-size: 12px; text-align: center; text-decoration: none;'>Netmedia Framecode</a>.
                          </td>
                          </tr>
                      </table>
                      </div>
                      <!-- END FOOTER -->
          
                  <!-- END CENTERED WHITE CONTAINER -->
                  </div>
                  </td>
                  <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>&nbsp;</td>
              </tr>
              </table>
          </body>
        </html>";
        smtp_mail($to, $subject, $message, "", "", 0, 0, true);
        $_SESSION['data_auth'] = ['en_user' => $reen_user];
        $sql = "UPDATE users SET en_user='$reen_user', token='$token', updated_at=current_timestamp WHERE en_user='$data[en_user]'";
      }
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function verifikasi($conn, $data, $action)
  {
    if ($action == "update") {
      $checkEN = "SELECT * FROM users WHERE en_user='$data[en_user]'";
      $checkEN = mysqli_query($conn, $checkEN);
      if (mysqli_num_rows($checkEN) == 0) {
        $message = "Maaf, sepertinya ada kesalahan saat mendaftar.";
        $message_type = "warning";
        alert($message, $message_type);
        return false;
      } else if (mysqli_num_rows($checkEN) > 0) {
        $row = mysqli_fetch_assoc($checkEN);
        $token_primary = $row['token'];
        $updated_at = strtotime($row['updated_at']);
        $current_time = time();
        if (($current_time - $updated_at) > (5 * 60)) {
          $message = "Maaf, waktu untuk verifikasi telah habis.";
          $message_type = "warning";
          alert($message, $message_type);
          $_SESSION["project_gis_korlantas"] = [
            "message-warning" => "Maaf, waktu untuk verifikasi telah habis.",
            "time-message" => time()
          ];
          return false;
        }
        if ($data['token'] !== $token_primary) {
          $message = "Maaf, kode token yang anda masukan masih salah.";
          $message_type = "warning";
          alert($message, $message_type);
          return false;
        }
        $sql = "UPDATE users SET id_active='1', updated_at=current_timestamp WHERE en_user='$data[en_user]'";
      }
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function forgot_password($conn, $data, $action, $baseURL)
  {
    if ($action == "update") {
      $checkEmail = "SELECT * FROM users WHERE email='$data[email]'";
      $checkEmail = mysqli_query($conn, $checkEmail);
      if (mysqli_num_rows($checkEmail) === 0) {
        $message = "Maaf, email yang anda masukan belum terdaftar.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      } else {
        $row = mysqli_fetch_assoc($checkEmail);
        $name = valid($conn, $row['name']);
        $token = generateToken();
        $en_user = password_hash($token, PASSWORD_DEFAULT);
        $en_user = str_replace("$", "", $en_user);
        $en_user = str_replace("/", "", $en_user);
        $en_user = str_replace(".", "", $en_user);
        require_once("mail.php");
        $to       = $data['email'];
        $subject  = "Reset password - GIS Korlantas";
        $message  = "<!doctype html>
        <html>
          <head>
              <meta name='viewport' content='width=device-width'>
              <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
              <title>Reset password</title>
              <style>
                  @media only screen and (max-width: 620px) {
                      table[class='body'] h1 {
                          font-size: 28px !important;
                          margin-bottom: 10px !important;}
                      table[class='body'] p,
                      table[class='body'] ul,
                      table[class='body'] ol,
                      table[class='body'] td,
                      table[class='body'] span,
                      table[class='body'] a {
                          font-size: 16px !important;}
                      table[class='body'] .wrapper,
                      table[class='body'] .article {
                          padding: 10px !important;}
                      table[class='body'] .content {
                          padding: 0 !important;}
                      table[class='body'] .container {
                          padding: 0 !important;
                          width: 100% !important;}
                      table[class='body'] .main {
                          border-left-width: 0 !important;
                          border-radius: 0 !important;
                          border-right-width: 0 !important;}
                      table[class='body'] .btn table {
                          width: 100% !important;}
                      table[class='body'] .btn a {
                          width: 100% !important;}
                      table[class='body'] .img-responsive {
                          height: auto !important;
                          max-width: 100% !important;
                          width: auto !important;}}
                  @media all {
                      .ExternalClass {
                          width: 100%;}
                      .ExternalClass,
                      .ExternalClass p,
                      .ExternalClass span,
                      .ExternalClass font,
                      .ExternalClass td,
                      .ExternalClass div {
                          line-height: 100%;}
                      .apple-link a {
                          color: inherit !important;
                          font-family: inherit !important;
                          font-size: inherit !important;
                          font-weight: inherit !important;
                          line-height: inherit !important;
                          text-decoration: none !important;
                      .btn-primary table td:hover {
                          background-color: #d5075d !important;}
                      .btn-primary a:hover {
                          background-color: #000 !important;
                          border-color: #000 !important;
                          color: #fff !important;}}
              </style>
          </head>
          <body class style='background-color: #e1e3e5; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;'>
              <table role='presentation' border='0' cellpadding='0' cellspacing='0' class='body' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; background-color: #e1e3e5; width: 100%;' width='100%' bgcolor='#e1e3e5'>
              <tr>
                  <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>&nbsp;</td>
                  <td class='container' style='font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto;' width='580' valign='top'>
                  <div class='content' style='box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;'>
          
                      <!-- START CENTERED WHITE CONTAINER -->
                      <table role='presentation' class='main' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; background: #ffffff; border-radius: 3px; width: 100%;' width='100%'>
          
                      <!-- START MAIN CONTENT AREA -->
                      <tr>
                          <td class='wrapper' style='font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;' valign='top'>
                          <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; width: 100%;' width='100%'>
                              <tr>
                              <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>
                                  <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Hi " . $name . ",</p>
                                  <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Pesan ini secara otomatis dikirimkan kepada anda karena anda meminta untuk mereset kata sandi. Jika anda tidak sama sekali ingin mereset atau bukan anda yang ingin mereset abaikan saja. Klik tombol reset berikut untuk melanjutkan:</p>
                                  <table role='presentation' border='0' cellpadding='0' cellspacing='0' class='btn btn-primary' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; box-sizing: border-box; min-width: 100%; width: 100%;' width='100%'>
                                  <tbody>
                                      <tr>
                                      <td align='left' style='font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;' valign='top'>
                                          <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: auto; width: auto;'>
                                          <tbody>
                                              <tr>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: center;' valign='top' bgcolor='#ffffff' align='center'>
                                                  <a href='" . $baseURL . "auth/new-password?en=" . $en_user . "' target='_blank' style='background-color: #ffffff; border: solid 1px #000; border-radius: 5px; box-sizing: border-box; cursor: pointer; display: inline-block; font-size: 14px; font-weight: bold; margin: 0; padding: 12px 25px; text-decoration: none; text-transform: capitalize; border-color: #000; color: #000;'>Atur Ulang Kata Sandi</a> 
                                                </td>
                                              </tr>
                                          </tbody>
                                          </table>
                                      </td>
                                      </tr>
                                  </tbody>
                                  </table>
                                  <small>Peringatan! Ini adalah pesan otomatis sehingga Anda tidak dapat membalas pesan ini.</small>
                              </td>
                              </tr>
                          </table>
                          </td>
                      </tr>
          
                      <!-- END MAIN CONTENT AREA -->
                      </table>
                      
                      <!-- START FOOTER -->
                      <div class='footer' style='clear: both; margin-top: 10px; text-align: center; width: 100%;'>
                      <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; width: 100%;' width='100%'>
                          <tr>
                          <td class='content-block' style='font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #9a9ea6; font-size: 12px; text-align: center;' valign='top' align='center'>
                              <span class='apple-link' style='color: #9a9ea6; font-size: 12px; text-align: center;'>Workarea Jln. S. K. Lerik, Kota Baru, Kupang, NTT, Indonesia. (0380) 8438423</span>
                          </td>
                          </tr>
                          <tr>
                          <td class='content-block powered-by' style='font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #9a9ea6; font-size: 12px; text-align: center;' valign='top' align='center'>
                              Powered by <a href='https://www.netmedia-framecode.com' style='color: #9a9ea6; font-size: 12px; text-align: center; text-decoration: none;'>Netmedia Framecode</a>.
                          </td>
                          </tr>
                      </table>
                      </div>
                      <!-- END FOOTER -->
          
                  <!-- END CENTERED WHITE CONTAINER -->
                  </div>
                  </td>
                  <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>&nbsp;</td>
              </tr>
              </table>
          </body>
        </html>";
        smtp_mail($to, $subject, $message, "", "", 0, 0, true);
        $sql = "UPDATE users SET en_user='$en_user', token='$token', updated_at=current_timestamp WHERE email='$data[email]'";
      }
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function new_password($conn, $data, $action)
  {
    if ($action == "update") {
      $lenght = strlen($data['password']);
      if ($lenght < 8) {
        $message = "Maaf, password yang anda masukan harus 8 digit atau lebih.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      } else if ($data['password'] !== $data['re_password']) {
        $message = "Maaf, konfirmasi password yang anda masukan belum sama.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      } else {
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $sql = "UPDATE users SET password='$password' WHERE email='$data[email]'";
      }
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function login($conn, $data)
  {
    // check account
    $checkAccount = mysqli_query($conn, "SELECT * FROM users JOIN user_role ON users.id_role=user_role.id_role WHERE users.email='$data[email]'");
    if (mysqli_num_rows($checkAccount) == 0) {
      $message = "Maaf, akun yang anda masukan belum terdaftar.";
      $message_type = "danger";
      alert($message, $message_type);
      return false;
    } else if (mysqli_num_rows($checkAccount) > 0) {
      $row = mysqli_fetch_assoc($checkAccount);
      if (password_verify($data['password'], $row["password"])) {
        $_SESSION["project_gis_korlantas"]["users"] = [
          "id" => $row["id_user"],
          "id_role" => $row["id_role"],
          "role" => $row["role"],
          "email" => $row["email"],
          "name" => $row["name"],
          "image" => $row["image"]
        ];
        return mysqli_affected_rows($conn);
      } else {
        $message = "Maaf, kata sandi yang anda masukan salah.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      }
    }
  }
}

if (isset($_SESSION["project_gis_korlantas"]["users"])) {

  function profil($conn, $data, $action, $id_user)
  {
    if ($action == "update") {
      $path = "../assets/img/profil/";
      if (!empty($_FILES['image']["name"])) {
        $fileName = basename($_FILES["image"]["name"]);
        $fileName = str_replace(" ", "-", $fileName);
        $fileName_encrypt = crc32($fileName);
        $ekstensiGambar = explode('.', $fileName);
        $ekstensiGambar = strtolower(end($ekstensiGambar));
        $imageUploadPath = $path . $fileName_encrypt . "." . $ekstensiGambar;
        $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION);
        $allowTypes = array('jpg', 'png', 'jpeg');
        if (in_array($fileType, $allowTypes)) {
          $imageTemp = $_FILES["image"]["tmp_name"];
          compressImage($imageTemp, $imageUploadPath, 75);
          $image = $fileName_encrypt . "." . $ekstensiGambar;
        } else {
          $message = "Maaf, hanya file gambar JPG, JPEG, dan PNG yang diizinkan.";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        }
      }
      if (!empty($_FILES['image']["name"])) {
        $unwanted_characters = "../assets/img/profil/";
        $remove_image = str_replace($unwanted_characters, "", $data['imageOld']);
        if ($remove_image != "default.svg") {
          unlink($path . $remove_image);
        }
      } else if (empty($_FILE['image']["name"])) {
        $image = $data['imageOld'];
      }
      if (!empty($data['password'])) {
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $sql = "UPDATE users SET name='$data[name]', image='$image', password='$password' WHERE id_user='$id_user'";
      } else {
        $sql = "UPDATE users SET name='$data[name]', image='$image' WHERE id_user='$id_user'";
      }
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function setting($conn, $data, $action)
  {

    if ($action == "update") {
      $path = "../assets/img/auth/";
      if (!empty($_FILES['image']["name"])) {
        $fileName = basename($_FILES["image"]["name"]);
        $fileName = str_replace(" ", "-", $fileName);
        $fileName_encrypt = crc32($fileName);
        $ekstensiGambar = explode('.', $fileName);
        $ekstensiGambar = strtolower(end($ekstensiGambar));
        $imageUploadPath = $path . $fileName_encrypt . "." . $ekstensiGambar;
        $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION);
        $allowTypes = array('jpg', 'png', 'jpeg');
        if (in_array($fileType, $allowTypes)) {
          $imageTemp = $_FILES["image"]["tmp_name"];
          compressImage($imageTemp, $imageUploadPath, 75);
          $image = $fileName_encrypt . "." . $ekstensiGambar;
        } else {
          $message = "Maaf, hanya file gambar JPG, JPEG, dan PNG yang diizinkan.";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        }
      }
      if (!empty($_FILES['image']["name"])) {
        $unwanted_characters = "../assets/img/auth/";
        $remove_image = str_replace($unwanted_characters, "", $data['imageOld']);
        unlink($path . $remove_image);
      } else if (empty($_FILE['image']["name"])) {
        $image = $data['imageOld'];
      }
      $sql = "UPDATE auth SET image='$image', bg='$data[bg]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function users($conn, $data, $action)
  {

    if ($action == "update") {
      $sql = "UPDATE users SET id_role='$data[id_role]', id_active='$data[id_active]' WHERE id_user='$data[id_user]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function role($conn, $data, $action)
  {
    if ($action == "insert") {
      $checkRole = "SELECT * FROM user_role WHERE role LIKE '%$data[role]%'";
      $checkRole = mysqli_query($conn, $checkRole);
      if (mysqli_num_rows($checkRole) > 0) {
        $message = "Maaf, role yang anda masukan sudah ada.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      } else {
        $sql = "INSERT INTO user_role(role) VALUES('$data[role]')";
      }
    }

    if ($action == "update") {
      if ($data['role'] !== $data['roleOld']) {
        $checkRole = "SELECT * FROM user_role WHERE role LIKE '%$data[role]%'";
        $checkRole = mysqli_query($conn, $checkRole);
        if (mysqli_num_rows($checkRole) > 0) {
          $message = "Maaf, role yang anda masukan sudah ada.";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        }
      }
      $sql = "UPDATE user_role SET role='$data[role]' WHERE id_role='$data[id_role]'";
    }

    if ($action == "delete") {
      $sql = "DELETE FROM user_role WHERE id_role='$data[id_role]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function menu($conn, $data, $action)
  {
    if ($action == "insert") {
      $checkMenu = "SELECT * FROM user_menu WHERE menu='$data[menu]'";
      $checkMenu = mysqli_query($conn, $checkMenu);
      if (mysqli_num_rows($checkMenu) > 0) {
        $message = "Maaf, menu yang anda masukan sudah ada.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      } else {
        $sql = "INSERT INTO user_menu(menu) VALUES('$data[menu]')";
      }
    }

    if ($action == "update") {
      if ($data['menu'] !== $data['menuOld']) {
        $checkMenu = "SELECT * FROM user_menu WHERE menu='$data[menu]'";
        $checkMenu = mysqli_query($conn, $checkMenu);
        if (mysqli_num_rows($checkMenu) > 0) {
          $message = "Maaf, menu yang anda masukan sudah ada.";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        }
      }
      $sql = "UPDATE user_menu SET menu='$data[menu]' WHERE id_menu='$data[id_menu]'";
    }

    if ($action == "delete") {
      $sql = "DELETE FROM user_menu WHERE id_menu='$data[id_menu]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function sub_menu($conn, $data, $action, $baseURL)
  {
    $url = strtolower($data['title']);
    $url = str_replace(" ", "-", $url);

    if ($action == "insert") {
      $checkSubMenu = "SELECT * FROM user_sub_menu WHERE title='$data[title]'";
      $checkSubMenu = mysqli_query($conn, $checkSubMenu);
      if (mysqli_num_rows($checkSubMenu) > 0) {
        $message = "Maaf, nama sub menu yang anda masukan sudah ada.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      } else {
        $file = fopen("../views/" . $url . ".php", "w");
        fwrite($file, '<?php require_once("../controller/script.php");
        $_SESSION["project_gis_korlantas"]["name_page"] = "' . $data['title'] . '";
        require_once("../templates/views_top.php"); ?>
        
        <!-- Begin Page Content -->
        <div class="container-fluid">
        
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><?= $_SESSION["project_gis_korlantas"]["name_page"] ?></h1>
          </div>
        
          <!-- Mulai buatlah lembar kerja anda disini! -->
        
        </div>
        <!-- /.container-fluid -->
        
        <?php require_once("../templates/views_bottom.php") ?>
        ');
        fclose($file);
        $sql = "INSERT INTO user_sub_menu(id_menu,id_active,title,url,icon) VALUES('$data[id_menu]','$data[id_active]','$data[title]','$url','$data[icon]')";
      }
    }

    if ($action == "update") {
      if ($data['title'] !== $data['titleOld']) {
        $checkSubMenu = "SELECT * FROM user_sub_menu WHERE title='$data[title]'";
        $checkSubMenu = mysqli_query($conn, $checkSubMenu);
        if (mysqli_num_rows($checkSubMenu) > 0) {
          $message = "Maaf, nama sub menu yang anda masukan sudah ada.";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        }
      }
      $sql = "UPDATE user_sub_menu SET id_menu='$data[id_menu]', id_active='$data[id_active]', title='$data[title]', url='$url', icon='$data[icon]' WHERE id_sub_menu='$data[id_sub_menu]'";
    }

    if ($action == "delete") {
      unlink("../views/" . $url . ".php");
      $sql = "DELETE FROM user_sub_menu WHERE id_sub_menu='$data[id_sub_menu]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function menu_access($conn, $data, $action)
  {
    if ($action == "insert") {
      $sql = "INSERT INTO user_access_menu(id_role,id_menu) VALUES('$data[id_role]','$data[id_menu]')";
    }

    if ($action == "update") {
      $sql = "UPDATE user_access_menu SET id_role='$data[id_role]', id_menu='$data[id_menu]' WHERE id_access_menu='$data[id_access_menu]'";
    }

    if ($action == "delete") {
      $sql = "DELETE FROM user_access_menu WHERE id_access_menu='$data[id_access_menu]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function sub_menu_access($conn, $data, $action)
  {
    if ($action == "insert") {
      $sql = "INSERT INTO user_access_sub_menu(id_role,id_sub_menu) VALUES('$data[id_role]','$data[id_sub_menu]')";
    }

    if ($action == "update") {
      $sql = "UPDATE user_access_sub_menu SET id_role='$data[id_role]', id_sub_menu='$data[id_sub_menu]' WHERE id_access_sub_menu='$data[id_access_sub_menu]'";
    }

    if ($action == "delete") {
      $sql = "DELETE FROM user_access_sub_menu WHERE id_access_sub_menu='$data[id_access_sub_menu]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function informasi_khusus($conn, $data, $action)
  {
    if ($action == "insert") {
      $select_informasi_khusus = "SELECT * FROM informasi_khusus WHERE informasi_khusus='$data[informasi_khusus]'";
      $take_informasi_khusus = mysqli_query($conn, $select_informasi_khusus);
      if (mysqli_num_rows($take_informasi_khusus) > 0) {
        $message = "Maaf, informasi khusus yang anda masukan sudah ada.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      }
      $sql = "INSERT INTO informasi_khusus(informasi_khusus) VALUES('$data[informasi_khusus]')";
    }

    if ($action == "update") {
      if ($data['informasi_khusus'] != $data['informasi_khususOld']) {
        $select_informasi_khusus = "SELECT * FROM informasi_khusus WHERE informasi_khusus='$data[informasi_khusus]'";
        $take_informasi_khusus = mysqli_query($conn, $select_informasi_khusus);
        if (mysqli_num_rows($take_informasi_khusus) > 0) {
          $message = "Maaf, informasi khusus yang anda masukan sudah ada.";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        }
      }
      $sql = "UPDATE informasi_khusus SET informasi_khusus='$data[informasi_khusus]' WHERE id_informasi_khusus='$data[id_informasi_khusus]'";
    }

    if ($action == "delete") {
      $sql = "DELETE FROM informasi_khusus WHERE id_informasi_khusus='$data[id_informasi_khusus]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function cuaca($conn, $data, $action)
  {
    if ($action == "insert") {
      $select_cuaca = "SELECT * FROM cuaca WHERE kondisi='$data[kondisi]'";
      $take_cuaca = mysqli_query($conn, $select_cuaca);
      if (mysqli_num_rows($take_cuaca) > 0) {
        $message = "Maaf, kondisi cuaca yang anda masukan sudah ada.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      }
      $sql = "INSERT INTO cuaca(kondisi) VALUES('$data[kondisi]')";
    }

    if ($action == "update") {
      if ($data['kondisi'] != $data['kondisiOld']) {
        $select_cuaca = "SELECT * FROM cuaca WHERE kondisi='$data[kondisi]'";
        $take_cuaca = mysqli_query($conn, $select_cuaca);
        if (mysqli_num_rows($take_cuaca) > 0) {
          $message = "Maaf, kondisi cuaca yang anda masukan sudah ada.";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        }
      }
      $sql = "UPDATE cuaca SET kondisi='$data[kondisi]' WHERE id_cuaca='$data[id_cuaca]'";
    }

    if ($action == "delete") {
      $sql = "DELETE FROM cuaca WHERE id_cuaca='$data[id_cuaca]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function tingkat_kecelakaan($conn, $data, $action)
  {
    if ($action == "insert") {
      $select_tingkat_kecelakaan = "SELECT * FROM tingkat_kecelakaan WHERE tingkat_kecelakaan='$data[tingkat_kecelakaan]'";
      $take_tingkat_kecelakaan = mysqli_query($conn, $select_tingkat_kecelakaan);
      if (mysqli_num_rows($take_tingkat_kecelakaan) > 0) {
        $message = "Maaf, tingkat kecelakaan yang anda masukan sudah ada.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      }
      $sql = "INSERT INTO tingkat_kecelakaan(tingkat_kecelakaan) VALUES('$data[tingkat_kecelakaan]')";
    }

    if ($action == "update") {
      if ($data['tingkat_kecelakaan'] != $data['tingkat_kecelakaanOld']) {
        $select_tingkat_kecelakaan = "SELECT * FROM tingkat_kecelakaan WHERE tingkat_kecelakaan='$data[tingkat_kecelakaan]'";
        $take_tingkat_kecelakaan = mysqli_query($conn, $select_tingkat_kecelakaan);
        if (mysqli_num_rows($take_tingkat_kecelakaan) > 0) {
          $message = "Maaf, tingkat kecelakaan yang anda masukan sudah ada.";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        }
      }
      $sql = "UPDATE tingkat_kecelakaan SET tingkat_kecelakaan='$data[tingkat_kecelakaan]' WHERE id_tingkat_kecelakaan='$data[id_tingkat_kecelakaan]'";
    }

    if ($action == "delete") {
      $sql = "DELETE FROM tingkat_kecelakaan WHERE id_tingkat_kecelakaan='$data[id_tingkat_kecelakaan]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function kecelakaan_menonjol($conn, $data, $action)
  {
    if ($action == "insert") {
      $select_kecelakaan_menonjol = "SELECT * FROM kecelakaan_menonjol WHERE kecelakaan_menonjol='$data[kecelakaan_menonjol]'";
      $take_kecelakaan_menonjol = mysqli_query($conn, $select_kecelakaan_menonjol);
      if (mysqli_num_rows($take_kecelakaan_menonjol) > 0) {
        $message = "Maaf, status kecelakaan menonjol yang anda masukan sudah ada.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      }
      $sql = "INSERT INTO kecelakaan_menonjol(kecelakaan_menonjol) VALUES('$data[kecelakaan_menonjol]')";
    }

    if ($action == "update") {
      if ($data['kecelakaan_menonjol'] != $data['kecelakaan_menonjolOld']) {
        $select_kecelakaan_menonjol = "SELECT * FROM kecelakaan_menonjol WHERE kecelakaan_menonjol='$data[kecelakaan_menonjol]'";
        $take_kecelakaan_menonjol = mysqli_query($conn, $select_kecelakaan_menonjol);
        if (mysqli_num_rows($take_kecelakaan_menonjol) > 0) {
          $message = "Maaf, status kecelakaan menonjol yang anda masukan sudah ada.";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        }
      }
      $sql = "UPDATE kecelakaan_menonjol SET kecelakaan_menonjol='$data[kecelakaan_menonjol]' WHERE id_kecelakaan_menonjol='$data[id_kecelakaan_menonjol]'";
    }

    if ($action == "delete") {
      $sql = "DELETE FROM kecelakaan_menonjol WHERE id_kecelakaan_menonjol='$data[id_kecelakaan_menonjol]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function fungsi_jalan($conn, $data, $action)
  {
    if ($action == "insert") {
      $select_fungsi_jalan = "SELECT * FROM fungsi_jalan WHERE fungsi_jalan='$data[fungsi_jalan]'";
      $take_fungsi_jalan = mysqli_query($conn, $select_fungsi_jalan);
      if (mysqli_num_rows($take_fungsi_jalan) > 0) {
        $message = "Maaf, fungsi jalan yang anda masukan sudah ada.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      }
      $sql = "INSERT INTO fungsi_jalan(fungsi_jalan) VALUES('$data[fungsi_jalan]')";
    }

    if ($action == "update") {
      if ($data['fungsi_jalan'] != $data['fungsi_jalanOld']) {
        $select_fungsi_jalan = "SELECT * FROM fungsi_jalan WHERE fungsi_jalan='$data[fungsi_jalan]'";
        $take_fungsi_jalan = mysqli_query($conn, $select_fungsi_jalan);
        if (mysqli_num_rows($take_fungsi_jalan) > 0) {
          $message = "Maaf, fungsi jalan yang anda masukan sudah ada.";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        }
      }
      $sql = "UPDATE fungsi_jalan SET fungsi_jalan='$data[fungsi_jalan]' WHERE id_fungsi_jalan='$data[id_fungsi_jalan]'";
    }

    if ($action == "delete") {
      $sql = "DELETE FROM fungsi_jalan WHERE id_fungsi_jalan='$data[id_fungsi_jalan]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function kelas_jalan($conn, $data, $action)
  {
    if ($action == "insert") {
      $select_kelas_jalan = "SELECT * FROM kelas_jalan WHERE kelas_jalan LIKE '%$data[kelas_jalan]'";
      $take_kelas_jalan = mysqli_query($conn, $select_kelas_jalan);
      if (mysqli_num_rows($take_kelas_jalan) > 0) {
        $message = "Maaf, kelas jalan yang anda masukan sudah ada.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      }
      $sql = "INSERT INTO kelas_jalan(kelas_jalan) VALUES('$data[kelas_jalan]')";
    }

    if ($action == "update") {
      if ($data['kelas_jalan'] != $data['kelas_jalanOld']) {
        $select_kelas_jalan = "SELECT * FROM kelas_jalan WHERE kelas_jalan LIKE '%$data[kelas_jalan]'";
        $take_kelas_jalan = mysqli_query($conn, $select_kelas_jalan);
        if (mysqli_num_rows($take_kelas_jalan) > 0) {
          $message = "Maaf, kelas jalan yang anda masukan sudah ada.";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        }
      }
      $sql = "UPDATE kelas_jalan SET kelas_jalan='$data[kelas_jalan]' WHERE id_kelas_jalan='$data[id_kelas_jalan]'";
    }

    if ($action == "delete") {
      $sql = "DELETE FROM kelas_jalan WHERE id_kelas_jalan='$data[id_kelas_jalan]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function tipe_jalan($conn, $data, $action)
  {
    if ($action == "insert") {
      $select_tipe_jalan = "SELECT * FROM tipe_jalan WHERE tipe_jalan='$data[tipe_jalan]'";
      $take_tipe_jalan = mysqli_query($conn, $select_tipe_jalan);
      if (mysqli_num_rows($take_tipe_jalan) > 0) {
        $message = "Maaf, tipe jalan yang anda masukan sudah ada.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      }
      $sql = "INSERT INTO tipe_jalan(tipe_jalan) VALUES('$data[tipe_jalan]')";
    }

    if ($action == "update") {
      if ($data['tipe_jalan'] != $data['tipe_jalanOld']) {
        $select_tipe_jalan = "SELECT * FROM tipe_jalan WHERE tipe_jalan='$data[tipe_jalan]'";
        $take_tipe_jalan = mysqli_query($conn, $select_tipe_jalan);
        if (mysqli_num_rows($take_tipe_jalan) > 0) {
          $message = "Maaf, tipe jalan yang anda masukan sudah ada.";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        }
      }
      $sql = "UPDATE tipe_jalan SET tipe_jalan='$data[tipe_jalan]' WHERE id_tipe_jalan='$data[id_tipe_jalan]'";
    }

    if ($action == "delete") {
      $sql = "DELETE FROM tipe_jalan WHERE id_tipe_jalan='$data[id_tipe_jalan]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function permukaan_jalan($conn, $data, $action)
  {
    if ($action == "insert") {
      $select_permukaan_jalan = "SELECT * FROM permukaan_jalan WHERE permukaan_jalan='$data[permukaan_jalan]'";
      $take_permukaan_jalan = mysqli_query($conn, $select_permukaan_jalan);
      if (mysqli_num_rows($take_permukaan_jalan) > 0) {
        $message = "Maaf, permukaan jalan yang anda masukan sudah ada.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      }
      $sql = "INSERT INTO permukaan_jalan(permukaan_jalan) VALUES('$data[permukaan_jalan]')";
    }

    if ($action == "update") {
      if ($data['permukaan_jalan'] != $data['permukaan_jalanOld']) {
        $select_permukaan_jalan = "SELECT * FROM permukaan_jalan WHERE permukaan_jalan='$data[permukaan_jalan]'";
        $take_permukaan_jalan = mysqli_query($conn, $select_permukaan_jalan);
        if (mysqli_num_rows($take_permukaan_jalan) > 0) {
          $message = "Maaf, permukaan jalan yang anda masukan sudah ada.";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        }
      }
      $sql = "UPDATE permukaan_jalan SET permukaan_jalan='$data[permukaan_jalan]' WHERE id_permukaan_jalan='$data[id_permukaan_jalan]'";
    }

    if ($action == "delete") {
      $sql = "DELETE FROM permukaan_jalan WHERE id_permukaan_jalan='$data[id_permukaan_jalan]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function kemiringan_jalan($conn, $data, $action)
  {
    if ($action == "insert") {
      $select_kemiringan_jalan = "SELECT * FROM kemiringan_jalan WHERE kemiringan_jalan='$data[kemiringan_jalan]'";
      $take_kemiringan_jalan = mysqli_query($conn, $select_kemiringan_jalan);
      if (mysqli_num_rows($take_kemiringan_jalan) > 0) {
        $message = "Maaf, kemiringan jalan yang anda masukan sudah ada.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      }
      $sql = "INSERT INTO kemiringan_jalan(kemiringan_jalan) VALUES('$data[kemiringan_jalan]')";
    }

    if ($action == "update") {
      if ($data['kemiringan_jalan'] != $data['kemiringan_jalanOld']) {
        $select_kemiringan_jalan = "SELECT * FROM kemiringan_jalan WHERE kemiringan_jalan='$data[kemiringan_jalan]'";
        $take_kemiringan_jalan = mysqli_query($conn, $select_kemiringan_jalan);
        if (mysqli_num_rows($take_kemiringan_jalan) > 0) {
          $message = "Maaf, kemiringan jalan yang anda masukan sudah ada.";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        }
      }
      $sql = "UPDATE kemiringan_jalan SET kemiringan_jalan='$data[kemiringan_jalan]' WHERE id_kemiringan_jalan='$data[id_kemiringan_jalan]'";
    }

    if ($action == "delete") {
      $sql = "DELETE FROM kemiringan_jalan WHERE id_kemiringan_jalan='$data[id_kemiringan_jalan]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function status_jalan($conn, $data, $action)
  {
    if ($action == "insert") {
      $select_status_jalan = "SELECT * FROM status_jalan WHERE status_jalan='$data[status_jalan]'";
      $take_status_jalan = mysqli_query($conn, $select_status_jalan);
      if (mysqli_num_rows($take_status_jalan) > 0) {
        $message = "Maaf, status jalan yang anda masukan sudah ada.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      }
      $sql = "INSERT INTO status_jalan(status_jalan) VALUES('$data[status_jalan]')";
    }

    if ($action == "update") {
      if ($data['status_jalan'] != $data['status_jalanOld']) {
        $select_status_jalan = "SELECT * FROM status_jalan WHERE status_jalan='$data[status_jalan]'";
        $take_status_jalan = mysqli_query($conn, $select_status_jalan);
        if (mysqli_num_rows($take_status_jalan) > 0) {
          $message = "Maaf, status jalan yang anda masukan sudah ada.";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        }
      }
      $sql = "UPDATE status_jalan SET status_jalan='$data[status_jalan]' WHERE id_status_jalan='$data[id_status_jalan]'";
    }

    if ($action == "delete") {
      $sql = "DELETE FROM status_jalan WHERE id_status_jalan='$data[id_status_jalan]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function polres($conn, $data, $action)
  {
    $path = "../assets/img/polres/";

    if ($action == "insert") {
      $select_polres = "SELECT * FROM polres WHERE nama_polres='$data[nama_polres]'";
      $take_polres = mysqli_query($conn, $select_polres);
      if (mysqli_num_rows($take_polres) > 0) {
        $message = "Maaf, nama polres yang anda masukan sudah ada.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      }
      $fileName = basename($_FILES["img_polres"]["name"]);
      $fileName = str_replace(" ", "-", $fileName);
      $fileName_encrypt = crc32($fileName);
      $ekstensiGambar = explode('.', $fileName);
      $ekstensiGambar = strtolower(end($ekstensiGambar));
      $imageUploadPath = $path . $fileName_encrypt . "." . $ekstensiGambar;
      $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION);
      $allowTypes = array('jpg', 'png', 'jpeg');
      if (in_array($fileType, $allowTypes)) {
        $imageTemp = $_FILES["img_polres"]["tmp_name"];
        compressImage($imageTemp, $imageUploadPath, 75);
        $img_polres = $fileName_encrypt . "." . $ekstensiGambar;
      } else {
        $message = "Maaf, hanya file gambar JPG, JPEG, dan PNG yang diizinkan.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      }
      $sql = "INSERT INTO polres(nama_polres,alamat,telepon,email,jumlah_anggota,img_polres) VALUES('$data[nama_polres]','$data[alamat]','$data[telepon]','$data[email]','$data[jumlah_anggota]','$img_polres')";
    }

    if ($action == "update") {
      if ($data['nama_polres'] != $data['nama_polresOld']) {
        $select_polres = "SELECT * FROM polres WHERE nama_polres='$data[nama_polres]'";
        $take_polres = mysqli_query($conn, $select_polres);
        if (mysqli_num_rows($take_polres) > 0) {
          $message = "Maaf, nama polres yang anda masukan sudah ada.";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        }
      }
      if (!empty($_FILES['img_polres']["name"])) {
        $fileName = basename($_FILES["img_polres"]["name"]);
        $fileName = str_replace(" ", "-", $fileName);
        $fileName_encrypt = crc32($fileName);
        $ekstensiGambar = explode('.', $fileName);
        $ekstensiGambar = strtolower(end($ekstensiGambar));
        $imageUploadPath = $path . $fileName_encrypt . "." . $ekstensiGambar;
        $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION);
        $allowTypes = array('jpg', 'png', 'jpeg');
        if (in_array($fileType, $allowTypes)) {
          $imageTemp = $_FILES["img_polres"]["tmp_name"];
          compressImage($imageTemp, $imageUploadPath, 75);
          $img_polres = $fileName_encrypt . "." . $ekstensiGambar;
          unlink($path . $data['img_polresOld']);
        } else {
          $message = "Maaf, hanya file gambar JPG, JPEG, dan PNG yang diizinkan.";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        }
      } else if (empty($_FILE['img_polres']["name"])) {
        $img_polres = $data['img_polresOld'];
      }
      $sql = "UPDATE polres SET nama_polres='$data[nama_polres]', alamat='$data[alamat]', telepon='$data[telepon]', email='$data[email]', jumlah_anggota='$data[jumlah_anggota]', img_polres='$img_polres' WHERE id_polres='$data[id_polres]'";
    }

    if ($action == "delete") {
      unlink($path . $data['img_polres']);
      $sql = "DELETE FROM polres WHERE id_polres='$data[id_polres]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function kondisi_cahaya($conn, $data, $action)
  {
    if ($action == "insert") {
      $select_kondisi_cahaya = "SELECT * FROM kondisi_cahaya WHERE kondisi_cahaya='$data[kondisi_cahaya]'";
      $take_kondisi_cahaya = mysqli_query($conn, $select_kondisi_cahaya);
      if (mysqli_num_rows($take_kondisi_cahaya) > 0) {
        $message = "Maaf, status jalan yang anda masukan sudah ada.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      }
      $sql = "INSERT INTO kondisi_cahaya(kondisi_cahaya) VALUES('$data[kondisi_cahaya]')";
    }

    if ($action == "update") {
      if ($data['kondisi_cahaya'] != $data['kondisi_cahayaOld']) {
        $select_kondisi_cahaya = "SELECT * FROM kondisi_cahaya WHERE kondisi_cahaya='$data[kondisi_cahaya]'";
        $take_kondisi_cahaya = mysqli_query($conn, $select_kondisi_cahaya);
        if (mysqli_num_rows($take_kondisi_cahaya) > 0) {
          $message = "Maaf, status jalan yang anda masukan sudah ada.";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        }
      }
      $sql = "UPDATE kondisi_cahaya SET kondisi_cahaya='$data[kondisi_cahaya]' WHERE id_kondisi_cahaya='$data[id_kondisi_cahaya]'";
    }

    if ($action == "delete") {
      $sql = "DELETE FROM kondisi_cahaya WHERE id_kondisi_cahaya='$data[id_kondisi_cahaya]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function laka($conn, $data, $action)
  {
    $path = "../assets/img/laka/";

    if ($action == "insert") {
      $select_laka = "SELECT * FROM laka WHERE no_laka='$data[no_laka]'";
      $take_laka = mysqli_query($conn, $select_laka);
      if (mysqli_num_rows($take_laka) > 0) {
        $message = "Maaf, nomor laka yang anda masukan sudah ada.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      }
      $fileName = basename($_FILES["img_laka"]["name"]);
      $fileName = str_replace(" ", "-", $fileName);
      $fileName_encrypt = crc32($fileName);
      $ekstensiGambar = explode('.', $fileName);
      $ekstensiGambar = strtolower(end($ekstensiGambar));
      $imageUploadPath = $path . $fileName_encrypt . "." . $ekstensiGambar;
      $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION);
      $allowTypes = array('jpg', 'png', 'jpeg');
      if (in_array($fileType, $allowTypes)) {
        $imageTemp = $_FILES["img_laka"]["tmp_name"];
        compressImage($imageTemp, $imageUploadPath, 75);
        $img_laka = $fileName_encrypt . "." . $ekstensiGambar;
      } else {
        $message = "Maaf, hanya file gambar JPG, JPEG, dan PNG yang diizinkan.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      }
      $sql = "INSERT INTO laka(
        id_informasi_khusus,
        id_kondisi_cahaya,
        id_cuaca,
        id_tingkat_kecelakaan,
        id_kecelakaan_menonjol,
        id_fungsi_jalan,
        id_kelas_jalan,
        id_tipe_jalan,
        id_permukaan_jalan,
        id_kemiringan_jalan,
        id_status_jalan,
        id_polres,
        id_titik_rawan,
        no_laka,
        tanggal_kejadian,
        jumlah_meninggal,
        jumlah_luka_berat,
        jumlah_luka_ringan,
        latitude,
        longitude,
        titik_acuan,
        tipe_kecelakaan,
        nama_jalan,
        batas_kecepatan_dilokasi,
        nilai_kerugian_non_kendaraan,
        nilai_kerugian_kendaraan,
        keterangan_kerugian,
        jam_kejadian,
        img_laka
      ) VALUES(
        '$data[id_informasi_khusus]',
        '$data[id_kondisi_cahaya]',
        '$data[id_cuaca]',
        '$data[id_tingkat_kecelakaan]',
        '$data[id_kecelakaan_menonjol]',
        '$data[id_fungsi_jalan]',
        '$data[id_kelas_jalan]',
        '$data[id_tipe_jalan]',
        '$data[id_permukaan_jalan]',
        '$data[id_kemiringan_jalan]',
        '$data[id_status_jalan]',
        '$data[id_polres]',
        '$data[id_titik_rawan]',
        '$data[no_laka]',
        '$data[tanggal_kejadian]',
        '$data[jumlah_meninggal]',
        '$data[jumlah_luka_berat]',
        '$data[jumlah_luka_ringan]',
        '$data[latitude]',
        '$data[longitude]',
        '$data[titik_acuan]',
        '$data[tipe_kecelakaan]',
        '$data[batas_kecepatan_dilokasi]',
        '$data[nilai_kerugian_non_kendaraan]',
        '$data[nilai_kerugian_kendaraan]',
        '$data[keterangan_kerugian]',
        '$data[jam_kejadian]',
        '$img_laka'
      )";
    }

    if ($action == "update") {
      if ($data['no_laka'] != $data['no_lakaOld']) {
        $select_laka = "SELECT * FROM laka WHERE no_laka='$data[no_laka]'";
        $take_laka = mysqli_query($conn, $select_laka);
        if (mysqli_num_rows($take_laka) > 0) {
          $message = "Maaf, nomor laka yang anda masukan sudah ada.";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        }
      }
      if (!empty($_FILES['img_laka']["name"])) {
        $fileName = basename($_FILES["img_laka"]["name"]);
        $fileName = str_replace(" ", "-", $fileName);
        $fileName_encrypt = crc32($fileName);
        $ekstensiGambar = explode('.', $fileName);
        $ekstensiGambar = strtolower(end($ekstensiGambar));
        $imageUploadPath = $path . $fileName_encrypt . "." . $ekstensiGambar;
        $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION);
        $allowTypes = array('jpg', 'png', 'jpeg');
        if (in_array($fileType, $allowTypes)) {
          $imageTemp = $_FILES["img_laka"]["tmp_name"];
          compressImage($imageTemp, $imageUploadPath, 75);
          $img_laka = $fileName_encrypt . "." . $ekstensiGambar;
          unlink($path . $data['img_lakaOld']);
        } else {
          $message = "Maaf, hanya file gambar JPG, JPEG, dan PNG yang diizinkan.";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        }
      } else if (empty($_FILE['img_laka']["name"])) {
        $img_laka = $data['img_lakaOld'];
      }
      $sql = "UPDATE laka SET id_informasi_khusus='$data[id_informasi_khusus]', id_kondisi_cahaya='$data[id_kondisi_cahaya]', id_cuaca='$data[id_cuaca]', id_tingkat_kecelakaan='$data[id_tingkat_kecelakaan]', id_kecelakaan_menonjol='$data[id_kecelakaan_menonjol]', id_fungsi_jalan='$data[id_fungsi_jalan]', id_kelas_jalan='$data[id_kelas_jalan]', id_tipe_jalan='$data[id_tipe_jalan]', id_permukaan_jalan='$data[id_permukaan_jalan]', id_kemiringan_jalan='$data[id_kemiringan_jalan]', id_status_jalan='$data[id_status_jalan]', id_polres='$data[id_polres]', no_laka='$data[no_laka]', tanggal_kejadian='$data[tanggal_kejadian]', jumlah_meninggal='$data[jumlah_meninggal]', jumlah_luka_berat='$data[jumlah_luka_berat]', jumlah_luka_ringan='$data[jumlah_luka_ringan]', latitude='$data[latitude]', longitude='$data[longitude]', titik_acuan='$data[titik_acuan]', tipe_kecelakaan='$data[tipe_kecelakaan]', id_titik_rawan='$data[id_titik_rawan]', batas_kecepatan_dilokasi='$data[batas_kecepatan_dilokasi]', nilai_kerugian_non_kendaraan='$data[nilai_kerugian_non_kendaraan]', nilai_kerugian_kendaraan='$data[nilai_kerugian_kendaraan]', keterangan_kerugian='$data[keterangan_kerugian]', jam_kejadian='$data[jam_kejadian]', img_laka='$img_laka' WHERE id_laka='$data[id_laka]'";
    }

    if ($action == "delete") {
      unlink($path . $data['img_laka']);
      $sql = "DELETE FROM laka WHERE id_laka='$data[id_laka]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function titik_rawan($conn, $data, $action)
  {
    $path = "../assets/img/titik_rawan/";

    if ($action == "insert") {
      $select_titik_rawan = "SELECT * FROM titik_rawan WHERE nama_jalan_rawan='$data[nama_jalan_rawan]'";
      $take_titik_rawan = mysqli_query($conn, $select_titik_rawan);
      if (mysqli_num_rows($take_titik_rawan) > 0) {
        $message = "Maaf, nama jalan yang anda masukan sudah ada.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      }
      $fileName = basename($_FILES["img_titik_rawan"]["name"]);
      $fileName = str_replace(" ", "-", $fileName);
      $fileName_encrypt = crc32($fileName);
      $ekstensiGambar = explode('.', $fileName);
      $ekstensiGambar = strtolower(end($ekstensiGambar));
      $imageUploadPath = $path . $fileName_encrypt . "." . $ekstensiGambar;
      $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION);
      $allowTypes = array('jpg', 'png', 'jpeg');
      if (in_array($fileType, $allowTypes)) {
        $imageTemp = $_FILES["img_titik_rawan"]["tmp_name"];
        compressImage($imageTemp, $imageUploadPath, 75);
        $img_titik_rawan = $fileName_encrypt . "." . $ekstensiGambar;
      } else {
        $message = "Maaf, hanya file gambar JPG, JPEG, dan PNG yang diizinkan.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      }
      $sql = "INSERT INTO titik_rawan(img_titik_rawan,nama_jalan_rawan,latitude,longitude) VALUES('$img_titik_rawan','$data[nama_jalan_rawan]','$data[latitude]','$data[longitude]')";
    }

    if ($action == "update") {
      if ($data['nama_jalan_rawan'] != $data['nama_jalan_rawanOld']) {
        $select_titik_rawan = "SELECT * FROM titik_rawan WHERE nama_jalan_rawan='$data[nama_jalan_rawan]'";
        $take_titik_rawan = mysqli_query($conn, $select_titik_rawan);
        if (mysqli_num_rows($take_titik_rawan) > 0) {
          $message = "Maaf, nama jalan yang anda masukan sudah ada.";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        }
      }
      if (!empty($_FILES['img_titik_rawan']["name"])) {
        $fileName = basename($_FILES["img_titik_rawan"]["name"]);
        $fileName = str_replace(" ", "-", $fileName);
        $fileName_encrypt = crc32($fileName);
        $ekstensiGambar = explode('.', $fileName);
        $ekstensiGambar = strtolower(end($ekstensiGambar));
        $imageUploadPath = $path . $fileName_encrypt . "." . $ekstensiGambar;
        $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION);
        $allowTypes = array('jpg', 'png', 'jpeg');
        if (in_array($fileType, $allowTypes)) {
          $imageTemp = $_FILES["img_titik_rawan"]["tmp_name"];
          compressImage($imageTemp, $imageUploadPath, 75);
          $img_titik_rawan = $fileName_encrypt . "." . $ekstensiGambar;
          unlink($path . $data['img_titik_rawanOld']);
        } else {
          $message = "Maaf, hanya file gambar JPG, JPEG, dan PNG yang diizinkan.";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        }
      } else if (empty($_FILE['img_titik_rawan']["name"])) {
        $img_titik_rawan = $data['img_titik_rawanOld'];
      }
      $sql = "UPDATE titik_rawan SET img_titik_rawan='$data[img_titik_rawan]', nama_jalan_rawan='$data[nama_jalan_rawan]', latitude='$data[latitude]', longitude='$data[longitude]' WHERE id_titik_rawan='$data[id_titik_rawan]'";
    }

    if ($action == "delete") {
      unlink($path . $data['img_titik_rawan']);
      $sql = "DELETE FROM titik_rawan WHERE id_titik_rawan='$data[id_titik_rawan]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function __name($conn, $data, $action)
  {
    if ($action == "insert") {
    }

    if ($action == "update") {
    }

    if ($action == "delete") {
    }

    // mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }
}
