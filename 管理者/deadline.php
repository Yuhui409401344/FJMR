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
                <div class="container-fluid">
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="text-center filter-menu">
                                <a href="javascript: void(0);" class="filter-menu-item active" data-rel="all">All</a>
                                <a href="javascript: void(0);" class="filter-menu-item"
                                    data-rel="closeddl">即將到期未收到回覆的稿件</a>
                                <a href="javascript: void(0);" class="filter-menu-item"
                                    data-rel="overddl">已超過回覆期限的稿件</a>
                            </div>
                        </div>
                    </div>
                    <!-- end row-->
                    <div class="row filterable-content">
                        <!-- 即將到期但未收到回覆的稿件 -->
                        <div class="row col-12 col-xl-12 filter-item all closeddl">
                            <div class="col-12">
                                <div class="card-box">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <form action="closeddl_mail.php" method="POST" id="closeddl">
                                                <input type="submit" id="row" class="btn btn-danger btn-sm"
                                                    value="寄送信件">
                                                <table id="demo-custom-toolbar" data-toolbar="#row" data-toggle="table"
                                                    data-toolbar="#toolbar" data-search="true" data-show-refresh="true"
                                                    data-show-columns="true" data-sort-name="date"
                                                    data-page-list="[5, 10, 20]" data-page-size="6"
                                                    data-pagination="true" data-show-pagination-switch="true"
                                                    class="table-borderless">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th data-field data-align="center"></th>
                                                            <th data-field="id" data-sortable="true">標題</th>
                                                            <th data-field="recipient" data-sortable="true">作者</th>
                                                            <th data-field="name" data-sortable="true">審稿者</th>
                                                            <th data-field="date" data-sortable="true"
                                                                data-align="center" data-formatter="dateFormatter">回覆日期
                                                            </th>
                                                            <th data-field="ddl" data-align="center"
                                                                data-sortable="true">距離截稿日期</th>
                                                            <th data-field="phone" data-align="center"
                                                                data-sortable="false">審稿者電話</th>
                                                            <th data-field="action" data-align="center"
                                                                data-sortable="false">傳送信件</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                $pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
                                                foreach ($pdo->query("SELECT distri.*,DATEDIFF(distri.ddl,now()) as deadline from distri where not exists ( select id,reply.senter from reply where reply.id=distri.id AND reply.senter = distri.pro ) AND DATEDIFF(distri.ddl,now()) between 0 and 5 ") as $row) {
                                                    $id=$row['id'];
                                                    $title=$row['title'];
                                                    $pro=$row['pro'];
                                                    $ddl=$row['ddl'];
                                                    $auth1=$row['auth1'];
                                                    $auth2=$row['auth2'];
                                                    $auth3=$row['auth3'];
                                                    $auth4=$row['auth4'];
                                                    $auth5=$row['auth5'];
                                                    $deadline = $row['deadline'];
                                                    
                                                    foreach($pdo->query("select account.name,account.email,account_tel.tel from account LEFT JOIN account_tel ON account.login = account_tel.login where account.login = '".$pro."'") as $sql1){
                                                        $email = $sql1['email'];
                                                        $name = $sql1['name'];
                                                        $tel = $sql1['tel'];
                                                    }

                                            ?>
                                                        <tr>
                                                            <td><input type="checkbox" value="<?php echo $email?>"
                                                                    name="email[]"></td>
                                                            <td><a href="distriHistoryContent.php?id=<?php echo $id?>&&pro=<?php echo $pro?>"
                                                                    style="color: #6C757D"><?php echo $title ?></a>
                                                            </td>
                                                            <td><?php echo $auth1,' ',$auth2,' ',$auth3,' ',$auth4,' ',$auth5 ?>
                                                            </td>
                                                            <td><?php echo $name ?></td>
                                                            <td><?php echo $ddl ?></td>
                                                            <td><?php echo $deadline ?></td>
                                                            <td><?php echo $tel ?></td>
                                                            <td><a href="closeddl_mail.php?email=<?php echo $email?>"
                                                                    class='action-icon'><i
                                                                        class="mdi mdi-email-send-outline"
                                                                        style="color:#d96060"></i></a></td>
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

                        <!-- 已超過回覆期限的稿件 -->
                        <div class="row col-12 col-xl-12 filter-item all overddl">
                            <div class="col-12">
                                <div class="card-box">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <form action="overddl_mail.php" method="POST" id="overddl">
                                                <input type="submit" id="demo-row" class="btn btn-danger btn-sm"
                                                    value="寄送信件">
                                                <table id="demo-custom-toolbar" data-toolbar="#demo-row"
                                                    data-toggle="table" data-toolbar="#toolbar" data-search="true"
                                                    data-show-refresh="true" data-show-columns="true"
                                                    data-sort-name="date" data-page-list="[5, 10, 20]"
                                                    data-page-size="6" data-pagination="true"
                                                    data-show-pagination-switch="true" class="table-borderless">


                                                    <thead class="thead-light">

                                                        <tr>
                                                            <th data-field="checkbox"></th>
                                                            <th data-field="id" data-sortable="true">標題</th>
                                                            <th data-field="recipient" data-sortable="true">作者</th>
                                                            <th data-field="name" data-sortable="true">審稿者</th>
                                                            <th data-field="date" data-sortable="true"
                                                                data-align="center" data-formatter="dateFormatter">回覆日期
                                                            </th>
                                                            <th data-field="ddl" data-align="center"
                                                                data-sortable="true">已超過截稿日期</th>
                                                            <th data-field="phone" data-align="center"
                                                                data-sortable="false">審稿者電話</th>
                                                            <th data-field="action" data-align="center"
                                                                data-sortable="false">傳送信件</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                
                                                $pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
                                                foreach ($pdo->query("SELECT distri.*,DATEDIFF(distri.ddl,now()) as deadline from distri where not exists ( select id,reply.senter from reply where reply.id=distri.id AND reply.senter = distri.pro ) AND DATEDIFF(distri.ddl,now()) < 0") as $row) {
                                                    $id=$row['id'];
                                                    $title=$row['title'];
                                                    $pro=$row['pro'];
                                                    $ddl=$row['ddl'];
                                                    $auth1=$row['auth1'];
                                                    $auth2=$row['auth2'];
                                                    $auth3=$row['auth3'];
                                                    $auth4=$row['auth4'];
                                                    $auth5=$row['auth5'];
                                                    $deadline = $row['deadline'];
                                                    
                                                    foreach($pdo->query("select account.name,account.email,account_tel.tel from account LEFT JOIN account_tel ON account.login = account_tel.login where account.login = '".$pro."'") as $sql1){
                                                        $mail = $sql1['email'];
                                                        $name = $sql1['name'];
                                                        $tel = $sql1['tel'];
                                                    }

                                            ?>
                                                        <tr>
                                                            <td><input type="checkbox" value="<?php echo $mail?>"
                                                                    name="mail[]"></td>
                                                            <td><a href="distriHistoryContent.php?id=<?php echo $id?>&&pro=<?php echo $pro?>"
                                                                    style="color: #6C757D"><?php echo $title ?></a>
                                                            </td>
                                                            <td><?php echo $auth1,' ',$auth2,' ',$auth3,' ',$auth4,' ',$auth5 ?>
                                                            </td>
                                                            <td><?php echo $name ?></td>
                                                            <td><?php echo $ddl ?></td>
                                                            <td><?php echo abs($deadline) ?></td>
                                                            <td><?php echo $tel ?></td>
                                                            <td><a href="overddl_mail.php?mail=<?php echo $mail?>"
                                                                    class='action-icon'><i
                                                                        class="mdi mdi-email-send-outline"></i></a></td>
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
                    </div>
                </div> <!-- container -->
            </div> <!-- content -->
        </div>

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