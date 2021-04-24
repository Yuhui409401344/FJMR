
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

        <!-- Plugins css -->
        <link href="../assets/libs/mohithg-switchery/switchery.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/libs/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />
        <link href="../assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/libs/selectize/css/selectize.bootstrap3.css" rel="stylesheet" type="text/css" />
        <link href="../assets/libs/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" type="text/css" />

        <!-- Plugins css -->
        <link href="../assets/libs/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/libs/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/libs/clockpicker/bootstrap-clockpicker.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />

  

		<!-- App css -->
		<link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
		<link href="../assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

		<link href="../assets/css/bootstrap-dark.min.css" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
		<link href="../assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />

		<!-- icons -->
        <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <style>
            p{
            max-width: 200px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            }

        </style>
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

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-left mt-1">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);"></a></li>
                                            <li class="breadcrumb-item active">分配稿件</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <form method="post"  action="distri-output.php">
                                            <?php 
                                            $id=$_GET['id'];
                                            $pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
                                            foreach ($pdo->query("select * from newpaper where id='".$id."'") as $row) {
                                                $title=$row["title"];
                                                $auth1=$row['auth1'];
                                                $auth2=$row['auth2'];
                                                $auth3=$row['auth3'];
                                                $auth4=$row['auth4'];
                                                $auth5=$row['auth5'];
                                                $summary=$row['summary'];   
                                                $uploadname=$row['uploadname'];
                                                $uploadtime=$row['uploadtime'];

                                            }
                                            ?>
                                            <input type="hidden" name="title" value="<?php echo $title?>"></input>
                                            <h4><b><?php echo $title ?></b></h4>

                                            <?php
                                            $pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
                                            $subject=['人力資源管理','數量方法','資訊管理','會計','財務管理','審計','管理與政策','國際企業','行銷管理','國際貿易','生產與作業管理','統計'];
                                            $query=$pdo->query("SELECT  f_name from newpaper_field  where title='$title'");
                                            $datalist=$query->fetchall();
                                            foreach($datalist as $datadetail){
                                                $arr[]=$datadetail['f_name'];
                                            };
                                            echo "<b>作者：</b>";
                                            echo $auth1,' ',$auth2,' ',$auth3,' ',$auth4,' ',$auth5;

                                            
                                            echo " &nbsp  <b>文章領域：</b>";
                                            foreach($arr as $fdetail){
                                                echo $fdetail;
                                                echo "&nbsp";
                                            }

                                            // 計算文章所屬領域有幾個
                                            $fdetailnum = count($arr);

                                            for($i=0;$i<$fdetailnum;$i++){
                                                ${"f".$i}=$arr[$i];
                                            }
                                           
                                            // 轉為list，之後才能用sql in 語法
                                            list(${"f".$i}) = $arr;
                                                                                        
                                            echo " &nbsp  <b>上傳日期：</b>";
                                            echo $uploadtime;
                                            ?>

                                            <div class="row mt-3">
                                                <div class="col-md-6">
                                                    <!-- assignee -->
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <p class="mb-1 font-weight-bold text-muted">審稿者01</p>
                                                            <?php
                                                                $conn = mysqli_connect('localhost','root','','fjup');
                                                                if (!$conn) {
                                                                die('Could not connect: ' . mysqli_error($con));
                                                                }
                                                                $sql="SELECT distinct account.login from account, account_field where account.status='審稿者' and account_field.f_name in (SELECT  f_name from newpaper_field  where title='$title') and account_field.login=account.login" ;
                                                                $result = mysqli_query($conn, $sql);
                                                                echo "<select  action='distri-output.php' method='post' class='form-control' data-toggle='select2'  name='pro[]' aria-placeholder='請選擇'>";
                                                                while($row = mysqli_fetch_array($result)) {
                                                                echo "<option name='pro[]' value='" . $row["login"] . "'>   " . $row["login"] . "  </option>";
                                                                }echo "</select>";
                                                                mysqli_close($conn);
                                                            ?>
                                                        </div> <!-- end col -->
                                                    </div> <!-- end row -->
                                                    <!-- end assignee -->
                                                </div> <!-- end col -->

                                                <div class="col-md-6">
                                                    <!-- assignee -->
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <p class="mb-1 font-weight-bold text-muted">審稿者02</p>
                                                            <?php 
                                                                $conn = mysqli_connect('localhost','root','','fjup');
                                                                if (!$conn) {
                                                                die('Could not connect: ' . mysqli_error($con));
                                                                }
                                                                $sql="SELECT distinct account.login from account,account_field where account.status='審稿者' and account_field.f_name in (SELECT  f_name from newpaper_field  where title='$title') and account_field.login=account.login ";
                                                                $result = mysqli_query($conn, $sql);
                                                                echo "<select action='distri-output.php' method='post' class='form-control' data-toggle='select2' name='pro[]' aria-placeholder='請選擇'>";
                                                                while($row = mysqli_fetch_array($result)) {
                                                                echo "<option name='pro[]' value='" . $row["login"] . "'>" . $row["login"] . "</option>";
                                                                }echo "</select>";
                                                                mysqli_close($conn);
                                                            ?>
                                                            
                                                        </div> <!-- end col -->
                                                    </div> <!-- end row -->
                                                    <!-- end assignee -->
                                                </div> <!-- end col -->
                                            </div> <!-- end row -->
                                            <div class="row mt-3">
                                                <div class="form-group col-md-10">
                                                    <!-- start due date -->
                                                        <div class="col-md-6">
                                                            <label class="text-muted">回覆期限</label>
                                                            <input type="text"  id="humanfd-datepicker" name="ddl" class="form-control" placeholder="<?php $date=date("M,d,Y"); echo $date; ?>">
                                                        </div>
                                                    <!-- end due date -->
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="form-group col-md-12">
                                                    <div class="col-md">
                                                        <label class="text-muted">留言</label>
                                                        <textarea class="form-control" name="comment" rows="3" style="height:160px"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                
                                            <a href="maildistribution.php"><button type="button" class="btn btn-secondary waves-effect waves-light">取消</button></a>
                                            <a href="distri-output.php"><button type="submit" class="btn btn-info waves-effect waves-light" >寄出</button></a>
                                            </div>
                                        </form>
                                    </div>
                                </div> <!-- end card-box -->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

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

        <script src="../assets/libs/selectize/js/standalone/selectize.min.js"></script>
        <script src="../assets/libs/mohithg-switchery/switchery.min.js"></script>
        <script src="../assets/libs/multiselect/js/jquery.multi-select.js"></script>
        <script src="../assets/libs/select2/js/select2.min.js"></script>
        <script src="../assets/libs/jquery-mockjax/jquery.mockjax.min.js"></script>
        <script src="../assets/libs/devbridge-autocomplete/jquery.autocomplete.min.js"></script>
        <script src="../assets/libs/bootstrap-select/js/bootstrap-select.min.js"></script>
        <script src="../assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
        <script src="../assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>

        <!-- Init js -->
        <script src="../assets/js/pages/foo-tables.init.js"></script>

        <!-- App js -->
        <script src="../assets/js/app.min.js"></script>

        <!-- Inbox init -->
        <script src="../assets/js/pages/inbox.js"></script>

        <!-- Plugins js-->
        <script src="../assets/libs/flatpickr/flatpickr.min.js"></script>
        <script src="../assets/libs/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
        <script src="../assets/libs/clockpicker/bootstrap-clockpicker.min.js"></script>
        <script src="../assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

        <!-- Init js for time picker-->
        <script src="../assets/js/pages/form-pickers.init.js"></script>

        
    </body>
</html>