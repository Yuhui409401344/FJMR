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

        <!-- Bootstrap Tables css -->
        <link href="../assets/libs/bootstrap-table/bootstrap-table.min.css" rel="stylesheet" type="text/css" />

        <!-- App css -->
        <link href="../assets/css/bootstrap.min.(1).css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
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

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-left mt-1">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);"></a></li>
                                            <li class="breadcrumb-item active">已分配的稿件</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 
                        <div class="row">
                            
                            <!-- Right Sidebar -->
                            <div class="col-12">
                                <div class="card-box">
                                    <div class="row">
                                        <div class="col-sm-12">
                                                
                                                <table 
                                                    data-toggle="table"
                                                    data-search="true"
                                                    data-show-refresh="true"
                                                    data-toolbar="#demo-edit-row"
                                                    data-show-columns="true"
                                                    data-sort-name="date"
                                                    data-page-list="[5, 10, 20]"
                                                    data-page-size="10"
                                                    data-pagination="true" data-show-pagination-switch="true" class="table-borderless">
                                                    <button  id="demo-edit-row" class="btn btn-blue btn-sm" disabled>分配審稿</button>
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th  ellipsis data-sortable="true">標題</th>
                                                            <th  ellipsis>作者</th>
                                                            <th  data-sortable="true">審稿者</th>
                                                            <th  data-sortable="true">回覆期限</th>
                                                            <th  >回覆留言</th>
                                                            <th  data-sortable="true" >上傳日期</th>
                                                            <th  data-sortable="false">動作</th>
                                                        </tr>
                                                    </thead>
                                                   
                                                    <tbody>
                                                    <?php
                                                        
                                                        $pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
                                                        foreach ($pdo->query('select * from distri_history') as $row) {
                                                            $id=$row['id'];
                                                            $title=$row['title'];
                                                            $summary=$row['summary'];
                                                            $pro=$row['pro'];
                                                            $ddl=$row['ddl'];
                                                            $auth1=$row['auth1'];
                                                            $auth2=$row['auth2'];
                                                            $auth3=$row['auth3'];
                                                            $auth4=$row['auth4'];
                                                            $auth5=$row['auth5'];
                                                            $filename=$row['filename'];
                                                            $uploadtime=$row['uploadtime'];
                                                            $comment=$row['comment'];
                                                    ?>
                                                    <tr>
                                                        
                                                        <td><a href="p2.php?id=<?php echo $id ?>"><?php echo $title ?></td>
                                                        <td><?php echo $auth1,' ',$auth2,' ',$auth3,' ',$auth4,' ',$auth5 ?></td>
                                                        <td><?php echo $pro?></td>
                                                        <td><?php echo $ddl ?></td>
                                                        <td><?php echo $comment ?></td>
                                                        <td><?php echo $uploadtime ?></td>
                                                        <td>
                                                        <a href='../投稿者/upload/<?php echo $filename ?>'  target="blank" download="<?php echo $filename ?>" class='action-icon'> <i class='mdi mdi-arrow-collapse-down'></i></a>
                                                        </td>
                                                        
                                                        </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                </tbody>
                               
                                                </table>
                                               
                                            
                                        </div> <!-- end col-->
                                    </div>
                                    <!-- end row-->
                                </div> <!-- end card-box -->
                            </div> <!-- end Col -->
                        </div><!-- End row -->

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-left mt-1">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);"></a></li>
                                            <li class="breadcrumb-item active">已回覆的稿件</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <div class="row">
                            
                            <!-- Right Sidebar -->
                            <div class="col-12">
                                <div class="card-box">
                                    <div class="row">
                                        <div class="col-sm-12">
                                                <button id="demo-delete-row" class="btn btn-primary btn-sm" disabled>回覆意見</button>
                                                <table id="demo-custom-toolbar"
                                                    data-toolbar="#demo-delete-row"
                                                    data-toggle="table"
                                                    data-search="true"
                                                    data-show-refresh="true"
                                                    data-show-columns="true"
                                                    data-sort-name="date"
                                                    data-page-list="[5, 10, 20]"
                                                    data-page-size="10"
                                                    data-pagination="true" data-show-pagination-switch="true" class="table-borderless">
                                                    
                                                    
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th  ellipsis data-sortable="true">標題</th>
                                                            <th  data-sortable="true">作者</th>
                                                            <th  data-sortable="true" >回覆時間</th>
                                                            <th  data-sortable="true"  data-align="center"  data-formatter="statusFormatter">回覆意見</th>
                                                            <th  data-sortable="true" data-align="center" data-formatter="timesFormatter">回覆次數</th>
                                                            <th  >回覆建議</th>
                                                            <th  data-sortable="false">動作</th>
                                                        </tr>
                                                    </thead>
                    
                                                    <tbody>
                                                    <?php
                                                        
                                                        $pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
                                                        foreach ($pdo->query('select * from totalreply') as $row) {
                                                            $id=$row['id'];
                                                            $title=$row['title'];
                                                            $level=$row['level'];
                                                            $file=$row['filename'];
                                                            $auth1=$row['auth1'];
                                                            $auth2=$row['auth2'];
                                                            $auth3=$row['auth3'];
                                                            $auth4=$row['auth4'];
                                                            $auth5=$row['auth5'];
                                                            $message=$row['message'];
                                                            $replycount=$row['replycount'];
                                                            $replytime=$row['replytime'];
                                                    ?>
                                                    <tr>
                                                        <td><a href="p1.php?id=<?php echo $id ?>"><?php echo $title ?></a></td>
                                                        <td><?php echo $auth1,' ',$auth2,' ',$auth3,' ',$auth4,' ',$auth5 ?></td>
                                                        <td><?php echo $replytime ?></td>
                                                        
                                                        <td><?php 
                                                        if ($level=='接受') {
                                                            echo "<span class='badge badge-soft-blue'>接受</span>" ;
                                                        }elseif ($level=='大幅修改') {
                                                            echo  "<span class='badge badge-soft-warning'>大幅修改</span>";
                                                        }elseif($level=='小幅修改'){
                                                            echo  "<span class='badge badge-soft-success'>小幅修改</span>";
                                                        }elseif($level=='拒絕'){
                                                            echo "<span class='badge badge-soft-pink'>拒絕</span>";
                                                        }elseif($level=='退稿'){
                                                            echo "<span class='badge badge-soft-danger'>退稿</span>";
                                                        } ?></td>
                                                        
                                                        <td><?php  echo $replycount+1 ; ?></td>
                                                        <td><?php echo $message ?></td>
                                                        <td>
                                                        <a href="../管理者/upload/<?php echo $file ?>"  target="blank" download="<?php echo $file ?>" class='action-icon' ><i class='mdi mdi-arrow-collapse-down'></i></a>
                                                        </td>
                                                        
                                                        </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                </tbody>
                               
                                                </table>
                                                
                                        </div> <!-- end col-->
                                    </div>
                                    <!-- end row-->
                                </div> <!-- end card-box -->
                            </div> <!-- end Col -->
                        </div><!-- End row -->
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
        
        <!-- Bootstrap Tables js -->
        <script src="../assets/libs/bootstrap-table/bootstrap-table.min.js"></script>

        <!-- Init js -->
        <script src="../assets/js/pages/bootstrap-tables.init.js"></script>

        <!-- App js -->
        <script src="../assets/js/app.min.js"></script>

        <!-- Todo app -->
        <script src="../assets/js/pages/jquery.todo.js"></script>

        <!-- Inbox init -->
        <script src="../assets/js/pages/inbox.js"></script>

        

        
    </body>
</html>