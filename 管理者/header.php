<?php 
session_start();
$password=$_SESSION["account"]["password"];
$login=$_SESSION["account"]["login"];
?>

<!DOCTYPE html>
<html lang="en">
    
    <body class="loading">
        <!-- Begin page -->
        <div id="wrapper">
            <!-- Topbar Start -->
            <div class="navbar-custom">
                <div class="container-fluid">
                    <ul class="list-unstyled topnav-menu float-right mb-0">

                        <li class="dropdown  d-lg-inline-block">
                            <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="fullscreen" href="#">
                                <i class="fe-maximize noti-icon"></i>
                            </a>
                        </li>

                        <li class="dropdown  d-lg-inline-block topbar-dropdown">
                            <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <i class="fe-grid noti-icon"></i>
                            </a>
                            <div class="dropdown-menu dropdown-lg dropdown-menu-right">

                                <div class="p-lg-1">
                                    <div class="row no-gutters">
                                        <div class="col">
                                            <a class="dropdown-icon-item" href="http://www.management.fju.edu.tw/zh-tw/research/journal.php"  target="blank">
                                                <i class="fas fa-graduation-cap"></i>
                                                <span>輔仁管理評論</span>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a class="dropdown-icon-item" href="http://www.management.fju.edu.tw/"  target="blank" >
                                                <img src="../assets/images/logo-fju-sm.png" alt="輔仁管院">
                                                <span>輔仁管理學院</span>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a class="dropdown-icon-item" href="https://www.fju.edu.tw/"  target="blank">
                                                <img src="../assets/images/brands/fju.jpg" alt="輔仁大學">
                                                <span>輔仁大學</span>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="row no-gutters">
                                        <div class="col">
                                            <a class="dropdown-icon-item" href="https://www.dropbox.com/zh_TW/"  target="blank">
                                                <img src="../assets/images/brands/dropbox.png" alt="dropbox">
                                                <span>Dropbox</span>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a class="dropdown-icon-item" href="https://workspace.google.com/intl/zh-TW/?utm_source=google&utm_medium=cpc&utm_campaign=1009153-Workspace-APAC-TW-zh-BKWS-EXA-Golden&utm_content=CMPGN_1009153+%7C+Workspace+%7C+DR+%7C+ESS01+%7C+APAC+%7C+TW+%7C+zh+%7C+Hybrid+%7C+AW+SEM+%7C+BKWS+~+Exact+%7C+Golden-ADGP_58700006377646730-KWID_43700057629356506-TERM_g+suite&gclid=CjwKCAjwz6_8BRBkEiwA3p02VfMkZNDDDvPhmMl_W3t-3fCRDaxNHViYX9t84m7kGndt3JP23BwqLRoCJmgQAvD_BwE&gclsrc=aw.ds"  target="blank">
                                                <img src="../assets/images/brands/g-suite.png" alt="G Suite">
                                                <span>Google workspace</span>
                                            </a>
                                        </div>
                            
                                    </div>
                                </div>

                            </div>
                        </li>
                        
                        <li class="dropdown notification-list topbar-dropdown">
                            <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <span>
                                <?php echo $login ?><i class="mdi mdi-chevron-down"></i> 
                                </span>
                            </a>
                            
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                <?php 
                            $pdo=new PDO('mysql:host=localhost;dbname=fjup;charset=utf8','root', '');
                            $sql=$pdo->query("select status from account where login='".$login."'");
                            foreach($sql as $row){
                                $status=$row["status"];
                            
                                if($status=="投稿者"){
                                ?>
                                <a class="dropdown-item" href="../投稿者/format.php" style="font-size: small;">
                                <i class="fe-user"></i>
                                投稿者系統
                                </a>
                                <?php
                                }elseif($status=="審稿者"){
                                ?>
                                <a class="dropdown-item" href="../審稿者/dashboard.php" style="font-size: small;">
                                <i class="fe-user"></i>
                                審稿者系統
                                </a>
                                <?php
                                }else{
                                ?>
                                <a class="dropdown-item" href="../管理者/index.php?method=maildistribution" style="font-size: small;">
                                <i class="fe-user"></i>
                                管理者系統
                                </a>
                                <?php
                                }
                            }
                            ?>
                            <div class="dropdown-divider"></div>

                            <a href="profile.php" class="dropdown-item notify-item">
                                <i class="mdi mdi-account-details-outline"></i>
                                <span>我的帳號</span>
                            </a>
                            <a href="tour.php" class="dropdown-item notify-item">
                                <i class="mdi mdi-alert-circle-outline"></i>
                                <span>常見問題</span>
                            </a>
                            <a href="../login/logout-output.php" class="dropdown-item notify-item">
                                <i class="fe-log-out"></i>
                                <span>登出</span>
                            </a>
                            </div>
                        </li>

                        <li class="dropdown notification-list">
                            <a href="javascript:void(0);" class="nav-link right-bar-toggle waves-effect waves-light">
                                <i class="fe-settings noti-icon"></i>
                            </a>
                        </li>

                    </ul>

                    <!-- LOGO -->
                    <div class="logo-box">
                        <a href="../home/home.php" class="logo logo-dark text-center">
                            <span class="logo-sm">
                                <img src="../assets/images/logo-fju-sm.png" alt="" height="42">
                                <!-- <span class="logo-lg-text-light">UBold</span> -->
                            </span>
                            <span class="logo-lg">
                                <img src="../assets/images/logo-fju-manager.png" alt="" height="50">
                                <!-- <span class="logo-lg-text-light">U</span> -->
                            </span>
                        </a>

                        <a href="../home/home.php" class="logo logo-light text-center">
                            <span class="logo-sm">
                                <img src="../assets/images/logo-fju-sm.png" alt="" height="42">
                            </span>
                            <span class="logo-lg">
                                <img src="../assets/images/logo-fju-manager.png" alt="" height="50">
                            </span>
                        </a>
                    </div>
                    <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                        <li>
                            <button class="button-menu-mobile waves-effect waves-light">
                                <i class="fe-menu"></i>
                            </button>
                        </li>
                    </ul>

                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- end Topbar -->
            <!-- ========== Left Sidebar Start ========== -->
            <div class="left-side-menu">

                <div class="h-100" data-simplebar>

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">

                        <ul id="side-menu">

                            <li>
                                <a href="#sidebarCrm" data-toggle="collapse">
                                    <i class="mdi mdi-email"></i>
                                    <span> 收件夾 </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarCrm">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="index.php?method=maildistribution">分配稿件</a>
                                        </li>
                                        <li>
                                            <a href="index.php?method=mailbox">審稿回覆</a>
                                        </li>
                                        <li>
                                            <a href="index.php?method=sent">寄件備份</a>
                                        </li>
                                        <!-- <li>
                                            <a href="trash.php">垃圾桶</a>
                                        </li> -->
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="index.php?method=deadline">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    <span> 即期稿件 </span>
                                </a>
                            </li>
                            
                            <li>
                                <a href="index.php?method=accountmanage">
                                    <i class="mdi mdi-account"></i>
                                    <span> 賬號管理 </span>
                                </a>
                            </li>

                            <li>
                                <a href="index.php?method=accounts">
                                    <i class="mdi mdi-account-box-multiple"></i>
                                    <span> 名片夾 </span>
                                </a>
                            </li>
                    </div>
                    <!-- End Sidebar -->

                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->
        </div>
        <!-- END wrapper -->
        <!-- Right Sidebar -->
        <div class="right-bar">
            <div data-simplebar class="h-100">
                <!-- Tab panes -->
                <div class="tab-content pt-0">
                
                    <div class="tab-pane active" id="settings-tab" role="tabpanel">
                        <h6 class="font-weight-medium px-3 m-0 py-2 font-13 text-uppercase bg-light">
                            <span class="d-block py-1">主題設定</span>
                        </h6>

                        <div class="p-3">
                            <h6 class="font-weight-medium font-14 mt-4 mb-2 pb-1">背景顏色</h6>
                            <div class="custom-control custom-switch mb-1">
                                <input type="radio" class="custom-control-input" name="color-scheme-mode" value="light"
                                    id="light-mode-check" checked />
                                <label class="custom-control-label" for="light-mode-check">淺色</label>
                            </div>

                            <div class="custom-control custom-switch mb-1">
                                <input type="radio" class="custom-control-input" name="color-scheme-mode" value="dark"
                                    id="dark-mode-check" />
                                <label class="custom-control-label" for="dark-mode-check">深色</label>
                            </div>

                            <!-- Width -->
                            <h6 class="font-weight-medium font-14 mt-4 mb-2 pb-1">側邊欄</h6>
                            <div class="custom-control custom-switch mb-1">
                                <input type="radio" class="custom-control-input" name="width" value="fluid" id="fluid-check" checked />
                                <label class="custom-control-label" for="fluid-check">打開</label>
                            </div>
                            <div class="custom-control custom-switch mb-1">
                                <input type="radio" class="custom-control-input" name="width" value="boxed" id="boxed-check" />
                                <label class="custom-control-label" for="boxed-check">收起</label>
                            </div>

                            <!-- Left Sidebar-->
                            <h6 class="font-weight-medium font-14 mt-4 mb-2 pb-1">側邊欄顏色</h6>

                            <div class="custom-control custom-switch mb-1">
                                <input type="radio" class="custom-control-input" name="leftsidebar-color" value="light" id="light-check" checked />
                                <label class="custom-control-label" for="light-check">淺色</label>
                            </div>

                            <div class="custom-control custom-switch mb-1">
                                <input type="radio" class="custom-control-input" name="leftsidebar-color" value="dark" id="dark-check" />
                                <label class="custom-control-label" for="dark-check">深色</label>
                            </div>

                            <div class="custom-control custom-switch mb-1">
                                <input type="radio" class="custom-control-input" name="leftsidebar-color" value="brand" id="brand-check" />
                                <label class="custom-control-label" for="brand-check">天藍色</label>
                            </div>

                            <div class="custom-control custom-switch mb-3">
                                <input type="radio" class="custom-control-input" name="leftsidebar-color" value="gradient" id="gradient-check" />
                                <label class="custom-control-label" for="gradient-check">亮紫色</label>
                            </div>

                            <!-- size -->
                            <h6 class="font-weight-medium font-14 mt-4 mb-2 pb-1">側邊欄大小</h6>

                            <div class="custom-control custom-switch mb-1">
                                <input type="radio" class="custom-control-input" name="leftsidebar-size" value="default"
                                    id="default-size-check" checked />
                                <label class="custom-control-label" for="default-size-check">預設</label>
                            </div>

                            <div class="custom-control custom-switch mb-1">
                                <input type="radio" class="custom-control-input" name="leftsidebar-size" value="condensed"
                                    id="condensed-check" />
                                <label class="custom-control-label" for="condensed-check">最小化</small></label>
                            </div>

                            <div class="custom-control custom-switch mb-1">
                                <input type="radio" class="custom-control-input" name="leftsidebar-size" value="compact"
                                    id="compact-check" />
                                <label class="custom-control-label" for="compact-check">中等</small></label>
                            </div>

                            <!-- Topbar -->
                            <h6 class="font-weight-medium font-14 mt-4 mb-2 pb-1">頂欄</h6>

                            <div class="custom-control custom-switch mb-1">
                                <input type="radio" class="custom-control-input" name="topbar-color" value="dark" id="darktopbar-check"
                                    checked />
                                <label class="custom-control-label" for="darktopbar-check">深色</label>
                            </div>

                            <div class="custom-control custom-switch mb-1">
                                <input type="radio" class="custom-control-input" name="topbar-color" value="light" id="lighttopbar-check" />
                                <label class="custom-control-label" for="lighttopbar-check">淺色</label>
                            </div>


                            <button class="btn btn-primary btn-block mt-4" id="resetBtn">重置為默認</button>

                        </div>

                    </div>
                </div>
            </div> <!-- end slimscroll-menu-->
        </div>
        <!-- /Right-bar -->
        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>
    </body>
