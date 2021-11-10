<!DOCTYPE html>
<html lang="en">

<?php include "nav.php" ?>

<body class="loading">
    <!-- Begin page -->
    <div id="wrapper">
        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">
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
                            
                            // 管理者個人資料
                            foreach($pdo->query("select name, email from account where login='".$senter."'") as $row){
                                $name = $row['name'];
                                $email = $row['email'];
                            }
    
                          
                            foreach ($pdo->query("select photo, imgType from account_img where account_img.login =  '".$senter."' ") as $row) {
                               $img = $row['photo'];
                               $imgType = $row['imgType'];
                            }
                        ?>
                    <!-- 稿件內容 -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">
                                <div class="row">
                                    <div class="container-fluid">
                                        <div>

                                            <h3 style="font-weight: bolder;font-family:Microsoft JhengHei;">
                                                <?php echo $title ?>
                                            </h3>
                                            <small class="float-right">上傳日期：<?php echo $uploadtime ?></small>
                                            <h4 class="m-0 font-14">
                                                作者：<?php echo $auth1,' ', $auth2, ' ', $auth3, ' ', $auth4, ' ', $auth5 ?>
                                            </h4>

                                            <hr />



                                            <p
                                                style="text-align: justify; padding-right: 30px;font-family:Microsoft JhengHei">
                                                摘要：<?php echo $summary; ?>
                                            </p>

                                            <h4 class="m-0 font-14">
                                                領域：<p class='badge badge-soft-secondary mr-1'>
                                                    <?php
                                                                        foreach ($pdo->query("select f_name from newpaper_field where title = '".$title."'") as $row) 
                                                                        {
                                                                            echo $field = $row["f_name"];
                                                                            echo " ";
                                                                        }
                                                                    ?></p>

                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                <!-- 非匿名檔案 -->
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card mb-1 shadow-none border">
                                            <div class="p-2">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">

                                                        <i class="mdi mdi-attachment"></i>

                                                    </div>
                                                    <div class="col pl-0">
                                                        非匿名檔案：
                                                        <a href='upload/<?php echo $scriptfile?>' target="blank"
                                                            download="<?php echo $scriptfile ?>"><?php echo $title?></a>
                                                    </div>
                                                    <div class="col-auto">
                                                        <!-- Button -->
                                                        <a href='upload/<?php echo $scriptfile?>' target="blank"
                                                            download="<?php echo $scriptfile ?>">
                                                            <i class="dripicons-download"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- end col -->
                                </div>
                                <!-- 匿名檔案 -->
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card mb-1 shadow-none border">
                                            <div class="p-2">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">

                                                        <i class="mdi mdi-attachment"></i>

                                                    </div>
                                                    <div class="col pl-0">
                                                        匿名檔案：
                                                        <a href='upload_x/<?php echo $scriptfile?>' target="blank"
                                                            download="<?php echo $scriptfile ?>">
                                                            <?php echo $title?>
                                                        </a>
                                                    </div>
                                                    <div class="col-auto">
                                                        <!-- Button -->
                                                        <a href='upload_x/<?php echo $scriptfile?>' target="blank"
                                                            download="<?php echo $scriptfile ?>">
                                                            <i class="dripicons-download"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- end col -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 管理者回覆信息 -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">
                                <div class="row">
                                    <div class="container-fluid">
                                        <div>
                                            <div class="media mb-3 mt-1">
                                                <?php 
                                                     if(isset($img)){
                                                        echo '<img src="data:'.$imgType.';base64,' . $img . '"   height="32" class="d-flex mr-2 rounded-circle"  />';
                                                    }else{
                                                        echo '<img src="../assets/images/user.png"   height="32" class="d-flex mr-2 rounded-circle"  />'; 
                                                    }
                             
                                                    ?>

                                                <div class="media-body">
                                                    <small class="float-right">回覆日期：<?php echo $replytime ?></small>
                                                    <h6 class="m-0 font-14"><?php echo $name ?>（管理者）
                                                    </h6>
                                                    <small class="text-muted"><?php echo $email ?></small>
                                                </div>
                                            </div>
                                            <hr />
                                            <p
                                                style="text-align: justify; padding-right: 30px;font-family:Microsoft JhengHei">
                                                稿件評級：<?php switch($level)
                                                            {
                                                                case "接受":echo "<span class='badge badge-soft-blue'>接受</span>" ;break;
                                                                case "小幅修改":echo  "<span class='badge badge-soft-warning'>小幅修改</span>" ;break;
                                                                case "大幅修改":echo  "<span class='badge badge-soft-success'>大幅修改</span>" ;break;
                                                                case "拒絕":echo "<span class='badge badge-soft-pink'>拒絕</span>";break;
                                                                case "退稿":echo "<span class='badge badge-soft-danger'>退稿</span>"; break;
                                                            }?></p>
                                            <p
                                                style="text-align: justify; padding-right: 30px;font-family:Microsoft JhengHei">
                                                留言：<?php echo $managerreply ?></p>
                                        </div>
                                        <!-- end .mt-4 -->
                                    </div>
                                </div> <!-- end card-->

                                <!-- 管理者回覆檔案 -->
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card mb-1 shadow-none border">
                                            <div class="p-2">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">

                                                        <i class="mdi mdi-attachment"></i>

                                                    </div>
                                                    <div class="col pl-0">
                                                        <a href='../管理者/upload/<?php echo $managerfile?>' target="blank"
                                                            download="<?php echo $managerfile ?>"><?php echo $managerfile?></a>
                                                    </div>
                                                    <div class="col-auto">
                                                        <!-- Button -->
                                                        <a href='../管理者/upload/<?php echo $managerfile?>' target="blank"
                                                            download="<?php echo $managerfile ?>">
                                                            <i class="dripicons-download"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- end col -->
                                </div>
                            </div> <!-- end col-->
                        </div>
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
                    <!-- 稿件內容 -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">
                                <div class="row">
                                    <div class="container-fluid">
                                        <div>

                                            <h3 style="font-weight: bolder;font-family:Microsoft JhengHei;">
                                                <?php echo $title ?>
                                            </h3>
                                            <small class="float-right">上傳日期：<?php echo $uploadtime ?></small>
                                            <h4 class="m-0 font-14">
                                                作者：<?php echo $auth1,' ', $auth2, ' ', $auth3, ' ', $auth4, ' ', $auth5 ?>
                                            </h4>

                                            <hr />



                                            <p
                                                style="text-align: justify; padding-right: 30px;font-family:Microsoft JhengHei">
                                                摘要：<?php echo $Summary; ?>
                                            </p>

                                            <h4 class="m-0 font-14">
                                                領域：<p class='badge badge-soft-secondary mr-1'>
                                                    <?php
                                                                        foreach ($pdo->query("select f_name from newpaper_field where title = '".$title."'") as $row) 
                                                                        {
                                                                            echo $field = $row["f_name"];
                                                                            echo " ";
                                                                        }
                                                                    ?></p>

                                            </h4>
                                        </div>
                                    </div>
                                </div>

                                <!-- 非匿名檔案 -->
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card mb-1 shadow-none border">
                                            <div class="p-2">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">

                                                        <i class="mdi mdi-attachment"></i>

                                                    </div>
                                                    <div class="col pl-0">
                                                        非匿名檔案：
                                                        <a href='upload/<?php echo $scriptfile?>' target="blank"
                                                            download="<?php echo $scriptfile ?>"><?php echo $title?></a>
                                                    </div>
                                                    <div class="col-auto">
                                                        <!-- Button -->
                                                        <a href='upload/<?php echo $scriptfile?>' target="blank"
                                                            download="<?php echo $scriptfile ?>">
                                                            <i class="dripicons-download"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- end col -->
                                </div>
                                <!-- 匿名檔案 -->
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card mb-1 shadow-none border">
                                            <div class="p-2">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">

                                                        <i class="mdi mdi-attachment"></i>

                                                    </div>
                                                    <div class="col pl-0">
                                                        匿名檔案：
                                                        <a href='upload_x/<?php echo $scriptfile?>' target="blank"
                                                            download="<?php echo $scriptfile ?>">
                                                            <?php echo $title?>
                                                        </a>
                                                    </div>
                                                    <div class="col-auto">
                                                        <!-- Button -->
                                                        <a href='upload_x/<?php echo $scriptfile?>' target="blank"
                                                            download="<?php echo $scriptfile ?>">
                                                            <i class="dripicons-download"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- end col -->
                                </div>
                            </div>

                        </div>


                        <?php } ?>


                    </div>
                </div> <!-- end container fluid-->
            </div> <!-- end content-->
        </div><!-- end content-page-->
    </div><!-- END wrapper -->
</body>

</html>