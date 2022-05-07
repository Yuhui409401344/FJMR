<?php 
session_start();
if(isset($_SESSION["account"]["login"])){
    $login=$_SESSION["account"]["login"];
}

?>
<link rel="apple-touch-icon" sizes="180x180" href="../assets/images/logo/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="../assets/images/logo/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="../assets/images/logo/favicon-16x16.png">
<link rel="icon" href="../assets/images/logo/logo.ico" type="image/x-icon">
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row mt-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- Start project here-->
                            <div style="height: 100vh">
                                <?php
                                   
                                    //開啟圖片檔
                                    $file = fopen($_FILES["file"]["tmp_name"], "rb");
                                    // 讀入圖片檔資料
                                    $fileContents = fread($file, filesize($_FILES["file"]["tmp_name"])); 
                                    //關閉圖片檔
                                    fclose($file);
                                    //讀取出來的圖片資料必須使用base64_encode()函數加以編碼：圖片檔案資料編碼
                                    $fileContents = base64_encode($fileContents);
                                    $imgType = $_FILES["file"]["tmp_name"];

                                   
                                    
                                    
                                    $pdo=new PDO('mysql:host=localhost;dbname=fjup;charset=utf8','root', '');
                                  
                                    $sql0=$pdo ->prepare("delete from  account_img where login=?");
                                    $sql0->execute([$login]);
                                    $sql1=$pdo ->prepare("INSERT INTO account_img (login,photo,imgType) VALUES(?,?,?)");
                                    $sql1->execute([$login,$fileContents,$imgType]);
                                 
                                  
                                    if ($_FILES["file"]["error"] > 0){
                                        echo "Error: " . $_FILES["file"]["error"];
                                    }else{
                                        echo "<script> {window.alert('修改成功');location.href='profile.php'} </script>";
                                    }
                                    
                                ?>
                            </div>


                            <!-- /Start your project here-->
                            <div>
                            </div>
                        </div>
                        <div>
                            <div>
                                <div>
                                    <div>