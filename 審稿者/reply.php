<?php include "header.php" ?>
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
        <div class="content-page">
            <div class="content">

                <!-- Start Content-->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <br>
                            <?php
                                    $id=$_GET['id'];
                                    $pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
                                    foreach ($pdo->query("select * from distri where id='".$id."'") as $row) {
                                        $id=$row["id"];
                                        $auth1=$row['auth1'];
                                        $auth2=$row['auth2'];
                                        $auth3=$row['auth3'];
                                        $auth4=$row['auth4'];
                                        $auth5=$row['auth5'];
                                        $title=$row['title'];
                                        $pro=$row['pro'];
                                        $ddl=$row['ddl'];
                                        $summary=$row['summary'];   
                                        $filename=$row['filename'];
                                        $uploadtime=$row['uploadtime'];
                                        $manager = $row['manager'];

                                    }
                                       
                                ?>
                            <div class="card-box">
                                <form method=POST action="reply-output.php?title=<?php echo $title ?>"
                                    enctype="multipart/form-data">

                                    <!-- 標題 -->
                                    <div class="form-group mb-3">
                                        <label for="product-reference"
                                            class=" font-weight-bold text-muted">標題</label><br>
                                        <b><?php echo $title ?></b>
                                    </div>

                                    <!-- 作者 -->
                                    <div class="form-group mb-3">
                                        <label for="product-reference"
                                            class=" font-weight-bold text-muted">作者</label><br>
                                        <b><?php echo $auth1,' ',$auth2,' ',$auth3,' ',$auth4,' ',$auth5 ?></b>
                                    </div>

                                    <!-- 收件人（管理者） recipient -->
                                    <div class="form-group mb-3">
                                        <!-- <p class="font-weight-bold text-muted">收件人</p>  
                                            <?php
                                                $conn = mysqli_connect('localhost','root','','fjup');
                                                if (!$conn) {
                                                    die('Could not connect: ' . mysqli_error($con));
                                                }
                                                $sql="SELECT * FROM account where status='管理者'";  
                                                $result = mysqli_query($conn, $sql);
                                                echo "<select  action='reply-output.php' method='post' class='form-control' data-toggle='select2'  name='recipient' aria-placeholder='請選擇'>";
                                                while($row = mysqli_fetch_array($result)) {
                                                echo "<option name='recipient' value='" . $row["login"] . "'>" . $row["login"] . "</option>";
                                                }echo "</select>";
                                                mysqli_close($conn);
                                            ?> -->
                                        <label for="product-reference"
                                            class=" font-weight-bold text-muted">收件人（管理者）</label><br>
                                        <b><?php echo $manager ?></b>
                                    </div>

                                    <!-- 留言 comment-->
                                    <div class="form-group mb-3">
                                        <label for="product-reference"
                                            class=" font-weight-bold text-muted">回覆建議</label><br>
                                        <textarea class="form-control" name="comment" rows="5" required></textarea>
                                    </div>

                                    <!-- 評級 level -->
                                    <div class="form-group mb-3">
                                        <label for="product-reference"
                                            class=" font-weight-bold text-muted">回覆評級</label><br>
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
                                        <label class=" font-weight-bold text-muted">回覆範例 :</label>&nbsp;&nbsp;
                                        <a href="初審意見書.rtf"><i class="mdi mdi-download"></i>回覆範例檔下載</a>
                                    </div>
                                    <!-- 檔案 file -->
                                    <div class="form-group mb-3">
                                        <input type=file name="file" accept=".pdf,.doc,.docx" id="file"
                                            enctype="multipart/form-data">
                                    </div>

                                    <!-- 送出 -->
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="text-center">
                                                <input class="btn btn-primary waves-effect waves-light" type="submit"
                                                    value="傳送">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div> <!-- end col-->
                    </div>
                    <!-- end row -->
                </div> <!-- container -->

            </div> <!-- content -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->


    </div>


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