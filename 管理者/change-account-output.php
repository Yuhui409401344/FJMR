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
                                        <div style="height: 100vh">
                                            <?php
                                                $name=$_POST["name"];
                                                $email=$_POST["email"];
                                                $password=$_POST["password"];
                                                $login=$_POST["login"];  
                                                $status=$_POST["status"];
                                                $field=$_POST["field"];
                                                
                                                
                                                $pdo=new PDO('mysql:host=localhost;dbname=fjup;charset=utf8','root', '');
                                                $sql=$pdo ->prepare("delete from account where login=? and status=?");
                                                $sql->execute([$login,implode(',',$status)]);

                                                $sql1=$pdo->prepare("INSERT INTO account (login,name,email,password,status) VALUES (?,?,?,?,?)");
                                                $sql1->execute([$login,$name,$email,$password, implode(',',$status)]);

                                                $sql2=$pdo ->prepare("delete from account_field where login=? and status=?");
                                                $sql2->execute([$login,implode(',',$status)]);

                                                foreach($field as $v){
                                                    $sql3=$pdo ->prepare('INSERT INTO account_field (login, f_name,status) VALUES (?,?,?)');
                                                    $sql3->execute([$login,$v,implode(',',$status)]);
                                                    
                                                }
                                                echo "<script> {window.alert('修改成功');location.href='accountmanage.php'} </script>";
                                            ?>
                                        </div>
                                        <!-- /Start your project here-->
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                    </div> <!-- container -->
                </div>
            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->
        
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