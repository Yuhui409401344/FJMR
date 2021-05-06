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
        <meta charset="utf-8" />
        <title>個人帳號</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="../assets/images/favicon.ico">

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
            <?php include "header.php" ?>
            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">
                    <!-- Start Content-->
                    <div class="container-fluid">
                    <?php
                        $pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
                        foreach ($pdo->query("select distinct name,password,email,date,bio from account left join account_bio on account.login = account_bio.login where account.login =  '".$login."' ") as $row) {
                            $name = $row['name'];
                            $password = $row['password'];
                            $email = $row['email'];
                            $date = $row['date'];
                            $bio = $row['bio'];
                        }

                    ?>
                        <div class="row mt-3">
                            <div class="col-lg-4 col-xl-4">
                                <div class="card-box text-center">
                                    <img src="../assets/images/users/user-paggie.jpg" class="rounded-circle avatar-lg img-thumbnail"
                                        alt="profile-image">

                                    <h4 class="mb-0"><?php echo $name ?> </h4>
                                    <p class="text-muted">@ <?php echo $login ?> </p>

                                    <div class="text-left mt-3">
                                        <p class="text-muted mb-2 font-13"><strong>身份 :</strong>
                                        <span class="ml-2 ">
                                        <?php
                                        $pdo1 = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
                                        $query=$pdo1->query("SELECT status from account where login='".$login."'");
                                        $statuses=$query->fetchall();
                                        foreach($statuses as $status){
                                            print_r($status['status']);
                                            echo ' ';
                                        }
                                        ?></span></p>

                                        <p class="text-muted mb-2 font-13"><strong>專長 :</strong>
                                        <span class="ml-2">
                                        <?php
                                        $pdo2 = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
                                        $query=$pdo2->query("SELECT distinct f_name from account_field where login='".$login."'");
                                        $datalist=$query->fetchall();
                                        foreach($datalist as $datadetail){
                                            print_r($datadetail['f_name']);
                                            echo ' ';
                                        }
                                        ?>
                                        </span>
                                        </p>
                                        <p class="text-muted mb-2 font-13"><strong>Email :</strong>
                                        <span class="ml-2 "><?php echo $email ?> </span></p>

                                        <strong class="text-muted font-13 ">簡介 :</strong>
                                        <p class="text-muted font-13 mt-1 mb-2">
                                            <?php echo $bio ?> 
                                        </p>
                                    </div>

                                </div> <!-- end card-box -->
                            
                            
                            </div> <!-- end col-->

                            <div class="col-lg-8 col-xl-8">
                                <div class="card-box">
                                    <ul class="nav nav-pills navtab-bg nav-justified">
                                        <li class="nav-item">
                                            <a href="#aboutme" data-toggle="tab" aria-expanded="true" class="nav-link active">
                                                個人簡歷
                                            </a>
                                        </li>
                                        
                                        <li class="nav-item">
                                            <a href="#settings" data-toggle="tab" aria-expanded="false" class="nav-link">
                                                基本資料
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane show active" id="aboutme">

                                            <h5 class="mb-4 text-uppercase"><i class="mdi mdi-briefcase mr-1"></i>
                                                學經歷</h5>

                                            <ul class="list-unstyled timeline-sm">
                                                <li class="timeline-sm-item">
                                                    <span class="timeline-sm-date">2023 - 25</span>
                                                    <h5 class="mt-0 mb-1">蘋果大學 手機定價研究專業</h5>
                                                    <p>碩士</p>

                                                </li>
                                                <li class="timeline-sm-item">
                                                    <span class="timeline-sm-date">2019 - 23</span>
                                                    <h5 class="mt-0 mb-1">輔仁大學 資訊管理系</h5>
                                                    <p>學士</p>
                                                    
                                                </li>
                                                <li class="timeline-sm-item">
                                                    <span class="timeline-sm-date">2018 - 19</span>
                                                    <h5 class="mt-0 mb-1">中山大學 信息管理與信息系統專業</h5>
                                                    <p>學士 肄業</p>
                                                    
                                                </li>
                                            </ul>

                                        
                                        </div> <!-- end tab-pane -->
                                        <!-- end about me section content -->

                                        

                                        <div class="tab-pane" id="settings">
                                            <form action="change-profile-output.php" method=Post>
                                                <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle mr-1"></i>個人訊息</h5>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="firstname">姓名</label>
                                                            <input type="text" class="form-control" id="firstname" name='name_' value="<?php echo $name ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="lastname">帳號</label>
                                                            <input type="text" style="color:darkblue" class="form-control" id="lastname" name='account' value="<?php echo $login?>"  readonly>
                                                        </div>
                                                    </div> <!-- end col -->
                                                </div> <!-- end row -->

                                            

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="userpassword">密碼</label>
                                                            <input type="text" class="form-control" id="userpassword"  name="password" value="<?php echo $password ?>">
                                                        </div>
                                                    </div> <!-- end col -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="useremail">Email</label>
                                                            <input type="email" class="form-control" id="useremail" name="email" value="<?php echo $email ?>">
                                                        </div>
                                                    </div>
                                                </div> <!-- end row -->
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <div>
                                                                <div style="margin-top: 3px;">
                                                                    <?php
                                                                    
                                                                    $pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
                                                                    $subject=['人力資源管理','數量方法','資訊管理','會計','財務管理','審計','管理與政策','國際企業','行銷管理','國際貿易','生產與作業管理','統計'];
                                                                    $query=$pdo->query("SELECT f_name from account_field where login='".$login."'");
                                                                    $datalist=$query->fetchall();
                                                                    foreach($datalist as $datadetail){
                                                                        $arr[]=$datadetail['f_name'];
                                                                    }

                                                                    ?>
                                                                </div>
                                                            </div>
                                                            <label>領域</label>
                                                            <div  style="background-color: whitesmoke; padding: 1px;">
                                                            
                                                                <div class="mt-2">
                                                                    <div class="col-6 float-right"  style="padding-right: 0px">
                                                                        <div class="checkbox mb-2">  
                                                                            <input type="checkbox" id="f1" name="field[]" value="<?php echo "管理與政策"?>"<?php if(in_array('管理與政策',$arr)) echo 'checked'?>>
                                                                            <label for="f1"> 管理與政策 </label>
                                                                        </div>
                                                                        <div class="checkbox mb-2">
                                                                            <input type="checkbox" id="f2" name="field[]" value="<?php echo "國際企業"?>"<?php if(in_array('國際企業',$arr)) echo 'checked'?>>
                                                                            <label for="f2"> 國際企業 </label>
                                                                        </div>
                                                                        <div class="checkbox mb-2">
                                                                            <input type="checkbox" id="f3"name="field[]" value="<?php echo "行銷管理"?>"<?php if(in_array('行銷管理',$arr)) echo 'checked'?>>
                                                                            <label for="f3"> 行銷管理 </label>
                                                                        </div>
                                                                        <div class="checkbox mb-2">
                                                                            <input type="checkbox" id="f4"  name="field[]" value="<?php echo "國際貿易"?>"<?php if(in_array('國際貿易',$arr)) echo 'checked'?>>
                                                                            <label for="f4"> 國際貿易 </label>
                                                                        </div>
                                                                        <div class="checkbox mb-2">
                                                                            <input type="checkbox" id="f3"name="field[]" value="<?php echo "生產與作業管理"?>"<?php if(in_array('生產與作業管理',$arr)) echo 'checked'?>>
                                                                            <label for="f3"> 生產與作業管理 </label>
                                                                        </div>
                                                                        <div class="checkbox mb-2">
                                                                            <input type="checkbox" id="f6" name="field[]" value="<?php echo "統計"?>"<?php if(in_array('統計',$arr)) echo 'checked'?>>
                                                                            <label for="f6"> 統計 </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6" style="padding-right: 0px">
                                                                        <div class="checkbox mb-2">
                                                                            <input type="checkbox" id="f7"  name="field[]" value="<?php echo "人力資源管理"?>"<?php if(in_array('人力資源管理',$arr)) echo 'checked'?>>
                                                                            <label for="f7"> 人力資源管理 </label>
                                                                        </div>
                                                                        <div class="checkbox mb-2">
                                                                            <input type="checkbox" id="f8" name="field[]" value="<?php echo "數量方法"?>"<?php if(in_array('數量方法',$arr)) echo 'checked'?>>
                                                                            <label for="f8"> 數量方法 </label>
                                                                        </div>
                                                                        <div class="checkbox mb-2">
                                                                            <input type="checkbox" id="f9" name="field[]" value="<?php echo "資訊管理"?>"<?php if(in_array('資訊管理',$arr)) echo 'checked'?>>
                                                                            <label for="f9"> 資訊管理 </label>
                                                                        </div>
                                                                        <div class="checkbox mb-2">
                                                                            <input type="checkbox" id="f10" name="field[]" value="<?php echo "會計"?>"<?php if(in_array('會計',$arr)) echo 'checked'?>>
                                                                            <label for="f10"> 會計 </label>
                                                                        </div>
                                                                        <div class="checkbox mb-2">
                                                                            <input type="checkbox" id="f11" name="field[]" value="<?php echo "財務管理"?>"<?php if(in_array('財務管理',$arr)) echo 'checked'?>>
                                                                            <label for="f11"> 財務管理 </label>
                                                                        </div>
                                                                        <div class="checkbox mb-2">
                                                                            <input type="checkbox" id="f12" name="field[]" value="<?php echo "審計"?>"<?php if(in_array('審計',$arr)) echo 'checked'?>>
                                                                            <label for="f12"> 審計 </label>
                                                                        </div>
                                                                    </div> 
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="userbio">簡介（300字以內）</label>
                                                            <textarea class="form-control" id="userbio" rows="4" name="bio" style="height:100px" ><?php echo $bio ?></textarea>
                                                        </div>
                                                    </div> <!-- end col -->
                                                </div> <!-- end row -->
                                                <div class="row">
                                                    <div class="col-6"><a href="profile.php"><button type="button" class="form-control btn btn-primary waves-effect waves-light mt-2">取消</button></a></div>
                                                    <div class="col-6"><button type="submit" class="form-control btn btn-warning waves-effect waves-light mt-2">更新</button></div>
                                                    
                                                    
                                                </div>
                                        
                                                

                                            </form>
                                        </div>
                                        <!-- end settings content-->

                                    </div> <!-- end tab-content -->
                                </div> <!-- end card-box-->

                            </div> <!-- end col -->
                        </div>
                        <!-- end row-->
                    </div> <!-- container -->
                </div> <!-- content -->
            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->

        

        <!-- Vendor js -->
        <script src="../assets/js/vendor.min.js"></script>

        <!-- App js -->
        <script src="../assets/js/app.min.js"></script>

        <!-- Todo app -->
        <script src="../assets/js/pages/jquery.todo.js"></script>

    </body>

</html>