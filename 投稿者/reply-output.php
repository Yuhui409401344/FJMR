<!DOCTYPE html>
<html lang="en">

<?php include "nav.php" ?>

<body class="loading">

    <!-- Begin page -->
    <div id="wrapper">


        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">
                <!-- Start Content-->
                <div class="mt-3 container-fluid">
                    <?php
                    $title = $_POST["title"];
                    // $field=$_POST["field"];
                    $summary = $_POST["summary"];
                    $auth1 = $_POST["auth1"];
                    $auth2 = $_POST["auth2"];
                    $auth3 = $_POST["auth3"];
                    $auth4 = $_POST["auth4"];
                    $auth5 = $_POST["auth5"];
                    $uploadtime = "";



                    $pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
                    $sql1 = "select count(*) as count from newpaper_history where title='" . $title . "'";
                    $result = $pdo->query($sql1);
                    foreach ($result as $row) {
                        $row["count"];
                    }
                    $filename = $_FILES["file"]["name"];
                    $name = explode('.', $filename);
                    $newname = $title . 'r' . $row["count"] . '.' . $name[1];

                    $sql2 = $pdo->prepare('insert into newpaper (title,uploader,summary,auth1,auth2,auth3,auth4,auth5,uploadname) VALUES(?,?,?,?,?,?,?,?,?)');
                    $sql2->execute([$title, $login, $summary, $auth1, $auth2, $auth3, $auth4, $auth5, $newname]);

                    $id = "select id from newpaper where title='" . $title . "' and uploadname='" . $newname . "' ";
                    $paper_id = $pdo->query($id);
                    foreach ($paper_id as $pid) {
                        $pid["id"];
                    }

                    $sql4 = $pdo->prepare('insert into newpaper_history (id,title,uploader,summary,auth1,auth2,auth3,auth4,auth5,uploadname) VALUES(?,?,?,?,?,?,?,?,?,?)');
                    $sql4->execute([$pid["id"], $title, $login, $summary, $auth1, $auth2, $auth3, $auth4, $auth5, $newname]);

                    $c = $row['count'] - 1;
                    $sql5 = $pdo->prepare("UPDATE totalreply SET have_reply=? WHERE replycount=? and title=?");
                    $sql5->execute(['0', $c, $title]);

                    // $odlname=$_FILES["file"]["tmp_name"];

                    if ($_FILES["file"]["error"] > 0) {
                        echo "Error: " . $_FILES["file"]["error"];
                    } else {
                        "????????????: " . $newname . "<br/>";
                        "????????????: " . $_FILES["file"]["type"] . "<br/>";
                        "????????????: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
                        "????????????: " . $_FILES["file"]["tmp_name"];
                        move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $newname);
                        move_uploaded_file($_FILES["file_x"]["tmp_name"], "upload_x/" . $newname);
                    }

                    $sql5 = $pdo->query("select name,email from account where status='?????????' ");

                    foreach ($sql5 as $row) {
                        $to_email = $row['email'];     //???????????????
                        $name = $row['name'];         //???????????????

                        require_once '../PHPMailer/PHPMailerAutoload.php';

                        $mail = new PHPMailer;

                        $mail->isSMTP();
                        $mail->Host = 'smtp.gmail.com';
                        $mail->SMTPAuth = true;
                        $mail->Username = 'paggiechen8866@gmail.com';                 // SMTP username
                        $mail->Password = 'vtqnavfijdkcjpln';                         // SMTP password
                        $mail->SMTPSecure = 'tls';
                        $mail->Port = 587;

                        $mail->setFrom('paggiechen8866@gmail.com', 'FJMR');
                        $mail->addAddress($to_email, $name);
                        $mail->isHTML(true);


                        $mail->Subject = "??????????????????????????????????????????????????????????????????????????????";
                        $content = '??????????????????????????????????????????????????????????????????????????????????????????'.$title.'????????????????????????????????????????????????????????????????????????????????????';
                        $mail->Body    =  require 'mail.php';
                        $mail->AltBody = "????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????";
                    }
                    if (!$mail->send()) {
                        echo 'Message could not be sent.';
                        echo 'Mailer Error: ' . $mail->ErrorInfo;
                    } else {
                        echo '';
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
                                                ?????????<?php echo $auth1, ' ', $auth2, ' ', $auth3, ' ', $auth4, ' ', $auth5 ?>
                                            </h4>
                                            <hr />
                                            <p
                                                style="text-align: justify; padding-right: 30px;font-family:Microsoft JhengHei">
                                                ?????????<?php echo $summary; ?></p>

                                            <h4 class="m-0 font-14">
                                                ?????????<p class='badge badge-soft-secondary mr-1'>
                                                    <?php
                                                    $sql3 = $pdo->query("select f_name from newpaper_field where title = '" . $title . "'");
                                                    foreach ($sql3 as $first) {
                                                        $field = $first['f_name'];
                                                        echo $field . ' ';
                                                    }
                                                    ?>

                                            </h4>
                                        </div>
                                    </div>
                                </div> <!-- end card-->
                            </div> <!-- end col-->
                        </div>
                    </div>
                </div>
            </div> <!-- container -->
        </div> <!-- content -->
    </div>
    <!-- END wrapper -->
</body>

</html>