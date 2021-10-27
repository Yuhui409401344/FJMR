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
                                        <li class="breadcrumb-item active">分配審稿</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <?php
                        $id=$_GET["id"];
                        $pro=$_GET["pro"];
                        $pdo=new PDO('mysql:host=localhost;dbname=fjup;charset=utf8','root', '');
                        foreach ($pdo->query("select * from distri_history where id='$id' and pro='$pro'") as $row) {
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
                            $uploadtime=$row['uploadtime'];

                            $Summary=nl2br($summary);
                            
                        }
                        foreach($pdo->query("select name, email, school from account where login='".$pro."'") as $row){
                            $name = $row['name'];
                            $email = $row['email'];
                            $school = $row['school'];
                        }

                      
                        foreach ($pdo->query("select photo, imgType from account_img where account_img.login =  '".$pro."' ") as $row) {
                           $img = $row['photo'];
                           $imgType = $row['imgType'];
                        }

                      
                    ?>

                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">
                                <div class="row">

                                    <div class="container-fluid">

                                        <div>

                                            <h3 style="font-weight: bolder;font-family:Microsoft JhengHei;">
                                                <?php echo $title ?>
                                            </h3>
                                            <h4 class="m-0 font-14">
                                                作者：<?php echo $auth1,' ', $auth2, ' ', $auth3, ' ', $auth4, ' ', $auth5 ?>
                                            </h4>

                                            <hr />



                                            <p
                                                style="text-align: justify; padding-right: 30px;font-family:Microsoft JhengHei">
                                                摘要：<?php echo $summary ?></p>

                                            <h4 class="m-0 font-14">
                                                領域： <?php
                                                            foreach ($pdo->query("select f_name from newpaper_field where title = '".$title."'") as $row) 
                                                            {
                                                                echo  "<p class='badge badge-soft-secondary mr-1'>".$row['f_name']."</p>";
                                                            }
                                                        ?>
                                            </h4>

                                            <div class="row">
                                                <div class="col-xl-4">
                                                    <div class="card mb-1 shadow-none border">
                                                        <div class="p-2">
                                                            <div class="row align-items-center">
                                                                <div class="col-auto">

                                                                    <i class="mdi mdi-attachment"></i>

                                                                </div>
                                                                <div class="col pl-0">
                                                                    <a href='../投稿者/upload_x/<?php echo $uploadname?>'
                                                                        target="blank"
                                                                        download="<?php echo $uploadname ?>"><?php echo $uploadname?></a>
                                                                </div>
                                                                <div class="col-auto">
                                                                    <!-- Button -->
                                                                    <a href='../投稿者/upload_x/<?php echo $uploadname?>'
                                                                        target="blank"
                                                                        download="<?php echo $uploadname ?>">
                                                                        <i class="dripicons-download"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> <!-- end col -->
                                            </div>
                                            <!-- end row-->
                                        </div>
                                    </div>
                                </div> <!-- end card-->
                            </div> <!-- end col-->
                        </div>
                        <!-- end row-->

                    </div> <!-- container -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">
                                <div class="row">
                                    <div class="container-fluid">
                                        <div>
                                            <div class="media mb-3 mt-1">
                                                <?php 
                                                     if(isset($img)){
                                                        echo '<img src="data:'.$imgType.';base64,' . $img . '"   height="32" class="d-flex mr-2 rounded-circle"  />';
                                                    }else{
                                                        echo '<img src="../assets/images/user.png"   height="32" class="d-flex mr-2 rounded-circle"  />'; 
                                                    }
                             
                                                    ?>

                                                <div class="media-body">
                                                    <small class="float-right">配稿日期：<?php echo $uploadtime ?></small>
                                                    <h6 class="m-0 font-14"><?php echo $name ?>
                                                    </h6>
                                                    <small class="text-muted"><?php echo $email ?></small>

                                                </div>
                                            </div>

                                            <p>審稿期限：
                                                <?php 
                                                    $today = date('Y-m-d') ;
                                                    if(strtotime($today) > strtotime($ddl)){
                                                        echo "<span class='badge badge-danger'>$ddl</span>"; //稿件超時了
                                                    }else{
                                                        echo "<span class='badge badge-info'>$ddl</span>"; //稿件未超時
                                                    }
                                                    ?></p>


                                            <p
                                                style="text-align: justify; padding-right: 30px;font-family:Microsoft JhengHei">
                                                您的配稿留言：<?php echo $comment ?></p>
                                        </div>
                                        <!-- end .mt-4 -->





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