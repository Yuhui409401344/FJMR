<?php include "nav.php"?>
<div class="content-page">
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">
            <?php
                $aid=$_GET["aid"];
                $pdo=new PDO('mysql:host=localhost;dbname=fjup;charset=utf8','root', '');
                foreach ($pdo->query("SELECT * FROM distri,distri_field where distri.title=distri_field.title and distri.id='".$aid."'") as $row) {
                    $title=$row['title'];
                    $summary=$row['summary'];
                    $auth1=$row['auth1'];
                    $auth2=$row['auth2'];
                    $auth3=$row['auth3'];
                    $auth4=$row['auth4'];
                    $field=$row['f_name'];
                    $uploadname=$row['uploadname'];
                }
            ?>
            <div class="row mt-3">
            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <div class="row">
                            <div class="container-fluid">
                                <div style=" display: flex;
                                            justify-content: right;
                                            align-items: center;
                                            height: 70px;
                                            border: bottom: 0;">
                                <h3 style="font-weight: bolder;font-family:Microsoft JhengHei;margin-left: 60px;margin-top: 20px;"><?php echo $title?></h3>
                                </div>
                                <div class="container">
                                    <div class="row justify-content-start">
                                        <div style="margin-left: 60px">
                                        <a href="upload/<?php echo $uploadname?>">全文下載</a>
                                            <?php
                                                if(isset($_GET['file']))
                                                {
                                                    // $_GET['file'] 即為傳入要下載檔名的引數
                                                    header("Content-type:application");
                                                    header("Content-Length: " .(string)(filesize($_GET['file'])));
                                                    header("Content-Disposition: attachment; filename=".$_GET['file']);
                                                    readfile($_GET['file']);
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    </div>
                                <div class="row" style="margin-left: 60px;margin-right: 60px;">
                                    <div class="container mt-0" >
                                    <section class="mt-3">

                                    <!-- Card header -->
                                    <div class="card-header border-0 font-weight-bold d-flex justify-content-between">
                                    <p class="mr-4 mb-0">作者</p>
                                    </div>

                                    <div class="media my-2 px-1">
                                        <div class="media-body" style="font-family:Microsoft JhengHei">
                                            <div>
                                                <p class=" mb-0;" style="color: #1c2a48; margin-bottom: 0px;font-weight: 520">
                                                    <?php echo $auth1?><br>
                                                    <?php echo $auth2?><br>
                                                    <?php echo $auth3?><br>
                                                    <?php echo $auth4?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    </section>
                                    </div>
                                    <div class="container">
                                    <section class="mt-3">

                                    <!-- Card header -->
                                    <div class="card-header border-0 font-weight-bold d-flex justify-content-between">
                                    <p class="mr-4 mb-0">摘要</p>
                                    </div>

                                    <div class="media mt-3 px-1">
                                    <div class="media-body" style="text-align: justify; padding-right: 30px;font-family:Microsoft JhengHei">
                                        <p><?php echo $summary?></p>
                                    </div>
                                    </div>

                                    </section>
                                    </div>

                                    <div class="container">
                                        <section class="my-5">

                                        <!-- Card header -->
                                        <div class="card-header border-0 font-weight-bold d-flex justify-content-between">
                                        <p class="mr-4 mb-0">領域</p>
                                        </div>

                                        <div class="media mt-4 px-1">
                                        <div class="media-body">
                                            <a href=""><?php echo $field?></a>
                                        </div>
                                        </div>

                                        </section>
                                        </div>
                                </div>
                            </div>
                            
                        </div>
                    </div> <!-- end card-->
                </div> <!-- end col-->
            </div>
            <!-- end row-->
            
        </div> <!-- container -->

    </div> <!-- content -->
</div>
        