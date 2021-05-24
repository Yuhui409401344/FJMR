<?php 
session_start();
if(isset($_SESSION["account"]["login"])){
    $login=$_SESSION["account"]["login"];
}

?>
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

                                    
                                    



                                    $pdo1 = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
                                    $query=$pdo1->query("SELECT status from account where login='".$login."'");
                                    $statuses=$query->fetchall();
                                    foreach($statuses as $status){
                                        $array[]=$status['status'];
                                    }
                                    
                                    
                                    $pdo=new PDO('mysql:host=localhost;dbname=fjup;charset=utf8','root', '');
                                  
                                    $sql1=$pdo ->prepare("update account_bio set photo=?, imgType=? where login='".$login."'");
                                    $sql1->execute([$fileContents,$imgType]);
                                 
                                  
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