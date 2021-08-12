<?php 
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
if(isset($_SESSION["account"]["login"])){
    $manager=$_SESSION["account"]["login"];
    foreach ($pdo->query("select status from account where login= '".$manager."'") as $row) {
    $status[] = $row['status'];
    }
    if(in_array("管理者",$status)){
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
                                        
                                        $id=$_GET['id'];  
                                        $link=mysqli_connect("localhost","root","","fjup");
                                        $sql="select * from newpaper where id='".$id."'";
                                        $rs=mysqli_query($link,$sql);
                                        if($record=mysqli_fetch_row($rs))
                                        {
                                            $title=$record[1];
                                            $auth1=$record[2];
                                            $auth2=$record[3];
                                            $auth3=$record[4];
                                            $auth4=$record[5];
                                            $auth5=$record[6];
                                        }
                                        mysqli_close($link);
                                ?>
                                <div class="card-box">
                                     <form method="post" action="reply-cancel-output.php?id=<?php echo $id ?>" enctype="multipart/form-data">
                                    <div class="card-box">
                                        <div class="form-group mb-3">
                                            <label for="title">標題</label><br>
                                            <h4 ><?php echo $title ?> </h4>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="product-name">收件人（投稿者）</label>
                                            <h4><?php echo $auth1,' ',$auth2,' ',$auth3,' ',$auth4 ?></h4>

                                        </div>    
                                        <div class="form-group mb-3">
                                            <label for="product-reference">回覆評級</label><br>
                                                <div class="radio form-check-inline">&nbsp;&nbsp;&nbsp;
                                                    <input type="radio" checked id="inlineRadio1" value="退稿" name="level">
                                                    <label for="inlineRadio1"> 退稿</label>
                                                </div>
                                                <div class="radio form-check-inline">
                                                    <input type="radio" id="inlineRadio3" value="大幅修改" name="level">
                                                    <label for="inlineRadio3"> 大幅修改 </label>
                                                </div>
                                                <div class="radio form-check-inline">
                                                    <input type="radio" id="inlineRadio4" value="小幅修改" name="level">
                                                    <label for="inlineRadio4"> 小幅修改 </label>
                                                </div>
                                                </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <div class="form-group mb-3">
                                                <label for="example-textarea">回覆</label>
                                                <textarea class="form-control" id="example-textarea" name="message" rows="5"></textarea>
                                            </div>
                                        <!-- <div class="form-group mb-3">
                                            <input name="file" type="file">
                                        </div> -->
                                    </div>
                                        <div class="fallback">
                                            
                                        </div>
                                         <div class="row">
                                             <div class="col-12">
                                                 <div class="text-center">
                                                    <input class="btn btn-primary waves-effect waves-light" type="submit" value="傳送">
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
    }else{
        include "pages-404.html";
    }
}else{
    include "pages-404.html";
}
?>