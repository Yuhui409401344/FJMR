<?php 
session_start();

$pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
if(isset($_SESSION["account"]["login"])){
    $login=$_SESSION["account"]["login"];
    foreach ($pdo->query("select status from account where login= '".$login."'") as $row) {
    $status[] = $row['status'];
    }
    if(in_array("管理者",$status)){
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>管理者</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="../assets/images/favicon.ico">

        <!-- Bootstrap Tables css -->
        <link href="../assets/libs/bootstrap-table/bootstrap-table.min.css" rel="stylesheet" type="text/css" />

	    <!-- App css -->
	    <link href="../assets/css/bootstrap.min.(1).css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
	    <link href="../assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

	    <link href="../assets/css/bootstrap-dark.min.css" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
	    <link href="../assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />

	    <!-- icons -->
	    <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />

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
                                                        <th data-field="status" data-align="center" data-sortable="true" data-formatter="statusFormatter">回覆意見</th>
                                                        <!-- <th data-field="times" data-align="center" data-sortable="true" data-formatter="timesFormatter">回覆次數</th> -->
                                                        <!-- <th data-align="center" >回覆建議</th> -->
                                                        <th data-field="action" data-align="center" data-sortable="false">動作</th>
                                                        
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                        
                                                        $pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
                                                        foreach ($pdo->query("select count(title) from reply where recipient='".$login."'") as $row) {
                                                            $amount=$row[0];
                                                        }
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
                                                        <td><a href="pages-mailbox.php?title=<?php echo "$title"?>"><?php echo $title ?></a></td>
                                                        <td><?php echo $auth1,' ',$auth2,' ',$auth3,' ',$auth4,' ',$auth5 ?></td>
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

                                                        <!-- <td><?php  echo $replytime ; ?></td>
                                                       <td><?php echo $comment ?></td> -->
                                                        
                                                        
                                                        <td>
                                                        <?php 
                                                        if($amount >= 2){
                                                            echo "<a href='reply.php?title=".$title."' class='action-icon' ><i class='mdi mdi-email-send-outline'></i></a>";
                                                        } 
                                                        ?>
                                                        <a href='../審稿者/upload/<?php echo $file ?>' target="blank" download="<?php echo $file ?>" class='action-icon'> <i class='mdi mdi-arrow-collapse-down'></i></a>
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
</html>
<?php
    }else{
        include "pages-404.html";
    }
}else{
    include "pages-404.html";
}
?>