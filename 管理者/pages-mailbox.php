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

    <!-- App css -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="../assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

    <link href="../assets/css/bootstrap-dark.min.css" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
    <link href="../assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />

    <!-- icons -->
    <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />

</head>

<?php include "header.php" ?>

<body class="loading">

    <div id="wrapper">
        <div class="content-page">
            <div class="content">

                <!-- Start Content-->
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-left mt-1">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"></li>
                                    <li class="breadcrumb-item"><a href="index.php?method=mailbox">所有信件</a></li>
                                    <li class="breadcrumb-item active">審稿者回覆</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="container-fluid">
                    <?php $title=$_REQUEST["title"] ;
                        $pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
                        foreach ($pdo->query('select count(title) from reply') as $row) {
                            $amount=$row[0];
                        }
                        foreach ($pdo->query("select n.id,n.title,n.auth1,n.auth2,n.auth3,n.auth4,n.auth5, n.uploadname as scriptfile, r.senter, r.recipient,r.level, r.time, r.comment, r.uploadname, r.replytime from newpaper_history n
                        left JOIN reply_history r on n.id = r.id where n.title='".$title."'") as $row) {
                            $senter=$row['senter'];
                            $recipient=$row['recipient'];
                            $auth1=$row['auth1'];
                            $auth2=$row['auth2'];
                            $auth3=$row['auth3'];
                            $auth4=$row['auth4'];
                            $auth5=$row['auth5'];
                            $level=$row['level'];
                            $time=$row['time'];
                            $replytime=$row['replytime'];
                            $uploadname=$row['uploadname'];
                            $comment=$row['comment'];
                            $scriptfile=$row['scriptfile'];

                            $Comment=nl2br($comment);

                            foreach ($pdo->query("select name from account where login='".$senter."'") as $row) {
                                $name=$row['name'];
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

                                                <div class="col-6">
                                                    全文下載：<a href='../投稿者/upload/<?php echo $scriptfile ?>'
                                                        target="blank"
                                                        download="<?php echo $scriptfile ?>"><?php echo $title ?></a>
                                                </div>

                                                <div class="col-6">
                                                    審稿者回覆時間：<?php echo $time ;?>
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
                                                                    <?php echo $auth1,' ', $auth2,' ', $auth3,' ', $auth4, ' ', $auth5 ?>
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
                                                        <p class="mr-4 mb-0">審稿者<b>
                                                                <?php echo $name ?></b> 留言</p>
                                                    </div>

                                                    <div class="media mt-3 px-1">
                                                        <div class="media-body"
                                                            style="text-align: justify; padding-right: 30px;font-family:Microsoft JhengHei">
                                                            <p><?php echo $Comment ?></p>
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
                                                            <a href='../審稿者/upload/<?php echo $uploadname ?>'
                                                                target="blank"
                                                                download="<?php echo $uploadname ?>"><?php echo $uploadname ?></a>
                                                        </div>
                                                    </div>

                                                </section>
                                            </div>

                                            <!-- <div class="container">
                                                    <section class="my-5">

                                                        <div class="card-header border-0 font-weight-bold d-flex justify-content-between">
                                                        <p class="mr-4 mb-0">關鍵字</p>
                                                        </div>

                                                        <div class="media mt-4 px-1">
                                                            <div class="media-body">
                                                                <a href="">關鍵因素，國際交換生，層級分析法</a>
                                                            </div>
                                                        </div>

                                                    </section>
                                                </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end card-->

                        </div> <!-- end col-->

                    </div>
                    <?php }

                        if($amount>=2){
                        ?>
                    <button type="button" class="btn btn-blue waves-effect waves-light"
                        style="text-align:center; float:right">
                        <a href='reply.php?title=<?php echo "$title" ?>' style="color: white"><span class="btn-label"><i
                                    class="fas mdi mdi-email-send-outline fa-lg"></i></span>回覆</a>
                    </button>
                    <?php 
                            } 
                        ?>



                </div> <!-- container -->

            </div> <!-- content -->
        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->
</body>


</div>
<!-- END wrapper -->

<!-- Todo app -->
<script src="../assets/js/pages/jquery.todo.js"></script>

<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>

<!-- Vendor js -->
<script src="../assets/js/vendor.min.js"></script>

<!-- App js -->
<script src="../assets/js/app.min.js"></script>


</html>