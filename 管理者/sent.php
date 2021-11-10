<link href="../assets/libs/bootstrap-table/bootstrap-table.min.css" rel="stylesheet" type="text/css" />

<link rel="apple-touch-icon" sizes="180x180" href="../assets/images/logo/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="../assets/images/logo/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="../assets/images/logo/favicon-16x16.png">
<link rel="icon" href="../assets/images/logo/logo.ico" type="image/x-icon">
<style>
.row {
    display: flex;
    align-content: space-around;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
}
</style>

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

                    <div class="row mt-3" style="flex-direction: row">

                        <div class="page-title-box col-xs-12 col-sm-6 col-md-8">
                            <div class="page-title-left mt-1">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);"></a></li>
                                    <li class="breadcrumb-item">收件夾</li>
                                    <li class="breadcrumb-item active">寄件備份</li>
                                </ol>

                            </div>
                        </div>
                        <div class="text-center filter-menu col-xs-6 col-md-4">
                            <a href="javascript: void(0);" class="filter-menu-item active" data-rel="all">All</a>
                            <a href="javascript: void(0);" class="filter-menu-item" data-rel="distri">配稿歷史</a>
                            <a href="javascript: void(0);" class="filter-menu-item" data-rel="reply">回覆歷史</a>
                        </div>
                    </div>
                    <!-- end row-->
                    <div class="row filterable-content" style="flex-direction: column;">
                        <!-- 已分配的稿件 -->
                        <div class="row col-12 col-xl-12 filter-item all distri">

                            <!-- Right Sidebar -->
                            <div class="col-12">
                                <div class="card-box">
                                    <div class="row">
                                        <div class="col-sm-12">

                                            <table data-toggle="table" data-search="true" data-show-refresh="true"
                                                data-toolbar="#demo-edit-row" data-show-columns="true"
                                                data-sort-name="date" data-page-list="[5, 10, 20]" data-page-size="10"
                                                data-pagination="true" data-show-pagination-switch="true"
                                                class="table-borderless">
                                                <button id="demo-edit-row" class="btn btn-blue btn-sm" disabled>To:
                                                    審稿者</button>
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th ellipsis data-sortable="true">標題</th>
                                                        <th ellipsis>作者</th>
                                                        <th data-sortable="true">審稿者</th>
                                                        <th data-sortable="true">審稿意願</th>
                                                        <th data-sortable="true">審稿期限</th>
                                                        <th>回覆留言</th>
                                                        <th data-sortable="true">上傳日期</th>
                                                        <th data-sortable="false">動作</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php
                                                            
                                                            $pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
                                                            foreach ($pdo->query("select id,title,summary,pro,ddl,auth1,auth2,auth3,auth4,auth5,filename,uploadtime,comment,accept from distri_history where manager = '".$manager."'") as $row) {
                                                                $id=$row['id'];
                                                                $title=$row['title'];
                                                                $summary=$row['summary'];
                                                                $pro=$row['pro'];
                                                                $ddl=$row['ddl'];
                                                                $auth1=$row['auth1'];
                                                                $auth2=$row['auth2'];
                                                                $auth3=$row['auth3'];
                                                                $auth4=$row['auth4'];
                                                                $auth5=$row['auth5'];
                                                                $filename=$row['filename'];
                                                                $uploadtime=$row['uploadtime'];
                                                                $comment=$row['comment'];
                                                                $accept=$row['accept'];
                                                        ?>
                                                    <tr>

                                                        <td><a href="distriHistoryContent.php?id=<?php echo $id ?>&&pro=<?php echo $pro?>"
                                                                style="color:#005282"><?php echo $title ?>

                                                        </td>
                                                        <td><?php echo $auth1,' ',$auth2,' ',$auth3,' ',$auth4,' ',$auth5 ?>
                                                        </td>
                                                        <td><?php  
                                                        foreach ($pdo->query("select distinct name from account where login='".$pro."'") as $row) {
                                                            $proName=$row['name'];
                                                        }
                                                            echo $proName ?></td>
                                                        <td><?php 
                                                                if($accept=='0'){  //審稿者拒絕該稿件
                                                                    echo "<span class='badge badge-outline-danger badge-pill'>拒絕審稿</span>";
                                                                }elseif($accept == null){
                                                                    echo "<span class='badge badge-outline-secondary badge-pill'>尚未回覆</span>";
                                                                }else{
                                                                    echo "<span class='badge badge-outline-blue badge-pill'>接受審稿</span>";
                                                                }
                                                                 
                                                                ?></td>
                                                        <td><?php echo $ddl ?></td>
                                                        <td><?php echo $comment ?></td>
                                                        <td><?php echo $uploadtime ?></td>
                                                        <td>
                                                            <a href='../投稿者/upload/<?php echo $filename ?>'
                                                                target="blank" download="<?php echo $filename ?>"
                                                                class='action-icon'> <i
                                                                    class='mdi mdi-arrow-collapse-down'></i></a>
                                                        </td>

                                                    </tr>
                                                    <?php
                                                        }
                                                        ?>
                                                </tbody>

                                            </table>


                                        </div> <!-- end col-->
                                    </div>
                                    <!-- end row-->
                                </div> <!-- end card-box -->
                            </div> <!-- end Col -->
                        </div><!-- End row -->

                        <!-- 已回復的稿件 -->
                        <div class="row col-12 col-xl-12 filter-item all reply">

                            <!-- Right Sidebar -->
                            <div class="col-12">
                                <div class="card-box">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <button id="demo-delete-row" class="btn btn-primary btn-sm" disabled>To:
                                                投稿者</button>
                                            <table id="demo-custom-toolbar" data-toolbar="#demo-delete-row"
                                                data-toggle="table" data-search="true" data-show-refresh="true"
                                                data-show-columns="true" data-sort-name="date"
                                                data-page-list="[5, 10, 20]" data-page-size="10" data-pagination="true"
                                                data-show-pagination-switch="true" class="table-borderless">


                                                <thead class="thead-light">
                                                    <tr>
                                                        <th ellipsis data-sortable="true">標題</th>
                                                        <th data-sortable="true">作者</th>
                                                        <th data-sortable="true" data-align="center"
                                                            data-formatter="timesFormatter">回覆次數</th>
                                                        <th data-sortable="true" data-align="center"
                                                            data-formatter="statusFormatter">回覆評級</th>
                                                        <th>回覆留言</th>
                                                        <th data-sortable="true">回覆時間</th>
                                                        <th data-sortable="false">動作</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php
                                                            
                                                            $pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
                                                            foreach ($pdo->query("select * from totalreply where senter = '".$manager."'") as $row) {
                                                                $id=$row['id'];
                                                                $title=$row['title'];
                                                                $level=$row['level'];
                                                                $file=$row['filename'];
                                                                $auth1=$row['auth1'];
                                                                $auth2=$row['auth2'];
                                                                $auth3=$row['auth3'];
                                                                $auth4=$row['auth4'];
                                                                $auth5=$row['auth5'];
                                                                $message=$row['message'];
                                                                $replycount=$row['replycount'];
                                                                $replytime=$row['replytime'];
                                                        ?>
                                                    <tr>
                                                        <td><a href="historyContent.php?id=<?php echo $id ?>"
                                                                style="color:#005282"><?php echo $title ?></a>
                                                        </td>
                                                        <td><?php echo $auth1,' ',$auth2,' ',$auth3,' ',$auth4,' ',$auth5 ?>
                                                        </td>
                                                        <td><?php  echo $replycount+1 ; ?></td>

                                                        <td><?php 
                                                           switch($level)
                                                           {
                                                               case "接受":echo "<span class='badge badge-soft-blue'>接受</span>" ;break;
                                                               case "小幅修改":echo  "<span class='badge badge-soft-warning'>小幅修改</span>" ;break;
                                                               case "大幅修改":echo  "<span class='badge badge-soft-success'>大幅修改</span>" ;break;
                                                               case "拒絕":echo "<span class='badge badge-soft-pink'>拒絕</span>";break;
                                                               case "退稿":echo "<span class='badge badge-soft-danger'>退稿</span>"; break;
                                                           }
                                                             ?></td>


                                                        <td><?php echo $message ?></td>
                                                        <td><?php echo $replytime ?></td>


                                                        <td>
                                                            <?php 
                                                            if(empty($file)){
                                                                echo " <a  class='action-icon' ><i class='mdi mdi-cancel'></i></a>";
                                                            }else{
                                                                echo " <a href='../管理者/upload/".$file."'  target='blank' download='".$file."' class='action-icon' ><i class='mdi mdi-arrow-collapse-down'></i></a> ";
                                                            }
                                                            
                                                            ?>
                                                        </td>

                                                    </tr>
                                                    <?php
                                                        }
                                                        ?>
                                                </tbody>

                                            </table>

                                        </div> <!-- end col-->
                                    </div>
                                    <!-- end row-->
                                </div> <!-- end card-box -->
                            </div> <!-- end Col -->
                        </div><!-- End row -->
                    </div>
                </div> <!-- container -->
            </div> <!-- content -->



        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->
    </div>
    <!-- END wrapper -->


    <!-- Vendor js -->
    <script src="../assets/js/vendor.min.js"></script>

    <!-- Bootstrap Tables js -->
    <script src="../assets/libs/bootstrap-table/bootstrap-table.min.js"></script>

    <!-- Init js -->
    <script src="../assets/js/pages/bootstrap-tables.init.js"></script>

    <!-- App js -->
    <script src="../assets/js/app.min.js"></script>

    <!-- Todo app -->
    <script src="../assets/js/pages/jquery.todo.js"></script>

    <!-- Inbox init -->
    <script src="../assets/js/pages/inbox.js"></script>

    <!-- Magnific Popup-->
    <script src="../assets/libs/magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- Gallery Init-->
    <script src="../assets/js/pages/gallery.init.js"></script>




</body>

</html>