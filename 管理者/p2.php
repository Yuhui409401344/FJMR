<?php 
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
if(isset($_SESSION["account"]["login"])){
    $manager=$_SESSION["account"]["login"];
    foreach ($pdo->query("select status from account where login= '".$manager."'") as $row) {
    $status[] = $row['status'];
    }
    if(in_array("管理者",$status)){
?>
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
                                            <li class="breadcrumb-item"><a href="sent.php">寄件備份</a></li>
                                            <li class="breadcrumb-item active">分配審稿</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 
                        <?php
                            $id=$_GET["id"];
                            $pdo=new PDO('mysql:host=localhost;dbname=fjup;charset=utf8','root', '');
                            foreach ($pdo->query("select * from distri_history where id='$id'") as $row) {
                                $title=$row['title'];
                                $pro=$row['pro'];
                                $ddl=$row['ddl'];
                                $uploadname=$row['filename'];
                                $summary=$row['summary'];
                                $auth1=$row['auth1'];
                                $auth2=$row['auth2'];
                                $auth3=$row['auth3'];
                                $auth4=$row['auth4'];
                                $auth5=$row['auth5'];
                                $comment=$row['comment'];
                                
                            }
                        ?>
                        <div class="row">
                            <div class="col-12">
                                <div class="card-box">
                                    <div class="row">
                                        <div class="container-fluid">
                                            <div class="container"
                                                    style=" display: flex;
                                                        justify-content: right;
                                                        align-items: center;
                                                        height: 70px;
                                                        border: 0;
                                                        bottom: 0;
                                                        margin-left: 60px
                                                        ;">
                                            <h3 style="font-weight: bolder;font-family:Microsoft JhengHei;margin-top: 20px;"><?php echo $title?></h3>
                                            </div>
                                            <div style="margin-left: 60px">
                                                <div class="container">
                                                <div class="row">
                                                    <div class="col-3">
                                                        回覆檔案：<a href="upload/<?php echo $uploadname ?>"><?php echo $uploadname ?></a>
                                                            <?php
                                                                if(isset($_GET['file']))
                                                                {
                                                                    // $_GET['file'] 即為傳入要下載檔名的引數
                                                                    header("Content-type:application");
                                                                    header("Content-Length: " .(string)(filesize($_GET['file'])));
                                                                    header("Content-Disposition: attachment; filename=".$_GET['file']);
                                                                    readfile($_GET['file']);
                                                                }
                                                            ?>
                                                    </div>
                                                    <div class="col-3">
                                                        <?php
                                                            foreach ($pdo->query("select name from account where login = '".$pro."'") as $row) {
                                                                $name = $row["name"];
                                                            }
                                                            echo "審稿者：";
                                                            echo $name;    
                                                        ?>
                                                    </div>
                                                    <div class="col-4" style="display:inline-block">
                                                        <?php 
                                                        echo "審稿期限：";
                                                        echo $ddl?>
                                                </div>
                                                </div>
                                                </div>
                                            </div>
                                            <div class="row" style="margin-left: 60px;margin-right: 60px;">
                                                <div class="container mt-0" >
                                                <section class="mt-3">

                                                <!-- Card header -->
                                                <div class="card-header border-0 font-weight-bold d-flex justify-content-between">
                                                <p class="mr-4 mb-0">作者</p>
                                                </div>

                                                <div class="media my-2 px-1">
                                                    <div class="media-body" style="font-family:Microsoft JhengHei">
                                                        <div>
                                                            <p class=" mb-0;" style="color: #1c2a48; margin-bottom: 0px;font-weight: 520">
                                                                <?php echo $auth1?><br>
                                                                <?php echo $auth2?><br>
                                                                <?php echo $auth3?><br>
                                                                <?php echo $auth4?><br>
                                                                <?php echo $auth5?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>

                                                </section>
                                                </div>
                                                <div class="container">
                                                    <section class="my-5">

                                                    <!-- Card header -->
                                                    <div class="card-header border-0 font-weight-bold d-flex justify-content-between">
                                                    <p class="mr-4 mb-0">領域</p>
                                                    </div>

                                                    <div class="media mt-4 px-1">
                                                    <div class="media-body">
                                                        <a href="">
                                                        <?php
                                                            foreach ($pdo->query("select f_name from newpaper_field where title = '".$title."'") as $row) 
                                                            {
                                                                echo $field = $row["f_name"];
                                                                echo " ";
                                                            }
                                                        ?>
                                                        </a>
                                                    </div>
                                                    </div>

                                                    </section>
                                                </div>

                                                <div class="container">
                                                <section class="mt-3">

                                                <!-- Card header -->
                                                <div class="card-header border-0 font-weight-bold d-flex justify-content-between">
                                                <p class="mr-4 mb-0">摘要</p>
                                                </div>

                                                <div class="media mt-3 px-1">
                                                <div class="media-body" style="text-align: justify; padding-right: 30px;font-family:Microsoft JhengHei">
                                                    <p><?php echo $summary?></p>
                                                </div>
                                                </div>

                                                </section>
                                                </div>
                                                <div class="container">
                                                <section class="mt-3">

                                                <!-- Card header -->
                                                <div class="card-header border-0 font-weight-bold d-flex justify-content-between">
                                                <p class="mr-4 mb-0">管理者配稿留言</p>
                                                </div>

                                                <div class="media mt-3 px-1">
                                                <div class="media-body" style="text-align: justify; padding-right: 30px;font-family:Microsoft JhengHei">
                                                    <p><?php echo $comment ?></p>
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
<?php
    }else{
        include "pages-404.html";
    }
}else{
    include "pages-404.html";
}
?>