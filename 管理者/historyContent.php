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
                                        <li class="breadcrumb-item"></li>
                                        <li class="breadcrumb-item"><a href="index.php?method=sent">寄件備份</a></li>
                                        <li class="breadcrumb-item active">回覆意見</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <?php
                            $id=$_GET["id"];
                            $pdo=new PDO('mysql:host=localhost;dbname=fjup;charset=utf8','root', '');
                            foreach ($pdo->query("select * from totalreply  natural join newpaper_history where id='".$id."'") as $row) {
                                
                                //投稿資料
                                $id=$row["id"];
                                $title=$row['title'];
                                $auth1=$row['auth1'];
                                $auth2=$row['auth2'];
                                $auth3=$row['auth3'];
                                $auth4=$row['auth4'];
                                $auth5=$row['auth5'];
                                $summary=$row["summary"]; //摘要
                                $Summary=nl2br($summary);
                                $uploadtime=$row["uploadtime"]; //投稿時間
                                $scriptfile=$row['uploadname']; //原始投稿檔案
                                
                                //管理者的動作
                                $senter=$row["level"]; //管理者
                                $level=$row['level']; //回覆評級
                                $managerreply=$row["message"];  //管理者回覆
                                $replycount=$row['replycount']+1; //回覆次數
                                $managerfile=$row["filename"]; //管理者上傳的回覆檔案
                                $replytime=$row['replytime']; //回覆日期
                                
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
                                                <div class="col-12">
                                                    全文下載：<a href='../投稿者/upload/<?php echo $scriptfile?>' target="blank"
                                                        download="<?php echo $scriptfile ?>"><?php echo $title ?></a>
                                                </div>

                                            </div>
                                            <div class="row justify-content-start">
                                                <div class="col-4">

                                                    <?php
                                                    echo "回覆評級：";
                                                    if ($level=='接受') {
                                                        echo "<span class='badge badge-soft-blue' >接受</span>" ;
                                                    }elseif ($level=='大幅修改') {
                                                        echo  "<span class='badge badge-soft-warning'>大幅修改</span>";
                                                    }elseif($level=='小幅修改'){
                                                        echo  "<span class='badge badge-soft-success'>小幅修改</span>";
                                                    }elseif($level=='拒絕'){
                                                        echo "<span class='badge badge-soft-pink'>拒絕</span>";
                                                    }elseif($level=='退稿'){
                                                        echo "<span class='badge badge-soft-danger'>退稿</span>";
                                                    }
                                                ?>

                                                </div>

                                                <div class="col-4">
                                                    <a>回覆次數：<?php echo "第";
                                                    echo $replycount;
                                                    echo "次"?></a>
                                                </div>
                                                <div class="col-4">
                                                    <a>回覆日期：<?php echo $replytime ?></a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="container mt-0">
                                                <section class="mt-3">

                                                    <!-- Card header -->
                                                    <div
                                                        class="card-header border-0 font-weight-bold d-flex justify-content-between">
                                                        <p class="mr-4 mb-0">作者</p>
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
                                                        <p class="mr-4 mb-0">摘要</p>
                                                    </div>

                                                    <div class="media mt-3 px-1">
                                                        <div class="media-body"
                                                            style="text-align: justify; padding-right: 30px;font-family:Microsoft JhengHei">
                                                            <p><?php echo $Summary ?></p>
                                                        </div>
                                                    </div>

                                                </section>
                                            </div>
                                            <div class="container">
                                                <section class="mt-3">

                                                    <!-- Card header -->
                                                    <div
                                                        class="card-header border-0 font-weight-bold d-flex justify-content-between">
                                                        <p class="mr-4 mb-0">回覆評論</p>
                                                    </div>

                                                    <div class="media mt-3 px-1">
                                                        <div class="media-body"
                                                            style="text-align: justify; padding-right: 30px;font-family:Microsoft JhengHei">
                                                            <p><?php echo $managerreply ?></p>
                                                        </div>
                                                    </div>

                                                </section>
                                            </div>
                                            <div class="container">
                                                <section class="mt-3">

                                                    <!-- Card header -->
                                                    <div
                                                        class="card-header border-0 font-weight-bold d-flex justify-content-between">
                                                        <p class="mr-4 mb-0">回覆檔案</p>
                                                    </div>

                                                    <div class="media mt-3 px-1">
                                                        <div class="media-body"
                                                            style="text-align: justify; padding-right: 30px;font-family:Microsoft JhengHei">
                                                            <p><a
                                                                    href="upload/<?php echo $managerfile ?>"><?php echo $managerfile ?></a>
                                                            </p>
                                                        </div>
                                                    </div>

                                                </section>
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