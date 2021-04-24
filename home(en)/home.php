<?php 
session_start();
if(isset($_SESSION["account"]["login"])){
    $password=$_SESSION["account"]["password"];
    $login=$_SESSION["account"]["login"];
}

?>

<html lang="en">
    <head>
        <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>FJMR</title>
  <!-- MDB icon -->
  <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <!-- Google Fonts Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- MDBootstrap Datatables  -->
  <link href="css/addons/datatables.min.css" rel="stylesheet">
    <!-- Bootstrap Tables css -->
    <link href="../assets/libs/bootstrap-table/bootstrap-table.min.css" rel="stylesheet" type="text/css" />

  <!-- Material Design Bootstrap -->
  <link rel="stylesheet" href="css/mdb.min.css">
  <!-- Your custom styles (optional) -->
  <link rel="stylesheet" href="css/style.css">





  <style class="list-search-style"></style>
<style>
    html,
    body,
    header,
    .view {
    height: 100%;
    }

    @media (max-width: 740px) {
    html,
    body,
    header,
    .view {
        height: 100vh;
    }
    }

    .top-nav-collapse {
    background-color: #78909c !important;
    }

    .navbar:not(.top-nav-collapse) {
    background: transparent !important;
    }

    @media (max-width: 991px) {
    .navbar:not(.top-nav-collapse) {
        background: #78909c !important;
    }
    }

    h1 {
    letter-spacing: 8px;
    }

    h5 {
    letter-spacing: 3px;
    }

    .hr-light {
    border-top: 3px solid #fff;
    width: 80px;
    }
</style>
</head>
<body>

    <header>
        <!--Navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top scrolling-navbar">
        <div class="container">
            <a class="navbar-brand" href="home.php">FJMR</a>
            <!-- Collapse button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
                aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Collapsible content -->
            <div class="collapse navbar-collapse" id="basicExampleNav">
                <!-- Links -->
                <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a data-toggle="dropdown" class="nav-link w-100 dropdown-toggle" aria-haspopup="true" aria-expanded="false" >
                        <i class="mdi mdi-pencil" style="color:#fff; font-size:3px;"></i>
                        <span >About</span>
                    </a>
                    <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                      <a class="dropdown-item" href="purpose.php">Aim and Scope</a>
                      <a class="dropdown-item" href="editors.php">Editorial Board</a>
                      <a class="dropdown-item" href="subscribe.php">Subscribe</a>
                    </div>
                </li>
            
                <li class="nav-item dropdown">
                    <a data-toggle="dropdown" class="nav-link w-100 dropdown-toggle" aria-haspopup="true" aria-expanded="false" >Submission</a>
                    <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="papersubmission.php">Guideline & Process</a>
                    <a class="dropdown-item" href="format.php">Format</a>
                    </div>
                </li>
                <li class="nav-item">
                      <a class="nav-link waves-effect waves-light" href="All.php">Articles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link waves-effect waves-light" href="contact.php">Contact Us</a>
                </li>
                </ul>
            
                <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <?php
                    if(isset($_SESSION["account"]["login"]) && $login != ""){
                    ?>
                        <a data-toggle="dropdown" class="nav-link  dropdown-toggle" aria-haspopup="true" aria-expanded="false" style="font-size: small;"><i class="fas fa-user-alt"></i><?php echo $login ?></a>
                        <div class="dropdown-menu dropdown-primary">
                    <?php 
                        $pdo=new PDO('mysql:host=localhost;dbname=fjup;charset=utf8','root', '');
                        $sql=$pdo->query("select status from account where login='".$login."'");
                        foreach($sql as $row){
                            $status=$row["status"];
                        
                            if($status=="投稿者"){
                            ?>
                            <a class="dropdown-item" href="../投稿者/format.php?login=<? echo $login?>" style="font-size: small;">
                            Author System
                            </a>
                            <?php
                            }elseif($status=="審稿者"){
                            ?>
                            <a class="dropdown-item" href="../審稿者/dashboard.php?login=<? echo $login?>" style="font-size: small;">
                            Reviewer System
                            </a>
                            <?php
                            }else{
                            ?>
                            <a class="dropdown-item" href="../管理者/maildistribution.php?login=<? echo $login?>" style="font-size: small;">
                            Manager System
                            </a>
                            <?php
                            }
                        }
                        ?>
                        <a href="../login/logout-output.php" class="dropdown-item notify-item" style="font-size: small;">
                            <span>Log Out</span>
                        </a>
                        </div>
                    <?php 

                    }else{
                        ?>
                        <a class="nav-link" href="../login/login.php" style="font-size: small;">
                            <i class="fas fa-sign-in-alt"></i> LogIn
                        </a>
                    <?php
                    }
                    ?>
                </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://www.management.fju.edu.tw/" target="blank" style="font-size: small;">
                            <i class="fas fa-graduation-cap"></i> FJUM
                        </a>
                    </li>
                    </li>
                        <a class="nav-link waves-effect waves-light" style="font-size: small;"  href="../home/home.php">中文</a>
                    </li>
                </ul>
                </div>
            </div>
            </div>
            </nav>
        <!-- Navbar -->
        <!-- Full Page Intro -->
        <div class="view" style="background-image: url('https://mdbootstrap.com/img/Photos/Horizontal/Nature/full page/img(11).jpg'); background-repeat: no-repeat; background-size: cover; background-position: center center;">
        <!-- Mask & flexbox options-->
        <div class="mask rgba-black-light align-items-center">
            <!-- Content -->
            <div class="container">
            <!--Grid row-->
            <div class="row">
                <!--Grid column-->
                <div class="col-md-12 mb-4 white-text text-center" style="margin-top: 170px;">
                <h1 class="h1-reponsive white-text text-uppercase font-weight-bold mb-0 pt-md-5 pt-5 wow fadeInDown" data-wow-delay="0.3s"><strong>Fu Jen Management Review</strong></h1>
                <hr class="hr-light my-4 wow fadeInDown" data-wow-delay="0.4s">
                <h5 class="text-uppercase mb-4 white-text wow fadeInDown" data-wow-delay="0.4s"><strong>TODAY'S RESEARCH, TOMORROW'S INNOVATION.</strong></h5>
                <a class="btn btn-outline-white wow fadeInDown" data-wow-delay="0.4s" href="All.php">Articles</a>
                <a class="btn btn-outline-white wow fadeInDown" data-wow-delay="0.4s" href="purpose.php">About</a>
                </div>
                <!--Grid column-->
            </div>
            <!--Grid row-->
            </div>
            <!-- Content -->
        </div>
        <!-- Mask & flexbox options-->
        </div>
        <!-- Full Page Intro -->
    </header>
        <!-- Main navigation -->
        <!--Main Layout-->
        <div class="content mt-4">
        <!-- Start Content-->
        <div class="container-fluid">   

            <div class="row mb-3">
                <div class="col-lg-4 mb-3">
                    <div class="card" style="height:215px; text-align:justify">
                        <div class="card-body">
                            <h4 class="card-title">Enterprise and Society</h4>
                            <p class="card-text">We provide abundant opportunities for collaboration between industry and school, if you are interested in cooperation, please contact us.</p>
                            <ul class="rlist" >
                                <li><a href="產學合作.php" target="_blank" rel="noopener">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                </div> <!-- end col -->

                <div class="col-lg-4 mb-3">
                    <div class="card" style="height:215px">
                        <div class="card-body">
                            <h4 class="card-title">Researcher</h4>
                            <p class="card-text">It's our honor to provide journal articles in all business fields at Fu Jen Catholic University to support your research progress.</p>
                            <ul class="rlist" >
                                <li><a href="All.php">Articles</a></li>
                            </ul>
                        </div>
                    </div>
                </div> <!-- end col -->

                <div class="col-lg-4 mb-3">
                    <div class="card" style="height:215px">
                        <div class="card-body">
                            <h4 class="card-title">Author</h4>
                            <p class="card-text">Your research will bring changes to the world.</p>
                            <ul class="rlist" >
                                <li><a href="徵稿.php" target="_blank" rel="noopener">Guideline & Process</a></li>
                                <li><a href="稿約格式.php" target="_blank" rel="noopener">Format</a></li>
                            </ul>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end row -->   
            <div class="row mb-6 mt-5" style="min-height:278px">
                <div class="col-lg-8">
                    <table class="table table-hover">
                        <div class="title_list ml-3" style="font-size: large;color: darkred;">
                            <i class="fas fa-bell"></i> &nbsp;Latest Article
                        </div>
                        
                        <tbody>
                            <?php
                                                            
                                $pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
                                foreach ($pdo->query('select * from newpaper') as $row) {
                                    $title=$row['title'];
                                    $uploadtime=$row['uploadtime'];

                            ?>
                            <tr>
                                <td><i class="fas fa-caret-right"></i></td>
                                <td><?php echo $title ?></td>
                                <td><?php echo $uploadtime ?></td>
                            </tr>              
                            <?php 
                                }
                            ?>                  
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- container -->

<?php require "footer.php" ?>
        <!-- jQuery -->
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <!-- Your custom scripts (optional) -->
  <script type="text/javascript"></script>
  <!-- MDBootstrap Datatables  -->
  <script type="text/javascript" src="js/addons/datatables.min.js"></script>

<script>
// Animations init
new WOW().init();
</script>
</body>
</html>