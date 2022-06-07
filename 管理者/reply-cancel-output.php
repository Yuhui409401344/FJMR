<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
if (isset($_SESSION["account"]["login"])) {
    $manager = $_SESSION["account"]["login"];
    foreach ($pdo->query("select status from account where login= '" . $manager . "'") as $row) {
        $status[] = $row['status'];
    }
    if (in_array("管理者", $status)) {

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
            <!-- App favicon -->
            <link rel="shortcut icon" href="../assets/images/favicon.ico">

            <link rel="apple-touch-icon" sizes="180x180" href="../assets/images/logo/apple-touch-icon.png">
            <link rel="icon" type="image/png" sizes="32x32" href="../assets/images/logo/favicon-32x32.png">
            <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/logo/favicon-16x16.png">
            <link rel="icon" href="../assets/images/logo/logo.ico" type="image/x-icon">

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
                        <?php
                        $id = $_GET["id"];
                        $level = $_POST["level"];
                        $message = $_POST["message"];
                        $pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
                        foreach ($pdo->query("select * from newpaper where id='" . $id . "'") as $row) {
                            $title = $row["title"];
                            $uploader = $row["uploader"];
                            $auth1 = $row['auth1'];
                            $auth2 = $row['auth2'];
                            $auth3 = $row['auth3'];
                            $auth4 = $row['auth4'];
                            $auth5 = $row['auth5'];
                            $summary = $row['summary'];

                            $replytime = "SELECT COUNT(*) AS count_ FROM totalreply WHERE title='" . $title . "'";
                            $result = $pdo->query($replytime);
                            foreach ($result as $row) {
                                $sql = $pdo->prepare('insert into totalreply (id,title,uploader,senter,auth1,auth2,auth3,auth4,auth5,level,message,replycount) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)');
                                $sql->execute([$id, $title, $uploader, $login, $auth1, $auth2, $auth3, $auth4, $auth5, $level, $message, $row['count_']]);

                                $count_ = $row['count_'];
                            }
                        }

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

                            $mail->Subject = "=?utf-8?B?" . base64_encode("輔仁管理評論有一封已評閱完畢的稿件，請盡速查閱。") . "?=";
                            $mail->Body    =  require "mail-author.php";
                            $mail->AltBody = '親愛的投稿者您好，輔仁管理評論目前收到一封已評閱完畢的稿件，請您盡速到輔仁管理評論確認結果，謝謝您！';
                        }

                        if (!$mail->send()) {
                            echo 'Message could not be sent.';
                            echo 'Mailer Error: ' . $mail->ErrorInfo;
                        } else {
                            // echo 'Message has been sent';
                        }


                        // echo "<script> {window.alert('發送成功');'} </script>";
                        $sql3 = $pdo->prepare('delete from newpaper where id=?');
                        $sql3->execute([$id]);
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
                                                <!-- <small class="float-right">上傳日期：<?php echo $uploadtime ?></small> -->
                                                <h4 class="m-0 font-14">
                                                    作者：<?php echo $auth1, ' ', $auth2, ' ', $auth3, ' ', $auth4, ' ', $auth5 ?>
                                                </h4>
                                                <hr />
                                                <p style="text-align: justify; padding-right: 30px;font-family:Microsoft JhengHei">
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
                                                            非匿名稿件檔案：
                                                            <a href='../投稿者/upload/<?php echo $paper ?>' target="blank" download="<?php echo $title ?>">
                                                                <?php echo  $title ?>
                                                            </a>
                                                        </div>
                                                        <div class="col-auto">
                                                            <!-- Button -->
                                                            <a href='../投稿者/upload/<?php echo $paper ?>' target="blank" download="<?php echo $title  ?>">
                                                                <i class="dripicons-download"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card mb-1 shadow-none border">
                                                <div class="p-2">
                                                    <div class="row align-items-center">
                                                        <div class="col-auto">

                                                            <i class="mdi mdi-attachment"></i>

                                                        </div>
                                                        <div class="col pl-0">
                                                            匿名稿件檔案：
                                                            <a href='../投稿者/upload_x/<?php echo $paper ?>' target="blank" download="<?php echo $title ?>">
                                                                <?php echo  $title ?>
                                                            </a>
                                                        </div>
                                                        <div class="col-auto">
                                                            <!-- Button -->
                                                            <a href='../投稿者/upload_x/<?php echo $paper ?>' target="blank" download="<?php echo $title  ?>">
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
                        foreach ($pdo->query("select distinct name,email from account where login='" . $login . "'") as $row) {
                            $name = $row['name'];
                            $email = $row['email'];
                        }

                        foreach ($pdo->query("select photo, imgType from account_img where account_img.login ='" . $login . "'") as $row) {
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
                                                    if (isset($img)) {
                                                        echo '<img src="data:' . $imgType . ';base64,' . $img . '"   height="32" class="d-flex mr-2 rounded-circle"  />';
                                                    } else {
                                                        echo '<img src="../assets/images/user.png"   height="32" class="d-flex mr-2 rounded-circle"  />';
                                                    };
                                                    ?>

                                                    <div class="media-body">
                                                        <h6 class="m-0 font-14"><?php echo $name ?>
                                                        </h6>
                                                        <small class="text-muted"><?php echo $email ?></small>
                                                    </div>
                                                </div>

                                                <p style="text-align: justify; padding-right: 30px;font-family:Microsoft JhengHei">
                                                    回覆評級： <?php
                                                            if ($level == '大幅修改') {
                                                                echo  "<span class='badge badge-soft-warning'>大幅修改</span>";
                                                            } elseif ($level == '小幅修改') {
                                                                echo  "<span class='badge badge-soft-success'>小幅修改</span>";
                                                            } elseif ($level == '退稿') {
                                                                echo "<span class='badge badge-soft-danger'>退稿</span>";
                                                            }
                                                            ?></p>
                                                <p style="text-align: justify; padding-right: 30px;font-family:Microsoft JhengHei">
                                                    回覆次數：<?php echo $RCount + 1 ?></p>

                                                <p style="text-align: justify; padding-right: 30px;font-family:Microsoft JhengHei">
                                                    留言：<?php echo  $message ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end col -->
                            </div>
                            <!-- end row -->
                        </div> <!-- container -->
                    </div><!-- end col-->
                </div>
                <!-- end row -->



                <!-- file preview template -->
                <div class="d-none" id="uploadPreviewTemplate">
                    <div class="card mt-1 mb-0 shadow-none border">
                        <div class="p-2">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <img data-dz-thumbnail src="#" class="avatar-sm rounded bg-light" alt="">
                                </div>
                                <div class="col pl-0">
                                    <a href="javascript:void(0);" class="text-muted font-weight-bold" data-dz-name></a>
                                    <p class="mb-0" data-dz-size></p>
                                </div>
                                <div class="col-auto">
                                    <!-- Button -->
                                    <a href="" class="btn btn-link btn-lg text-muted" data-dz-remove>
                                        <i class="dripicons-cross"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div> <!-- container -->

            </div> <!-- content -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


            </div>
            <!-- END wrapper -->

            <!-- Right Sidebar -->
            <div class="right-bar">
                <div data-simplebar class="h-100">

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs nav-bordered nav-justified" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link py-2" data-toggle="tab" href="#tasks-tab" role="tab">
                                <i class="mdi mdi-format-list-checkbox d-block font-22 my-1"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link py-2 active" data-toggle="tab" href="#settings-tab" role="tab">
                                <i class="mdi mdi-cog-outline d-block font-22 my-1"></i>
                            </a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content pt-0">
                        <div class="tab-pane" id="tasks-tab" role="tabpanel">
                            <h6 class="font-weight-medium px-3 m-0 py-2 font-13 text-uppercase bg-light">
                                <span class="d-block py-1">待辦事項</span>
                            </h6>
                            <div class="card">
                                <div class="card-body">

                                    <div class="todoapp">
                                        <div class="row">
                                            <div class="col">
                                                <h5 id="todo-message"><span id="todo-remaining">4</span> of <span id="todo-total">8</span> remaining</h5>
                                            </div>
                                            <div class="col-auto">
                                                <a href="" class="float-right btn btn-light btn-sm" id="btn-archive">更新</a>
                                            </div>
                                        </div>

                                        <div style="max-height: 310px;" data-simplebar="init">
                                            <div class="simplebar-wrapper" style="margin: 0px;">
                                                <div class="simplebar-height-auto-observer-wrapper">
                                                    <div class="simplebar-height-auto-observer"></div>
                                                </div>
                                                <div class="simplebar-mask">
                                                    <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                                        <div class="simplebar-content-wrapper" style="height: auto; overflow: hidden scroll;">
                                                            <div class="simplebar-content" style="padding: 0px;">
                                                                <ul class="list-group list-group-flush todo-list" id="todo-list">
                                                                    <li class="list-group-item border-0 pl-0">
                                                                        <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input todo-done" id="8"><label class="custom-control-label" for="8">準備課室會議</label></div>
                                                                    </li>
                                                                    <li class="list-group-item border-0 pl-0">
                                                                        <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input todo-done" id="7" checked=""><label class="custom-control-label" for="7"><s>回覆李雯教授</s></label></div>
                                                                    </li>
                                                                    <li class="list-group-item border-0 pl-0">
                                                                        <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input todo-done" id="6"><label class="custom-control-label" for="6">創建新帳號給李敏同學</label></div>
                                                                    </li>
                                                                    <li class="list-group-item border-0 pl-0">
                                                                        <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input todo-done" id="5"><label class="custom-control-label" for="5">回覆系秘</label></div>
                                                                    </li>
                                                                    <li class="list-group-item border-0 pl-0">
                                                                        <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input todo-done" id="4" checked=""><label class="custom-control-label" for="4"><s>回覆研究計劃</s></label></div>
                                                                    </li>
                                                                    <li class="list-group-item border-0 pl-0">
                                                                        <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input todo-done" id="3" checked=""><label class="custom-control-label" for="3"><s>開題準備</s></label></div>
                                                                    </li>
                                                                    <li class="list-group-item border-0 pl-0">
                                                                        <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input todo-done" id="2" checked=""><label class="custom-control-label" for="2"><s>創建新帳號給林姚教授</s></label></div>
                                                                    </li>
                                                                    <li class="list-group-item border-0 pl-0">
                                                                        <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input todo-done" id="1"><label class="custom-control-label" for="1">刪除陳立同學帳號</label></div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="simplebar-placeholder" style="width: auto; height: 360px;">
                                                </div>
                                            </div>
                                            <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                                <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                                            </div>
                                            <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                                                <div class="simplebar-scrollbar" style="height: 266px; transform: translate3d(0px, 0px, 0px); display: block;">
                                                </div>
                                            </div>
                                        </div>

                                        <form name="todo-form" id="todo-form" class="needs-validation mt-3" novalidate="">
                                            <div class="row">
                                                <div class="col">
                                                    <input type="text" id="todo-input-text" name="todo-input-text" class="form-control" placeholder="新增待辦" required="">
                                                    <div class="invalid-feedback">
                                                        Please enter your task name
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <button class="btn-primary btn-md btn-block btn waves-effect waves-light" type="submit" id="todo-btn-submit">新增</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div> <!-- end .todoapp-->

                                </div> <!-- end card-body -->
                            </div>
                        </div>


                        <div class="tab-pane active" id="settings-tab" role="tabpanel">
                            <h6 class="font-weight-medium px-3 m-0 py-2 font-13 text-uppercase bg-light">
                                <span class="d-block py-1">主題設定</span>
                            </h6>

                            <div class="p-3">
                                <h6 class="font-weight-medium font-14 mt-4 mb-2 pb-1">背景顏色</h6>
                                <div class="custom-control custom-switch mb-1">
                                    <input type="radio" class="custom-control-input" name="color-scheme-mode" value="light" id="light-mode-check" checked />
                                    <label class="custom-control-label" for="light-mode-check">淺色</label>
                                </div>

                                <div class="custom-control custom-switch mb-1">
                                    <input type="radio" class="custom-control-input" name="color-scheme-mode" value="dark" id="dark-mode-check" />
                                    <label class="custom-control-label" for="dark-mode-check">深色</label>
                                </div>

                                <!-- Width -->
                                <h6 class="font-weight-medium font-14 mt-4 mb-2 pb-1">側邊欄</h6>
                                <div class="custom-control custom-switch mb-1">
                                    <input type="radio" class="custom-control-input" name="width" value="fluid" id="fluid-check" checked />
                                    <label class="custom-control-label" for="fluid-check">打開</label>
                                </div>
                                <div class="custom-control custom-switch mb-1">
                                    <input type="radio" class="custom-control-input" name="width" value="boxed" id="boxed-check" />
                                    <label class="custom-control-label" for="boxed-check">收起</label>
                                </div>

                                <!-- Left Sidebar-->
                                <h6 class="font-weight-medium font-14 mt-4 mb-2 pb-1">側邊欄顏色</h6>

                                <div class="custom-control custom-switch mb-1">
                                    <input type="radio" class="custom-control-input" name="leftsidebar-color" value="light" id="light-check" checked />
                                    <label class="custom-control-label" for="light-check">淺色</label>
                                </div>

                                <div class="custom-control custom-switch mb-1">
                                    <input type="radio" class="custom-control-input" name="leftsidebar-color" value="dark" id="dark-check" />
                                    <label class="custom-control-label" for="dark-check">深色</label>
                                </div>

                                <div class="custom-control custom-switch mb-1">
                                    <input type="radio" class="custom-control-input" name="leftsidebar-color" value="brand" id="brand-check" />
                                    <label class="custom-control-label" for="brand-check">天藍色</label>
                                </div>

                                <div class="custom-control custom-switch mb-3">
                                    <input type="radio" class="custom-control-input" name="leftsidebar-color" value="gradient" id="gradient-check" />
                                    <label class="custom-control-label" for="gradient-check">亮紫色</label>
                                </div>

                                <!-- size -->
                                <h6 class="font-weight-medium font-14 mt-4 mb-2 pb-1">側邊欄大小</h6>

                                <div class="custom-control custom-switch mb-1">
                                    <input type="radio" class="custom-control-input" name="leftsidebar-size" value="default" id="default-size-check" checked />
                                    <label class="custom-control-label" for="default-size-check">預設</label>
                                </div>

                                <div class="custom-control custom-switch mb-1">
                                    <input type="radio" class="custom-control-input" name="leftsidebar-size" value="condensed" id="condensed-check" />
                                    <label class="custom-control-label" for="condensed-check">最小化</small></label>
                                </div>

                                <div class="custom-control custom-switch mb-1">
                                    <input type="radio" class="custom-control-input" name="leftsidebar-size" value="compact" id="compact-check" />
                                    <label class="custom-control-label" for="compact-check">中等</small></label>
                                </div>

                                <!-- Topbar -->
                                <h6 class="font-weight-medium font-14 mt-4 mb-2 pb-1">頂欄</h6>

                                <div class="custom-control custom-switch mb-1">
                                    <input type="radio" class="custom-control-input" name="topbar-color" value="dark" id="darktopbar-check" checked />
                                    <label class="custom-control-label" for="darktopbar-check">深色</label>
                                </div>

                                <div class="custom-control custom-switch mb-1">
                                    <input type="radio" class="custom-control-input" name="topbar-color" value="light" id="lighttopbar-check" />
                                    <label class="custom-control-label" for="lighttopbar-check">淺色</label>
                                </div>


                                <button class="btn btn-primary btn-block mt-4" id="resetBtn">重置為默認</button>

                            </div>

                        </div>
                    </div>

                </div> <!-- end slimscroll-menu-->
            </div>
            <!-- /Right-bar -->


            <!-- Todo app -->
            <script src="../assets/js/pages/jquery.todo.js"></script>

            <!-- Right bar overlay-->
            <div class="rightbar-overlay"></div>

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
<?php
    } else {
        include "pages-404.html";
    }
} else {
    include "pages-404.html";
}
?>