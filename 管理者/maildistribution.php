<link rel="apple-touch-icon" sizes="180x180" href="../assets/images/logo/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="../assets/images/logo/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="../assets/images/logo/favicon-16x16.png">
<link rel="icon" href="../assets/images/logo/logo.ico" type="image/x-icon">

<body class="loading">
    <style>
    .footable-row-detail-name {
        display: block;
        font-weight: 700;
        padding-right: 0.5em;
        width: 40px;
    }
    </style>

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
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"></a></li>
                                        <li class="breadcrumb-item">收件夾</li>
                                        <li class="breadcrumb-item active">分配稿件</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">
                                <div class="mb-2">
                                    <div class="row">
                                        <div class="col-12 text-sm-center form-inline">
                                            <div class="form-group mr-2">
                                                <select id="demo-foo-filter-status"
                                                    class="custom-select custom-select-sm">
                                                    <option value="">全部</option>
                                                    <option value="管理與政策">管理與政策</option>
                                                    <option value="國際企業">國際企業</option>
                                                    <option value="行銷管理">行銷管理</option>
                                                    <option value="國際貿易">國際貿易</option>
                                                    <option value="生產與作業管理">生產與作業管理</option>
                                                    <option value="統計">統計</option>
                                                    <option value="人力資源管理">人力資源管理</option>
                                                    <option value="數量方法">數量方法</option>
                                                    <option value="資訊管理">資訊管理</option>
                                                    <option value="會計">會計</option>
                                                    <option value="財務管理">財務管理</option>
                                                    <option value="審計">審計</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <input id="demo-foo-search" type="text" placeholder="Search"
                                                    class="form-control form-control-sm" autocomplete="on">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table id="demo-foo-filtering" class="table table-bordered toggle-circle  mb-0"
                                        data-page-size="10">
                                        <colgroup>
                                            <col span="1" style="width: 20%;">
                                            <col span="1" style="width: 15%;">
                                            <col span="1" style="width: 15%;">
                                            <col span="1" style="width: 15%;">
                                            <col span="1" style="width: 15%;">
                                            <col span="1" style="width: 3%;">
                                            <col span="1" style="width: 12%;">
                                        </colgroup>
                                        <thead>
                                            <tr>
                                                <th data-toggle="true" ellipsis>標題</th>
                                                <th ellipsis>作者</th>
                                                <th data-field="field" data-sortable="true"
                                                    data-formatter="fieldFormatter" data-hide="phone">領域</th>
                                                <th>上傳日期</th>
                                                <th>回覆次數</th>
                                                <th data-hide="phone,tablet">摘要</th>
                                                <th data-align="center">動作</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                        
                                                        $pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
                                                        foreach ($pdo->query('select * from newpaper') as $row) {
                                                            $id=$row["id"];
                                                            $title=$row['title'];
                                                            $author1=$row['auth1'];
                                                            $author2=$row['auth2'];
                                                            $author3=$row['auth3'];
                                                            $author4=$row['auth4'];
                                                            $author5=$row['auth5'];
                                                            $summary=$row['summary'];
                                                            $uploadname=$row['uploadname'];
                                                            $uploadtime=$row['uploadtime'];

                                                            $Summary=nl2br($summary);//回車換成換行

                                                        $sql2 = $pdo->query("select count(title) from newpaper_history where title='$title'");
                                                        $count = $sql2->fetch(PDO::FETCH_ASSOC);
                                                        $title_c = $count['count(title)'];
                                                    ?>
                                            <tr>
                                                <td><a class="title"
                                                        href='pages-maildistribution.php?id=<?php echo "$id"?>'
                                                        style="color: #005282"><?php echo $title ?></a>
                                                </td>
                                                <td><?php echo $author1, ' ',$author2,' ',$author3,' ',$author4,' ', $author5 ?>
                                                </td>


                                                <td><?php
                                                            $pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
                                                            $query=$pdo->query("SELECT f_name from newpaper_field where title='$title'");
                                                            $datalist=$query->fetchall();
                                                            foreach($datalist as $datadetail){
                                                                print_r($datadetail['f_name']);
                                                                echo ' ';
                                                            }
                                                            ?>

                                                </td>
                                                <td><?php echo $uploadtime ?></td>
                                                <td align="center"><?php echo $title_c  ?></td>
                                                <td>
                                                    <p class='summary'><?php echo $Summary ?></p>
                                                </td>
                                                <td>
                                                    <a href='../投稿者/upload/<?php echo $uploadname ?>' target="blank"
                                                        download="<?php echo $uploadname ?>" class='action-icon'
                                                        title="下載檔案"> <i class='mdi mdi-arrow-collapse-down'></i></a>
                                                    <a href='distri.php?id=<?php echo "$id" ?> ' class='action-icon'><i
                                                            class='mdi mdi-email-send-outline' title="分配文章"></i></a>
                                                    <a href='reply-cancel.php?id=<?php echo "$id" ?> '
                                                        class='action-icon'><i class='mdi mdi-reply mr-1'
                                                            title="直接回覆文章"></i></a>
                                                </td>

                                            </tr>
                                            <?php
                                                    }
                                                    ?>
                                        </tbody>

                                        <tfoot>
                                            <tr class="active">
                                                <td colspan="6">
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
    <script src="../assets/js/vendor.min.js"></script>

    <!-- Footable js -->
    <script src="../assets/libs/footable/footable.all.min.js"></script>

    <!-- Init js -->
    <script src="../assets/js/pages/foo-tables.init.js"></script>

    <!-- App js -->
    <script src="../assets/js/app.min.js"></script>

    <script>
    $(function() {
        var len = 8;
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