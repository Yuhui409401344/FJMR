<?php 
session_start();
if(isset($_SESSION["account"]["login"])){
    $password=$_SESSION["account"]["password"];
    $login=$_SESSION["account"]["login"];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>輔仁管理評論</title>
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

<header style="margin-bottom:55px">
<!--Navbar-->
<nav class="navbar navbar-expand-lg navbar-dark mdb-color darken-2  fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="home.php">輔仁管理評論</a>
            <!-- Collapse button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
                aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Collapsible content -->
            <div class="collapse navbar-collapse" id="basicExampleNav">
                <!-- Links -->
                <ul class="navbar-nav mr-auto" style="font-size:initial">
                <li class="nav-item dropdown">
                    <a data-toggle="dropdown" class="nav-link w-100" aria-haspopup="true" aria-expanded="false" >
                        <span >關於<i class="mdi mdi-chevron-down"></i> </span>
                    </a>
                    <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                      <a class="dropdown-item" href="purpose.php">成立宗旨</a>
                      <a class="dropdown-item" href="editors.php">編輯群</a>
                      <a class="dropdown-item" href="subscribe.php">訂閱方式</a>
                    </div>
                </li>
                
                <li class="nav-item dropdown">
                    <a data-toggle="dropdown" class="nav-link w-10" aria-haspopup="true" aria-expanded="false" >投稿<i class="mdi mdi-chevron-down"></i> </a>
                    <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="papersubmission.php">徵稿說明</a>
                    <a class="dropdown-item" href="format.php">稿約格式</a>
                    </div>
                </li>
                <li class="nav-item">
                      <a class="nav-link waves-effect waves-light" href="All.php">所有刊物</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link waves-effect waves-light" href="contact.php">聯繫我們</a>
                </li>
                </ul>
            
             
                <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <?php
                    if(isset($_SESSION["account"]["login"]) && $login !=""){
                    ?>
                        <a data-toggle="dropdown" class="nav-link" aria-haspopup="true" aria-expanded="false" style="font-size:14px;"><i class="fas fa-user-alt"></i><?php echo $login ?><i class="mdi mdi-chevron-down"></i> </a>
                        <div class="dropdown-menu dropdown-primary">
                    <?php 
                        $pdo=new PDO('mysql:host=localhost;dbname=fjup;charset=utf8','root', '');
                        $sql=$pdo->query("select status from account where login='".$login."'");
                        foreach($sql as $row){
                            $status=$row["status"];
                        
                            if($status=="投稿者"){
                            ?>
                            <a class="dropdown-item" href="../投稿者/format.php" style="font-size:14px;">
                            投稿者系統
                            </a>
                            <?php
                            }elseif($status=="審稿者"){
                            ?>
                            <a class="dropdown-item" href="../審稿者/dashboard.php" style="font-size:14px;">
                            審稿者系統
                            </a>
                            <?php
                            }else{
                            ?>
                            <a class="dropdown-item" href="../管理者/index.php?method=maildistribution" style="font-size:14px;">
                            管理者系統
                            </a>
                            <?php
                            }
                        }
                        ?>
                        <a href="../login/logout-output.php" class="dropdown-item notify-item" style="font-size:14px;">
                            <span>登出</span>
                        </a>
                        </div>
                    <?php 

                    }else{
                        ?>
                        <a class="nav-link" href="../login/login.php" style="font-size:14px;">
                            <i class="fas fa-sign-in-alt"></i> 登入
                        </a>
                    <?php
                    }
                    ?>
                </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://www.management.fju.edu.tw/" style="font-size: 14px;">
                            <i class="fas fa-graduation-cap"></i> 輔大管理學院
                        </a>
                    </li>
                    </li>
                        <a class="nav-link waves-effect waves-light" style="font-size: small;" href="../home(en)/home.php">English</a>
                    </li>
                </ul>
                </div>
          </div>
     
        </nav>
        <!-- Navbar -->
</header>
<?php require "../home/carousel.php" ?>
<body>
 
<div>
  <nav aria-label="breadcrumb" >
    <ol class="breadcrumb" style="margin-bottom: 0px;background-color:#e9ecef;height:48px;color:#9ba1a7;font-size:1rem; font-family:roboto">
      <li><a href="home.php" style="color:#9ba1a7">&nbsp &nbsp 輔仁管理評論 &nbsp &nbsp/&nbsp &nbsp </a></li>
      <li>瀏覽 &nbsp / &nbsp</li>
      <li>所有刊物</li>
    </ol>
    </nav>
</div>


<div class="container-fluid">

    <div class="col-12 mt-1">
          <div class="card-box">
              

              <div class="mb-2">
                  <div class="row">
                      <div class="col-12 text-sm-center form-inline">
                          <div class="form-group mr-2">
                              <select id="demo-foo-filter-status" class="custom-select custom-select-sm">
                                  <option value="">全部</option>
                                  <option value="第一卷">第一卷</option>
                                  <option value="第二卷">第二卷</option>
                                  <option value="第三卷">第三卷</option>
                                  <option value="第四卷">第四卷</option>
                              </select>
                          </div>
                          <div class="form-group mr-2">
                              <select id="demo-foo-filter-status2" class="custom-select custom-select-sm">
                                  <option value="">全部</option>
                                  <option value="第一期">第一期</option>
                                  <option value="第二期">第二期</option>
                                  <option value="第三期">第三期</option>
                                  <option value="第四期">第四期</option>
                              </select>
                          </div>
                          <div class="form-group">
                              <input id="demo-foo-search" type="text" placeholder="Search" class="form-control form-control-sm" autocomplete="on">
                          </div>
                      </div>
                  </div>
              </div>
              
              <div class="table-responsive">
                  <table id="demo-foo-filtering" class="table table-bordered toggle-circle mb-0" data-page-size="7">
                      <thead>
                      <tr>
                          <th data-toggle="true">卷數</th>
                          <th>期數</th>
                          <th data-hide="phone">標題</th>
                          <th data-hide="phone, tablet">作者</th>
                          <th data-hide="phone, tablet">摘要</th>
                      </tr>
                      </thead>
                      <tbody>
                      <tr>
                          <td>第二卷</td>
                          <td>第一期</td>
                          <td>鮭魚返鄉：玉山下中生農微型農企業創業的責任與動力</td>
                          <td>22 Jun 1972</td>
                          <td><span class="badge label-table badge-success">Active</span></td>
                      </tr>
                      <tr>
                          <td>Shona</td>
                          <td>Woldt</td>
                          <td>Airline Transport Pilot</td>
                          <td>3 Oct 1981</td>
                          <td><span class="badge label-table badge-secondary">Disabled</span></td>
                      </tr>
                      <tr>
                          <td>Granville</td>
                          <td>Leonardo</td>
                          <td>Business Services Sales Representative</td>
                          <td>19 Apr 1969</td>
                          <td><span class="badge label-table badge-danger">Suspended</span></td>
                      </tr>
                      <tr>
                          <td>Easer</td>
                          <td>Dragoo</td>
                          <td>Drywall Stripper</td>
                          <td>13 Dec 1977</td>
                          <td><span class="badge label-table badge-success">Active</span></td>
                      </tr>
                      <tr>
                          <td>Maple</td>
                          <td>Halladay</td>
                          <td>Aviation Tactical Readiness Officer</td>
                          <td>30 Dec 1991</td>
                          <td><span class="badge label-table badge-danger">Suspended</span></td>
                      </tr>
                      <tr>
                          <td>Maxine</td>
                          <td><a href="#">Woldt</a></td>
                          <td><a href="#">Business Services Sales Representative</a></td>
                          <td>17 Oct 1987</td>
                          <td><span class="badge label-table badge-secondary">Disabled</span></td>
                      </tr>
                      <tr>
                          <td>Lorraine</td>
                          <td>Mcgaughy</td>
                          <td>Hemodialysis Technician</td>
                          <td>11 Nov 1983</td>
                          <td><span class="badge label-table badge-secondary">Disabled</span></td>
                      </tr>
                      <tr>
                          <td>Lizzee</td>
                          <td><a href="#">Goodlow</a></td>
                          <td>Technical Services Librarian</td>
                          <td>1 Nov 1961</td>
                          <td><span class="badge label-table badge-danger">Suspended</span></td>
                      </tr>
                      <tr>
                          <td>Judi</td>
                          <td>Badgett</td>
                          <td>Electrical Lineworker</td>
                          <td>23 Jun 1981</td>
                          <td><span class="badge label-table badge-success">Active</span></td>
                      </tr>
                      <tr>
                          <td>Lauri</td>
                          <td>Hyland</td>
                          <td>Blackjack Supervisor</td>
                          <td>15 Nov 1985</td>
                          <td><span class="badge label-table badge-danger">Suspended</span></td>
                      </tr>
                      <tr>
                          <td>Isidra</td>
                          <td>Boudreaux</td>
                          <td>Traffic Court Referee</td>
                          <td>22 Jun 1972</td>
                          <td><span class="badge label-table badge-success">Active</span></td>
                      </tr>
                      <tr>
                          <td>Shona</td>
                          <td>Woldt</td>
                          <td>Airline Transport Pilot</td>
                          <td>3 Oct 1981</td>
                          <td><span class="badge label-table badge-secondary">Disabled</span></td>
                      </tr>
                      <tr>
                          <td>Granville</td>
                          <td>Leonardo</td>
                          <td>Business Services Sales Representative</td>
                          <td>19 Apr 1969</td>
                          <td><span class="badge label-table badge-danger">Suspended</span></td>
                      </tr>
                      <tr>
                          <td>Easer</td>
                          <td>Dragoo</td>
                          <td>Drywall Stripper</td>
                          <td>13 Dec 1977</td>
                          <td><span class="badge label-table badge-success">Active</span></td>
                      </tr>
                      <tr>
                          <td>Maple</td>
                          <td>Halladay</td>
                          <td>Aviation Tactical Readiness Officer</td>
                          <td>30 Dec 1991</td>
                          <td><span class="badge label-table badge-danger">Suspended</span></td>
                      </tr>
                      <tr>
                          <td>Maxine</td>
                          <td><a href="#">Woldt</a></td>
                          <td><a href="#">Business Services Sales Representative</a></td>
                          <td>17 Oct 1987</td>
                          <td><span class="badge label-table badge-secondary">Disabled</span></td>
                      </tr>
                      <tr>
                          <td>Lorraine</td>
                          <td>Mcgaughy</td>
                          <td>Hemodialysis Technician</td>
                          <td>11 Nov 1983</td>
                          <td><span class="badge label-table badge-secondary">Disabled</span></td>
                      </tr>
                      <tr>
                          <td>Lizzee</td>
                          <td><a href="#">Goodlow</a></td>
                          <td>Technical Services Librarian</td>
                          <td>1 Nov 1961</td>
                          <td><span class="badge label-table badge-danger">Suspended</span></td>
                      </tr>
                      <tr>
                          <td>Judi</td>
                          <td>Badgett</td>
                          <td>Electrical Lineworker</td>
                          <td>23 Jun 1981</td>
                          <td><span class="badge label-table badge-success">Active</span></td>
                      </tr>
                      <tr>
                          <td>Lauri</td>
                          <td>Hyland</td>
                          <td>Blackjack Supervisor</td>
                          <td>15 Nov 1985</td>
                          <td><span class="badge label-table badge-danger">Suspended</span></td>
                      </tr>
                      <tr>
                          <td>Isidra</td>
                          <td>Boudreaux</td>
                          <td>Traffic Court Referee</td>
                          <td>22 Jun 1972</td>
                          <td><span class="badge label-table badge-success">Active</span></td>
                      </tr>
                      <tr>
                          <td>Shona</td>
                          <td>Woldt</td>
                          <td>Airline Transport Pilot</td>
                          <td>3 Oct 1981</td>
                          <td><span class="badge label-table badge-secondary">Disabled</span></td>
                      </tr>
                      <tr>
                          <td>Granville</td>
                          <td>Leonardo</td>
                          <td>Business Services Sales Representative</td>
                          <td>19 Apr 1969</td>
                          <td><span class="badge label-table badge-danger">Suspended</span></td>
                      </tr>
                      <tr>
                          <td>Easer</td>
                          <td>Dragoo</td>
                          <td>Drywall Stripper</td>
                          <td>13 Dec 1977</td>
                          <td><span class="badge label-table badge-success">Active</span></td>
                      </tr>
                      <tr>
                          <td>Maple</td>
                          <td>Halladay</td>
                          <td>Aviation Tactical Readiness Officer</td>
                          <td>30 Dec 1991</td>
                          <td><span class="badge label-table badge-danger">Suspended</span></td>
                      </tr>
                      <tr>
                          <td>Maxine</td>
                          <td><a href="#">Woldt</a></td>
                          <td><a href="#">Business Services Sales Representative</a></td>
                          <td>17 Oct 1987</td>
                          <td><span class="badge label-table badge-secondary">Disabled</span></td>
                      </tr>
                      <tr>
                          <td>Lorraine</td>
                          <td>Mcgaughy</td>
                          <td>Hemodialysis Technician</td>
                          <td>11 Nov 1983</td>
                          <td><span class="badge label-table badge-secondary">Disabled</span></td>
                      </tr>
                      <tr>
                          <td>Lizzee</td>
                          <td><a href="#">Goodlow</a></td>
                          <td>Technical Services Librarian</td>
                          <td>1 Nov 1961</td>
                          <td><span class="badge label-table badge-danger">Suspended</span></td>
                      </tr>
                      <tr>
                          <td>Judi</td>
                          <td>Badgett</td>
                          <td>Electrical Lineworker</td>
                          <td>23 Jun 1981</td>
                          <td><span class="badge label-table badge-success">Active</span></td>
                      </tr>
                      <tr>
                          <td>Lauri</td>
                          <td>Hyland</td>
                          <td>Blackjack Supervisor</td>
                          <td>15 Nov 1985</td>
                          <td><span class="badge label-table badge-danger">Suspended</span></td>
                      </tr>
                      </tbody>
                      <tfoot>
                      <tr class="active">
                          <td colspan="5">
                              <div class="text-right">
                                  <ul class="pagination pagination-rounded justify-content-end footable-pagination m-t-10 mb-0"></ul>
                              </div>
                          </td>
                      </tr>
                      </tfoot>
                  </table>
              </div> <!-- end .table-responsive-->
          </div> <!-- end card-box -->
    </div> <!-- end col -->

</div>


<!-- Footer -->
<footer class="page-footer font-small mdb-color lighten-3 pt-2">

  <!-- Footer Links -->
  <div class="container-fluid text-center text-md-left">

    <!-- Grid row -->
    <div class="row">

      <!-- Grid column -->
      <div class="col-md-4 mt-md-0 mt-3">

        <!-- Content -->
        <h5 class="text-uppercase" style="font-family:roboto; color:#ffffff; font-size:20px">連絡我們</h5></br>
        <p style="color: white;">輔仁大學管理學院 邱瑞真秘書</p>
        <p style="color: white;"><a href="mailto:fjreview@mail.fju.edu.tw">fjreview@mail.fju.edu.tw</a></p>
        <p><a href="tel:886229052000">TEL: (02) 2905-2000</a></p>
        <p><a href="fax:0229052186">FAX: (02) 2905-2186</a></p>

      </div>
      <!-- Grid column -->

      <hr class="clearfix w-100 d-md-none pb-3">

      <!-- Grid column -->
      <div class="col-md-4 mb-md-0 mb-3">

        <!-- Links -->
        <h5 class="text-uppercase" style="font-family:roboto; color:#ffffff; font-size:20px">相關連結</h5></br>
          <p>
            <a href="http://alumni.fju.edu.tw/" target="blank">輔仁大學校友資料庫</a>
          </p>
          <p>
            <a href="http://research.fju.edu.tw/admin/login" target="blank">研究人才資料庫</a>
          </p>
          <p>
            <a href="http://www.grb.gov.tw/" target="blank">政府研究資訊系統(GRB)</a>
          </p>
        

      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-md-4 mb-md-0 mb-3">

        <!-- Links -->
        <h5 class="text-uppercase" style="font-family:roboto; color:#ffffff; font-size:20px">學術資料庫</h5></br>
          <p>
            <a href="https://ndltd.ncl.edu.tw/cgi-bin/gs32/gsweb.cgi?o=dnclcdr&amp;s=id=%22089SHU05389001%22.&amp;searchmode=basic" target="blank">博碩士論文行動網</a>
          </p>
          <p>
          <a href="https://www.airitilibrary.com/" target="blank">華藝線上圖書館</a>
          </p>
          <p>
            <a href="https://www.oxfordeconomics.com/" target="blank">Oxford Economics</a>
          </p>
          
        

      </div>
      <!-- Grid column -->

    </div>
    <!-- Grid row -->

  </div>
  <!-- Footer Links -->

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">©<?php echo date("Y"); ?> Copyright:
    <a href="http://www.fju.edu.tw/"> 輔仁大學</a>
  </div>
  <!-- Copyright -->

</footer>
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



</body>

</html>
