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

    <!-- Plugins css-->
    <link href="../assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/libs/summernote/summernote-bs4.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css" />

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

                <div class="container-fluid">
                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <div class="card-box">
                                <?php
                                    $title=$_GET['title'];
                                    // $recipient=$_POST["recipient"];
                                    $comment=$_POST["comment"];
                                    $level=$_POST["level"];
                                    $uploadtime="";
                                    
                                    
                                    $pdo=new PDO('mysql:host=localhost;dbname=fjup;charset=utf8','root', '');

                                    foreach ($pdo->query("select * from distri where title='".$title."'") as $row) {
                                        $id=$row["id"];
                                        $uploader=$row["uploader"];
                                        $auth1=$row["auth1"];
                                        $auth2=$row["auth2"];
                                        $auth3=$row["auth3"];
                                        $auth4=$row["auth4"];
                                        $auth5=$row["auth5"];
                                        $manager=$row['manager'];
                                    }
                                    
                                    foreach($pdo->query("SELECT COUNT(*)+1 AS count_ FROM totalreply WHERE title='".$title."'") as $row){
                                        $replytime = $row["count_"];

                                        $sql4 = $pdo->query("select count(*) as replycount from reply_history where title='".$title."'");
                                        foreach($sql4 as $a){
                                            $replycount = $a['replycount'];
                                        }
                                        $filename=$_FILES["file"]["name"];
                                        $name= explode('.',$filename);
                                        $newname=$title.'r'.$replycount.'.'.$name[1];

                                        $sql1=$pdo->prepare('insert into reply (id,title,uploader,senter,recipient,auth1,auth2,auth3,auth4,auth5,level,replytime,uploadname,comment) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
                                        $sql1->execute([$id,$title,$uploader,$login,$manager,$auth1,$auth2,$auth3,$auth4,$auth5,$level,$replytime,$newname,$comment]);
                                        
                                        $sql2=$pdo->prepare('insert into reply_history (id,title,uploader,senter,recipient,auth1,auth2,auth3,auth4,auth5,level,replytime,uploadname,comment) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
                                        $sql2->execute([$id,$title,$uploader,$login,$manager,$auth1,$auth2,$auth3,$auth4,$auth5,$level,$replytime,$newname,$comment]);

                                        $sql5 = $pdo->query("select name, email from account where status='管理者' and login ='".$manager."'");
                                        foreach($sql5 as $row){
                                            $to_email = $row['email']; //管理者信箱
                                            $name = $row['name']; //管理者姓名

                                            require_once '../PHPMailer/PHPMailerAutoload.php';

                                            $mail = new PHPMailer;
                                            $mail->Charset='UTF-8';

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

                                            $mail->Subject = "=?utf-8?B?" . base64_encode("輔仁管理評論有一封來自審稿者的回覆稿件") . "?=";
                                            // $mail->Subject = "輔仁管理評論有一封來自審稿者的回覆稿件";
                                            $mail->Body    =  file_get_contents('mail.html', true);
                                            $mail->AltBody = '親愛的管理者者您好，輔仁管理評論目前收到一封來自審稿者的回覆稿件，請您盡速到輔仁管理評論的管理者平台回覆稿件，謝謝您！';
                                        }

                                            if(!$mail->send()) {
                                                echo 'Message could not be sent.';
                                                echo 'Mailer Error: ' . $mail->ErrorInfo;
                                            } else {
                                                echo '';
                                            }

                                        $sql3=$pdo ->prepare("DELETE from distri where distri.pro=? and distri.title=?");
                                        $sql3->execute([$login,$title]);
                                    }

                                    if (empty($level)) {
                                        echo '請輸入評級。';
                                    }else{
                                        
                                    
                                ?>

                                <div class="row mt-3">
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
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- end col-->
                                </div><!-- end row-->
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card-box">
                                            <div class="row">
                                                <div class="container-fluid">
                                                    <div>
                                                        <div class="media mb-3 mt-1">

                                                            <div class="media-body">
                                                                <h6 class="m-0 font-14"><?php echo $login ?>
                                                                </h6>

                                                            </div>
                                                        </div>
                                                        <p>回覆評級： <?php echo $_REQUEST['level']; ?></p>
                                                        <p>回覆次數：<?php echo $replytime ?></p>

                                                        <p
                                                            style="text-align: justify; padding-right: 30px;font-family:Microsoft JhengHei">
                                                            留言：<?php $Comment=nl2br($comment); echo  $Comment ?></p>
                                                    </div>
                                                    <!-- end .mt-4 -->





                                                </div>
                                            </div> <!-- end card-->
                                        </div> <!-- end col-->
                                    </div>
                                    <!-- end row-->



                                    <table>
                                        <tr>

                                            <td><span class="badge badge-soft-secondary"
                                                    style="font-size:large">收件人</span>
                                            </td>
                                            <td><label style="font-size:18px"><?php echo $manager ?></label></td>
                                        </tr><br>



                                        <tr>
                                            <td><span class="badge badge-soft-secondary"
                                                    style="font-size:large">檔案名稱</span>
                                            </td>
                                            <td><label style="font-size:18px">
                                                    <?php
                                                
                                                // $odlname=$_FILES["file"]["tmp_name"];
        
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
                                                </label>
                                            </td>
                                        </tr>
                                    </table>
                                    <?php 
                                    }
                                ?>
                                </div> <!-- end card-box -->
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