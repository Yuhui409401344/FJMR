<?php 
session_start();
$password=$_SESSION["account"]["password"];
$login=$_SESSION["account"]["login"];
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

    <!-- Bootstrap Tables css -->
    <link href="../assets/libs/bootstrap-table/bootstrap-table.min.css" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="../assets/css/bootstrap.min.(1).css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
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

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title" id="page-title-tour">常見問題</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-xl-6">
                            <div id="accordion" class="mb-3">
                                <div class="card mb-1">
                                    <div class="card-header" id="headingOne">
                                        <h5 class="m-0">
                                            <a class="text-dark" data-toggle="collapse" href="#collapseOne"
                                                aria-expanded="true">
                                                <i class="mdi mdi-help-circle mr-1 text-primary"></i>
                                                投稿流程是什麼？
                                            </a>
                                        </h5>
                                    </div>

                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                        data-parent="#accordion">
                                        <div class="card-body">
                                            輔仁管理評論的用戶分為「投稿者」、「審稿者」、「管理者」。<br>
                                            當投稿者投遞第一份稿件後，管理者會依據稿件領域選擇兩位審稿者，並且訂定回覆期限，將稿件分配給審稿者們。
                                            審稿者必須在期限內回覆稿件給管理者，管理者接著統整兩位審稿者的意見，統一回覆給投稿者。
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-1">
                                    <div class="card-header" id="headingTwo">
                                        <h5 class="m-0">
                                            <a class="text-dark" data-toggle="collapse" href="#collapseTwo"
                                                aria-expanded="false">
                                                <i class="mdi mdi-help-circle mr-1 text-primary"></i>
                                                我如何得知稿件目前的狀態？
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                        data-parent="#accordion">
                                        <div class="card-body">
                                            稿件狀態依序分為「等待主編確認」、「審稿中」、「已接收」、「退稿」，投稿者可以至「歷史稿件」中查看。
                                            <br><br>
                                            <ol style="list-style-type:circle;">
                                                <li>等待主編確認：表示稿件已送出，待管理者分配稿件給審稿者。</li>
                                                <li>審稿中：表示審稿者正在審稿中，尚未回覆給管理者；管理者已收到審稿回覆，但尚未統一回覆意見，傳給投稿者。</li>
                                                <li>已接收：表示管理者已回覆最終意見給投稿者，投稿者可以點擊歷史稿件的標題以查看管理者的回覆意見，或是在「回覆修正檔」中查看。</li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-1">
                                    <div class="card-header" id="headingThree">
                                        <h5 class="m-0">
                                            <a class="text-dark" data-toggle="collapse" href="#collapseThree"
                                                aria-expanded="false">
                                                <i class="mdi mdi-help-circle mr-1 text-primary"></i>
                                                我可以成為審稿者或管理者嗎？
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                        data-parent="#accordion">
                                        <div class="card-body">
                                            目前，輔仁管理評論的所有註冊帳號預設都是「投稿者」身份，若要成為審稿者或管理者，您可以聯繫<a
                                                href="mailto:fjreview@mail.fju.edu.tw">輔仁大學管理學院的邱瑞真秘書</a>，
                                            經過管理者的審核後，方可具有審稿者或管理者身份。
                                        </div>
                                    </div>
                                </div>

                                <div class="card mb-1">
                                    <div class="card-header" id="headingFour">
                                        <h5 class="m-0">
                                            <a class="text-dark" data-toggle="collapse" href="#collapseFour"
                                                aria-expanded="false">
                                                <i class="mdi mdi-help-circle mr-1 text-primary"></i>
                                                稿件級別有幾種？分別代表什麼意義？
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="collapseFour" class="collapse" aria-labelledby="collapseFour"
                                        data-parent="#accordion">
                                        <div class="card-body">
                                            輔仁管理評論的稿件級別分為「接受」、「大幅修改」、「小幅修改」、「拒絕」、「退稿」。<br><br>
                                            <ol style="list-style-type:circle;">
                                                <li>接受：表示稿件通過審核。</li>
                                                <li>大幅修改：表示稿件需要修正的地方較多，投稿者需要上傳修正版本。</li>
                                                <li>小幅修改：表示稿件需要細微的修正，投稿者需要上傳修正版本。</li>
                                                <li>拒絕：表示稿件經過兩位審稿者的審核以及管理者的最終統一意見，得出的結論是稿件不合格。投稿者需要上傳修正版本。</li>
                                                <li>退稿：表示稿件可能離題，或領域填寫錯誤，管理者發現此錯誤後直接將稿件退回給投稿者請求修改。投稿者需要上傳新版本。</li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end #accordions-->
                        </div> <!-- end col -->


                    </div> <!-- end row -->

                </div> <!-- container -->

            </div> <!-- content -->

            <!-- Footer Start -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            2020 - <script>
                            document.write(new Date().getFullYear())
                            </script> &copy; 輔仁管理評論
                        </div>
                        <div class="col-md-6">
                            <div class="text-md-right footer-links d-none d-sm-block">
                                <a href="../home/purpose.php" target="blank">關於</a>
                                <a href="maito:fjreview@mail.fju.edu.tw">聯繫我們</a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end Footer -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->
    </div>
    <!-- END wrapper -->


    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- Vendor js -->
    <script src="../assets/js/vendor.min.js"></script>

    <!-- App js -->
    <script src="../assets/js/app.min.js"></script>



</body>

</html>