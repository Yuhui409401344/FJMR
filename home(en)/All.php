<?php
session_start();
if (isset($_SESSION["account"]["login"])) {
  $password = $_SESSION["account"]["password"];
  $login = $_SESSION["account"]["login"];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="icon" href="img/logo-FJMR.ico" type="image/x-icon">
  <title>FJMR</title>
  <!-- App favicon -->
  <link rel="shortcut icon" href="../assets/images/favicon.ico">

  <!-- Material Design Bootstrap -->
  <link rel="stylesheet" href="css/mdb.min.css">
  <!-- App css -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
  <link href="../assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

  <link href="../assets/css/bootstrap-dark.min.css" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
  <link href="../assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />

  <!-- icons -->
  <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="css/style.css">

  <style class="list-search-style"></style>
</head>
<!--Navbar-->
<?php require "nav.php" ?>

<body>


  <!-- Start your project here-->

  <?php require "../home/carousel.php" ?>

  <style type="text/css">
    .navbar .dropdown-menu {
      background-color: #2e3951;
      border-top: 0px;
    }

    #change {
      color: #fff;
      ;
    }

    #change:hover {
      color: black
    }
  </style>
  <div>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb" style="background-color:#e9ecef;height:48px;color:#9ba1a7;font-size:1rem; font-family:roboto">
        <li><a href="home.php" style="color:#9ba1a7">&nbsp; &nbsp; FJMR &nbsp; &nbsp;/&nbsp; &nbsp; </a></li>
        <li>Articles &nbsp; / &nbsp;</li>
        <li>All</li>
      </ol>
    </nav>
  </div>


  <div class="container-fluid">
    <div class="col-12 mt-1" style="position:relative;width:100%;height:300px;padding-bottom:50%">
      <iframe src="http://www.management.fju.edu.tw/zh-tw/research/journal.php" style="position:absolute;top:0;left:0;width:100%;height:100%" onload=""></iframe>
    </div>
  </div>





  <!-- Footer -->
  <?php require "footer.php" ?>
  <!-- Footer -->
  <!--/Dropdown primary-->
  <!-- End your project here-->

  <!-- Right bar overlay-->
  <div class="rightbar-overlay"></div>


  <!-- Vendor js -->
  <script src="../assets/js/vendor.min.js"></script>

  <!-- Footable js -->
  <script src="../assets/libs/footable/footable.all.min.js"></script>

  <!-- Init js -->
  <script src="../assets/js/pages/foo-tables.init.js"></script>

  <!-- App js -->
  <script src="../assets/js/app.min.js"></script>

</html>