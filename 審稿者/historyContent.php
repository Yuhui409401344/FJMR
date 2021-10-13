<?php 
session_start();
$password=$_SESSION["account"]["password"];
$login=$_SESSION["account"]["login"];
?>
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
                                        <li class="breadcrumb-item"><a href="history.php">寄件備份</a></li>
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
                            foreach ($pdo->query("select n.id,n.title,n.summary,n.uploadtime as stime, n.uploadname as scriptfile, r.senter, r.recipient,r.level, r.time, r.comment, r.uploadname, r.replytime from newpaper_history n
                            left JOIN reply_history r on n.id = r.id where r.id='".$id."' and r.senter ='".$login."'") as $row) {
                                $id=$row['id'];
                                $title=$row['title'];
                                $summary=$row['summary'];

                                $Summary=nl2br($summary);

                                $stime=$row['stime']; //投稿者上傳日期
                                $scriptfile=$row['scriptfile']; //投稿者原始稿件
                                $senter=$row['senter']; //審稿者
                                
                                $recipient=$row['recipient']; #收件人（管理者）
                                $level=$row['level'];
                                $time=$row['time'];  #審稿者上傳日期
                                $comment=$row['comment'];

                                $Comment=nl2br($comment);
                                $uploadname=$row['uploadname']; #審稿檔案
                                $replytime=$row['replytime'];  #回覆次數
                                
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
                                                    <h3 style="font-weight: bolder;font-family:Microsoft JhengHei;margin-top: 20px; 
                                                        ">
                                                        <?php echo $title ?>
                                                    </h3>
                                                </div>
                                                <div class="col-12">
                                                    全文下載：<a href='../投稿者/upload_x/<?php echo $scriptfile?>'
                                                        target="blank"
                                                        download="<?php echo $scriptfile ?>"><?php echo $title ?></a>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="container">
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
                                                        echo $replytime;
                                                        echo "次"?></a>
                                                </div>
                                                <div class="col-4">
                                                    <a>回覆日期：<?php echo $time ?></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
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
                                                        <p class="mr-4 mb-0">回覆評論</p>
                                                    </div>

                                                    <div class="media mt-3 px-1">
                                                        <div class="media-body"
                                                            style="text-align: justify; padding-right: 30px;font-family:Microsoft JhengHei">
                                                            <p> <?php echo $Comment ?></p>
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
                                                            <a href='upload/<?php echo $uploadname?>' target="blank"
                                                                download="<?php echo $uploadname ?>"><?php echo $uploadname ?></a>
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