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



    <!-- Plugins css -->
    <link href="../assets/libs/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet"
        type="text/css" />



    <!-- Plugins css -->
    <link href="../assets/libs/mohithg-switchery/switchery.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/libs/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />
    <link href="../assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/libs/selectize/css/selectize.bootstrap3.css" rel="stylesheet" type="text/css" />
    <link href="../assets/libs/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet"
        type="text/css" />

    <!-- App css -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="../assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

    <link href="../assets/css/bootstrap-dark.min.css" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
    <link href="../assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />

    <!-- icons -->
    <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <style>
    p {
        max-width: 200px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    </style>
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
                                        <li class="breadcrumb-item active">分配稿件</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <form method="post" action="distri-output.php">
                                        <?php 
                                            $id=$_GET['id'];
                                            $pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
                                            foreach ($pdo->query("select title, auth1,auth2,auth3,auth4,auth5,summary, uploadname,uploadtime from newpaper where id='".$id."'") as $row) {
                                                $title=$row["title"];
                                                $auth1=$row['auth1'];
                                                $auth2=$row['auth2'];
                                                $auth3=$row['auth3'];
                                                $auth4=$row['auth4'];
                                                $auth5=$row['auth5'];
                                                $summary=$row['summary'];   
                                                $uploadname=$row['uploadname'];
                                                $uploadtime=$row['uploadtime'];

                                            }
                                            ?>
                                        <input type="hidden" name="title" value="<?php echo $title?>"></input>
                                        <div class="row">
                                            <div class="col-9">
                                                <h4><b><?php echo $title ?></b></h4>
                                            </div>

                                            <button type="button" class="btn-shadow col-3 form-control"
                                                data-toggle="modal" data-target="#exampleModalLong"
                                                style="height:fit-content" onclick="showModal()">修改文章領域</button>
                                        </div>
                                        <?php
                                            $pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
                                            $subject=['人力資源管理','數量方法','資訊管理','會計','財務管理','審計','管理與政策','國際企業','行銷管理','國際貿易','生產與作業管理','統計'];
                                            $query=$pdo->query("SELECT  f_name from newpaper_field  where title='$title'");
                                            $datalist=$query->fetchall();
                                            foreach($datalist as $datadetail){
                                                $arr[]=$datadetail['f_name'];
                                            };
                                            echo "<b>作者：</b>";
                                            echo $auth1,' ',$auth2,' ',$auth3,' ',$auth4,' ',$auth5;

                                            
                                            echo " &nbsp  <b>文章領域：</b>";
                                            foreach($arr as $fdetail){
                                                echo $fdetail;
                                                echo "&nbsp";
                                            }

                                            // 計算文章所屬領域有幾個
                                            $fdetailnum = count($arr);

                                            for($i=0;$i<$fdetailnum;$i++){
                                                ${"f".$i}=$arr[$i];
                                            }
                                           
                                            // 轉為list，之後才能用sql in 語法
                                            list(${"f".$i}) = $arr;
                                                                                        
                                            echo " &nbsp  <b>上傳日期：</b>";
                                            echo $uploadtime;
                                            ?>


                                        <div class="row mt-3">
                                            <div class="form-group col-md-6">
                                                <label class="text-muted">審稿者</label> <br />
                                                <select id="selectize-maximum" action='distri-output.php' method='post'
                                                    name='pro[]' aria-placeholder='請選擇'>

                                                    <?php  
                                                        $editors=$pdo->query("SELECT  login,name from account  where account.status = '審稿者' ");
                                                        foreach($editors as $row){
                                                            $login = $row['login'];
                                                            $name = $row['name'];

                                                            echo "<option name='pro1' value='" . $row["login"] . "'>" .$row["name"]." ".$row["login"] . "</option>";
                                                        }
                                                        ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="text-muted">回覆期限</label>
                                                <input type="text" id="humanfd-datepicker" name="ddl"
                                                    class="form-control"
                                                    placeholder="<?php $date=date("M,d,Y"); echo $date; ?>">
                                            </div>

                                        </div>


                                        <div class="row mt-3">
                                            <div class="form-group col-md-12">
                                                <label class="text-muted">留言</label>
                                                <textarea class="form-control" name="comment" rows="3"
                                                    style="height:160px"></textarea>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <a href="index.php?method=maildistribution"><button type="button"
                                                    class="btn btn-light waves-effect waves-light">取消</button></a>
                                            <a href="distri-output.php"><button type="submit"
                                                    class="btn btn-blue waves-effect waves-light">寄出</button></a>
                                        </div>
                                    </form>
                                </div>
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
    <script type="text/javascript">
    function showModal() {
        $('#change').modal('show');
    }

    function closeModal() {
        $('#change').modal('hide');
    }
    </script>
    <div class="modal" tabindex="-1" role="dialog" id="change">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">修改文章領域</h5>
                </div>
                <form action="change_subject.php" method="post">
                    <input type=hidden name="title" value="<?php echo $title ?>">
                    <div class="modal-body">
                        <div style="background-color: whitesmoke; padding: 1px;">
                            <div style="margin-top: 3px;">
                                <?php
                        $pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
                        $subject=['人力資源管理','數量方法','資訊管理','會計','財務管理','審計','管理與政策','國際企業','行銷管理','國際貿易','生產與作業管理','統計'];
                        $query=$pdo->query("SELECT f_name from newpaper_field where title = '".$title."'");
                        $datalist=$query->fetchall();
                        foreach($datalist as $datadetail){
                        $arry[]=$datadetail['f_name'];
                        }
                        ?>
                            </div>
                        </div>
                        <div style="background-color: whitesmoke; padding: 1px;">
                            <div style="margin-top: 3px;">
                                <div class="col-6 float-right">
                                    <div class="checkbox mb-2">
                                        <input type="checkbox" id="f1" name="field[]" value="<?php echo "管理與政策"?>"
                                            <?php if(in_array('管理與政策',$arry)) echo 'checked'?>>
                                        <label for="f1"> 管理與政策 </label>
                                    </div>
                                    <div class="checkbox mb-2">
                                        <input type="checkbox" id="f2" name="field[]" value="<?php echo "國際企業"?>"
                                            <?php if(in_array('國際企業',$arry)) echo 'checked'?>>
                                        <label for="f2"> 國際企業 </label>
                                    </div>
                                    <div class="checkbox mb-2">
                                        <input type="checkbox" id="f3" name="field[]" value="<?php echo "行銷管理"?>"
                                            <?php if(in_array('行銷管理',$arry)) echo 'checked'?>>
                                        <label for="f3"> 行銷管理 </label>
                                    </div>
                                    <div class="checkbox mb-2">
                                        <input type="checkbox" id="f4" name="field[]" value="<?php echo "國際貿易"?>"
                                            <?php if(in_array('國際貿易',$arry)) echo 'checked'?>>
                                        <label for="f4"> 國際貿易 </label>
                                    </div>
                                    <div class="checkbox mb-2">
                                        <input type="checkbox" id="f5" name="field[]" value="<?php echo "生產與作業管理"?>"
                                            <?php if(in_array('生產與作業管理',$arry)) echo 'checked'?>>
                                        <label for="f5"> 生產與作業管理 </label>
                                    </div>
                                    <div class="checkbox mb-2">
                                        <input type="checkbox" id="f6" name="field[]" value="<?php echo "統計"?>"
                                            <?php if(in_array('統計',$arry)) echo 'checked'?>>
                                        <label for="f6"> 統計 </label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="checkbox mb-2">
                                        <input type="checkbox" id="f7" name="field[]" value="<?php echo "人力資源管理"?>"
                                            <?php if(in_array('人力資源管理',$arry)) echo 'checked'?>>
                                        <label for="f7"> 人力資源管理 </label>
                                    </div>
                                    <div class="checkbox mb-2">
                                        <input type="checkbox" id="f8" name="field[]" value="<?php echo "數量方法"?>"
                                            <?php if(in_array('數量方法',$arry)) echo 'checked'?>>
                                        <label for="f8"> 數量方法 </label>
                                    </div>
                                    <div class="checkbox mb-2">
                                        <input type="checkbox" id="f9" name="field[]" value="<?php echo "資訊管理"?>"
                                            <?php if(in_array('資訊管理',$arry)) echo 'checked'?>>
                                        <label for="f9"> 資訊管理 </label>
                                    </div>
                                    <div class="checkbox mb-2">
                                        <input type="checkbox" id="f10" name="field[]" value="<?php echo "會計"?>"
                                            <?php if(in_array('會計',$arry)) echo 'checked'?>>
                                        <label for="f10"> 會計 </label>
                                    </div>
                                    <div class="checkbox mb-2">
                                        <input type="checkbox" id="f11" name="field[]" value="<?php echo "財務管理"?>"
                                            <?php if(in_array('財務管理',$arry)) echo 'checked'?>>
                                        <label for="f11"> 財務管理 </label>
                                    </div>
                                    <div class="checkbox mb-2">
                                        <input type="checkbox" id="f12" name="field[]" value="<?php echo "審計"?>"
                                            <?php if(in_array('審計',$arry)) echo 'checked'?>>
                                        <label for="f12"> 審計 </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light waves-effect waves-light" data-dismiss="modal"
                                onclick="closeModal()">取消</button>
                            <button type="submit" class="btn btn-warning waves-effect waves-light">確認</button>
                        </div>
                </form>
            </div>
        </div>


        <!-- Vendor js -->
        <script src="../assets/js/vendor.min.js"></script>


        <script src="../assets/libs/selectize/js/standalone/selectize.min.js"></script>
        <script src="../assets/libs/select2/js/select2.min.js"></script>
        <script src="../assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
        <script src="../assets/js/pages/form-advanced.init.js"></script>

        <script src="../assets/libs/flatpickr/flatpickr.min.js"></script>
        <script src="../assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
        <script src="../assets/js/pages/form-pickers.init.js"></script>

        <!-- App js -->
        <script src="../assets/js/app.min.js"></script>


</body>

</html>