<?php 
session_start();
if(isset($_SESSION["account"]["login"])){
    $password=$_SESSION["account"]["password"];
    $login=$_SESSION["account"]["login"];
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>審稿者</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
        <meta content="Coderthemes" name="author">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- App favicon -->
        <link rel="shortcut icon" href="../assets/images/favicon.ico">

		<!-- App css -->
		<link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet">
		<link href="../assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet">

		<link href="../assets/css/bootstrap-dark.min.css" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" disabled="disabled">
		<link href="../assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="app-dark-stylesheet" disabled="disabled">

		<!-- icons -->
		<link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css">
        <style>
.footable-row-detail-name {
  display: block;
  font-weight: 700;
  padding-right: 0.5em;
  width: 60px; }
        </style>

    </head>
<body class="loading">

<div id="wrapper">
    <?php include "header.php" ?>
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
                                    <div class="form-group">
                                        <input id="demo-foo-search" type="text" placeholder="Search" class="form-control form-control-sm" autocomplete="on">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="table-responsive">
                            <table id="demo-foo-filtering" class="table table-bordered toggle-circle mb-0" data-page-size="8">
                                <thead>
                                <tr>
                                    <th data-toggle="true" ellipsis>標題</th>
                                    <th data-hide="phone">作者</th>
                                    <th ellipsis data-hide="phone,tablet" style="display:block; width:70px">收件人</th>
                                    <th ellipsis>回覆評級</th>
                                    <th data-field="field" data-sortable="true" data-formatter="fieldFormatter">上傳日期</th>  
                                    <th data-field="field" data-sortable="true" data-formatter="fieldFormatter">回覆次數</th>  
                                    <!-- <th data-sortable="true">領域</th> -->
                                    <th>動作</th>
                                    <th data-hide="tablet">建議</th>
                                    
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        
                                        $pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
                                        foreach ($pdo->query("select * from reply_history where senter = '".$login."'") as $row) {
                                            $id=$row['id'];
                                            $title=$row['title'];
                                            $recipient=$row['recipient']; #收件人（管理者）
                                            $author1=$row['auth1'];
                                            $author2=$row['auth2'];
                                            $author3=$row['auth3'];
                                            $author4=$row['auth4'];
                                            $author5=$row['auth5'];
                                            $level=$row['level'];
                                            $time=$row['time'];  #上傳日期
                                            $replytime=$row['replytime'];  #回覆次數
                                            $comment=$row['comment'];
                                            $uploadname=$row['uploadname'];

                                    ?>
                                    <tr>
                                        <td><a href="p1.php?id=<?php echo "$id" ?>"><?php echo $title ?></a></td>
                                        <td><?php echo $author1, ' ',$author2,' ',$author3,' ',$author4,' ',$author5 ?></td>
                                        <td><?php echo $recipient ?></td>
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
                                        <td><?php echo $time ?></td>
                                        <td><?php echo $replytime ?></td>
                                        <td>
                                            <a href='../審稿者/upload/<?php echo $uploadname ?>'  target="blank" download="<?php echo $uploadname ?>"  class='action-icon'> <i class='mdi mdi-arrow-collapse-down'></i></a>
                                            <a href='delete_reply_history.php?title=<?php echo "$title" ?> ' class='action-icon' onClick='return confirm("確定刪除?");' ><i class='mdi mdi-delete mr-1'></i></a>
                                        </td>
                                        <td><?php 
                                        $comment=nl2br($comment);//回車換成換行
                                        echo $comment; ?>
                                        </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                                
                                <tfoot>
                                <tr class="active">
                                    <td colspan="7">
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




</body>
</html>