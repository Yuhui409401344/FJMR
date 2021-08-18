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
  <title>輔仁管理評論</title>
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
            <a class="navbar-brand" href="home.php">輔仁管理評論</a>
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
                    關於
                    </a>
                    <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                      <a class="dropdown-item" href="purpose.php">成立宗旨</a>
                      <a class="dropdown-item" href="editors.php">編輯群</a>
                      <a class="dropdown-item" href="subscribe.php">訂閱方式</a>
                    </div>
                </li>
                
                <li class="nav-item dropdown">
                    <a data-toggle="dropdown" class="nav-link w-100 dropdown-toggle" aria-haspopup="true" aria-expanded="false" >投稿</a>
                    <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="徵稿.php">徵稿說明</a>
                    <a class="dropdown-item" href="稿約格式.php">稿約格式</a>
                    </div>
                </li>

                <li class="nav-item">
                      <a class="nav-link waves-effect waves-light" href="瀏覽刊物.php">所有刊物</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link waves-effect waves-light" href="contact.php">聯繫我們</a>
                </li>
                </ul>
            
                <!-- <div class="collapse navbar-collapse" id="navbarSupportedContent-4"> -->
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
                                <a class="dropdown-item" href="../投稿者/format.php" style="font-size: small;">
                                投稿者系統
                                </a>
                                <?php
                                }elseif($status=="審稿者"){
                                ?>
                                <a class="dropdown-item" href="../審稿者/dashboard.php" style="font-size: small;">
                                審稿者系統
                                </a>
                                <?php
                                }else{
                                ?>
                                <a class="dropdown-item" href="../管理者/index.php?method=maildistribution" style="font-size: small;">
                                管理者系統
                                </a>
                                <?php
                                }
                            }
                            ?>
                            <a href="../login/logout-output.php" class="dropdown-item notify-item" style="font-size: small;">
                                <span>登出</span>
                            </a>
                            </div>
                        <?php 

                        }else{
                            ?>
                            <a class="nav-link" href="../login/login.php" style="font-size: small;">
                                <i class="fas fa-sign-in-alt"></i> 登入
                            </a>
                        <?php
                        }
                        ?>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://www.management.fju.edu.tw/" target="blank" style="font-size: small;">
                            <i class="fas fa-graduation-cap"></i> 輔大管理學院
                        </a>
                    </li>
                    </li>
                        <a class="nav-link waves-effect waves-light" style="font-size: small;" href="../home(en)/home.php">English</a>
                    </li>
                </ul>
                <!-- </div> -->
            </div>
            </div>
            </nav>
        <!-- Navbar -->
        <!-- Full Page Intro -->
        <!-- <div class="view" style="background-image: url('https://mdbootstrap.com/img/Photos/Horizontal/Nature/full page/img(11).jpg'); background-repeat: no-repeat; background-size: cover; background-position: center center;"> -->
        <div class="view" style="background-image: url('../assets/images/mountain.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center center;">
        <!-- Mask & flexbox options-->
        <div class="mask rgba-black-light align-items-center">
            <!-- Content -->
            <div class="container">
            <!--Grid row-->
            <div class="row">
                <!--Grid column-->
                <div class="col-md-12 mb-4 white-text text-center" style="margin-top: 170px;">
                <h1 class="h1-reponsive white-text text-uppercase font-weight-bold mb-0 pt-md-5 pt-5 wow fadeInDown" data-wow-delay="0.3s"><strong>輔仁管理評論</strong></h1>
                <hr class="hr-light my-4 wow fadeInDown" data-wow-delay="0.4s">
                <h5 class="text-uppercase mb-4 white-text wow fadeInDown" data-wow-delay="0.4s"><strong>TODAY'S RESEARCH, TOMORROW'S INNOVATION.</strong></h5>
                <a class="btn btn-outline-white wow fadeInDown" data-wow-delay="0.4s" href="瀏覽刊物.php">瀏覽</a>
                <a class="btn btn-outline-white wow fadeInDown" data-wow-delay="0.4s" href="purpose.php">關於</a>
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
                    <div class="card" style="height:215px">
                        <div class="card-body">
                            <h4 class="card-title">企業及社會</h4>
                            <p class="card-text">輔仁管理學院擁有豐富的產學研合作機會，如果您有意合作，請聯繫我們。</p>
                            <ul class="rlist" >
                                <li><a href="contact.php" rel="noopener">聯繫我們</a></li>
                            </ul>
                        </div>
                    </div>
                </div> <!-- end col -->

                <div class="col-lg-4 mb-3">
                    <div class="card" style="height:215px">
                        <div class="card-body">
                            <h4 class="card-title">研究員</h4>
                            <p class="card-text">我們很榮幸可以提供輔仁大學所有商業領域的期刊論文，以支持您在研究上的進步。</p>
                            <ul class="rlist" >
                                <li><a href="瀏覽刊物.php">所有刊物</a></li>
                            </ul>
                        </div>
                    </div>
                </div> <!-- end col -->

                <div class="col-lg-4 mb-3">
                    <div class="card" style="height:215px">
                        <div class="card-body">
                            <h4 class="card-title">作家</h4>
                            <p class="card-text">你的研究將會為世界帶來改變。</p>
                            <ul class="rlist" >
                                <li><a href="徵稿.php"  rel="noopener">徵稿說明</a></li>
                                <li><a href="稿約格式.php" rel="noopener">稿約格式</a></li>
                            </ul>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end row -->   
            <!-- <div class="row mb-6 mt-5" style="min-height:278px">
                <div class="col-lg-8">
                    <table class="table table-hover">
                        <div class="title_list ml-3" style="font-size: large;color: darkred;">
                            <i class="fas fa-bell"></i> &nbsp;最新論文
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
            </div> -->
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