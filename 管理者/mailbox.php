<link href="../assets/libs/bootstrap-table/bootstrap-table.min.css" rel="stylesheet" type="text/css" />

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
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"></a></li>
                                        <li class="breadcrumb-item active">審稿者回覆</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <div class="row">

                        <!-- Right Sidebar -->
                        <div class="col-12">
                            <div class="card-box">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <form action="reply.php" method="post">
                                            <table id="demo-custom-toolbar" data-toggle="table" data-toolbar="#toolbar"
                                                data-search="true" data-show-refresh="true" data-show-columns="true"
                                                data-sort-name="date" data-page-list="[5, 10, 20]" data-page-size="10"
                                                data-pagination="true" data-show-pagination-switch="true"
                                                class="table-borderless">

                                                <colgroup>
                                                    <col span="1" style="width: 25%;">
                                                    <col span="1" style="width: 15%;">
                                                    <col span="1" style="width: 15%;">
                                                    <col span="1" style="width: 15%;">
                                                    <col span="1" style="width: 15%;">
                                                    <col span="1" style="width: 15%;">
                                                </colgroup>


                                                <thead class="thead-light">

                                                    <tr>
                                                        <th data-field="id" data-sortable="true">標題</th>
                                                        <th data-field="recipient" data-sortable="true">作者</th>
                                                        <th data-field="name" data-sortable="true">審稿者</th>
                                                        <th data-field="date" data-sortable="true"
                                                            data-formatter="dateFormatter">回覆時間</th>
                                                        <th data-field="status" data-align="center" data-sortable="true"
                                                            data-formatter="statusFormatter">回覆評級</th>
                                                        <!-- <th data-field="times" data-align="center" data-sortable="true" data-formatter="timesFormatter">回覆次數</th> -->
                                                        <!-- <th data-align="center" >回覆建議</th> -->
                                                        <th data-field="action" data-align="center"
                                                            data-sortable="false">動作</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    
                                                    $pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
                                                    
                                                    foreach ($pdo->query("select * from reply where recipient='".$login."'") as $row) {
                                                        $id=$row['id'];
                                                        $title=$row['title'];
                                                        $senter=$row['senter'];
                                                        $time=$row['time'];
                                                        $recipient=$row['recipient']; //指的是管理者，也就是自己
                                                        $auth1=$row['auth1'];
                                                        $auth2=$row['auth2'];
                                                        $auth3=$row['auth3'];
                                                        $auth4=$row['auth4'];
                                                        $auth5=$row['auth5'];
                                                        $level=$row['level'];
                                                        $file=$row['uploadname'];
                                                        $replytime=$row['replytime'];
                                                        $comment=$row['comment'];
                                                        

                                                ?>
                                                    <tr>
                                                        <td><a href="pages-mailbox.php?title=<?php echo "$title"?>"
                                                                style="color: #005282"><?php echo $title ?></a>
                                                        </td>
                                                        <td><?php echo $auth1,' ',$auth2,' ',$auth3,' ',$auth4,' ',$auth5 ?>
                                                        </td>
                                                        <td><?php echo $senter ?></td>
                                                        <td><?php echo $time ?></td>
                                                        <td><?php 
                                                                if ($level=='接受') {
                                                                    echo "<span class='badge badge-soft-blue'>接受</span>" ;
                                                                }elseif ($level=='大幅修改') {
                                                                    echo  "<span class='badge badge-soft-warning'>大幅修改</span>";
                                                                }elseif($level=='小幅修改'){
                                                                    echo  "<span class='badge badge-soft-success'>小幅修改</span>";
                                                                }elseif($level=='拒絕'){
                                                                    echo "<span class='badge badge-soft-danger'>拒絕</span>";
                                                                }
                                                        ?></td>



                                                        <td>
                                                            <?php 
                                                            foreach ($pdo->query("select title, count(title) as count from reply where title='".$title."'") as $row) {
                                                                $amount=$row['count']; //回覆稿件的數量。同篇稿件要集齊兩篇回覆才能讓管理者統一回覆。
                                                            }
                                                            if($amount >= 2){
                                                                echo "<a href='reply.php?title=".$title."' class='action-icon' ><i class='mdi mdi-email-send-outline'></i></a>";
                                                            } 
                                                        ?>
                                                            <a href='../審稿者/upload/<?php echo $file ?>' target="blank"
                                                                download="<?php echo $file ?>" class='action-icon'> <i
                                                                    class='mdi mdi-arrow-collapse-down'></i></a>
                                                        </td>



                                                    </tr>
                                                    <?php
                                                }
                                                ?>
                                                </tbody>
                                            </table>

                                        </form>

                                    </div> <!-- end col-->
                                </div>
                                <!-- end row-->
                            </div> <!-- end card-box -->
                        </div> <!-- end Col -->
                    </div><!-- End row -->
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

    <!-- Todo app -->
    <script src="../assets/js/pages/jquery.todo.js"></script>

    <!-- Bootstrap Tables js -->
    <script src="../assets/libs/bootstrap-table/bootstrap-table.min.js"></script>

    <!-- Init js -->
    <script src="../assets/js/pages/bootstrap-tables.init.js"></script>

    <!-- App js -->
    <script src="../assets/js/app.min.js"></script>

    <!-- Inbox init -->
    <script src="../assets/js/pages/inbox.js"></script>




</body>