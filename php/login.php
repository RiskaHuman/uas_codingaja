<?php
session_start();

// Set string CAPTCHA
$_SESSION['captcha'] = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'), 0, 6);

// Cek jika form login telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai input dari form
    $username = $_POST['user'];
    $password = $_POST['pwd'];
    $captcha = $_POST['captcha'];

    // Verifikasi CAPTCHA
    if ($captcha !== $_SESSION['captcha']) {
        $error = "CAPTCHA salah!";
    } else {
        // Proses verifikasi username dan password
        // Contoh sederhana: cek jika username dan password adalah 'admin'
        if ($username === 'admin' && $password === 'admin') {
            // Redirect ke halaman beranda jika login berhasil
            header("Location: beranda.php");
            exit;
        } else {
            $error = "Username atau password salah!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en" itemscope itemtype="http://schema.org/WebPage">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login</title>
  <!-- Fonts and icons -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/material-kit.css?v=3.0.4" rel="stylesheet" />
</head>
<body>
  <div class="page-header align-items-start min-vh-100" style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');" loading="lazy">
    <span class="mask bg-gradient-dark opacity-6"></span>
    <div class="container my-auto">
      <div class="row">
        <div class="col-lg-4 col-md-8 col-12 mx-auto">
          <div class="card z-index-0 fadeIn3 fadeInBottom">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
              <?php if (isset($error)) echo "<p>$error</p>"; ?>
                <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Sign in</h4>
                <div class="row mt-3">
                  <div class="col-2 text-center ms-auto">
                    <a class="btn btn-link px-3" href="javascript:;">
                      <i class="fa fa-facebook text-white text-lg"></i>
                    </a>
                  </div>
                  <div class="col-2 text-center me-auto">
                    <a class="btn btn-link px-3" href="javascript:;">
                      <i class="fa fa-google text-white text-lg"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form role="form" class="text-start">
                <div class="input-group input-group-outline my-3">
                  <label class="form-label">Username</label>
                  <input type="email" class="form-control" id="user">
                </div>
                <div class="input-group input-group-outline mb-3">
                  <label class="form-label">Password</label>
                  <input type="password" class="form-control" id="pwd">
                </div>
                <div class="form-check form-switch d-flex align-items-center mb-3">
                  <input class="form-check-input" type="checkbox" id="rememberMe" checked>
                  <label class="form-check-label mb-0 ms-3" for="rememberMe">Remember me</label>
                </div>
                <div class="input-group input-group-outline mb-3">
                <img src="data:image/jpeg;base64,<?= base64_encode(file_get_contents('https://dummyimage.com/120x40/000/fff&text='.$_SESSION['captcha'])) ?>"><br>
                <input type="text" id="captcha" name="captcha">
                </div>
                <div class="text-center">
                  <button type="button" class="btn bg-gradient-primary w-100 my-4 mb-2" onclick="login()">Sign in</button>
                </div>
                <p class="mt-4 text-sm text-center">
                  Don't have an account? <a href="register.php">Register</a>
                </p>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <footer class="footer position-absolute bottom-2 py-2 w-100">
    <div class="container">
      <div class="row align-items-center justify-content-lg-between">
        <div class="col-12 col-md-6 my-auto">
        <div class="col-12">
        
        </div>
      </div>
    </div>
  </footer>
        <div class="text-center">
          <p class="text-dark my-4 text-sm font-weight-normal">
            Copyright © <script>document.write(new Date().getFullYear())</script> 21552011098_M Wipaldi Nurpadilah_KELOMPOK3_TIFRP-221PA <a href="" target="_blank">UASWEB1</a>.
          </p>
        </div>


<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
  function login() {
    const username = document.getElementById('user').value;
    const password = document.getElementById('pwd').value;

    const formData = new FormData();
    formData.append('user', username);
    formData.append('pwd', password);

    axios.post('https://client-server-wifal.000webhostapp.com/login.php', formData)
      .then(response => {
        if (response.data.status == 'success') {
          const sessionToken = response.data.session_token; // Corrected session token variable name
          localStorage.setItem('session_token', sessionToken);
          window.location.href = 'index.php';
        } else {
          alert('Login failed. Please check your credentials.');
        }
      })
      .catch(error => {
        console.error('Error during login:', error);
        alert('An error occurred during login. Please try again later.');
      });
  }
</script>



</body>
</html>
