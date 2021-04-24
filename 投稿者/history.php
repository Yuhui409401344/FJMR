<?php include "nav.php"?>
<head>
    <style>
.footable-row-detail-name {
  display: block;
  font-weight: 700;
  padding-right: 0.5em;
  width: 70px; 
}
    </style>
</head>
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mt-2">
                    <div class="card-box">
                        <div class="mb-2">
                            <div class="row">
                                <div class="col-12 text-sm-center form-inline">
                                    <div class="form-group mr-2">
                                        <select id="demo-foo-filter-status" class="custom-select custom-select-sm">
                                            <option value="">全部</option>
                                            <option value="等待主編確認">等待主編確認</option>
                                            <option value="審稿中">審稿中</option>
                                            <option value="已接收">已接收</option>
                                            <option value="退稿">退稿</option>
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
                                    <th data-field="field" data-sortable="true" data-hide="phone" data-formatter="fieldFormatter">上傳日期</th>
                                    <th data-align="center">狀態</th>
                                    <th data-hide="tablet,phone">摘要</th>
                                    
                                </tr>
                                </thead>
                                <tbody>
                                        <?php
                                            $pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
                                            foreach ($pdo->query("select * from newpaper_history where ((select DISTINCT name from account where login = '".$login."') in (auth1,auth2,auth3,auth4,auth5)) ") as $row) {
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
                                            <td>
                                            <?php $query1=$pdo->query("SELECT title from newpaper");
                                                $datalist1=$query1->fetchall();
                                                foreach($datalist1 as $datadetail1){
                                                    $arr1[]=$datadetail1['title'];
                                                    
                                                }
                                                // 審稿中data in distri or reply
                                                $query2=$pdo->query("SELECT title from reply UNION select title from distri ");
                                                $datalist2=$query2->fetchall();
                                                foreach($datalist2 as $datadetail2){
                                                    $arr2[]=$datadetail2['title'];
                                                    
                                                }
                                                // 已接收data in totalreply and level is 修改、接受、拒絕
                                                $query3=$pdo->query("SELECT title from totalreply where (level='大幅修改' or level = '小幅修改' or level = '接受' or level = '拒絕')  ");
                                                $datalist3=$query3->fetchall();
                                                foreach($datalist3 as $datadetail3){
                                                    $arr3[]=$datadetail3['title'];
                                                    
                                                }
                                                // 退稿data in totalreply and level is 退稿
                                                $query4=$pdo->query("SELECT title from totalreply where level='退稿' ");
                                                $datalist4=$query4->fetchall();
                                                foreach($datalist4 as $datadetail4){
                                                    $arr4[]=$datadetail4['title'];
                                                    
                                                }

                                                if (isset($arr1) and in_array($title, $arr1)) {
                                                    $s ="等待主編確認" ;
                                                }elseif (isset($arr2) and in_array($title,$arr2)) {
                                                    $s = "審稿中";
                                                }elseif(isset($arr3) and in_array($title,$arr3)){
                                                    $s ="已接收";
                                                }elseif(isset($arr4) and in_array($title,$arr4)){
                                                    $s ="退稿";
                                                }
                                            ?>

                                            <a href="p2.php?id=<?php echo "$id"?> && s=<?php echo "$s" ?>"><?php echo $title ?></a></td>
                                            <td><?php echo $author1, ' ',$author2,' ',$author3,' ',$author4,' ',$author5?></td>
                                            <td><?php echo $row['uploadtime']?></td>
                                            <!-- 狀態 -->
                                            <td> 
                                            <?php
                                                if (isset($arr1) and in_array($title, $arr1)) {
                                                    echo "<span class='badge badge-soft-blue'>等待主編確認</span>" ;
                                                }elseif (isset($arr2) and in_array($title,$arr2)) {
                                                    echo  "<span class='badge badge-soft-warning'>審稿中</span>";
                                                }elseif(isset($arr3) and in_array($title,$arr3)){
                                                    echo  "<span class='badge badge-soft-success'>已接收</span>";
                                                }elseif(isset($arr4) and in_array($title,$arr4)){
                                                    echo "<span class='badge badge-soft-danger'>退稿</span>";
                                                }
                                                
                                            ?></td>

                                                <!-- 摘要 -->
                                                <td><?php 
                                                $Summary=nl2br($summary);//回車換成換行
                                                echo $Summary; 
                                                ?>
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
<!-- END wrapper -->

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




<!-- Footable js -->
<script src="../assets/libs/footable/footable.all.min.js"></script>

<!-- Init js -->
<script src="../assets/js/pages/foo-tables.init.js"></script>



<!-- Inbox init -->
<script src="../assets/js/pages/inbox.js"></script>

<!-- Plugins js-->
<script src="../assets/libs/flatpickr/flatpickr.min.js"></script>
<script src="../assets/libs/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script src="../assets/libs/clockpicker/bootstrap-clockpicker.min.js"></script>
<script src="../assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

<!-- Init js for time picker-->
<script src="../assets/js/pages/form-pickers.init.js"></script>

