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

    <!-- App css -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="../assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

    <link href="../assets/css/bootstrap-dark.min.css" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
    <link href="../assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />

    <!-- icons -->
    <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <style>
    .footable-row-detail-name {
        display: block;
        font-weight: 700;
        padding-right: 0.5em;
        width: 80px;
    }
    </style>
</head>

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
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="card-box">

                                <div class="mb-2">
                                    <div class="row">
                                        <div class="col-12 text-sm-center form-inline">
                                            <div class="form-group">
                                                <input id="demo-foo-search" type="text" placeholder="Search"
                                                    class="form-control form-control-sm" autocomplete="on">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table id="demo-foo-filtering" class="table table-bordered toggle-circle mb-0"
                                        data-page-size="10">
                                        <colgroup>
                                            <col span="1" style="width: 20%;">
                                            <col span="1" style="width: 10%;">
                                            <col span="1" style="width: 10%;">
                                            <col span="1" style="width: 10%;">
                                            <col span="1" style="width: 10%;">
                                            <col span="1" style="width: 20%;">
                                            <col span="1" style="width: 10%;">
                                        </colgroup>
                                        <thead>
                                            <tr>
                                                <th data-toggle="true">標題</th>
                                                <th data-hide="phone">配稿人</th>
                                                <th>收件期限</th>
                                                <th data-hide="phone">投稿日期</th>
                                                <th data-hide="phone, tablet">摘要</th>
                                                <th data-hide="phone, tablet">配稿留言</th>
                                                <th>動作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
                                                foreach($pdo->query("select count(title) from distri where pro='".$login."'") as $row){
                                                    $count=$row[0];
                                                }
                                                foreach ($pdo->query("select id, title, ddl, uploadtime, summary, filename, comment, manager from distri where pro='".$login."'") as $row) {
                                                    $id = $row['id'];
                                                    $title=$row['title'];
                                                   
                                                    $ddl=$row['ddl'];
                                                    $uploadtime = $row['uploadtime'];
                                                    $summary = $row['summary'];
                                                    $filename = $row['filename'];
                                                    $comment = $row['comment'];
                                                    $manager = $row['manager'];

                                                    $Summary=nl2br($summary);
                                                    
                                            ?>

                                            <tr>
                                                <td><a class="title" href="paperContent.php?id=<?php echo "$id" ?>"
                                                        style="color: #005282"><?php echo $title ?></a>
                                                </td>
                                                </td>
                                                <td><?php echo $manager ?></td>
                                                <td><span class='badge badge-soft-blue'><?php echo $ddl ?></span></td>
                                                <td><span class='badge badge-light'><?php echo $uploadtime ?></span>
                                                </td>
                                                <td>
                                                    <p class="summary"><?php echo $Summary ?></p>
                                                </td>
                                                <td><?php echo $comment ?></td>
                                                <td>
                                                    <a href="reply.php?id=<?php echo $id ?>" class="action-icon"> <i
                                                            class="mdi mdi-email-send-outline" title="回覆審稿"></i></a>
                                                    <a href='../投稿者/upload_x/<?php echo $filename?>' target="blank"
                                                        download="<?php echo $title ?>" class='action-icon'
                                                        title="下載檔案"> <i class='mdi mdi-arrow-collapse-down'></i></a>
                                                </td>

                                            </tr>
                                        </tbody>
                                        <?php
                                                }
                                            ?>
                                        <tfoot>
                                            <tr class="active">
                                                <td colspan="7">
                                                    <div class="text-right">
                                                        <ul
                                                            class="pagination pagination-rounded justify-content-end footable-pagination m-t-10 mb-0">
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div> <!-- end .table-responsive-->
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



    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- Vendor js -->
    <script src="../assets/js/vendor.min.js"></script>

    <!-- Footable js -->
    <script src="../assets/libs/footable/footable.all.min.js"></script>

    <!-- Init js -->
    <script src="../assets/js/pages/foo-tables.init.js"></script>

    <!-- App js -->
    <script src="../assets/js/app.min.js"></script>


    <script>
    $(function() {
        var len = 7;
        $(".title").each(function(i) {
            if ($(this).text().length > len) {
                $(this).attr("title", $(this).text());
                var text = $(this).text().substring(0, len - 1) + "...";
                $(this).text(text);
            }
        });
    });
    $(function() {
        var len = 50;
        $(".summary").each(function(i) {
            if ($(this).text().length > len) {
                $(this).attr("title", $(this).text());
                var text = $(this).text().substring(0, len - 1) + "...";
                $(this).text(text);
            }
        });
    });
    </script>

</body>

</html>