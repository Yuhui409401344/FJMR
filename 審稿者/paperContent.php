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
                                        <li class="breadcrumb-item"></li>
                                        <li class="breadcrumb-item"><a href="dashboard.php">儀錶板</a></li>
                                        <li class="breadcrumb-item active">稿件內容</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <?php
                            $id=$_GET["id"];
                            $pdo=new PDO('mysql:host=localhost;dbname=fjup;charset=utf8','root', '');
                            foreach ($pdo->query("select * from distri where id='$id'") as $row) {
                                $title=$row['title'];
                                $pro=$row['pro'];
                                $manager=$row['manager'];
                                $ddl=$row['ddl'];
                                $uploadname=$row['filename'];
                                $summary=$row['summary'];
                                $auth1=$row['auth1'];
                                $auth2=$row['auth2'];
                                $auth3=$row['auth3'];
                                $auth4=$row['auth4'];
                                $auth5=$row['auth5'];
                                $comment=$row['comment'];

                                $Summary=nl2br($summary);
                                
                            }
                        ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">
                                <div class="row">
                                    <div class="container-fluid">

                                        <div class="container">
                                            <div class="row justify-content-start">
                                                <div class="col-12">
                                                    <h3
                                                        style="font-weight: bolder;font-family:Microsoft JhengHei;margin-top: 20px;">
                                                        <?php echo $title ?>
                                                    </h3>
                                                </div>
                                            </div>
                                            <div class="row justify-content-start">
                                                <div class="col-8">
                                                    全文下載：<a href='../投稿者/upload/<?php echo $uploadname?>' target="blank"
                                                        download="<?php echo $uploadname ?>"><?php echo $uploadname?></a>
                                                </div>
                                                <div class="col-4" style="display:inline-block">
                                                    審稿期限：
                                                    <?php 
                                                        $today = date('Y-m-d') ;
                                                        if(strtotime($today) > strtotime($ddl)){
                                                            echo "<span class='badge badge-danger'>$ddl</span>"; //稿件超時了
                                                        }else{
                                                            echo "<span class='badge badge-info'>$ddl</span>"; //稿件未超時
                                                        }
                                                        ?>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="container mt-0">
                                                <section class="mt-3">

                                                    <!-- Card header -->
                                                    <div
                                                        class="card-header border-0 font-weight-bold d-flex justify-content-between">
                                                        <p class="mr-5 mb-0">作者</p>
                                                    </div>

                                                    <div class="media my-2 px-1">
                                                        <div class="media-body" style="font-family:Microsoft JhengHei">
                                                            <div>
                                                                <p class=" mb-0;"
                                                                    style="color: #1c2a48; margin-bottom: 0px;font-weight: 520">
                                                                    <?php echo $auth1,' ', $auth2, ' ', $auth3, ' ', $auth4, ' ', $auth5 ?>
                                                                </p>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </section>
                                            </div>
                                            <div class="container">
                                                <section class="mt-3">

                                                    <!-- Card header -->
                                                    <div
                                                        class="card-header border-0 font-weight-bold d-flex justify-content-between">
                                                        <p class="mr-4 mb-0">稿件領域</p>
                                                    </div>

                                                    <div class="media mt-3 px-1">
                                                        <div class="media-body"
                                                            style="text-align: justify; padding-right: 30px;font-family:Microsoft JhengHei">
                                                            <p> <?php
                                                                foreach ($pdo->query("select f_name from newpaper_field where title = '".$title."'") as $row) 
                                                                {
                                                                    echo $field = $row["f_name"];
                                                                    echo " ";
                                                                }
                                                            ?></p>
                                                        </div>
                                                    </div>

                                                </section>
                                            </div>
                                            <div class="container">
                                                <section class="mt-3">

                                                    <!-- Card header -->
                                                    <div
                                                        class="card-header border-0 font-weight-bold d-flex justify-content-between">
                                                        <p class="mr-4 mb-0">摘要</p>
                                                    </div>

                                                    <div class="media mt-3 px-1">
                                                        <div class="media-body"
                                                            style="text-align: justify; padding-right: 30px;font-family:Microsoft JhengHei">
                                                            <p> <?php echo $Summary ?></p>
                                                        </div>
                                                    </div>

                                                </section>
                                            </div>
                                            <div class="container">
                                                <section class="mt-3">

                                                    <!-- Card header -->
                                                    <div
                                                        class="card-header border-0 font-weight-bold d-flex justify-content-between">
                                                        <p class="mr-4 mb-0">管理者留言</p>
                                                    </div>

                                                    <div class="media mt-3 px-1">
                                                        <div class="media-body"
                                                            style="text-align: justify; padding-right: 30px;font-family:Microsoft JhengHei">
                                                            <p> <?php echo $comment ?></p>
                                                        </div>
                                                    </div>

                                                </section>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end card-->
                        </div> <!-- end col-->
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