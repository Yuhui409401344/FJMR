<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>管理者</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="shortcut icon" href="../assets/images/favicon.ico">

    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="../assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

    <link href="../assets/css/bootstrap-dark.min.css" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
    <link href="../assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />

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
                    <?php 
                    
                        $title=$_REQUEST["title"] ;
                        $id=$_REQUEST["id"];
                        $pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
                        foreach ($pdo->query('select count(title) from reply') as $row) {
                            $amount=$row[0];
                        }
                        foreach ($pdo->query("select auth1,auth2,auth3,auth4,auth5,summary,uploadtime, uploadname as scriptfile from newpaper_history where id='".$id."' and title='".$title."'") as $row) {
                            
                            $auth1=$row['auth1'];
                            $auth2=$row['auth2'];
                            $auth3=$row['auth3'];
                            $auth4=$row['auth4'];
                            $auth5=$row['auth5'];
                            $summary=$row['summary'];
                            $uploadtime=$row['uploadtime'];
                            $scriptfile=$row['scriptfile'];
                           
                        }

                    ?>


                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="card-box">
                                <!-- 稿件基本資料 -->
                                <div class="row">
                                    <div class="container-fluid">
                                        <div>

                                            <h3 style="font-weight: bolder;font-family:Microsoft JhengHei;">
                                                <?php echo $title ?>
                                            </h3>
                                            <small class="float-right">上傳日期：<?php echo $uploadtime ?></small>
                                            <h4 class="m-0 font-14">
                                                作者：<?php echo $auth1,' ', $auth2, ' ', $auth3, ' ', $auth4, ' ', $auth5 ?>
                                            </h4>
                                            <hr />
                                            <p
                                                style="text-align: justify; padding-right: 30px;font-family:Microsoft JhengHei">
                                                摘要：<?php echo $summary; ?>
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
                                <!-- 稿件檔案 -->
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card mb-1 shadow-none border">
                                            <div class="p-2">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">

                                                        <i class="mdi mdi-attachment"></i>

                                                    </div>
                                                    <div class="col pl-0">
                                                        稿件檔案：
                                                        <a href='../投稿者/upload_x/<?php echo $scriptfile?>'
                                                            target="blank" download="<?php echo $title ?>">
                                                            <?php echo  $title ?>
                                                        </a>
                                                    </div>
                                                    <div class="col-auto">
                                                        <!-- Button -->
                                                        <a href='../投稿者/upload_x/<?php echo $scriptfile ?>'
                                                            target="blank" download="<?php echo $title  ?>">
                                                            <i class="dripicons-download"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php 
                        foreach ($pdo->query("select r.senter, r.recipient,r.level, r.time, r.comment, r.uploadname, r.replytime from
                      reply_history r where r.id='".$id."' and r.title='".$title."'") as $row) {
                            $senter=$row['senter'];
                            $recipient=$row['recipient'];
                            $level=$row['level'];
                            $time=$row['time'];
                            $replytime=$row['replytime'];
                            $uploadname=$row['uploadname'];
                            $comment=$row['comment'];
                        


                            foreach ($pdo->query("select distinct name,email from account where login='".$senter."'") as $row) {
                                $name=$row['name'];
                                $email=$row['email'];
                            }

                            foreach ($pdo->query("select photo, imgType from account_img where account_img.login =  '".$senter."' ") as $row) {
                                $img = $row['photo'];
                                $imgType = $row['imgType'];
                            }
                    ?>

                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">
                                <!-- 審稿者自己的回覆評級、次數、建議-->
                                <div class="row">
                                    <div class="container-fluid">
                                        <div>
                                            <div class="media mb-3 mt-1">
                                                <?php 
                                                        if(isset($img)){
                                                            echo '<img src="data:'.$imgType.';base64,' . $img . '"   height="32" class="d-flex mr-2 rounded-circle"  />';
                                                        }else{
                                                            echo '<img src="../assets/images/user.png"   height="32" class="d-flex mr-2 rounded-circle"  />'; 
                                                        };
                                                        ?>

                                                <div class="media-body">
                                                    <small class="float-right">回覆日期：<?php echo $time ?></small>
                                                    <h6 class="m-0 font-14"><?php echo $name ?>
                                                    </h6>
                                                    <small class="text-muted"><?php echo $email ?></small>
                                                </div>
                                            </div>

                                            <p
                                                style="text-align: justify; padding-right: 30px;font-family:Microsoft JhengHei">
                                                回覆評級： <?php echo $level ?></p>
                                            <p
                                                style="text-align: justify; padding-right: 30px;font-family:Microsoft JhengHei">
                                                回覆次數：<?php echo $replytime ?></p>

                                            <p
                                                style="text-align: justify; padding-right: 30px;font-family:Microsoft JhengHei">
                                                留言：<?php echo  $comment ?></p>
                                        </div>
                                    </div>
                                </div>

                                <!-- 審稿者自己的回覆檔案 -->
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card mb-1 shadow-none border">
                                            <div class="p-2">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <i class="mdi mdi-attachment"></i>
                                                    </div>

                                                    <div class="col pl-0">
                                                        稿件檔案：
                                                        <a href='../審稿者/upload/<?php echo $uploadname ?>' target="blank"
                                                            download="<?php echo $uploadname ?>"><?php echo $uploadname ?></a>
                                                    </div>
                                                    <div class="col-auto">
                                                        <!-- Button -->
                                                        <a href='../審稿者/upload/<?php echo $uploadname ?>' target="blank"
                                                            download="<?php echo $uploadname ?>">
                                                            <i class="dripicons-download"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end card-->
                        </div><!-- end col-->
                    </div>

                    <?php 
                        } 
                    ?>
                </div>

                <?php
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