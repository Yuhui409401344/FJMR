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

<!-- icons -->
<link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />
  
  <style class="list-search-style"></style>
</head>
  <!--Navbar-->
<?php require "nav.php" ?>

<body>
  
  
<!-- Start your project here--> 

<?php require "../home/carousel.php" ?>


<div>
  <nav aria-label="breadcrumb" >
    <ol class="breadcrumb" style="background-color:#e9ecef;height:48px;color:#9ba1a7;font-size:1rem; font-family:roboto">
      <li><a href="home.php" style="color:#9ba1a7">&nbsp; &nbsp; FJMR &nbsp; &nbsp;/&nbsp; &nbsp; </a></li>
      <li>Articles &nbsp; / &nbsp;</li>
      <li>All</li>
    </ol>
    </nav>
</div>


<div class="container-fluid">

    <div class="col-12">
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