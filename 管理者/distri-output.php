<?php
session_start();
$manager=$_SESSION["account"]["login"];
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
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="../assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />
    <link href="../assets/css/bootstrap-dark.min.css" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
    <link href="../assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />
    <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />

</head>

<body class="loading">
    <style>
    p {
        max-width: 200px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    </style>
    <!-- Begin page -->
    <div id="wrapper">
        <?php 
            
            include "header.php" ?>

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">
                <!-- Start Content-->
                <div class="container-fluid">
                    <div class="row mt-3">
                        <div class="col-12">
                            <!-- Start project here-->

                            <div style="height: 100vh">

                                <?php
                                      
                                      $title=$_POST["title"];
                                      $pro=$_POST["pro"];
                                      $ddl=$_POST["ddl"];
                                      $comment=$_POST["comment"];
                                     
                                      if (empty($pro)) {
                                        echo '<script> {window.alert("請輸入審稿者");history.back()} </script>';
                                      }elseif(empty($ddl)){
                                        echo '<script> {window.alert("請輸入審稿者繳交截止日期");history.back()} </script>';
                                      }else{

                                        $pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
                                        foreach ($pdo->query("select * from newpaper where title='".$title."'") as $row) {
                                            $id=$row["id"];
                                            $uploader=$row["uploader"];
                                            $auth1=$row['auth1'];
                                            $auth2=$row['auth2'];
                                            $auth3=$row['auth3'];
                                            $auth4=$row['auth4'];
                                            $auth5=$row['auth5'];
                                            $summary=$row['summary'];
                                            $uploadname=$row['uploadname'];
  
                                        }
                                        
                                        foreach($pro as $a){
                                          $sql=$pdo->prepare('INSERT INTO distri (id,title,uploader,summary,pro, manager,ddl,auth1,auth2,auth3,auth4,filename,auth5,comment) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
                                          $sql->execute([$id,$title,$uploader,$summary,$a,$manager,$ddl,$auth1,$auth2,$auth3,$auth4,$uploadname,$auth5,$comment]);
  
                                          $sql2=$pdo->prepare('INSERT INTO distri_history (id,title,uploader,summary,pro,manager,ddl,auth1,auth2,auth3,auth4,filename,auth5,comment) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
                                          $sql2->execute([$id,$title,$uploader,$summary,$a,$manager,$ddl,$auth1,$auth2,$auth3,$auth4,$uploadname,$auth5,$comment]);
  
                                          $sql5 = $pdo->query("select name,email from account where status='審稿者' and login ='".$a."'");
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
  
                                              $mail->Subject = "=?utf-8?B?" . base64_encode("輔仁管理評論有一封來自管理者分配的稿件") . "?=";
                                              // $mail->Subject = "輔仁管理評論有一封來自審稿者的回覆稿件";
                                              $mail->Body    =  require 'mail.php';
                                              $mail->AltBody = '親愛的審稿者您好，您的輔仁管理評論帳號中有一封最新的待審稿稿件，還望您儘速到平台上審稿，給予投稿者意見！謝謝您！';
                                          }
  
                                              if(!$mail->send()) {
                                                  echo 'Message could not be sent.';
                                                  echo 'Mailer Error: ' . $mail->ErrorInfo;
                                              } else {
                                                  'Message has been sent';
                                              }
  
                                          }
                                        $sql3=$pdo ->prepare('delete newpaper from newpaper  where newpaper.title=?');
                                        $sql3->execute([$title]);
                                    ?>


                                <div class="form-group mb-3">
                                    <label for="product-name" style="font-size: 20px;"><?php echo "配稿成功!";?></label>
                                </div>
                                <div class="form-group mb-3">
                                    <div class="card-header border-0 font-weight-bold d-flex justify-content-between">標題
                                    </div><br>
                                    <td><?php echo $title ?></td>
                                </div>
                                <div class="form-group mb-3">
                                    <div class="card-header border-0 font-weight-bold d-flex justify-content-between">作者
                                    </div><br>
                                    <div
                                        style="font-family:Microsoft JhengHei;color: #1c2a48; margin-bottom: 0px;font-weight: 520">
                                        <td>
                                            <?php echo $auth1,' ',$auth2,' ',$auth3,' ',$auth4,' ',$auth5 ?>
                                        </td>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <div class="card-header border-0 font-weight-bold d-flex justify-content-between">
                                        配稿留言
                                    </div><br>
                                    <td><?php $Comment=nl2br($comment); echo $Comment; ?></td>
                                </div>
                                <?php 
                                      }
                                    ?>
                            </div>
                            <!-- /Start your project here-->

                        </div> <!-- end col -->
                    </div> <!-- end row -->
                </div> <!-- container -->
            </div> <!-- content -->
        </div> <!-- content page -->

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->
    </div>
    <!-- END wrapper -->

    <!-- Vendor js -->
    <script src="../assets/js/vendor.min.js"></script>

    <!-- App js -->
    <script src="../assets/js/app.min.js"></script>

    <!-- Inbox init -->
    <script src="../assets/js/pages/inbox.js"></script>

</body>

</html>