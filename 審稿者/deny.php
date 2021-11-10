<!DOCTYPE html>
<html lang="en">
<link rel="apple-touch-icon" sizes="180x180" href="../assets/images/logo/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="../assets/images/logo/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="../assets/images/logo/favicon-16x16.png">
<link rel="icon" href="../assets/images/logo/logo.ico" type="image/x-icon">

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



                                    <p style="text-align: justify; padding-right: 30px;font-family:Microsoft JhengHei">
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
                    </div>
                    <div class="row">
                        <div class="col-xl-4">
                            <div class="card mb-1 shadow-none border">
                                <div class="p-2">
                                    <div class="row align-items-center">
                                        <div class="col-auto">

                                            <i class="mdi mdi-attachment"></i>

                                        </div>
                                        <div class="col pl-0">
                                            <a href='upload/<?php echo $scriptfile?>' target="blank"
                                                download="<?php echo $scriptfile ?>"><?php echo $scriptfile?></a>
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
                </div>
            </div> <!-- container-fluid -->
        </div>
    </div> <!-- end col-->

</body>

</html>