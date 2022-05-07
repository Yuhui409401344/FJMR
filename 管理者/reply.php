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

                <!-- Start Content-->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <br>
                            <?php
                                        
                                $title=$_GET['title'];
                                $pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
                                    foreach ($pdo->query("select * from reply where title='".$title."'") as $row) 
                                    {       
                                        $id=$row["id"];
                                        $title=$row['title'];
                                        $auth1=$row['auth1'];
                                        $auth2=$row['auth2'];
                                        $auth3=$row['auth3'];
                                        $auth4=$row['auth4'];
                                        $auth5=$row['auth5'];
                                    }
                                ?>
                            <div class="card-box">
                                <form method="post" action="reply-output.php?title=<?php echo $title ?>"
                                    enctype="multipart/form-data">
                                    <div class="card-box">
                                        <div class="form-group mb-3">
                                            <label class=" font-weight-bold text-muted" for="title">標題</label><br>
                                            <b><?php echo $title ?> </b>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class=" font-weight-bold text-muted"
                                                for="product-name">收件人（投稿者）</label><br>
                                            <b><?php echo $auth1,' ',$auth2,' ',$auth3,' ',$auth4,' ',$auth5 ?></b>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class=" font-weight-bold text-muted" for="product-name">審稿者回覆</label>
                                            <?php
                                        foreach ($pdo->query("select * from reply where title='".$title."'") as $row) 
                                                    {
                                                            $senter=$row["senter"];
                                                            $comment=$row['comment'];
                                                            $level=$row['level'];
                                            ?>
                                            <h4>
                                                <?php echo $senter?>
                                                <?php
                                                if ($level=="接受") echo "<span class='badge badge-soft-success'>接受</span>";
                                                elseif ($level=="小幅修改") echo "<span class='badge badge-soft-primary'>小幅修改</span>";
                                                elseif ($level=="大幅修改") echo "<span class='badge badge-soft-warning'>大幅修改</span>";
                                                else echo "<span class='badge badge-soft-danger'>拒絕</span>";?>
                                            </h4>
                                            <p><?php echo $comment ?></p>
                                            <?php }
                                           ?>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class=" font-weight-bold text-muted"
                                                for="product-reference">回覆建議</label><br>
                                            <textarea class="form-control" name="comment" rows="5"></textarea>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class=" font-weight-bold text-muted"
                                                for="product-reference">回覆評級</label><br>
                                            <div class="radio form-check-inline">&nbsp;&nbsp;&nbsp;
                                                <input type="radio" id="inlineRadio2" value="接受" name="level">
                                                <label for="inlineRadio2"> 接受 </label>
                                            </div>
                                            <div class="radio form-check-inline">
                                                <input type="radio" id="inlineRadio3" value="大幅修改" name="level">
                                                <label for="inlineRadio3"> 大幅修改 </label>
                                            </div>
                                            <div class="radio form-check-inline">
                                                <input type="radio" id="inlineRadio4" value="小幅修改" name="level">
                                                <label for="inlineRadio4"> 小幅修改 </label>
                                            </div>
                                            <div class="radio form-check-inline">
                                                <input type="radio" id="inlineRadio5" value="拒絕" name="level">
                                                <label for="inlineRadio5"> 拒絕 </label>
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <input name="file" type="file" accept=".pdf,.doc,.docx" required>
                                        </div>
                                    </div>
                                    <div class="fallback">

                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="text-center">
                                                <input class="btn btn-primary waves-effect waves-light" type="submit"
                                                    value="傳送">
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <!-- Preview -->
                                <div class="dropzone-previews mt-3" id="file-previews"></div>
                            </div> <!-- end col-->
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
                                            <a href="javascript:void(0);" class="text-muted font-weight-bold"
                                                data-dz-name></a>
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