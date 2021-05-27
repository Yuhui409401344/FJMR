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
        <title>投稿者</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="../assets/images/favicon.ico">

        <!-- Tour css -->
        <link href="../assets/libs/hopscotch/css/hopscotch.min.css" rel="stylesheet" type="text/css" />

        <!-- Plugins css-->
        <link href="../assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/libs/summernote/summernote-bs4.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css" />
        
	    <!-- App css -->
	    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
	    <link href="../assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

	    <link href="../assets/css/bootstrap-dark.min.css" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
	    <link href="../assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />

	    <!-- icons -->
	    <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />

    </head>

    <body class="loading">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Topbar Start -->
            <div class="navbar-custom">
                <div class="container-fluid">
                    <ul class="list-unstyled topnav-menu float-right mb-0">

                       
                        <li class="dropdown d-lg-inline-block ">
                            <form>
                                <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="fullscreen" href="#">
                                    <i class="fe-maximize noti-icon"></i>
                                </a>
                            </form>
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
                                            <a class="dropdown-icon-item" href="http://www.management.fju.edu.tw/"  target="blank">
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
                                <span class="pro-user-name ml-1">
                                <?php echo $login ?><i class="mdi mdi-chevron-down"></i> 
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">


                                <!-- item-->
                                <?php 
                        $pdo=new PDO('mysql:host=localhost;dbname=fjup;charset=utf8','root', '');
                        $sql=$pdo->query("select status from account where login='".$login."'");
                        foreach($sql as $row){
                            $status=$row["status"];
                        
                            if($status=="投稿者"){
                            ?>
                            
                            <a class="dropdown-item" href="../投稿者/format.php?login=<? echo $login?>" style="font-size: small;">
                            <i class="fe-user"></i>
                            投稿者系統
                            </a>
                            <?php
                            }elseif($status=="審稿者"){
                            ?>
                            
                            <a class="dropdown-item" href="../審稿者/dashboard.php?login=<? echo $login?>" style="font-size: small;">
                            <i class="fe-user"></i>
                            審稿者系統
                            </a>
                            <?php
                            }else{
                            ?>
                            
                            <a class="dropdown-item" href="../管理者/maildistribution.php?login=<? echo $login?>" style="font-size: small;">
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

                                <!-- item-->
                                <a href="../login/logout-output.php" class="dropdown-item notify-item">
                                    <i class="fe-log-out"></i>
                                    <span>登出</span>
                                </a>

                            </div>
                        </li>

                        <li class="dropdown notification-list" >
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
                                <img src="../assets/images/logo-fju-contributor.png" alt="" height="50">
                                <!-- <span class="logo-lg-text-light">U</span> -->
                            </span>
                        </a>

                        <a href="../home/home.php" class="logo logo-light text-center">
                            <span class="logo-sm">
                                <img src="../assets/images/logo-fju-sm.png" alt="" height="42">
                            </span>
                            <span class="logo-lg">
                                <img src="../assets/images/logo-fju-contributor.png" alt="" height="50">
                            </span>
                        </a>
                    </div>

                    
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
                            <li id="first-tour">
                                <a href="#sidebarwrite" data-toggle="collapse">
                                    <i data-feather="edit"></i>
                                    <span>投稿</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarwrite">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="add.php">新增投稿</a>
                                        </li>
                                        <li>
                                            <a href="seereply.php">回覆修正檔 </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li id="second-tour">
                                <a href="format.php">
                                    <i data-feather="clipboard"></i>
                                    <span> 稿約格式 </span>
                                </a>
                            </li>
                            <li id="third-tour">
                                <a href="history.php">
                                    <i data-feather="clock"></i>
                                    <span> 歷史稿件 </span>
                                </a>
                            </li>
                            
                        </ul>
                    </div>
                    <!-- End Sidebar -->

                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->

            
            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <h4 class="page-title" id="page-title-tour" >常見問題</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <div class="row">
                            <div class="col-xl-6">
                                <div id="accordion" class="mb-3">
                                    <div class="card mb-1">
                                        <div class="card-header" id="headingOne">
                                            <h5 class="m-0">
                                                <a class="text-dark" data-toggle="collapse" href="#collapseOne" aria-expanded="true">
                                                    <i class="mdi mdi-help-circle mr-1 text-primary"></i> 
                                                    投稿流程是什麼？
                                                </a>
                                            </h5>
                                        </div>
                            
                                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                            <div class="card-body">
                                                輔仁管理評論的用戶分為「投稿者」、「審稿者」、「管理者」。<br>
                                                當投稿者投遞第一份稿件後，管理者會依據稿件領域選擇兩位審稿者，並且訂定回覆期限，將稿件分配給審稿者們。
                                                審稿者必須在期限內回覆稿件給管理者，管理者接著統整兩位審稿者的意見，統一回覆給投稿者。
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mb-1">
                                        <div class="card-header" id="headingTwo">
                                            <h5 class="m-0">
                                                <a class="text-dark" data-toggle="collapse" href="#collapseTwo" aria-expanded="false">
                                                    <i class="mdi mdi-help-circle mr-1 text-primary"></i> 
                                                    我如何得知稿件目前的狀態？
                                                </a>
                                            </h5>
                                        </div>
                                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                            <div class="card-body">
                                                稿件狀態依序分為「等待主編確認」、「審稿中」、「已接收」、「退稿」，投稿者可以至「歷史稿件」中查看。
                                                <br><br>
                                                <ol style="list-style-type:circle;" >
                                                <li>等待主編確認：表示稿件已送出，待管理者分配稿件給審稿者。</li>
                                                <li>審稿中：表示審稿者正在審稿中，尚未回覆給管理者；管理者已收到審稿回覆，但尚未統一回覆意見，傳給投稿者。</li>
                                                <li>已接收：表示管理者已回覆最終意見給投稿者，投稿者可以點擊歷史稿件的標題以查看管理者的回覆意見，或是在「回覆修正檔」中查看。</li>
                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mb-1">
                                        <div class="card-header" id="headingThree">
                                            <h5 class="m-0">
                                                <a class="text-dark" data-toggle="collapse" href="#collapseThree" aria-expanded="false">
                                                    <i class="mdi mdi-help-circle mr-1 text-primary"></i> 
                                                    我可以成為審稿者或管理者嗎？
                                                </a>
                                            </h5>
                                        </div>
                                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                            <div class="card-body">
                                                目前，輔仁管理評論的所有註冊帳號預設都是「投稿者」身份，若要成為審稿者或管理者，您可以聯繫<a href="mailto:fjreview@mail.fju.edu.tw">輔仁大學管理學院的邱瑞真秘書</a>，
                                                經過管理者的審核後，方可具有審稿者或管理者身份。
                                            </div>
                                        </div>
                                    </div>
        
                                    <div class="card mb-1">
                                        <div class="card-header" id="headingFour">
                                            <h5 class="m-0">
                                                <a class="text-dark" data-toggle="collapse" href="#collapseFour" aria-expanded="false">
                                                    <i class="mdi mdi-help-circle mr-1 text-primary"></i> 
                                                    稿件級別有幾種？分別代表什麼意義？
                                                </a>
                                            </h5>
                                        </div>
                                        <div id="collapseFour" class="collapse" aria-labelledby="collapseFour" data-parent="#accordion">
                                            <div class="card-body">
                                                輔仁管理評論的稿件級別分為「接受」、「大幅修改」、「小幅修改」、「拒絕」、「退稿」。<br><br>
                                                <ol style="list-style-type:circle;" >
                                                <li>接受：表示稿件通過審核。</li>
                                                <li>大幅修改：表示稿件需要修正的地方較多，投稿者需要上傳修正版本。</li>
                                                <li>小幅修改：表示稿件需要細微的修正，投稿者需要上傳修正版本。</li>
                                                <li>拒絕：表示稿件經過兩位審稿者的審核以及管理者的最終統一意見，得出的結論是稿件不合格。投稿者需要上傳修正版本。</li>
                                                <li>退稿：表示稿件可能離題，或領域填寫錯誤，管理者發現此錯誤後直接將稿件退回給投稿者請求修改。投稿者需要上傳新版本。</li>
                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end #accordions-->
                            </div> <!-- end col -->

                           
                        </div> <!-- end row --> 
                        
                    </div> <!-- container -->

                </div> <!-- content -->

                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                2020 - <script>document.write(new Date().getFullYear())</script> &copy; 輔仁管理評論
                            </div>
                            <div class="col-md-6">
                                <div class="text-md-right footer-links d-none d-sm-block">
                                    <a href="../home/purpose.php" target="blank">關於</a>
                                    <a href="maito:fjreview@mail.fju.edu.tw">聯繫我們</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


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
                    <h6 class="font-weight-medium font-14 mb-2 pb-1">背景顏色</h6>
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
                        <label class="custom-control-label" for="condensed-check">最小化</label>
                    </div>

                    <div class="custom-control custom-switch mb-1">
                        <input type="radio" class="custom-control-input" name="leftsidebar-size" value="compact"
                            id="compact-check" />
                        <label class="custom-control-label" for="compact-check">中等</label>
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
             </div>
        </div>
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- Vendor js -->
        <script src="../assets/js/vendor.min.js"></script>

         <!-- Tour page js -->
         <script src="../assets/libs/hopscotch/js/hopscotch.min.js"></script>

        <!-- Tour init js-->
        <script>
            $(document).ready(function () {
    hopscotch.startTour({
        id: 'my-intro',
        steps: [
            {
                target: 'first-tour',
                title: '投稿',
                content: "您可以在此上傳新投稿，或查看級別為「大幅修改」、「小幅修改」、「拒絕」的回覆稿件，並上傳修正版本。",
                placement: 'right',
                yOffset: 10,
            },
            {
                target: 'second-tour',
                title: '稿約格式',
                content: '包含中文版與英文版格式。',
                placement: 'right',
                zindex: 9999,
            },
            {
                target: 'third-tour',
                title: '歷史稿件',
                content: '您可以在此查看歷史稿件的詳細資訊，追蹤稿件目前的審核狀態。',
                placement: 'bottom',
                zindex: 999,
            },
          
        ],
        showPrevButton: !0,
    })
})

        </script>

        <!-- App js -->
        <script src="../assets/js/app.min.js"></script>
     
        
    </body>
</html>