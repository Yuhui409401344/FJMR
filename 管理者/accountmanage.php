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
                                        <div class="row mb-2">
                                            <div class="col-sm-12">
                                                <div class="text-sm-left">
                                                     <!-- Large modal -->
                                                     <a href="addaccount.php"><button type="button" class="btn btn-danger waves-effect waves-light"><i class="mdi mdi-plus-circle mr-1"></i> 新增帳號</button></a>
                                                </div>
                                            </div><!-- end col-->
                                        </div>
                
                                        <div class="table-responsive">
                                            <table class="table table-centered table-nowrap table-striped" id="tickets-table">
                                                <thead>
                                                    <tr>
                                                    <th scope="col">帳號</th>
                                                    <th scope="col">姓名</th>
                                                    <th scope="col">密碼</th>
                                                    <th scope="col">email</th>
                                                    <th scope="col">身份</th>
                                                    <th scope="col">領域</th>
                                                    <th scope="col">#動作</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        
                                                        $pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
                                                        foreach ($pdo->query('select * from account') as $row) {
                                                            $login=$row['login'];
                                                            $status=$row['status'];

                                                    ?>
                                                    <tr>
                                                        <td><?php echo $login ?></td>
                                                        <td><?php echo $row['name']?></td>
                                                        <td><?php echo $row['password']?></td>
                                                        <td><?php echo $row['email']?></td>
                                                        <?php if ($status=="審稿者") echo "<td><span class='badge badge-soft-blue badge-pill '>審稿者</span></td>" ;
                                                    elseif($status=="投稿者") echo "<td><span class='badge badge-soft-secondary badge-pill '>投稿者</span></td>" ;
                                                    elseif($status=="管理者") echo "<td><span class='badge badge-soft-danger badge-pill'>管理者</span></td>";
                                                    ?>
                                                        <td><?php
                                                            $pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
                                                            $query=$pdo->query("SELECT f_name from account_field where login='".$login."' and status ='".$status."' ");
                                                            $datalist=$query->fetchall();
                                                            foreach($datalist as $datadetail){
                                                                print_r($datadetail['f_name']);
                                                                echo ' ';
                                                            }
                                                            ?>
                                                               
                                                        </td>
                                                        <td>
                                                            <a href='change-account-input.php?login=<?php echo "$login" ?>  && status=<?php echo "$status" ?> ' class='action-icon' ><i class='mdi mdi-account-edit'></i></a>
                                                            <a href='deleteaccount.php?login=<?php echo "$login" ?> && status=<?php echo "$status" ?> ' class='action-icon' onClick='return confirm("確定刪除?");' ><i class='mdi mdi-delete mr-1'></i></a>
                                                        </td>
                                                        </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>

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

       <!-- Warning Alert Modal (which is no use anymore!!!)-->
       <div id="warning-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-body p-4">
                        
                        <div class="form-group">
                            <input type='hidden' class="content" name="id">
                            <i class="dripicons-warning h1 text-warning"></i>
                            <h4 class="mt-2">刪除用戶</h4>
                            <p class="mt-3">您確定要永久刪除該用戶嗎？</p>
                            <button type="button" class="btn btn-danger my-2" ><?php echo "<a href='deleteaccount.php?login=". $login." '><i class='mdi mdi-delete'></i></a>";?></button>
                        </div>
                        
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        <!-- end of warning alert modal -->

                                    

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