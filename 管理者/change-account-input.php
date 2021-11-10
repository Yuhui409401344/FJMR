<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>管理者</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="../assets/images/favicon.ico">

    <link rel="apple-touch-icon" sizes="180x180" href="../assets/images/logo/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/images/logo/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/logo/favicon-16x16.png">
    <link rel="icon" href="../assets/images/logo/logo.ico" type="image/x-icon">

    <!-- third party css -->
    <link href="../assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet"
        type="text/css" />
    <!-- third party css end -->

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
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <!-- Start project here-->
                                    <?php
                                        
                                        $login=$_GET['login'];
                                        $status=$_GET["status"];  
                                        $pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
                                        foreach($pdo->query("select account.name,account.login,account.password,account.email,account.school,account.status,account_tel.tel from account left join account_tel on account.login=account_tel.login where account.login='".$login."' and account.status='".$status."' ") as $row){
                                            $name=$row["name"];
                                            $password=$row["password"];
                                            $email=$row["email"];
                                            $school=$row["school"];
                                            $phone=$row["tel"];
                                        }
                                                                  
                                    ?>

                                    <!--form group -->
                                    <form action="change-account-output.php" method="post" class="mt-3">
                                        <div style="margin: 25px 120px 120px">

                                            <div class="form-group">
                                                <input type=hidden name="login" value="<?php echo $login ?>">
                                                <label for="login">帳號：</label>
                                                <td name="login">
                                                    <font size=4 color=navy> <?php echo $login ?></font>
                                                </td>
                                            </div>
                                            <!--input -->
                                            <div class="form-group">
                                                <label for="name">姓名</label>
                                                <input type="text" class="form-control" name="name"
                                                    value="<?php echo $name ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="password">密碼</label>
                                                <input type="text" class="form-control" name="password"
                                                    value="<?php echo $password ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="email">email</label>
                                                <input type="text" class="form-control" name="email"
                                                    value="<?php echo $email ?>">
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-6">
                                                    <label for="phone">電話</lable>
                                                        <input type="text" class="form-control" name="phone"
                                                            value="<?php echo $phone?>">
                                                </div>
                                                <div class="form-group col-6">
                                                    <label for="school">學校與學系</lable>
                                                        <input type="text" class="form-control" name="school"
                                                            value="<?php echo $school?>">
                                                </div>
                                            </div>
                                            <div class="p-sm-3">
                                                <div class="radio radio-info form-check-inline">
                                                    <input type="radio" id="option1" <?php if($status == '投稿者')
                                                                {
                                                                echo 'checked="checked"';
                                                                }
                                                            ?> value="投稿者" name="status[]">
                                                    <label for="writer" style="font-size: large;">投稿者</label>
                                                </div>
                                                <div class="radio form-check-inline">
                                                    <input type="radio" id="option2" <?php if($status == '審稿者')
                                                                {
                                                                echo 'checked="checked"';
                                                                }
                                                            ?> value="審稿者" name="status[]">
                                                    <label for="professor" style="font-size: large;">審稿者 </label>
                                                </div>
                                                <div class="radio form-check-inline">
                                                    <input type="radio" id="option3" <?php if($status == '管理者')
                                                                {
                                                                echo 'checked="checked"';
                                                                }
                                                            ?> value="管理者" name="status[]">
                                                    <label for="manager" style="font-size: large;">管理者 </label>
                                                </div>
                                            </div>

                                            <div style="background-color: whitesmoke; padding: 1px;">
                                                <div style="margin-top: 3px;">


                                                    <?php
                                                            
                                                            $pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
                                                            $subject=['人力資源管理','數量方法','資訊管理','會計','財務管理','審計','管理與政策','國際企業','行銷管理','國際貿易','生產與作業管理','統計'];
                                                            $query=$pdo->query("SELECT af.login, af.f_name from account_field af where af.login='".$login."' and af.status='".$status."'");
                                                            $datalist=$query->fetchall();
                                                            foreach($datalist as $datadetail){
                                                                $arr[]=$datadetail['f_name'];
                                                            }
                                                            if(!isset($arr)){
                                                                $arr[]='';
                                                            }
                                                            ?>

                                                </div>
                                            </div>
                                            <div style="background-color: whitesmoke; padding: 1px;">

                                                <div style="margin-top: 3px;">
                                                    <div class="col-6 float-right">
                                                        <div class="checkbox mb-2">
                                                            <input type="checkbox" id="f1" name="field[]"
                                                                value="<?php echo "管理與政策"?>"
                                                                <?php if(in_array('管理與政策',$arr)) echo 'checked'?>>
                                                            <label for="f1"> 管理與政策 </label>
                                                        </div>
                                                        <div class="checkbox mb-2">
                                                            <input type="checkbox" id="f2" name="field[]"
                                                                value="<?php echo "國際企業"?>"
                                                                <?php if(in_array('國際企業',$arr)) echo 'checked'?>>
                                                            <label for="f2"> 國際企業 </label>
                                                        </div>
                                                        <div class="checkbox mb-2">
                                                            <input type="checkbox" id="f3" name="field[]"
                                                                value="<?php echo "行銷管理"?>"
                                                                <?php if(in_array('行銷管理',$arr)) echo 'checked'?>>
                                                            <label for="f3"> 行銷管理 </label>
                                                        </div>
                                                        <div class="checkbox mb-2">
                                                            <input type="checkbox" id="f4" name="field[]"
                                                                value="<?php echo "國際貿易"?>"
                                                                <?php if(in_array('國際貿易',$arr)) echo 'checked'?>>
                                                            <label for="f4"> 國際貿易 </label>
                                                        </div>
                                                        <div class="checkbox mb-2">
                                                            <input type="checkbox" id="f5" name="field[]"
                                                                value="<?php echo "生產與作業管理"?>"
                                                                <?php if(in_array('生產與作業管理',$arr)) echo 'checked'?>>
                                                            <label for="f5"> 生產與作業管理 </label>
                                                        </div>
                                                        <div class="checkbox mb-2">
                                                            <input type="checkbox" id="f6" name="field[]"
                                                                value="<?php echo "統計"?>"
                                                                <?php if(in_array('統計',$arr)) echo 'checked'?>>
                                                            <label for="f6"> 統計 </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="checkbox mb-2">
                                                            <input type="checkbox" id="f7" name="field[]"
                                                                value="<?php echo "人力資源管理"?>"
                                                                <?php if(in_array('人力資源管理',$arr)) echo 'checked'?>>
                                                            <label for="f7"> 人力資源管理 </label>
                                                        </div>
                                                        <div class="checkbox mb-2">
                                                            <input type="checkbox" id="f8" name="field[]"
                                                                value="<?php echo "數量方法"?>"
                                                                <?php if(in_array('數量方法',$arr)) echo 'checked'?>>
                                                            <label for="f8"> 數量方法 </label>
                                                        </div>
                                                        <div class="checkbox mb-2">
                                                            <input type="checkbox" id="f9" name="field[]"
                                                                value="<?php echo "資訊管理"?>"
                                                                <?php if(in_array('資訊管理',$arr)) echo 'checked'?>>
                                                            <label for="f9"> 資訊管理 </label>
                                                        </div>
                                                        <div class="checkbox mb-2">
                                                            <input type="checkbox" id="f10" name="field[]"
                                                                value="<?php echo "會計"?>"
                                                                <?php if(in_array('會計',$arr)) echo 'checked'?>>
                                                            <label for="f10"> 會計 </label>
                                                        </div>
                                                        <div class="checkbox mb-2">
                                                            <input type="checkbox" id="f11" name="field[]"
                                                                value="<?php echo "財務管理"?>"
                                                                <?php if(in_array('財務管理',$arr)) echo 'checked'?>>
                                                            <label for="f11"> 財務管理 </label>
                                                        </div>
                                                        <div class="checkbox mb-2">
                                                            <input type="checkbox" id="f12" name="field[]"
                                                                value="<?php echo "審計"?>"
                                                                <?php if(in_array('審計',$arr)) echo 'checked'?>>
                                                            <label for="f12"> 審計 </label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="form-group mt-3">
                                                <label for="date">修改日期：</label>
                                                <?php $date=date("Y/m/d"); echo $date; ?>
                                            </div>

                                            <div class="form-group mt-5 float-right">
                                                <input class="form-control" type="submit" placeholder="submit"
                                                    style="background-color:#e0f2f1">
                                            </div>
                                        </div>


                                    </form>

                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col -->
                    </div>
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

    <!-- Todo app -->
    <script src="../assets/js/pages/jquery.todo.js"></script>

    <!-- third party js -->
    <script src="../assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
    <!-- third party js ends -->

    <!-- Tickets js -->
    <script src="../assets/js/pages/tickets.js"></script>

    <!-- App js -->
    <script src="../assets/js/app.min.js"></script>

</body>

</html>