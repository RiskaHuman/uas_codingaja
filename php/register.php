<?php
session_start();

// Generate CSRF Token
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Proses pendaftaran jika formulir disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi CSRF Token
    if (!empty($_POST['csrf_token']) && hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        // Lakukan proses pendaftaran jika token valid
        // Ambil nilai input dari form
        $username = $_POST['username'];
        $password = $_POST['password'];
        $name = $_POST['name'];

        // Lakukan validasi data, lakukan proses pendaftaran, dll.
    } else {
        // Token CSRF tidak valid, lakukan tindakan yang sesuai
        die("Invalid CSRF token!");
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
                <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Register</h4>
                <div class="row mt-3">
                  <div class="col-2 text-center ms-auto">
                    <a class="btn btn-link px-3" href="javascript:;">
                      <i class=""></i>
                    </a>
                  </div>
                  <div class="col-2 text-center me-auto">
                    <a class="btn btn-link px-3" href="javascript:;">
                      <i class=""></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form role="form" class="text-start" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="input-group input-group-outline my-3">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
                  <label class="form-label">Username</label>
                  <input type="email" class="form-control" id="username">
                </div>
                <div class="input-group input-group-outline mb-3">
                  <label class="form-label">Password</label>
                  <input type="password" class="form-control" id="pasword">
                </div>
                <div class="input-group input-group-outline my-3">
                  <label class="form-label">name</label>
                  <input type="name" class="form-control" id="name">
                </div>
            </div>

            <div class="text-center">
              <button type="button" class="btn bg-gradient-primary w-100 my-4 mb-2" onclick="login()">Register</button>
              <div class="text-center">
                <p class="mt-3 mb-0">Forgot Password?</p>
                <p class="mb-0">Already have an account? <a href="login.php">Sign in</a></p>
              </div>
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

        </div>
      </div>
    </div>
  </footer>
  <div class="col-12">
    <div class="text-center">
      <p class="text-dark my-4 text-sm font-weight-normal">
        Copyright © <script>
          document.write(new Date().getFullYear())
        </script> 21552011098_M Wipaldi Nurpadilah_KELOMPOK3_TIFRP-221PA <a href="" target="_blank">UASWEB1</a>.
      </p>
    </div>

    <!-- Core JS Files -->
    <script src="../assets/js/core/popper.min.js" type="text/javascript"></script>
    <script src="../assets/js/core/bootstrap.min.js" type="text/javascript"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/material-kit.min.js?v=3.0.4" type="text/javascript"></script>

    <!-- Custom Script for Login -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
      function login() {
        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;
        const name = document.getElementById('name').value;


        const formData = new FormData();
        formData.append('username', username)
        formData.append('password', password);
        formData.append('', password);


      }
      document.getElementById('registerForm').addEventListener('submit', function(event) {
        event.preventDefault();
        var formData = new FormData(this);
        axios.post('https://client-server-wifal.000webhostapp.com/register.php', formData)
          .then(function(response) {
            alert(response.data.message);
            if (response.data.status === 'success') {
              window.location.href = 'login.php';
            }
          })
          .catch(function(error) {
            console.error(error);
            alert('Terjadi kesalahan, silakan coba lagi.');
          });
      });
    </script>

</body>

</html>