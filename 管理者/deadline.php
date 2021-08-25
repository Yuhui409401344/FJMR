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
                                    <li class="breadcrumb-item active">即將到期之稿件</li>
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
                                        <table id="demo-custom-toolbar"
                                            data-toggle="table"
                                            data-toolbar="#toolbar"
                                            data-search="true"
                                            data-show-refresh="true"
                                            data-show-columns="true"
                                            data-sort-name="date"
                                            data-page-list="[5, 10, 20]"
                                            data-page-size="6"
                                            data-pagination="true" data-show-pagination-switch="true" class="table-borderless"
                                            style="font-weight: 700;">
                                            

                                           <thead class="thead-light">
                                                
                                            <tr>
                                                <th data-field="id"  data-sortable="true">標題</th>
                                                <th data-field="recipient" data-sortable="true">作者</th>
                                                <th data-field="name" data-sortable="true">審稿者</th>
                                                <th data-field="date" data-sortable="true" data-formatter="dateFormatter">回覆時間</th>
                                                <th data-field="status" data-align="center" data-sortable="true">審稿者Email</th>
                                                <th data-field="action" data-align="center" data-sortable="false">審稿者電話</th>
                                                
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                
                                                $pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
                                                foreach ($pdo->query("SELECT distri.* from distri where not exists ( select id,reply.senter from reply where reply.id=distri.id AND reply.senter = distri.pro )") as $row) {
                                                    $id=$row['id'];
                                                    $title=$row['title'];
                                                    $pro=$row['pro'];
                                                    $ddl=$row['ddl'];
                                                    $auth1=$row['auth1'];
                                                    $auth2=$row['auth2'];
                                                    $auth3=$row['auth3'];
                                                    $auth4=$row['auth4'];
                                                    $auth5=$row['auth5'];
                                                    $level=$row['level'];
                                                    $file=$row['uploadname'];
                                                    $replytime=$row['replytime'];
                                                    $comment=$row['comment'];
                                                    
                                                    foreach($pdo->query("select account.name,account.email,account_tel.tel from account LEFT JOIN account_tel ON account.login = account_tel.login where account.login = '".$pro."'") as $sql1){
                                                        $email = $sql1['email'];
                                                        $name = $sql1['name'];
                                                        $tel = $sql1['tel'];
                                                    }

                                            ?>
                                            <tr>
                                                <td><a href="p2.php?id=<?php echo $id?>&&pro=<?php echo $pro?>"><?php echo $title ?></a></td>
                                                <td><?php echo $auth1,' ',$auth2,' ',$auth3,' ',$auth4,' ',$auth5 ?></td>
                                                <td><?php echo $name ?></td>
                                                <td><?php echo $ddl ?></td>
                                                <td><?php echo $email ?></td>            
                                                <td><?php echo $tel ?></td>
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