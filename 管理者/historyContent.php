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
                                $senter=$row["senter"]; //管理者
                                $level=$row['level']; //回覆評級
                                $managerreply=$row["message"];  //管理者回覆
                                $replycount=$row['replycount']+1; //回覆次數
                                $managerfile=$row["filename"]; //管理者上傳的回覆檔案
                                $replytime=$row['replytime']; //回覆日期
                                
                            }

                            foreach($pdo->query("select name, email, school from account where login='$senter'") as $row){
                                $name = $row['name'];
                                $email = $row['email'];
                                $school = $row['school'];
                            }
    
                          
                            foreach ($pdo->query("select photo, imgType from account_img where account_img.login =  '".$senter."' ") as $row) {
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
                                                摘要：<?php echo $Summary ?></p>

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
                                                                    <a href='../投稿者/upload/<?php echo $scriptfile?>'
                                                                        target="blank"
                                                                        download="<?php echo $scriptfile ?>"><?php echo $title ?></a>
                                                                </div>
                                                                <div class="col-auto">
                                                                    <!-- Button -->
                                                                    <a href='../投稿者/upload/<?php echo $scriptfile?>'
                                                                        target="blank"
                                                                        download="<?php echo $scriptfile ?>">
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
                                                    <small class="float-right">回覆日期：<?php echo $replytime ?></small>
                                                    <h6 class="m-0 font-14"><?php echo $name ?>（您）
                                                    </h6>
                                                    <small class="text-muted"><?php echo $email ?></small>

                                                </div>
                                            </div>



                                            <p><?php
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
                                                ?></p>
                                            <p>回覆次數：<?php echo "第";
                                                    echo $replycount;
                                                    echo "次"?></p>


                                            <p
                                                style="text-align: justify; padding-right: 30px;font-family:Microsoft JhengHei">
                                                留言：<?php echo $managerreply ?></p>

                                            <div class="row">
                                                <div class="col-xl-4">
                                                    <div class="card mb-1 shadow-none border">
                                                        <div class="p-2">
                                                            <div class="row align-items-center">
                                                                <div class="col-auto">

                                                                    <i class="mdi mdi-attachment"></i>

                                                                </div>
                                                                <div class="col pl-0">
                                                                    <a
                                                                        href="upload/<?php echo $managerfile ?>"><?php echo $managerfile ?></a>
                                                                </div>
                                                                <div class="col-auto">
                                                                    <!-- Button -->
                                                                    <a href="upload/<?php echo $managerfile ?>">
                                                                        <i class="dripicons-download"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> <!-- end col -->
                                            </div>
                                        </div>
                                        <!-- end .mt-4 -->





                                    </div>
                                </div> <!-- end card-->
                            </div> <!-- end col-->
                        </div>
                        <!-- end row-->

                    </div> <!-- container -->


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