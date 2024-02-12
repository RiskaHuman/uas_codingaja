<!DOCTYPE html>
<html lang="en" itemscope itemtype="http://schema.org/WebPage">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
   <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
   <!-- DataTables JavaScript -->
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>


  <title>
    Codingin Aja
  </title>
  <!--     Fonts and icons     -->
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
  <!-- Nepcha Analytics (nepcha.com) -->
  <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
  
  <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>

<body class="about-us bg-gray-200">
  <!-- Navbar Transparent -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand" href="#"onclick="dashboard()">CodinginAJA</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
            <a href="#" class="btn btn-sm bg-white mb-0 me-1 mt-2 mt-md-0" onclick="tambahdata()">Tambah data</a>
          </li>
          <li class="nav-item">
            <a href="#" class="btn btn-sm bg-white mb-0 me-1 mt-2 mt-md-0" onclick="keloladata()">Kelola Data</a>
          </li>
          <li class="nav-item">
            <a href="dashboard.php" class="btn btn-sm bg-white mb-0 me-1 mt-2 mt-md-0" >kembali</a>
          </li>
          <li class="nav-item">
            <a href="#" class="btn btn-sm bg-white mb-0 me-1 mt-2 mt-md-0" onclick="logout()">Log Out</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- End Navbar -->
  <!-- -------- START HEADER 7 w/ text and video ------- -->
 
       
  </footer>
  
  
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script>
function dashboard() {
  window.location.href = 'index.php';
}

function tambahdata() {
  window.location.href = 'tambah.php';
}
function keloladata() {
  window.location.href = 'kelola.php';
}



    </script>
</body>

</html>