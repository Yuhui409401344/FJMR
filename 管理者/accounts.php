<?php 
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
if(isset($_SESSION["account"]["login"])){
    $manager=$_SESSION["account"]["login"];
    foreach ($pdo->query("select status from account where login= '".$manager."'") as $row) {
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

                <!-- App css -->
                <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
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
                            <?php 
                                $pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
                                foreach ($pdo->query('select count(distinct login) from account') as $row) {
                                    $amount=$row[0];
                                }
                                foreach ($pdo->query("select count(distinct login) from follow where manager='".$manager."'") as $row) {
                                    $follow=$row[0];
                                }
                                foreach ($pdo->query("select count(login) from account where status='投稿者'") as $row) {
                                    $status1=$row[0];
                                }
                                foreach ($pdo->query("select count(login) from account where status='審稿者'") as $row) {
                                    $status2=$row[0];
                                }
                                foreach ($pdo->query("select count(login) from account where status='管理者'") as $row) {
                                    $status3=$row[0];
                                }
                            ?>


                        <div class="row mt-2">
                                <div class="col-md-6 col-xl-3">
                                    <div class="widget-rounded-circle card-box">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="avatar-lg rounded-circle bg-soft-primary border-primary border">
                                                    <i class="fe-heart font-22 avatar-title text-primary"></i>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-right">
                                                    <h3  data-plugin="counterup"class="mt-1"><?php echo $follow ?></h3>
                                                    <p class="text-muted mb-1 text-truncate">追蹤總數</p>
                                                </div>
                                            </div>
                                        </div> <!-- end row-->
                                    </div> <!-- end widget-rounded-circle-->
                                </div>
                                <div class="col-md-6 col-xl-3">
                                    <div class="widget-rounded-circle card-box">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="avatar-lg rounded-circle bg-soft-warning border-warning border">
                                                    <i class="fe-eye font-22 avatar-title text-warning"></i>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-right">
                                                    <h3 data-plugin="counterup" class="text-dark mt-1"><?php echo $amount ?></h3>
                                                    <p class="text-muted mb-1 text-truncate">用戶總數</p>
                                                </div>
                                            </div>
                                        </div> <!-- end row-->
                                    </div> <!-- end widget-rounded-circle-->
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-xl-4 col-md-6">
                                    <!-- Portlet card -->
                                    <div class="card">
                                        <div class="card-body" dir="ltr">
                                            <div class="card-widgets">
                                                <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                                                <a data-toggle="collapse" href="#cardCollpase4" role="button" aria-expanded="false" aria-controls="cardCollpase4"><i class="mdi mdi-minus"></i></a>
                                                <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                                            </div>
                                            <h4 class="header-title mb-0">我的追蹤</h4>

                                            <div id="cardCollpase4" class="collapse pt-3 show">
                                                <div class="text-center">
                                                <table class="tablesaw table mb-0 tablesaw-stack">
                                                        <thead>
                                                            <tr>
                                                                <th>User</th>
                                                                <th>Status</th>
                                                                <th>#action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php 
                                                        $pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
                                                        foreach ($pdo->query("SELECT login,name,email from follow where manager='$manager' ") as $row) {
                                                            $login=$row['login'];
                                                            $name=$row['name'];
                                                            $email=$row['email'];
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $name ?></td>
                                                            <td>
                                                            <?php
                                                                $pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
                                                                $query1=$pdo->query("SELECT status from account where login='$login' ");
                                                                $datalist1=$query1->fetchall();
                                                                foreach($datalist1 as $datadetail1){
                                                                    print_r($datadetail1['status']);
                                                                    echo ' ';
                                                                }
                                                            ?>
                                                            </td>
                                                            <!-- <?php if($status=="審稿者") echo "<td><span class='badge badge-soft-blue badge-pill '>審稿者</span></td>" ;
                                                            elseif($status=="投稿者") echo "<td><span class='badge badge-soft-secondary badge-pill '>投稿者</span></td>" ;
                                                            elseif($status=="管理者") echo "<td><span class='badge badge-soft-danger badge-pill'>管理者</span></td>";
                                                            ?> -->
                                                            <td>
                                                                <a href='deletefollowaccount.php?login=<?php echo "$login" ?> ' class='action-icon' onClick='return confirm("確定刪除?");' ><i class='mdi mdi-delete mr-1'></i></a>
                                                            </td>
                                                        </tr>
                                                        
                                                    <?php
                                                    }
                                                    ?>
                                                        </tbody>
                                                    </table>
                                                    
                                                </div>
                                            </div> <!-- end collapse-->
                                        </div> <!-- end card-body-->
                                    </div> <!-- end card-->
                                    <!-- Portlet card -->
                                </div>
                                <div class="col-xl-4 col-md-6">
                                    <div class="card">
                                        <div class="card-body" dir="ltr">
                                            <div class="card-widgets">
                                                <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                                                <a data-toggle="collapse" href="#cardCollpase3" role="button" aria-expanded="false" aria-controls="cardCollpase3"><i class="mdi mdi-minus"></i></a>
                                                <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                                            </div>
                                            <h4 class="header-title ">用戶級別數量</h4>
                                            <div id="cardCollpase3" class="collapse pt-3 show">
                                                <div class="text-center">
                                                <div id="donutchart" style="width: 449px; height: 300px;"></div>
                                                </div>
                                            </div>
                                        </div> <!-- end card-body-->
                                    </div> <!-- end card-->
                                </div>
                            </div>

                        
                            
                            
                            <!-- 搜尋功能 -->    
                            <?php
                                if($_GET){
                                $searchtxt = $_GET["searchtxt"]; 
                                }
                            ?>   
                            <form  method="get">
                                <div class="container">
                                    <input class="form-control" name="searchtxt" id="searchtxt" value="<?php if($_GET){echo $searchtxt;} ?>" type="text" placeholder="輸入名字搜尋">
                                    <br>
                                </div>
                            </form>

                            <div class="row">
                            <?php
                                $pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');	  
                                if(empty($searchtxt))
                                    {
                                        $sql="select account.login,account.name,account.password,account.email,account.status, account_img.photo,account_img.imgType FROM `account` left join account_img on account.login=account_img.login group by account.name"; //預設搜尋的SQL字串
                                    }
                                else
                                    {
                                        $sql="select  account.login,account.name,account.password,account.email,account.status, account_img.photo,account_img.imgType FROM `account` left join account_img on account.login=account_img.login where account.name like '%". $searchtxt . "%' group by account.name";
                                    }
                                $result=$pdo->query($sql);
                                foreach ($result as $row) {
                                    $login=$row['login'];
                                    $name=$row['name'];
                                    $email=$row['email'];
                                    $password=$row['password'];
                                    $status=$row['status'];
                                    $img=$row['photo'];
                                    $imgType=$row['imgType']
                                ?>
                                <div class="col-lg-4">
                                    <div class="text-center card-box">
                                        <div class="pt-2 pb-2">
                                        <?php 
                                            if(isset($img)){
                                                echo '<img src="data:'.$imgType.';base64,' . $img . '"   class="rounded-circle avatar-lg "  /><br>';
                                            }else{
                                                echo '<img src="../assets/images/user.png"   class="rounded-circle avatar-lg "  /><br>'; 
                                            }
                                        
                                        ?>
                                            <input type="button" style="color:black; font-size: large" name="<?php echo $name ?>" value="<?php echo $name ?>" id="<?php echo $login ?>" class=" btn btn-link mt-1 mb-1 waves-effect waves-light view_data"></input>
                                            <p class="text-muted">@
                                                <?php
                                                $pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
                                                $query1=$pdo->query("SELECT status from account where login='$login'");
                                                $datalist1=$query1->fetchall();
                                                foreach($datalist1 as $datadetail1){
                                                    print_r($datadetail1['status']);
                                                    echo ' ';
                                                }
                                                ?>
                                                </p> <span> | </span> <span> <a href="mailto:<?php echo $email ?>" class="text-pink"><?php echo $email ?></a> </span></p>

                                                <p>專長：
                                                <?php
                                                $pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
                                                $query=$pdo->query("SELECT distinct f_name from account_field where login='$login'");
                                                $datalist=$query->fetchall();
                                                foreach($datalist as $datadetail){
                                                    print_r($datadetail['f_name']);
                                                    echo ' ';
                                                }
                                                ?>
                                                </p>

                                                <a href="mailto:<?php echo $email ?>"><button type="button" class="btn btn-primary btn-sm waves-effect waves-light">傳送訊息</button></a>
                                                <a href='follow.php?login=<?php echo "$login" ?>'><button type="button" class="btn btn-light btn-sm waves-effect" onClick='return confirm("確定追蹤？");'>追蹤</button></a>

                                            

                                        </div> <!-- end .padding -->
                                    </div> <!-- end card-box-->
                                </div> <!-- end col -->
                                <?php 
                                }
                                ?>
                            </div>
                        </div> <!-- content -->
                    </div>

                    <!-- ============================================================== -->
                    <!-- End Page content -->
                    <!-- ============================================================== -->


                </div>
                <!-- END wrapper -->


                <!-- Vendor js -->
                <script src="../assets/js/vendor.min.js"></script>

                <!-- Plugins js-->
                <script src="../assets/libs/jquery-sparkline/jquery.sparkline.min.js"></script>
                <script src="../assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
                <script src="../assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js"></script>
                <!-- Plugins js -->
                <script src="../assets/libs/morris.js06/morris.min.js"></script>
                <script src="../assets/libs/raphael/raphael.min.js"></script>

                <!-- Dashboard 4 init -->
                <script src="../assets/js/pages/dashboard-4.init.js"></script>

                <!-- Todo app -->
                <script src="../assets/js/pages/jquery.todo.js"></script>

                <!-- App js -->
                <script src="../assets/js/app.min.js"></script>

                <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

            
            

                <!-- Standard modal content -->
                <div id="standard-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body" id="user_detail"> 
                            <!-- -------------- -->
                            <!-- userDetail.php -->
                            <!-- -------------- -->
                            
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                <script>
                $(document).ready(function(){
                    $('.view_data').click(function(){
                        var login = $(this).attr("id");
                        console.log(login);

                        $.ajax({
                            url:"userDetail.php",
                            method:"POST",
                            data:{
                                login:login},
                            success:function(data){
                                    $('#user_detail').html(data);
                                    $('#standard-modal').modal("show");
                            }
                        })
                            $('#standard-modal').modal("show");
                    });
                });
                </script>


        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript">
            google.charts.load("current", {packages:["corechart"]});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                ['投稿者',     <?php echo $status1 ?>],
                ['審稿者',     <?php echo $status2 ?>],
                ['管理者',     <?php echo $status3 ?>],
                ]);

                var options = {
                pieHole: 0.4,
                };

                var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
                chart.draw(data, options);
            }
            </script>
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

