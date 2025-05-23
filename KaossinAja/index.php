<?php
require 'asset/php/koneksi.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['register'])) {
        // Registrasi Pengguna
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmpassword = $_POST['confirmpassword'];

        if ($password === $confirmpassword) {
            $sql = "INSERT INTO users (name, email, password, confirmpassword) 
                    VALUES ('$name', '$email', '$password', '$confirmpassword')";
            if (mysqli_query($con, $sql)) {
                $_SESSION['message'] = "Registrasi berhasil!";
                header('Location: index.php');
                exit();
            } else {
                $_SESSION['error'] = "Error: " . mysqli_error($con);
            }
        } else {
            $_SESSION['error'] = "Password dan Konfirmasi Password tidak sesuai!";
        }
    }

    if (isset($_POST['login'])) {
        // Login Pengguna
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) > 0) {
            $_SESSION['user'] = mysqli_fetch_assoc($result);
            header('Location: indexadmin.php');
            exit();
        } else {
            $_SESSION['error'] = "Email atau Password salah!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>KaosSin Aja</title>
    <link rel="stylesheet" href="asset/css/style.css" />
    <script>
        window.onload = function() {
            const urlParams = new URLSearchParams(window.location.search);
            const message = urlParams.get('message');
            if (message) {
                alert(message);
            }
        }
    </script>
  </head>
  <body>
    <!-- Navbar -->
    <header class="navbar">
      <div class="logo">Gataco Official Shop</div>
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="pages/HalAbout.html">About</a></li>
        <li><a href="pages/halshop.html">Shop</a></li>
      </ul>
      <ul class="buttontextlogin">
        <li><button id="open-popup-login">Login</button></li>
        <li><button id="open-popup-regis">Register</button></li>
      </ul>
    </header>

    <!-- Hero Section -->
    <section class="hero">
      <div class="hero-content">
        <div class="hero-text">
          <h1>New Collection</h1>
          <p>
            We know how large objects will act, but things on a small scale.
          </p>
          <button><a href="pages/halshop.html">Shop Now</a></button>
        </div>
        <div class="hero-image">
          <img src="asset/image/bahan2.png" alt="Fashion Model" />
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
      <div class="footer-container">
        <!-- Contact Information -->
        <div class="contact-info">
          <div class="contact-item">
            <img src="asset/image/icontlp.png" alt="Phone" class="icon" />
            <a href="tel:+1225555018">0857-2905-8285</a>
          </div>
          <div class="contact-item">
            <img src="asset/image/iconemail.png" alt="Email" class="icon" />
            <a href="Gataco.Official@gmail.com">Gataco.Official@gmail.com</a>
          </div>
        </div>

        <!-- Promo Text -->
        <div class="promo-text">Follow Us and get a chance to win 80% off</div>

        <!-- Social Media Links -->
        <div class="social-media">
          <span>Follow Us:</span>
          <a href="https://www.facebook.com/"
            ><img src="asset/image/iconfb.png" alt="Facebook" class="social-icon"
          /></a>
          <a href="https://www.instagram.com/"
            ><img src="asset/image/iconig.png" alt="Instagram" class="social-icon"
          /></a>
          <a href="https://www.youTube.com/"
            ><img src="asset/image/iconyt.png" alt="YouTube" class="social-icon"
          /></a>
        </div>
      </div>
    </footer>

    <!-- Register -->
    <div id="popupRegis" class="popup">
      <div class="popup-content">
        <span class="close-btn">&times;</span>
        <form method="POST" action="index.php">
          <h2>Register !</h2>
          <input type="text" name="name" placeholder="Name" required />
          <input type="email" name="email" placeholder="Email" required />
          <input type="password" name="password" placeholder="Password" required />
          <input type="password" name="confirmpassword" placeholder="Confirm Password" required />
          <button type="submit" name="register">Register</button>
        </form>
      </div>
    </div>

    <!-- Login -->
    <div id="popupLogin" class="popup">
      <div class="popup-content">
        <span class="close-btn">&times;</span>
        <form method="POST" action="index.php">
          <h2>Login !</h2>
          <input type="email" name="email" placeholder="Email" required />
          <input type="password" name="password" placeholder="Password" required />
          <button type="submit" name="login">Login</button>
        </form>
      </div>
    </div>

    <div id="successPopup" class="modal">
      <div class="modal-content">
        <span class="close">&times;</span>
        <p>Data berhasil disimpan!</p>
      </div>
    </div>
    <script src="asset/javascript/script.js"></script>
  </body>
</html>
