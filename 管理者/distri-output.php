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
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="shortcut icon" href="../assets/images/favicon.ico">
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="../assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />
    <link href="../assets/css/bootstrap-dark.min.css" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
    <link href="../assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />
    <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="../assets/css/spinkit.min.css">
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/images/logo/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/images/logo/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/logo/favicon-16x16.png">
    <link rel="icon" href="../assets/images/logo/logo.ico" type="image/x-icon">
    <style>
    p {
        overflow: hidden;
        text-overflow: ellipsis;
    }
    </style>
</head>

<body class="loading">
    <?php include "header.php"; ?>

    <!-- Begin page -->
    <div id="wrapper">

        <div class="content-page">
            <div class="content">
                <!-- Start Content-->
                <div class="container-fluid">


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
                                       
                                        
                                        foreach($pro as $a){
                                            foreach ($pdo->query("select id,uploader,auth1,auth2,auth3,auth4,auth5,summary,uploadname from newpaper where title='".$title."'") as $row) {
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
                                            
                                          $sql=$pdo->prepare("INSERT INTO distri (id,title,uploader,summary,pro, manager,ddl,auth1,auth2,auth3,auth4,filename,auth5,comment) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
                                          $sql->execute([$id,$title,$uploader,$summary,$a,$manager,$ddl,$auth1,$auth2,$auth3,$auth4,$uploadname,$auth5,$comment]);
  
                                          $sql2=$pdo->prepare("INSERT INTO distri_history (id,title,uploader,summary,pro,manager,ddl,auth1,auth2,auth3,auth4,filename,auth5,comment) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
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
                                              $mail->Username = 'fjmreview@gmail.com';                 // SMTP username
                                              $mail->Password = 'umpkxmlgguzfowqa';                         // SMTP password
                                              $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                                              $mail->Port = 587;                                    // TCP port to connect to
  
                                              $mail->setFrom('fjmreview@gmail.com', 'FJMR');
                                              $mail->addAddress($to_email, $name);     // Add a recipient
                                          
                                              // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                                              // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
                                              $mail->isHTML(true);                                  // Set email format to HTML
  
                                              $mail->Subject = "=?utf-8?B?" . base64_encode("輔仁管理評論有一封來自管理者分配的稿件") . "?=";
                                              // $mail->Subject = "輔仁管理評論有一封來自審稿者的回覆稿件";
                                              $mail->Body    =  require "mail-reviewer.php";
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
                                            <p
                                                style="text-align: justify; font-family:Microsoft JhengHei">
                                                摘要：<?php echo $summary ?></p>
                                            <h4 class="m-0 font-14">
                                                <?php
                                                            foreach ($pdo->query("select f_name from newpaper_field where title = '".$title."'") as $row) 
                                                            {
                                                                echo  "<p class='badge badge-soft-secondary mr-1'>".$row['f_name']."</p>";
                                                            }
                                                        ?>
                                            </h4>
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

                                            <?php 
                                                foreach($pro as $a){
                                                    foreach($pdo->query("select name, email from account where login='".$a."'") as $row){
                                                        $name = $row['name']; //審稿者名字
                                                        $email = $row['email']; //審稿者email
                                                    }
                            
                                                    foreach ($pdo->query("select photo, imgType from account_img where account_img.login =  '".$a."' ") as $row) {
                                                       $img = $row['photo'];  //審稿者圖片
                                                       $imgType = $row['imgType']; 
                                                    }
                                                
                                                    if(isset($img)){
                                                        echo '<div class="media mb-3 mt-1"><img src="data:'.$imgType.';base64,' . $img . '"   height="32" class="d-flex mr-2 rounded-circle"  />';
                                                    }else{
                                                        echo '<div class="media mb-3 mt-1"><img src="../assets/images/user.png"   height="32" class="d-flex mr-2 rounded-circle"  />'; 
                                                    }
                             
                                                    ?>

                                            <div class="media-body">
                                                <h6 class="m-0 font-14"><?php echo $name ?>
                                                </h6>
                                                <small class="text-muted"><?php echo $email ?></small>
                                            </div>
                                        </div>
                                        <?php 
                                        unset($img);
                                                }
                                                ?>

                                        <p>審稿期限： <?php echo $ddl ?></p>
                                        <p
                                            style="text-align: justify; font-family:Microsoft JhengHei">
                                            您的配稿留言：<?php echo  $comment ?></p>
                                    </div>
                                    <!-- end .mt-4 -->





                                </div>
                            </div> <!-- end card-->
                        </div> <!-- end col-->
                    </div>
                    <!-- end row-->

                </div> <!-- container -->

                <?php 
                                      }
                                    ?>
            </div>
            <!-- /Start your project here-->


        </div>
    </div>


    <!-- Vendor js -->
    <script src="../assets/js/vendor.min.js"></script>

    <!-- App js -->
    <script src="../assets/js/app.min.js"></script>

    <!-- Inbox init -->
    <script src="../assets/js/pages/inbox.js"></script>
    <script>
    document.onreadystatechange = loadingChange; //当页面加载状态改变的时候执行这个方法.  
    function loadingChange() {

        if (document.readyState == "complete") {
            //結束動畫
            var loadingMask = document.getElementById('load'); //获取动画预加载动画的div
            loadingMask.parentNode.removeChild(loadingMask);
        };
    };
    </script>

</body>

</html>