<?php include "header.php" ?>
<link rel="apple-touch-icon" sizes="180x180" href="../assets/images/logo/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="../assets/images/logo/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="../assets/images/logo/favicon-16x16.png">
<link rel="icon" href="../assets/images/logo/logo.ico" type="image/x-icon">

<body class="loading">

    <!-- Begin page -->
    <div id="wrapper">

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
                                        echo "<script> {window.alert('刪除成功');location.href='index.php?method=accountmanage'} </script>";
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
                                    $sql6=$pdo->prepare("delete account_tel from account_tel where login=?");
                                    if ($sql1->execute([$login]) and $sql2->execute([$login]) and $sql3->execute([$login]) and $sql4->execute([$login]) and $sql5->execute([$login]) and $sql6->execute([$login])) {
                                        echo "<script> {window.alert('刪除成功');location.href='index.php?method=accountmanage'} </script>";
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
    <!-- App js -->
    <script src="../assets/js/app.min.js"></script>
</body>