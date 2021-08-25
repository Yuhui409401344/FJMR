    <body class="loading">
    <style>
.footable-row-detail-name {
  display: block;
  font-weight: 700;
  padding-right: 0.5em;
  width: 40px; }
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
                                            <li class="breadcrumb-item active">分配投稿者的新稿件</li>
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
                                                    <select id="demo-foo-filter-status" class="custom-select custom-select-sm">
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
                                                    <input id="demo-foo-search" type="text" placeholder="Search" class="form-control form-control-sm" autocomplete="on">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="table-responsive">
                                        <table id="demo-foo-filtering" class="table table-bordered toggle-circle mb-0" data-page-size="7">
                                            <thead>
                                            <tr>
                                                <th data-toggle="true" ellipsis>標題</th>
                                                <th ellipsis>作者</th>
                                                <th data-field="field" data-sortable="true" data-formatter="fieldFormatter" data-hide="phone">領域</th>
                                                <th>上傳日期</th>
                                                <th data-align="center">動作</th>
                                                <th data-hide="phone,tablet">摘要</th>
                                                
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

                                                    ?>
                                                    <tr>
                                                        <td><a href='pages-maildistribution.php?id=<?php echo "$id"?>'><?php echo $title ?></a></td>
                                                        <td><?php echo $author1, ' ',$author2,' ',$author3,' ',$author4,' ', $author5 ?></td>
                                                       
                                                        
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
                                                        <td><?php echo $row['uploadtime']?></td>
                                                        <td>
                                                            <a href='../投稿者/upload/<?php echo $uploadname ?>'  target="blank" download="<?php echo $uploadname ?>"  class='action-icon'> <i class='mdi mdi-arrow-collapse-down'></i></a>
                                                            <a href='distri.php?id=<?php echo "$id" ?> ' class='action-icon' ><i class='mdi mdi-email-send-outline'></i></a>
                                                            <a href='reply-cancel.php?id=<?php echo "$id" ?> ' class='action-icon' ><i class='mdi mdi-reply mr-1'></i></a>
                                                        </td>
                                                        <td><?php 
                                                        $Summary=nl2br($summary);//回車換成換行
                                                        echo $Summary; ?>
                                                        </td>
                                                        </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                </tbody>
                                            
                                            <tfoot>
                                            <tr class="active">
                                                <td colspan="5">
                                                    <div class="text-right">
                                                        <ul class="pagination pagination-rounded justify-content-end footable-pagination m-t-10 mb-0"></ul>
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


        
        <!-- Vendor js -->
        <script src="../assets/js/vendor.min.js"></script>

        <script src="../assets/libs/selectize/js/standalone/selectize.min.js"></script>
        <script src="../assets/libs/mohithg-switchery/switchery.min.js"></script>
        <script src="../assets/libs/multiselect/js/jquery.multi-select.js"></script>
        <script src="../assets/libs/select2/js/select2.min.js"></script>
        <script src="../assets/libs/jquery-mockjax/jquery.mockjax.min.js"></script>
        <script src="../assets/libs/devbridge-autocomplete/jquery.autocomplete.min.js"></script>
        <script src="../assets/libs/bootstrap-select/js/bootstrap-select.min.js"></script>
        <script src="../assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
        <script src="../assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>

        <!-- Init js for modal select bar-->
        <script src="../assets/js/pages/form-advanced.init.js"></script>

        <!-- Todo app -->
        <script src="../assets/js/pages/jquery.todo.js"></script>

        <!-- Footable js -->
        <script src="../assets/libs/footable/footable.all.min.js"></script>

        <!-- Init js -->
        <script src="../assets/js/pages/foo-tables.init.js"></script>

        <!-- App js -->
        <script src="../assets/js/app.min.js"></script>

        <!-- Inbox init -->
        <script src="../assets/js/pages/inbox.js"></script>

        <!-- Plugins js-->
        <script src="../assets/libs/flatpickr/flatpickr.min.js"></script>
        <script src="../assets/libs/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
        <script src="../assets/libs/clockpicker/bootstrap-clockpicker.min.js"></script>
        <script src="../assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

        <!-- Init js for time picker-->
        <script src="../assets/js/pages/form-pickers.init.js"></script>

        
    </body>