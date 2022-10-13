<?php

include 'config.php';

session_start();

error_reporting(0);

if (isset($_SESSION["user_id"])) {
  header("Location: welcome.php");
}

if (isset($_POST["signup"])) {
  $name = mysqli_real_escape_string($conn, $_POST["signup_name"]);
  $email = mysqli_real_escape_string($conn, $_POST["signup_email"]);
  $password = mysqli_real_escape_string($conn, md5($_POST["signup_password"]));
  $cpassword = mysqli_real_escape_string($conn, md5($_POST["signup_cpassword"]));
  $token = md5(rand());
  
  $check_email = mysqli_num_rows(mysqli_query($conn, "SELECT email FROM tb_user WHERE email='$email'"));

  if ($password !== $cpassword) {
    echo "<script>alert('Password tidak sama!');</script";
  } elseif ($check_email > 0) {
    echo "<script>alert('Email sudah terdaftar!');</script";
  } else {
    $sql = "INSERT INTO tb_user (name, email, password, token, status) VALUES ('$name', '$email', '$password', '$token', '0')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
      $_POST["signup_name"] = "";
      $_POST["signup_email"] = "";
      $_POST["signup_password"] = "";
      $_POST["signup_cpassword"] = "";

      $to = $email;
      $subject = "Verifikasi Register JOBSIDE";

      $message = "
      <html>
      <head>
      <title>{$subject}</title>
      </head>
      <body>
      <p><strong>Hai {$name},</strong></p>
      <p>Terimakasih telah melakukan registrasi, verifikasi email Anda untuk dapat mengakses JOBSIDE. Klik link dibawah untuk verifikasi!</p>
      <p><a href='{$base_url}verify-email.php?token={$token}'>Verifikasi Email</a></p>
      </body>
      </html>
      ";

      // Always set content-type when sending HTML email
      $headers = "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

      // More headers
      $headers .= "From: ". $email;

      if (mail($to,$subject,$message,$headers)) {
        echo "<script>alert('Verifikasi telah terkirim di email. Silahkan cek Email anda {$email}.');</script";
      } else {
        echo "<script>alert('Verifkasi Email tidak terkirim. Silahkan ulangi kembali.');</script";
      }
    } else {
      echo "<script>alert('Registrasi gagal! Coba ulangi kembali.');</script";
    }
  }  
}

if (isset($_POST["signin"])) {
  $email = mysqli_real_escape_string($conn, $_POST["email"]);
  $password = mysqli_real_escape_string($conn, md5($_POST["password"]));
  
  $check_email = mysqli_query($conn, "SELECT id FROM tb_user WHERE email='$email' AND password='$password'");
  
  if (mysqli_num_rows($check_email) > 0) {
    $row = mysqli_fetch_assoc($check_email);
    $_SESSION["user_id"] = $row['id'];
    header("Location: welcome.php");
    } else {
    echo "<script>alert('Login gagal! Coba ulangi kembali.');</script";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="style.css" />
    <title>JOBSIDE | Register</title>
  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <form action="" method="post" class="sign-in-form">
            <h2 class="title">Sign In</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Email Address" name="email" value="<?php echo $_POST['email']; ?>" required/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required/>
            </div>
            <input type="submit" value="Login" name="signin" class="btn solid" />
            <p class="social-text">Atau masuk melalui</p>
            <div class="social-media">
              <a href="#" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-google"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div>
          </form>
          <form action="" class="sign-up-form" method="post">
            <h2 class="title">Sign Up</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Nama" name="signup_name" value="<?php echo $_POST["signup_name"]; ?>" required/>
            </div>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" placeholder="Email" name="signup_email" value="<?php echo $_POST["signup_email"]; ?>" required/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" name="signup_password" value="<?php echo $_POST["signup_password"]; ?>" required/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Konfirmasi Password" name="signup_cpassword" value="<?php echo $_POST["signup_cpassword"]; ?>" required/>
            </div>
            <input type="submit" class="btn" name="signup" value="Sign up" />
            <p class="social-text">Atau masuk melalui</p>
            <div class="social-media">
              <a href="#" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-google"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div>
          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h1>JOBSIDE</h1>
            <p>
              Bekerja bersama kami, buat waktu luangmu lebih menghasilkan. Mulailah sekarang!
            </p>
            <button class="btn transparent" id="sign-up-btn">
              Sign Up
            </button>
          </div>
          <img src="img/register.png" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h1>JOBSIDE</h1>
            <p>
              Sudah memiliki akun sebelumnya? Yuk kembali lagi untuk memulai aktivitas luangmu disini!
            </p>
            <button class="btn transparent" id="sign-in-btn">
              Sign In
            </button>
          </div>
          <img src="img/register.png" class="image" alt="" />
        </div>
      </div>
    </div>

    <script src="app.js"></script>
  </body>
</html>