<!DOCTYPE html>
<html lang="en">

<body class="loading">

    <!-- Begin page -->
    <div id="wrapper">
        <?php include "nav.php" ?>

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
                                <div class="page-title-left mt-1">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"></li>
                                        <li class="breadcrumb-item active"><a href="history.php">歷史稿件</a></li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">
                                <div class="row">
                                    <div class="container-fluid">

                                        <?php

                                            $id=$_GET["id"];
                                            $s=$_GET["s"];

                                            if($s=="已接收" or $s=="退稿"){    //totalreply有該資料，狀態為 已完成 或 退稿
                                                $pdo=new PDO('mysql:host=localhost;dbname=fjup;charset=utf8','root', '');
                                                foreach ($pdo->query("select * from newpaper_history natural join totalreply where id='".$id."'") as $row) {
                                                    //投稿資料
                                                    $id=$row["id"];
                                                    $title=$row['title'];
                                                    $auth1=$row['auth1'];
                                                    $auth2=$row['auth2'];
                                                    $auth3=$row['auth3'];
                                                    $auth4=$row['auth4'];
                                                    $auth5=$row['auth5'];
                                                    $summary=$row["summary"]; //摘要
                                                    $uploadtime=$row["uploadtime"]; //投稿時間
                                                    $scriptfile=$row['uploadname']; //原始投稿檔案
                                                    
                                                    //管理者的動作
                                                    $senter=$row["senter"]; //管理者
                                                    $level=$row['level']; //回覆評級
                                                    $managerreply=$row["message"];  //管理者回覆
                                                    $replycount=$row['replycount']+1; //回覆次數
                                                    $managerfile=$row["filename"]; //管理者上傳的回覆檔案
                                                    $replytime=$row['replytime']; //回覆日期
                                                
                                                }
                                            ?>

                                        <div style=" display: flex;justify-content: left;border-bottom: 0;">
                                            <h3
                                                style="font-weight: bolder;font-family:Microsoft JhengHei;margin-top: 20px;">
                                                <?php echo $title ?>
                                            </h3>
                                        </div>
                                        <div class="container">
                                            <div class="row justify-content-start">
                                                <div>
                                                    全文下載：<a href='upload/<?php echo $scriptfile?>' target="blank"
                                                        download="<?php echo $scriptfile ?>"><?php echo $scriptfile?></a>
                                                </div>
                                                <div>
                                                    管理者回覆：<a href='../管理者/upload/<?php echo $managerfile?>'
                                                        target="blank"
                                                        download="<?php echo $managerfile ?>"><?php echo $managerfile ?></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="container">
                                            <div class="row justify-content-start">
                                                <div class="col-2">
                                                    <?php
                                                                echo "回覆評級：";
                                                                if ($level=='接受') {
                                                                    echo "<span class='badge badge-soft-blue' >接受</span>" ;
                                                                }elseif ($level=='大幅修改') {
                                                                    echo  "<span class='badge badge-soft-warning'>大幅修改</span>";
                                                                }elseif($level=='小幅修改'){
                                                                    echo  "<span class='badge badge-soft-success'>小幅修改</span>";
                                                                }elseif($level=='拒絕'){
                                                                    echo "<span class='badge badge-soft-pink'>拒絕</span>";
                                                                }elseif($level=='退稿'){
                                                                    echo "<span class='badge badge-soft-danger'>退稿</span>";
                                                                }
                                                            ?>
                                                </div>
                                                <div class="col-2">
                                                    <a>回覆次數：<?php echo "第";
                                                            echo $replycount;
                                                            echo "次"?></a>
                                                </div>
                                                <div class="col-4">
                                                    <a>回覆日期：<?php echo $replytime ?></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="container mt-0">
                                                <section class="mt-3">

                                                    <!-- Card header -->
                                                    <div
                                                        class="card-header border-0 font-weight-bold d-flex justify-content-between">
                                                        <p class="mr-4 mb-0">作者</p>
                                                    </div>

                                                    <div class="media my-2 px-1">
                                                        <div class="media-body" style="font-family:Microsoft JhengHei">
                                                            <div>
                                                                <p class=" mb-0;"
                                                                    style="color: #1c2a48; margin-bottom: 0px;font-weight: 520">
                                                                    <?php echo $author1,' ', $author2, ' ', $author3, ' ', $author4, ' ', $author5 ?>
                                                                </p>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </section>
                                            </div>
                                            <div class="container">
                                                <section class="mt-3">

                                                    <!-- Card header -->
                                                    <div
                                                        class="card-header border-0 font-weight-bold d-flex justify-content-between">
                                                        <p class="mr-4 mb-0">領域</p>
                                                    </div>

                                                    <div class="media mt-3 px-1">
                                                        <div class="media-body"
                                                            style="text-align: justify; padding-right: 30px;font-family:Microsoft JhengHei">
                                                            <p> <?php
                                                            foreach ($pdo->query("select f_name from newpaper_field where title = '".$title."'") as $row) 
                                                            {
                                                                echo $field = $row["f_name"];
                                                                echo " ";
                                                            }
                                                        ?></p>
                                                        </div>
                                                    </div>

                                                </section>
                                            </div>
                                            <div class="container">
                                                <section class="mt-3">

                                                    <!-- Card header -->
                                                    <div
                                                        class="card-header border-0 font-weight-bold d-flex justify-content-between">
                                                        <p class="mr-4 mb-0">摘要</p>
                                                    </div>

                                                    <div class="media mt-3 px-1">
                                                        <div class="media-body"
                                                            style="text-align: justify; padding-right: 30px;font-family:Microsoft JhengHei">
                                                            <p> <?php $summary ?></p>
                                                        </div>
                                                    </div>

                                                </section>
                                            </div>
                                            <div class="container">
                                                <section class="mt-3">

                                                    <!-- Card header -->
                                                    <div
                                                        class="card-header border-0 font-weight-bold d-flex justify-content-between">
                                                        <p class="mr-4 mb-0">管理者回覆</p>
                                                    </div>

                                                    <div class="media mt-3 px-1">
                                                        <div class="media-body"
                                                            style="text-align: justify; padding-right: 30px;font-family:Microsoft JhengHei">
                                                            <p> <?php $managerreply ?></p>
                                                        </div>
                                                    </div>

                                                </section>
                                            </div>


                                            <!-- <div class="container">
                                                    <section class="my-5">

                                                        <div class="card-header border-0 font-weight-bold d-flex justify-content-between">
                                                        <p class="mr-4 mb-0">關鍵字</p>
                                                        </div>

                                                        <div class="media mt-4 px-1">
                                                            <div class="media-body">
                                                                <a href="">關鍵因素，國際交換生，層級分析法</a>
                                                            </div>
                                                        </div>

                                                    </section>
                                                </div> -->
                                        </div>

                                        <?php 
                                        }elseif($s=="等待主編確認" or $s=="審稿中"){    //totalreply沒有該資料，狀態為 等待主編確認 或 審稿中
                                            $pdo=new PDO('mysql:host=localhost;dbname=fjup;charset=utf8','root', '');
                                            foreach ($pdo->query("select * from newpaper_history  where id='".$id."'") as $row) {
                                                       
                                                $id=$row["id"];
                                                $title=$row['title'];
                                                $auth1=$row['auth1'];
                                                $auth2=$row['auth2'];
                                                $auth3=$row['auth3'];
                                                $auth4=$row['auth4'];
                                                $auth5=$row['auth5'];
                                                $summary=$row["summary"]; 
                                                $uploadtime=$row["uploadtime"]; //投稿時間
                                                $scriptfile=$row['uploadname']; //原始投稿檔案

                                                $Summary=nl2br($summary);
                                                    
                                                }
                                            ?>

                                        <div style=" display: flex;justify-content: left;border-bottom: 0;">
                                            <h3
                                                style="font-weight: bolder;font-family:Microsoft JhengHei;margin-top: 20px;">
                                                <?php echo $title ?>
                                            </h3>
                                        </div>
                                        <div class="container">
                                            <div class="row justify-content-start">
                                                <div>
                                                    全文下載：<a href='upload/<?php echo $scriptfile?>' target="blank"
                                                        download="<?php echo $scriptfile ?>"><?php echo $scriptfile?></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="container">
                                            <div class="row justify-content-start">
                                                <div>
                                                    上傳時間：<?php echo $uploadtime ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="container mt-0">
                                                <section class="mt-3">

                                                    <!-- Card header -->
                                                    <div
                                                        class="card-header border-0 font-weight-bold d-flex justify-content-between">
                                                        <p class="mr-4 mb-0">作者</p>
                                                    </div>

                                                    <div class="media my-2 px-1">
                                                        <div class="media-body" style="font-family:Microsoft JhengHei">
                                                            <div>
                                                                <p class=" mb-0;"
                                                                    style="color: #1c2a48; margin-bottom: 0px;font-weight: 520">
                                                                    <?php echo $auth1,' ', $auth2, ' ', $auth3, ' ', $auth4, ' ', $auth5 ?>
                                                                </p>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </section>
                                            </div>
                                            <div class="container">
                                                <section class="mt-3">

                                                    <!-- Card header -->
                                                    <div
                                                        class="card-header border-0 font-weight-bold d-flex justify-content-between">
                                                        <p class="mr-4 mb-0">領域</p>
                                                    </div>

                                                    <div class="media mt-3 px-1">
                                                        <div class="media-body"
                                                            style="text-align: justify; padding-right: 30px;font-family:Microsoft JhengHei">
                                                            <p> <?php
                                                                foreach ($pdo->query("select f_name from newpaper_field where title = '".$title."'") as $row) 
                                                                {
                                                                    echo $field = $row["f_name"];
                                                                    echo " ";
                                                                }
                                                            ?></p>
                                                        </div>
                                                    </div>

                                                </section>
                                            </div>
                                            <div class="container">
                                                <section class="mt-3">

                                                    <!-- Card header -->
                                                    <div
                                                        class="card-header border-0 font-weight-bold d-flex justify-content-between">
                                                        <p class="mr-4 mb-0">摘要</p>
                                                    </div>

                                                    <div class="media mt-3 px-1">
                                                        <div class="media-body"
                                                            style="text-align: justify; padding-right: 30px;font-family:Microsoft JhengHei">
                                                            <p> <?php echo $Summary; ?></p>
                                                        </div>
                                                    </div>

                                                </section>
                                            </div>


                                        </div>
                                        <?php } ?>
                                    </div> <!-- container-fluid -->
                                </div>
                            </div>
                        </div> <!-- end col-->
                    </div><!-- end row-->
                </div> <!-- container -->

            </div> <!-- content -->
        </div>
        <!--content-page -->
    </div><!-- END wrapper -->
</body>

</html>