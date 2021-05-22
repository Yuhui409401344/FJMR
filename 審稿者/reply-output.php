
<?php 
session_start();
$password=$_SESSION["account"]["password"];
$login=$_SESSION["account"]["login"];
?>

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

                <div class="container-fluid">
                        <div class="row mt-3">
                            <div class="col-lg-12">
                                <div class="card-box">
                                <?php
                                    $title=$_GET['title'];
                                    $recipient=$_POST["recipient"];
                                    $comment=$_POST["comment"];
                                    $level=$_POST["level"];
                                    $uploadtime="";
                                    
                                    
                                    $pdo=new PDO('mysql:host=localhost;dbname=fjup;charset=utf8','root', '');

                                    foreach ($pdo->query("select * from distri where title='".$title."'") as $row) {
                                        $id=$row["id"];
                                        $auth1=$row["auth1"];
                                        $auth2=$row["auth2"];
                                        $auth3=$row["auth3"];
                                        $auth4=$row["auth4"];
                                        $auth5=$row["auth5"];
                                        

                                    }
                                    
                                    // 回復次數
                                    $replytime="SELECT COUNT(*)+1 AS count_ FROM totalreply WHERE title='".$title."'";

                                    $result=$pdo->query($replytime);
                                    foreach($result as $row){

                                        $sql4 = $pdo->query("select count(*) as replycount from reply_history where title='".$title."'");
                                        foreach($sql4 as $a){
                                            $replycount = $a['replycount'];
                                        }
                                        $filename=$_FILES["file"]["name"];
                                        $name= explode('.',$filename);
                                        $newname=$title.'r'.$replycount.'.'.$name[1];

                                        $sql1=$pdo->prepare('insert into reply (id,title,senter,recipient,auth1,auth2,auth3,auth4,auth5,level,replytime,uploadname,comment) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)');
                                        $sql1->execute([$id,$title,$login,$recipient,$auth1,$auth2,$auth3,$auth4,$auth5,$level,$row['count_'] ,$newname,$comment]);
                                        
                                        $sql2=$pdo->prepare('insert into reply_history (id,title,senter,recipient,auth1,auth2,auth3,auth4,auth5,level,replytime,uploadname,comment) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)');
                                        $sql2->execute([$id,$title,$login,$recipient,$auth1,$auth2,$auth3,$auth4,$auth5,$level,$row['count_'] ,$newname,$comment]);

                                        $sql3=$pdo ->prepare("DELETE from distri where distri.pro=? and distri.title=?");
                                        $sql3->execute([$login,$title]);
                                    }

                                    if (empty($level)) {
                                        echo '請輸入評級。';
                                    }else{
                                        
                                    
                                ?>
                                
                                <label for="product-name" style="font-size: 20px;"><?php echo "回覆成功!";?></label>

                                <table>
                                    <tr>
                                        <td><span class="badge badge-soft-secondary" style="font-size:large">標題</span></td>
                                        <td><label style="font-size:18px"><?php echo $_REQUEST['title']?></label></td>
                                    </tr><br>
                                    <tr>
                                        <td><span class="badge badge-soft-secondary" style="font-size:large">收件人</span></td>
                                        <td><label style="font-size:18px"><?php echo $_REQUEST['recipient']?></label></td>
                                    </tr><br>
                                    <tr>
                                        <td><span class="badge badge-soft-secondary" style="font-size:large">回覆建議</span></td>
                                        <td><label style="font-size:18px"><?php 
                                        $comment=nl2br($comment);//回車換成換行
                                        echo $comment; ?></label></td>

                                    </tr><br>
                                    <tr>
                                        <td><span class="badge badge-soft-secondary" style="font-size:large">回覆評級</span>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                        <td><label style="font-size:18px">
                                        <?php echo $_REQUEST['level']; ?></label></td>
                                    </tr><br>
                                    <tr>
                                        <td><span class="badge badge-soft-secondary" style="font-size:large">回覆次數</span></td>
                                        <td><label style="font-size:18px"><?php echo $row['count_'] ?></label></td>
                                    </tr><br>
                                    <tr>
                                        <td><span class="badge badge-soft-secondary" style="font-size:large">檔案名稱</span></td>
                                        <td><label style="font-size:18px">
                                            <?php
                                                
                                                // $odlname=$_FILES["file"]["tmp_name"];
        
                                                # 檢查檔案是否上傳成功
                                                if ($_FILES['file']['error'] === UPLOAD_ERR_OK){
                                                    echo "檔案名稱: " . $newname."<br/>";
                                                    echo "檔案類型: " . $_FILES["file"]["type"]."<br/>";
                                                    echo "檔案大小: " . ($_FILES["file"]["size"] / 1024)." Kb<br />";
                                                    echo "暫存名稱: " . $_FILES["file"]["tmp_name"];
                                                
                                                  # 檢查檔案是否已經存在
                                                  if (file_exists('upload/' . $newname)){
                                                    echo '檔案已存在。<br/>';
                                                  } else {
                                                    # 將檔案移至指定位置
                                                    move_uploaded_file($_FILES["file"]["tmp_name"],"upload/".$newname);
                                                  }
                                                } else {
                                                  echo '錯誤代碼：' . $_FILES['file']['error'] . '<br/>';
                                                }
                                                
                                             ?> 
                                            </label>
                                        </td>
                                    </tr>
                                </table>
                                <?php 
                                    }
                                ?>
                                </div> <!-- end card-box -->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->                
                    </div> <!-- container -->

                </div> <!-- content -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->

       
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