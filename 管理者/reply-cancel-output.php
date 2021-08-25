<?php 
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
if(isset($_SESSION["account"]["login"])){
    $manager=$_SESSION["account"]["login"];
    foreach ($pdo->query("select status from account where login= '".$manager."'") as $row) {
    $status[] = $row['status'];
    }
    if(in_array("管理者",$status)){

$password=$_SESSION["account"]["password"];
$login=$_SESSION["account"]["login"];
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>審稿者</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="../assets/images/favicon.ico">

        <!-- Plugins css-->
        <link href="../assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/libs/summernote/summernote-bs4.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css" />
        
	    <!-- App css -->
	    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
	    <link href="../assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

	    <link href="../assets/css/bootstrap-dark.min.css" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
	    <link href="../assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />

	    <!-- icons -->
	    <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />

    </head>

    <body class="loading">
        <div id="wrapper">
                <?php include "header.php" ?>

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <br>
                                <div class="card-box">
                                    <?php
                                    $id=$_GET["id"];
                                    $level=$_POST["level"];
                                    $message=$_POST["message"];
                                    $pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
                                    foreach ($pdo->query("select * from newpaper where id='".$id."'") as $row) {
                                        $title=$row["title"];
                                        $uploader=$row["uploader"];
                                        $auth1=$row['auth1'];
                                        $auth2=$row['auth2'];
                                        $auth3=$row['auth3'];
                                        $auth4=$row['auth4'];
                                        $auth5=$row['auth5'];

                                        $replytime="SELECT COUNT(*)+1 AS count_ FROM totalreply WHERE title='".$title."'";
                                        $result=$pdo->query($replytime);
                                        foreach($result as $row){
                                            $sql=$pdo->prepare('insert into totalreply (id,title,uploader,senter,auth1,auth2,auth3,auth4,auth5,level,message,replycount) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)');
                                            $sql->execute([$id,$title,$uploader,$login,$auth1,$auth2,$auth3,$auth4,$auth5,$level,$message,$row['count_']]);
                                            
                                            $count_ = $row['count_'];
                                        }
                                    }
                            
                                    $sql5 = $pdo->query("select email from account where login='".$uploader."' and status='投稿者'");
                                    foreach($sql5 as $row){

                                        $to_email = $row['email'];
                                        $subject = '投稿文章:'.$title;
                                        $message1 = '已評閱完畢，請盡速到平台確認結果。';
                                        $headers = 'From: 408402511@gapp.fju.edu.tw';

                                        mail($to_email,$subject,$message1,$headers);
                                    }

                                    echo "<script> {window.alert('發送成功');'} </script>";
                                    $sql3=$pdo ->prepare('delete from newpaper where id=?');
                                    $sql3->execute([$id]);
                                ?>
                                      
                                    <label for="product-name" style="font-size: 20px;"><?php echo "回覆成功!";?></label>
                                            
                                       <table border="0">
                                            <tr>
                                                <td>
                                                    <font size="5"><span class="badge badge-soft-secondary">標題</span></font></td>
                                                <td><lebel style="font-size:18px"><?php echo $title?></lebel></td></tr><br>
                                            <tr>
                                                <td><font size="5"><span class="badge badge-soft-secondary">收件人</span></font></td>
                                                
                                                <td><lebel style="font-size:18px"><?php echo $auth1?></lebel></td></tr>
                                            <tr>
                                                <td><font size="5"><span class="badge badge-soft-secondary">回覆評級</span>&nbsp;&nbsp;&nbsp;&nbsp;</font></td>
                                                <td><lebel style="font-size:18px"><?php echo $level ?></lebel></td></tr><br>
                                            <tr>
                                                <td><font size="5"><span class="badge badge-soft-secondary">回覆次數</span></font></td>
                                                <td><lebel style="font-size:18px"><?php echo $count_ ?></lebel></td></tr><br>

                                            <tr>
                                            <td><font size="5"><span class="badge badge-soft-secondary">回覆意見</span></font></td>
                                            <td><lebel style="font-size:18px"><?php echo $message ?></lebel></td></tr><br>
                                            
                                        </table>
                                        
                                    
                            
                            </div><!-- end col-->
                        </div>
                        <!-- end row -->

    

                        <!-- file preview template -->
                        <div class="d-none" id="uploadPreviewTemplate">
                            <div class="card mt-1 mb-0 shadow-none border">
                                <div class="p-2">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <img data-dz-thumbnail src="#" class="avatar-sm rounded bg-light" alt="">
                                        </div>
                                        <div class="col pl-0">
                                            <a href="javascript:void(0);" class="text-muted font-weight-bold" data-dz-name></a>
                                            <p class="mb-0" data-dz-size></p>
                                        </div>
                                        <div class="col-auto">
                                            <!-- Button -->
                                            <a href="" class="btn btn-link btn-lg text-muted" data-dz-remove>
                                                <i class="dripicons-cross"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                    </div> <!-- container -->

                </div> <!-- content -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->

               <!-- Right Sidebar -->
        <div class="right-bar">
            <div data-simplebar class="h-100">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs nav-bordered nav-justified" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link py-2" data-toggle="tab" href="#tasks-tab" role="tab">
                            <i class="mdi mdi-format-list-checkbox d-block font-22 my-1"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link py-2 active" data-toggle="tab" href="#settings-tab" role="tab">
                            <i class="mdi mdi-cog-outline d-block font-22 my-1"></i>
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content pt-0">
                    <div class="tab-pane" id="tasks-tab" role="tabpanel">
                        <h6 class="font-weight-medium px-3 m-0 py-2 font-13 text-uppercase bg-light">
                            <span class="d-block py-1">待辦事項</span>
                        </h6>
                        <div class="card">
                            <div class="card-body">
                                
                                <div class="todoapp">
                                    <div class="row">
                                        <div class="col">
                                            <h5 id="todo-message"><span id="todo-remaining">4</span> of <span id="todo-total">8</span> remaining</h5>
                                        </div>
                                        <div class="col-auto">
                                            <a href="" class="float-right btn btn-light btn-sm" id="btn-archive">更新</a>
                                        </div>
                                    </div>

                                    <div style="max-height: 310px;" data-simplebar="init"><div class="simplebar-wrapper" style="margin: 0px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: 0px; bottom: 0px;"><div class="simplebar-content-wrapper" style="height: auto; overflow: hidden scroll;"><div class="simplebar-content" style="padding: 0px;">
                                        <ul class="list-group list-group-flush todo-list" id="todo-list"><li class="list-group-item border-0 pl-0"><div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input todo-done" id="8"><label class="custom-control-label" for="8">準備課室會議</label></div></li><li class="list-group-item border-0 pl-0"><div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input todo-done" id="7" checked=""><label class="custom-control-label" for="7"><s>回覆李雯教授</s></label></div></li><li class="list-group-item border-0 pl-0"><div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input todo-done" id="6"><label class="custom-control-label" for="6">創建新賬號給李敏同學</label></div></li><li class="list-group-item border-0 pl-0"><div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input todo-done" id="5"><label class="custom-control-label" for="5">回覆系秘</label></div></li><li class="list-group-item border-0 pl-0"><div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input todo-done" id="4" checked=""><label class="custom-control-label" for="4"><s>回覆研究計劃</s></label></div></li><li class="list-group-item border-0 pl-0"><div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input todo-done" id="3" checked=""><label class="custom-control-label" for="3"><s>開題準備</s></label></div></li><li class="list-group-item border-0 pl-0"><div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input todo-done" id="2" checked=""><label class="custom-control-label" for="2"><s>創建新賬號給林姚教授</s></label></div></li><li class="list-group-item border-0 pl-0"><div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input todo-done" id="1"><label class="custom-control-label" for="1">刪除陳立同學帳號</label></div></li></ul>
                                    </div></div></div></div><div class="simplebar-placeholder" style="width: auto; height: 360px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="width: 0px; display: none;"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: visible;"><div class="simplebar-scrollbar" style="height: 266px; transform: translate3d(0px, 0px, 0px); display: block;"></div></div></div>

                                    <form name="todo-form" id="todo-form" class="needs-validation mt-3" novalidate="">
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" id="todo-input-text" name="todo-input-text" class="form-control" placeholder="新增待辦" required="">
                                                <div class="invalid-feedback">
                                                    Please enter your task name
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button class="btn-primary btn-md btn-block btn waves-effect waves-light" type="submit" id="todo-btn-submit">新增</button>
                                            </div>
                                        </div>
                                    </form>
                                </div> <!-- end .todoapp-->

                            </div> <!-- end card-body -->
                        </div>
                    </div>

                
                    <div class="tab-pane active" id="settings-tab" role="tabpanel">
                        <h6 class="font-weight-medium px-3 m-0 py-2 font-13 text-uppercase bg-light">
                            <span class="d-block py-1">主題設定</span>
                        </h6>

                        <div class="p-3">
                            <h6 class="font-weight-medium font-14 mt-4 mb-2 pb-1">背景顏色</h6>
                            <div class="custom-control custom-switch mb-1">
                                <input type="radio" class="custom-control-input" name="color-scheme-mode" value="light"
                                    id="light-mode-check" checked />
                                <label class="custom-control-label" for="light-mode-check">淺色</label>
                            </div>

                            <div class="custom-control custom-switch mb-1">
                                <input type="radio" class="custom-control-input" name="color-scheme-mode" value="dark"
                                    id="dark-mode-check" />
                                <label class="custom-control-label" for="dark-mode-check">深色</label>
                            </div>

                            <!-- Width -->
                            <h6 class="font-weight-medium font-14 mt-4 mb-2 pb-1">側邊欄</h6>
                            <div class="custom-control custom-switch mb-1">
                                <input type="radio" class="custom-control-input" name="width" value="fluid" id="fluid-check" checked />
                                <label class="custom-control-label" for="fluid-check">打開</label>
                            </div>
                            <div class="custom-control custom-switch mb-1">
                                <input type="radio" class="custom-control-input" name="width" value="boxed" id="boxed-check" />
                                <label class="custom-control-label" for="boxed-check">收起</label>
                            </div>

                            <!-- Left Sidebar-->
                            <h6 class="font-weight-medium font-14 mt-4 mb-2 pb-1">側邊欄顏色</h6>

                            <div class="custom-control custom-switch mb-1">
                                <input type="radio" class="custom-control-input" name="leftsidebar-color" value="light" id="light-check" checked />
                                <label class="custom-control-label" for="light-check">淺色</label>
                            </div>

                            <div class="custom-control custom-switch mb-1">
                                <input type="radio" class="custom-control-input" name="leftsidebar-color" value="dark" id="dark-check" />
                                <label class="custom-control-label" for="dark-check">深色</label>
                            </div>

                            <div class="custom-control custom-switch mb-1">
                                <input type="radio" class="custom-control-input" name="leftsidebar-color" value="brand" id="brand-check" />
                                <label class="custom-control-label" for="brand-check">天藍色</label>
                            </div>

                            <div class="custom-control custom-switch mb-3">
                                <input type="radio" class="custom-control-input" name="leftsidebar-color" value="gradient" id="gradient-check" />
                                <label class="custom-control-label" for="gradient-check">亮紫色</label>
                            </div>

                            <!-- size -->
                            <h6 class="font-weight-medium font-14 mt-4 mb-2 pb-1">側邊欄大小</h6>

                            <div class="custom-control custom-switch mb-1">
                                <input type="radio" class="custom-control-input" name="leftsidebar-size" value="default"
                                    id="default-size-check" checked />
                                <label class="custom-control-label" for="default-size-check">預設</label>
                            </div>

                            <div class="custom-control custom-switch mb-1">
                                <input type="radio" class="custom-control-input" name="leftsidebar-size" value="condensed"
                                    id="condensed-check" />
                                <label class="custom-control-label" for="condensed-check">最小化</small></label>
                            </div>

                            <div class="custom-control custom-switch mb-1">
                                <input type="radio" class="custom-control-input" name="leftsidebar-size" value="compact"
                                    id="compact-check" />
                                <label class="custom-control-label" for="compact-check">中等</small></label>
                            </div>

                            <!-- Topbar -->
                            <h6 class="font-weight-medium font-14 mt-4 mb-2 pb-1">頂欄</h6>

                            <div class="custom-control custom-switch mb-1">
                                <input type="radio" class="custom-control-input" name="topbar-color" value="dark" id="darktopbar-check"
                                    checked />
                                <label class="custom-control-label" for="darktopbar-check">深色</label>
                            </div>

                            <div class="custom-control custom-switch mb-1">
                                <input type="radio" class="custom-control-input" name="topbar-color" value="light" id="lighttopbar-check" />
                                <label class="custom-control-label" for="lighttopbar-check">淺色</label>
                            </div>


                            <button class="btn btn-primary btn-block mt-4" id="resetBtn">重置為默認</button>

                        </div>

                    </div>
                </div>

            </div> <!-- end slimscroll-menu-->
        </div>
        <!-- /Right-bar -->


        <!-- Todo app -->
        <script src="../assets/js/pages/jquery.todo.js"></script>

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- App js -->
        <script src="../assets/js/vendor.min.js"></script>

        <!-- Summernote js -->
        <script src="../assets/libs/summernote/summernote-bs4.min.js"></script>
        <!-- Select2 js-->
        <script src="../assets/libs/select2/js/select2.min.js"></script>
        <!-- Dropzone file uploads-->
        <script src="../assets/libs/dropzone/min/dropzone.min.js"></script>

        <!-- Init js-->
        <script src="../assets/js/pages/form-fileuploads.init.js"></script>

        <!-- Init js -->
        <script src="../assets/js/pages/add-product.init.js"></script>

        <!-- App js -->
        <script src="../assets/js/app.min.js"></script>
        
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