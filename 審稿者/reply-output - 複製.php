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
    <link rel="shortcut icon" href="../assets/images/favicon.ico">

    <link rel="apple-touch-icon" sizes="180x180" href="../assets/images/logo/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/images/logo/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/logo/favicon-16x16.png">
    <link rel="icon" href="../assets/images/logo/logo.ico" type="image/x-icon">

    <link href="../assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/libs/summernote/summernote-bs4.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css" />

    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="../assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

    <link href="../assets/css/bootstrap-dark.min.css" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
    <link href="../assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />

    <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />

</head>

<body class="loading">
    <div id="wrapper">
        <?php include "header.php" ?>
        <div class="content-page">
            <div class="content">

                <div class="container-fluid">

                    <?php
                        $title=$_GET['title'];
                        // $comment=$_POST["comment"];
                        $level=$_POST["level"];
                        $uploadtime="";
                        
                        $filename=$_FILES["file"]["name"]; //審稿者意見書
                        $name= explode('.',$filename);
                        $sql0 = $pdo->query("select count(*) as replycount from reply_history where title='".$title."'");
                        foreach($sql0 as $a){
                            $replycount = $a['replycount'];
                        }
                        $newname=$title.'r'.$replycount.'.'.$name[1]; //審稿者意見書
                        
                        $pdo=new PDO('mysql:host=localhost;dbname=fjup;charset=utf8','root', '');
                        
                        // 1. 該稿件的資料
                        foreach ($pdo->query("select id,uploader,summary,manager,ddl,auth1,auth2,auth3,auth4,auth5,comment,filename,uploadtime from distri where title='".$title."' and pro='".$login."' ") as $row) {
                            $id=$row["id"];
                            $uploader=$row["uploader"];
                            $summary=$row["summary"];
                            $manager=$row['manager'];
                            $ddl=$row["ddl"];
                            $auth1=$row["auth1"];
                            $auth2=$row["auth2"];
                            $auth3=$row["auth3"];
                            $auth4=$row["auth4"];
                            $auth5=$row["auth5"];
                            $managerComment=$row["comment"];
                            $uploadtime=$row["uploadtime"];
                            $paper=$row["filename"]; //原始稿件
                            
                        }

                        // 2. 稿件的回復次數（是指該篇稿件被管理者統一回覆的次數，並沒有說明這個數字是這位審稿者的回覆次數）
                        foreach($pdo->query("SELECT COUNT(*)+1 AS count_ FROM totalreply WHERE title='".$title."'") as $row){
                            $replytime = $row["count_"];
                        }

                        // 3. 將回覆資料新增資料庫reply, reply_history
                        $sql1=$pdo->prepare('insert into reply (id,title,uploader,senter,recipient,auth1,auth2,auth3,auth4,auth5,level,replytime,uploadname) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)');
                        $sql1->execute([$id,$title,$uploader,$login,$manager,$auth1,$auth2,$auth3,$auth4,$auth5,$level,$replytime,$newname]);
                        
                        $sql2=$pdo->prepare('insert into reply_history (id,title,uploader,senter,recipient,auth1,auth2,auth3,auth4,auth5,level,replytime,uploadname) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)');
                        $sql2->execute([$id,$title,$uploader,$login,$manager,$auth1,$auth2,$auth3,$auth4,$auth5,$level,$replytime,$newname]);

                        // 4-1. 管理者的名字和郵箱
                        foreach($pdo->query("select name,email from account where status='管理者' and login='".$manager."'") as $row){
                            $managerName = $row['name'];
                            $managerEmail = $row['email'];
                        };

                        
                        // 5. 從資料庫distri中刪除該審稿人的工作
                        $sql3=$pdo ->prepare("DELETE from distri where distri.pro=? and distri.title=?");
                        $sql3->execute([$login,$title]);

                        // 6. 將distri_history中的accept欄位設為1, 表示接受審稿
                        $sql4=$pdo->prepare("update distri_history set accept=? where pro=? and id=? ");
                        $sql4->execute(["1",$login,$id]);

                        
                        // 6-1. 審稿者的名字和郵箱
                        foreach($pdo->query("select name,email from account where login='".$login."'") as $row){
                            $yourName = $row['name'];
                            $yourEmail = $row['email'];
                        }

                        // 6-2. 審稿者的頭像
                        foreach ($pdo->query("select photo, imgType from account_img where account_img.login =  '".$login."' ") as $row) {
                            $yourImg = $row['photo'];
                            $yourImgType = $row['imgType'];
                            }
                        
                        // 4-2. 發送信件
                        require_once '../PHPMailer/PHPMailerAutoload.php';
                        $mail = new PHPMailer;
                        $mail->Charset='UTF-8';
                        $mail->isSMTP();  
                        $mail->Host = 'smtp.gmail.com';                               // Specify main and backup SMTP servers
                        $mail->SMTPAuth = true;                                       // Enable SMTP authentication
                        $mail->Username = 'fjmreview@gmail.com';                 // SMTP username
                        $mail->Password = '';                         // SMTP password
                        $mail->SMTPSecure = 'tls';                                    // Enable TLS encryption, `ssl` also accepted
                        $mail->Port = 587;                                            // TCP port to connect to
                        $mail->setFrom('fjmreview@gmail.com', 'FJMR');
                        $mail->addAddress($managerEmail, $managerName);               // Add a recipient
                        $mail->isHTML(true);                                  // Set email format to HTML
                        $mail->Subject = "=?utf-8?B?" . base64_encode("輔仁管理評論有一封來自審稿者的回覆稿件") . "?=";
                        $mail->Body    =  require "mail.php";
                        $mail->AltBody = '親愛的管理者者您好，輔仁管理評論目前收到一封來自審稿者的回覆稿件，請您盡速到輔仁管理評論的管理者平台回覆稿件，謝謝您！';
                        
                        if(!$mail->send()) {
                            echo 'Message could not be sent.';
                            echo 'Mailer Error: ' . $mail->ErrorInfo;
                        } else {
                            echo '';
                        };

                        if (empty($level)) {
                            echo '請輸入評級。';
                        }else{
                            
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
                                                        <a href='../投稿者/upload_x/<?php echo $paper?>' target="blank"
                                                            download="<?php echo $title ?>">
                                                            <?php echo  $title ?>
                                                        </a>
                                                    </div>
                                                    <div class="col-auto">
                                                        <!-- Button -->
                                                        <a href='../投稿者/upload_x/<?php echo $paper ?>' target="blank"
                                                            download="<?php echo $title  ?>">
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




                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">
                                <!-- 審稿者自己的回覆評級、次數、建議-->
                                <div class="row">
                                    <div class="container-fluid">
                                        <div>
                                            <div class="media mb-3 mt-1">
                                                <?php 
                                                    if(isset($yourImg)){
                                                        echo '<img src="data:'.$yourImgType.';base64,' . $yourImg . '"   height="32" class="d-flex mr-2 rounded-circle"  />';
                                                    }else{
                                                        echo '<img src="../assets/images/user.png"   height="32" class="d-flex mr-2 rounded-circle"  />'; 
                                                    };
                                                    ?>

                                                <div class="media-body">
                                                    <h6 class="m-0 font-14"><?php echo $yourName ?>
                                                    </h6>
                                                    <small class="text-muted"><?php echo $yourEmail ?></small>
                                                </div>
                                            </div>

                                            <p style="text-align: justify; padding-right: 30px;font-family:Microsoft JhengHei">
                                                回覆評級： <?php echo $_REQUEST['level']; ?></p>
                                            <p style="text-align: justify; padding-right: 30px;font-family:Microsoft JhengHei">
                                                回覆次數：<?php echo $replytime ?></p>

                                            <!-- <p style="text-align: justify; padding-right: 30px;font-family:Microsoft JhengHei">
                                                留言：<?php echo  $comment ?></p> -->
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
                                                    <?php
                                            # 檢查檔案是否上傳成功
                                            if ($_FILES['file']['error'] === UPLOAD_ERR_OK){
                                            
                                            # 檢查檔案是否已經存在
                                            if (file_exists('upload/' . $newname)){
                                                echo '檔案已存在。<br/>';
                                            } else {
                                                # 將檔案移至指定位置
                                                move_uploaded_file($_FILES["file"]["tmp_name"],"upload/".$newname);
                                            }
                                            } else {
                                            echo '錯誤代碼：' . $_FILES['file']['error'] . '<br/>';
                                            }
                                            
                                        ?>
                                                    <div class="col pl-0">
                                                        稿件檔案：
                                                        <a href='upload/<?php echo $newname?>' target="blank"
                                                            download="<?php echo $newname ?>">
                                                            <?php echo  $newname ?>
                                                        </a>
                                                    </div>
                                                    <div class="col-auto">
                                                        <!-- Button -->
                                                        <a href='upload_x/<?php echo $newname ?>' target="blank"
                                                            download="<?php echo $newname  ?>">
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

                </div> <!-- container -->

            </div> <!-- content -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->


    </div>
    <!-- END wrapper -->


    <!-- App js -->
    <script src="../assets/js/vendor.min.js"></script>

    <!-- Summernote js -->
    <script src="../assets/libs/summernote/summernote-bs4.min.js"></script>
    <!-- Select2 js-->
    <script src="../assets/libs/select2/js/select2.min.js"></script>
    <!-- Dropzone file uploads-->
    <script src="../assets/libs/dropzone/min/dropzone.min.js"></script>

    <!-- Init js-->
    <script src="../assets/js/pages/form-fileuploads.init.js"></script>

    <!-- Init js -->
    <script src="../assets/js/pages/add-product.init.js"></script>

    <!-- App js -->
    <script src="../assets/js/app.min.js"></script>

</body>

</html>