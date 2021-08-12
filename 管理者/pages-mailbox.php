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
        <title><?php echo $title ?></title>
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
    
    <?php include "header.php" ?>
    
    <body class="loading">

        <div id="wrapper">
            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <!-- start page title -->
                         <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-left mt-1">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"></li>
                                            <li class="breadcrumb-item"><a href="mailbox.php">所有信件</a></li>
                                            <li class="breadcrumb-item active">審稿者回覆</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->
                    <div class="container-fluid">
                    <?php $title=$_REQUEST["title"] ;
                        $pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
                        foreach ($pdo->query('select count(title) from reply') as $row) {
                            $amount=$row[0];
                        }
                        foreach ($pdo->query("select * from reply where title='".$title."'") as $row) {
                            $senter=$row['senter'];
                            $recipient=$row['recipient'];
                            $author1=$row['auth1'];
                            $author2=$row['auth2'];
                            $author3=$row['auth3'];
                            $author4=$row['auth4'];
                            $author5=$row['auth5'];
                            $level=$row['level'];
                            $time=$row['time'];
                            $replytime=$row['replytime'];
                            $uploadname=$row['uploadname'];
                            $comment=$row['comment'];
                    ?>
                          

                        <div class="row">
                            <div class="col-12">
                                <div class="card-box">
                                    <div class="row">
                                        <div class="container-fluid">
                                            <div style=" display: flex;
                                                        justify-content: right;
                                                        border: 0;
                                                        bottom: 0;">
                                            <h3 style="font-weight: bolder;font-family:Microsoft JhengHei;margin-left: 10px;margin-top: 20px;"><?php echo $title ?></h3>
                                            </div>
                                            <div class="container">
                                                <div class="row justify-content-start">
                                                  
                                                  <div class="col-6">
                                                    審稿回覆檔案：<a href='../審稿者/upload/<?php echo $uploadname ?>'  target="blank" download="<?php echo $uploadname ?>"><?php echo $uploadname ?></a>
                                                  </div>
                                                  <div class="col-3">
                                                    發布時間：<?php echo $time ;?>
                                                  </div>
                                                <div class="col-3">
                                                    審稿者：<?php echo $senter ;?>
                                                  </div>
                                                </div>
                                              </div>
                                            <div class="row">
                                                <div class="container mt-0" >
                                                <section class="mt-3">

                                                <!-- Card header -->
                                                <div class="card-header border-0 font-weight-bold d-flex justify-content-between">
                                                <p class="mr-4 mb-0">作者</p>
                                                </div>

                                                <div class="media my-2 px-1">
                                                    <div class="media-body" style="font-family:Microsoft JhengHei">
                                                        <div>
                                                          <p class=" mb-0;" style="color: #1c2a48; margin-bottom: 0px;font-weight: 520"><?php echo $author1,' ', $author2,' ', $author3,' ', $author4, ' ', $author5 ?></p>
                                                          
                                                        </div>
                                                    </div>
                                                </div>

                                                </section>
                                                </div>
                                                <div class="container">
                                                <section class="mt-3">

                                                <!-- Card header -->
                                                <div class="card-header border-0 font-weight-bold d-flex justify-content-between">
                                                <p class="mr-4 mb-0">留言</p>
                                                </div>

                                                <div class="media mt-3 px-1">
                                                <div class="media-body" style="text-align: justify; padding-right: 30px;font-family:Microsoft JhengHei">
                                                    <p><?php echo $comment ?></p>
                                                </div>
                                                </div>

                                                </section>
                                                </div>

                                                <!-- <div class="container">
                                                    <section class="my-5">

                                                        <div class="card-header border-0 font-weight-bold d-flex justify-content-between">
                                                        <p class="mr-4 mb-0">關鍵字</p>
                                                        </div>

                                                        <div class="media mt-4 px-1">
                                                            <div class="media-body">
                                                                <a href="">關鍵因素，國際交換生，層級分析法</a>
                                                            </div>
                                                        </div>

                                                    </section>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end card-->
                                
                            </div> <!-- end col-->
                           
                        </div>
                        <?php }

                        if($amount>=2){
                        ?>
                         <button type="button" class="btn btn-success waves-effect waves-light" style="text-align:center; float:right">
                            <a href='reply.php?title=<?php echo "$title" ?>' style="color: white"><span class="btn-label"><i class="fas mdi mdi-email-send-outline fa-lg"></i></span>回覆</a>
                        </button>
                        <?php 
                            } 
                        ?>
                       
                        
                        
                    </div> <!-- container -->

                </div> <!-- content -->
            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->
            </body>
        

        </div>
        <!-- END wrapper -->

        <!-- Todo app -->
        <script src="../assets/js/pages/jquery.todo.js"></script>

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- Vendor js -->
        <script src="../assets/js/vendor.min.js"></script>

        <!-- App js -->
        <script src="../assets/js/app.min.js"></script>
        
    
</html>
<?php
    }else{
        include "pages-404.html";
    }
}else{
    include "pages-404.html";
}
?>