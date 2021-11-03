<?php 
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
if(isset($_SESSION["account"]["login"])){
    $manager=$_SESSION["account"]["login"];
    foreach ($pdo->query("select status from account where login= '".$manager."'") as $row) {
    $status[] = $row['status'];
    }
    if(in_array("管理者",$status)){

$id=$_GET["id"] ;
$pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
foreach ($pdo->query("select * from newpaper where id='".$id."'") as $row) {
    $title=$row["title"];
    $author1=$row['auth1'];
    $author2=$row['auth2'];
    $author3=$row['auth3'];
    $author4=$row['auth4'];
    $author5=$row['auth5'];
    $summary=$row['summary'];
    $uploadname=$row['uploadname'];
    $uploadtime=$row['uploadtime'];

    $Summary=nl2br($summary);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title><?php echo $title ?></title>
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

<body class="loading">

    <div id="wrapper">
        <?php include "header.php" ?>
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
                                        <li class="breadcrumb-item"><a href="index.php?method=maildistribution">分配稿件</a>
                                        </li>
                                        <li class="breadcrumb-item active">投稿者新稿件</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">

                                <div class="row">
                                    <div class="container-fluid">
                                        <div>

                                            <h3 style="font-weight: bolder;font-family:Microsoft JhengHei;">
                                                <?php echo $title ?>
                                            </h3>
                                            <small class="float-right">上傳日期：<?php echo $uploadtime ?></small>
                                            <h4 class="m-0 font-14">
                                                作者：<?php echo $author1,' ', $author2, ' ', $author3, ' ', $author4, ' ', $author5 ?>
                                            </h4>

                                            <hr />



                                            <p
                                                style="text-align: justify; padding-right: 30px;font-family:Microsoft JhengHei">
                                                摘要：<?php echo $Summary; ?>
                                            </p>

                                            <h4 class="m-0 font-14">
                                                領域：<p class='badge badge-soft-secondary mr-1'>
                                                    <?php
                                                                foreach ($pdo->query("select f_name from newpaper_field where title = '".$title."'") as $row) 
                                                                {
                                                                    echo $field = $row["f_name"];
                                                                    echo " ";
                                                                }
                                                            ?></p>

                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                <!-- 非匿名檔案 -->
                                <div class="row">
                                    <div class="col-xl-4">
                                        <div class="card mb-1 shadow-none border">
                                            <div class="p-2">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">

                                                        <i class="mdi mdi-attachment"></i>

                                                    </div>
                                                    <div class="col pl-0">
                                                        非匿名檔案：
                                                        <a href='../投稿者/upload/<?php echo $uploadname?>' target="blank"
                                                            download="<?php echo $uploadname ?>"><?php echo $title ?></a>
                                                    </div>
                                                    <div class="col-auto">
                                                        <!-- Button -->
                                                        <a href='../投稿者/upload/<?php echo $uploadname?>' target="blank"
                                                            download="<?php echo $uploadname ?>">
                                                            <i class="dripicons-download"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- end col -->
                                </div>
                                <!-- 匿名檔案 -->
                                <div class="row">
                                    <div class="col-xl-4">
                                        <div class="card mb-1 shadow-none border">
                                            <div class="p-2">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">

                                                        <i class="mdi mdi-attachment"></i>

                                                    </div>
                                                    <div class="col pl-0">
                                                        匿名檔案：
                                                        <a href='../投稿者/upload_x/<?php echo $uploadname?>'
                                                            target="blank"
                                                            download="<?php echo $uploadname ?>"><?php echo $title ?></a>
                                                    </div>
                                                    <div class="col-auto">
                                                        <!-- Button -->
                                                        <a href='../投稿者/upload_x/<?php echo $uploadname?>'
                                                            target="blank" download="<?php echo $uploadname ?>">
                                                            <i class="dripicons-download"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- end col -->
                                </div>
                                <div class="row mt-3" style="display:flex; flex-wrap:wrap; justify-content: flex-end">
                                    <button type="button" class="btn btn-blue waves-effect waves-light"
                                        style="text-align:center; float:right">
                                        <a href='distri.php?id=<?php echo "$id" ?>' style="color: white"><span
                                                class="btn-label"><i
                                                    class="fas mdi mdi-email-send-outline fa-lg"></i></span>分配稿件</a>
                                    </button>
                                </div>
                            </div>
                        </div> <!-- container -->
                    </div> <!-- content -->
                </div>

                <!-- ============================================================== -->
                <!-- End Page content -->
                <!-- ============================================================== -->
                <?php } ?>

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