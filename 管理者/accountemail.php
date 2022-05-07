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

    <!-- third party css -->
    <link href="../assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <!-- third party css end -->

    <!-- App css -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
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
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <?php
                                    // include "header.php";
                                    $pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
                                    $login = $_GET["login"];
                                    $status = $_GET["status"];
                                    $sql = $pdo->query("select name,password,email from account where login='$login' and status='$status'");
                                    foreach ($sql as $row) {
                                        $to_email = $row['email']; //管理者信箱
                                        $name = $row['name']; //管理者姓名
                                        $password = $row['password'];

                                        require_once '../PHPMailer/PHPMailerAutoload.php';

                                        $mail = new PHPMailer;

                                        $mail->isSMTP();
                                        $mail->Host = 'smtp.gmail.com';
                                        $mail->SMTPAuth = true;
                                        $mail->Username = 'fjmreview@gmail.com'; // SMTP username
                                        $mail->Password = 'iormzmrmiwoabbik'; // SMTP password
                                        $mail->SMTPSecure = 'tls';
                                        $mail->Port = 587;

                                        $mail->setFrom('fjmreview@gmail.com', 'FJMR');
                                        $mail->addAddress($to_email, $name);
                                        $mail->isHTML(true);


                                        $mail->Subject = "輔仁管理評論將帳號密碼寄送給您！";
                                        $content = '親愛的' . $status . '您好，這是您在輔仁管理評論帳號與密碼:';
                                        $mail->Body = '親愛的' . $name . '您好，這是您在輔仁管理評論帳號與密碼:<br><br>帳號:' . $login . '<br>密碼:' . $password . '<br><br><a href="http://fjmr.fju.edu.tw/">點擊此前往輔仁管理評論</a>';
                                        $mail->AltBody = '親愛的' . $status . '您好，這是您在輔仁管理評論帳號與密碼:<br>帳號:' . $login . '<br>密碼:' . $password . '';
                                    }

                                    if (!$mail->send()) {
                                        echo 'Message could not be sent.';
                                        echo 'Mailer Error: ' . $mail->ErrorInfo;
                                    } else {
                                        echo '';
                                    }
                                    echo "<script>alert('寄送成功!');location.href='" . $_SERVER["HTTP_REFERER"] . "';</script>";
                                    ?>
                                </div>
                            </div> <!-- end card-->
                        </div> <!-- end col -->
                    </div>
                </div> <!-- container -->

            </div> <!-- content -->


        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->
    </div>
    <!-- END wrapper -->



    <!-- Vendor js -->
    <script src="../assets/js/vendor.min.js"></script>

    <!-- Todo app -->
    <script src="../assets/js/pages/jquery.todo.js"></script>

    <!-- third party js -->
    <script src="../assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
    <!-- third party js ends -->

    <!-- Tickets js -->
    <script src="../assets/js/pages/tickets.js"></script>

    <!-- App js -->
    <script src="../assets/js/app.min.js"></script>
</body>

</html>