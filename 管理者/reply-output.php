<?php
session_start();
$password = $_SESSION["account"]["password"];
$login = $_SESSION["account"]["login"];
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
    <link rel="shortcut icon" href="../assets/images/favicon.ico">

    <link rel="apple-touch-icon" sizes="180x180" href="../assets/images/logo/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/images/logo/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/logo/favicon-16x16.png">
    <link rel="icon" href="../assets/images/logo/logo.ico" type="image/x-icon">

    <link href="../assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/libs/summernote/summernote-bs4.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css" />

    <!-- <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="../assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" /> -->

    <!-- <link href="../assets/css/bootstrap-dark.min.css" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
    <link href="../assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="app-dark-stylesheet" /> -->

    <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />

</head>


<body class="loading">
    <div id="wrapper">
        <?php include "header.php" ?>

        <div class="content-page">
            <div class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-left mt-1">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"></li>
                                    <li class="breadcrumb-item"><a href="index.php?method=mailbox">審稿回覆</a></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                $title = $_GET['title'];
                $comment = $_POST["comment"];
                $level = $_POST["level"];



                $pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');

                foreach ($pdo->query("select r.id,r.uploader,r.auth1,r.auth2,r.auth3,r.auth4,r.auth5,r.recipient,n.summary from reply r,newpaper_history n where n.title='" . $title . "' and r.title='" . $title . "'") as $row) {
                    $id = $row["id"];
                    $uploader = $row["uploader"];
                    $auth1 = $row["auth1"];
                    $auth2 = $row["auth2"];
                    $auth3 = $row["auth3"];
                    $auth4 = $row["auth4"];
                    $auth5 = $row["auth5"];
                    $summary = $row["summary"];
                    $recipient = $row["recipient"];
                }

                // 回復次數
                $replytime = "SELECT COUNT(*) AS count_ FROM totalreply WHERE title='" . $title . "'";

                $result = $pdo->query($replytime);
                foreach ($result as $row) {
                    $RCount = $row['count_'];
                    $filename = $_FILES["file"]["name"];
                    $name = explode('.', $filename);
                    $newname = $title . 'r' . $row["count_"] . '.' . $name[1];

                    $sql1 = $pdo->prepare('insert into totalreply (id,title,uploader,senter,auth1,auth2,auth3,auth4,auth5,level,message,replycount,filename) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)');
                    $sql1->execute([$id, $title, $uploader, $login, $auth1, $auth2, $auth3, $auth4, $auth5, $level, $comment, $row["count_"], $newname]);

                    $sql5 = $pdo->query("select name,email from account where login='" . $uploader . "' and status='投稿者'");
                    foreach ($sql5 as $row) {
                        $to_email = $row['email']; //投稿者信箱
                        $name = $row['name']; //投稿者姓名

                        require_once '../PHPMailer/PHPMailerAutoload.php';

                        $mail = new PHPMailer;
                        $mail->Charset = 'UTF-8';

                        //$mail->SMTPDebug = 3;                               // Enable verbose debug output

                        $mail->isSMTP();
                        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                        $mail->SMTPAuth = true;                               // Enable SMTP authentication
                        $mail->Username = 'paggiechen8866@gmail.com';                 // SMTP username
                        $mail->Password = 'vtqnavfijdkcjpln';                         // SMTP password
                        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                        $mail->Port = 587;                                    // TCP port to connect to

                        $mail->setFrom('paggiechen8866@gmail.com', 'FJMR');
                        $mail->addAddress($to_email, $name);     // Add a recipient

                        // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
                        $mail->isHTML(true);                                  // Set email format to HTML

                        $mail->Subject = "=?utf-8?B?" . base64_encode("您在輔仁管理評論的投稿《" . $title . "》已收到回覆") . "?=";
                        $mail->Body    =  require "mail-author.php";
                        $mail->AltBody = '親愛的投稿者您好，您在輔仁管理評論的投稿《' . $title . '》已收到回覆，請您到輔仁管理評論確認結果，謝謝您！';
                    }

                    if (!$mail->send()) {
                        echo 'Message could not be sent.';
                        echo 'Mailer Error: ' . $mail->ErrorInfo;
                    } else {
                        echo '';
                    }

                    $sql3 = $pdo->prepare("DELETE from reply where reply.id=?");
                    $sql3->execute([$id]);
                }

                if (empty($level)) {
                    echo '請輸入評級。';
                } else {
                    # 檢查檔案是否上傳成功
                    if ($_FILES['file']['error'] === UPLOAD_ERR_OK) {
                        "檔案名稱: " . $newname . "<br/>";
                        "檔案類型: " . $_FILES["file"]["type"] . "<br/>";
                        "檔案大小: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
                        "暫存名稱: " . $_FILES["file"]["tmp_name"];

                        # 檢查檔案是否已經存在
                        if (file_exists('upload/' . $newname)) {
                            '檔案已存在。<br/>';
                        } else {
                            # 將檔案移至指定位置
                            move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $newname);
                        }
                    } else {
                        echo '錯誤代碼：' . $_FILES['file']['error'] . '<br/>';
                    }
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
                                            <?php echo $title?>
                                        </h3>
                                        <!-- <small class="float-right">上傳日期：<?php echo $uploadtime ?></small> -->
                                        <h4 class="m-0 font-14">
                                            作者：<?php echo $auth1, ' ', $auth2, ' ', $auth3, ' ', $auth4, ' ', $auth5 ?>
                                        </h4>
                                        <hr />
                                        <p
                                            style="text-align: justify; padding-right: 30px;font-family:Microsoft JhengHei">
                                            摘要：<?php $Summary = nl2br($summary);
                                                echo $Summary; ?>
                                        </p>
                                        <h4 class="m-0 font-14">
                                            領域：<p class='badge badge-soft-secondary mr-1'>
                                                <?php
                                                foreach ($pdo->query("select f_name from newpaper_field where title = '" . $title . "'") as $row) {
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
                                                    <a href='../投稿者/upload_x/<?php echo $paper ?>' target="blank"
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
                <?php
                    foreach ($pdo->query("select distinct name,email from account where login='". $recipient ."'") as $row) {
                        $name = $row['name'];
                        $email = $row['email'];
                    }
    
                    foreach ($pdo->query("select photo, imgType from account_img where account_img.login ='".$recipient."'") as $row) {
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
                                            if (isset($yourImg)) {
                                                echo '<img src="data:' . $imgType . ';base64,' . $Img . '"   height="32" class="d-flex mr-2 rounded-circle"  />';
                                            } else {
                                                echo '<img src="../assets/images/user.png"   height="32" class="d-flex mr-2 rounded-circle"  />';
                                            };
                                            ?>

                                            <div class="media-body">
                                                <h6 class="m-0 font-14"><?php echo $name?>
                                                </h6>
                                                <small class="text-muted"><?php echo $email ?></small>
                                            </div>
                                        </div>

                                        <p
                                            style="text-align: justify; padding-right: 30px;font-family:Microsoft JhengHei">
                                            回覆評級： <?php 
                                                        if ($level=='接受') {
                                                            echo "<span class='badge badge-soft-blue'>接受</span>" ;
                                                        }elseif ($level=='大幅修改') {
                                                            echo  "<span class='badge badge-soft-warning'>大幅修改</span>";
                                                        }elseif($level=='小幅修改'){
                                                            echo  "<span class='badge badge-soft-success'>小幅修改</span>";
                                                        }elseif($level=='拒絕'){
                                                            echo "<span class='badge badge-soft-danger'>拒絕</span>";
                                                        }
                                                        ?></p>
                                        <p
                                            style="text-align: justify; padding-right: 30px;font-family:Microsoft JhengHei">
                                            回覆次數：<?php echo $RCount+1 ?></p>

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
                                                    <a href='upload/<?php echo $newname ?>' target="blank"
                                                        download="<?php echo $newname ?>">
                                                        <?php echo  $newname ?>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->
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