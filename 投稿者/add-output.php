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
        <link rel="shortcut icon" href="../assets/images/favicon.ico">

        <link href="../assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/libs/summernote/summernote-bs4.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css" />
        
	    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
	    <link href="../assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

	    <link href="../assets/css/bootstrap-dark.min.css" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
	    <link href="../assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />

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

                                <!-- item-->
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
                            <li>
                                <a href="format.php">
                                    <i data-feather="clipboard"></i>
                                    <span> 稿約格式 </span>
                                </a>
                            </li>
                            <li>
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

            <div class="content-page">
                <div class="content">
                    <!-- Start Content-->
                    <div class="container-fluid">
                        <div class="row mt-3">
                            <div class="col-lg-12">
                                <div class="card-box">
                                <?php
                                    $title=$_POST["title"];
                                    $field=$_POST["field"];
                                    $summary=$_POST["summary"];
                                    $auth1=$_POST["auth1"];
                                    $auth2=$_POST["auth2"];
                                    $auth3=$_POST["auth3"];
                                    $auth4=$_POST["auth4"];
                                    $auth5=$_POST["auth5"];
                                    $uploadtime="";
                                    
                                
                                    $pdo=new PDO('mysql:host=localhost;dbname=fjup;charset=utf8','root', '');
                                    $sql7=$pdo->query("select title,level,uploader from totalreply where title= '".$title."' AND replycount=(SELECT MAX(replycount) from totalreply where title='".$title."')");
                                    foreach($sql7 as $s7){
                                        $level = $s7['level'];
                                        $uploader = $s7['uploader'];
                                        $stitle = $s7['title'];
                                    }

                                    if( isset($stitle) && $level == '接受' && $uploader == $login){
                                        echo "<script> {window.alert('稿件標題已接受，請去歷史稿件中查詢結果');location.href='history.php'} </script>";
                                    }else if( isset($stitle) && ($level == '大幅修改' || $level == '小幅修改') && $uploader == $login){
                                        echo "<script> {window.alert('請到回覆修正檔的介面上傳回覆');location.href='seereply.php'} </script>";
                                    }else if( isset($stitle) && $stitle == $title && $uploader != $login){
                                        echo "<script> {window.alert('稿件標題已重複，請更改稿件名稱');location.href='add.php'} </script>";
                                    }else{
                                    $sql1="select count(*) as count from newpaper_history where title='".$title."'";
                                    $result=$pdo->query($sql1);
                                    foreach($result as $row){
                                        $row["count"];
                                    }
                                    $filename=$_FILES["file"]["name"];
                                    $name= explode('.',$filename);
                                    $newname=$title.'r'.$row["count"].'.'.$name[1];

                                    $sql2=$pdo->prepare('insert into newpaper (title,uploader,summary,auth1,auth2,auth3,auth4,auth5,uploadname) VALUES(?,?,?,?,?,?,?,?,?)');
                                    $sql2->execute([$title,$login,$summary,$auth1,$auth2,$auth3,$auth4,$auth5,$newname]);
                                    
                                    $pid = $pdo->lastInsertId();

                                    $sql4=$pdo->prepare('insert into newpaper_history (id,title,uploader,summary,auth1,auth2,auth3,auth4,auth5,uploadname) VALUES(?,?,?,?,?,?,?,?,?,?)');
                                    $sql4->execute([$pid,$title,$login,$summary,$auth1,$auth2,$auth3,$auth4,$auth5,$newname]);
                                    

                                    $sql6=$pdo->query("select f_name from newpaper_field where title='".$title."'");
                                    foreach($sql6 as $f){
                                        $f_name[]=$f["f_name"];
                                    }
                                    
                                    if(isset($f_name) && (implode(',',$f_name) != implode(',',$field))){
                                        $sql8=$pdo ->prepare("delete from newpaper_field where title=?");
                                        $sql8->execute([$title]);

                                        foreach($field as $v){
                                            $sql3=$pdo ->prepare('INSERT INTO newpaper_field (title, f_name) VALUES (?,?)');
                                            $sql3->execute([$title,$v]);
                                        }
                                    }else{
                                        foreach($field as $v){
                                            $sql3=$pdo ->prepare('INSERT INTO newpaper_field (title, f_name) VALUES (?,?)');
                                            $sql3->execute([$title,$v]);
                                        }
                                    }
                                ?>
                                        <div class="form-group mb-3">
                                            <label for="product-name" style="font-size: 20px;"><?php echo "新增成功!";?></label>
                                        </div>
                                        <div class="form-group mb-3">
                                            <div class="card-header border-0 font-weight-bold d-flex justify-content-between">標題</div><br>
                                            <td><?php echo $_REQUEST['title']?></td>
                                        </div>
                                        <div class="form-group mb-3">
                                            <div class="card-header border-0 font-weight-bold d-flex justify-content-between">作者</div><br>
                                            <div style="font-family:Microsoft JhengHei;color: #1c2a48; margin-bottom: 0px;font-weight: 520">
                                            <td>
                                                <?php echo $_REQUEST['auth1']?>
                                                <?php echo $_REQUEST['auth2']?>
                                                <?php echo $_REQUEST['auth3']?>
                                                <?php echo $_REQUEST['auth4']?>
                                                <?php echo $_REQUEST['auth5']?>
                                            </td>
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <div class="card-header border-0 font-weight-bold d-flex justify-content-between">摘要</div><br>
                                            <td><?php $Summary=nl2br($summary); echo $Summary; ?></td>
                                        </div>
                                        <div class="form-group mb-3">
                                            <div class="card-header border-0 font-weight-bold d-flex justify-content-between">領域</div><br>
                                            <td><font color=navy><?php echo implode(',',$field) ?></font></td>
                                        </div>
                                    <?php
                                        
                                        // $odlname=$_FILES["file"]["tmp_name"];

                                        if ($_FILES["file"]["error"] > 0){
                                            "Error: " . $_FILES["file"]["error"];
                                        }else{
                                            "檔案名稱: " . $newname."<br/>";
                                            "檔案類型: " . $_FILES["file"]["type"]."<br/>";
                                            "檔案大小: " . ($_FILES["file"]["size"] / 1024)." Kb<br />";
                                            "暫存名稱: " . $_FILES["file"]["tmp_name"];
                                            move_uploaded_file($_FILES["file"]["tmp_name"],"upload/".$newname);
                                        }

                                        $sql5 = $pdo->query("select email from account where status='管理者'");
                                        foreach($sql5 as $row){

                                            $to_email = $row['email'];
                                            $subject = '新上傳的投稿文章:'.$title;
                                            $message = '請盡速到管理平台分配稿件。';
                                            $headers = 'From: 408402511@gapp.fju.edu.tw';

                                            mail($to_email,$subject,$message,$headers);
                                        }
                                    }
                                    ?>
                                </div> <!-- end card-box -->
                            </div> <!-- end col -->
                        </div><!-- end row -->                
                    </div> <!-- container -->
                </div> <!-- content -->
            </div>  


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

        <!-- Plugins js -->
        <script src="../assets/libs/quill/quill.min.js"></script>

        <!-- Init js-->
        <script src="../assets/js/pages/form-quilljs.init.js"></script>

        <!-- App js -->
        <script src="../assets/js/app.min.js"></script>
        
        <!--Todo app js-->
        <script scr="../assets/pages/jquery.todo.js"></script>
        
    </body>
</html>
      