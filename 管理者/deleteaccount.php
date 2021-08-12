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
<?php require "header.php" ?>
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

        <!-- third party css -->
        <link href="../assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
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
                                $login=$_GET["login"];
                                $status=$_GET["status"];
                                $pdo=new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
                                foreach ($pdo->query("select count(login) as count from account where login=  '".$login."' ") as $row) {
                                    $count = $row['count'];
                                 }


                                //判斷是否為雙重身份的用戶

                                //如果有雙重身份，僅刪除該身份的account
                                if($count > 1){
                                    $sql=$pdo->prepare("DELETE account,account_field from account left join account_field on account_field.login=account.login and account_field.status=account.status where account.login=? and account.status=?");
                                    if ($sql->execute([$login,$status])) {
                                        echo "<script> {window.alert('刪除成功');location.href='accountmanage.php'} </script>";
                                    } else {
                                        echo '刪除失敗。';
                                    }

                                }//如果沒有雙重身份，則刪除account,account_field, account_bio, account_img, account_resume
                                else{
                                    $sql1=$pdo->prepare("DELETE account from account where login=?  ");
                                    $sql2=$pdo->prepare("DELETE account_field from account_field where login=? ");
                                    $sql3=$pdo->prepare("DELETE account_bio from account_bio where login=?  ");
                                    $sql4=$pdo->prepare("DELETE account_img from account_img where login=?  ");
                                    $sql5=$pdo->prepare("DELETE account_resume from account_resume where login=?  ");
                                    if ($sql1->execute([$login]) and $sql2->execute([$login]) and $sql3->execute([$login]) and $sql4->execute([$login]) and $sql5->execute([$login])) {
                                        echo "<script> {window.alert('刪除成功');location.href='accountmanage.php'} </script>";
                                    } else {
                                        echo '刪除失敗。';
                                    }
                                }
                                
                                ?>
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

 
</script>
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
<?php
    }else{
        include "pages-404.html";
    }
}else{
    include "pages-404.html";
}
?>