<!DOCTYPE html>
<html lang="en">

<body class="loading">

    <!-- Begin page -->
    <div id="wrapper">
        <?php include "nav.php" ?>
        <div class="content-page">
            <div class="content">
                <!-- Start Content-->
                <div class=" mt-3 alert alert-success alert-dismissible bg-success text-white border-0 fade show"
                    role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    投稿成功，請靜候回覆！
                </div>
                <div class="mt-3 container-fluid">
                    <?php
                                    $title=$_POST["title"];
                                    $field=$_POST["field"];
                                    $summary=$_POST["summary"];
                                    $auth1=$_POST["auth1"];
                                    $auth2=$_POST["auth2"];
                                    $auth3=$_POST["auth3"];
                                    $auth4=$_POST["auth4"];
                                    $auth5=$_POST["auth5"];
                                    $uploadtime="";
                                    
                                
                                    $pdo=new PDO('mysql:host=localhost;dbname=fjup;charset=utf8','root', '');
                                    $sql7=$pdo->query("select title,level,uploader from totalreply where title= '".$title."' AND replycount=(SELECT MAX(replycount) from totalreply where title='".$title."')");
                                    foreach($sql7 as $s7){
                                        $level = $s7['level'];
                                        $uploader = $s7['uploader'];
                                        $stitle = $s7['title'];
                                    }

                                    if( isset($stitle) && $level == '接受' && $uploader == $login){
                                        echo "<script> {window.alert('稿件標題已接受，請去歷史稿件中查詢結果');location.href='history.php'} </script>";
                                    }else if( isset($stitle) && ($level == '大幅修改' || $level == '小幅修改') && $uploader == $login){
                                        echo "<script> {window.alert('請到回覆修正檔的介面上傳回覆');location.href='seereply.php'} </script>";
                                    }else if( isset($stitle) && $stitle == $title && $uploader != $login){
                                        echo "<script> {window.alert('稿件標題已重複，請更改稿件名稱');location.href='add.php'} </script>";
                                    }else{
                                    $sql1="select count(*) as count from newpaper_history where title='".$title."'";
                                    $result=$pdo->query($sql1);
                                    foreach($result as $row){
                                        $row["count"];
                                    }
                                    $filename=$_FILES["file"]["name"];
                                    $name= explode('.',$filename);
                                    $newname=$title.'r'.$row["count"].'.'.$name[1];

                                    $sql2=$pdo->prepare('insert into newpaper (title,uploader,summary,auth1,auth2,auth3,auth4,auth5,uploadname) VALUES(?,?,?,?,?,?,?,?,?)');
                                    $sql2->execute([$title,$login,$summary,$auth1,$auth2,$auth3,$auth4,$auth5,$newname]);
                                    
                                    $pid = $pdo->lastInsertId();

                                    $sql4=$pdo->prepare('insert into newpaper_history (id,title,uploader,summary,auth1,auth2,auth3,auth4,auth5,uploadname) VALUES(?,?,?,?,?,?,?,?,?,?)');
                                    $sql4->execute([$pid,$title,$login,$summary,$auth1,$auth2,$auth3,$auth4,$auth5,$newname]);
                                    

                                    $sql6=$pdo->query("select f_name from newpaper_field where title='".$title."'");
                                    foreach($sql6 as $f){
                                        $f_name[]=$f["f_name"];
                                    }
                                    
                                    if(isset($f_name) && (implode(',',$f_name) != implode(',',$field))){
                                        $sql8=$pdo ->prepare("delete from newpaper_field where title=?");
                                        $sql8->execute([$title]);

                                        foreach($field as $v){
                                            $sql3=$pdo ->prepare('INSERT INTO newpaper_field (title, f_name) VALUES (?,?)');
                                            $sql3->execute([$title,$v]);
                                        }
                                    }else{
                                        foreach($field as $v){
                                            $sql3=$pdo ->prepare('INSERT INTO newpaper_field (title, f_name) VALUES (?,?)');
                                            $sql3->execute([$title,$v]);
                                        }
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
                                                摘要：<?php $Summary=nl2br($summary); echo $Summary; ?></p>

                                            <h4 class="m-0 font-14">
                                                領域：<p class='badge badge-soft-secondary mr-1'>
                                                    <?php echo implode(',',$field) ?></p>

                                            </h4>
                                        </div>
                                    </div>
                                </div> <!-- end card-->
                            </div> <!-- end col-->
                        </div>
                        <!-- end row-->

                    </div>


                    <?php
                                        
                                        // $odlname=$_FILES["file"]["tmp_name"];

                                        if ($_FILES["file"]["error"] > 0){
                                            "Error: " . $_FILES["file"]["error"];
                                        }else{
                                            "檔案名稱: " . $newname."<br/>";
                                            "檔案類型: " . $_FILES["file"]["type"]."<br/>";
                                            "檔案大小: " . ($_FILES["file"]["size"] / 1024)." Kb<br />";
                                            "暫存名稱: " . $_FILES["file"]["tmp_name"];
                                            move_uploaded_file($_FILES["file"]["tmp_name"],"upload/".$newname);
                                            move_uploaded_file($_FILES["file_x"]["tmp_name"],"upload_x/".$newname);
                                        }

                                        $sql5 = $pdo->query("select name,email from account where status='管理者' ");

                                        foreach($sql5 as $row){
                                            $to_email = $row['email']; //管理者信箱
                                            $name = $row['name']; //管理者姓名

                                            require_once '../PHPMailer/PHPMailerAutoload.php';

                                            $mail = new PHPMailer;

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

                                           
                                            $mail->Subject = "輔仁管理評論有新的投稿稿件，請您分配給審稿者！";
                                            $mail->Body    =  file_get_contents('../mail.html', true);
                                            $mail->AltBody = '親愛的管理者您好，輔仁管理評論目前收到一封新的投稿稿件，請您盡速到輔仁管理評論的管理者平台分配稿件，謝謝您！';
                                        }

                                            if(!$mail->send()) {
                                                echo 'Message could not be sent.';
                                                echo 'Mailer Error: ' . $mail->ErrorInfo;
                                            } else {
                                                echo ''; 
                                            }
                                    }
                                    ?>
                </div> <!-- end card-box -->
            </div> <!-- content -->
        </div>
    </div>
    <!-- END wrapper -->
</body>

</html>