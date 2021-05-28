<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>審稿者</title>
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
        <style>
.footable-row-detail-name {
  display: block;
  font-weight: 700;
  padding-right: 0.5em;
  width: 60px; }
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
                    <div class="row mt-3">
                            <div class="col-12">
                                <div class="card-box">
                                   
                                    <div class="mb-2">
                                        <div class="row">
                                            <div class="col-12 text-sm-center form-inline">
                                                <div class="form-group">
                                                    <input id="demo-foo-search" type="text" placeholder="Search" class="form-control form-control-sm" autocomplete="on">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="table-responsive">
                                        <table id="demo-foo-filtering" class="table table-bordered toggle-circle mb-0" data-page-size="7">
                                            <thead>
                                            <tr>
                                                <th data-toggle="true">標題</th>
                                                <th data-hide="phone">作者</th>
                                                <th data-hide="phone">寄件人（管理者）</th>
                                                <th>收件期限</th>
                                                <th data-hide="phone">投稿日期</th>
                                                <th>動作</th>
                                                <!-- <th data-hide="phone, tablet">領域</th> -->
                                                <th data-hide="phone, tablet">摘要</th>
                                                <th data-hide="phone, tablet">管理者留言</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
                                                foreach ($pdo->query("select * from distri where pro='".$login."'") as $row) {
                                                    $id = $row['id'];
                                                    $title=$row['title'];
                                                    $auth1=$row['auth1'];
                                                    $auth2=$row['auth2'];
                                                    $auth3=$row['auth3'];
                                                    $auth4=$row['auth4'];
                                                    $auth5=$row['auth5'];
                                                    $ddl=$row['ddl'];
                                                    $uploadtime = $row['uploadtime'];
                                                    $summary = $row['summary'];
                                                    $filename = $row['filename'];
                                                    $comment = $row['comment'];
                                                    $manager = $row['manager'];
                                                    
                                            ?>
                                            <tr>
                                                <td><?php echo $title ?></td>
                                                <td><?php echo $auth1,' ',$auth2,' ',$auth3,' ',$auth4,' ',$auth5 ?></td>
                                                <td><?php echo $manager ?></td>
                                                <td><span class='badge badge-soft-blue'><?php echo $ddl ?></span></td>
                                                <td><?php echo $uploadtime ?></td>
                                                <td>
                                                    <a href="reply.php?id=<?php echo $id ?>" class="action-icon"> <i class="mdi mdi-email-send-outline"></i></a>
                                                    <a href='../投稿者/upload/<?php echo $filename?>'   target="blank" download="<?php echo $filename ?>" class='action-icon'> <i class='mdi mdi-arrow-collapse-down'></i></a>
                                                </td>

                                                <td>
                                                    <?php   
                                                        $Summary=nl2br($summary);//回車換成換行
                                                        echo $Summary;
                                                    ?>
                                                </td>
                                                <td><?php echo $comment ?></td>
                                                
                                                
                                            </tr>
                                            </tbody>
                                            <?php
                                                }
                                            ?>
                                            <tfoot>
                                            <tr class="active">
                                                <td colspan="6">
                                                    <div class="text-right">
                                                        <ul class="pagination pagination-rounded justify-content-end footable-pagination m-t-10 mb-0"></ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div> <!-- end .table-responsive-->
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



       <!-- Right bar overlay-->
       <div class="rightbar-overlay"></div>

        <!-- Vendor js -->
        <script src="../assets/js/vendor.min.js"></script>

        <!-- Footable js -->
        <script src="../assets/libs/footable/footable.all.min.js"></script>

        <!-- Init js -->
        <script src="../assets/js/pages/foo-tables.init.js"></script>

        <!-- App js -->
        <script src="../assets/js/app.min.js"></script>

    </body>
</html>