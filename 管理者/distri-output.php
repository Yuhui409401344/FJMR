<?php 
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
if(isset($_SESSION["account"]["login"])){
    $manager=$_SESSION["account"]["login"];
    foreach ($pdo->query("select status from account where login= '".$manager."'") as $row) {
    $status[] = $row['status'];
    }
    if(in_array("管理者",$status)){
?>
<?php 
session_start();
if(isset($_SESSION["account"]["login"])){
    $manager=$_SESSION["account"]["login"];
}

?>
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
            <?php 
            
            include "header.php" ?>

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">
                    <!-- Start Content-->
                    <div class="container-fluid">
                        <div class="row mt-3">
                            <div class="col-12">
                                <!-- Start project here-->

                                <div style="height: 100vh">
                               
                                    <?php
                                      
                                      $title=$_POST["title"];
                                      $pro=$_POST["pro"];
                                      $ddl=$_POST["ddl"];
                                      $comment=$_POST["comment"];
                                      $pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
                                      foreach ($pdo->query("select * from newpaper where title='".$title."'") as $row) {
                                          $id=$row["id"];
                                          $uploader=$row["uploader"];
                                          $auth1=$row['auth1'];
                                          $auth2=$row['auth2'];
                                          $auth3=$row['auth3'];
                                          $auth4=$row['auth4'];
                                          $auth5=$row['auth5'];
                                          $summary=$row['summary'];
                                          $uploadname=$row['uploadname'];

                                      }
                                      
                                      $pdo=new PDO('mysql:host=localhost;dbname=fjup;charset=utf8','root', '');
                                      foreach($pro as $a){
                                        $sql=$pdo->prepare('INSERT INTO distri (id,title,uploader,summary,pro, manager,ddl,auth1,auth2,auth3,auth4,filename,auth5,comment) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
                                        $sql->execute([$id,$title,$uploader,$summary,$a,$manager,$ddl,$auth1,$auth2,$auth3,$auth4,$uploadname,$auth5,$comment]);

                                        $sql2=$pdo->prepare('INSERT INTO distri_history (id,title,uploader,summary,pro,manager,ddl,auth1,auth2,auth3,auth4,filename,auth5,comment) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
                                        $sql2->execute([$id,$title,$uploader,$summary,$a,$manager,$ddl,$auth1,$auth2,$auth3,$auth4,$uploadname,$auth5,$comment]);

                                        $sql5 = $pdo->query("select email from account where status='審稿者' and login ='".$pro."'");
                                        foreach($sql5 as $row){

                                            $to_email = $row['email'];
                                            $subject = '新分配的稿件:'.$title;
                                            $message = '請盡速到平台審理已被分配稿件。';
                                            $headers = 'From: 408402511@gapp.fju.edu.tw';

                                            mail($to_email,$subject,$message,$headers);
                                        }
                                        }
                                      if (empty($pro)) {
                                        echo '請輸入審稿者';
                                      }elseif(empty($ddl)){
                                        echo '請輸入繳交截止日期';
                                      }else{
                                        echo "<script> {window.alert('發送成功');location.href='sent.php'} </script>";
                                        $sql3=$pdo ->prepare('delete newpaper from newpaper  where newpaper.title=?');
                                        $sql3->execute([$title]);
                                      }
                                    ?>
                                </div>
                                <!-- /Start your project here-->

                            </div> <!-- end col -->
                        </div> <!-- end row -->
                    </div> <!-- container -->
                </div> <!-- content -->
            </div> <!-- content page -->

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

        <!-- Init js for modal select bar-->
        <script src="../assets/js/pages/form-advanced.init.js"></script>

        <!-- Todo app -->
        <script src="../assets/js/pages/jquery.todo.js"></script>

        <!-- Footable js -->
        <script src="../assets/libs/footable/footable.all.min.js"></script>

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
<?php
    }else{
        include "pages-404.html";
    }
}else{
    include "pages-404.html";
}
?>